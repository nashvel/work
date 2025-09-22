document.addEventListener('DOMContentLoaded', function() {
    console.log('Main.js loaded - initializing all modules...');
    
    if (typeof window.initializeMainViewAutomation === 'function') {
        window.initializeMainViewAutomation();
    }

    if (typeof testPeopleAssignmentModal === 'function') {
        testPeopleAssignmentModal();
    }
    
    console.log('All modules initialized successfully');
});
