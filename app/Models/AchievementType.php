<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AchievementType extends Model
{
    protected $table = 'achievement_types';

    protected $fillable = ['name'];

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }
}
