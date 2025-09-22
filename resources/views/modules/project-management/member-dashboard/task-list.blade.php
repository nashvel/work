<div class="bg-white shadow-xl sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-medium text-gray-900">Assigned Tasks</h2>
            <div class="flex space-x-2">
                <select id="statusFilter" class="text-sm border border-gray-300 rounded-md px-3 py-1">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="on_hold">On Hold</option>
                </select>
                <select id="priorityFilter" class="text-sm border border-gray-300 rounded-md px-3 py-1">
                    <option value="">All Priority</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
        </div>

        @if($assignedTasks->count() > 0)
            <div class="space-y-4">
                @foreach($assignedTasks as $task)
                    @include('modules.project-management.member-dashboard.task-card', ['task' => $task])
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="bi bi-clipboard-check text-6xl text-gray-400 mx-auto block"></i>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No tasks assigned</h3>
                <p class="mt-2 text-gray-500">
                    You don't have any tasks assigned to you yet.
                </p>
            </div>
        @endif
    </div>
</div>
