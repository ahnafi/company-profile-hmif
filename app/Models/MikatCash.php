<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MikatCash extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "administrator_id",
        "date",
        "work_program",
        "type",
        "source_fund",
        "amount"
    ];

    public function administrator(): BelongsTo
    {
        return $this->belongsTo(Administrator::class);
    }
}
