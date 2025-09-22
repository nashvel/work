// Task Management Functions
function assignMorePeople(taskId) {
    alert(`Assigning more people to task ${taskId}...\n\nOptions:\nAdd team members\nSet role permissions\nConfigure notifications\nView assignment history`);
}

function changePriority(taskId) {
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskRow) return;
    
    const priorityContainer = taskRow.querySelector('.col-span-1 .flex.items-center.cursor-pointer');
    if (!priorityContainer) return;
    
    // Simple priority cycling for now
    const stars = priorityContainer.querySelectorAll('i');
    let currentPriority = 0;
    
    stars.forEach(star => {
        if (star.classList.contains('bi-star-fill')) {
            currentPriority++;
        }
    });
    
    // Cycle to next priority (1-5)
    const newPriority = currentPriority >= 5 ? 1 : currentPriority + 1;
    
    // Update stars display
    stars.forEach((star, index) => {
        if (index < newPriority) {
            star.className = 'bi bi-star-fill text-xs';
            // Set color based on priority
            if (newPriority === 5) star.classList.add('text-red-500');
            else if (newPriority === 4) star.classList.add('text-orange-500');
            else if (newPriority === 3) star.classList.add('text-yellow-500');
            else if (newPriority === 2) star.classList.add('text-blue-500');
            else star.classList.add('text-green-500');
        } else {
            star.className = 'bi bi-star text-gray-300 text-xs';
        }
    });
    
    console.log(`Priority changed to ${newPriority} for task ${taskId}`);
}

