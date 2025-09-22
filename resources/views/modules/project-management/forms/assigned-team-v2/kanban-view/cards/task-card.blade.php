<div class="kanban-card bg-white border border-{{ $status['color'] == 'green' ? 'green' : ($status['color'] == 'blue' ? 'blue' : 'gray') }}-200 rounded-lg p-3 cursor-move shadow-sm hover:shadow-md transition-all" 
     draggable="true" 
     ondragstart="dragTask(event)" 
     data-task-id="{{ $taskId }}">
    <div class="flex items-start justify-between mb-2">
        <h5 class="font-medium text-sm text-gray-900 line-clamp-2">{{ $title }}</h5>
        <div class="flex items-center gap-1">
            @php
                $priorityColor = match($priority) {
                    5 => 'text-red-500',      // Critical - Red
                    4 => 'text-orange-500',   // High - Orange  
                    3 => 'text-yellow-500',   // Medium - Yellow
                    2 => 'text-blue-500',     // Low - Blue
                    default => 'text-gray-400' // Default - Gray
                };
            @endphp
            @for($i = 1; $i <= $priority; $i++)
                <i class="bi bi-star-fill {{ $priorityColor }} text-xs"></i>
            @endfor
            @for($i = $priority + 1; $i <= 5; $i++)
                <i class="bi bi-star text-gray-300 text-xs"></i>
            @endfor
        </div>
    </div>
    
    <p class="text-xs text-gray-600 mb-3">{{ $description }}</p>
    
    @if($progress !== null)
        <div class="mb-3">
            <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
                <span>Progress</span>
                <span>{{ $progress }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-{{ $status['color'] == 'red' ? 'red' : ($status['color'] == 'green' ? 'green' : 'blue') }}-500 h-2 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
        </div>
    @endif
    
    <div class="flex items-center justify-between">
        <div class="flex -space-x-1 cursor-pointer" onclick="event.stopPropagation(); openPeopleAssignmentModal('{{ $taskId }}')">
            @if(empty($assignees))
                <span class="inline-block w-6 h-6 bg-gray-400 rounded-full text-xs text-white flex items-center justify-center border-2 border-white hover:bg-gray-500 transition-colors">
                    <i class="bi bi-plus text-xs"></i>
                </span>
            @else
                {{-- Debug: Show assignees count --}}
                @php \Log::info("Task Card {$taskId}: Rendering " . count($assignees) . " assignees", $assignees); @endphp
                @foreach($assignees as $assignee)
                    @php \Log::info("Task Card {$taskId}: Rendering assignee", $assignee); @endphp
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($assignee['name']) }}&size=24&background={{ $assignee['color'] }}&color=fff" 
                         class="w-6 h-6 rounded-full border-2 border-white hover:scale-110 transition-transform" 
                         alt="{{ $assignee['name'] }}"
                         title="{{ $assignee['name'] }}">
                @endforeach
                <span class="inline-block w-6 h-6 bg-blue-500 rounded-full text-xs text-white flex items-center justify-center border-2 border-white hover:bg-blue-600 transition-colors">
                    <i class="bi bi-plus text-xs"></i>
                </span>
            @endif
        </div>
        <span class="px-2 py-1 text-xs bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-700 rounded-full">{{ $status['text'] }}</span>
    </div>
</div>