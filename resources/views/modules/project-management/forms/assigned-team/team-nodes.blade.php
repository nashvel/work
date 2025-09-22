{{-- Team Member Nodes Component --}}
<div class="grid gap-4" style="grid-template-columns: repeat({{ min($project->teamMembers->count(), 3) }}, 1fr);">
    @foreach($project->teamMembers->take(6) as $index => $member)
        <div class="relative">
            {{-- Member Node --}}
            <div class="bg-green-50 border-2 border-green-200 rounded-lg p-3 text-center min-w-[120px] hover:shadow-md transition-shadow">
                <div class="flex justify-center mb-2">
                    <img class="w-8 h-8 rounded-full object-cover border-2 border-green-300" 
                         src="{{ $member->profile_photo_url }}" 
                         alt="{{ $member->name }}">
                </div>
                <h5 class="font-medium text-gray-900 text-xs truncate">{{ $member->name }}</h5>
                <div class="mt-1">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                        @if(($member->pivot->role ?? 'member') === 'manager') bg-purple-100 text-purple-800
                        @elseif(($member->pivot->role ?? 'member') === 'lead') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($member->pivot->role ?? 'Member') }}
                    </span>
                </div>
                
                {{-- Task Count --}}
                @if(isset($project->tasks))
                    <div class="mt-2 text-xs text-gray-600">
                        {{ $project->tasks->where('assigned_to', $member->id)->count() }} tasks
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>