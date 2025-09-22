{{-- Individual Task Row --}}
<div class="task-row border-b border-gray-100 px-4 py-3 hover:bg-gray-50 transition-all cursor-pointer" 
     data-task-id="{{ $taskId }}" 
     onclick="selectTask('{{ $taskId }}')">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 flex-1">
            {{-- Priority Stars --}}
            <div class="flex items-center gap-1">
                @for($i = 1; $i <= $priority; $i++)
                    <i class="bi bi-star-fill text-xs 
                        {{ $priority == 5 ? 'text-red-500' : 
                           ($priority == 4 ? 'text-orange-500' : 
                           ($priority == 3 ? 'text-yellow-500' : 
                           ($priority == 2 ? 'text-blue-500' : 'text-green-500'))) }}"></i>
                @endfor
                @for($i = $priority + 1; $i <= 5; $i++)
                    <i class="bi bi-star text-gray-300 text-xs"></i>
                @endfor
            </div>
            
            {{-- Task Name --}}
            <div class="flex-1">
                <div class="font-medium text-sm text-gray-900 truncate">{{ $taskName }}</div>
                <div class="flex items-center gap-2 mt-1">
                    {{-- Status Badge --}}
                    <span class="px-2 py-1 text-xs rounded-full 
                        {{ $status == 'done' ? 'bg-green-100 text-green-700' : 
                           ($status == 'in-progress' ? 'bg-blue-100 text-blue-700' : 
                           ($status == 'stuck' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) }}">
                        {{ ucfirst(str_replace('-', ' ', $status)) }}
                    </span>
                    
                    {{-- Progress Indicator --}}
                    <div class="flex items-center gap-1">
                        <div class="w-12 h-1 bg-gray-200 rounded-full">
                            <div class="h-1 rounded-full 
                                {{ $status == 'done' ? 'bg-green-500' : 
                                   ($status == 'stuck' ? 'bg-red-500' : 'bg-blue-500') }}" 
                                 style="width: {{ $progress }}%"></div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $progress }}%</span>
                    </div>
                    
                    {{-- Dependencies Indicator --}}
                    @if(!empty($dependencies))
                        <div class="flex items-center gap-1">
                            <i class="bi bi-link-45deg text-orange-500 text-xs"></i>
                            <span class="text-xs text-orange-600">{{ count($dependencies) }} dep.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Action Buttons --}}
        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-all">
            <button onclick="editTask('{{ $taskId }}')" class="p-1 text-gray-400 hover:text-blue-600 transition-all">
                <i class="bi bi-pencil text-xs"></i>
            </button>
            <button onclick="assignTask('{{ $taskId }}')" class="p-1 text-gray-400 hover:text-green-600 transition-all">
                <i class="bi bi-person-plus text-xs"></i>
            </button>
        </div>
    </div>
</div>