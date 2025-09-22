<script>
// Timeline View Functionality
let timelineScale = 'weeks';
let timelineGroupBy = 'assignee';
let dependenciesVisible = false;
let selectedTaskBar = null;
let isDragging = false;
let isResizing = false;
let dragStartX = 0;
let dragStartLeft = 0;

// Timeline View Management
function toggleTimelineView() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#timelineView):not(#kanbanView):not(#workloadView)');
    const kanbanView = document.getElementById('kanbanView');
    const workloadView = document.getElementById('workloadView');
    const timelineView = document.getElementById('timelineView');
    
    // Hide other views
    if (tableView) tableView.classList.add('hidden');
    if (kanbanView) kanbanView.classList.add('hidden');
    if (workloadView) workloadView.classList.add('hidden');
    
    // Show timeline view
    timelineView.classList.remove('hidden');
}

function closeTimelineView() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#timelineView):not(#kanbanView):not(#workloadView)');
    const timelineView = document.getElementById('timelineView');
    
    timelineView.classList.add('hidden');
    if (tableView) tableView.classList.remove('hidden');
}

// Time Scale Management
function changeTimelineScale() {
    const scale = document.getElementById('timelineScale').value;
    timelineScale = scale;
    updateTimeHeaders();
}

function updateTimeHeaders() {
    const timeHeaders = document.getElementById('timeHeaders');
    // Implementation would dynamically generate headers based on scale
}

// Grouping Management
function changeTimelineGrouping() {
    const groupBy = document.getElementById('timelineGroupBy').value;
    timelineGroupBy = groupBy;
    // Implementation would reorganize task sidebar and chart area
}

// Dependencies Management
function toggleDependencies() {
    dependenciesVisible = !dependenciesVisible;
    const toggle = document.getElementById('dependenciesToggle');
    const dependenciesLayer = document.getElementById('dependenciesLayer');
    
    if (dependenciesVisible) {
        toggle.className = 'px-3 py-1 text-sm bg-blue-200 text-blue-800 rounded-lg hover:bg-blue-300 transition-all';
        dependenciesLayer.classList.remove('hidden');
    } else {
        toggle.className = 'px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all';
        dependenciesLayer.classList.add('hidden');
    }
}

// Navigation
function navigateTimeline(direction) {
    // Implementation would shift the time range
}

function goToToday() {
    // Implementation would center timeline on current date
}

function zoomTimeline(direction) {
    // Implementation would adjust time scale granularity
}

// Filtering
function filterTimeline() {
    const filter = document.getElementById('timelineFilter').value;
    // Implementation would show/hide tasks based on filter
}

// Group Management
function toggleGroup(groupId) {
    const group = document.getElementById(groupId);
    const toggle = group.previousElementSibling.querySelector('.group-toggle');
    
    if (group.style.display === 'none') {
        group.style.display = '';
        toggle.className = toggle.className.replace('bi-chevron-right', 'bi-chevron-down');
    } else {
        group.style.display = 'none';
        toggle.className = toggle.className.replace('bi-chevron-down', 'bi-chevron-right');
    }
}

function collapseAllGroups() {
    document.querySelectorAll('.group-tasks').forEach(group => {
        group.style.display = 'none';
    });
    document.querySelectorAll('.group-toggle').forEach(toggle => {
        toggle.className = toggle.className.replace('bi-chevron-down', 'bi-chevron-right');
    });
}

// Task Selection
function selectTask(taskId) {
    // Highlight corresponding task bar
    highlightTaskBar(taskId);
}

function selectTaskBar(taskId) {
    // Remove previous selection
    if (selectedTaskBar) {
        selectedTaskBar.classList.remove('ring-2', 'ring-blue-400');
    }
    
    // Select new task bar
    selectedTaskBar = document.querySelector(`[data-task-id="${taskId}"]`);
    if (selectedTaskBar) {
        selectedTaskBar.classList.add('ring-2', 'ring-blue-400');
    }
}

function highlightTaskBar(taskId) {
    // Remove all highlights
    document.querySelectorAll('.task-bar').forEach(bar => {
        bar.classList.remove('ring-2', 'ring-yellow-400');
    });
    
    // Highlight specific task bar
    const taskBar = document.querySelector(`.task-bar[data-task-id="${taskId}"]`);
    if (taskBar) {
        taskBar.classList.add('ring-2', 'ring-yellow-400');
        setTimeout(() => {
            taskBar.classList.remove('ring-2', 'ring-yellow-400');
        }, 2000);
    }
}

// Task Bar Dragging
function startDragTaskBar(event, taskId) {
    if (event.target.classList.contains('resize-handle-left') || 
        event.target.classList.contains('resize-handle-right')) {
        return; // Don't start drag if clicking resize handle
    }
    
    event.preventDefault();
    isDragging = true;
    dragStartX = event.clientX;
    const taskBar = event.currentTarget;
    dragStartLeft = parseFloat(taskBar.style.left);
    
    
    document.addEventListener('mousemove', dragTaskBar);
    document.addEventListener('mouseup', stopDragTaskBar);
}

function dragTaskBar(event) {
    if (!isDragging) return;
    
    const deltaX = event.clientX - dragStartX;
    const chartArea = document.querySelector('.chart-area');
    const percentageMove = (deltaX / chartArea.offsetWidth) * 100;
    const newLeft = Math.max(0, Math.min(80, dragStartLeft + percentageMove));
    
    if (selectedTaskBar) {
        selectedTaskBar.style.left = newLeft + '%';
    }
}

function stopDragTaskBar() {
    if (isDragging) {
        isDragging = false;
        // Here you would update the task dates based on new position
        updateTaskDates();
    }
    
    document.removeEventListener('mousemove', dragTaskBar);
    document.removeEventListener('mouseup', stopDragTaskBar);
}

// Task Bar Resizing
function startResizeTaskBar(event, taskId, handle) {
    event.preventDefault();
    event.stopPropagation();
    
    isResizing = true;
    dragStartX = event.clientX;
    
    
    document.addEventListener('mousemove', resizeTaskBar);
    document.addEventListener('mouseup', stopResizeTaskBar);
}

function resizeTaskBar(event) {
    if (!isResizing) return;
    
    const deltaX = event.clientX - dragStartX;
    const chartArea = document.querySelector('.chart-area');
    const percentageChange = (deltaX / chartArea.offsetWidth) * 100;
    
    if (selectedTaskBar) {
        const currentWidth = parseFloat(selectedTaskBar.style.width);
        const newWidth = Math.max(5, currentWidth + percentageChange);
        selectedTaskBar.style.width = newWidth + '%';
    }
}

function stopResizeTaskBar() {
    if (isResizing) {
        isResizing = false;
        // Here you would update the task duration based on new width
        updateTaskDuration();
    }
    
    document.removeEventListener('mousemove', resizeTaskBar);
    document.removeEventListener('mouseup', stopResizeTaskBar);
}

// Task Management
function editTask(taskId) {
    // Implementation would open task edit modal
}

function assignTask(taskId) {
    // Implementation would open assignee selector
}

function updateTaskDates() {
    // Implementation would calculate new start/end dates
}

function updateTaskDuration() {
    // Implementation would calculate new duration
}

// Automation Functions
function autoSchedule() {
    alert('AI-powered auto-scheduling in progress...\n\nAnalyzing dependencies\nOptimizing resource allocation\nAdjusting timeline for efficiency');
}

function autoAssignTasks() {
    alert('Auto-assigning unassigned tasks...\n\nAnalyzing team capacity\nMatching skills to requirements\nDistributing workload evenly');
}

function autoResolveConflicts() {
    alert('Resolving schedule conflicts...\n\nFound 2 resource conflicts\nSuggesting task reassignments\nProposing timeline adjustments');
}

function optimizeSchedule() {
    alert('Optimizing project schedule...\n\nAnalyzing critical path\nReducing project duration by 15%\nBalancing team workload');
}

function exportTimeline() {
    alert('Exporting timeline...\n\nAvailable formats:\nPDF Report\nExcel Spreadsheet\nMS Project File\nPNG Image');
}

// Initialize Timeline View
document.addEventListener('DOMContentLoaded', function() {
    // Add timeline-specific event listeners
});
</script>