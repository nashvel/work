 <div class="px-3 pt-3 flex justify-between items-center">
     <div>
         <h3 class="text-2xl leading-6 font-medium text-gray-900"><strong>Tasks Management</strong></h3>
         <p class="mt-1 max-w-2xl text-sm text-gray-500">Comprehensive task tracking and management.</p>
     </div>
     <a href="{{ route('projects.tasks.create', $project) }}" class=" text-dark border  py-2 px-4 rounded-lg">
         <span class="bi bi-plus-lg"></span>
         Add Task
     </a>
 </div>
 <div class="overflow-x-auto mb-5 pt-6">
     @php
         $tasks = $project->tasks()->with(['assignedUser', 'creator'])->orderBy('order')->get();
         $users = $project->teamMembers;
     @endphp
     <div class="overflow-x-auto rounded-lg border border-gray-200">
         <h4 class="text-lg font-semibold text-gray-900 mb-4 mx-4 mt-4 float-start">To Do List</h4>
         <table class="min-w-full divide-y divide-gray-200">
             <thead class="bg-gray-50">
                 <tr class="bg-gray-100 text-left">
                     <th class="px-6 py-3 text-left  text-xs font-semibold text-gray-700 uppercase w-8">Done</th>
                     <th class="px-6 py-3 text-left  text-xs font-semibold text-gray-700 uppercase">Title</th>
                     <th class="px-6 py-3 text-left  text-xs font-semibold text-gray-700 uppercase w-55" width="150">
                         Priority</th>
                     <th class="px-6 py-3 text-left  text-xs font-semibold text-gray-700 uppercase w-40">Due Date</th>
                     <th class="px-6 py-3 text-left  text-xs font-semibold text-gray-700 uppercase w-40" width="150">Status</th>
                     <th class="px-6 py-3 text-left  text-xs font-semibold text-gray-700 uppercase w-24" width="50">
                         Action</th>
                 </tr>
             </thead>
             <tbody id="task-list">
                 @foreach ($tasks as $task)
                     <tr data-id="{{ $task->id }}" class="border border-gray-300">

                         {{-- Checkbox --}}
                         <td class="p-0 text-center border">
                             <input type="checkbox" class="form-check-input mx-3"
                                 {{ $task->status === 'completed' ? 'checked' : '' }}
                                 onchange="toggleTaskStatus(this, {{ $task->id }})" />
                         </td>

                         {{-- Title --}}
                         <td>
                             <div class="relative p-1">
                                 <input type="text"
                                     class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark !focus:border-primary"
                                     value="{{ $task->title }}" onblur="saveTask(this, {{ $task->id }})"
                                     placeholder="Task title...">
                                 <div
                                     class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                     <i class="bi bi-info-circle"></i>
                                 </div>
                             </div>
                         </td>

                         {{-- Priority --}}
                         <td>
                             <div class="relative p-1">
                                 <select
                                     class="ti-form-input rounded-sm focus:z-10 cell text-dark !focus:border-primary w-full ps-11"
                                     onchange="saveTaskField(this, {{ $task->id }}, 'priority')">
                                     <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low
                                     </option>
                                     <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium
                                     </option>
                                     <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High
                                     </option>
                                 </select>
                                 <div
                                     class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                     <i class="bi bi-ui-checks-grid"></i>
                                 </div>
                             </div>
                         </td>


                         {{-- Due Date --}}
                         <td>
                             <div class="relative p-1">
                                 <input type="date"
                                     class="ti-form-input rounded-sm focus:z-10 cell text-dark !focus:border-primary w-full ps-11"
                                     value="{{ $task->due_date }}"
                                     onchange="saveTaskField(this, {{ $task->id }}, 'due_date')" />
                                 <div
                                     class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                     <i class="bi bi-calendar-event"></i>
                                 </div>
                             </div>
                         </td>

                         {{-- Status --}}
                         <td>
                             <div class="relative p-1">
                                 <select
                                     class="ti-form-input rounded-sm focus:z-10 cell text-dark !focus:border-primary w-full ps-11"
                                     onchange="saveTaskField(this, {{ $task->id }}, 'status')">
                                     <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>
                                         To Do
                                     </option>
                                     <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>
                                         In Progress
                                     </option>
                                     <option value="review" {{ $task->status === 'review' ? 'selected' : '' }}>
                                         Review
                                     </option>
                                     <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>
                                         Completed
                                     </option>
                                     <option value="cancelled" {{ $task->status === 'cancelled' ? 'selected' : '' }}>
                                         Cancelled
                                     </option>
                                 </select>
                                 <div
                                     class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                     <i class="bi bi-bookmark-star"></i>
                                 </div>
                             </div>
                         </td>

                         <td>
                             <div class="hstack gap-1 text-[.9375rem]">
                                 <center>
                                     <span class="custom-tooltip">
                                         <a onclick="remove_data({{ $task->id }}, 'task')"
                                             href="javascript:void(0);"
                                             class="ti-btn ti-btn-sm ti-btn-danger">
                                             <i class="bi bi-trash"></i>
                                         </a>
                                     </span>

                                 </center>
                             </div>
                         </td>
                     </tr>
                 @endforeach

                 <tr>
                     <td class="text-center">
                         <center>
                             <button class="ti-btn ti-btn-light ti-btn-xs" onclick="alert('Add new task functionality will be implemented soon');">
                                <span class="bi bi-plus-lg text-success" style="font-weight: bold;"></span>
                            </button>
                         </center>
                     </td>
                     <td colspan="5" class="p-2">
                         <input type="text" class="w-full p-2 border rounded" onblur="createQuickTask(this)"
                             placeholder="Quick add task (press Enter or click away)" />
                     </td>
                 </tr>
             </tbody>
         </table>
     </div>
 </div>

<script>
function createQuickTask(input) {
    const title = input.value.trim();
    if (!title) return;
    
    const formData = new FormData();
    formData.append('title', title);
    formData.append('status', 'todo');
    formData.append('priority', 'medium');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    fetch('{{ route("projects.tasks.store", $project) }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.value = '';
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while creating the task.');
    });
}

function toggleTaskStatus(checkbox, taskId) {
    const status = checkbox.checked ? 'completed' : 'todo';
    
    fetch(`/projects/tasks/${taskId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            checkbox.checked = !checkbox.checked;
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        checkbox.checked = !checkbox.checked;
        alert('An error occurred while updating the task.');
    });
}

function saveTask(input, taskId) {
    const title = input.value.trim();
    if (!title) return;
    
    fetch(`/projects/tasks/${taskId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ title: title })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the task.');
    });
}

function saveTaskField(select, taskId, field) {
    const value = select.value;
    
    fetch(`/projects/tasks/${taskId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ [field]: value })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the task.');
    });
}

function remove_data(taskId, type) {
    if (confirm('Are you sure you want to delete this task?')) {
        fetch(`/projects/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the task.');
        });
    }
}
</script>
