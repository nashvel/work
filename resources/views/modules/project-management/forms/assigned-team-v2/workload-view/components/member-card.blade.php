<div class="workload-member-card bg-white border-2 border-{{ $member['status'] == 'overloaded' ? 'red' : ($member['status'] == 'busy' ? 'orange' : 'green') }}-200 rounded-lg p-6 hover:shadow-lg transition-all cursor-pointer"
     data-member="{{ strtolower(str_replace(' ', '-', $member['name'])) }}"
     onclick="openMemberDetails('{{ strtolower(str_replace(' ', '-', $member['name'])) }}')">
    
    <div class="flex items-center gap-4 mb-6">
        <div class="relative">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($member['name']) }}&size=64&background={{ $member['color'] }}&color=fff" 
                 class="w-16 h-16 rounded-full border-4 border-white shadow-lg" 
                 alt="{{ $member['name'] }}">
            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-{{ $member['status'] == 'overloaded' ? 'red' : ($member['status'] == 'busy' ? 'orange' : 'green') }}-500 rounded-full border-2 border-white flex items-center justify-center">
                <i class="bi bi-{{ $member['status'] == 'overloaded' ? 'exclamation' : ($member['status'] == 'busy' ? 'clock' : 'check') }} text-white text-xs"></i>
            </div>
        </div>
        <div class="flex-1">
            <h4 class="font-semibold text-gray-900 text-lg">{{ $member['name'] }}</h4>
            <p class="text-sm text-gray-600">{{ $member['role'] }}</p>
            <div class="flex items-center gap-2 mt-1">
                <span class="text-xs px-2 py-1 bg-{{ $member['status'] == 'overloaded' ? 'red' : ($member['status'] == 'busy' ? 'orange' : 'green') }}-100 text-{{ $member['status'] == 'overloaded' ? 'red' : ($member['status'] == 'busy' ? 'orange' : 'green') }}-700 rounded-full">
                    {{ ucfirst($member['status']) }}
                </span>
                @if($member['overdue_tasks'] > 0)
                    <span class="text-xs px-2 py-1 bg-red-100 text-red-700 rounded-full flex items-center gap-1">
                        <i class="bi bi-exclamation-triangle"></i>
                        {{ $member['overdue_tasks'] }} overdue
                    </span>
                @endif
            </div>
        </div>
        <div class="text-right">
            <div class="text-2xl font-bold text-{{ $member['status'] == 'overloaded' ? 'red' : ($member['status'] == 'busy' ? 'orange' : 'green') }}-600">
                {{ $member['capacity'] }}%
            </div>
            <div class="text-xs text-gray-500">{{ $member['hours_allocated'] }}/{{ $member['hours_available'] }}h</div>
        </div>
    </div>
    
    {{-- Capacity Bar --}}
    <div class="mb-6">
        <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
            <span>Weekly Capacity</span>
            <span>{{ $member['hours_allocated'] }}h / {{ $member['hours_available'] }}h</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4 relative overflow-hidden">
            <div class="bg-{{ $member['status'] == 'overloaded' ? 'red' : ($member['status'] == 'busy' ? 'orange' : 'green') }}-500 h-4 rounded-full transition-all duration-500 flex items-center justify-end pr-2" 
                 style="width: {{ min($member['capacity'], 100) }}%;">
                @if($member['capacity'] > 80)
                    <span class="text-white text-xs font-medium">{{ $member['capacity'] }}%</span>
                @endif
            </div>
            @if($member['capacity'] > 100)
                <div class="absolute top-0 right-0 h-4 bg-red-600 rounded-r-full" style="width: {{ $member['capacity'] - 100 }}%;"></div>
            @endif
        </div>
    </div>
    
    {{-- Project Distribution --}}
    <div class="mb-6">
        <h5 class="text-sm font-medium text-gray-700 mb-3">Project Distribution</h5>
        <div class="grid grid-cols-2 gap-4">
            <div class="text-center">
                <div class="text-xl font-bold text-blue-600">{{ $member['projects'] }}</div>
                <div class="text-xs text-gray-500">Active Projects</div>
            </div>
            <div class="text-center">
                <div class="text-xl font-bold text-purple-600">{{ rand(3, 8) }}</div>
                <div class="text-xs text-gray-500">Active Tasks</div>
            </div>
        </div>
    </div>
    
    {{-- Skills Tags --}}
    <div class="mb-6">
        <h5 class="text-sm font-medium text-gray-700 mb-2">Core Skills</h5>
        <div class="flex flex-wrap gap-1">
            @foreach($member['skills'] as $skill)
                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded-full">{{ $skill }}</span>
            @endforeach
        </div>
    </div>
    
    {{-- Quick Actions --}}
    <div class="flex gap-2">
        <button onclick="assignTasks('{{ strtolower(str_replace(' ', '-', $member['name'])) }}')" 
                class="flex-1 px-3 py-2 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all flex items-center justify-center gap-1">
            <i class="bi bi-plus-circle"></i>
            Assign
        </button>
        <button onclick="viewDetails('{{ strtolower(str_replace(' ', '-', $member['name'])) }}')" 
                class="flex-1 px-3 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-1">
            <i class="bi bi-eye"></i>
            Details
        </button>
        @if($member['status'] == 'overloaded')
            <button onclick="redistributeTasks('{{ strtolower(str_replace(' ', '-', $member['name'])) }}')" 
                    class="px-3 py-2 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all flex items-center justify-center">
                <i class="bi bi-arrow-left-right"></i>
            </button>
        @endif
    </div>
</div>