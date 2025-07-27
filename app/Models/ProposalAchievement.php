<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProposalAchievement extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "students",
        "program_type",
        "program_title",
        "program_year",
        "achievement",
    ];

    protected $casts = [
        "students" => "array"
    ];
}
