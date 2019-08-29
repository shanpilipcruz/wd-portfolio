<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uploader_id',
        'project_name',
        'project_description',
        'project_author',
        'project_image',
        'project_link'
    ];

    protected $dates = ['deleted_at'];
}
