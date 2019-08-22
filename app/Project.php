<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ProjectName',
        'ProjectDescription',
        'ProjectAuthor',
        'ProjectImage',
        'ProjectLink'
    ];

    protected $dates = ['deleted_at'];

    public function Users(){
        return $this->hasMany('App\User');
    }
}
