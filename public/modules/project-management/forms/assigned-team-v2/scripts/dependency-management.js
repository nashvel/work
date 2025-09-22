function manageDependencies(taskId) {
    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskRow) return;
    
    const dependencyCell = taskRow.querySelector('.col-span-2:last-child');
    if (!dependencyCell) return;
    
    const selectorHtml = `
        <div class="dependency-selector bg-white border border-gray-300 rounded-lg p-3 shadow-lg" style="position: absolute; z-index: 1000; min-width: 300px;">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Link Dependencies</span>
                <button onclick="closeDependencySelector('${taskId}')" class="text-gray-400 hover:text-gray-600">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="space-y-2">
                <div class="text-xs text-gray-500 mb-2">Select tasks this depends on:</div>
                <div class="max-h-32 overflow-y-auto space-y-1" id="dependency-list-${taskId}">
                    <!-- Will be populated with available tasks -->
                </div>
                <div class="flex gap-2 mt-3 pt-2 border-t">
                    <button onclick="saveDependencies('${taskId}')" class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                        Save
                    </button>
                    <button onclick="closeDependencySelector('${taskId}')" class="px-3 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.querySelectorAll('.dependency-selector').forEach(el => el.remove());

    dependencyCell.style.position = 'relative';
    dependencyCell.insertAdjacentHTML('beforeend', selectorHtml);

    populateDependencyList(taskId);
}

function populateDependencyList(currentTaskId) {
    const listContainer = document.getElementById(`dependency-list-${currentTaskId}`);
    if (!listContainer) return;

    const allTaskRows = document.querySelectorAll('.task-row:not(.editable-task-row)');
    const availableTasks = [];
    
    allTaskRows.forEach(row => {
        const taskId = row.getAttribute('data-task-id');
        if (taskId && taskId !== currentTaskId) {
            const taskNameEl = row.querySelector('.font-medium');
            const taskName = taskNameEl ? taskNameEl.textContent.trim() : 'Unnamed Task';
            availableTasks.push({ id: taskId, name: taskName });
        }
    });
    
    if (availableTasks.length === 0) {
        listContainer.innerHTML = '<div class="text-xs text-gray-400 italic">No other tasks available</div>';
        return;
    }

    const checkboxesHtml = availableTasks.map(task => `
        <label class="flex items-center gap-2 text-xs hover:bg-gray-50 p-1 rounded cursor-pointer">
            <input type="checkbox" value="${task.id}" class="dependency-checkbox text-blue-600 focus:ring-blue-500">
            <span class="text-gray-700">${task.name}</span>
        </label>
    `).join('');
    
    listContainer.innerHTML = checkboxesHtml;
}

function saveDependencies(taskId) {
    const selector = document.querySelector('.dependency-selector');
    if (!selector) return;
    
    const selectedDeps = [];
    const checkboxes = selector.querySelectorAll('.dependency-checkbox:checked');
    
    checkboxes.forEach(cb => {
        const depId = cb.value;
        const label = cb.nextElementSibling.textContent;
        selectedDeps.push({ id: depId, name: label });
    });

    const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
    const dependencyCell = taskRow.querySelector('.col-span-2:last-child');
    
    if (selectedDeps.length > 0) {
        const depsHtml = `
            <div class="flex items-center gap-1">
                ${selectedDeps.map(dep => `
                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-full border" title="Depends on: ${dep.name}">
                        ${dep.name.substring(0, 8)}${dep.name.length > 8 ? '...' : ''}
                    </span>
                `).join('')}
                <button onclick="manageDependencies('${taskId}')" class="text-xs text-blue-600 hover:text-blue-800">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        `;
        dependencyCell.innerHTML = depsHtml;
    } else {
        dependencyCell.innerHTML = `
            <button onclick="manageDependencies('${taskId}')" class="text-xs text-gray-400 hover:text-blue-600">
                <i class="bi bi-plus-circle"></i> Add
            </button>
        `;
    }
    
    console.log(`Saving dependencies for task ${taskId}:`, selectedDeps);

    closeDependencySelector(taskId);
}

function closeDependencySelector(taskId) {
    document.querySelectorAll('.dependency-selector').forEach(el => el.remove());
}
