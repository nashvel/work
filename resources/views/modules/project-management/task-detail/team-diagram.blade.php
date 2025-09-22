{{-- Team Diagram Section --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200 w-full max-w-full">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <div class="w-1 h-6 bg-blue-500 rounded"></div>
                    Team Structure
                    <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $task->assignedUsers->count() }} members</span>
                </h3>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="exportTeamDiagram()" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                    <i class="bi bi-download"></i>
                    Export
                </button>
                <button onclick="openAssignmentModal()" class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all">
                    <i class="bi bi-person-plus"></i>
                    Add Member
                </button>
            </div>
        </div>
    </div>
    
    <div class="p-4">

    {{-- Team Diagram Container --}}
    <div id="teamDiagram" class="relative overflow-hidden">
        <div class="p-4">
            @php
                $taskLeader = $task->assignedUsers->where('pivot.role', 'lead')->first() ?? $task->assignedUsers->first();
                $teamMembers = $task->assignedUsers->where('pivot.role', '!=', 'lead');
                $colors = ['blue', 'green', 'purple', 'orange', 'pink', 'indigo'];
            @endphp

            {{-- Task Leader (Top Level) --}}
            @if($taskLeader)
            @php
                $leaderProgress = $taskLeader->pivot->progress ?? 75;
                $leaderHours = $taskLeader->pivot->hours_today ?? 0;
            @endphp
            <div class="flex flex-col items-center mb-12">
                <div class="relative">
                    @if($taskLeader->profile_photo_url)
                        <img src="{{ $taskLeader->profile_photo_url }}" alt="{{ $taskLeader->name }}" 
                             class="w-20 h-20 rounded-full object-cover shadow-lg border-4 border-blue-500">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ strtoupper(substr($taskLeader->name, 0, 2)) }}
                        </div>
                    @endif
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center">
                        <i class="bi bi-star-fill text-white text-xs"></i>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <div class="font-semibold text-gray-900">{{ $taskLeader->name }}</div>
                    <div class="text-sm text-blue-600 font-medium">{{ $taskLeader->pivot->role ?? 'Task Leader' }}</div>
                    <div class="text-xs text-gray-500 mt-1">
                        <i class="bi bi-clock mr-1"></i>{{ $leaderHours }}h today
                    </div>
                </div>
                
                {{-- Progress Ring --}}
                <div class="mt-2 relative w-12 h-12">
                    <svg class="w-12 h-12 transform -rotate-90" viewBox="0 0 36 36">
                        <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                        <path class="text-blue-500" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="{{ $leaderProgress }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-xs font-semibold text-gray-700">{{ $leaderProgress }}%</span>
                    </div>
                </div>

                {{-- Connection Line --}}
                @if($teamMembers->count() > 0)
                <div class="w-px h-8 bg-gray-300 mt-4"></div>
                @endif
            </div>
            @endif

            {{-- Team Members Grid --}}
            @if($teamMembers->count() > 0)
            <div class="flex justify-center">
                <div class="grid grid-cols-{{ min($teamMembers->count(), 6) }} gap-6">
                    @foreach($teamMembers as $index => $member)
                    @php
                        $memberColor = $colors[$index % count($colors)];
                        $workingHours = $member->pivot->hours_today ?? 0;
                        $progressPercent = $member->pivot->progress ?? 0;
                        $isOnline = $member->pivot->is_online ?? false;
                    @endphp
                    
                    <div class="flex flex-col items-center relative">
                        {{-- Connection Line to Leader --}}
                        @if($loop->first && $taskLeader)
                        <div class="absolute -top-8 left-1/2 w-px h-8 bg-gray-300"></div>
                        @endif
                        
                        {{-- Horizontal Connection Lines --}}
                        @if(!$loop->first && !$loop->last)
                        <div class="absolute -top-8 left-0 right-0 h-px bg-gray-300"></div>
                        @elseif($loop->first && $teamMembers->count() > 1)
                        <div class="absolute -top-8 left-1/2 right-0 h-px bg-gray-300"></div>
                        @elseif($loop->last && $teamMembers->count() > 1)
                        <div class="absolute -top-8 left-0 right-1/2 h-px bg-gray-300"></div>
                        @endif

                        <div class="relative">
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
                                 class="w-12 h-12 rounded-full object-cover shadow-md border-2 border-{{ $memberColor }}-500">
                            
                            {{-- Online Status --}}
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-{{ $isOnline ? 'green' : 'gray' }}-400 rounded-full border-2 border-white flex items-center justify-center">
                                <i class="bi bi-{{ $isOnline ? 'check' : 'dash' }} text-white text-xs"></i>
                            </div>
                        </div>
                        
                        <div class="mt-2 text-center">
                            <div class="font-medium text-gray-900 text-xs">{{ $member->name }}</div>
                            <div class="text-xs text-{{ $memberColor }}-600 font-medium">
                                {{ $member->pivot->role ?? 'Member' }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="bi bi-clock mr-1"></i>{{ $workingHours }}h today
                            </div>
                        </div>

                        {{-- Mini Progress Ring --}}
                        <div class="mt-2 relative w-10 h-10">
                            <svg class="w-10 h-10 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="4" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                                <path class="text-{{ $memberColor }}-500" stroke="currentColor" stroke-width="4" fill="none" stroke-dasharray="{{ $progressPercent }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xs font-semibold text-gray-700">{{ $progressPercent }}%</span>
                            </div>
                        </div>

                        {{-- Quick Actions --}}
                        <div class="mt-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button onclick="messageTeamMember('{{ $member->id }}')" class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-200 transition-all">
                                <i class="bi bi-chat text-xs"></i>
                            </button>
                            <button onclick="viewMemberDetails('{{ $member->id }}')" class="w-6 h-6 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-gray-200 transition-all">
                                <i class="bi bi-eye text-xs"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Empty State --}}
            @if($task->assignedUsers->count() === 0)
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-people text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Team Members Assigned</h3>
                <p class="text-gray-500 mb-4">Assign team members to see the organizational structure.</p>
                <button onclick="openAssignmentModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                    <i class="bi bi-person-plus mr-2"></i>Assign Team Members
                </button>
            </div>
            @endif
        </div>
    </div>

    {{-- Team Stats --}}
    @if($task->assignedUsers->count() > 0)
    @php
        $totalHours = $task->assignedUsers->sum('pivot.hours_today') ?: 0;
        $avgProgress = $task->assignedUsers->avg('pivot.progress') ?: 0;
        $activeToday = $task->assignedUsers->where('pivot.is_online', true)->count();
    @endphp
    <div class="mt-6 pt-6 border-t border-gray-200">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="text-3xl font-bold text-blue-600 mb-1">{{ $task->assignedUsers->count() }}</div>
                <div class="text-sm text-gray-600">Team Members</div>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-3xl font-bold text-green-600 mb-1">{{ $activeToday }}</div>
                <div class="text-sm text-gray-600">Active Today</div>
            </div>
            <div class="text-center p-4 bg-orange-50 rounded-lg">
                <div class="text-3xl font-bold text-orange-600 mb-1">{{ $totalHours }}h</div>
                <div class="text-sm text-gray-600">Total Hours</div>
            </div>
            <div class="text-center p-4 bg-purple-50 rounded-lg">
                <div class="text-3xl font-bold text-purple-600 mb-1">{{ round($avgProgress) }}%</div>
                <div class="text-sm text-gray-600">Avg Progress</div>
            </div>
        </div>
    </div>
    @endif
</div>
