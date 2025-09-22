<script>

window.toggleTaskStatus = function(checkbox, taskId) {
    const status = checkbox.checked ? 'completed' : 'pending';
    
    fetch(`/projects/tasks/${taskId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            checkbox.checked = !checkbox.checked;
            alert(data.message || 'Failed to update task status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        checkbox.checked = !checkbox.checked;
        alert('An error occurred while updating the task status');
    });
}

window.filterTasks = function(status = '') {
    const statusFilter = document.getElementById('statusFilter');
    
    if (status) {
        statusFilter.value = status;
    }
    
    const statusValue = statusFilter.value;
    const taskRows = document.querySelectorAll('.task-row');
    const taskCards = document.querySelectorAll('.task-card');
    
    taskRows.forEach(row => {
        const taskStatus = row.dataset.status;
        const statusMatch = !statusValue || taskStatus === statusValue;
        
        if (statusMatch) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
    
    taskCards.forEach(card => {
        const taskStatus = card.dataset.status;
        const statusMatch = !statusValue || taskStatus === statusValue;
        
        if (statusMatch) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('statusFilter');
    
    if (statusFilter) {
        statusFilter.addEventListener('change', () => filterTasks());
    }
});
</script>
