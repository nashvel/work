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

// Show/Hide automation panel functions
function showMainViewAutomation() {
    const panel = document.getElementById('automationPanel');
    if (panel) {
        panel.style.display = 'flex';
        panel.classList.remove('hidden');
        loadAutomationSuggestions();
    }
}

function hideMainViewAutomation() {
    const panel = document.getElementById('automationPanel');
    if (panel) {
        panel.style.display = 'none';
        panel.classList.add('hidden');
    }
}

function refreshAutomationSuggestions() {
    loadAutomationSuggestions();
}

// Global variables
let mainViewProjectId = null;

// Set project ID for main view
function setMainViewProjectId(projectId) {
    mainViewProjectId = projectId;
}

// Get project ID from URL if not set globally
function getProjectIdFromUrl() {
    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    if (projectIndex !== -1 && urlParts[projectIndex + 1]) {
        return urlParts[projectIndex + 1];
    }
    return null;
}

// Show empty state
function showEmptyState() {
    const loadingElement = document.getElementById('automationLoading');
    const suggestionsElement = document.getElementById('automationSuggestions');
    const emptyStateElement = document.getElementById('emptyState');
    
    if (loadingElement) loadingElement.style.display = 'none';
    if (suggestionsElement) suggestionsElement.style.display = 'none';
    if (emptyStateElement) emptyStateElement.style.display = 'block';
}

// Load automation suggestions
function loadAutomationSuggestions() {
    const loadingElement = document.getElementById('automationLoading');
    const suggestionsElement = document.getElementById('automationSuggestions');
    const emptyStateElement = document.getElementById('emptyState');
    
    // Show loading
    if (loadingElement) loadingElement.style.display = 'block';
    if (suggestionsElement) suggestionsElement.style.display = 'none';
    if (emptyStateElement) emptyStateElement.style.display = 'none';
    
    const projectId = mainViewProjectId || getProjectIdFromUrl();
    
    if (!projectId) {
        showEmptyState();
        return;
    }
    
    fetch(`/projects/${projectId}/automation-suggestions`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        if (loadingElement) loadingElement.style.display = 'none';
        
        if (data.success && data.suggestions && data.suggestions.length > 0) {
            displaySuggestions(data.suggestions);
        } else {
            showEmptyState();
        }
    })
    .catch(error => {
        if (loadingElement) loadingElement.style.display = 'none';
        showEmptyState();
    });
}

// Display automation suggestions
function displaySuggestions(suggestions) {
    const suggestionsElement = document.getElementById('automationSuggestions');
    const suggestionsList = document.getElementById('suggestionsList');
    
    if (!suggestionsElement || !suggestionsList) return;
    
    // Clear existing content
    suggestionsList.innerHTML = '';
    
    // Generate suggestion cards
    suggestions.forEach((suggestion, index) => {
        const priorityColor = suggestion.priority === 'high' ? '#ef4444' : 
                            suggestion.priority === 'medium' ? '#f59e0b' : '#10b981';
        const priorityBg = suggestion.priority === 'high' ? '#fef2f2' : 
                          suggestion.priority === 'medium' ? '#fffbeb' : '#f0fdf4';
        const priorityText = suggestion.priority === 'high' ? '#991b1b' : 
                           suggestion.priority === 'medium' ? '#92400e' : '#166534';
        
        const card = document.createElement('div');
        card.style.cssText = `
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 12px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        `;
        
        // Create button element separately to avoid string escaping issues
        const buttonElement = document.createElement('button');
        buttonElement.style.cssText = 'padding: 4px 12px; background-color: #2563eb; color: white; font-size: 11px; border-radius: 4px; border: none; cursor: pointer; font-weight: 500;';
        buttonElement.innerHTML = '<i class="bi bi-plus-circle" style="margin-right: 3px;"></i>Create Rule';
        buttonElement.addEventListener('click', function() {
            createAutomationRule(suggestion.type, suggestion.trigger, suggestion.action, suggestion.priority);
        });
        
        card.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                <div style="display: flex; align-items: center;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background-color: ${priorityColor}; margin-right: 8px;"></div>
                    <span style="font-size: 12px; font-weight: 500; color: #374151; text-transform: uppercase;">${suggestion.type.replace('_', ' ')}</span>
                </div>
                <span style="padding: 2px 6px; font-size: 10px; font-weight: 500; border-radius: 9999px; background-color: ${priorityBg}; color: ${priorityText};">${suggestion.priority}</span>
            </div>
            <div style="margin-bottom: 8px;">
                <div style="font-size: 12px; color: #1f2937; margin-bottom: 3px;">
                    <strong>When:</strong> ${suggestion.trigger}
                </div>
                <div style="font-size: 12px; color: #1f2937; margin-bottom: 6px;">
                    <strong>Then:</strong> ${suggestion.action}
                </div>
                <div style="font-size: 10px; color: #6b7280; font-style: italic;">
                    ${suggestion.reasoning}
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end;" id="button-container-${index}">
            </div>
        `;
        
        // Append the button to avoid innerHTML escaping issues
        const buttonContainer = card.querySelector(`#button-container-${index}`);
        buttonContainer.appendChild(buttonElement);
        
        suggestionsList.appendChild(card);
    });
    
    // Show suggestions section
    suggestionsElement.style.display = 'block';
    window.currentSuggestions = suggestions;
}

// Load active automation rules
function loadActiveRules(projectId) {
    fetch(`/projects/${projectId}/automation-rules`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.rules && data.rules.length > 0) {
            displayActiveRules(data.rules);
        }
    })
    .catch(error => {
        console.error('Error loading active rules:', error);
    });
}

// Display active automation rules
function displayActiveRules(rules) {
    const activeRulesSection = document.getElementById('activeRulesSection');
    const activeRulesList = document.getElementById('activeRulesList');
    
    if (!activeRulesSection || !activeRulesList) return;
    
    activeRulesList.innerHTML = '';
    
    rules.forEach(rule => {
        const ruleHtml = `
            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                <div class="flex justify-between items-center">
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <span class="automation-active-badge mr-2">Active</span>
                            <span class="font-medium text-gray-800">${rule.trigger} → ${rule.action}</span>
                        </div>
                        <p class="text-sm text-gray-600">Type: ${rule.type} | Priority: ${rule.priority}</p>
                    </div>
                    <button onclick="toggleAutomationRule(${rule.id})" 
                            class="text-sm px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">
                        Disable
                    </button>
                </div>
            </div>
        `;
        activeRulesList.innerHTML += ruleHtml;
    });
    
    activeRulesSection.classList.remove('hidden');
}

// Show empty state
function showEmptyState() {
    const emptyStateElement = document.getElementById('emptyState');
    const suggestionsElement = document.getElementById('automationSuggestions');
    const activeRulesSection = document.getElementById('activeRulesSection');
    
    if (suggestionsElement) suggestionsElement.classList.add('hidden');
    if (activeRulesSection) activeRulesSection.classList.add('hidden');
    if (emptyStateElement) {
        emptyStateElement.classList.remove('hidden');
    }
}

// Create automation from suggestion
function createAutomationFromSuggestion(suggestionIndex) {
    if (!window.currentSuggestions || !window.currentSuggestions[suggestionIndex]) {
        console.error('Suggestion not found');
        return;
    }
    
    const suggestion = window.currentSuggestions[suggestionIndex];
    const button = document.getElementById(`createBtn-${suggestionIndex}`);
    const projectId = mainViewProjectId || getProjectIdFromUrl();
    
    if (!projectId) {
        console.error('Project ID not found');
        return;
    }
    
    if (button) {
        button.innerHTML = '<i class="bi bi-hourglass-split mr-1"></i> Creating...';
        button.classList.remove('create');
        button.classList.add('loading');
        button.disabled = true;
    }
    
    fetch('/automation/create-rule', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({
            project_id: projectId,
            type: suggestion.type,
            trigger: suggestion.trigger,
            action: suggestion.action,
            priority: suggestion.priority,
            conditions: {},
            parameters: {}
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && button) {
            button.innerHTML = '<i class="bi bi-check-circle mr-1"></i> Created';
            button.classList.remove('loading');
            button.classList.add('active');
            
            setTimeout(() => {
                loadAutomationSuggestions();
            }, 1000);
        } else {
            throw new Error(data.message || 'Failed to create automation rule');
        }
    })
    .catch(error => {
        console.error('Error creating automation:', error);
        if (button) {
            button.innerHTML = '<i class="bi bi-plus-circle mr-1"></i> Create Rule';
            button.classList.remove('loading');
            button.classList.add('create');
            button.disabled = false;
        }
    });
}

// Refresh automation suggestions
function refreshAutomationSuggestions() {
    loadAutomationSuggestions();
}

// Helper functions
function getTypeColor(type) {
    const colors = {
        'dependency': 'green',
        'workload': 'orange', 
        'sequential': 'blue',
        'default': 'purple'
    };
    return colors[type] || colors.default;
}

function getPriorityColor(priority) {
    const colors = {
        'high': 'bg-red-500',
        'medium': 'bg-yellow-500',
        'low': 'bg-green-500'
    };
    return colors[priority] || colors.medium;
}

function getPriorityBadgeColor(priority) {
    const colors = {
        'high': 'bg-red-100 text-red-800',
        'medium': 'bg-yellow-100 text-yellow-800',
        'low': 'bg-green-100 text-green-800'
    };
    return colors[priority] || colors.medium;
}

function getProjectIdFromUrl() {
    const urlParts = window.location.pathname.split('/');
    const projectIndex = urlParts.indexOf('project-management');
    if (projectIndex !== -1 && urlParts[projectIndex + 1]) {
        return urlParts[projectIndex + 1];
    }
    return null;
}

window.createAutomation = function(type) {
    console.log('Creating automation for type:', type);
    
    // Basic automation creation - can be expanded later
    const automationTypes = {
        'dependency-trigger': 'Dependency-based task automation',
        'workload': 'Workload balancing automation',
        'deadline': 'Deadline reminder automation',
        'status': 'Status change automation'
    };
    
    const automationType = automationTypes[type] || 'General automation';
    
    alert(`Creating ${automationType}...\n\nThis feature will:\n• Monitor project conditions\n• Trigger automated actions\n• Improve team efficiency\n\nAutomation rule will be saved to your project.`);
}

window.createAutomationRule = function(type, trigger, action, priority) {
    console.log('Creating automation rule:', { type, trigger, action, priority });
    
    // Get project ID from multiple sources
    let projectId = mainViewProjectId;
    
    if (!projectId) {
        // Try to get from URL
        const urlParts = window.location.pathname.split('/');
        const projectIndex = urlParts.indexOf('project-management');
        if (projectIndex !== -1 && urlParts[projectIndex + 1]) {
            projectId = urlParts[projectIndex + 1];
        }
    }
    
    if (!projectId) {
        // Try to get from DOM elements
        projectId = document.querySelector('input[name="project_id"]')?.value || 
                   document.querySelector('[data-project-id]')?.getAttribute('data-project-id');
    }
    
    if (!projectId) {
        alert('Project ID not found. Please refresh the page.');
        return;
    }
    
    console.log('Using project ID:', projectId);
    
    // Find the button that was clicked to add visual feedback
    const clickedButton = event.target;
    const originalText = clickedButton.textContent;
    const originalClasses = clickedButton.className;
    
    // Show loading state
    clickedButton.textContent = 'Creating...';
    clickedButton.disabled = true;
    clickedButton.className = clickedButton.className.replace(/bg-\w+-\d+/, 'bg-gray-400');
    
    // Prepare the automation rule data
    const ruleData = {
        project_id: projectId,
        type: type,
        trigger: trigger,
        action: action,
        priority: priority || 'medium'
    };
    
    // Send to backend
    fetch('/automation/create-rule', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(ruleData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success state
            clickedButton.textContent = '✓ Active';
            clickedButton.className = originalClasses.replace(/bg-\w+-\d+/, 'bg-green-500').replace(/text-\w+-\d+/, 'text-white');
            clickedButton.disabled = false;
            
            // Add automation indicator to the suggestion container
            const suggestionContainer = clickedButton.closest('.p-2, .bg-blue-50, .bg-orange-50, .bg-green-50');
            if (suggestionContainer && !suggestionContainer.querySelector('.automation-active-badge')) {
                const badge = document.createElement('div');
                badge.className = 'automation-active-badge inline-flex items-center px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full mt-2';
                badge.innerHTML = '<i class="bi bi-check-circle-fill mr-1"></i>Automation Active';
                suggestionContainer.appendChild(badge);
            }
            
            console.log('Automation rule created successfully:', data);
        } else {
            throw new Error(data.message || 'Failed to create automation rule');
        }
    })
    .catch(error => {
        console.error('Error creating automation rule:', error);
        
        // Restore original button state
        clickedButton.textContent = originalText;
        clickedButton.className = originalClasses;
        clickedButton.disabled = false;
        
        alert('Failed to create automation rule: ' + error.message);
    });
}
