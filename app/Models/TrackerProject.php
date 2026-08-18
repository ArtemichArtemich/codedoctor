<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackerProject extends Model
{
    /** @use HasFactory<\Database\Factories\TrackerProjectFactory> */
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Task::class, 'tracker_project_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
