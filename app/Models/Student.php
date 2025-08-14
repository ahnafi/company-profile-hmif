<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $table = 'students';

    protected $fillable = [
        'name',
        'nim',
        'image',
        'study_program',
        'batch_year',
    ];

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class, 'student_achievements', 'student_id', 'achievement_id')
            ->select('students.id as student_id', 'students.name as student_name', 'students.nim', 'students.study_program', 'students.batch_year');

    }
}
