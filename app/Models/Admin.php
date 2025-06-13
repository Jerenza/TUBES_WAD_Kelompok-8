<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    protected $fillable = [
        'username',
        'password',
        'nama',
        'email'
    ];

    protected $hidden = [
        'password'
    ];
} 