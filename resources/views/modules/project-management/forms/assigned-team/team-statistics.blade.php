{{-- Team Statistics Component --}}
<div class="grid grid-cols-1 gap-4">
    {{-- Total Members --}}
    <div class="bg-white border rounded-lg p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="p-2 rounded-full bg-blue-100 text-blue-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-500">Total Members</p>
                <p class="text-2xl font-semibold text-gray-900">{{ isset($project) && $project->teamMembers ? $project->teamMembers->count() : 0 }}</p>
            </div>
        </div>
    </div>

    {{-- Active Tasks --}}
    <div class="bg-white border rounded-lg p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="p-2 rounded-full bg-green-100 text-green-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-500">Active Tasks</p>
                <p class="text-2xl font-semibold text-gray-900">{{ isset($project) && $project->tasks ? $project->tasks->where('status', '!=', 'completed')->count() : 0 }}</p>
            </div>
        </div>
    </div>

    {{-- Completion Rate --}}
    <div class="bg-white border rounded-lg p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="p-2 rounded-full bg-purple-100 text-purple-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-500">Completion Rate</p>
                <p class="text-2xl font-semibold text-gray-900">
                    @if(isset($project) && $project->tasks && $project->tasks->count() > 0)
                        {{ round(($project->tasks->where('status', 'completed')->count() / $project->tasks->count()) * 100) }}%
                    @else
                        0%
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>