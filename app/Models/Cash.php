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

    /**
     * Get cash fund total (amount + penalty) by month
     */
    public function getCashFundTotalByMonth(string $month): int
    {
        return $this->cashFunds()
            ->where('month', $month)
            ->get()
            ->sum(fn($fund) => $fund->amount + $fund->penalty);
    }

    /**
     * Get April cash fund total
     */
    public function getAprilAttribute(): int
    {
        return $this->getCashFundTotalByMonth('april');
    }

    /**
     * Get May cash fund total
     */
    public function getMayAttribute(): int
    {
        return $this->getCashFundTotalByMonth('may');
    }

    /**
     * Get June cash fund total
     */
    public function getJuneAttribute(): int
    {
        return $this->getCashFundTotalByMonth('june');
    }

    /**
     * Get July cash fund total
     */
    public function getJulyAttribute(): int
    {
        return $this->getCashFundTotalByMonth('july');
    }

    /**
     * Get August cash fund total
     */
    public function getAugustAttribute(): int
    {
        return $this->getCashFundTotalByMonth('august');
    }

    /**
     * Get September cash fund total
     */
    public function getSeptemberAttribute(): int
    {
        return $this->getCashFundTotalByMonth('september');
    }

    /**
     * Get October cash fund total
     */
    public function getOctoberAttribute(): int
    {
        return $this->getCashFundTotalByMonth('october');
    }

    /**
     * Get November cash fund total
     */
    public function getNovemberAttribute(): int
    {
        return $this->getCashFundTotalByMonth('november');
    }
    
    /**
     * Get total cash fund amount for all months
     */
    public function getTotalCashFundAttribute(): int
    {
        return $this->cashFunds()
            ->get()
            ->sum(fn($fund) => $fund->amount + $fund->penalty);
    }

    /**
     * Get cash fund total by month for all records (static method for summarizer)
     */
    public static function getTotalByMonth(string $month): int
    {
        return static::with('cashFunds')
            ->get()
            ->sum(fn($record) => $record->getCashFundTotalByMonth($month));
    }
}
