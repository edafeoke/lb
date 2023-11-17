<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason','date','duration','amount','user_id','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

