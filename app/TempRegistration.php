<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['email','token','data','slug'];

}
