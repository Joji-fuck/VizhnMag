<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = ['title', 'year', 'description', 'image', 'genre', 'director', 'release_date', 'link', 'duration', 'country', 'city', 'average_rating', 'ratings_count'];
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function recalculateRating(): void
    {
        $this->update([
            'average_rating' => round($this->ratings()->avg('score') ?? 0, 2),
            'ratings_count' => $this->ratings()->count(),
        ]);
    }
}
