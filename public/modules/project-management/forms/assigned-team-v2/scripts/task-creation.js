
window.addTaskInStatus = function(status) {
    console.log('Adding new task with status:', status);
    

    const taskRows = document.querySelectorAll('.task-row');
    let targetSection = null;
    

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
    
    if (!targetSection) {
        targetSection = document.querySelector('.space-y-1');
    }
    
    if (targetSection) {
        const newRowHtml = createEditableTaskRow(status);
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = newRowHtml;
        const newRow = tempDiv.firstElementChild;

        targetSection.appendChild(newRow);

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
                       onblur="hidePersonSuggestions(this)">
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

window.addNewEmptyTask = function(section = 'this-week') {
    console.log('Adding new empty task row for section:', section);
    
    let taskContainer;
    
    if (section === 'next-week') {

        const nextWeekSection = document.querySelector('h3:has(.text-green-600)');
        if (nextWeekSection) {
            taskContainer = nextWeekSection.nextElementSibling.querySelector('.space-y-1');
        }
    } else {
        taskContainer = document.querySelector('.space-y-1');
    }
    
    if (!taskContainer) {
        console.error('Task container not found for section:', section);
        return;
    }

    const newRowHtml = createEmptyTaskRow(section);
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = newRowHtml;
    const newRow = tempDiv.firstElementChild;
    taskContainer.appendChild(newRow);

    const taskNameInput = newRow.querySelector('input[name="task_name"]');
    if (taskNameInput) {
        taskNameInput.focus();
    }

    newRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function createEmptyTaskRow(section = 'this-week') {
    const template = document.getElementById('new-task-row-template');
    if (template) {
        const clone = template.content.cloneNode(true);
        const uniqueId = 'new-task-' + Date.now();
        const taskRow = clone.querySelector('.editable-task-row');
        if (taskRow) {
            taskRow.setAttribute('data-task-id', uniqueId);
        }
        const dueDateInput = clone.querySelector('input[name="due_date"]');
        if (dueDateInput) {
            let dueDateValue;
            if (section === 'next-week') {
                dueDateValue = new Date(Date.now() + 10*24*60*60*1000).toISOString().split('T')[0];
            } else {
                dueDateValue = new Date(Date.now() + 7*24*60*60*1000).toISOString().split('T')[0];
            }
            dueDateInput.value = dueDateValue;
        }
        const tempDiv = document.createElement('div');
        tempDiv.appendChild(clone);
        return tempDiv.innerHTML;
    }
    console.warn('new-task-row-template not found, using fallback');
    return `
        <div class="grid grid-cols-12 gap-4 py-3 border-b border-gray-100 bg-blue-50 items-center task-row editable-task-row" data-task-id="new-task-${Date.now()}" data-status="todo">
            <div class="col-span-12 text-center p-4">
                <p class="text-gray-600">Loading new task form...</p>
                <p class="text-sm text-gray-500">Please use the existing task creation form above.</p>
            </div>
        </div>
    `;
}

window.saveTaskFromBlade = function(button) {
    const row = button.closest('.editable-task-row');
    if (!row) return;
    
    const taskName = row.querySelector('input[name="task_name"]').value.trim();
    if (!taskName) {
        alert('Please enter a task name');
        return;
    }

    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    const projectId = projectIndex !== -1 ? urlParts[projectIndex + 1] : null;
    
    if (!projectId) {
        alert('Project ID not found');
        return;
    }

    const formData = new FormData();
    formData.append('title', taskName);
    formData.append('description', row.querySelector('input[name="task_description"]')?.value || '');
    formData.append('assigned_to', '');
    formData.append('priority', 'medium');
    formData.append('due_date', row.querySelector('input[name="due_date"]')?.value || '');
    formData.append('status', row.querySelector('select[name="status"]')?.value || 'todo');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    const originalText = button.innerHTML;
    button.innerHTML = '<i class="bi bi-hourglass-split"></i>';
    button.disabled = true;

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

window.cancelTaskFromBlade = function(button) {
    const row = button.closest('.editable-task-row');
    if (row) {
        row.remove();
    }
}

// Handle @ mention functionality
window.handlePersonAssignment = function(event, input) {
    const query = input.value;
    const suggestionsDiv = input.parentElement.querySelector('.person-suggestions');
    
    if (query.includes('@') && query.length > 1) {
        const searchTerm = query.split('@').pop().toLowerCase();
        const availableUsers = window.projectTeamMembers || window.availableUsers || [];
        
        const matches = availableUsers.filter(user => 
            user.name.toLowerCase().includes(searchTerm)
        );
        
        if (matches.length > 0) {
            suggestionsDiv.innerHTML = matches.map(user => 
                `<div class="p-2 hover:bg-gray-100 cursor-pointer text-xs" onclick="selectUser('${user.name}', this)">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs">
                            ${user.name.charAt(0).toUpperCase()}
                        </div>
                        <span>${user.name}</span>
                    </div>
                </div>`
            ).join('');
            suggestionsDiv.classList.remove('hidden');
        } else {
            suggestionsDiv.classList.add('hidden');
        }
    } else {
        suggestionsDiv.classList.add('hidden');
    }
}

window.selectUser = function(userId, element) {
    if (!element) {
        console.error('Element is undefined in selectUser');
        return;
    }

    let user;
    if (typeof availableUsers !== 'undefined') {
        user = availableUsers.find(u => u.id === userId);
    }
    
    if (!user) {
        console.error('User not found with ID:', userId);
        return;
    }

    if (typeof addMentionedUser === 'function') {
        addMentionedUser(user);
    } else {
        console.error('addMentionedUser function not found');
    }
    
    if (typeof hideDropdown === 'function') {
        hideDropdown();
    }
}

window.hidePersonSuggestions = function(input) {
    setTimeout(() => {
        const suggestionsDiv = input.parentElement.querySelector('.person-suggestions');
        if (suggestionsDiv) {
            suggestionsDiv.classList.add('hidden');
        }
    }, 200);
}

// Handle priority changes
window.changePriority = function(element) {
    const stars = element.querySelectorAll('i');
    const hiddenInput = element.querySelector('input[name="priority"]');
    
    const filledStars = element.querySelectorAll('.bi-star-fill').length;
    let newPriority = 'low';
    let newFilledCount = 1;
    
    switch(filledStars) {
        case 1: newPriority = 'medium'; newFilledCount = 2; break;
        case 2: newPriority = 'high'; newFilledCount = 3; break;
        case 3: newPriority = 'critical'; newFilledCount = 4; break;
        case 4: newPriority = 'low'; newFilledCount = 1; break;
        default: newPriority = 'medium'; newFilledCount = 2; break;
    }
    
    stars.forEach((star, index) => {
        if (index < newFilledCount) {
            star.className = 'bi bi-star-fill text-xs text-yellow-500';
        } else {
            star.className = 'bi bi-star text-gray-300 text-xs';
        }
    });
    hiddenInput.value = newPriority;
}


let selectedTasks = new Set();

window.handleTaskSelection = function() {
    const checkboxes = document.querySelectorAll('.task-checkbox:checked');
    const deleteBtn = document.getElementById('deleteSelectedBtn');
    
    selectedTasks.clear();
    checkboxes.forEach(checkbox => {
        const taskRow = checkbox.closest('.task-row');
        if (taskRow) {
            const taskId = taskRow.getAttribute('data-task-id');
            if (taskId) {
                selectedTasks.add(taskId);
            }
        }
    });
    
    if (selectedTasks.size > 0) {
        deleteBtn.classList.remove('hidden');
    } else {
        deleteBtn.classList.add('hidden');
    }
}

// Show delete confirmation modal
window.showDeleteModal = function() {
    const modal = document.getElementById('deleteConfirmationModal');
    const countSpan = document.getElementById('selectedTaskCount');
    const confirmInput = document.getElementById('confirmationInput');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    
    countSpan.textContent = selectedTasks.size;
    confirmInput.value = '';
    confirmBtn.disabled = true;
    
    confirmBtn.style.backgroundColor = '#d1d5db'; // gray-300
    confirmBtn.style.cursor = 'not-allowed';
    confirmBtn.style.color = '#6b7280'; // gray-500 text
    
    modal.classList.remove('hidden');
    
    setTimeout(() => {
        confirmInput.focus();
        confirmInput.removeAttribute('readonly');
        confirmInput.removeAttribute('disabled');
    }, 100);
}

window.closeDeleteModal = function() {
    const modal = document.getElementById('deleteConfirmationModal');
    modal.classList.add('hidden');
}

// Toggle delete button based on confirmation input
window.toggleDeleteButton = function() {
    const confirmInput = document.getElementById('confirmationInput');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    
    if (confirmInput && confirmBtn) {
        const inputValue = confirmInput.value || '';
        const isConfirmed = inputValue.toLowerCase() === 'confirm';
        confirmBtn.disabled = !isConfirmed;

        if (isConfirmed) {
            confirmBtn.style.backgroundColor = '#dc2626'; // red-600
            confirmBtn.style.cursor = 'pointer';
            confirmBtn.style.color = '#ffffff'; // white text
        } else {
            confirmBtn.style.backgroundColor = '#d1d5db'; // gray-300
            confirmBtn.style.cursor = 'not-allowed';
            confirmBtn.style.color = '#6b7280'; // gray-500 text
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.task-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', handleTaskSelection);
    });
});

window.confirmDelete = function() {
    const confirmInput = document.getElementById('confirmationInput');
    
    if (confirmInput.value.toLowerCase() !== 'confirm') {
        alert('Please type "confirm" to proceed with deletion');
        return;
    }

    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    const projectId = projectIndex !== -1 ? urlParts[projectIndex + 1] : null;
    
    if (!projectId) {
        alert('Project ID not found');
        return;
    }
    
    const deletePromises = Array.from(selectedTasks).map(taskId => {
        const cleanTaskId = taskId.startsWith('task-') ? taskId.replace('task-', '') : taskId;
        
        const formData = new FormData();
        formData.append('_method', 'DELETE');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        return fetch(`/projects/${projectId}/tasks/${cleanTaskId}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
    });
    
    Promise.all(deletePromises)
        .then(responses => {
            const allSuccessful = responses.every(response => response.ok);
            
            if (allSuccessful) {
                selectedTasks.forEach(taskId => {
                    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
                    if (taskRow) {
                        taskRow.remove();
                    }
                });
                
                showSuccessModal(selectedTasks.size);
                
                selectedTasks.clear();
                document.getElementById('deleteSelectedBtn').classList.add('hidden');
                
                closeDeleteModal();
            } else {
                alert('Some tasks could not be deleted. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error deleting tasks:', error);
            alert('Error deleting tasks. Please try again.');
        });
}

window.showSuccessModal = function(count) {
    const modal = document.getElementById('deleteSuccessModal');
    const countSpan = document.getElementById('deletedTaskCount');
    
    countSpan.textContent = count;
    modal.classList.remove('hidden');
}

window.closeSuccessModal = function() {
    const modal = document.getElementById('deleteSuccessModal');
    modal.classList.add('hidden');
}

window.saveNewTask = function(element) {
    const row = element.closest('.editable-task-row');
    if (!row) return;
    
    const taskName = row.querySelector('input[name="task_name"]').value.trim();
    if (!taskName) {
        alert('Please enter a task name');
        return;
    }

    const formData = new FormData();
    formData.append('title', taskName);
    
    const descriptionInput = row.querySelector('input[name="task_description"]');
    const description = descriptionInput ? descriptionInput.value.trim() : '';
    formData.append('description', description);

    const assignedToInput = row.querySelector('input[name="assigned_to"], .person-input');
    let assignedUserId = '';
    if (assignedToInput) {
        const pendingUsers = assignedToInput.getAttribute('data-pending-users');
        if (pendingUsers) {
            const assignedUsers = JSON.parse(pendingUsers);
            if (assignedUsers.length > 0) {
                const userName = assignedUsers[0];
                if (window.projectTeamMembers) {
                    const user = window.projectTeamMembers.find(member => 
                        (member.name === userName) || (member.user?.name === userName)
                    );
                    assignedUserId = user?.id || user?.user?.id || '';
                }
            }
        }
    }
    
    formData.append('assigned_to', assignedUserId);
    
    const prioritySelect = row.querySelector('select[name="priority"]');
    const priority = prioritySelect ? prioritySelect.value : 'medium';
    formData.append('priority', priority);
    
    const startDateInput = row.querySelector('input[name="start_date"]');
    const startDate = startDateInput ? startDateInput.value : '';
    formData.append('start_date', startDate);
    
    const dueDateInput = row.querySelector('input[name="due_date"]');
    const dueDate = dueDateInput ? dueDateInput.value : '';
    formData.append('due_date', dueDate);
    
    const estimatedHoursInput = row.querySelector('input[name="estimated_hours"]');
    const estimatedHours = estimatedHoursInput ? estimatedHoursInput.value : '0';
    formData.append('estimated_hours', estimatedHours);
    
    const statusSelect = row.querySelector('select[name="status"]');
    const status = statusSelect ? statusSelect.value : 'todo';
    formData.append('status', status);
    
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    const projectId = document.querySelector('input[name="project_id"]')?.value || 
                     document.querySelector('[data-project-id]')?.getAttribute('data-project-id') ||
                     mainViewProjectId;
    
    console.log('Form data being sent:', {
        title: taskName,
        description: description,
        assigned_to: assignedTo,
        priority: priority,
        start_date: startDate,
        due_date: dueDate,
        estimated_hours: estimatedHours,
        status: status,
        project_id: projectId
    });
    if (projectId) {
        formData.append('project_id', projectId);
    }
    
    const saveBtn = row.querySelector('button[onclick="saveNewTask(this)"]');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';
    saveBtn.disabled = true;
    
    fetch('/projects/' + projectId + '/tasks', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.errors) {
            console.log('Validation errors:', data.errors);
            alert('Validation errors: ' + JSON.stringify(data.errors, null, 2));
        }
        if (data.success) {
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

function getLocalAvatar(personName) {
    const avatarMap = {
        'System Administrator': '/assets/images/faces/1.jpg',
        'Cesilia Cortez': '/assets/images/faces/2.jpg',
    };
    
    if (avatarMap[personName]) {
        return avatarMap[personName];
    }

    let hash = 0;
    for (let i = 0; i < personName.length; i++) {
        const char = personName.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;
        hash = hash & hash; 
    }
    
    const avatarNumber = (Math.abs(hash) % 16) + 1;
    return `/assets/images/faces/${avatarNumber}.jpg`;
}

// Person assignment with @ trigger
window.handlePersonAssignment = function(event, element) {
    const value = element.value;
    console.log('handlePersonAssignment called with value:', value);
    
    // Remove existing suggestions if @ is not present
    if (!value.includes('@')) {
        const existingSuggestions = document.querySelector('.person-suggestions');
        if (existingSuggestions) {
            existingSuggestions.remove();
        }
        return;
    }
    
    showPersonSuggestions(element);
}

window.showPersonSuggestions = async function(element) {
    if (element.style.display === 'none') {
        return;
    }
    const value = element.value;
    const atIndex = value.lastIndexOf('@');
    if (atIndex === -1) {
        return;
    }
    const searchTerm = value.substring(atIndex + 1).toLowerCase().trim();

    if (searchTerm.length === 0) {

        const existingSuggestions = document.querySelector('.person-suggestions');
        if (existingSuggestions) {
            existingSuggestions.remove();
        }
        return;
    }
    
    console.log('showPersonSuggestions called for element:', element);

    let suggestions = [];
    
    if (window.projectTeamMembers && window.projectTeamMembers.length > 0) {
        suggestions = window.projectTeamMembers.map(member => member.name || member.user?.name || member.email);
        console.log('Got suggestions from projectTeamMembers:', suggestions);
    } else {
        const existingAssignees = document.querySelectorAll('.task-row img[alt]');
        const uniqueNames = new Set();
        existingAssignees.forEach(img => {
            const name = img.getAttribute('alt');
            if (name && name !== 'undefined') {
                uniqueNames.add(name);
            }
        });
        suggestions = Array.from(uniqueNames);
        console.log('Got suggestions from existing assignees:', suggestions);

        if (suggestions.length === 0 && typeof window.availableUsers !== 'undefined') {
            suggestions = window.availableUsers.map(user => user.name);
        }
    }
    
    const filteredSuggestions = suggestions.filter(person => 
        person.toLowerCase().includes(searchTerm)
    );
    
    console.log('Filtered suggestions:', filteredSuggestions);
    
    const existingSuggestions = document.querySelector('.person-suggestions');
    if (existingSuggestions) {
        existingSuggestions.remove();
    }
    
    if (filteredSuggestions.length > 0) {
        const suggestionsHtml = `
            <div class="person-suggestions absolute bg-white border border-gray-300 rounded-lg shadow-lg z-50 mt-1 max-h-32 overflow-y-auto">
                ${filteredSuggestions.map(person => `
                    <div class="px-3 py-2 hover:bg-gray-50 cursor-pointer text-xs suggestion-item" data-person="${person}">
                        <img src="${getLocalAvatar(person)}" 
                             class="w-5 h-5 rounded-full inline-block mr-2 object-cover">
                        ${person}
                    </div>
                `).join('')}
            </div>
        `;
        
        element.parentElement.style.position = 'relative';
        element.parentElement.insertAdjacentHTML('beforeend', suggestionsHtml);
        

        const suggestionItems = element.parentElement.querySelectorAll('.suggestion-item');
        suggestionItems.forEach(item => {
            item.addEventListener('mousedown', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const personName = this.getAttribute('data-person');
                console.log('Suggestion clicked:', personName);
                selectPerson(personName, element); 
            });
        });
        
        console.log('Added suggestions dropdown with', filteredSuggestions.length, 'items');
    }
}

window.hidePersonSuggestions = function(element) {
    setTimeout(() => {
        const suggestions = document.querySelector('.person-suggestions');
        if (suggestions) {
            suggestions.remove();
            console.log('Hiding suggestions after timeout');
        }
    }, 300);
}

window.selectPerson = function(personName, inputElement) {
    console.log('selectPerson called with:', personName, inputElement);

    const element = inputElement || document.querySelector('.person-input:focus');
    if (!element) {
        console.error('No input element found for person selection');
        return;
    }
    
    console.log('Using element:', element);
    
    // Get current value and replace the @mention with selected person
    const currentValue = element.value;
    const atIndex = currentValue.lastIndexOf('@');
    
    if (atIndex !== -1) {
        const beforeAt = currentValue.substring(0, atIndex);
        const newValue = beforeAt + `@${personName} `;
        element.value = newValue;
        
        stagePendingAssignment(element, personName);
    }
    
    hidePersonSuggestions(element);
    
    element.focus();
    
    console.log('Person staged for assignment:', personName);
}

function stagePendingAssignment(element, personName) {
    let pendingUsers = element.getAttribute('data-pending-users');
    if (!pendingUsers) {
        pendingUsers = [];
    } else {
        pendingUsers = JSON.parse(pendingUsers);
    }
    
    if (!pendingUsers.includes(personName)) {
        pendingUsers.push(personName);
        element.setAttribute('data-pending-users', JSON.stringify(pendingUsers));
    }
    
    console.log('Staged pending assignment:', personName, 'Total pending:', pendingUsers);
}

function storeAssignedUser(element, personName) {
    let assignedUsers = element.getAttribute('data-assigned-users');
    if (!assignedUsers) {
        assignedUsers = [];
    } else {
        assignedUsers = JSON.parse(assignedUsers);
    }
    
    if (!assignedUsers.includes(personName)) {
        assignedUsers.push(personName);
        element.setAttribute('data-assigned-users', JSON.stringify(assignedUsers));
    }
}

function getAvatarForUser(personName) {
    if (typeof window.availableUsers !== 'undefined') {
        const user = window.availableUsers.find(u => u.name === personName);
        return user ? user.avatar : getLocalAvatar(personName);
    }
    return getLocalAvatar(personName);
}

function addAvatarToInput(element, personName, avatarUrl) {
    console.log('Avatar assignment for new task:', personName);
}

window.removeAssignedUser = function(button, personName) {
    const avatarElement = button.closest('[data-user]');
    const inputElement = button.closest('.task-row').querySelector('.person-input');
    
    if (avatarElement) {
        avatarElement.remove();
    }

    if (inputElement) {
        const currentValue = inputElement.value;
        const updatedValue = currentValue.replace(new RegExp(`@${personName}\\s*`, 'g'), '');
        inputElement.value = updatedValue;
    }
}

window.removeAssignment = function(avatarElement) {
    const container = avatarElement.parentElement;
    const input = container.querySelector('input[name="assigned_to"]');
    
    if (input) {
        input.value = '';
        input.style.display = 'block';
        
        input.setAttribute('onkeyup', 'handlePersonAssignment(event, this)');
        input.setAttribute('onblur', 'hidePersonSuggestions(this)');
        
        input.focus();
    }
    
    avatarElement.remove();
}

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
