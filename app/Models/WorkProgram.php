<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkProgram extends Model
{
    protected $table = 'work_programs';

    protected $fillable = [
        'name',
        'description',
        'images',
        'division_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function WorkProgramAdministrators(): HasMany
    {
        return $this->hasMany(WorkProgramAdministrator::class);
    }
}
