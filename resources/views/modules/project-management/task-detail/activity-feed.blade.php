{{-- Recent Activity Feed --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <div class="w-1 h-6 bg-purple-500 rounded"></div>
                    Recent Activity
                    <span class="ml-2 px-2 py-1 text-xs bg-purple-100 text-purple-700 rounded-full">Live Updates</span>
                </h3>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="refreshActivity()" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                    <i class="bi bi-arrow-clockwise"></i>
                    Refresh
                </button>
                <button onclick="viewAllActivity()" class="px-3 py-1 text-sm bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-all">
                    <i class="bi bi-eye"></i>
                    View All
                </button>
            </div>
        </div>
    </div>
    
    <div class="p-4">
        @php
            $activities = [];
            
            if($task->assignedUsers->count() > 0) {
                $activities[] = [
                    'user' => $task->assignedUsers->first(),
                    'action' => 'was assigned to task',
                    'time' => $task->created_at->diffForHumans(),
                    'icon' => 'bi-person-plus',
                    'color' => 'blue'
                ];
                
                if($task->status === 'in_progress') {
                    $activities[] = [
                        'user' => $task->assignedUsers->first(),
                        'action' => 'started working on task',
                        'time' => $task->updated_at->diffForHumans(),
                        'icon' => 'bi-play-circle',
                        'color' => 'orange'
                    ];
                } elseif($task->status === 'completed') {
                    $activities[] = [
                        'user' => $task->assignedUsers->first(),
                        'action' => 'completed the task',
                        'time' => $task->updated_at->diffForHumans(),
                        'icon' => 'bi-check-circle',
                        'color' => 'green'
                    ];
                }
            }
        @endphp

        <div class="space-y-4">

        @foreach($activities as $activity)
        @if($activity['user'])
        <div class="flex items-start gap-3 p-3 hover:bg-gray-50 rounded-lg transition-all">
            @php
                // Get user avatar with profile photo fallback
                $avatarUrl = '/assets/images/faces/' . ((abs(crc32($activity['user']->name)) % 16) + 1) . '.jpg';
                
                if ($activity['user']->profile_photo_path) {
                    $profilePath = public_path('storage/' . $activity['user']->profile_photo_path);
                    if (file_exists($profilePath) && is_readable($profilePath)) {
                        $avatarUrl = '/storage/' . $activity['user']->profile_photo_path;
                    }
                }
                
                // Only use specific mappings if no real profile photo exists
                if ($activity['user']->name === 'System Administrator' && (!$activity['user']->profile_photo_path || !file_exists(public_path('storage/' . $activity['user']->profile_photo_path)))) {
                    $avatarUrl = '/assets/images/faces/1.jpg';
                } elseif ($activity['user']->name === 'Cesilia Cortez' && (!$activity['user']->profile_photo_path || !file_exists(public_path('storage/' . $activity['user']->profile_photo_path)))) {
                    $avatarUrl = '/assets/images/faces/2.jpg';
                }
            @endphp
            <img src="{{ $avatarUrl }}" alt="{{ $activity['user']->name }}" 
                 class="w-10 h-10 rounded-full object-cover flex-shrink-0">
            <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-900">
                    <span class="font-medium">{{ $activity['user']->name }}</span>
                    {{ $activity['action'] }}
                </p>
                <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
            </div>
            <div class="flex-shrink-0">
                <i class="bi bi-{{ $activity['icon'] }} text-{{ $activity['color'] }}-500"></i>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    {{-- Quick Actions --}}
    <div class="mt-6 pt-4 border-t border-gray-200">
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-2 text-sm bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-all">
                <i class="bi bi-chat mr-2"></i>Add Comment
            </button>
            <button class="flex-1 px-3 py-2 text-sm bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-all">
                <i class="bi bi-paperclip mr-2"></i>Upload File
            </button>
        </div>
    </div>
</div>
