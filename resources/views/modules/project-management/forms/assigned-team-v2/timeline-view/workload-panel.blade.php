<div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <h5 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-calendar-week text-purple-600"></i>
                Timeline Metrics
            </h5>
            @php
                $allTasks = isset($project) && $project->tasks ? $project->tasks : collect();
                $totalTasks = $allTasks->count();
                $onScheduleTasks = $allTasks->where('status', 'in_progress')->count() + $allTasks->where('status', 'completed')->count();
                $overdueTasks = $allTasks->where('due_date', '<', now())->where('status', '!=', 'completed')->count();
                $criticalTasks = $allTasks->where('priority', 'critical')->count();
            @endphp
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Tasks:</span>
                    <span class="font-medium">{{ $totalTasks }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">On Schedule:</span>
                    <span class="font-medium text-green-600">{{ $onScheduleTasks }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Overdue:</span>
                    <span class="font-medium text-red-600">{{ $overdueTasks }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Critical Path:</span>
                    <span class="font-medium text-orange-600">{{ $criticalTasks }} tasks</span>
                </div>
            </div>
        </div>


        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <h5 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-people text-blue-600"></i>
                Resource Utilization
            </h5>
            @php
                $projectTeamMembers = isset($project) && $project->teamMembers ? $project->teamMembers : collect();
            @endphp
            <div class="space-y-3 text-sm">
                @if($projectTeamMembers->count() > 0)
                    @foreach($projectTeamMembers->take(3) as $member)
                        @php
                            $memberTasks = isset($project) && $project->tasks ? 
                                $project->tasks->where('assigned_to', $member->id) : collect();
                            $totalEstimatedHours = $memberTasks->sum('estimated_hours') ?: 0;
                            $weeklyCapacity = 40;
                            $utilizationPercent = $totalEstimatedHours > 0 ? min(150, ($totalEstimatedHours / $weeklyCapacity) * 100) : 0;
                            
                            $utilizationColor = $utilizationPercent >= 100 ? 'red-500' : ($utilizationPercent >= 85 ? 'orange-500' : 'green-500');
                            $utilizationTextColor = $utilizationPercent >= 100 ? 'red-600' : ($utilizationPercent >= 85 ? 'orange-600' : 'green-600');
                        @endphp
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">{{ $member->name }}:</span>
                            <div class="flex items-center gap-2">
                                <div class="w-12 h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-{{ $utilizationColor }} rounded-full" style="width: {{ min(100, $utilizationPercent) }}%;"></div>
                                </div>
                                <span class="text-xs text-{{ $utilizationTextColor }} font-medium">{{ round($utilizationPercent) }}%</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-500 py-2">
                        <i class="bi bi-people text-lg mb-1"></i>
                        <p class="text-xs">No team members assigned</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <h5 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-exclamation-triangle text-orange-600"></i>
                Schedule Conflicts
            </h5>
            @php
                $overloadedMembers = collect();
                $dependencyIssues = collect();
                
                if(isset($project) && $project->teamMembers) {
                    foreach($project->teamMembers as $member) {
                        $memberTasks = $project->tasks ? $project->tasks->where('assigned_to', $member->id) : collect();
                        $totalHours = $memberTasks->sum('estimated_hours') ?: 0;
                        if($totalHours > 40) {
                            $overloadedMembers->push([
                                'name' => $member->name,
                                'overload' => round(($totalHours / 40) * 100) - 100
                            ]);
                        }
                    }
                }
                
                if(isset($project) && $project->tasks) {
                    $dependencyIssues = $project->tasks->where('due_date', '<', now())
                        ->where('status', '!=', 'completed')
                        ->take(2);
                }
            @endphp
            <div class="space-y-2 text-sm">
                @if($overloadedMembers->count() > 0)
                    @foreach($overloadedMembers->take(1) as $member)
                        <div class="p-2 bg-red-50 rounded border-l-4 border-red-400">
                            <p class="text-red-800 font-medium">{{ $member['name'] }} Overloaded</p>
                            <p class="text-red-600 text-xs">{{ $member['overload'] }}% over capacity</p>
                        </div>
                    @endforeach
                @endif
                
                @if($dependencyIssues->count() > 0)
                    @foreach($dependencyIssues->take(1) as $task)
                        <div class="p-2 bg-orange-50 rounded border-l-4 border-orange-400">
                            <p class="text-orange-800 font-medium">Overdue Task</p>
                            <p class="text-orange-600 text-xs">{{ $task->title }} - {{ $task->due_date ? $task->due_date->diffForHumans() : 'No due date' }}</p>
                        </div>
                    @endforeach
                @endif
                
                @if($overloadedMembers->count() == 0 && $dependencyIssues->count() == 0)
                    <div class="text-center text-gray-500 py-2">
                        <i class="bi bi-check-circle text-green-500 text-lg mb-1"></i>
                        <p class="text-xs">No conflicts detected</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <h5 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-lightning text-yellow-600"></i>
                Quick Actions
            </h5>
            <div class="space-y-2">
                <button onclick="autoResolveConflicts()" class="w-full px-3 py-2 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all">
                    <i class="bi bi-magic"></i> Resolve Conflicts
                </button>
                <button onclick="optimizeSchedule()" class="w-full px-3 py-2 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all">
                    <i class="bi bi-gear"></i> Optimize Schedule
                </button>
                <button onclick="exportTimeline()" class="w-full px-3 py-2 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all">
                    <i class="bi bi-download"></i> Export Timeline
                </button>
            </div>
        </div>
    </div>
</div>