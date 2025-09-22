{{-- New Task Row Template - Blade Version --}}
<div class="grid grid-cols-12 gap-4 py-3 border-b border-gray-100 hover:bg-gray-50 items-center task-row editable-task-row" 
     data-task-id="new-task-{{ uniqid() }}" 
     data-status="todo" 
     style="background-color: #f0f9ff;">
     
    {{-- Task Name (no checkbox, just space) --}}
    <div class="col-span-3">
        <div class="flex items-center gap-2">
            <div class="w-4 h-4"></div> {{-- Empty space where checkbox would be --}}
            <div class="flex-1">
                <input type="text" 
                       class="font-medium text-gray-900 bg-transparent border-b-2 border-blue-400 focus:border-blue-600 focus:outline-none px-1 py-1 w-full" 
                       placeholder="Enter task name..."
                       name="task_name">
                <input type="text" 
                       class="text-xs text-gray-500 mt-1 bg-transparent border-b border-gray-300 focus:border-blue-400 focus:outline-none px-1 w-full" 
                       placeholder="Add description (optional)..."
                       name="task_description">
            </div>
        </div>
    </div>


    {{-- Due Date --}}
    <div class="col-span-4">
        <div class="text-sm text-gray-600">
            <label class="text-xs text-gray-500 mb-1 block">Due Date:</label>
            <input type="date" 
                   name="due_date" 
                   class="text-sm text-gray-600 bg-transparent border-b border-gray-300 focus:border-blue-400 focus:outline-none w-full" 
                   value="{{ date('Y-m-d', strtotime('+7 days')) }}">
        </div>
    </div>

    
    {{-- Status --}}
    <div class="col-span-3">
        <select name="status" 
                class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 border border-gray-300 focus:ring-2 focus:ring-gray-500 w-full">
            <option value="todo" selected>Not started</option>
            <option value="in_progress">Working on it</option>
            <option value="review">Stuck</option>
            <option value="completed">Done</option>
        </select>
    </div>
    
    {{-- Actions --}}
    <div class="col-span-2">
        <div class="flex items-center gap-1">
            <button onclick="saveTaskFromBlade(this)" 
                    class="px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700 transition-all">
                <i class="bi bi-check"></i>
            </button>
            <button onclick="cancelTaskFromBlade(this)" 
                    class="px-2 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600 transition-all">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>
</div>

