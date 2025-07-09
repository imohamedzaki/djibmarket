<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model; // If not using Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable; // If using authentication
use Illuminate\Notifications\Notifiable;

// class Driver extends Model // Use this if not authenticatable
class Driver extends Authenticatable // Use this if driver needs authentication
{
    use HasFactory, Notifiable; // Add Notifiable if needed

    protected $table = 'drivers';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password', // Consider hiding password from serialization
        'phone',
        'address',
        'avatar',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
