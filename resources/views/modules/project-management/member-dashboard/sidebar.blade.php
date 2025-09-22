<div class="space-y-6">
    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">My Projects</h3>
        <div class="space-y-3">
            @foreach($userProjects as $project)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($project->name, 30) }}</div>
                        <div class="text-xs text-gray-500">{{ ucfirst($project->pivot->role) }}</div>
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ $project->tasks()->whereHas('assignedUsers', function($q) { $q->where('user_id', auth()->id()); })->count() }} tasks
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Stats</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Tasks This Week</span>
                <span class="text-sm font-medium text-gray-900">
                    {{ $assignedTasks->where('due_date', '>=', now()->startOfWeek())->where('due_date', '<=', now()->endOfWeek())->count() }}
                </span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Overdue Tasks</span>
                <span class="text-sm font-medium text-red-600">
                    {{ $assignedTasks->where('due_date', '<', now())->whereNotIn('status', ['completed'])->count() }}
                </span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Completion Rate</span>
                <span class="text-sm font-medium text-green-600">
                    {{ $assignedTasks->count() > 0 ? round(($assignedTasks->where('status', 'completed')->count() / $assignedTasks->count()) * 100) : 0 }}%
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
        <div class="space-y-3">
            @foreach($assignedTasks->sortByDesc('updated_at')->take(5) as $task)
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <div class="text-sm text-gray-900">{{ Str::limit($task->title, 40) }}</div>
                        <div class="text-xs text-gray-500">
                            Updated {{ $task->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
