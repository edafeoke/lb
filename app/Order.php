<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Account;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'description','user_id','account_number','status','amount','type','time','date','order_id','from_bank',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class,'account_number');
    }

    public function lastWithdrawal()
    {
        $lastWithdrawal =  $this->where('user_id',auth()->id())->whereType('debit')->last();
        return $lastWithdrawal->amount;
    }
}
