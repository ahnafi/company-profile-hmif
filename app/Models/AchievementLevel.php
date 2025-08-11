<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AchievementLevel extends Model
{
    protected $table =  'achievement_levels';

    protected $fillable = ['name'];

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }
}
