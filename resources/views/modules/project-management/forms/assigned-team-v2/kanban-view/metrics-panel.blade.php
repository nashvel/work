<div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <h5 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-graph-up text-blue-600"></i>
                Board Metrics
            </h5>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Tasks:</span>
                    <span class="font-medium">6</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Avg. Cycle Time:</span>
                    <span class="font-medium">3.2 days</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Throughput:</span>
                    <span class="font-medium">2 tasks/week</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <h5 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-robot text-purple-600"></i>
                AI Automation Suggestions
            </h5>
            <div id="automationSuggestions" class="space-y-2 text-sm">
                <div class="text-center py-4">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600 mx-auto mb-2"></div>
                    <p class="text-gray-500 text-xs">Generating AI suggestions...</p>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <button onclick="refreshAutomationSuggestions()" class="w-full px-3 py-2 text-xs bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-all">
                    <i class="bi bi-arrow-clockwise mr-1"></i>
                    Refresh Suggestions
                </button>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <h5 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="bi bi-lightning text-yellow-600"></i>
                Quick Actions
            </h5>
            <div class="space-y-2">
                <button onclick="autoAssignTasks()" class="w-full px-3 py-2 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all">
                    Auto-assign Backlog
                </button>
                <button onclick="balanceWorkload()" class="w-full px-3 py-2 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all">
                    Balance Workload
                </button>
            </div>
        </div>
    </div>
</div>