<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','otp','slug','data'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
