<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    use SoftDeletes;

    public function User(){
        return $this->belongsTo('App/User');
    }

    protected $fillable = [
        'Project'
    ];
}
