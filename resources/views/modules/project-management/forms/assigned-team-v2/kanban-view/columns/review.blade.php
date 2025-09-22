<div class="kanban-column bg-yellow-50 rounded-lg border-2 border-yellow-200 min-w-[300px] flex-shrink-0" 
     data-column="review" 
     ondragover="allowDrop(event)" 
     ondrop="dropTask(event)">
    <div class="p-4 border-b border-yellow-300 bg-white rounded-t-lg">
        <div class="flex items-center justify-between">
            <h4 class="font-semibold text-yellow-800 flex items-center gap-2">
                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                Review
            </h4>
            <div class="flex items-center gap-2">
                <span class="wip-counter px-2 py-1 text-xs bg-yellow-200 text-yellow-700 rounded-full">0</span>
                <span class="wip-limit hidden px-2 py-1 text-xs bg-orange-200 text-orange-700 rounded-full">/2</span>
            </div>
        </div>
    </div>
    <div class="kanban-cards p-3 space-y-3 min-h-[500px]">
        @php
            $reviewTasks = isset($project) && $project->tasks ? 
                $project->tasks->where('status', 'review') : collect();
        @endphp
        
        @if($reviewTasks->count() > 0)
            @foreach($reviewTasks as $task)
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
                    
                    $progress = 95;
                    
                    $statusText = 'Pending review';
                    $statusColor = 'yellow';
                @endphp
                
                @include('modules.project-management.forms.assigned-team-v2.kanban-view.cards.task-card', [
                    'taskId' => 'task-' . $task->id,
                    'title' => $task->title,
                    'description' => $task->description ?? 'No description provided',
                    'priority' => $priorityValue,
                    'assignees' => $assignees,
                    'progress' => $progress,
                    'status' => ['text' => $statusText, 'color' => $statusColor]
                ])
            @endforeach
        @else
            <div class="flex items-center justify-center h-32 text-gray-400 border-2 border-dashed border-gray-300 rounded-lg">
                <div class="text-center">
                    <i class="bi bi-eye text-2xl mb-2"></i>
                    <p class="text-sm">No tasks in review</p>
                    @if(isset($project) && $project->id)
                        <p class="mt-1 text-xs text-gray-500">Tasks ready for review will appear here</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>