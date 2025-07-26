<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Download extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'file',
        'link',
    ];

}
