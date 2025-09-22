{{-- Next Week Section--}}
<div class="px-6 pb-6">
    <h3 class="text-lg font-medium text-green-600 mb-4 flex items-center gap-2">
        <div class="w-1 h-6 bg-green-500 rounded"></div>
        Next week
        <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">{{ count($nextWeekTasksArray ?? []) }} tasks</span>
        <button onclick="addNewEmptyTask('next-week')" class="ml-2 text-sm text-green-600 hover:text-green-800 flex items-center gap-1">
            <i class="bi bi-plus"></i>
            Add New Task
        </button>
        <button onclick="addAutomationRule('next-week')" class="ml-auto text-sm text-green-600 hover:text-green-800 flex items-center gap-1">
            <i class="bi bi-robot"></i>
            Add Automation
        </button>
    </h3>

    <div class="overflow-x-auto">
        <div class="space-y-1 min-w-max">
        @php
            $projectTasks = isset($project) && $project->tasks ? $project->tasks : collect();
            $projectTeamMembers = isset($project) && $project->teamMembers ? $project->teamMembers : collect();
            
            $nextWeekTasks = $projectTasks->filter(function($task) {
                return in_array($task->status, ['todo', 'in_progress']) && $task->due_date && 
                       $task->due_date->isAfter(now()->endOfWeek()) && 
                       $task->due_date->isBefore(now()->addWeek()->endOfWeek());
            });
            
            // If no tasks found for next week specifically, show upcoming tasks
            if ($nextWeekTasks->isEmpty() && $projectTasks->isNotEmpty()) {
                $upcomingTasks = $projectTasks->whereIn('status', ['todo', 'in_progress'])->take(2);
                $nextWeekTasks = $upcomingTasks;
            }
            
            $colors = ['3b82f6', 'e11d48', '8b5cf6', 'ec4899', '059669', 'f59e0b', '10b981', 'f97316', '6366f1', 'ef4444'];
            
            $nextWeekTasksArray = $nextWeekTasks->map(function($task, $index) use ($colors, $projectTeamMembers) {
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
                    // Fallback to single assigned user
                    $assignees[] = [
                        'name' => $task->assignedUser->name,
                        'color' => $colors[$index % count($colors)],
                        'role' => $projectTeamMembers->find($task->assignedUser->id)?->pivot?->role ?? 'Member',
                        'has_notification' => false
                    ];
                }
                
                $priorityValue = match($task->priority) {
                    'critical' => 5,
                    'high' => 4,
                    'medium' => 3,
                    'low' => 2,
                    default => 1
                };
                
                $startDate = $task->created_at ? $task->created_at->format('M j') : now()->addWeek()->format('M j');
                $endDate = $task->due_date ? $task->due_date->format('M j') : now()->addWeek()->addDays(4)->format('M j');
                
                return [
                    'id' => 'task-' . $task->id,
                    'name' => $task->title,
                    'description' => $task->description ?? 'No description provided',
                    'assignees' => $assignees,
                    'priority' => $priorityValue,
                    'timeline' => ['dates' => $startDate . ' - ' . $endDate, 'color' => 'gray'],
                    'progress' => 0,
                    'due_date' => $task->due_date ? $task->due_date->format('M j') : 'TBD',
                    'is_overdue' => false,
                    'status' => ['text' => ucfirst(str_replace('_', ' ', $task->status)), 'color' => match($task->status) {
                        'todo' => 'gray',
                        'in_progress' => 'orange', 
                        'review' => 'yellow',
                        'completed' => 'green',
                        default => 'gray'
                    }],
                    'dependencies' => [] // Could be enhanced with actual dependency data
                ];
            })->toArray();
        @endphp
        
        @if(count($nextWeekTasksArray) > 0)
            @foreach($nextWeekTasksArray as $task)
                @include('modules.project-management.forms.assigned-team-v2.task-row', ['task' => $task])
            @endforeach
        @else
            <div class="text-center py-8">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                    <i class="bi bi-calendar-plus text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Tasks Scheduled for Next Week</h3>
                <p class="text-gray-500 mb-4">Plan ahead by scheduling tasks for next week.</p>
                @if(isset($project) && $project->id)
                    <button onclick="openAddNewTaskModal('todo')" class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all text-sm">
                        <i class="bi bi-plus mr-2"></i>
                        Schedule Task for Next Week
                    </button>
                @endif
            </div>
        @endif
        </div>
    </div>

    <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
        <div class="flex items-start gap-3">
            <i class="bi bi-lightbulb text-green-600 mt-1"></i>
            <div>
                <h4 class="font-medium text-green-800">AI Automation Suggestions</h4>
                @php
                    $designTasks = $projectTasks->filter(function($task) {
                        return stripos($task->title, 'design') !== false || stripos($task->description, 'design') !== false;
                    });
                    
                    $completedTasks = $projectTasks->where('status', 'completed');
                    $pendingTasks = $projectTasks->whereIn('status', ['todo', 'in_progress']);
                    
                    $availableMembers = $projectTeamMembers->take(3);
                    $suggestedMember = $availableMembers->first();
                    
                    if ($completedTasks->isNotEmpty() && $pendingTasks->isNotEmpty() && $suggestedMember) {
                        $completedTask = $completedTasks->first();
                        $pendingTask = $pendingTasks->first();
                        $memberName = $suggestedMember->name;
                        
                        $suggestionText = "AI detected workflow opportunity: When \"{$completedTask->title}\" is completed, automatically assign \"{$pendingTask->title}\" to {$memberName} to maintain project momentum.";
                    } else {
                        $suggestionText = "AI is analyzing your project workflow patterns. Complete more tasks to generate intelligent automation suggestions.";
                    }
                @endphp
                <p class="text-sm text-green-700 mt-1">{{ $suggestionText }}</p>
                <button onclick="showMainViewAutomation()" class="mt-2 px-3 py-1 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Create Automation
                </button>
            </div>
        </div>
    </div>
    
    <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <div class="flex items-center justify-between mb-3">
            <h4 class="font-medium text-blue-800">Team Workload for Next Week</h4>
            <button onclick="optimizeWorkload()" class="text-sm text-blue-600 hover:text-blue-800">
                <i class="bi bi-gear"></i> Optimize
            </button>
        </div>
        <div class="grid grid-cols-5 gap-3">
            @php
                $projectTeamMembers = isset($project) && $project->teamMembers ? $project->teamMembers : collect();
                $colors = ['green', 'orange', 'blue', 'red', 'yellow'];
                
                $facesPath = public_path('assets/images/faces');
                $availableFaces = [];
                
                if (is_dir($facesPath)) {
                    $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    $availableFaces = array_map(function($file) {
                        return '/assets/images/faces/' . basename($file);
                    }, $files);
                }
                
                if (empty($availableFaces)) {
                    for ($i = 1; $i <= 16; $i++) {
                        $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
                    }
                }
                
                $teamWorkload = $projectTeamMembers->take(5)->map(function($member, $index) use ($colors, $availableFaces) {
                    $capacity = rand(40, 95);
                    $color = $capacity > 80 ? 'orange' : ($capacity > 60 ? 'blue' : 'green');
                    
                    $avatarUrl = '';
                    if ($member->profile_photo_path) {
                        $profilePath = public_path('storage/' . $member->profile_photo_path);
                        if (file_exists($profilePath) && is_readable($profilePath)) {
                            $avatarUrl = '/storage/' . $member->profile_photo_path;
                        }
                    }
                    
                    if (!$avatarUrl) {
                        $faceIndex = abs(crc32($member->name)) % count($availableFaces);
                        $avatarUrl = $availableFaces[$faceIndex];
                    }
                    
                    return [
                        'name' => $member->name,
                        'capacity' => $capacity,
                        'color' => $color,
                        'avatar' => $avatarUrl
                    ];
                })->toArray();
                
                if (empty($teamWorkload)) {
                    $teamWorkload = [
                        ['name' => 'No Team', 'capacity' => 0, 'color' => 'gray']
                    ];
                }
            @endphp
            @if($projectTeamMembers->count() > 0)
                @foreach($teamWorkload as $member)
                    <div class="text-center">
                        <img src="{{ $member['avatar'] ?? '/assets/images/faces/1.jpg' }}" 
                             class="w-10 h-10 rounded-full mx-auto mb-2 object-cover" 
                             alt="{{ $member['name'] }}">
                        <div class="text-xs font-medium text-gray-700">{{ explode(' ', $member['name'])[0] }}</div>
                        <div class="text-xs text-{{ $member['color'] }}-600 font-semibold">{{ $member['capacity'] }}%</div>
                        <div class="w-full bg-gray-200 rounded-full h-1 mt-1">
                            <div class="bg-{{ $member['color'] }}-500 h-1 rounded-full" style="width: {{ $member['capacity'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-5 text-center text-gray-500 py-4">
                    <i class="bi bi-people text-2xl mb-2"></i>
                    <p class="text-sm">No team members assigned</p>
                </div>
            @endif
        </div>
    </div>
</div>