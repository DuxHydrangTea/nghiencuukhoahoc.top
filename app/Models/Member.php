<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\RoleEnum;
use Hash;
use Storage;

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
        'role' => 'int',
        'password' => 'hashed'
    ];

    public function isProvidedAccout(){
        return $this->provider_name !== null;
    }

    public function getAvatarUrlAttribute(){
        return $this->isProvidedAccout() ? $this->avatar : Storage::disk('b2')->url($this->avatar);
    }
}
