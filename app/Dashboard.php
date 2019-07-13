<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ProjectName',
        'ProjectDescription',
        'ProjectAuthor',
        'ProjectImage',
        'ProjectLink'
    ];
}
