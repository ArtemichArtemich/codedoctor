<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(TrackerProject::class, 'tracker_project_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function priority()
    {
        return $this->belongsTo(TaskPriority::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }
}
