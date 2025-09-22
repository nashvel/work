{{-- Assigned Team Module --}}
<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
    {{-- Header --}}
    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-people-fill text-blue-600"></i>
                    Team Assignment
                </h3>
                <p class="text-sm text-gray-600 mt-1">Assign and manage team members across project tasks</p>
            </div>
            <button onclick="openAddMemberModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center gap-2 shadow-sm">
                <i class="bi bi-person-plus-fill"></i>
                Add Member
            </button>
        </div>
    </div>

    {{-- Team Status Overview --}}
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
        <div class="grid grid-cols-4 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600" id="totalMembers">3</div>
                <div class="text-sm text-gray-600">Total Members</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600" id="activeMembers">2</div>
                <div class="text-sm text-gray-600">Active</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-yellow-600" id="pendingTasks">5</div>
                <div class="text-sm text-gray-600">Pending Tasks</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600" id="completedTasks">8</div>
                <div class="text-sm text-gray-600">Completed</div>
            </div>
        </div>
    </div>

    {{-- Team Assignment Board --}}
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Not Assigned Column --}}
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-semibold text-gray-700 flex items-center gap-2">
                        <i class="bi bi-person-dash text-gray-500"></i>
                        Not Assigned
                    </h4>
                    <span class="bg-gray-200 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">2</span>
                </div>
                <div class="space-y-3" id="notAssignedColumn">
                    {{-- Task Card --}}
                    <div class="bg-white border border-gray-200 rounded-lg p-3 cursor-move hover:shadow-md transition-all group" draggable="true">
                        <div class="flex items-start justify-between mb-2">
                            <h5 class="font-medium text-gray-900 text-sm">Website Wireframes</h5>
                            <i class="bi bi-grip-vertical text-gray-400 group-hover:text-gray-600"></i>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Due: Dec 15</span>
                            <div class="flex items-center gap-1">
                                <i class="bi bi-clock text-yellow-500 text-xs"></i>
                                <span class="text-xs text-gray-600">3 days</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-3 cursor-move hover:shadow-md transition-all group" draggable="true">
                        <div class="flex items-start justify-between mb-2">
                            <h5 class="font-medium text-gray-900 text-sm">Market Research</h5>
                            <i class="bi bi-grip-vertical text-gray-400 group-hover:text-gray-600"></i>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Due: Dec 18</span>
                            <div class="flex items-center gap-1">
                                <i class="bi bi-clock text-yellow-500 text-xs"></i>
                                <span class="text-xs text-gray-600">5 days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Assigned Column --}}
            <div class="bg-blue-50 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-semibold text-blue-700 flex items-center gap-2">
                        <i class="bi bi-person-check text-blue-600"></i>
                        Assigned
                    </h4>
                    <span class="bg-blue-200 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">3</span>
                </div>
                <div class="space-y-3" id="assignedColumn">
                    {{-- Team Member Card --}}
                    <div class="bg-white border border-blue-200 rounded-lg p-3 hover:shadow-md transition-all">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                JS
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">John Smith</div>
                                <div class="flex items-center gap-2">
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">Lead</span>
                                    <span class="text-xs text-gray-500">2 tasks</span>
                                </div>
                            </div>
                            <div class="relative">
                                <button onclick="toggleMemberMenu('member1')" class="text-gray-400 hover:text-gray-600 p-1">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div id="member1Menu" class="hidden absolute right-0 top-8 bg-white border border-gray-200 rounded-lg shadow-lg w-36 z-10">
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-2">
                                        <i class="bi bi-pencil text-blue-600"></i>
                                        Edit Role
                                    </button>
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-2">
                                        <i class="bi bi-chat-dots text-green-600"></i>
                                        Message
                                    </button>
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 text-red-600 flex items-center gap-2">
                                        <i class="bi bi-person-dash"></i>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="bg-gray-50 rounded p-2">
                                <div class="text-xs font-medium text-gray-700">Database Design</div>
                                <div class="text-xs text-gray-500">Due: Dec 12</div>
                            </div>
                            <div class="bg-gray-50 rounded p-2">
                                <div class="text-xs font-medium text-gray-700">API Development</div>
                                <div class="text-xs text-gray-500">Due: Dec 20</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-blue-200 rounded-lg p-3 hover:shadow-md transition-all">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                SA
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Sarah Adams</div>
                                <div class="flex items-center gap-2">
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Designer</span>
                                    <span class="text-xs text-gray-500">1 task</span>
                                </div>
                            </div>
                            <div class="relative">
                                <button onclick="toggleMemberMenu('member2')" class="text-gray-400 hover:text-gray-600 p-1">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div id="member2Menu" class="hidden absolute right-0 top-8 bg-white border border-gray-200 rounded-lg shadow-lg w-36 z-10">
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-2">
                                        <i class="bi bi-pencil text-blue-600"></i>
                                        Edit Role
                                    </button>
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-2">
                                        <i class="bi bi-chat-dots text-green-600"></i>
                                        Message
                                    </button>
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 text-red-600 flex items-center gap-2">
                                        <i class="bi bi-person-dash"></i>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="bg-gray-50 rounded p-2">
                                <div class="text-xs font-medium text-gray-700">UI/UX Design</div>
                                <div class="text-xs text-gray-500">Due: Dec 16</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- In Progress Column --}}
            <div class="bg-green-50 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-semibold text-green-700 flex items-center gap-2">
                        <i class="bi bi-play-circle text-green-600"></i>
                        In Progress
                    </h4>
                    <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs font-medium">1</span>
                </div>
                <div class="space-y-3" id="inProgressColumn">
                    <div class="bg-white border border-green-200 rounded-lg p-3 hover:shadow-md transition-all">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                MJ
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Mike Johnson</div>
                                <div class="flex items-center gap-2">
                                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-full text-xs font-medium">Developer</span>
                                    <span class="text-xs text-gray-500">1 task</span>
                                </div>
                            </div>
                            <div class="relative">
                                <button onclick="toggleMemberMenu('member3')" class="text-gray-400 hover:text-gray-600 p-1">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div id="member3Menu" class="hidden absolute right-0 top-8 bg-white border border-gray-200 rounded-lg shadow-lg w-36 z-10">
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-2">
                                        <i class="bi bi-pencil text-blue-600"></i>
                                        Edit Role
                                    </button>
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 flex items-center gap-2">
                                        <i class="bi bi-chat-dots text-green-600"></i>
                                        Message
                                    </button>
                                    <button class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 text-red-600 flex items-center gap-2">
                                        <i class="bi bi-person-dash"></i>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="bg-green-100 rounded p-2 border-l-4 border-green-500">
                                <div class="text-xs font-medium text-gray-700">Frontend Implementation</div>
                                <div class="text-xs text-gray-500">Progress: 65%</div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button onclick="assignRandomly()" class="px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all text-sm flex items-center gap-2">
                    <i class="bi bi-shuffle"></i>
                    Auto Assign
                </button>
                <button onclick="showWorkloadView()" class="px-3 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all text-sm flex items-center gap-2">
                    <i class="bi bi-bar-chart"></i>
                    Workload View
                </button>
            </div>
            <div class="text-sm text-gray-600">
                <i class="bi bi-info-circle"></i>
                Drag tasks between columns to reassign
            </div>
        </div>
    </div>
</div>

{{-- Add Member Modal --}}
<div id="addMemberModal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-50" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); z-index: 9999; padding: 1rem;">
    <div class="flex items-center justify-center min-h-full py-4">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all" style="width: 100%; max-width: 500px !important; margin: 0 auto; max-height: 90vh; display: flex; flex-direction: column;">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 flex-shrink-0">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Add Team Member</h3>
                        <p class="text-sm text-gray-600">Assign a new member to this project</p>
                    </div>
                    <button onclick="closeAddMemberModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-white hover:bg-opacity-80 rounded-lg">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6 overflow-y-auto flex-1">
                <form id="addMemberForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Team Member</label>
                        <select id="memberSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Choose a member...</option>
                            <option value="1">Emily Chen - Designer</option>
                            <option value="2">David Wilson - Developer</option>
                            <option value="3">Lisa Thompson - Project Manager</option>
                            <option value="4">Robert Kim - QA Tester</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="roleSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="member">Member</option>
                            <option value="lead">Lead</option>
                            <option value="designer">Designer</option>
                            <option value="developer">Developer</option>
                            <option value="tester">Tester</option>
                            <option value="viewer">Viewer</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Initial Assignment</label>
                        <select id="statusSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="assigned">Assigned</option>
                            <option value="not-assigned">Not Assigned</option>
                            <option value="in-progress">In Progress</option>
                        </select>
                    </div>
                </form>
            </div>
            
            <div class="px-6 py-3 border-t border-gray-200 bg-white flex justify-end gap-3 flex-shrink-0">
                <button onclick="closeAddMemberModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-all rounded-lg font-medium">
                    Cancel
                </button>
                <button onclick="addTeamMember()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all font-medium flex items-center gap-2">
                    <i class="bi bi-person-plus"></i>
                    Add Member
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Team assignment functionality
function openAddMemberModal() {
    const modal = document.getElementById('addMemberModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.style.display = 'block';
    }
}

function closeAddMemberModal() {
    const modal = document.getElementById('addMemberModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
}

function toggleMemberMenu(memberId) {
    const menu = document.getElementById(memberId + 'Menu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
    
    // Close other menus
    const allMenus = document.querySelectorAll('[id$="Menu"]');
    allMenus.forEach(m => {
        if (m.id !== memberId + 'Menu') {
            m.classList.add('hidden');
        }
    });
}

function addTeamMember() {
    const memberSelect = document.getElementById('memberSelect');
    const roleSelect = document.getElementById('roleSelect');
    const statusSelect = document.getElementById('statusSelect');
    
    if (!memberSelect.value) {
        alert('Please select a team member');
        return;
    }
    
    // Simulate adding member (in real implementation, this would make an API call)
    alert(`Added ${memberSelect.options[memberSelect.selectedIndex].text} as ${roleSelect.value}`);
    closeAddMemberModal();
    
    // Reset form
    memberSelect.value = '';
    roleSelect.value = 'member';
    statusSelect.value = 'assigned';
}

function assignRandomly() {
    alert('Auto-assigning unassigned tasks to available team members...');
    // Implementation would distribute unassigned tasks among team members
}

function showWorkloadView() {
    alert('Switching to workload view...');
    // Implementation would show a different view with workload charts
}

// Close menus when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('[onclick*="toggleMemberMenu"]') && !e.target.closest('[id$="Menu"]')) {
        const allMenus = document.querySelectorAll('[id$="Menu"]');
        allMenus.forEach(menu => menu.classList.add('hidden'));
    }
});

// Close modal when clicking outside
document.getElementById('addMemberModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeAddMemberModal();
    }
});

// Drag and drop functionality (basic implementation)
document.addEventListener('DOMContentLoaded', function() {
    const draggables = document.querySelectorAll('[draggable="true"]');
    const dropZones = document.querySelectorAll('[id$="Column"]');
    
    draggables.forEach(draggable => {
        draggable.addEventListener('dragstart', e => {
            e.dataTransfer.setData('text/plain', e.target.outerHTML);
            e.target.style.opacity = '0.5';
        });
        
        draggable.addEventListener('dragend', e => {
            e.target.style.opacity = '1';
        });
    });
    
    dropZones.forEach(zone => {
        zone.addEventListener('dragover', e => {
            e.preventDefault();
            zone.style.backgroundColor = 'rgba(59, 130, 246, 0.1)';
        });
        
        zone.addEventListener('dragleave', e => {
            zone.style.backgroundColor = '';
        });
        
        zone.addEventListener('drop', e => {
            e.preventDefault();
            zone.style.backgroundColor = '';
            // In real implementation, this would update the task assignment
            console.log('Task dropped in', zone.id);
        });
    });
});
</script>