{{-- JavaScript for Team Management --}}
<script>
// Load available users for the inline form
document.addEventListener('DOMContentLoaded', function() {
    const userSelect = document.getElementById('user_select');
    const addTeamForm = document.getElementById('addTeamMemberForm');
    
    // Load available users when page loads
    if (userSelect) {
        loadAvailableUsers();
    }
    
    // Handle form submission
    if (addTeamForm) {
        addTeamForm.addEventListener('submit', function(e) {
            e.preventDefault();
            addTeamMemberInline();
        });
    }
});

function loadAvailableUsers() {
    const userSelect = document.getElementById('user_select');
    const projectId = document.querySelector('input[name="project_id"]')?.value;
    
    if (!projectId || !userSelect) return;
    
    fetch(`/projects/${projectId}/team-members`)
        .then(response => response.json())
        .then(data => {
            const availableUsers = data.available_users || [];
            userSelect.innerHTML = '<option value="">Choose a user...</option>';
            
            availableUsers.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = `${user.name} (${user.email})`;
                userSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading users:', error);
        });
}

function addTeamMemberInline() {
    const form = document.getElementById('addTeamMemberForm');
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    
    if (!csrfToken) {
        alert('Security token not found. Please refresh the page.');
        return;
    }
    
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <svg class="animate-spin h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
    `;
    
    const teamData = {
        project_id: formData.get('project_id'),
        team_members: [{
            user_id: formData.get('user_id'),
            role: formData.get('role')
        }]
    };
    
    fetch('/projects/assign-team', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        body: JSON.stringify(teamData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reset form
            form.reset();
            
            // Show success state briefly
            submitBtn.innerHTML = `
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Added!
            `;
            
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            throw new Error(data.message || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error adding team member: ' + error.message);
        
        // Reset button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}

if (typeof removeTeamMember === 'undefined') {
    function removeTeamMember(projectId, userId) {
        if (!confirm('Are you sure you want to remove this team member from the project?')) {
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            alert('Security token not found. Please refresh the page.');
            return;
        }

        fetch('/projects/team-member', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            },
            body: JSON.stringify({
                project_id: projectId,
                user_id: userId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Error removing team member');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing team member. Please try again.');
        });
    }
}

// Keep modal function for backward compatibility (but won't be used)
if (typeof openTeamModal === 'undefined') {
    function openTeamModal(projectId) {
        // This function is no longer needed as we use inline form
        console.log('Modal function called but inline form is used instead');
    }
}
</script>