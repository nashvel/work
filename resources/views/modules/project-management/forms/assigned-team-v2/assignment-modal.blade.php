<!-- Assignment Modal - @Mention Style -->
<div id="peopleAssignmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Assign People</h3>
                <button onclick="closeAssignmentModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="assignmentForm" method="POST">
                @csrf
                <input type="hidden" name="task_id" id="taskIdInput">
                
                <!-- @Mention Input -->
                <div class="mb-6">
                    <label class="text-sm font-medium text-gray-700 mb-2 block">Type @ to mention people:</label>
                    <div class="relative">
                        <div id="mentionContainer" 
                             class="min-h-[100px] max-h-[200px] overflow-y-auto p-3 border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-transparent bg-white cursor-text"
                             onclick="focusMentionInput()">
                            
                            <!-- Mentioned Users Display -->
                            <div id="mentionedUsers" class="flex flex-wrap gap-2 mb-2"></div>
                            
                            <!-- Input Field -->
                            <input type="text" 
                                   id="mentionInput" 
                                   placeholder="Type @ to mention team members..."
                                   class="border-none outline-none bg-transparent flex-1 min-w-[200px]"
                                   autocomplete="off">
                        </div>
                        
                        <!-- Autocomplete Dropdown -->
                        <div id="mentionDropdown" 
                             class="absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden max-h-48 overflow-y-auto">
                        </div>
                    </div>
                    
                    <!-- Hidden inputs for selected users -->
                    <div id="hiddenInputs"></div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeAssignmentModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                        Save Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// @Mention Assignment Modal
let currentTaskId = null;
let availableUsers = [];
let selectedUsers = new Set();
let isShowingDropdown = false;

function generateAvatarUrl(userName) {
    const hash = userName.split('').reduce((a, b) => a + b.charCodeAt(0), 0);
    const faceIndex = Math.abs(hash) % 16 + 1;
    return `/assets/images/faces/${faceIndex}.jpg`;
}

function openAssignmentModal(taskId) {
    currentTaskId = taskId;
    const modal = document.getElementById('peopleAssignmentModal');
    const form = document.getElementById('assignmentForm');
    const taskIdInput = document.getElementById('taskIdInput');
    const modalTitle = document.getElementById('modalTitle');
    
    // Set task ID
    taskIdInput.value = taskId;
    
    // Update modal title
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    const taskName = taskRow ? taskRow.querySelector('.font-medium.text-gray-900')?.textContent?.trim() || `Task ${taskId}` : `Task ${taskId}`;
    modalTitle.textContent = `Assign Peoples - ${taskName}`;
    
    // Set form action - extract numeric ID
    const numericTaskId = taskId.replace('task-', '');
    form.action = `/project-management/tasks/${numericTaskId}/assign`;
    
    // Clear previous state
    selectedUsers.clear();
    document.getElementById('mentionedUsers').innerHTML = '';
    document.getElementById('mentionInput').value = '';
    document.getElementById('hiddenInputs').innerHTML = '';
    hideDropdown();
    
    // Load current data
    loadAssignmentData(taskId);
    
    // Show modal
    modal.classList.remove('hidden');
    
    // Focus input
    setTimeout(() => {
        document.getElementById('mentionInput').focus();
    }, 100);
}

function closeAssignmentModal() {
    const modal = document.getElementById('peopleAssignmentModal');
    modal.classList.add('hidden');
    currentTaskId = null;
    hideDropdown();
}

function loadAssignmentData(taskId) {
    const numericTaskId = taskId.replace('task-', '');
    
    fetch(`/project-management/tasks/${numericTaskId}/assignment-data`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Assignment data received:', data);
            
            const availableArray = Array.isArray(data.available) ? data.available : [];
            const currentArray = Array.isArray(data.current) ? data.current : [];
            
            availableUsers = [...availableArray, ...currentArray];
            
            if (currentArray.length > 0) {
                currentArray.forEach(user => {
                    if (user && user.id && user.name) {
                        addMentionedUser(user);
                    }
                });
            }
            
            console.log('Available users loaded:', availableUsers.length);
            
            if (isShowingDropdown && document.getElementById('mentionDropdown').innerHTML.includes('animate-pulse')) {
                hideDropdown();
            }
        })
        .catch(error => {
            console.error('Error loading assignment data:', error);
            
            fetch('/api/users')
                .then(response => response.json())
                .then(users => {
                    availableUsers = users.map(user => ({
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        avatar: user.profile_photo_path ? `/storage/${user.profile_photo_path}` : generateAvatarUrl(user.name)
                    }));
                    console.log('Loaded fallback users from API:', availableUsers.length);
                    
                    if (isShowingDropdown && document.getElementById('mentionDropdown').innerHTML.includes('animate-pulse')) {
                        hideDropdown();
                    }
                })
                .catch(apiError => {
                    console.error('Failed to load users from API:', apiError);
                    availableUsers = [];
                });
        });
}

function focusMentionInput() {
    document.getElementById('mentionInput').focus();
}

function addMentionedUser(user) {
    if (selectedUsers.has(user.id)) return;
    
    selectedUsers.add(user.id);
    
    const avatarUrl = user.avatar || generateAvatarUrl(user.name);
    
    const mentionedUsersContainer = document.getElementById('mentionedUsers');
    const mentionTag = document.createElement('div');
    mentionTag.className = 'inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-sm rounded-full';
    mentionTag.innerHTML = `
        <img src="${avatarUrl}" class="w-4 h-4 rounded-full mr-1" alt="${user.name}">
        <span>@${user.name}</span>
        <button type="button" onclick="removeMentionedUser(${user.id})" class="ml-1 text-blue-600 hover:text-blue-800">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    mentionedUsersContainer.appendChild(mentionTag);
    
    const hiddenInputsContainer = document.getElementById('hiddenInputs');
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'assigned_users[]';
    hiddenInput.value = user.id;
    hiddenInput.id = `hidden-user-${user.id}`;
    hiddenInputsContainer.appendChild(hiddenInput);
}

function removeMentionedUser(userId) {
    selectedUsers.delete(userId);
    
    // Remove visual tag
    const mentionedUsersContainer = document.getElementById('mentionedUsers');
    const tagToRemove = Array.from(mentionedUsersContainer.children).find(tag => 
        tag.innerHTML.includes(`removeMentionedUser(${userId})`)
    );
    if (tagToRemove) {
        tagToRemove.remove();
    }
    
    // Remove hidden input
    const hiddenInput = document.getElementById(`hidden-user-${userId}`);
    if (hiddenInput) {
        hiddenInput.remove();
    }
}

function showDropdown(filteredUsers) {
    const dropdown = document.getElementById('mentionDropdown');
    
    if (filteredUsers.length === 0) {
        hideDropdown();
        return;
    }
    
    const html = filteredUsers.map(user => {
        const avatarUrl = user.avatar || generateAvatarUrl(user.name);
        return `
            <div class="flex items-center p-3 hover:bg-gray-50 cursor-pointer mention-option" 
                 onclick="selectUser(${user.id}, this)">
                <img src="${avatarUrl}" class="w-8 h-8 rounded-full mr-3" alt="${user.name}">
                <div>
                    <div class="font-medium text-gray-900">${user.name}</div>
                </div>
            </div>
        `;
    }).join('');
    
    dropdown.innerHTML = html;
    dropdown.classList.remove('hidden');
    isShowingDropdown = true;
}

function showSkeletonDropdown() {
    const dropdown = document.getElementById('mentionDropdown');
    
    const skeletonHtml = Array(3).fill(0).map(() => `
        <div class="flex items-center p-3 animate-pulse">
            <div class="w-8 h-8 bg-gray-200 rounded-full mr-3"></div>
            <div class="flex-1">
                <div class="h-4 bg-gray-200 rounded w-24 mb-1"></div>
                <div class="h-3 bg-gray-200 rounded w-32"></div>
            </div>
        </div>
    `).join('');
    
    dropdown.innerHTML = skeletonHtml;
    dropdown.classList.remove('hidden');
    isShowingDropdown = true;
}

function hideDropdown() {
    const dropdown = document.getElementById('mentionDropdown');
    dropdown.classList.add('hidden');
    isShowingDropdown = false;
}

function selectUser(userId) {
    const user = availableUsers.find(u => u.id === userId);
    if (user) {
        addMentionedUser(user);
        document.getElementById('mentionInput').value = '';
        hideDropdown();
        focusMentionInput();
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    const mentionInput = document.getElementById('mentionInput');
    
    if (mentionInput) {
        mentionInput.addEventListener('input', function(e) {
            const value = e.target.value;
            
            if (value.includes('@')) {
                const lastAtIndex = value.lastIndexOf('@');
                const searchTerm = value.substring(lastAtIndex + 1).toLowerCase();
                
                if (availableUsers.length === 0) {
                    showSkeletonDropdown();
                } else {
                    const filteredUsers = availableUsers.filter(user => {
                        const isNotSelected = !selectedUsers.has(user.id);
                        const matchesSearch = searchTerm.length === 0 || user.name.toLowerCase().includes(searchTerm);
                        return isNotSelected && matchesSearch;
                    });
                    
                    showDropdown(filteredUsers);
                }
            } else {
                hideDropdown();
            }
        });
        
        mentionInput.addEventListener('keyup', function(e) {
            if (e.key === '@' || e.key === 'Shift') {
                const value = e.target.value;
                if (value.includes('@')) {
                    if (availableUsers.length === 0) {
                        showSkeletonDropdown();
                    } else {
                        const unselectedUsers = availableUsers.filter(user => !selectedUsers.has(user.id));
                        showDropdown(unselectedUsers);
                    }
                }
            }
        });
        
        mentionInput.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && e.target.value === '' && selectedUsers.size > 0) {
                // Remove last mentioned user when backspace on empty input
                const lastUserId = Array.from(selectedUsers).pop();
                removeMentionedUser(lastUserId);
            }
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#mentionContainer') && !e.target.closest('#mentionDropdown')) {
            hideDropdown();
        }
    });
});

// Form submission
document.getElementById('assignmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update task row in real-time without page refresh
            updateTaskRowAssignments(currentTaskId, data.assignments || []);
            closeAssignmentModal();
            
            // Show success message
            showSuccessToast('Assignments updated successfully');
        } else {
            alert('Error saving assignments: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving assignments');
    });
});

// Function to update task row assignments in real-time
function updateTaskRowAssignments(taskId, assignments) {
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskRow) return;
    
    // Find the assignment container (col-span-2 with avatars)
    const assignmentCol = taskRow.querySelector('.col-span-2 .flex.items-center');
    if (!assignmentCol) return;
    
    // Remove existing avatar images (but keep the + button)
    const existingAvatars = assignmentCol.querySelectorAll('img');
    existingAvatars.forEach(img => img.remove());
    
    // Find the + button to insert avatars before it
    const addButton = assignmentCol.querySelector('button');
    
    if (assignments.length === 0) {
        // No assignments - just keep the + button
        return;
    }
    
    // Add new assignments with proper styling to match existing UI
    assignments.forEach(user => {
        const avatarContainer = document.createElement('div');
        avatarContainer.className = 'relative group';
        
        const img = document.createElement('img');
        img.src = user.avatar;
        img.className = 'w-8 h-8 rounded-full border-2 border-white hover:scale-110 transition-transform cursor-pointer';
        img.alt = user.name;
        img.title = user.name;
        
        avatarContainer.appendChild(img);
        
        // Insert before the + button
        if (addButton) {
            assignmentCol.insertBefore(avatarContainer, addButton);
        } else {
            assignmentCol.appendChild(avatarContainer);
        }
    });
}

function updateAssignmentSection(section, assignments) {
    // Find and update the assignment part of the section
    const images = section.querySelectorAll('img[alt]');
    
    // Remove existing assignment images
    images.forEach(img => {
        if (img.alt && img.alt !== 'undefined') {
            img.remove();
        }
    });
    
    if (assignments.length === 0) return;
    
    // Add new assignment images
    assignments.forEach(user => {
        const img = document.createElement('img');
        img.src = user.avatar;
        img.className = 'w-6 h-6 rounded-full border-2 border-white -ml-1 first:ml-0';
        img.alt = user.name;
        img.title = user.name;
        section.appendChild(img);
    });
}

// Success toast notification
function showSuccessToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full';
    toast.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            ${message}
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

// Replace the complex assignMorePeople function
window.assignMorePeople = openAssignmentModal;
</script>
