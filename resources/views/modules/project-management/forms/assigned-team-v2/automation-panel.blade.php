<div id="automationPanel" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center" onclick="hideMainViewAutomation()" style="display: none;">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4 relative" onclick="event.stopPropagation()" style="max-height: 70vh; overflow-y: auto;">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white p-4 rounded-t-lg">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold flex items-center">
                        <i class="bi bi-magic mr-2"></i>
                        AI Automation Suggestions
                    </h2>
                    <p class="text-purple-100 mt-1 text-sm">Intelligent workflow automation for your project</p>
                </div>
                <button onclick="hideMainViewAutomation()" class="text-white hover:text-purple-200 text-xl">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4">
            <div id="automationLoading" class="text-center py-8" style="display: none;">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Analyzing project workflow...</p>
            </div>

            <div id="automationSuggestions" style="display: block;">
                <div class="mb-4">
                    <h3 class="text-base font-semibold text-gray-800 mb-2">Recommended Automations</h3>
                    <p class="text-gray-600 text-xs">AI has analyzed your project and identified these optimization opportunities:</p>
                </div>

                <div id="suggestionsList" style="display: block;">
                    <!-- Suggestions will be populated here -->
                </div>
            </div>

            <div id="emptyState" class="text-center py-8" style="display: none;">
                <div class="text-gray-400 mb-3">
                    <i class="bi bi-robot text-4xl"></i>
                </div>
                <h3 class="text-base font-medium text-gray-600 mb-2">No Automation Suggestions</h3>
                <p class="text-gray-500 text-sm">Add more tasks to your project to get AI-powered automation recommendations.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-4 py-3 border-t rounded-b-lg">
            <div class="flex justify-between items-center">
                <div class="text-xs text-gray-500">
                    <i class="bi bi-lightbulb mr-1"></i>
                    Automations help reduce manual work and improve team efficiency
                </div>
                <button onclick="refreshAutomationSuggestions()" class="px-3 py-1.5 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-all text-xs">
                    <i class="bi bi-arrow-clockwise mr-1"></i>
                    Refresh
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Override any conflicting CSS that might hide elements */
#automationSuggestions {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    height: auto !important;
    max-height: none !important;
    overflow: visible !important;
}

#automationSuggestions.hidden {
    display: none !important;
}

#suggestionsList {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    height: auto !important;
    min-height: 100px !important;
}

.automation-suggestion {
    @apply bg-white border border-gray-200 rounded-lg p-4 shadow-sm mb-4;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    height: auto !important;
    min-height: 120px !important;
}

.automation-suggestion.dependency {
    @apply border-green-200 bg-green-50;
}

.automation-suggestion.workload {
    @apply border-orange-200 bg-orange-50;
}

.automation-suggestion.sequential {
    @apply border-blue-200 bg-blue-50;
}

.automation-suggestion.sequential_cleaning {
    @apply border-blue-200 bg-blue-50;
}

.automation-suggestion.task_dependency {
    @apply border-green-200 bg-green-50;
}

.automation-suggestion.deadline_management {
    @apply border-yellow-200 bg-yellow-50;
}

.automation-suggestion.deadline_extension {
    @apply border-red-200 bg-red-50;
}

.automation-suggestion.priority_escalation {
    @apply border-purple-200 bg-purple-50;
}

.automation-active-badge {
    @apply inline-flex items-center px-3 py-1 text-xs bg-green-100 text-green-800 rounded-full border border-green-200;
}

.automation-btn {
    @apply px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200;
}

.automation-btn.create {
    @apply bg-gradient-to-r from-purple-600 to-blue-600 text-white hover:from-purple-700 hover:to-blue-700;
}

.automation-btn.active {
    @apply bg-green-500 text-white cursor-default;
}

.automation-btn.loading {
    @apply bg-gray-400 text-white cursor-not-allowed;
}
</style>
