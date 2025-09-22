<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-medium text-gray-900">
                    Team Members
                </h1>
                <p class="mt-2 text-gray-600">
                    Manage team members for <span class="font-semibold">{{ $project->name }}</span>
                </p>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <i class="bi bi-people mr-1"></i>
                    {{ $project->teamMembers->count() }} {{ Str::plural('member', $project->teamMembers->count()) }}
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('projects.team', $project->id) }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="bi bi-gear"></i>
                    Manage
                </a>
                <button onclick="openAddMemberModal()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="bi bi-person-plus"></i>
                    Add Member
                </button>
            </div>
        </div>
    </div>
</div>
