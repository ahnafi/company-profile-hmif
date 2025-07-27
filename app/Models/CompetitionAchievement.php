<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitionAchievement extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "students",
        "competition_level",
        "competition_type",
        "competition_year",
        "event_name",
        "organizer",
        "achievement",
        "team_type"
    ];

    protected $casts = [
        "students" => "array"
    ];
}
