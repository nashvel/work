{{-- Enhanced Task Row --}}
<div class="grid grid-cols-12 gap-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-all group min-w-max task-row" data-task-id="{{ $task['id'] }}">
    {{-- Task Name with Checkbox --}}
    <div class="col-span-3">
        <div class="flex items-center gap-2">
            <input type="checkbox" class="task-checkbox rounded border-gray-300" data-task-id="{{ $task['id'] }}" onchange="handleTaskSelection()">
            <div class="flex items-center gap-2">
                @if(isset($task['dependencies']) && count($task['dependencies']) > 0)
                    <i class="bi bi-link-45deg text-orange-500" title="Has dependencies"></i>
                @endif
                <div>
                    <a href="{{ route('projects.tasks.detail', ['project' => request()->route('project') ?? 1, 'task' => str_replace('task-', '', $task['id'])]) }}" 
                       class="font-medium text-gray-900 hover:text-blue-600 transition-colors cursor-pointer">
                        {{ $task['name'] }}
                    </a>
                    @if(isset($task['description']))
                        <div class="text-xs text-gray-500 mt-1">{{ $task['description'] }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-2">
        <div class="flex items-center gap-1 -space-x-2">
            @foreach($task['assignees'] as $assignee)
                <div class="relative group">
                    @php
                        // Get user avatar with profile photo fallback
                        $user = \App\Models\User::where('name', $assignee['name'])->first();
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
                        $faceIndex = abs(crc32($assignee['name'])) % count($availableFaces);
                        $avatarUrl = $availableFaces[$faceIndex];
                        
                        // Check for user's actual profile photo first
                        if ($user && $user->profile_photo_path) {
                            $profilePath = public_path('storage/' . $user->profile_photo_path);
                            if (file_exists($profilePath) && is_readable($profilePath)) {
                                $avatarUrl = '/storage/' . $user->profile_photo_path;
                            }
                        }
                    @endphp
                    <img src="{{ $avatarUrl }}" 
                         class="w-8 h-8 rounded-full border-2 border-white hover:scale-110 transition-transform cursor-pointer" 
                         alt="{{ $assignee['name'] }}"
                         title="{{ $assignee['name'] }} - {{ $assignee['role'] }}">

                    @if($assignee['has_notification'])
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border border-white"></div>
                    @endif
                </div>
            @endforeach
            <button onclick="assignMorePeople('{{ $task['id'] }}')" class="w-8 h-8 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center hover:border-blue-500 hover:bg-blue-50 transition-all">
                <i class="bi bi-plus text-gray-400 text-xs"></i>
            </button>
        </div>
    </div>

    <div class="col-span-1">
        <div class="flex items-center cursor-pointer" onclick="changePriority('{{ $task['id'] }}')">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $task['priority'])
                    <i class="bi bi-star-fill text-xs 
                        {{ $task['priority'] == 5 ? 'text-red-500' : 
                           ($task['priority'] == 4 ? 'text-orange-500' : 
                           ($task['priority'] == 3 ? 'text-yellow-500' : 
                           ($task['priority'] == 2 ? 'text-blue-500' : 'text-green-500'))) }}"></i>
                @else
                    <i class="bi bi-star text-gray-300 text-xs"></i>
                @endif
            @endfor
        </div>
    </div>

    <div class="col-span-2">
        <div class="space-y-1">
            <div class="text-sm text-gray-600">{{ $task['timeline']['dates'] }}</div>
            <div class="w-full bg-gray-200 rounded-full h-2 relative">
                <div class="bg-{{ $task['timeline']['color'] }}-500 h-2 rounded-full transition-all" style="width: {{ $task['progress'] }}%"></div>
                @if($task['is_overdue'])
                    <div class="absolute -right-1 -top-1 w-3 h-3 bg-red-500 rounded-full border border-white"></div>
                @endif
            </div>
            <div class="text-xs text-gray-500">{{ $task['progress'] }}% complete</div>
        </div>
    </div>
    

    <div class="col-span-1">
        <div class="text-sm {{ $task['is_overdue'] ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
            {{ $task['due_date'] }}
            @if($task['is_overdue'])
                <i class="bi bi-exclamation-triangle-fill text-red-500 ml-1"></i>
            @endif
        </div>
    </div>
    
    <div class="col-span-2">
        <div class="flex items-center gap-1">
            <div class="relative">
                <select onchange="updateTaskStatus('{{ $task['id'] }}', this.value)" 
                        class="pr-2 pl-2 py-1 text-xs rounded-full bg-{{ $task['status']['color'] }}-100 text-{{ $task['status']['color'] }}-800 border-0 focus:ring-2 focus:ring-{{ $task['status']['color'] }}-500 appearance-none whitespace-nowrap"
                        style="-webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: none; width: auto; min-width: max-content;">
                    <option value="not-started" {{ $task['status']['text'] == 'Not started' ? 'selected' : '' }}>Not started</option>
                    <option value="working" {{ $task['status']['text'] == 'Working on it' || $task['status']['text'] == 'In progress' ? 'selected' : '' }}>Working on it</option>
                    <option value="stuck" {{ $task['status']['text'] == 'Stuck' ? 'selected' : '' }}>Stuck</option>
                    <option value="done" {{ $task['status']['text'] == 'Done' || $task['status']['text'] == 'Completed' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="col-span-1">
        @if(isset($task['dependencies']) && count($task['dependencies']) > 0)
            <div class="flex items-center gap-1">
                @foreach($task['dependencies'] as $dep)
                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-full border" title="Depends on: {{ $dep['name'] }}">
                        {{ $dep['short_name'] }}
                    </span>
                @endforeach
                <button onclick="manageDependencies('{{ $task['id'] }}')" class="text-xs text-blue-600 hover:text-blue-800">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        @else
            <button onclick="manageDependencies('{{ $task['id'] }}')" class="text-xs text-gray-400 hover:text-blue-600">
                <i class="bi bi-plus-circle"></i> Add
            </button>
        @endif
    </div>
</div>