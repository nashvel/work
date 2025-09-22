{{-- Individual Task Bar --}}
<div class="task-bar absolute h-6 rounded-lg cursor-pointer transition-all hover:shadow-md hover:z-10 group" 
     style="left: {{ $startPercent }}%; width: {{ $widthPercent }}%;"
     data-task-id="{{ $taskId }}"
     onclick="selectTaskBar('{{ $taskId }}')"
     onmousedown="startDragTaskBar(event, '{{ $taskId }}')"
     draggable="false">
    
    {{-- Main Task Bar --}}
    <div class="task-bar-main h-full rounded-lg relative overflow-hidden 
        {{ $color == 'green' ? 'bg-green-500' : 
           ($color == 'blue' ? 'bg-blue-500' : 
           ($color == 'pink' ? 'bg-pink-500' : 
           ($color == 'red' ? 'bg-red-500' : 
           ($color == 'purple' ? 'bg-purple-500' : 'bg-gray-400')))) }}
        {{ $status == 'stuck' ? 'animate-pulse' : '' }}">
        
        {{-- Progress Fill --}}
        @if($progress > 0)
            <div class="progress-fill absolute top-0 left-0 h-full bg-white bg-opacity-30 rounded-lg transition-all" 
                 style="width: {{ $progress }}%;"></div>
        @endif
        
        {{-- Task Bar Content --}}
        <div class="task-bar-content absolute inset-0 flex items-center justify-between px-2 text-white text-xs font-medium">
            <span class="truncate">{{ $progress }}%</span>
            @if($status == 'stuck')
                <i class="bi bi-exclamation-triangle text-yellow-300"></i>
            @elseif($status == 'done')
                <i class="bi bi-check-circle"></i>
            @endif
        </div>
        
        {{-- Resize Handles --}}
        <div class="resize-handle-left absolute left-0 top-0 w-1 h-full cursor-ew-resize opacity-0 group-hover:opacity-100 bg-white bg-opacity-50 transition-all"
             onmousedown="startResizeTaskBar(event, '{{ $taskId }}', 'left')"></div>
        <div class="resize-handle-right absolute right-0 top-0 w-1 h-full cursor-ew-resize opacity-0 group-hover:opacity-100 bg-white bg-opacity-50 transition-all"
             onmousedown="startResizeTaskBar(event, '{{ $taskId }}', 'right')"></div>
    </div>
    
    {{-- Task Bar Tooltip (Hidden by default) --}}
    <div class="task-bar-tooltip absolute bottom-8 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-xs rounded-lg px-3 py-2 opacity-0 group-hover:opacity-100 transition-all z-20 whitespace-nowrap">
        <div class="font-medium">Task {{ $taskId }}</div>
        <div>Progress: {{ $progress }}%</div>
        <div>Status: {{ ucfirst($status) }}</div>
        {{-- Tooltip Arrow --}}
        <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
    </div>
</div>