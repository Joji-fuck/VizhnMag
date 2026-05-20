<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $fillable = [
        'surname','name', 'login', 'role', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
