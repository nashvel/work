<div class="box task-card" data-status="{{ $task->status }}" data-priority="{{ $task->priority }}">
    <div class="box-body">
        <div class="flex justify-between items-start mb-3">
            <div class="flex-1">
                <h6 class="font-medium text-gray-900 mb-1">{{ Str::limit($task->title, 50) }}</h6>
                @if($task->project)
                    <p class="text-xs text-gray-500 mb-1">
                        <i class="bi bi-folder me-1"></i>{{ Str::limit($task->project->name, 30) }}
                    </p>
                @endif
            </div>
            <span class="badge 
                @if($task->priority === 'high') bg-danger/10 text-danger
                @elseif($task->priority === 'medium') bg-warning/10 text-warning  
                @else bg-success/10 text-success @endif text-xs px-2 py-1">
                {{ ucfirst($task->priority) }}
            </span>
        </div>
        
        @if($task->description)
            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($task->description, 100) }}</p>
        @endif
        
        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
            @if($task->due_date)
                <span class="flex items-center">
                    <i class="bi bi-calendar me-1"></i>
                    Due {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                </span>
            @endif
            @if($task->estimated_hours)
                <span class="flex items-center">
                    <i class="bi bi-clock me-1"></i>
                    {{ $task->estimated_hours }}h
                </span>
            @endif
        </div>
        
        <div class="flex justify-between items-center">
            @php
                $statusClasses = match($task->status) {
                    'completed' => 'bg-success/10 text-success',
                    'in_progress' => 'bg-primary/10 text-primary',
                    'pending' => 'bg-warning/10 text-warning',
                    'on_hold' => 'bg-secondary/10 text-secondary',
                    default => 'bg-gray-100 text-gray-700'
                };
                $statusText = match($task->status) {
                    'in_progress' => 'In Progress',
                    'on_hold' => 'On Hold',
                    default => ucfirst($task->status)
                };
            @endphp
            <span class="badge {{ $statusClasses }} text-xs px-2 py-1">
                {{ $statusText }}
            </span>
            
            <div class="flex gap-1">
                @if($task->status !== 'completed')
                    <button onclick="updateTaskStatus({{ $task->id }}, 'in_progress')" 
                            class="ti-btn ti-btn-xs ti-btn-primary-full" title="Start Task">
                        <i class="bi bi-play-circle"></i>
                    </button>
                    <button onclick="updateTaskStatus({{ $task->id }}, 'completed')" 
                            class="ti-btn ti-btn-xs ti-btn-success-full" title="Mark Complete">
                        <i class="bi bi-check-circle"></i>
                    </button>
                @endif
                <button class="ti-btn ti-btn-xs ti-btn-light" title="View Details">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        
        @if(isset($task->progress) && $task->progress > 0)
            <div class="mt-3">
                <div class="flex justify-between text-xs text-gray-600 mb-1">
                    <span>Progress</span>
                    <span>{{ $task->progress }}%</span>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-primary" style="width: {{ $task->progress }}%"></div>
                </div>
            </div>
        @endif
    </div>
</div>
