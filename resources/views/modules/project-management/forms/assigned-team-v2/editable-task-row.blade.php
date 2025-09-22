{{-- Editable Task Row Template for New Tasks --}}
<div class="grid grid-cols-12 gap-4 py-3 border-b border-gray-100 bg-blue-50 items-center task-row editable-task-row" data-task-id="new-task-{{ uniqid() }}" data-status="{{ $status ?? 'working' }}">
    {{-- Task Name with Checkbox --}}
    <div class="col-span-3">
        <div class="flex items-center gap-2">
            <input type="checkbox" class="task-checkbox rounded border-gray-300" disabled>
            <div class="flex items-center gap-2 w-full">
                <div class="w-full">
                    <input type="text" 
                           class="w-full font-medium text-gray-900 bg-transparent border-b border-blue-300 focus:border-blue-500 focus:outline-none px-1 py-1" 
                           placeholder="Enter task name..."
                           name="task_name">
                    <input type="text" 
                           class="w-full text-xs text-gray-500 mt-1 bg-transparent border-b border-gray-200 focus:border-blue-300 focus:outline-none px-1" 
                           placeholder="Add description (optional)..."
                           name="task_description">
                </div>
            </div>
        </div>
    </div>

    {{-- People Assignment --}}
    <div class="col-span-2">
        <div class="flex items-center gap-1">
            <select name="assigned_to" 
                    class="text-xs border border-gray-300 rounded px-2 py-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Unassigned</option>
                @if(isset($project) && $project->teamMembers)
                    @foreach($project->teamMembers as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- Priority --}}
    <div class="col-span-1">
        <select name="priority" 
                class="text-xs border border-gray-300 rounded px-1 py-1 focus:ring-2 focus:ring-blue-500">
            <option value="1">⭐</option>
            <option value="2">⭐⭐</option>
            <option value="3" selected>⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
        </select>
    </div>

    {{-- Timeline --}}
    <div class="col-span-2">
        <div class="space-y-1">
            <div class="flex gap-1">
                <input type="date" 
                       name="start_date" 
                       class="text-xs border border-gray-300 rounded px-1 py-1 focus:ring-2 focus:ring-blue-500 w-full"
                       value="{{ date('Y-m-d') }}">
                <input type="date" 
                       name="due_date" 
                       class="text-xs border border-gray-300 rounded px-1 py-1 focus:ring-2 focus:ring-blue-500 w-full"
                       value="{{ date('Y-m-d', strtotime('+7 days')) }}">
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
            </div>
            <div class="text-xs text-gray-500">0% complete</div>
        </div>
    </div>

    {{-- Due Date --}}
    <div class="col-span-1">
        <input type="number" 
               name="estimated_hours" 
               class="text-xs border border-gray-300 rounded px-1 py-1 focus:ring-2 focus:ring-blue-500 w-full" 
               placeholder="Hours"
               min="0"
               step="0.5">
    </div>
    
    {{-- Status --}}
    <div class="col-span-1">
        <div class="flex items-center gap-1">
            <select name="status" 
                    class="px-2 py-1 text-xs rounded-full bg-orange-100 text-orange-800 border border-orange-300 focus:ring-2 focus:ring-orange-500">
                <option value="todo" {{ ($status ?? 'working') == 'Not started' ? 'selected' : '' }}>Not started</option>
                <option value="in_progress" {{ ($status ?? 'working') == 'Working on it' ? 'selected' : '' }}>Working on it</option>
                <option value="review" {{ ($status ?? 'working') == 'Stuck' ? 'selected' : '' }}>Stuck</option>
                <option value="completed" {{ ($status ?? 'working') == 'Done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>
    </div>
    
    {{-- Actions --}}
    <div class="col-span-2">
        <div class="flex items-center gap-2">
            <button onclick="saveTaskInline(this)" 
                    class="px-3 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700 transition-all">
                <i class="bi bi-check"></i> Save
            </button>
            <button onclick="cancelNewTask(this)" 
                    class="px-3 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600 transition-all">
                <i class="bi bi-x"></i> Cancel
            </button>
        </div>
    </div>
</div>

{{-- Inline JavaScript for task creation --}}
<script>
function saveTaskInline(button) {
    const row = button.closest('.editable-task-row');
    if (!row) return;
    
    const taskName = row.querySelector('input[name="task_name"]').value.trim();
    if (!taskName) {
        alert('Please enter a task name');
        return;
    }
    
    // Get project ID from URL
    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    const projectId = projectIndex !== -1 ? urlParts[projectIndex + 1] : null;
    
    if (!projectId) {
        alert('Project ID not found');
        return;
    }
    
    // Collect form data
    const formData = new FormData();
    formData.append('title', taskName);
    formData.append('description', row.querySelector('input[name="task_description"]')?.value || '');
    formData.append('assigned_to', row.querySelector('select[name="assigned_to"]')?.value || '');
    formData.append('priority', row.querySelector('select[name="priority"]')?.value || 'medium');
    formData.append('start_date', row.querySelector('input[name="start_date"]')?.value || '');
    formData.append('due_date', row.querySelector('input[name="due_date"]')?.value || '');
    formData.append('estimated_hours', row.querySelector('input[name="estimated_hours"]')?.value || '0');
    formData.append('status', row.querySelector('select[name="status"]')?.value || 'todo');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Show loading state
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';
    button.disabled = true;
    
    // Submit to server
    fetch(`/projects/${projectId}/tasks`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the editable row and reload to show the new task
            row.remove();
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Failed to create task'));
            button.innerHTML = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error creating task');
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

function cancelNewTask(button) {
    const row = button.closest('.editable-task-row');
    if (row) {
        row.remove();
    }
}
</script>
