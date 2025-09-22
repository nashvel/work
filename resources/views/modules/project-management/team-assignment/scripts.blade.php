{{-- Team Assignment Modal JavaScript Component --}}
<script>
let currentProjectId = null;
let teamMembers = [];
let availableUsers = [];

function saveFormState() {
    const formState = {
        currentProjectId: currentProjectId,
        teamMembers: teamMembers,
        availableUsers: availableUsers,
        selectedUser: document.getElementById('newMemberSelect')?.value || '',
        selectedRole: document.getElementById('newMemberRole')?.value || 'member',
        timestamp: Date.now()
    };
    localStorage.setItem('teamModalFormState', JSON.stringify(formState));
}

function loadFormState() {
    try {
        const savedState = localStorage.getItem('teamModalFormState');
        if (savedState) {
            const formState = JSON.parse(savedState);

            const isRecent = (Date.now() - formState.timestamp) < (24 * 60 * 60 * 1000);
            
            if (isRecent && formState.currentProjectId) {
                currentProjectId = formState.currentProjectId;
                teamMembers = formState.teamMembers || [];
                availableUsers = formState.availableUsers || [];

                setTimeout(() => {
                    const userSelect = document.getElementById('newMemberSelect');
                    const roleSelect = document.getElementById('newMemberRole');
                    
                    if (userSelect && formState.selectedUser) {
                        userSelect.value = formState.selectedUser;
                    }
                    if (roleSelect && formState.selectedRole) {
                        roleSelect.value = formState.selectedRole;
                    }

                    renderTeamMembers();
                    renderAvailableUsers();
                }, 100);
                
                return true; 
            }
        }
    } catch (error) {
        console.error('Error loading form state:', error);
    }
    return false; 
}

function clearFormState() {
    localStorage.removeItem('teamModalFormState');
}

function openTeamModal(projectId) {
    currentProjectId = projectId;
    const modal = document.getElementById('teamAssignmentModal');
    const modalContent = modal.querySelector('.transform');
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }, 10);
    
    if (!loadFormState() || currentProjectId !== projectId) {
        loadTeamData();
    }
}

function closeTeamModal() {
    const modal = document.getElementById('teamAssignmentModal');
    const modalContent = modal.querySelector('.transform');

    saveFormState();
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100');
    modalContent.classList.add('scale-95');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 150);
}

function loadTeamData() {
    fetch(`/projects/${currentProjectId}/team-members`)
        .then(response => response.json())
        .then(data => {
            teamMembers = data.team_members || [];
            availableUsers = data.available_users || [];
            renderTeamMembers();
            renderAvailableUsers();
        })
        .catch(error => {
            console.error('Error loading team data:', error);
        });
}

function renderTeamMembers() {
    const container = document.getElementById('teamMembersList');
    const loadingElement = document.getElementById('loadingTeamMembers');

    if (loadingElement) {
        loadingElement.style.display = 'none';
    }
    
    if (teamMembers.length === 0) {
        container.innerHTML = `
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="text-gray-500 font-medium">No team members assigned yet</p>
                <p class="text-gray-400 text-sm">Add team members using the form below</p>
            </div>
        `;
        return;
    }

    container.innerHTML = teamMembers.map(member => `
        <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg hover:shadow-sm transition-shadow">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm">
                    ${member.name.charAt(0).toUpperCase()}
                </div>
                <div>
                    <p class="font-medium text-gray-900">${member.name}</p>
                    <p class="text-sm text-gray-500">${member.email}</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <select onchange="updateMemberRole(${member.id}, this.value)" class="px-3 py-1.5 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="member" ${member.pivot.role === 'member' ? 'selected' : ''}>Member</option>
                    <option value="lead" ${member.pivot.role === 'lead' ? 'selected' : ''}>Lead</option>
                    <option value="manager" ${member.pivot.role === 'manager' ? 'selected' : ''} disabled>Manager</option>
                    <option value="viewer" ${member.pivot.role === 'viewer' ? 'selected' : ''}>Viewer</option>
                </select>
                ${member.pivot.role !== 'manager' ? `
                    <button onclick="removeTeamMember(${member.id})" class="text-red-600 hover:text-red-800 p-1.5 rounded-md hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                ` : `<span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded">Owner</span>`}
            </div>
        </div>
    `).join('');
}

function renderAvailableUsers() {
    const select = document.getElementById('newMemberSelect');
    select.innerHTML = '<option value="">Select a user...</option>' + 
        availableUsers.map(user => `<option value="${user.id}">${user.name} (${user.email})</option>`).join('');
}

function addTeamMember() {
    const userSelect = document.getElementById('newMemberSelect');
    const roleSelect = document.getElementById('newMemberRole');
    
    if (!userSelect.value) {
        alert('Please select a user to add');
        return;
    }

    const userId = parseInt(userSelect.value);
    const role = roleSelect.value;
    const user = availableUsers.find(u => u.id === userId);

    if (!user) return;


    teamMembers.push({
        id: user.id,
        name: user.name,
        email: user.email,
        pivot: { role: role }
    });

    availableUsers = availableUsers.filter(u => u.id !== userId);

    renderTeamMembers();
    renderAvailableUsers();
    userSelect.value = '';
    roleSelect.value = 'member';
    
    saveFormState();
}

function updateMemberRole(userId, newRole) {
    const member = teamMembers.find(m => m.id === userId);
    if (member) {
        member.pivot.role = newRole;
        saveFormState();
    }
}

function removeTeamMember(userId) {
    const member = teamMembers.find(m => m.id === userId);
    if (!member) return;

    teamMembers = teamMembers.filter(m => m.id !== userId);

    availableUsers.push({
        id: member.id,
        name: member.name,
        email: member.email
    });

    renderTeamMembers();
    renderAvailableUsers();
    
    saveFormState();
}

function saveTeamAssignment() {
    const saveBtn = document.getElementById('saveTeamBtn');
    const originalText = saveBtn.innerHTML;
    

    saveBtn.disabled = true;
    saveBtn.innerHTML = `
        <svg class="animate-spin h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Saving...
    `;

    const teamData = teamMembers.map(member => ({
        user_id: member.id,
        role: member.pivot.role
    }));

    fetch('/projects/assign-team', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            project_id: currentProjectId,
            team_members: teamData
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            saveBtn.innerHTML = `
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Saved!
            `;
            setTimeout(() => {
                closeTeamModal();

                clearFormState();
                window.location.reload();
            }, 1000);
        } else {
            throw new Error(data.message || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving team assignment: ' + error.message);

        saveBtn.disabled = false;
        saveBtn.innerHTML = originalText;
    });
}

document.getElementById('teamAssignmentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTeamModal();
    }
});
</script>
