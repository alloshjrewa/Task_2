<?php

namespace App\Models;

<<<<<<< HEAD
 use Illuminate\Contracts\Auth\MustVerifyEmail;
=======
use Illuminate\Contracts\Auth\MustVerifyEmail;
>>>>>>> 2caf74e (task_3)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
<<<<<<< HEAD

class User extends Authenticatable implements MustVerifyEmail
=======
//implements MustVerifyEmail
class User extends Authenticatable
>>>>>>> 2caf74e (task_3)
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'profile_photo',
        'certificate',
<<<<<<< HEAD
        'remember_token',
        'remember_token_expiration',
        'email_verified_at'
    ];

=======
        'verification_code',
        'verification_code_expiration',
        'email_verified_at'

    ];


>>>>>>> 2caf74e (task_3)
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
