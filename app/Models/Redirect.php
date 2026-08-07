<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = [
        'from_url', 'to_url', 'status_code', 'is_active', 'hits'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'hits' => 'integer',
    ];
}