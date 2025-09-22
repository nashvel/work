<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @php
            $projectTeamMembers = isset($project) && $project->teamMembers ? $project->teamMembers : collect();
            
            $colors = ['3b82f6', 'e11d48', '8b5cf6', 'ec4899', '059669', 'f59e0b', '10b981', 'f97316', '6366f1', 'ef4444'];
            
            $teamMembers = $projectTeamMembers->map(function($member, $index) use ($colors, $project) {
                $hoursAvailable = 40;

                $memberTasks = isset($project) && $project->tasks ? 
                    $project->tasks->where('assigned_to', $member->id) : collect();
                
                $hoursAllocated = $memberTasks->sum('estimated_hours') ?: 0;
                $capacity = $hoursAllocated > 0 ? round(($hoursAllocated / $hoursAvailable) * 100) : 0;

                $status = 'available';
                if ($capacity >= 100) {
                    $status = 'overloaded';
                } elseif ($capacity >= 75) {
                    $status = 'busy';
                }
                
                $memberProjects = 1; // Current project
                $overdueTasks = $memberTasks->where('due_date', '<', now())
                    ->where('status', '!=', 'completed')->count();
                
                return [
                    'name' => $member->name,
                    'role' => ucfirst($member->pivot->role ?? 'Member'),
                    'color' => $colors[$index % count($colors)],
                    'capacity' => $capacity,
                    'hours_allocated' => $hoursAllocated,
                    'hours_available' => $hoursAvailable,
                    'status' => $status,
                    'projects' => $memberProjects,
                    'overdue_tasks' => $overdueTasks,
                    'skills' => ['General Skills', 'Project Work', 'Team Collaboration'] // Default skills
                ];
            })->toArray();
        @endphp
        
        @if(count($teamMembers) > 0)
            @foreach($teamMembers as $member)
                @include('modules.project-management.forms.assigned-team-v2.workload-view.components.member-card', ['member' => $member])
            @endforeach
        @else
            <div class="col-span-full text-center py-12">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                    <i class="bi bi-people text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Team Members Assigned</h3>
                <p class="text-gray-500 mb-4">This project doesn't have any team members assigned yet.</p>
                @if(isset($project) && $project->id)
                    <button onclick="openTeamModal({{ $project->id }})" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                        <i class="bi bi-person-plus mr-2"></i>
                        Add Team Members
                    </button>
                @endif
            </div>
        @endif
    </div>
    
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6">
        <h4 class="font-semibold text-blue-900 mb-4 flex items-center gap-2">
            AI-Powered Load Balancing Suggestions
        </h4>
        @php
            $suggestions = collect();
            
            $overloadedMembers = collect($teamMembers)->where('capacity', '>=', 100);
            foreach($overloadedMembers as $member) {
                $suggestions->push([
                    'type' => 'redistribute',
                    'icon' => 'exclamation-triangle',
                    'color' => 'red',
                    'title' => "Redistribute {$member['name']}'s Tasks",
                    'description' => "{$member['name']} is overloaded at {$member['capacity']}% capacity. Consider redistributing tasks to available team members.",
                    'action' => "redistributeTasks('{$member['name']}')"
                ]);
            }
            
            $underutilizedMembers = collect($teamMembers)->where('capacity', '<', 60);
            foreach($underutilizedMembers as $member) {
                $availableCapacity = 100 - $member['capacity'];
                $suggestions->push([
                    'type' => 'utilize',
                    'icon' => 'plus-circle',
                    'color' => 'green',
                    'title' => "Utilize {$member['name']}'s Capacity",
                    'description' => "{$member['name']} has {$availableCapacity}% available capacity. Consider assigning additional tasks.",
                    'action' => "assignToMember('{$member['name']}')"
                ]);
            }
            
            if($suggestions->isEmpty()) {
                $suggestions->push([
                    'type' => 'optimize',
                    'icon' => 'gear',
                    'color' => 'blue',
                    'title' => 'Team Load Balanced',
                    'description' => 'Your team workload is well distributed. Consider optimizing task scheduling for better efficiency.',
                    'action' => 'optimizeSchedule()'
                ]);
            }
            
            $suggestions = $suggestions->take(3);
        @endphp
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($suggestions as $suggestion)
                <div class="bg-white rounded-lg p-4 border border-blue-200">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-{{ $suggestion['color'] }}-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-{{ $suggestion['icon'] }} text-{{ $suggestion['color'] }}-600"></i>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-900 mb-1">{{ $suggestion['title'] }}</h5>
                            <p class="text-sm text-gray-600 mb-2">{{ $suggestion['description'] }}</p>
                            <button onclick="{{ $suggestion['action'] }}" class="text-xs bg-{{ $suggestion['color'] }}-100 text-{{ $suggestion['color'] }}-700 px-2 py-1 rounded hover:bg-{{ $suggestion['color'] }}-200 transition-all">
                                {{ $suggestion['type'] === 'redistribute' ? 'Redistribute' : ($suggestion['type'] === 'utilize' ? 'Assign Tasks' : 'Optimize') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>