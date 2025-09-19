<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\RoleEnum;
use Hash;

class Member extends Authenticatable
{
    //
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'avatar',
        'phone',
        'description',
        'role',
        'provider_name',
        'provider_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'role' => RoleEnum::class,
        'password' => 'hashed'
    ];
}
