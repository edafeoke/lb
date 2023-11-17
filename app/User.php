<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
// use Illuminate\Auth\Passwords\CanResetPassword;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\CausesActivity;
use Lab404\Impersonate\Models\Impersonate;
use Hash;
use Carbon\Carbon;
use Laravel\Cashier\Billable;
use App\Transaction;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, CausesActivity, Impersonate;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','middlename','lastname','username','email',
        'phone','avatar','birthday','sex','address','account_number',
        'occupation','marital_status','status','numbers_of_login',
        'password','last_login_at','last_login_ip','email_verified_at',
        'account_pin','pin_verified_at','pop_message','pop_status','currency'
    ];

    // protected static $logFillable = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function getFullnameAttribute()
    {
        $fullname = $this->firstname. ' ' . $this->lastname;
        return $fullname;
    }
    public function getFullnamesAttribute()
    {
        $fullnames = $this->firstname. ' ' . $this->middlename. ' ' . $this->lastname;
        return $fullnames;
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'sender_id');
    }

    public function checks()
    {
        return $this->hasMany(CheckDeposit::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function hasVerified()
    {
        return ! is_null($this->pin_verified_at);
    }

    public function card()
    {
        return $this->hasOne(Card::class);
    }

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->hasRole('admin');
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        return !$this->hasRole('admin');
    }
}

