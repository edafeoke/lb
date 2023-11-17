<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','card_type','status','card_number','card_pin','card_cvv','card_date','card_account','card_limit','card_balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
