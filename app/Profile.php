<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'user_role',
        'address',
        'contact_number',
        'profile_picture',
    ];

    protected $dates = ['deleted_at', 'birth_date'];
}
