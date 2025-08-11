<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkProgramAdministrator extends Model
{
    protected $table = 'work_program_administrators';

    protected $fillable = [
        'position',
        'work_program_id',
        'administrator_id',
    ];

    public function workProgram(): BelongsTo
    {
        return $this->belongsTo(WorkProgram::class);
    }

    public function administrator(): BelongsTo
    {
        return $this->belongsTo(Administrator::class);
    }
}
