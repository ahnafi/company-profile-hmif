<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Division extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $dates = ['deleted_at'];

    /**
     * Get administrators for this division
     */
    public function administrators(): HasMany
    {
        return $this->hasMany(Administrator::class);
    }

    public function workPrograms(): HasMany
    {
        return $this->hasMany(WorkProgram::class);
    }
}
