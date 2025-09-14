<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "name",
        "nip",
        "image",
        "type" // "informatics", "computer_engineering"
    ];
}
