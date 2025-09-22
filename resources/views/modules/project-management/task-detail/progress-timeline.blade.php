{{-- Progress Timeline Section --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <div class="w-1 h-6 bg-green-500 rounded"></div>
                    Progress Timeline
                    <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Recent Activity</span>
                </h3>
            </div>
            <div class="flex items-center gap-2">
                <select class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>All time</option>
                </select>
                <button onclick="refreshTimeline()" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                    <i class="bi bi-arrow-clockwise"></i>
                    Refresh
                </button>
            </div>
        </div>
    </div>
    
    <div class="p-4">

    {{-- Timeline Container --}}
    <div class="relative">
        @php
            // Get real activity data or create basic timeline from task data
            $timelineEvents = [];
            
            if($task->assignedUsers->count() > 0) {
                // Task creation event
                $timelineEvents[] = [
                    'time' => $task->created_at->diffForHumans(),
                    'user' => $task->assignedUsers->first(),
                    'action' => 'Task was created',
                    'type' => 'start',
                    'color' => 'blue'
                ];
                
                // Status updates based on current status
                if($task->status === 'in_progress') {
                    $timelineEvents[] = [
                        'time' => $task->updated_at->diffForHumans(),
                        'user' => $task->assignedUsers->first(),
                        'action' => 'Started working on task',
                        'type' => 'progress',
                        'color' => 'orange'
                    ];
                } elseif($task->status === 'completed') {
                    $timelineEvents[] = [
                        'time' => $task->updated_at->diffForHumans(),
                        'user' => $task->assignedUsers->first(),
                        'action' => 'Completed task',
                        'type' => 'completion',
                        'color' => 'green'
                    ];
                }
            }
        @endphp

        {{-- Timeline Line --}}
        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200"></div>

        <div class="space-y-6">
            @foreach($timelineEvents as $event)
            @if($event['user'])
            <div class="relative flex items-start gap-4">
                {{-- Timeline Dot --}}
                <div class="relative z-10 w-4 h-4 bg-{{ $event['color'] }}-500 rounded-full border-2 border-white shadow-sm"></div>
                
                {{-- Event Content --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        @php
                            // Get user avatar with profile photo fallback
                            $facesPath = public_path('assets/images/faces');
                            $availableFaces = [];
                            
                            if (is_dir($facesPath)) {
                                $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                $availableFaces = array_map(function($file) {
                                    return '/assets/images/faces/' . basename($file);
                                }, $files);
                            }
                            
                            // Fallback if no faces found
                            if (empty($availableFaces)) {
                                for ($i = 1; $i <= 16; $i++) {
                                    $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
                                }
                            }
                            
                            // Use hash to consistently assign a face
                            $faceIndex = abs(crc32($event['user']->name)) % count($availableFaces);
                            $avatarUrl = $availableFaces[$faceIndex];
                            
                            // Check for user's actual profile photo first
                            if ($event['user']->profile_photo_path) {
                                $profilePath = public_path('storage/' . $event['user']->profile_photo_path);
                                if (file_exists($profilePath) && is_readable($profilePath)) {
                                    $avatarUrl = '/storage/' . $event['user']->profile_photo_path;
                                }
                            }
                        @endphp
                        <img src="{{ $avatarUrl }}" alt="{{ $event['user']->name }}" 
                             class="w-8 h-8 rounded-full object-cover">
                        <div>
                            <div class="font-medium text-gray-900">{{ $event['user']->name }}</div>
                            <div class="text-sm text-gray-500">{{ $event['time'] }}</div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-3 ml-11">
                        <p class="text-sm text-gray-700">{{ $event['action'] }}</p>
                        
                        {{-- Additional Details Based on Type --}}
                        @if($event['type'] === 'progress')
                        <div class="mt-2 flex items-center gap-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-{{ $event['color'] }}-500 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                            <span class="text-xs text-gray-600">75%</span>
                        </div>
                        @elseif($event['type'] === 'completion')
                        <div class="mt-2 flex items-center gap-2 text-green-600">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-sm">Subtask completed</span>
                        </div>
                        @elseif($event['type'] === 'update')
                        <div class="mt-2 flex items-center gap-4 text-sm text-gray-600">
                            <span><i class="bi bi-chat mr-1"></i>3 comments</span>
                            <span><i class="bi bi-paperclip mr-1"></i>2 files</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- Working Hours Today --}}
    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="font-medium text-gray-900 mb-4">Today's Working Hours</h3>
        <div class="space-y-3">
            @foreach($task->assignedUsers->take(3) as $index => $member)
            @php
                $hoursWorked = $member->pivot->hours_today ?? 0;
                $isCurrentlyWorking = $member->pivot->is_online ?? false;
            @endphp
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center gap-3">
                    @php
                        // Get user avatar with profile photo fallback
                        $facesPath = public_path('assets/images/faces');
                        $availableFaces = [];
                        
                        if (is_dir($facesPath)) {
                            $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                            $availableFaces = array_map(function($file) {
                                return '/assets/images/faces/' . basename($file);
                            }, $files);
                        }
                        
                        // Fallback if no faces found
                        if (empty($availableFaces)) {
                            for ($i = 1; $i <= 16; $i++) {
                                $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
                            }
                        }
                        
                        // Use hash to consistently assign a face
                        $faceIndex = abs(crc32($member->name)) % count($availableFaces);
                        $avatarUrl = $availableFaces[$faceIndex];
                        
                        // Check for user's actual profile photo first
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
                        <div class="text-sm text-gray-500">
                            @if($isCurrentlyWorking)
                                <span class="text-green-600"><i class="bi bi-circle-fill text-xs mr-1"></i>Currently working</span>
                            @else
                                Last active {{ rand(1, 3) }} hours ago
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-semibold text-gray-900">{{ $hoursWorked }}h</div>
                    <div class="text-sm text-gray-500">Today</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
