// Main JavaScript Entry Point - Loads all other scripts
document.addEventListener('DOMContentLoaded', function() {
    console.log('Main.js loaded - initializing all modules...');
    
    // Initialize automation
    if (typeof window.initializeMainViewAutomation === 'function') {
        window.initializeMainViewAutomation();
    }
    
    // Test people assignment modal availability
    if (typeof testPeopleAssignmentModal === 'function') {
        testPeopleAssignmentModal();
    }
    
    console.log('All modules initialized successfully');
});
