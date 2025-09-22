let currentTaskId = null;
let pendingAssignments = new Set();
let pendingRemovals = new Set();
let currentAssignments = new Set();

window.assignMorePeople = function(taskId) {
    
    currentTaskId = taskId;
    pendingAssignments.clear();
    pendingRemovals.clear();
    currentAssignments.clear();

    const modal = document.getElementById('peopleAssignmentModal');
    
    if (!modal) {
        alert(`Modal not available. Adding more assignees to task ${taskId}...`);
        return;
    }

    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    const taskName = taskRow ? taskRow.querySelector('.font-medium.text-gray-900')?.textContent?.trim() || `Task ${taskId}` : `Task ${taskId}`;
    const modalTitle = modal.querySelector('h3');
    if (modalTitle) {
        modalTitle.textContent = `Assign People - ${taskName}`;
    }
    

    modal.style.display = 'block';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    const taskIdInput = modal.querySelector('#taskId');
    if (taskIdInput) {
        taskIdInput.value = 'task-' + taskId;
    }

    showCurrentAssignments(taskId);

    populateTeamMembersList();
}

function getLocalAvatar(personName) {
    if (!personName || typeof personName !== 'string' || personName.length === 0) {
        return '/assets/images/faces/1.jpg'; 
    }
    
    //Harcoded for now
    const avatarMap = {
        'System Administrator': '/assets/images/faces/1.jpg',
        'Cesilia Cortez': '/assets/images/faces/2.jpg',
    };
    
    // Check if person has a specific avatar
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


function populateTeamMembersList() {
    const peopleListContainer = document.getElementById('peopleList');
    if (!peopleListContainer) return;
    
    let teamMembers = [];

    if (window.projectTeamMembers && window.projectTeamMembers.length > 0) {
        teamMembers = window.projectTeamMembers.map(member => member.name || member.user?.name || member.email);
    } else {
        const existingAssignees = document.querySelectorAll('.task-row img[alt]');
        const uniqueNames = new Set();
        existingAssignees.forEach(img => {
            const name = img.getAttribute('alt');
            if (name && name !== 'undefined') {
                uniqueNames.add(name);
            }
        });
        teamMembers = Array.from(uniqueNames);
        
        if (teamMembers.length === 0) {
            teamMembers = ['System Administrator', 'Cesilia Cortez', 'John Doe', 'Jane Smith'];
        }
    }

    const assignedMembers = new Set([...currentAssignments, ...pendingAssignments]);
    pendingRemovals.forEach(member => assignedMembers.delete(member));
    
    const availableMembers = teamMembers.filter(member => !assignedMembers.has(member));
    
    const teamMembersHtml = availableMembers.map(member => `
        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-md cursor-pointer team-member-item" data-member="${member}">
            <div class="flex items-center">
                <img src="${getLocalAvatar(member)}" 
                     class="w-8 h-8 rounded-full mr-3 object-cover" 
                     alt="${member}">
                <span class="text-sm text-gray-900">${member}</span>
            </div>
            <button class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 assign-btn" 
                    onclick="stageAssignMember('${member}')">
                Assign
            </button>
        </div>
    `).join('');
    
    peopleListContainer.innerHTML = teamMembersHtml || '<div class="text-sm text-gray-500 text-center py-4">All team members are already assigned</div>';
}

function showCurrentAssignments(taskId) {
    const currentlyAssignedContainer = document.getElementById('currentlyAssigned');
    if (!currentlyAssignedContainer) return;

    if (currentAssignments.size === 0) {
        currentlyAssignedContainer.innerHTML = `
            <div class="mb-3">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Currently Assigned:</h4>
                <div class="space-y-2">
                    <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 animate-pulse">
                        <div class="w-6 h-6 bg-gray-300 rounded-full mr-2"></div>
                        <div class="h-4 bg-gray-300 rounded w-24"></div>
                    </div>
                </div>
            </div>
        `;
        
        const numericTaskId = taskId.replace('task-', '');

        fetch(`/project-management/tasks/${numericTaskId}/assignments`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.assignments) {
                    currentAssignments.clear();
                    data.assignments.forEach(assignment => currentAssignments.add(assignment));
                    displayCurrentAssignments(data.assignments);
                } else {
                    displayCurrentAssignments([]);
                }
            })
            .catch(error => {
                displayCurrentAssignments([]);
            });
    } else {
        const finalAssignments = [...currentAssignments, ...pendingAssignments].filter(member => !pendingRemovals.has(member));
        displayCurrentAssignments(finalAssignments);
    }
}

function displayCurrentAssignments(assignments) {
    const currentlyAssignedContainer = document.getElementById('currentlyAssigned');
    if (!currentlyAssignedContainer) return;
    
    if (assignments.length === 0) {
        currentlyAssignedContainer.innerHTML = `
            <div class="mb-3">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Currently Assigned:</h4>
                <div class="text-sm text-gray-500">No one assigned</div>
            </div>
        `;
        return;
    }
    
    const assignmentHtml = assignments.map(assignment => `
        <div class="flex items-center bg-blue-50 rounded-lg px-3 py-2 mb-2">
            <img src="${getLocalAvatar(assignment.name)}" 
                 class="w-6 h-6 rounded-full mr-2" 
                 alt="${assignment.name}">
            <span class="text-sm text-gray-700">${assignment.name}</span>
            <button onclick="removeAssignment('${assignment.name}')" 
                    class="ml-auto text-red-500 hover:text-red-700 text-xs">
                <i class="bi bi-x-circle"></i>
            </button>
        </div>
    `).join('');
    
    currentlyAssignedContainer.innerHTML = `
        <div class="mb-3">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Currently Assigned:</h4>
            ${assignmentHtml}
        </div>
    `;
}

window.stageAssignMember = function(memberName) {
    pendingAssignments.add(memberName);
    pendingRemovals.delete(memberName); 
    
    displayCurrentAssignments([...currentAssignments, ...pendingAssignments].filter(member => !pendingRemovals.has(member)));
    populateTeamMembersList();
}

window.stageRemoveMember = function(memberName) {
    
    if (pendingAssignments.has(memberName)) {
        pendingAssignments.delete(memberName);
    } else {
        pendingRemovals.add(memberName);
    }
    
    displayCurrentAssignments([...currentAssignments, ...pendingAssignments].filter(member => !pendingRemovals.has(member)));
    populateTeamMembersList();
}

window.assignMemberToTask = function(memberName) {
    stageAssignMember(memberName);
}

window.unassignMemberFromTask = function(memberName) {
    stageRemoveMember(memberName);
}


function showSuccessMessage(message) {
    // Create and show success toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

function showErrorMessage(message) {
    // Create and show error toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Function to save people assignment with button disable/enable
window.savePeopleAssignment = function() {
    const saveBtn = document.getElementById('saveAssignmentBtn');
    if (!saveBtn) return;
    
    // Disable button to prevent double clicks
    saveBtn.disabled = true;
    saveBtn.textContent = 'Saving...';
    
    // Process pending changes
    const hasChanges = pendingAssignments.size > 0 || pendingRemovals.size > 0;
    
    if (!hasChanges) {
        showSuccessMessage('No changes to save');
        saveBtn.disabled = false;
        saveBtn.textContent = 'Save Assignment';
        return;
    }

    setTimeout(() => {
        pendingAssignments.forEach(member => {
            currentAssignments.add(member);
        });
        
        pendingRemovals.forEach(member => {
            currentAssignments.delete(member);
        });
        
        const totalChanges = pendingAssignments.size + pendingRemovals.size;
        pendingAssignments.clear();
        pendingRemovals.clear();
        
        showSuccessMessage(`${totalChanges} assignment change(s) saved successfully!`);
        
        saveBtn.disabled = false;
        saveBtn.textContent = 'Save Assignment';

        window.closePeopleAssignmentModal();

        updateTaskRowAssignments(currentTaskId, Array.from(currentAssignments));
        populateTeamMembersList();

        updateTaskAssignmentsAPI(currentTaskId, Array.from(currentAssignments));
    }, 1000);
}

window.closePeopleAssignmentModal = function() {
    const modal = document.getElementById('peopleAssignmentModal');
    if (modal) {
        modal.style.display = 'none';
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

function updateTaskAssignmentsAPI(taskId, assignedMembers) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const numericTaskId = taskId.replace('task-', '');
    
    fetch(`/project-management/tasks/${numericTaskId}/assign`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            assigned_users: assignedMembers.map(name => {
                const user = window.projectTeamMembers?.find(member => 
                    (member.name === name) || 
                    (member.user?.name === name) || 
                    (member.email === name)
                );
                return user ? (user.id || user.user?.id) : null;
            }).filter(id => id !== null)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
        } else {
            showErrorMessage('Failed to update assignments');
        }
    })
    .catch(error => {
        showErrorMessage('Error updating assignments');
    });
}

function changePriority(taskId) {
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskRow) return;
    
    const priorityContainer = taskRow.querySelector('.col-span-1 .flex.items-center.cursor-pointer');
    if (!priorityContainer) return;

    const stars = priorityContainer.querySelectorAll('i');
    let currentPriority = 0;
    
    stars.forEach(star => {
        if (star.classList.contains('bi-star-fill')) {
            currentPriority++;
        }
    });

    const newPriority = currentPriority >= 5 ? 1 : currentPriority + 1;
    
    stars.forEach((star, index) => {
        if (index < newPriority) {
            star.className = 'bi bi-star-fill text-xs';
            if (newPriority === 5) star.classList.add('text-red-500');
            else if (newPriority === 4) star.classList.add('text-orange-500');
            else if (newPriority === 3) star.classList.add('text-yellow-500');
            else if (newPriority === 2) star.classList.add('text-blue-500');
            else star.classList.add('text-green-500');
        } else {
            star.className = 'bi bi-star text-gray-300 text-xs';
        }
    });
    
}

function updateTaskRowAssignments(taskId, assignedMembers) {
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskRow) return;
    
    const assigneesSection = taskRow.querySelector('.col-span-2 .flex');
    if (!assigneesSection) return;

    const existingAvatars = assigneesSection.querySelectorAll('img[alt]:not([onclick])');
    existingAvatars.forEach(avatar => avatar.parentElement.remove());

    const addButton = assigneesSection.querySelector('button[onclick*="assignMorePeople"]');
    
    assignedMembers.forEach(member => {
        const avatarDiv = document.createElement('div');
        avatarDiv.className = 'relative group';
        avatarDiv.innerHTML = `
            <img src="${getLocalAvatar(member)}" 
                 class="w-8 h-8 rounded-full border-2 border-white hover:scale-110 transition-transform cursor-pointer" 
                 alt="${member}"
                 title="${member}">
        `;
        
        if (addButton) {
            assigneesSection.insertBefore(avatarDiv, addButton);
        } else {
            assigneesSection.appendChild(avatarDiv);
        }
    });
}

function updateTaskStatus(taskId, newStatus) {
    
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskRow) return;
    
    const progressBar = taskRow.querySelector('.bg-blue-500, .bg-green-500, .bg-red-500');
    const progressText = taskRow.querySelector('.text-xs.text-gray-500');
    
    let progress = 0;
    switch(newStatus) {
        case 'working':
            progress = 50;
            break;
        case 'stuck':
            progress = 25;
            break;
        case 'done':
            progress = 100;
            break;
        default:
            progress = 0;
    }
    
    if (progressBar) {
        progressBar.style.width = `${progress}%`;
    }
    
    if (progressText) {
        progressText.textContent = `${progress}% complete`;
    }

    if (newStatus === 'done') {
        taskRow.style.opacity = '0.8';
        setTimeout(() => {
            taskRow.style.opacity = '1';
        }, 500);
    }
}
