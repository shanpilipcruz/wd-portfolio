<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public function User()
    {
        return $this->hasMany('App/User');
    }

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'role',
        'username',
        'password',
        'email',
        'contact_number',
        'address',
        'description'
    ];
}
