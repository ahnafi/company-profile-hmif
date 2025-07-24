<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'administrator_id',
    ];

    /**
     * Get the administrator that owns the deposit
     */
    public function administrator(): BelongsTo
    {
        return $this->belongsTo(Administrator::class);
    }

    public function depositFunds(): HasMany
    {
        return $this->hasMany(DepositFund::class);
    }

    /**
     * Get deposit penalties for this deposit
     */
    public function depositPenalties(): HasMany
    {
        return $this->hasMany(DepositPenalty::class);
    }

    /**
     * Get total penalty amount by detail type
     */
    public function getPenaltyAmountByDetail(string $detail): int
    {
        return $this->depositPenalties()
            ->where('detail', $detail)
            ->sum('amount');
    }

    /**
     * Get plenary meeting penalty amount
     */
    public function getPlenaryMeetingAttribute(): int
    {
        return $this->getPenaltyAmountByDetail('plenary_meeting');
    }

    /**
     * Get jacket day penalty amount
     */
    public function getJacketDayAttribute(): int
    {
        return $this->getPenaltyAmountByDetail('jacket_day');
    }

    /**
     * Get graduation ceremony penalty amount
     */
    public function getGraduationCeremonyAttribute(): int
    {
        return $this->getPenaltyAmountByDetail('graduation_ceremony');
    }

    /**
     * Get secretariat maintenance penalty amount
     */
    public function getSecretariatMaintenanceAttribute(): int
    {
        return $this->getPenaltyAmountByDetail('secretariat_maintenance');
    }

    /**
     * Get work program penalty amount
     */
    public function getWorkProgramAttribute(): int
    {
        return $this->getPenaltyAmountByDetail('work_program');
    }

    /**
     * Get other penalty amount
     */
    public function getOtherAttribute(): int
    {
        return $this->getPenaltyAmountByDetail('other');
    }

    /**
     * Get total penalty amount
     */
    public function getTotalPenaltyAmountAttribute(): int
    {
        return $this->depositPenalties()->sum('amount');
    }

    /**
     * Get total deposit fund amount
     */
    public function getTotalDepositFundAttribute(): int
    {
        return $this->depositFunds()->sum('amount');
    }

    /**
     * Get deposit amount (total funds - total penalties)
     */
    public function getDepositAttribute(): int
    {
        return $this->total_deposit_fund - $this->total_penalty_amount;
    }

}
