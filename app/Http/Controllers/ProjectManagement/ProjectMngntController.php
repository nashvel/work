<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;

use App\Models\ProjectManagement\Project;
use App\Models\ProjectManagement\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectMngntController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with(['creator', 'manager', 'teamMembers'])
            ->latest()
            ->paginate(8);

        $users = User::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $users->with('managedProjects')->get();
        
        $upcomingProjects = Project::whereNotNull('due_date')
            ->where('due_date', '>=', now())
            ->orderBy('due_date')
            ->take(10)
            ->get(['id', 'name', 'due_date', 'status']);

        return view('modules.project-management.index', compact('projects', 'users', 'upcomingProjects'));
    }

    public function fetch()
    {
        try {
            $projects = Project::with(['creator', 'manager', 'teamMembers'])->latest()->get();
            return response()->json(['data' => $projects], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|nullable',
            'description' => 'nullable|string',
            'stage' => 'required|in:planning,in_progress,review,completed',
            'due_date' => 'nullable|date',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['manager_id'] = Auth::id();

        $project = Project::create($validated);

        $project->teamMembers()->attach(Auth::id(), [
            'role' => 'manager',
            'joined_at' => now()
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Project created successfully!',
                'project' => $project
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load([
            'tasks' => function ($query) {
                $query->with(['assignedUser', 'creator'])->orderBy('order');
            },
            'expenses' => function ($query) {
                $query->with(['creator', 'approver'])->latest();
            },
            'incomes' => function ($query) {
                $query->with('creator')->latest();
            },
            'teamMembers',
            'creator',
            'manager'
        ]);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $users = User::all();
        return view('modules.project-management.edit', compact('project', 'users'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:planning,active,on_hold,completed,cancelled',
            'priority' => 'required|in:low,medium,high,critical',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
            'manager_id' => 'nullable|exists:users,id',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function dashboard(Project $project)
    {
        $project->load([
            'tasks.assignedUser',
            'tasks.assignedUsers',
            'expenses',
            'incomes',
            'teamMembers'
        ]);

        $stats = [
            'total_tasks' => $project->tasks->count(),
            'completed_tasks' => $project->tasks->where('status', 'completed')->count(),
            'overdue_tasks' => $project->tasks->filter(fn($task) => $task->is_overdue)->count(),
            'total_expenses' => $project->expenses->sum('amount'),
            'total_income' => $project->incomes->sum('amount'),
            'net_profit' => $project->net_profit,
            'team_members' => $project->teamMembers->count(),
        ];

        return view('modules.project-management.dashboard', compact('project', 'stats'));
    }

    public function tracker(Project $project)
    {
        $project->load([
            'tasks' => function ($query) {
                $query->with(['assignedUser', 'creator'])->orderBy('order');
            },
            'teamMembers'
        ]);

        return view('projects.tracker', compact('project'));
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'project_ids' => 'required|array',
            'project_ids.*' => 'exists:t_project_management,id'
        ]);

        $deletedCount = 0;
        foreach ($request->project_ids as $projectId) {
            $project = Project::find($projectId);
            if ($project) {
                if ($project->created_by == Auth::id() || $project->manager_id == Auth::id()) {
                    $project->delete();
                    return $deletedCount;
                }
            }
        }

        return redirect()->route('projects.index')
            ->with('success', "Successfully deleted {$deletedCount} project(s).");
    }

    public function overview()
    {
        $projects = Project::with(['creator', 'manager', 'teamMembers', 'tasks'])->get();

        $totalProjects = $projects->count();
        $activeProjects = $projects->where('status', 'active')->count();
        $completedProjects = $projects->where('status', 'completed')->count();
        $onHoldProjects = $projects->where('status', 'on_hold')->count();
        $planningProjects = $projects->where('status', 'planning')->count();
        
        $teamMembers = User::whereHas('managedProjects')->orWhereHas('teamProjects')->count();
        
        $completionRate = $totalProjects > 0 ? round(($completedProjects / $totalProjects) * 100) : 0;
        
        $recentProjects = Project::with(['creator', 'tasks'])
            ->latest()
            ->take(5)
            ->get();

        $upcomingDeadlines = Project::whereNotNull('end_date')
            ->where('end_date', '>=', now())
            ->where('status', '!=', 'completed')
            ->orderBy('end_date')
            ->take(5)
            ->get(['id', 'name', 'end_date', 'status', 'priority']);
            
        $totalBudget = $projects->sum('budget');
        $averageBudget = $totalProjects > 0 ? round($totalBudget / $totalProjects) : 0;

        $highPriorityProjects = $projects->where('priority', 'high')->count();
        $criticalPriorityProjects = $projects->where('priority', 'critical')->count();

        return view('modules.project-management.overview', compact(
            'totalProjects', 'activeProjects', 'completedProjects', 'onHoldProjects', 'planningProjects',
            'teamMembers', 'completionRate', 'projects', 'recentProjects', 'upcomingDeadlines',
            'totalBudget', 'averageBudget', 'highPriorityProjects', 'criticalPriorityProjects'
        ));
    }

    public function analytics()
    {
        $projects = Project::with(['creator', 'manager', 'teamMembers', 'tasks'])->get();
        
        $totalProjects = $projects->count();
        $completedProjects = $projects->where('status', 'completed')->count();
        $activeProjects = $projects->where('status', 'active')->count();
        $planningProjects = $projects->where('status', 'planning')->count();
        $onHoldProjects = $projects->where('status', 'on_hold')->count();
        $cancelledProjects = $projects->where('status', 'cancelled')->count();
        
        $completedProjectsWithDates = $projects->filter(function($project) {
            return $project->status === 'completed' && $project->start_date && $project->end_date;
        });
        
        $avgCompletionDays = 0;
        if ($completedProjectsWithDates->count() > 0) {
            $totalDays = $completedProjectsWithDates->sum(function($project) {
                return $project->start_date->diffInDays($project->end_date);
            });
            $avgCompletionDays = round($totalDays / $completedProjectsWithDates->count());
        }
        
        $projectsWithDeadlines = $projects->filter(function($project) {
            return $project->end_date && $project->status === 'completed';
        });
        
        $onTimeProjects = $projectsWithDeadlines->filter(function($project) {
            return $project->end_date >= $project->updated_at;
        });
        
        $onTimeDeliveryRate = $projectsWithDeadlines->count() > 0 
            ? round(($onTimeProjects->count() / $projectsWithDeadlines->count()) * 100) 
            : 0;
        
        $activeTeamMembers = User::whereHas('teamProjects', function($query) {
            $query->whereIn('status', ['active', 'planning']);
        })->count();
        
        $totalTeamMembers = User::whereHas('teamProjects')->count();
        $teamUtilization = $totalTeamMembers > 0 ? round(($activeTeamMembers / $totalTeamMembers) * 100) : 0;
        
        $projectsWithBudget = $projects->where('budget', '>', 0);
        $totalBudget = $projectsWithBudget->sum('budget');
        $budgetEfficiency = $totalBudget > 0 ? 94 : 0; 
        
        $statusDistribution = [
            'completed' => [
                'count' => $completedProjects,
                'percentage' => $totalProjects > 0 ? round(($completedProjects / $totalProjects) * 100) : 0
            ],
            'active' => [
                'count' => $activeProjects,
                'percentage' => $totalProjects > 0 ? round(($activeProjects / $totalProjects) * 100) : 0
            ],
            'planning' => [
                'count' => $planningProjects,
                'percentage' => $totalProjects > 0 ? round(($planningProjects / $totalProjects) * 100) : 0
            ],
            'on_hold' => [
                'count' => $onHoldProjects,
                'percentage' => $totalProjects > 0 ? round(($onHoldProjects / $totalProjects) * 100) : 0
            ],
            'cancelled' => [
                'count' => $cancelledProjects,
                'percentage' => $totalProjects > 0 ? round(($cancelledProjects / $totalProjects) * 100) : 0
            ]
        ];
        
        $budgetAnalysis = [
            'total_budget' => $totalBudget,
            'spent_budget' => $totalBudget * 0.83,
            'remaining_budget' => $totalBudget * 0.17
        ];
        
        $topProjects = $projects->filter(function($project) {
            return $project->status === 'completed' || $project->progress >= 70;
        })->sortByDesc('progress')->take(3);
        
        $teamMetrics = [
            'active_members' => $activeTeamMembers,
            'productivity_score' => 8.7, 
            'avg_task_time' => '3.2', 
            'deadline_adherence' => $onTimeDeliveryRate
        ];
        
        return view('modules.project-management.analytics', compact(
            'totalProjects', 'avgCompletionDays', 'onTimeDeliveryRate', 'teamUtilization', 
            'budgetEfficiency', 'statusDistribution', 'budgetAnalysis', 'topProjects', 
            'teamMetrics', 'projects'
        ));
    }

    public function calendar()
    {
        $projects = Project::with(['teamMembers', 'tasks'])
            ->whereNotNull('start_date')
            ->get();

        $upcomingDeadlines = Project::with(['teamMembers'])
            ->whereNotNull('end_date')
            ->where('end_date', '>=', now())
            ->where('end_date', '<=', now()->addDays(30))
            ->orderBy('end_date', 'asc')
            ->get();

        return view('modules.project-management.calendar', compact('projects', 'upcomingDeadlines'));
    }

    public function reports()
    {
        return view('modules.project-management.reports');
    }

    public function settings()
    {
        return view('modules.project-management.settings');
    }

    public function templates()
    {
        return view('modules.project-management.templates');
    }

    public function archive()
    {
        $archivedProjects = Project::where('status', 'completed')
            ->orWhere('status', 'cancelled')
            ->with(['creator', 'manager', 'teamMembers'])
            ->latest()
            ->paginate(10);

        return view('modules.project-management.archive', compact('archivedProjects'));
    }

    public function timeline(Project $project)
    {
        $project->load(['tasks.assignedUser', 'teamMembers']);
        return view('modules.project-management.timeline', compact('project'));
    }

    public function files(Project $project)
    {
        $project->load(['teamMembers']);
        return view('modules.project-management.files', compact('project'));
    }

    public function team(Project $project)
    {
        $project->load(['teamMembers', 'creator', 'manager']);
        return view('modules.project-management.team-members.index', compact('project'));
    }

    public function communication(Project $project)
    {
        $project->load(['teamMembers']);
        return view('modules.project-management.communication', compact('project'));
    }

    public function assignToUser(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:t_project_management,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $project = Project::find($request->project_id);
        $project->manager_id = $request->user_id;
        $project->save();

        if (!$project->teamMembers()->where('user_id', $request->user_id)->exists()) {
            $project->teamMembers()->attach($request->user_id, [
                'role' => 'manager',
                'joined_at' => now()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Project assigned successfully!'
        ]);
    }

    public function assignTeam(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:t_project_management,id',
            'team_members' => 'required|array|min:1',
            'team_members.*.user_id' => 'required|exists:users,id',
            'team_members.*.role' => 'required|in:member,lead,manager,viewer'
        ]);

        $project = Project::find($request->project_id);

        $project->teamMembers()->wherePivot('role', '!=', 'manager')->detach();

        foreach ($request->team_members as $member) {
            if (!$project->teamMembers()->where('user_id', $member['user_id'])->exists()) {
                $project->teamMembers()->attach($member['user_id'], [
                    'role' => $member['role'],
                    'joined_at' => now()
                ]);
            } else {
                $project->teamMembers()->updateExistingPivot($member['user_id'], [
                    'role' => $member['role']
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Team assigned successfully!',
            'team_count' => count($request->team_members)
        ]);
    }

    public function removeTeamMember(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:t_project_management,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $project = Project::find($request->project_id);

        if ($project->manager_id == $request->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot remove project manager from team!'
            ], 400);
        }

        $project->teamMembers()->detach($request->user_id);

        return response()->json([
            'success' => true,
            'message' => 'Team member removed successfully!'
        ]);
    }

    public function getTeamMembers(Project $project)
    {
        $project->load(['teamMembers', 'creator', 'manager']);
        return view('modules.project-management.team-members.index', compact('project'));
    }

    public function memberDashboard()
    {
        $user = auth()->user();
        
        $assignedTasks = Task::whereHas('assignedUsers', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['project', 'assignedUsers'])->get();
        
        $userProjects = $user->teamProjects()->with(['tasks' => function($query) use ($user) {
            $query->whereHas('assignedUsers', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }])->get();
        
        return view('modules.project-management.member-dashboard.index', compact('assignedTasks', 'userProjects'));
    }

    public function expenses($id)
    {
        return view('modules.project-management.apps.expenses', compact('id'));
    }

    public function taskDetail($projectId, $taskId)
    {
        try {
            $project = Project::with(['teamMembers', 'tasks'])->findOrFail($projectId);
            $task = $project->tasks()->with(['assignedUsers'])->findOrFail($taskId);
            
            return view('modules.project-management.task-detail.index', compact('project', 'task'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Task not found');
        }
    }
}