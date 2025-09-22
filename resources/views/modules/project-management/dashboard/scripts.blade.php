{{-- Dashboard JavaScript Component --}}
<script>
    window.switchView = function(view) {
        const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView):not(#timelineView)');
        const workloadView = document.getElementById('workloadView');
        const kanbanView = document.getElementById('kanbanView');
        const timelineView = document.getElementById('timelineView');

        if (tableView) tableView.classList.add('hidden');
        if (workloadView) workloadView.classList.add('hidden');
        if (kanbanView) kanbanView.classList.add('hidden');
        if (timelineView) timelineView.classList.add('hidden');

        switch(view) {
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
    };

    window.testViewSwitching = function() {
        const viewMode = document.getElementById('viewMode');
        const kanbanView = document.getElementById('kanbanView');
        const workloadView = document.getElementById('workloadView');
        const timelineView = document.getElementById('timelineView');
        const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#kanbanView):not(#workloadView):not(#timelineView)');
        
        if (viewMode) {
            viewMode.value = 'kanban';
            const event = new Event('change', { bubbles: true });
            viewMode.dispatchEvent(event);
            
            if (tableView) {
                tableView.classList.add('hidden');
            }
            if (workloadView) {
                workloadView.classList.add('hidden');
            }
            if (kanbanView) {
                kanbanView.classList.add('hidden');
            }
            if (timelineView) {
                timelineView.classList.add('hidden');
            }

            if (kanbanView) {
                kanbanView.classList.remove('hidden');
            }
        }
    };

    function saveActiveTab(tabId) {
        localStorage.setItem('activeProjectTab', tabId);
    }
    
    function restoreActiveTab() {
        const savedTab = localStorage.getItem('activeProjectTab');
        
        if (savedTab) {
            const tabButton = document.querySelector(`[data-hs-tab="#${savedTab}"]`);
            const tabPanel = document.getElementById(savedTab);
            
            if (tabButton && tabPanel) {
                document.querySelectorAll('[role="tabpanel"]').forEach(panel => {
                    panel.classList.add('hidden');
                });

                document.querySelectorAll('[data-hs-tab]').forEach(btn => {
                    btn.classList.remove('active', 'hs-tab-active:font-semibold', 'hs-tab-active:border-primary', 'hs-tab-active:text-primary');
                });

                tabPanel.classList.remove('hidden');
                tabButton.classList.add('active');
                
                return true;
            }
        }
        return false;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const restored = restoreActiveTab();

        document.querySelectorAll('[data-hs-tab]').forEach(tabButton => {
            tabButton.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-hs-tab').replace('#', '');
                saveActiveTab(targetTab);
            });
        });
    });
    
    if (typeof addExtra === 'undefined') {
        window.addExtra = {
            addEventListener: function() {
            }
        };
    }
    
    window.openPeopleAssignmentModal = function(taskId) {
        const modal = document.getElementById('peopleAssignmentModal');
        if (!modal) {
            alert('Modal not found! Switching to Assigned Team v2 tab...');
            const teamV2Tab = document.querySelector('[data-hs-tab="#icon-people-v2"]');
            if (teamV2Tab && !teamV2Tab.classList.contains('active')) {
                teamV2Tab.click();
                setTimeout(() => {
                    const modalAfterSwitch = document.getElementById('peopleAssignmentModal');
                    if (modalAfterSwitch) {
                        window.openPeopleAssignmentModal(taskId);
                    } else {
                        alert(`Adding more assignees to task ${taskId}...\n\nAvailable team members:\nAvailable team members will be shown\nMultiple people can be assigned\nNotifications will be sent automatically`);
                    }
                }, 1000);
            } else {
                alert(`Adding more assignees to task ${taskId}...\n\nAvailable team members:\nAvailable team members will be shown\nMultiple people can be assigned\nNotifications will be sent automatically`);
            }
            return;
        }

        const taskIdInput = modal.querySelector('#taskId');
        if (taskIdInput) {
            taskIdInput.value = taskId;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };
</script>
