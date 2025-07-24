<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashFund extends Model
{
    protected $table = 'cash_fund';

    protected $fillable = [
        'cash_id',
        'fund_id',
        'date',
        'month',
        'amount',
        'penalty',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'integer',
        'penalty' => 'integer',
    ];

    public function cash(): BelongsTo
    {
        return $this->belongsTo(Cash::class);
    }

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    /**
     * Get total amount (cash + penalty)
     */
    public function getTotalAttribute(): int
    {
        return $this->amount + $this->penalty;
    }
}
