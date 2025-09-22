<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User;

class Task extends Model
{
    protected $table = 't_project_tasks';
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'estimated_hours',
        'actual_hours',
        'assigned_to',
        'created_by',
        'order',
        'attachments'
    ];

    protected $casts = [
        'due_date' => 'date',
        'attachments' => 'array'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 't_project_task_user_assignments', 'task_id', 'user_id');
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date && $this->due_date->isPast() && $this->status !== 'completed';
    }

    public function getProgressPercentageAttribute(): int
    {
        return match($this->status) {
            'todo' => 0,
            'in_progress' => 50,
            'review' => 80,
            'completed' => 100,
            'cancelled' => 0,
            default => 0
        };
    }
}
