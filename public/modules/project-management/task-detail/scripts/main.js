// Task Detail View JavaScript
document.addEventListener('DOMContentLoaded', function() {
    initializeTaskDetail();
});

function initializeTaskDetail() {
    console.log('Task Detail View Initialized');
    
    // Initialize tooltips and interactive elements
    initializeInteractiveElements();
    
    // Set up real-time updates
    setupRealTimeUpdates();
}

function initializeInteractiveElements() {
    // Team diagram interactions
    setupTeamDiagramInteractions();
    
    // Progress timeline interactions
    setupTimelineInteractions();
    
    // Activity feed interactions
    setupActivityFeedInteractions();
}

// Team Diagram Functions
function toggleDiagramView() {
    const diagram = document.getElementById('teamDiagram');
    if (diagram.classList.contains('fullscreen')) {
        diagram.classList.remove('fullscreen');
        document.body.classList.remove('overflow-hidden');
    } else {
        diagram.classList.add('fullscreen');
        document.body.classList.add('overflow-hidden');
    }
}

function exportDiagram() {
    // Implement diagram export functionality
    alert('Exporting team diagram...');
}

function messageTeamMember(memberId) {
    // Open messaging modal or redirect to chat
    console.log('Opening message for member:', memberId);
    alert(`Opening chat with team member ${memberId}`);
}

function viewMemberDetails(memberId) {
    // Show member detail modal
    console.log('Viewing details for member:', memberId);
    alert(`Viewing details for member ${memberId}`);
}

function openAssignmentModal() {
    // Open team assignment modal
    alert('Opening team assignment modal...');
}

// Team Metrics Functions
function viewMemberReport(memberId) {
    console.log('Viewing report for member:', memberId);
    alert(`Viewing performance report for member ${memberId}`);
}

function assignTask(memberId) {
    console.log('Assigning task to member:', memberId);
    alert(`Assigning new task to member ${memberId}`);
}

function openDependencyModal() {
    alert('Opening dependency management modal...');
}

function setupRealTimeUpdates() {
    setInterval(updateProgressIndicators, 30000); 
}

function updateProgressIndicators() {
    const progressRings = document.querySelectorAll('[stroke-dasharray]');
    progressRings.forEach(ring => {
        const currentProgress = parseInt(ring.getAttribute('stroke-dasharray').split(',')[0]);
        const newProgress = Math.min(100, currentProgress + Math.random() * 2);
        ring.setAttribute('stroke-dasharray', `${newProgress}, 100`);
    });
}

function setupTeamDiagramInteractions() {
    const teamMembers = document.querySelectorAll('[data-member-id]');
    teamMembers.forEach(member => {
        member.addEventListener('mouseenter', function() {
            this.classList.add('scale-105', 'shadow-lg');
        });
        
        member.addEventListener('mouseleave', function() {
            this.classList.remove('scale-105', 'shadow-lg');
        });
    });
}

function setupTimelineInteractions() {
    console.log('Timeline interactions initialized');
}

function setupActivityFeedInteractions() {
    console.log('Activity feed interactions initialized');
}

function formatTime(hours) {
    const h = Math.floor(hours);
    const m = Math.round((hours - h) * 60);
    return `${h}h ${m}m`;
}

function updateTaskStatus(taskId, status) {
    console.log(`Updating task ${taskId} status to ${status}`);
}

function updateTaskProgress(taskId, progress) {
    console.log(`Updating task ${taskId} progress to ${progress}%`);
}

window.toggleDiagramView = toggleDiagramView;
window.exportDiagram = exportDiagram;
window.messageTeamMember = messageTeamMember;
window.viewMemberDetails = viewMemberDetails;
window.openAssignmentModal = openAssignmentModal;
window.viewMemberReport = viewMemberReport;
window.assignTask = assignTask;
window.openDependencyModal = openDependencyModal;
