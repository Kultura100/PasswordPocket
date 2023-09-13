<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordDiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'password',
        'lastPassword',
        'url',
        'token',        
    ];
}
