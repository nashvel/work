<script>
// Workload View Functionality
let workloadPeriod = 'this-week';
let workloadViewMode = 'capacity';

// Workload View Management
function toggleWorkloadView() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#workloadView):not(#kanbanView):not(#timelineView)');
    const kanbanView = document.getElementById('kanbanView');
    const timelineView = document.getElementById('timelineView');
    const workloadView = document.getElementById('workloadView');
    
    // Hide other views
    if (tableView) tableView.classList.add('hidden');
    if (kanbanView) kanbanView.classList.add('hidden');
    if (timelineView) timelineView.classList.add('hidden');
    
    // Show workload view
    workloadView.classList.remove('hidden');
}

function closeWorkloadView() {
    const tableView = document.querySelector('.bg-white.rounded-lg.shadow-sm.border.border-gray-200:not(#workloadView):not(#kanbanView):not(#timelineView)');
    const workloadView = document.getElementById('workloadView');
    
    workloadView.classList.add('hidden');
    if (tableView) tableView.classList.remove('hidden');
}

// Period and View Mode Management
function changeWorkloadPeriod() {
    const period = document.getElementById('workloadPeriod').value;
    workloadPeriod = period;
    console.log('Workload period changed to:', period);
    
    // Update data display based on selected period
    updateWorkloadData();
    
    // Add visual feedback
    const element = document.getElementById('workloadPeriod');
    element.classList.add('ring-2', 'ring-orange-400');
    setTimeout(() => {
        element.classList.remove('ring-2', 'ring-orange-400');
    }, 1000);
}

function changeWorkloadViewMode() {
    const viewMode = document.getElementById('workloadViewMode').value;
    workloadViewMode = viewMode;
    console.log('Workload view mode changed to:', viewMode);
    
    // Transform the display based on view mode
    switch(viewMode) {
        case 'capacity':
            showCapacityView();
            break;
        case 'hours':
            showHoursView();
            break;
        case 'projects':
            showProjectsView();
            break;
        case 'skills':
            showSkillsView();
            break;
    }
}

function updateWorkloadData() {
    console.log('Updating workload data for period:', workloadPeriod);
    // Implementation would fetch and update data based on selected period
    
    // Simulate data loading
    document.querySelectorAll('.workload-member-card').forEach(card => {
        card.classList.add('timeline-loading');
        setTimeout(() => {
            card.classList.remove('timeline-loading');
        }, 800);
    });
}

// View Mode Functions
function showCapacityView() {
    console.log('Showing capacity view');
    // Implementation would show capacity-focused layout
}

function showHoursView() {
    console.log('Showing hours breakdown view');
    // Implementation would show detailed hours breakdown
}

function showProjectsView() {
    console.log('Showing projects view');
    // Implementation would group by projects
}

function showSkillsView() {
    console.log('Showing skills view');
    // Implementation would group by skills
}

// Member Interaction Functions
function openMemberDetails(memberId) {
    console.log('Opening details for member:', memberId);
    // Implementation would open detailed member modal
    showMemberDetailModal(memberId);
}

function assignTasks(memberId) {
    console.log('Assigning tasks to member:', memberId);
    alert(`Assigning tasks to ${memberId.replace('-', ' ')}...\n\nAvailable tasks from backlog:\nSecurity audit (5h)\nCode review (2h)\nDocumentation update (3h)\n\nClick to assign selected tasks`);
}

function viewDetails(memberId) {
    console.log('Viewing details for member:', memberId);
    openMemberDetails(memberId);
}

function redistributeTasks(memberId) {
    console.log('Redistributing tasks for member:', memberId);
    alert(`Redistributing tasks for ${memberId.replace('-', ' ')}...\n\nOverloaded tasks:\nAPI integration testing (8h)\nDatabase optimization (6h)\n\nSuggested reassignments:\nMove API testing → David Wilson\nMove DB optimization → Sarah Adams\n\nApply redistribution?`);
}

function showMemberDetailModal(memberId) {
    // Create and show detailed member modal
    const modalContent = `
        <div class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl !max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-orange-50 to-amber-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900">Team Member Details</h3>
                        <button onclick="closeMemberModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2">
                            <i class="bi bi-x-lg text-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6 overflow-y-auto flex-1">
                    <p class="text-gray-600">Detailed workload analysis for ${memberId.replace('-', ' ')} would be displayed here...</p>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalContent);
}

function closeMemberModal() {
    const modal = document.querySelector('.fixed.inset-0.bg-black.bg-opacity-60');
    if (modal) modal.remove();
}

// Automation Functions
function autoBalanceWorkload() {
    console.log('Auto-balancing workload...');
    alert('AI-Powered Workload Balancing\n\nAnalyzing team capacity...\nIdentifying optimization opportunities...\nApplying intelligent task redistribution...\n\nWorkload balanced!\nExpected efficiency gain: 15%\nOverload conflicts resolved: 3');
}

function redistributeOverload() {
    console.log('Redistributing overloaded tasks...');
    alert('Task Redistribution Analysis\n\nFound 1 overloaded team member:\nCarlos Dela Cruz (110% capacity)\n\nSuggested redistributions:\nAPI testing → Jose Reyes (30% → 60%)\nDB optimization → Maria Rodriguez (45% → 70%)\n\nApply redistribution plan?');
}

function scheduleOptimization() {
    console.log('Optimizing schedule...');
    alert('Schedule Optimization\n\nAnalyzing project timelines...\nOptimizing task sequencing...\nBalancing team workload...\n\nSchedule optimized!\nProject duration reduced by 12%\nTeam efficiency improved by 18%');
}

function generateReport() {
    console.log('Generating workload report...');
    alert('Workload Report Generation\n\nAvailable report formats:\nExecutive Summary (PDF)\nDetailed Analytics (Excel)\nTeam Performance (PowerPoint)\nInteractive Dashboard (HTML)\n\nReports will be emailed to stakeholders');
}

function exportWorkloadReport() {
    console.log('Exporting workload report...');
    generateReport();
}

function optimizeEfficiency() {
    console.log('Optimizing team efficiency...');
    alert('Efficiency Optimization\n\nCurrent efficiency: 87%\nPotential gain: +13%\n\nOptimization strategies:\nTask automation (3% gain)\nSkill-based assignments (5% gain)\nTimeline adjustments (5% gain)\n\nApply optimizations?');
}

// Quick Action Functions
function assignToMember(memberId) {
    console.log('Assigning tasks to member:', memberId);
    assignTasks(memberId);
}

function planAhead() {
    console.log('Planning ahead for workload forecast...');
    alert('Proactive Planning\n\nForecast Analysis:\nWeek 2: High workload risk\nBackend development bottleneck\n2 critical deadlines\n\nRecommended actions:\nHire temporary contractor\nAdjust project timelines\nCross-train team members\n\nCreate action plan?');
}

// Utility Functions
function addWorkloadAnimation() {
    document.querySelectorAll('.workload-member-card').forEach((card, index) => {
        setTimeout(() => {
            card.style.transform = 'translateY(0)';
            card.style.opacity = '1';
        }, index * 100);
    });
}

// Initialize Workload View
document.addEventListener('DOMContentLoaded', function() {
    // Initialize workload view animations
    console.log('Workload view initialized');
    
    // Set initial card positions for animation
    document.querySelectorAll('.workload-member-card').forEach(card => {
        card.style.transform = 'translateY(20px)';
        card.style.opacity = '0';
        card.style.transition = 'all 0.5s ease';
    });
    
    // Add hover effects to member cards
    document.querySelectorAll('.workload-member-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Trigger initial animation
    setTimeout(addWorkloadAnimation, 200);
});
</script>