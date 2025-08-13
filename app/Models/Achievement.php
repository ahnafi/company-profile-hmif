<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Achievement extends Model
{
    protected $table = 'achievements';

    protected $fillable = [
        'name',
        'description',
        'image',
        'proof',
        'awarded_at',
        'approval',
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

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_achievements', 'achievement_id', 'student_id')
            ->select('students.id as student_id', 'students.name as student_name', 'students.nim', 'students.study_program', 'students.batch_year');
    }

}
