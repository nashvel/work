// Automation Functions
function addAutomationRule(section) {
    alert(`Adding automation rule for ${section}...\n\nOptions:\nAuto-assign based on workload\nStatus change triggers\nDeadline notifications\nDependency automation`);
}

function testPeopleAssignmentModal() {
    console.log('Testing people assignment modal...');
    if (typeof openPeopleAssignmentModal === 'function') {
        console.log('openPeopleAssignmentModal function is available');
        return true;
    } else {
        console.error('openPeopleAssignmentModal function is NOT available');
        return false;
    }
}

let mainViewProjectId = null;

window.initializeMainViewAutomation = function() {
    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    if (projectIndex !== -1 && urlParts[projectIndex + 1]) {
        mainViewProjectId = urlParts[projectIndex + 1];
    }
}
