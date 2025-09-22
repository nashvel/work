<div class="task-sidebar w-80 bg-white border-r border-gray-200 flex-shrink-0 overflow-y-auto">
    @php
        // Use real project team members instead of hardcoded data
        $projectTeamMembers = isset($project) && $project->teamMembers ? $project->teamMembers : collect();
        
        // Color palette for dynamic assignment
        $colors = ['blue-500', 'red-500', 'purple-500', 'pink-500', 'green-500', 'yellow-500', 'emerald-500', 'orange-500', 'indigo-500', 'red-600'];
    @endphp
    
    @if($projectTeamMembers->count() > 0)
        @foreach($projectTeamMembers as $index => $member)
            @php
                $memberColor = $colors[$index % count($colors)];
                
                $memberTasks = isset($project) && $project->tasks ? 
                    $project->tasks->where('assigned_to', $member->id) : collect();
                
                $taskCount = $memberTasks->count();

                $totalEstimatedHours = $memberTasks->sum('estimated_hours') ?: 0;
                $weeklyCapacity = 40; // Standard 40-hour work week
                $capacity = $totalEstimatedHours > 0 ? min(150, ($totalEstimatedHours / $weeklyCapacity) * 100) : rand(60, 90);
            @endphp
            
            <div class="task-group">
                <div class="group-header bg-blue-50 px-4 py-3 border-b border-blue-200 cursor-pointer hover:bg-blue-100 transition-all" onclick="toggleGroup('member-{{ $member->id }}-group')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-chevron-down text-blue-600 group-toggle"></i>
                            @php
                                $initials = collect(explode(' ', $member->name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->join('');
                            @endphp
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-medium" style="background-color: {{ $memberColor === 'blue-500' ? '#3b82f6' : ($memberColor === 'red-500' ? '#ef4444' : ($memberColor === 'purple-500' ? '#a855f7' : ($memberColor === 'pink-500' ? '#ec4899' : ($memberColor === 'green-500' ? '#22c55e' : ($memberColor === 'yellow-500' ? '#eab308' : ($memberColor === 'emerald-500' ? '#10b981' : ($memberColor === 'orange-500' ? '#f97316' : ($memberColor === 'indigo-500' ? '#6366f1' : '#dc2626')))))))) }}">
                                {{ $initials }}
                            </div>
                            <div>
                                <div class="font-medium text-blue-800">{{ $member->name }}</div>
                                <div class="text-xs text-blue-600">{{ ucfirst($member->pivot->role ?? 'Member') }} • {{ $taskCount }} tasks</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            @if($capacity >= 100)
                                <span class="px-2 py-1 text-xs bg-red-200 text-red-800 rounded-full">{{ round($capacity) }}% capacity</span>
                            @elseif($capacity >= 85)
                                <span class="px-2 py-1 text-xs bg-orange-200 text-orange-800 rounded-full">{{ round($capacity) }}% capacity</span>
                            @else
                                <span class="px-2 py-1 text-xs bg-green-200 text-green-800 rounded-full">{{ round($capacity) }}% capacity</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="member-{{ $member->id }}-group" class="group-tasks">
                    @if($memberTasks->count() > 0)
                        @foreach($memberTasks as $task)
                            @php
                                $priorityValue = match($task->priority) {
                                    'critical' => 5,
                                    'high' => 4,
                                    'medium' => 3,
                                    'low' => 2,
                                    default => 1
                                };
                            
                                // Calculate progress based on status since progress field may not exist
                                $progressValue = match($task->status) {
                                    'completed' => 100,
                                    'review' => 90,
                                    'in_progress' => rand(30, 80), // Random progress for in-progress tasks
                                    'cancelled' => 0,
                                    default => 0
                                };
                                
                                $timelineStatus = match($task->status) {
                                    'completed' => 'done',
                                    'in_progress' => 'in-progress',
                                    'review' => 'review',
                                    'cancelled' => 'cancelled',
                                    default => 'not-started'
                                };
                            @endphp
                            
                            @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-row', [
                                'taskId' => 'task-' . $task->id,
                                'taskName' => $task->title,
                                'priority' => $priorityValue,
                                'status' => $timelineStatus,
                                'progress' => $progressValue,
                                'dependencies' => [] // Could be enhanced with actual dependency data
                            ])
                        @endforeach
                    @else
                        <div class="px-4 py-3 text-center text-gray-500">
                            <i class="bi bi-inbox text-lg mb-2"></i>
                            <p class="text-sm">No tasks assigned</p>
                            @if(isset($project) && $project->id)
                                <button onclick="openAddNewTaskModal('todo', {{ $member->id }})" class="mt-2 text-xs text-blue-600 hover:text-blue-800">
                                    Assign a task
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-8 px-4">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                <i class="bi bi-people text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Team Members</h3>
            <p class="text-gray-500 text-sm mb-4">This project doesn't have any team members assigned yet.</p>
            @if(isset($project) && $project->id)
                <button onclick="openTeamModal({{ $project->id }})" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all text-sm">
                    <i class="bi bi-person-plus mr-2"></i>
                    Add Team Members
                </button>
            @endif
        </div>
    @endif
</div>