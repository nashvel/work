// Task Creation Functions
// Excel-like inline task creation functions
window.addTaskInStatus = function(status) {
    console.log('Adding new task with status:', status);
    
    // Find the section where this status exists
    const taskRows = document.querySelectorAll('.task-row');
    let targetSection = null;
    
    // Find a row with the same status to insert after
    for (let row of taskRows) {
        const statusSelect = row.querySelector('select[onchange*="updateTaskStatus"]');
        if (statusSelect) {
            const selectedOption = statusSelect.options[statusSelect.selectedIndex];
            if (selectedOption && selectedOption.text === status) {
                targetSection = row.parentElement;
                break;
            }
        }
    }
    
    // If no section found, use the first available section
    if (!targetSection) {
        targetSection = document.querySelector('.space-y-1');
    }
    
    if (targetSection) {
        // Create new editable row
        const newRowHtml = createEditableTaskRow(status);
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = newRowHtml;
        const newRow = tempDiv.firstElementChild;
        
        // Insert the new row
        targetSection.appendChild(newRow);
        
        // Focus on the task name input
        const taskNameInput = newRow.querySelector('input[name="task_name"]');
        if (taskNameInput) {
            taskNameInput.focus();
        }
    }
}

function createEditableTaskRow(status) {
    const uniqueId = 'new-task-' + Date.now();
    const statusMapping = {
        'Not started': 'todo',
        'Working on it': 'in_progress',
        'Stuck': 'review',
        'Done': 'completed'
    };
    
    const statusValue = statusMapping[status] || 'in_progress';
    const statusColor = {
        'todo': 'gray',
        'in_progress': 'orange',
        'review': 'yellow',
        'completed': 'green'
    }[statusValue] || 'orange';
    
    return `
    <div class="grid grid-cols-12 gap-4 py-3 border-b border-gray-100 bg-blue-50 items-center task-row editable-task-row" data-task-id="${uniqueId}" data-status="${statusValue}">
        <div class="col-span-3">
            <div class="flex items-center gap-2">
                <input type="checkbox" class="task-checkbox rounded border-gray-300" disabled>
                <div class="flex items-center gap-2 w-full">
                    <div class="w-full">
                        <input type="text" 
                               class="w-full font-medium text-gray-900 bg-transparent border-b border-blue-300 focus:border-blue-500 focus:outline-none px-1 py-1" 
                               placeholder="Enter task name..."
                               name="task_name"
                               onblur="saveNewTask(this)"
                               onkeypress="handleTaskNameEnter(event, this)">
                        <input type="text" 
                               class="w-full text-xs text-gray-500 mt-1 bg-transparent border-b border-gray-200 focus:border-blue-300 focus:outline-none px-1" 
                               placeholder="Add description (optional)..."
                               name="task_description">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-2">
            <div class="flex items-center gap-1 -space-x-2">
                <input type="text" 
                       name="assigned_to" 
                       class="text-xs bg-transparent focus:outline-none px-1 py-1 w-full" 
                       placeholder="Type @ to assign..."
                       onkeyup="handlePersonAssignment(event, this)"
                       onfocus="showPersonSuggestions(this)"
                       onblur="hidePersonSuggestions(this)">
                <button onclick="assignMorePeople('${uniqueId}')" class="w-8 h-8 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center hover:border-blue-500 hover:bg-blue-50 transition-all ml-2">
                    <i class="bi bi-plus text-gray-400 text-xs"></i>
                </button>
            </div>
        </div>

        <div class="col-span-1">
            <div class="flex items-center cursor-pointer" onclick="changePriority('${uniqueId}')">
                <i class="bi bi-star-fill text-xs text-yellow-500"></i>
                <i class="bi bi-star-fill text-xs text-yellow-500"></i>
                <i class="bi bi-star-fill text-xs text-yellow-500"></i>
                <i class="bi bi-star text-gray-300 text-xs"></i>
                <i class="bi bi-star text-gray-300 text-xs"></i>
            </div>
        </div>

        <div class="col-span-2">
            <div class="space-y-1">
                <div class="flex gap-1">
                    <input type="date" name="start_date" class="text-xs border border-gray-300 rounded px-1 py-1 focus:ring-2 focus:ring-blue-500 w-full" value="${new Date().toISOString().split('T')[0]}">
                    <input type="date" name="due_date" class="text-xs border border-gray-300 rounded px-1 py-1 focus:ring-2 focus:ring-blue-500 w-full" value="${new Date(Date.now() + 7*24*60*60*1000).toISOString().split('T')[0]}">
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
                </div>
                <div class="text-xs text-gray-500">0% complete</div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="text-sm text-gray-600">
                <input type="date" 
                       name="due_date" 
                       class="text-sm text-gray-600 bg-transparent border-b border-gray-300 focus:border-blue-400 focus:outline-none" 
                       value="${new Date(Date.now() + 7*24*60*60*1000).toISOString().split('T')[0]}">
            </div>
        </div>
        
        <div class="col-span-1">
            <div class="flex items-center gap-1">
                <select name="status" onchange="updateNewTaskProgress('${uniqueId}', this.value)" 
                        class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 border-0 focus:ring-2 focus:ring-gray-500">
                    <option value="not-started" selected>Not started</option>
                    <option value="working">Working on it</option>
                    <option value="stuck">Stuck</option>
                    <option value="done">Done</option>
                </select>
                <button onclick="addTaskInStatus('Not started')" 
                        class="w-5 h-5 rounded-full bg-gray-200 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all" 
                        title="Add new task with Not started status">
                    <i class="bi bi-plus text-xs"></i>
                </button>
            </div>
        </div>
        
        <div class="col-span-2">
            <div class="flex items-center gap-2">
                <button onclick="manageDependencies('${uniqueId}')" class="text-xs text-gray-400 hover:text-blue-600">
                    <i class="bi bi-plus-circle"></i> Add
                </button>
                <button onclick="saveNewTask(this)" class="px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700 transition-all">
                    <i class="bi bi-check"></i>
                </button>
                <button onclick="cancelNewTask(this)" class="px-2 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600 transition-all">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
    </div>`;
}

// Main Add Task function - creates empty row at bottom
window.addNewEmptyTask = function() {
    console.log('Adding new empty task row...');
    
    // Find the task container (space-y-1 div)
    const taskContainer = document.querySelector('.space-y-1');
    if (!taskContainer) {
        console.error('Task container not found');
        return;
    }
    
    // Create completely empty editable row
    const newRowHtml = createEmptyTaskRow();
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = newRowHtml;
    const newRow = tempDiv.firstElementChild;
    
    // Add to bottom of task list
    taskContainer.appendChild(newRow);
    
    // Focus on the task name input
    const taskNameInput = newRow.querySelector('input[name="task_name"]');
    if (taskNameInput) {
        taskNameInput.focus();
    }
    
    // Scroll to the new row
    newRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function createEmptyTaskRow() {
    const uniqueId = 'new-task-' + Date.now();
    const todayFormatted = new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    const nextWeekFormatted = new Date(Date.now() + 7*24*60*60*1000).toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    
    return `
    <div class="grid grid-cols-12 gap-4 py-3 border-b border-gray-100 hover:bg-gray-50 items-center task-row editable-task-row" data-task-id="${uniqueId}" data-status="todo" style="background-color: #f0f9ff;">
        <!-- Task Name with Checkbox -->
        <div class="col-span-3">
            <div class="flex items-center gap-2">
                <input type="checkbox" class="task-checkbox rounded border-gray-300" disabled>
                <div class="flex items-center gap-2">
                    <div>
                        <input type="text" 
                               class="font-medium text-gray-900 bg-transparent border-b-2 border-blue-400 focus:border-blue-600 focus:outline-none px-1 py-1 w-full" 
                               placeholder="Enter task name..."
                               name="task_name"
                               onkeypress="handleTaskNameEnter(event, this)">
                        <input type="text" 
                               class="text-xs text-gray-500 mt-1 bg-transparent border-b border-gray-300 focus:border-blue-400 focus:outline-none px-1 w-full" 
                               placeholder="Add description (optional)..."
                               name="task_description">
                    </div>
                </div>
            </div>
        </div>

        <!-- People Assignment -->
        <div class="col-span-2">
            <div class="flex items-center gap-1 -space-x-2">
                <input type="text" 
                       name="assigned_to" 
                       class="text-xs bg-transparent focus:outline-none px-1 py-1 w-full" 
                       placeholder="Type @ to assign..."
                       onkeyup="handlePersonAssignment(event, this)"
                       onfocus="showPersonSuggestions(this)"
                       onblur="hidePersonSuggestions(this)">
                <button onclick="assignMorePeople('${uniqueId}')" class="w-8 h-8 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center hover:border-blue-500 hover:bg-blue-50 transition-all ml-2">
                    <i class="bi bi-plus text-gray-400 text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Priority -->
        <div class="col-span-1">
            <div class="flex items-center cursor-pointer" onclick="changePriority('${uniqueId}')">
                <i class="bi bi-star-fill text-xs text-yellow-500"></i>
                <i class="bi bi-star-fill text-xs text-yellow-500"></i>
                <i class="bi bi-star-fill text-xs text-yellow-500"></i>
                <i class="bi bi-star text-gray-300 text-xs"></i>
                <i class="bi bi-star text-gray-300 text-xs"></i>
            </div>
        </div>

        <!-- Timeline -->
        <div class="col-span-2">
            <div class="space-y-1">
                <div class="text-sm text-gray-600">${todayFormatted} - ${nextWeekFormatted}</div>
                <div class="w-full bg-gray-200 rounded-full h-2 relative">
                    <div class="bg-blue-500 h-2 rounded-full transition-all progress-bar" style="width: 0%"></div>
                </div>
                <div class="text-xs text-gray-500 progress-text">0% complete</div>
            </div>
        </div>

        <!-- Due Date -->
        <div class="col-span-1">
            <div class="text-sm text-gray-600">
                <input type="date" 
                       name="due_date" 
                       class="text-sm text-gray-600 bg-transparent border-b border-gray-300 focus:border-blue-400 focus:outline-none" 
                       value="${new Date(Date.now() + 7*24*60*60*1000).toISOString().split('T')[0]}">
            </div>
        </div>
        
        <!-- Status -->
        <div class="col-span-1">
            <div class="flex items-center gap-1">
                <select name="status" onchange="updateNewTaskProgress('${uniqueId}', this.value)" 
                        class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 border-0 focus:ring-2 focus:ring-gray-500">
                    <option value="not-started" selected>Not started</option>
                    <option value="working">Working on it</option>
                    <option value="stuck">Stuck</option>
                    <option value="done">Done</option>
                </select>
                <button onclick="addTaskInStatus('Not started')" 
                        class="w-5 h-5 rounded-full bg-gray-200 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all" 
                        title="Add new task with Not started status">
                    <i class="bi bi-plus text-xs"></i>
                </button>
            </div>
        </div>
        
        <!-- Dependencies -->
        <div class="col-span-2">
            <div class="flex items-center gap-2">
                <button onclick="manageDependencies('${uniqueId}')" class="text-xs text-gray-400 hover:text-blue-600">
                    <i class="bi bi-plus-circle"></i> Add
                </button>
                <button onclick="saveNewTask(this)" class="px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700 transition-all">
                    <i class="bi bi-check"></i>
                </button>
                <button onclick="cancelNewTask(this)" class="px-2 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600 transition-all">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
    </div>`;
}

window.saveNewTask = function(element) {
    const row = element.closest('.editable-task-row');
    if (!row) return;
    
    const taskName = row.querySelector('input[name="task_name"]').value.trim();
    if (!taskName) {
        alert('Please enter a task name');
        return;
    }
    
    // Collect form data
    const formData = new FormData();
    formData.append('title', taskName);
    formData.append('description', row.querySelector('input[name="task_description"]').value.trim());
    formData.append('assigned_to', row.querySelector('select[name="assigned_to"]').value);
    formData.append('priority', row.querySelector('select[name="priority"]').value);
    formData.append('start_date', row.querySelector('input[name="start_date"]').value);
    formData.append('due_date', row.querySelector('input[name="due_date"]').value);
    formData.append('estimated_hours', row.querySelector('input[name="estimated_hours"]').value);
    formData.append('status', row.querySelector('select[name="status"]').value);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Add project ID
    const projectId = document.querySelector('input[name="project_id"]')?.value || 
                     document.querySelector('[data-project-id]')?.getAttribute('data-project-id') ||
                     mainViewProjectId;
    if (projectId) {
        formData.append('project_id', projectId);
    }
    
    // Show loading state
    const saveBtn = row.querySelector('button[onclick="saveNewTask(this)"]');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';
    saveBtn.disabled = true;
    
    // Submit to server
    fetch('/projects/tasks/store', {
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
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error creating task: ' + error.message);
    })
    .finally(() => {
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    });
}

window.cancelNewTask = function(element) {
    const row = element.closest('.editable-task-row');
    if (row) {
        row.remove();
    }
}

window.handleTaskNameEnter = function(event, element) {
    if (event.key === 'Enter') {
        event.preventDefault();
        saveNewTask(element);
    }
}

// Person assignment with @ trigger
window.handlePersonAssignment = function(event, element) {
    const value = element.value;
    if (value.includes('@')) {
        showPersonSuggestions(element);
    }
}

window.showPersonSuggestions = function(element) {
    // Mock person suggestions - replace with actual team members
    const suggestions = ['John Doe', 'Jane Smith', 'Mike Johnson', 'Sarah Wilson'];
    
    // Remove existing suggestions
    const existingSuggestions = document.querySelector('.person-suggestions');
    if (existingSuggestions) {
        existingSuggestions.remove();
    }
    
    if (element.value.includes('@')) {
        const suggestionsHtml = `
            <div class="person-suggestions absolute bg-white border border-gray-300 rounded-lg shadow-lg z-50 mt-1 max-h-32 overflow-y-auto">
                ${suggestions.map(person => `
                    <div class="px-3 py-2 hover:bg-gray-50 cursor-pointer text-xs" onclick="selectPerson('${person}', this)">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(person)}&size=20&background=3b82f6&color=fff" 
                             class="w-5 h-5 rounded-full inline-block mr-2">
                        ${person}
                    </div>
                `).join('')}
            </div>
        `;
        
        element.parentElement.style.position = 'relative';
        element.parentElement.insertAdjacentHTML('beforeend', suggestionsHtml);
    }
}

window.hidePersonSuggestions = function(element) {
    setTimeout(() => {
        const suggestions = document.querySelector('.person-suggestions');
        if (suggestions) {
            suggestions.remove();
        }
    }, 200);
}

window.selectPerson = function(personName, element) {
    const input = element.closest('.col-span-2').querySelector('input[name="assigned_to"]');
    input.value = personName;
    
    // Create avatar display
    const avatarHtml = `
        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(personName)}&size=32&background=3b82f6&color=fff" 
             class="w-8 h-8 rounded-full border-2 border-white hover:scale-110 transition-transform cursor-pointer" 
             alt="${personName}"
             title="${personName}">
    `;
    
    const container = input.parentElement;
    input.style.display = 'none';
    container.insertAdjacentHTML('afterbegin', avatarHtml);
    
    // Remove suggestions
    document.querySelector('.person-suggestions').remove();
}

// Real-time progress updates
window.updateNewTaskProgress = function(taskId, status) {
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskRow) return;
    
    const progressBar = taskRow.querySelector('.progress-bar');
    const progressText = taskRow.querySelector('.progress-text');
    const statusSelect = taskRow.querySelector('select[name="status"]');
    
    let progress = 0;
    let color = 'blue';
    
    switch(status) {
        case 'not-started':
            progress = 0;
            color = 'gray';
            break;
        case 'working':
            progress = 50;
            color = 'orange';
            break;
        case 'stuck':
            progress = 25;
            color = 'red';
            break;
        case 'done':
            progress = 100;
            color = 'green';
            break;
    }
    
    // Update progress bar
    if (progressBar) {
        progressBar.style.width = `${progress}%`;
        progressBar.className = `bg-${color}-500 h-2 rounded-full transition-all progress-bar`;
    }
    
    // Update progress text
    if (progressText) {
        progressText.textContent = `${progress}% complete`;
    }
    
    // Update status select styling
    if (statusSelect) {
        statusSelect.className = `px-2 py-1 text-xs rounded-full bg-${color}-100 text-${color}-800 border-0 focus:ring-2 focus:ring-${color}-500`;
    }
}
