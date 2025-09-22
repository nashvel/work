<?php

namespace App\Http\Controllers\ProjectManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AutomationService;
use App\Models\ProjectManagement\Project;
use App\Models\ProjectManagement\Task;
use App\Models\ProjectManagement\AutomationRule;

class AutomationController extends Controller
{
    protected $automationService;

    public function __construct(AutomationService $automationService)
    {
        $this->automationService = $automationService;
    }

    /**
     * Get AI-powered automation suggestions for a project
     */
    public function getAutomationSuggestions(Request $request, $projectId)
    {
        try {
            \Log::info('AutomationController: Getting suggestions for project', ['project_id' => $projectId]);
            
            $project = Project::with(['tasks.assignedUser', 'teamMembers'])->find($projectId);
            
            if (!$project) {
                \Log::warning('AutomationController: Project not found', ['project_id' => $projectId]);
                return response()->json([
                    'success' => false,
                    'message' => 'Project not found'
                ], 404);
            }
            
            \Log::info('AutomationController: Project found', [
                'project_id' => $projectId,
                'tasks_count' => $project->tasks->count(),
                'team_members_count' => $project->teamMembers->count()
            ]);
            
            $suggestions = $this->automationService->generateAutomationSuggestions($project);
            
            \Log::info('AutomationController: Generated suggestions', [
                'project_id' => $projectId,
                'suggestions_count' => count($suggestions),
                'suggestions' => $suggestions
            ]);
            
            return response()->json([
                'success' => true,
                'suggestions' => $suggestions
            ]);
            
        } catch (\Exception $e) {
            \Log::error('AutomationController error: ' . $e->getMessage(), [
                'project_id' => $projectId,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate automation suggestions',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Execute an automation rule
     */
    public function executeAutomation(Request $request)
    {
        $request->validate([
            'rule_type' => 'required|string',
            'trigger_task_id' => 'nullable|integer',
            'target_task_id' => 'required|integer',
            'assignee_id' => 'required|integer'
        ]);

        try {
            $result = $this->automationService->executeAutomation(
                $request->rule_type,
                $request->trigger_task_id,
                $request->target_task_id,
                $request->assignee_id
            );

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Automation executed successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to execute automation'
            ], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Automation execution failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new automation rule
     */
    public function createAutomationRule(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer',
            'trigger' => 'required|string',
            'action' => 'required|string',
            'type' => 'required|string',
            'priority' => 'required|in:high,medium,low'
        ]);

        try {
            // Check if project exists
            $project = Project::find($request->project_id);
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project not found'
                ], 404);
            }

            // Create automation rule in database
            $automationRule = AutomationRule::create([
                'project_id' => $request->project_id,
                'type' => $request->type,
                'trigger' => $request->trigger,
                'action' => $request->action,
                'priority' => $request->priority,
                'is_active' => true,
                'conditions' => $request->conditions ?? [],
                'parameters' => $request->parameters ?? []
            ]);

            \Log::info('Automation rule created', [
                'rule_id' => $automationRule->id,
                'project_id' => $request->project_id,
                'type' => $request->type,
                'trigger' => $request->trigger,
                'action' => $request->action
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Automation rule created successfully',
                'rule' => [
                    'id' => $automationRule->id,
                    'type' => $automationRule->type,
                    'trigger' => $automationRule->trigger,
                    'action' => $automationRule->action,
                    'priority' => $automationRule->priority,
                    'is_active' => $automationRule->is_active
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Failed to create automation rule', [
                'error' => $e->getMessage(),
                'project_id' => $request->project_id,
                'type' => $request->type
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create automation rule: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get active automation rules for a project
     */
    public function getAutomationRules(Request $request, $projectId)
    {
        try {
            $project = Project::find($projectId);
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project not found'
                ], 404);
            }

            $rules = AutomationRule::forProject($projectId)
                ->active()
                ->orderBy('priority', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'rules' => $rules->map(function($rule) {
                    return [
                        'id' => $rule->id,
                        'type' => $rule->type,
                        'trigger' => $rule->trigger,
                        'action' => $rule->action,
                        'priority' => $rule->priority,
                        'is_active' => $rule->is_active,
                        'execution_count' => $rule->execution_count,
                        'last_executed' => $rule->last_executed,
                        'created_at' => $rule->created_at
                    ];
                })
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve automation rules: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle automation rule status
     */
    public function toggleAutomationRule(Request $request, $ruleId)
    {
        try {
            $rule = AutomationRule::find($ruleId);
            if (!$rule) {
                return response()->json([
                    'success' => false,
                    'message' => 'Automation rule not found'
                ], 404);
            }

            $rule->update(['is_active' => !$rule->is_active]);

            return response()->json([
                'success' => true,
                'message' => 'Automation rule ' . ($rule->is_active ? 'activated' : 'deactivated'),
                'is_active' => $rule->is_active
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle automation rule: ' . $e->getMessage()
            ], 500);
        }
    }
}
