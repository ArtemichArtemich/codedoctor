<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackerProject extends Model
{
    use HasFactory;

    public const STATUSES = [
        'active' => 'Активен',
        'paused' => 'На паузе',
        'completed' => 'Завершён',
        'archived' => 'В архиве',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'client_name',
        'site_url',
        'repository_url',
        'status',
        'created_by',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'tracker_project_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}