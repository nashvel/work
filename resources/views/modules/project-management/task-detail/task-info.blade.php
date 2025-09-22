{{-- Task Information Sidebar --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="font-semibold text-gray-900 mb-4">Task Details</h3>
    
    <div class="space-y-4">
        {{-- Status --}}
        <div>
            <label class="text-sm font-medium text-gray-700">Status</label>
            <select class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="not_started" {{ $task->status === 'not_started' ? 'selected' : '' }}>Not Started</option>
                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="review" {{ $task->status === 'review' ? 'selected' : '' }}>In Review</option>
                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        {{-- Priority --}}
        <div>
            <label class="text-sm font-medium text-gray-700">Priority</label>
            <select class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                <option value="critical" {{ $task->priority === 'critical' ? 'selected' : '' }}>Critical</option>
            </select>
        </div>

        {{-- Due Date --}}
        <div>
            <label class="text-sm font-medium text-gray-700">Due Date</label>
            <input type="date" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}" 
                   class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Progress --}}
        <div>
            <label class="text-sm font-medium text-gray-700">Progress</label>
            <div class="mt-2">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                    <span>{{ $task->progress ?? rand(45, 85) }}% Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full transition-all" style="width: {{ $task->progress ?? rand(45, 85) }}%"></div>
                </div>
            </div>
        </div>

        {{-- Estimated Hours --}}
        <div>
            <label class="text-sm font-medium text-gray-700">Estimated Hours</label>
            <input type="number" value="{{ $task->estimated_hours ?? rand(8, 24) }}" 
                   class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Actual Hours --}}
        <div>
            <label class="text-sm font-medium text-gray-700">Actual Hours</label>
            <div class="mt-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700">
                {{ rand(6, 20) }} hours logged
            </div>
        </div>
    </div>

    {{-- Description --}}
    <div class="mt-6 pt-6 border-t border-gray-200">
        <label class="text-sm font-medium text-gray-700">Description</label>
        <div class="mt-2 text-sm text-gray-600 leading-relaxed">
            {{ $task->description ?? 'Clean all office windows inside and outside, including window sills. Use appropriate cleaning supplies and ensure streak-free finish.' }}
        </div>
    </div>

    {{-- Tags --}}
    <div class="mt-6">
        <label class="text-sm font-medium text-gray-700 mb-2 block">Tags</label>
        <div class="flex flex-wrap gap-2">
            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Maintenance</span>
            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Cleaning</span>
            <span class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded-full">Office</span>
        </div>
    </div>
</div>
