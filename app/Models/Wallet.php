<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Wallet extends Authenticatable
{
    protected $fillable = [
        'id',
        'user_id',
        'balance',
        'created_at',
        'updated_at',
    ];

}
