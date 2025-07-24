<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cash extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'administrator_id',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the administrator that owns the cash
     */
    public function administrator(): BelongsTo
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Get cash fund records
     */
    public function cashFunds(): HasMany
    {
        return $this->hasMany(CashFund::class);
    }
}
