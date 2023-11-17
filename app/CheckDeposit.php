<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount','front_view','back_view','status','slug','date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
