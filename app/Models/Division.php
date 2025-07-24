<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get administrators for this division
     */
    public function administrators(): HasMany
    {
        return $this->hasMany(Administrator::class);
    }

}
