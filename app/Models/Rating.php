<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $fillable = ['movie_id', 'nickname', 'score', 'review', 'ip_address'];
    protected static function booted(): void
    {
        static::saved(fn(Rating $r) => $r->movie->recalculateRating());
        static::deleted(fn(Rating $r) => $r->movie->recalculateRating());
    }
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
