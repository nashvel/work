{{-- Team Performance Metrics --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <div class="w-1 h-6 bg-orange-500 rounded"></div>
                    Team Metrics
                    <span class="ml-2 px-2 py-1 text-xs bg-orange-100 text-orange-700 rounded-full">Performance</span>
                </h3>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="exportMetrics()" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                    <i class="bi bi-download"></i>
                    Export
                </button>
            </div>
        </div>
    </div>
    
    <div class="p-4">
    
    <div class="space-y-4">
        @foreach($task->assignedUsers->take(4) as $index => $member)
        @php
            $productivity = $member->pivot->productivity ?? 0;
            $efficiency = $member->pivot->efficiency ?? 0;
            $tasksDone = $member->pivot->tasks_completed_today ?? 0;
            $hoursToday = $member->pivot->hours_today ?? 0;
            $memberColor = ['blue', 'green', 'purple', 'orange'][$index % 4];
        @endphp
        
        <div class="p-3 border border-gray-200 rounded-lg">
            <div class="flex items-center gap-2 mb-2">
                @php
                    $facesPath = public_path('assets/images/faces');
                    $availableFaces = [];
                    
                    if (is_dir($facesPath)) {
                        $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                        $availableFaces = array_map(function($file) {
                            return '/assets/images/faces/' . basename($file);
                        }, $files);
                    }
                    
                    if (empty($availableFaces)) {
                        for ($i = 1; $i <= 16; $i++) {
                            $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
                        }
                    }
                    
                    $faceIndex = abs(crc32($member->name)) % count($availableFaces);
                    $avatarUrl = $availableFaces[$faceIndex];
                    
                    if ($member->profile_photo_path) {
                        $profilePath = public_path('storage/' . $member->profile_photo_path);
                        if (file_exists($profilePath) && is_readable($profilePath)) {
                            $avatarUrl = '/storage/' . $member->profile_photo_path;
                        }
                    }
                @endphp
                <img src="{{ $avatarUrl }}" alt="{{ $member->name }}" 
                     class="w-8 h-8 rounded-full object-cover">
                <div>
                    <div class="font-medium text-gray-900">{{ $member->name }}</div>
                    <div class="text-sm text-gray-500">{{ $member->pivot->role ?? 'Team Member' }}</div>
                </div>
            </div>
            
            {{-- Performance Metrics --}}
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div>
                    <div class="text-gray-500 text-xs">Productivity</div>
                    <div class="flex items-center gap-1">
                        <div class="flex-1 bg-gray-200 rounded-full h-1.5">
                            <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $productivity }}%"></div>
                        </div>
                        <span class="text-blue-600 font-medium text-xs">{{ $productivity }}%</span>
                    </div>
                </div>
                
                <div>
                    <div class="text-gray-500 text-xs">Efficiency</div>
                    <div class="flex items-center gap-1">
                        <div class="flex-1 bg-gray-200 rounded-full h-1.5">
                            <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $efficiency }}%"></div>
                        </div>
                        <span class="text-green-600 font-medium text-xs">{{ $efficiency }}%</span>
                    </div>
                </div>
                
                <div>
                    <div class="text-gray-500 text-xs">Tasks Done</div>
                    <div class="font-semibold text-gray-900 text-sm">{{ $tasksDone }}</div>
                </div>
                
                <div>
                    <div class="text-gray-500 text-xs">Hours Today</div>
                    <div class="font-semibold text-gray-900 text-sm">{{ $hoursToday }}h</div>
                </div>
            </div>
            
            {{-- Quick Actions --}}
            <div class="mt-3 flex gap-2">
                <button onclick="viewMemberReport('{{ $member->id }}')" class="flex-1 px-2 py-1 text-xs bg-{{ $memberColor }}-50 text-{{ $memberColor }}-700 rounded hover:bg-{{ $memberColor }}-100 transition-all">
                    View Report
                </button>
                <button onclick="assignTask('{{ $member->id }}')" class="flex-1 px-2 py-1 text-xs bg-gray-50 text-gray-700 rounded hover:bg-gray-100 transition-all">
                    Assign Task
                </button>
            </div>
        </div>
        @endforeach
    </div>
    
    {{-- Team Summary --}}
    <div class="mt-6 pt-4 border-t border-gray-200">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div class="text-center">
                <div class="text-lg font-bold text-blue-600">{{ rand(85, 95) }}%</div>
                <div class="text-gray-500">Team Avg</div>
            </div>
            <div class="text-center">
                <div class="text-lg font-bold text-green-600">{{ rand(20, 30) }}h</div>
                <div class="text-gray-500">Total Hours</div>
            </div>
        </div>
    </div>
</div>
