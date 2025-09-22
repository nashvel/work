{{-- Team Member Card Component --}}
<div class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:shadow-sm transition-shadow bg-white">
    <div class="flex-shrink-0">
        <img class="h-8 w-8 rounded-full object-cover" src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}">
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-sm font-medium text-gray-900 truncate">{{ $member->name }}</p>
        <p class="text-sm text-gray-500 truncate">{{ $member->email }}</p>
        <div class="mt-1">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ ucfirst($member->pivot->role ?? 'Member') }}
            </span>
        </div>
    </div>
    @if(isset($project) && $project->id)
        <div class="flex-shrink-0">
            <button onclick="removeTeamMember({{ $project->id }}, {{ $member->id }})" class="text-red-600 hover:text-red-900 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        </div>
    @endif
</div>