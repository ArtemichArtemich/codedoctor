<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 
        'title', 
        'h1',
        'short_description',
        'description',
        'content',
        'image',
        'images',
        'icon',
        'price_from',
        'features',
        'faq',
        'cases',
        'technologies',
        'meta_title',
        'meta_description',
        'sort',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'faq' => 'array',
        'cases' => 'array',
        'technologies' => 'array',
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    public function getUrlAttribute()
    {
        return '/services/' . $this->slug;
    }
}