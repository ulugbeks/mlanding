<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogTranslation extends Model
{
    protected $fillable = [
        'blog_id', 'locale', 'title', 'excerpt', 'content',
        'meta_title', 'meta_description', 'meta_keywords'
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}