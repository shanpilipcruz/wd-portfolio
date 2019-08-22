<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{

    use SoftDeletes;

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

    protected $dates = ['deleted_at'];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
