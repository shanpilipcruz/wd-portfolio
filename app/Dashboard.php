<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = [
        'ProjectName',
        'ProjectDescription',
        'ProjectImage',
        'ProjectAuthor'
    ];
}
