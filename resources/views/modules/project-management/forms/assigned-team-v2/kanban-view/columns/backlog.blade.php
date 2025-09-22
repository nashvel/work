<div class="kanban-column bg-gray-50 rounded-lg border-2 border-gray-200 min-w-[300px] flex-shrink-0" 
     data-column="backlog" 
     ondragover="allowDrop(event)" 
     ondrop="dropTask(event)">
    <div class="p-4 border-b border-gray-300 bg-white rounded-t-lg">
        <div class="flex items-center justify-between">
            <h4 class="font-semibold text-gray-800 flex items-center gap-2">
                <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                Backlog
            </h4>
            <div class="flex items-center gap-2">
                <span class="wip-counter px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded-full">3</span>
                <span class="wip-limit hidden px-2 py-1 text-xs bg-orange-200 text-orange-700 rounded-full">/5</span>
            </div>
        </div>
    </div>
    <div class="kanban-cards p-3 space-y-3 min-h-[500px]">
        @php
            $backlogTasks = isset($project) && $project->tasks ? 
                $project->tasks->where('status', 'todo') : collect();
        @endphp
        
        @if($backlogTasks->count() > 0)
            @foreach($backlogTasks as $task)
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

                    \Log::info("Task {$task->id} Debug:", [
                        'assignedUsers_count' => $task->assignedUsers ? $task->assignedUsers->count() : 'null',
                        'assignedUsers_data' => $task->assignedUsers ? $task->assignedUsers->pluck('name', 'id')->toArray() : 'null',
                        'assignedUser' => $task->assignedUser ? $task->assignedUser->name : 'null'
                    ]);

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
                    
                    // Debug: Log final assignees array
                    \Log::info("Task {$task->id} Final assignees:", $assignees);
                    
                    $statusText = count($assignees) > 0 ? 'Ready to start' : 'Unassigned';
                    $statusColor = count($assignees) > 0 ? 'blue' : 'gray';
                @endphp
                
                @include('modules.project-management.forms.assigned-team-v2.kanban-view.cards.task-card', [
                    'taskId' => 'task-' . $task->id,
                    'title' => $task->title,
                    'description' => $task->description ?? 'No description provided',
                    'priority' => $priorityValue,
                    'assignees' => $assignees,
                    'progress' => null,
                    'status' => ['text' => $statusText, 'color' => $statusColor]
                ])
            @endforeach
        @else
            <div class="flex items-center justify-center h-32 text-gray-400 border-2 border-dashed border-gray-300 rounded-lg">
                <div class="text-center">
                    <i class="bi bi-card-list text-2xl mb-2"></i>
                    <p class="text-sm">No backlog tasks yet</p>
                    @if(isset($project) && $project->id)
                        <button onclick="openAddNewTaskModal('todo')" class="mt-2 text-xs text-blue-600 hover:text-blue-800">
                            Add your first task
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>