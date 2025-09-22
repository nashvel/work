<script>
const projectId = {{ $project->id }};

window.openAddMemberModal = function() {
    document.getElementById('addMemberModal').classList.remove('hidden');
    document.getElementById('userSearch').focus();
}

window.closeAddMemberModal = function() {
    document.getElementById('addMemberModal').classList.add('hidden');
    document.getElementById('addMemberForm').reset();
    document.getElementById('userDropdown').classList.add('hidden');
    document.getElementById('selectedUserPreview').classList.add('hidden');
    document.getElementById('selectedUserId').value = '';
    document.getElementById('userSearch').value = '';
}

window.selectUser = function(userId, userName, userEmail) {
    document.getElementById('selectedUserId').value = userId;
    document.getElementById('selectedUserName').textContent = userName;
    document.getElementById('selectedUserEmail').textContent = userEmail;
    document.getElementById('selectedUserInitial').textContent = userName.charAt(0).toUpperCase();
    document.getElementById('userSearch').value = userName;
    document.getElementById('userDropdown').classList.add('hidden');
    document.getElementById('selectedUserPreview').classList.remove('hidden');
}

window.clearSelectedUser = function() {
    document.getElementById('selectedUserId').value = '';
    document.getElementById('userSearch').value = '';
    document.getElementById('selectedUserPreview').classList.add('hidden');
    document.getElementById('userSearch').focus();
}

window.removeMember = function(userId) {
    if (!confirm('Are you sure you want to remove this team member from the project?')) return;
    
    fetch('/projects/team-member', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ project_id: projectId, user_id: userId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert(data.message || 'Failed to remove team member');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while removing the team member');
    });
}

window.openEditRoleModal = function(userId, userName, userEmail, currentRole) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editMemberName').textContent = userName;
    document.getElementById('editMemberEmail').textContent = userEmail;
    
    const avatarImg = document.getElementById('editMemberAvatar');
    const memberCard = document.querySelector(`[data-member-id="${userId}"] img`);
    
    if (memberCard) {
        avatarImg.src = memberCard.src;
        avatarImg.alt = userName;
    } else {
        const hash = userName.split('').reduce((a, b) => a + b.charCodeAt(0), 0);
        const faceIndex = Math.abs(hash) % 16 + 1;
        avatarImg.src = `/assets/images/faces/${faceIndex}.jpg`;
        avatarImg.alt = userName;
    }
    
    document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.checked = radio.value === currentRole;
    });
    
    document.getElementById('editRoleModal').classList.remove('hidden');
}

window.closeEditRoleModal = function() {
    document.getElementById('editRoleModal').classList.add('hidden');
    document.getElementById('editRoleForm').reset();
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addMemberForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const userId = document.getElementById('selectedUserId').value;
        const role = document.getElementById('memberRole').value;
        
        if (!userId) {
            alert('Please select a user from the search results');
            return;
        }
        
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Adding...';
        submitBtn.disabled = true;
        
        fetch('/projects/assign-team', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                project_id: projectId,
                team_members: [{ user_id: parseInt(userId), role: role }]
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Failed to add team member');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the team member');
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });
    
    document.getElementById('editRoleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const userId = document.getElementById('editUserId').value;
        const selectedRole = document.querySelector('input[name="role"]:checked');
        
        if (!selectedRole) {
            alert('Please select a role');
            return;
        }
        
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Updating...';
        submitBtn.disabled = true;
        
        fetch('/projects/assign-team', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                project_id: projectId,
                team_members: [{ user_id: parseInt(userId), role: selectedRole.value }]
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Failed to update member role');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the role');
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });
    
    document.getElementById('userSearch').addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const dropdown = document.getElementById('userDropdown');
        const options = dropdown.querySelectorAll('.user-option');
        
        if (query.length === 0) {
            dropdown.classList.add('hidden');
            return;
        }
        
        let hasVisibleOptions = false;
        options.forEach(option => {
            const searchText = option.dataset.search;
            if (searchText.includes(query)) {
                option.style.display = 'flex';
                hasVisibleOptions = true;
            } else {
                option.style.display = 'none';
            }
        });
        
        if (hasVisibleOptions) {
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    });
    
    document.getElementById('userSearch').addEventListener('focus', function() {
        if (this.value.length > 0) {
            document.getElementById('userDropdown').classList.remove('hidden');
        }
    });
    
    document.querySelectorAll('.user-option').forEach(option => {
        option.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.dataset.name;
            const userEmail = this.dataset.email;
            selectUser(userId, userName, userEmail);
        });
    });
    
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#userSearch') && !e.target.closest('#userDropdown')) {
            document.getElementById('userDropdown').classList.add('hidden');
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddMemberModal();
            closeEditRoleModal();
            document.getElementById('userDropdown').classList.add('hidden');
        }
    });
});
</script>
