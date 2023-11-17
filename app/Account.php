<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','account_type','account_number','total_balance','available_balance','cot','tax','imf','account_pin','routing_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
