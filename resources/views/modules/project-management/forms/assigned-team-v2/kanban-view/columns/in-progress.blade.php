<div class="kanban-column bg-blue-50 rounded-lg border-2 border-blue-200 min-w-[300px] flex-shrink-0" 
     data-column="in-progress" 
     ondragover="allowDrop(event)" 
     ondrop="dropTask(event)">
    <div class="p-4 border-b border-blue-300 bg-white rounded-t-lg">
        <div class="flex items-center justify-between">
            <h4 class="font-semibold text-blue-800 flex items-center gap-2">
                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                In Progress
            </h4>
            <div class="flex items-center gap-2">
                <span class="wip-counter px-2 py-1 text-xs bg-blue-200 text-blue-700 rounded-full">2</span>
                <span class="wip-limit hidden px-2 py-1 text-xs bg-orange-200 text-orange-700 rounded-full">/3</span>
            </div>
        </div>
    </div>
    <div class="kanban-cards p-3 space-y-3 min-h-[500px]">
        @php
            $inProgressTasks = isset($project) && $project->tasks ? 
                $project->tasks->where('status', 'in_progress') : collect();
        @endphp
        
        @if($inProgressTasks->count() > 0)
            @foreach($inProgressTasks as $task)
                @php
                    $priorityValue = match($task->priority) {
                        'critical' => 5,
                        'high' => 4,
                        'medium' => 3,
                        'low' => 2,
                        default => 1
                    };
                    
                    $assignees = [];
                    $colors = ['3b82f6', 'e11d48', '8b5cf6', 'ec4899', '059669', 'f59e0b'];
                    
                    if ($task->assignedUsers && $task->assignedUsers->count() > 0) {
                        foreach ($task->assignedUsers as $index => $user) {
                            $assignees[] = [
                                'name' => $user->name,
                                'color' => $colors[$user->id % count($colors)]
                            ];
                        }
                    } elseif ($task->assignedUser) {
                        $assignees[] = [
                            'name' => $task->assignedUser->name,
                            'color' => $colors[$task->assignedUser->id % count($colors)]
                        ];
                    }
                    $progress = 50;
                    if ($task->due_date && $task->created_at) {
                        $totalDays = $task->created_at->diffInDays($task->due_date);
                        $daysPassed = $task->created_at->diffInDays(now());
                        if ($totalDays > 0) {
                            $progress = min(90, max(10, ($daysPassed / $totalDays) * 100));
                        }
                    }

                    $statusText = $progress > 70 ? 'Almost done' : ($progress > 30 ? 'Working on it' : 'Just started');
                    $statusColor = $progress > 70 ? 'green' : ($progress > 30 ? 'orange' : 'blue');
                @endphp
                
                @include('modules.project-management.forms.assigned-team-v2.kanban-view.cards.task-card', [
                    'taskId' => 'task-' . $task->id,
                    'title' => $task->title,
                    'description' => $task->description ?? 'No description provided',
                    'priority' => $priorityValue,
                    'assignees' => $assignees,
                    'progress' => (int)$progress,
                    'status' => ['text' => $statusText, 'color' => $statusColor]
                ])
            @endforeach
        @else
            <div class="flex items-center justify-center h-32 text-gray-400 border-2 border-dashed border-gray-300 rounded-lg">
                <div class="text-center">
                    <i class="bi bi-play-circle text-2xl mb-2"></i>
                    <p class="text-sm">No tasks in progress</p>
                    @if(isset($project) && $project->id)
                        <button onclick="openAddNewTaskModal('in_progress')" class="mt-2 text-xs text-blue-600 hover:text-blue-800">
                            Start working on a task
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>