<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    @include('modules.project-management.forms.assigned-team-v2.header')
    @include('modules.project-management.forms.assigned-team-v2.this-week-section')
    @include('modules.project-management.forms.assigned-team-v2.next-week-section')
</div>

@include('modules.project-management.forms.assigned-team-v2.workload-view.main')

@include('modules.project-management.forms.assigned-team-v2.kanban-view.main')

@include('modules.project-management.forms.assigned-team-v2.timeline-view.main')

@include('modules.project-management.forms.assigned-team-v2.assignment-modal')

@include('modules.project-management.forms.assigned-team-v2.delete-confirmation-modal')

@include('modules.project-management.forms.assigned-team-v2.automation-panel')

{{-- Hidden template for new task rows --}}
<template id="new-task-row-template">
    @include('modules.project-management.forms.assigned-team-v2.new-task-row')
</template>

{{-- Pass server-side data to JavaScript --}}
<script>
// Make users available globally for task creation
window.availableUsers = @json($users ?? []);
console.log('Available users loaded:', window.availableUsers);
</script>

{{-- Load JavaScript modules --}}
<script src="{{ asset('modules/project-management/forms/assigned-team-v2/scripts/view-switching.js') }}"></script>
<script src="{{ asset('modules/project-management/forms/assigned-team-v2/scripts/task-management.js') }}"></script>
<script src="{{ asset('modules/project-management/forms/assigned-team-v2/scripts/dependency-management.js') }}"></script>
<script src="{{ asset('modules/project-management/forms/assigned-team-v2/scripts/task-creation.js') }}"></script>
<script src="{{ asset('modules/project-management/forms/assigned-team-v2/scripts/bulk-operations.js') }}"></script>
<script src="{{ asset('modules/project-management/forms/assigned-team-v2/scripts/automation.js') }}"></script>
<script src="{{ asset('modules/project-management/forms/assigned-team-v2/scripts/main.js') }}"></script>

<script>
// Legacy compatibility functions - most functionality moved to separate JS files
// Test function for debugging view switching
window.testViewSwitching = function() {
    console.log('=== MANUAL VIEW SWITCHING TEST ===');
    if (typeof switchView === 'function') {
        switchView('kanban');
    } else {
        console.error('switchView function not available');
    }
};

// Legacy compatibility - view switching functions moved to view-switching.js
window.closeKanbanView = function() {
    if (typeof switchView === 'function') {
        switchView('table');
    }
};

window.closeWorkloadView = function() {
    if (typeof switchView === 'function') {
        switchView('table');
    }
};

window.closeTimelineView = function() {
    if (typeof switchView === 'function') {
        switchView('table');
    }
};

// Minimal legacy functions - most functionality moved to separate JS files
let mainViewProjectId = null;

// Initialize project ID and team members from URL
document.addEventListener('DOMContentLoaded', function() {
    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    if (projectIndex !== -1 && urlParts[projectIndex + 1]) {
        mainViewProjectId = urlParts[projectIndex + 1];
    }
    
    // Initialize team members data for @ assignment
    window.projectTeamMembers = @json($project->teamMembers ?? []);
});


// Legacy compatibility functions - functionality moved to separate JS files
// Note: assignMorePeople is now defined in task-management.js

// Define openPeopleAssignmentModal function for this module
window.openPeopleAssignmentModal = function(taskId) {
    console.log('openPeopleAssignmentModal called with taskId:', taskId);
    const modal = document.getElementById('peopleAssignmentModal');
    console.log('Modal element found:', modal);
    
    if (!modal) {
        console.error('Modal not found!');
        alert(`Adding more assignees to task ${taskId}...\n\nModal not available in this view`);
        return;
    }
    
    // Set task ID if there's an input for it
    const taskIdInput = modal.querySelector('#taskId');
    if (taskIdInput) {
        taskIdInput.value = taskId;
    }
    
    // Show modal
    modal.style.display = 'block';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    console.log('Modal should now be visible');
}

// Define closePeopleAssignmentModal function
window.closePeopleAssignmentModal = function() {
    const modal = document.getElementById('peopleAssignmentModal');
    if (modal) {
        modal.style.display = 'none';
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

</script>
