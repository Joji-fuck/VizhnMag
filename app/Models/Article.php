<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = ['title', 'image','category_id','content'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
