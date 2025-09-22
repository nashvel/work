<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectManagement\Project;

class AutomationRule extends Model
{
    use HasFactory;

    protected $table = 't_projects_automation_rules';

    protected $fillable = [
        'project_id',
        'type',
        'trigger',
        'action',
        'priority',
        'conditions',
        'parameters',
        'is_active',
        'last_executed',
        'execution_count'
    ];

    protected $casts = [
        'conditions' => 'array',
        'parameters' => 'array',
        'is_active' => 'boolean',
        'last_executed' => 'datetime',
        'execution_count' => 'integer'
    ];

    /**
     * Get the project that owns the automation rule
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    /**
     * Scope for active rules
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific project
     */
    public function scopeForProject($query, $projectId)
    {
        return $query->where('project_id', $projectId);
    }

    /**
     * Scope for specific type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Mark rule as executed
     */
    public function markExecuted()
    {
        $this->update([
            'last_executed' => now(),
            'execution_count' => $this->execution_count + 1
        ]);
    }
}
