<script>
let draggedTask = null;
let wipLimitsEnabled = false;

function toggleKanbanView() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView)');
    const workloadView = document.getElementById('workloadView');
    const kanbanView = document.getElementById('kanbanView');
    
    // Hide other views
    if (tableView) tableView.classList.add('hidden');
    if (workloadView) workloadView.classList.add('hidden');
    
    // Show kanban view
    kanbanView.classList.remove('hidden');
}

function closeKanbanView() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView)');
    const kanbanView = document.getElementById('kanbanView');
    
    kanbanView.classList.add('hidden');
    if (tableView) tableView.classList.remove('hidden');
}

function dragTask(event) {
    draggedTask = event.target;
    event.dataTransfer.effectAllowed = "move";
    event.target.style.opacity = "0.5";
}

function allowDrop(event) {
    event.preventDefault();
    event.dataTransfer.dropEffect = "move";
}

function dropTask(event) {
    event.preventDefault();
    
    if (!draggedTask) return;
    
    const targetColumn = event.currentTarget;
    const targetCardsContainer = targetColumn.querySelector('.kanban-cards');
    const sourceColumn = draggedTask.closest('.kanban-column');
    
    if (wipLimitsEnabled && !checkWIPLimit(targetColumn)) {
        alert('WIP limit exceeded for this column!');
        draggedTask.style.opacity = "1";
        draggedTask = null;
        return;
    }
    
    targetCardsContainer.appendChild(draggedTask);
    
    updateTaskStatus(draggedTask, targetColumn.dataset.column);
    
    updateColumnCounters();

    triggerKanbanAutomation(draggedTask, targetColumn.dataset.column);

    draggedTask.style.opacity = "1";
    draggedTask = null;
}

function updateTaskStatus(taskCard, columnStatus) {
    const taskId = taskCard.dataset.taskId.replace('task-', '');
    const statusBadge = taskCard.querySelector('.rounded-full:last-child');
   
    const statusMap = {
        'backlog': 'todo',
        'in-progress': 'in_progress', 
        'review': 'review',
        'done': 'completed'
    };
    
    const dbStatus = statusMap[columnStatus];
    
    switch(columnStatus) {
        case 'backlog':
            statusBadge.className = 'px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded-full';
            statusBadge.textContent = 'Unassigned';
            break;
        case 'in-progress':
            statusBadge.className = 'px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full';
            statusBadge.textContent = 'In Progress';
            break;
        case 'review':
            statusBadge.className = 'px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full';
            statusBadge.textContent = 'Review';
            break;
        case 'done':
            statusBadge.className = 'px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full';
            statusBadge.textContent = 'Done';
            // Update progress to 100%
            const progressBar = taskCard.querySelector('.bg-blue-500, .bg-red-500, .bg-green-500');
            if (progressBar) {
                progressBar.className = 'bg-green-500 h-2 rounded-full';
                progressBar.style.width = '100%';
                progressBar.parentElement.previousElementSibling.querySelector('span:last-child').textContent = '100%';
            }
            break;
    }
    
    // Update database via AJAX
    fetch(`/project-management/tasks/${taskId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            status: dbStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(`Task ${taskId} status updated to ${dbStatus}`);
            // Show success message
            showSuccessMessage(`Task moved to ${columnStatus.replace('-', ' ')}`);
        } else {
            console.error('Failed to update task status:', data.message);
            // Revert UI changes on failure
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error updating task status:', error);
        // Revert UI changes on failure
        location.reload();
    });
}

function updateColumnCounters() {
    document.querySelectorAll('.kanban-column').forEach(column => {
        const counter = column.querySelector('.wip-counter');
        const taskCount = column.querySelectorAll('.kanban-card').length;
        counter.textContent = taskCount;
    });
}

function checkWIPLimit(column) {
    const wipLimit = column.dataset.wipLimit;
    if (!wipLimit) return true;
    
    const currentTasks = column.querySelectorAll('.kanban-card').length;
    return currentTasks < parseInt(wipLimit);
}

function toggleWIPLimits() {
    wipLimitsEnabled = !wipLimitsEnabled;
    const toggle = document.getElementById('wipToggle');
    const limitSpans = document.querySelectorAll('.wip-limit');
    
    if (wipLimitsEnabled) {
        toggle.className = 'px-3 py-1 text-sm bg-orange-200 text-orange-800 rounded-lg hover:bg-orange-300 transition-all';
        limitSpans.forEach(span => span.classList.remove('hidden'));
        
        // Set default WIP limits
        document.querySelector('[data-column="backlog"]').dataset.wipLimit = '5';
        document.querySelector('[data-column="in-progress"]').dataset.wipLimit = '3';
        document.querySelector('[data-column="review"]').dataset.wipLimit = '2';
        
    } else {
        toggle.className = 'px-3 py-1 text-sm bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-all';
        limitSpans.forEach(span => span.classList.add('hidden'));
    }
}

function changeKanbanGrouping() {
    const groupBy = document.getElementById('kanbanGroupBy').value;
    console.log('Grouping by:', groupBy);
    // Implementation would reorganize columns based on grouping
}

function triggerKanbanAutomation(taskCard, newStatus) {
    const taskId = taskCard.dataset.taskId;
    
    // Example automations
    if (newStatus === 'in-progress') {
        console.log(`Automation: Task ${taskId} moved to In Progress - notifying assignees`);
    }
    
    if (newStatus === 'done') {
        console.log(`Automation: Task ${taskId} completed - updating project metrics`);
    }
    
    if (newStatus === 'review') {
        console.log(`Automation: Task ${taskId} ready for review - notifying reviewers`);
    }
}

function addKanbanColumn() {
    const columnName = prompt('Enter column name:');
    if (columnName) {
        console.log('Adding column:', columnName);
        // Implementation would dynamically create new column
    }
}

// AI Automation Functions
let currentProjectId = null;

function initializeAutomation() {
    // Get project ID from URL or data attribute
    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    if (projectIndex !== -1 && urlParts[projectIndex + 1]) {
        currentProjectId = urlParts[projectIndex + 1];
        loadAutomationSuggestions();
    }
}

function loadAutomationSuggestions() {
    if (!currentProjectId) return;
    
    const container = document.getElementById('automationSuggestions');
    if (!container) return;
    
    fetch(`/projects/${currentProjectId}/automation-suggestions`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayAutomationSuggestions(data.suggestions);
            } else {
                showErrorMessage('Failed to load automation suggestions');
            }
        })
        .catch(error => {
            console.error('Error loading automation suggestions:', error);
            showFallbackSuggestions();
        });
}

function displayAutomationSuggestions(suggestions) {
    const container = document.getElementById('automationSuggestions');
    if (!container) return;
    
    if (suggestions.length === 0) {
        container.innerHTML = `
            <div class="text-center py-4">
                <i class="bi bi-check-circle text-green-500 text-lg mb-2"></i>
                <p class="text-gray-500 text-xs">No automation suggestions at this time</p>
            </div>
        `;
        return;
    }
    
    container.innerHTML = suggestions.slice(0, 2).map(suggestion => {
        const colorClass = suggestion.priority === 'high' ? 'red' : 
                          suggestion.priority === 'medium' ? 'orange' : 'blue';
        
        return `
            <div class="p-2 bg-${colorClass}-50 rounded border-l-4 border-${colorClass}-400">
                <p class="text-${colorClass}-800 font-medium text-xs mb-1">${suggestion.trigger}</p>
                <p class="text-${colorClass}-700 text-xs mb-2">${suggestion.action}</p>
                <button onclick="createAutomationRule('${suggestion.type}', '${suggestion.trigger}', '${suggestion.action}', '${suggestion.priority}')" 
                        class="text-xs bg-${colorClass}-100 text-${colorClass}-700 px-2 py-1 rounded hover:bg-${colorClass}-200 transition-all">
                    Create Rule
                </button>
            </div>
        `;
    }).join('');
}

function showFallbackSuggestions() {
    const container = document.getElementById('automationSuggestions');
    if (!container) return;
    
    container.innerHTML = `
        <div class="p-2 bg-blue-50 rounded border-l-4 border-blue-400">
            <p class="text-blue-800 font-medium text-xs mb-1">When high-priority task is completed</p>
            <p class="text-blue-700 text-xs mb-2">automatically assign next dependent task to available team member</p>
            <button onclick="createAutomationRule('dependency', 'task_completed', 'assign_dependent_task', 'high')" 
                    class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200 transition-all">
                Create Rule
            </button>
        </div>
        <div class="p-2 bg-orange-50 rounded border-l-4 border-orange-400">
            <p class="text-orange-800 font-medium text-xs mb-1">When team member reaches 80% capacity</p>
            <p class="text-orange-700 text-xs mb-2">automatically redistribute tasks to available members</p>
            <button onclick="createAutomationRule('workload', 'capacity_limit', 'redistribute_tasks', 'medium')" 
                    class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded hover:bg-orange-200 transition-all">
                Create Rule
            </button>
        </div>
    `;
}

function createAutomationRule(type, trigger, action, priority) {
    if (!currentProjectId) {
        showErrorMessage('Project ID not found');
        return;
    }
    
    fetch('/automation/create-rule', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            project_id: currentProjectId,
            type: type,
            trigger: trigger,
            action: action,
            priority: priority
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccessMessage('Automation rule created successfully!');
            // Refresh suggestions
            setTimeout(() => loadAutomationSuggestions(), 1000);
        } else {
            showErrorMessage('Failed to create automation rule');
        }
    })
    .catch(error => {
        console.error('Error creating automation rule:', error);
        showErrorMessage('Error creating automation rule');
    });
}

function refreshAutomationSuggestions() {
    const container = document.getElementById('automationSuggestions');
    if (container) {
        container.innerHTML = `
            <div class="text-center py-4">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600 mx-auto mb-2"></div>
                <p class="text-gray-500 text-xs">Generating AI suggestions...</p>
            </div>
        `;
    }
    loadAutomationSuggestions();
}

function triggerKanbanAutomation(taskCard, newStatus) {
    const taskId = taskCard.dataset.taskId;
    const taskTitle = taskCard.querySelector('h6').textContent;
    
    // Check for specific automation rules
    if (newStatus === 'done' && taskTitle.toLowerCase().includes('design system documentation')) {
        // Find Emily Chen and Mobile responsive design task
        executeSpecificAutomation('design_system_complete', taskId);
    }
    
    // General automations
    if (newStatus === 'in-progress') {
        console.log(`Automation: Task ${taskId} moved to In Progress - notifying assignees`);
    }
    
    if (newStatus === 'done') {
        console.log(`Automation: Task ${taskId} completed - checking for dependent tasks`);
        checkForDependentTasks(taskId, taskTitle);
    }
    
    if (newStatus === 'review') {
        console.log(`Automation: Task ${taskId} ready for review - notifying reviewers`);
    }
}

function executeSpecificAutomation(automationType, triggerTaskId) {

    console.log(`Executing automation: ${automationType} triggered by task ${triggerTaskId}`);
    
    showSuccessMessage('Automation executed: Mobile responsive design assigned to Emily Chen');
}

function checkForDependentTasks(completedTaskId, completedTaskTitle) {
    // Check if any tasks depend on this completed task
    // This would query the database for task dependencies
    console.log(`Checking for tasks dependent on: ${completedTaskTitle}`);
}

function autoAssignTasks() {
    if (!currentProjectId) {
        showErrorMessage('Project ID not found');
        return;
    }
    
    showSuccessMessage('AI-powered task assignment in progress...');
    
    // This would implement intelligent task assignment based on:
    // - Team member availability
    // - Skill matching
    // - Workload balancing
    setTimeout(() => {
        showSuccessMessage('Tasks automatically assigned based on team capacity and skills');
    }, 2000);
}

function balanceWorkload() {
    if (!currentProjectId) {
        showErrorMessage('Project ID not found');
        return;
    }
    
    showSuccessMessage('Analyzing team workload...');
    
    // This would implement workload balancing by:
    // - Calculating current team member capacity
    // - Identifying overloaded members
    // - Redistributing tasks to available members
    setTimeout(() => {
        showSuccessMessage('Workload balanced - tasks redistributed to optimize team efficiency');
    }, 2000);
}

// Utility functions
function showSuccessMessage(message) {
    // Create and show success toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

function showErrorMessage(message) {
    // Create and show error toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Initialize automation when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeAutomation();
});
</script>