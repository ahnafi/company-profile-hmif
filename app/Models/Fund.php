<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get transactions for this fund
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function cashFunds(): HasMany
    {
        return $this->hasMany(CashFund::class);
    }

    public function depositFunds(): HasMany
    {
        return $this->hasMany(DepositFund::class);
    }
}
