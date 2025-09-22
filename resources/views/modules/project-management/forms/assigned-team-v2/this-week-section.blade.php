{{-- This Week Section--}}
<div class="p-6">
    @php
        $projectTeamMembers = isset($project) && $project->teamMembers ? $project->teamMembers : collect();
        $projectTasks = isset($project) && $project->tasks ? $project->tasks : collect();
        
        $colors = ['3b82f6', 'e11d48', '8b5cf6', 'ec4899', '059669', 'f59e0b', '10b981', 'f97316', '6366f1', 'ef4444'];
        
        $thisWeekTasks = [];
        
        if ($projectTasks->count() > 0) {
            
            $currentWeekTasks = $projectTasks->filter(function($task) {
                return in_array($task->status, ['in_progress', 'review']) || 
                       ($task->due_date && $task->due_date->isCurrentWeek());
            });
            
            if ($currentWeekTasks->isEmpty()) {
                $currentWeekTasks = $projectTasks->whereIn('status', ['todo', 'in_progress'])->take(3);
            }
            
            foreach ($currentWeekTasks as $index => $task) {
                $assignees = [];
                
                // Load all assigned users for this task
                if ($task->assignedUsers && $task->assignedUsers->count() > 0) {
                    foreach ($task->assignedUsers as $user) {
                        $assignees[] = [
                            'name' => $user->name,
                            'color' => $colors[$index % count($colors)],
                            'role' => $projectTeamMembers->find($user->id)?->pivot?->role ?? 'Member',
                            'has_notification' => false
                        ];
                    }
                } elseif ($task->assignedUser) {
                    $assignees[] = [
                        'name' => $task->assignedUser->name,
                        'color' => $colors[$index % count($colors)],
                        'role' => $projectTeamMembers->find($task->assignedUser->id)?->pivot?->role ?? 'Member',
                        'has_notification' => false
                    ];
                }
                
                $progress = 0;
                if ($task->status === 'completed') {
                    $progress = 100;
                } elseif ($task->status === 'review') {
                    $progress = 90;
                } elseif ($task->status === 'in_progress') {
                    $progress = rand(30, 80);
                }
                
                $statusText = match($task->status) {
                    'completed' => 'Done',
                    'in_progress' => 'Working on it',
                    'review' => 'In Review',
                    'cancelled' => 'Cancelled',
                    default => 'Not started'
                };
                
                $statusColor = match($task->status) {
                    'completed' => 'green',
                    'in_progress' => 'orange',
                    'review' => 'yellow',
                    'cancelled' => 'red',
                    default => 'gray'
                };
                
                $priorityValue = match($task->priority) {
                    'critical' => 5,
                    'high' => 4,
                    'medium' => 3,
                    'low' => 2,
                    default => 1
                };
                
                $startDate = $task->created_at ? $task->created_at->format('M j') : now()->format('M j');
                $endDate = $task->due_date ? $task->due_date->format('M j') : now()->addDays(5)->format('M j');
                
                $thisWeekTasks[] = [
                    'id' => 'task-' . $task->id,
                    'name' => $task->title,
                    'description' => $task->description ?? 'No description provided',
                    'assignees' => $assignees,
                    'priority' => $priorityValue,
                    'timeline' => ['dates' => $startDate . ' - ' . $endDate, 'color' => ['blue', 'green', 'red'][$index % 3]],
                    'progress' => $progress,
                    'due_date' => $task->due_date ? $task->due_date->format('M j') : 'No due date',
                    'is_overdue' => $task->due_date && $task->due_date->isPast() && $task->status !== 'completed',
                    'status' => ['text' => $statusText, 'color' => $statusColor],
                    'dependencies' => [] // Could be enhanced with actual dependency data
                ];
            }
        }
    @endphp
    
    <h3 class="text-lg font-medium text-blue-600 mb-4 flex items-center gap-2">
        <div class="w-1 h-6 bg-blue-500 rounded"></div>
        This week
        <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">{{ count($thisWeekTasks) }} tasks</span>
        <button onclick="addAutomationRule('this-week')" class="ml-auto text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
            <i class="bi bi-robot"></i>
            Add Automation
        </button>
    </h3>
    
    <div class="overflow-x-auto">
        @include('modules.project-management.forms.assigned-team-v2.table-header')

        <div class="space-y-1 min-w-max">
        @if(count($thisWeekTasks) > 0)
            @foreach($thisWeekTasks as $task)
                @include('modules.project-management.forms.assigned-team-v2.task-row', ['task' => $task])
            @endforeach
        @else
            <div class="text-center py-12">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                    <i class="bi bi-calendar-week text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Tasks This Week</h3>
                <p class="text-gray-500 mb-4">No tasks are scheduled for this week. Create tasks to get started.</p>
                @if(isset($project) && $project->id)
                    <button onclick="openTeamModal({{ $project->id }})" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                        <i class="bi bi-person-plus mr-2"></i>
                        Add Team Members
                    </button>
                @endif
            </div>
        @endif
        </div>
    </div>

    <div class="mt-4 flex items-center justify-between border-t pt-4">
        <div class="flex items-center gap-3">
            <button onclick="addNewEmptyTask()" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Add Task
            </button>
            <button onclick="bulkAssign()" class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all">
                <i class="bi bi-people"></i> Bulk Assign
            </button>
            <button onclick="bulkStatusUpdate()" class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all">
                <i class="bi bi-check-circle"></i> Update Status
            </button>
            <button onclick="createTemplate()" class="px-3 py-1 text-sm bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-all">
                <i class="bi bi-collection"></i> Save as Template
            </button>
            <button id="deleteSelectedBtn" onclick="showDeleteModal()" class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all hidden">
                <i class="bi bi-trash"></i> Delete Selected
            </button>
        </div>
        <div class="text-sm text-gray-600">
            @php
                $totalTasks = count($thisWeekTasks);
                $totalAssignees = $projectTeamMembers->count();
                $avgProgress = $totalTasks > 0 ? round(collect($thisWeekTasks)->avg('progress')) : 0;
            @endphp
            <span class="font-medium">{{ $totalTasks }}</span> tasks • <span class="font-medium">{{ $totalAssignees }}</span> assignees • <span class="font-medium">{{ $avgProgress }}%</span> complete
        </div>
    </div>
</div>