<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name',
        'nim',
        'study_program',
        'batch_year',
    ];

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }
}
