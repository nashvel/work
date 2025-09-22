// View Switching Functions
window.testViewSwitching = function() {
    console.log('=== MANUAL VIEW SWITCHING TEST ===');
    
    const viewMode = document.getElementById('viewMode');
    const kanbanView = document.getElementById('kanbanView');
    const workloadView = document.getElementById('workloadView');
    const timelineView = document.getElementById('timelineView');
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView):not(#timelineView)');
    
    console.log('Elements check:', {
        viewMode: !!viewMode,
        kanbanView: !!kanbanView,
        workloadView: !!workloadView,
        timelineView: !!timelineView,
        tableView: !!tableView
    });
    
    if (viewMode) {
        console.log('Current viewMode value:', viewMode.value);
        viewMode.value = 'kanban';

        const event = new Event('change', { bubbles: true });
        viewMode.dispatchEvent(event);
        
        console.log('Manually triggered change event for kanban view');
    } else {
        console.error('viewMode element not found!');
    }
};

window.closeKanbanView = function() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView):not(#timelineView)');
    const kanbanView = document.getElementById('kanbanView');
    
    if (tableView && kanbanView) {
        tableView.classList.remove('hidden');
        kanbanView.classList.add('hidden');
        
        const viewMode = document.getElementById('viewMode');
        if (viewMode) {
            viewMode.value = 'table';
        }
        
        console.log('Switched back to table view');
    }
};

window.closeWorkloadView = function() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView):not(#timelineView)');
    const workloadView = document.getElementById('workloadView');
    
    if (tableView && workloadView) {
        tableView.classList.remove('hidden');
        workloadView.classList.add('hidden');
        
        const viewMode = document.getElementById('viewMode');
        if (viewMode) {
            viewMode.value = 'table';
        }
        
        console.log('Switched back to table view');
    }
};

window.closeTimelineView = function() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView):not(#timelineView)');
    const timelineView = document.getElementById('timelineView');
    
    if (tableView && timelineView) {
        tableView.classList.remove('hidden');
        timelineView.classList.add('hidden');
        
        const viewMode = document.getElementById('viewMode');
        if (viewMode) {
            viewMode.value = 'table';
        }
        
        console.log('Switched back to table view');
    }
};

window.switchView = function(viewType) {
    console.log('Switching to view:', viewType);
    
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView):not(#timelineView)');
    const kanbanView = document.getElementById('kanbanView');
    const workloadView = document.getElementById('workloadView');
    const timelineView = document.getElementById('timelineView');
    
    // Hide all views first
    if (tableView) tableView.classList.add('hidden');
    if (kanbanView) kanbanView.classList.add('hidden');
    if (workloadView) workloadView.classList.add('hidden');
    if (timelineView) timelineView.classList.add('hidden');
    
    // Show selected view
    switch(viewType) {
        case 'kanban':
            if (kanbanView) kanbanView.classList.remove('hidden');
            break;
        case 'timeline':
            if (timelineView) timelineView.classList.remove('hidden');
            break;
        case 'workload':
            if (workloadView) workloadView.classList.remove('hidden');
            break;
        default:
            if (tableView) tableView.classList.remove('hidden');
            break;
    }
}
