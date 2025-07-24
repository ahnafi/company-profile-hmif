<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fund_id',
        'date',
        'type',
        'detail',
        'amount'
    ];

    protected $dates = ['deleted_at', 'date'];

    protected $casts = [
        'date' => 'date',
        'amount' => 'integer'
    ];

    /**
     * Get the fund that owns the transaction
     */
    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }
}
