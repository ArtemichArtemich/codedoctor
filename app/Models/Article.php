<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'h1',
        'excerpt',
        'content',
        'category',
        'tags',
        'image',
        'meta_title',
        'meta_description',
        'is_active',
        'published_at',
        'sort',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getUrlAttribute(): string
    {
        return '/blog/' . $this->slug;
    }

    public function scopePublished($query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($query) {
                $query
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public static function categories(): array
    {
        return [
            'clients' => 'Для владельцев сайтов',
            'development' => 'Разработка',
            'diagnostics' => 'Диагностика',
            'python' => 'Python',
            'seo' => 'SEO',
            'opencart' => 'OpenCart',
            'servers' => 'Серверы',
        ];
    }

    public function getCategoryNameAttribute(): string
    {
        return self::categories()[$this->category] ?? $this->category ?? '';
    }
}