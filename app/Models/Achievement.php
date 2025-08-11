<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Achievement extends Model
{
    protected $table = 'achievements';

    protected $fillable = [
        'name',
        'description',
        'image',
        'achievement_type_id',
        'achievement_category_id',
        'achievement_level_id',
    ];

    public function achievementType(): BelongsTo
    {
        return $this->belongsTo(AchievementType::class);
    }

    public function achievementCategory(): BelongsTo
    {
        return $this->belongsTo(AchievementCategory::class);
    }

    public function achievementLevel(): BelongsTo
    {
        return $this->belongsTo(AchievementLevel::class);
    }

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
