<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    protected $fillable = ['slug', 'preview_image', 'is_published', 'sort_order'];

    public function translations(): HasMany
    {
        return $this->hasMany(BlogTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}