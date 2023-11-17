<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id','amount','bank_name','account_name','account_number','account_type','swift','routing','remarks','status','type','date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
}
