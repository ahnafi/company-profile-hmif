<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;
    protected $fillable = ["article_id"];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
