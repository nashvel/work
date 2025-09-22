<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-medium text-gray-900">
                    My Tasks
                </h1>
                <p class="mt-2 text-gray-600">
                    Tasks assigned to you across all projects
                </p>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <i class="bi bi-list-task mr-1"></i>
                    {{ $assignedTasks->count() }} {{ Str::plural('task', $assignedTasks->count()) }} assigned
                </div>
            </div>
            <div class="flex space-x-3">
                <div class="bg-blue-50 px-4 py-2 rounded-lg">
                    <div class="text-sm text-blue-600 font-medium">Active Tasks</div>
                    <div class="text-2xl font-bold text-blue-700">{{ $assignedTasks->whereIn('status', ['pending', 'in_progress'])->count() }}</div>
                </div>
                <div class="bg-green-50 px-4 py-2 rounded-lg">
                    <div class="text-sm text-green-600 font-medium">Completed</div>
                    <div class="text-2xl font-bold text-green-700">{{ $assignedTasks->where('status', 'completed')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
