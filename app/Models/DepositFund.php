<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositFund extends Model
{
    protected $table = "deposit_fund";

    protected $fillable = [
        "deposit_id",
        'fund_id',
        'date',
        'amount'
    ];

    protected $casts = [
        "date" => "date",
        'amount' => 'integer',
    ];

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class);
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }
}
