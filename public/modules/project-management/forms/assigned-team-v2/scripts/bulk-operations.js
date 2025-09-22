function bulkAssign() {
    const checkedTasks = document.querySelectorAll('.task-checkbox:checked');
    if (checkedTasks.length === 0) {
        alert('Please select tasks to assign in bulk.');
        return;
    }
    alert(`Bulk assigning ${checkedTasks.length} selected tasks...\n\nOptions:\nAssign to same person\nDistribute across team\nUse AI recommendations`);
}

function bulkStatusUpdate() {
    const checkedTasks = document.querySelectorAll('.task-checkbox:checked');
    if (checkedTasks.length === 0) {
        alert('Please select tasks to update status in bulk.');
        return;
    }
    alert(`Bulk updating status for ${checkedTasks.length} selected tasks...\n\nOptions:\nSet all to Working\nMark as Done\nMove to Review`);
}

function createTemplate() {
    alert('Creating template from current task setup...\n\nOptions:\nSave current layout\nInclude team assignments\nSet as default template\nShare with team');
}
