<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'title_short', 'category', 'price', 'duration',
        'complexity', 'client', 'website', 'has_logo', 'logo', 'logo_color',
        'task', 'tags', 'solution_text', 'solution_list', 'technologies',
        'results', 'details', 'result', 'sort', 'is_active', 'images',
    ];

    protected $casts = [
        'tags' => 'array',
        'images' => 'array',
        'solution_list' => 'array',
        'technologies' => 'array',
        'results' => 'array',
        'details' => 'array',
        'has_logo' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getUrlAttribute()
    {
        return '/cases/' . $this->slug;
    }
}