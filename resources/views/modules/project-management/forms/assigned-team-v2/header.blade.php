<div class="px-6 py-4 border-b border-gray-200">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Team Assignment</h2>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="openTemplateSelector()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center gap-2">
                <i class="bi bi-collection"></i>
                Templates
            </button>
            <button onclick="toggleWorkloadView()" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-all flex items-center gap-2">
                <i class="bi bi-bar-chart-fill"></i>
                Workload
            </button>
        </div>  
    </div>
    
    <div class="mt-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Filter by:</label>
                <select id="assigneeFilter" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Assignees</option>
                    @if(isset($project) && $project->teamMembers && $project->teamMembers->count() > 0)
                        @foreach($project->teamMembers as $member)
                            <option value="{{ Str::slug($member->name) }}">{{ $member->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">View:</label>
                <select id="viewMode" onchange="switchView(this.value)" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="table">Table View</option>
                    <option value="kanban">Kanban Board</option>
                    <option value="timeline">Timeline View</option>
                    <option value="workload">Workload View</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">Auto-assign:</span>
            <button onclick="toggleAutoAssign()" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                <i class="bi bi-robot"></i>
                AI Assistant
            </button>
            <button onclick="showMainViewAutomation()" class="px-3 py-1 text-sm bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-all">
                <i class="bi bi-magic"></i>
                AI Suggestions
            </button>
        </div>
    </div>
    
    <!-- AI Automation Panel for Main View -->
    <div id="mainViewAutomationPanel" class="hidden mt-4 p-4 bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-lg">
        <div class="flex items-center justify-between mb-3">
            <h4 class="font-semibold text-purple-800 flex items-center gap-2">
                <i class="bi bi-robot text-purple-600"></i>
                AI Automation Suggestions
            </h4>
            <div class="flex items-center gap-2">
                <button onclick="refreshMainViewSuggestions()" class="px-2 py-1 text-xs bg-purple-100 text-purple-700 rounded hover:bg-purple-200 transition-all">
                    <i class="bi bi-arrow-clockwise"></i>
                    Refresh
                </button>
                <button onclick="hideMainViewAutomation()" class="text-purple-600 hover:text-purple-800">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>
        
        <div id="mainViewSuggestions" class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="text-center py-4">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600 mx-auto mb-2"></div>
                <p class="text-gray-500 text-xs">Generating AI suggestions...</p>
            </div>
        </div>
        
        <div class="mt-3 pt-3 border-t border-purple-200">
            <div class="flex items-center justify-between text-xs text-purple-700">
                <span> AI analyzes your project to suggest optimal workflows</span>
                <button onclick="createCustomAutomation()" class="px-2 py-1 bg-purple-600 text-white rounded hover:bg-purple-700 transition-all">
                    Create Custom Rule
                </button>
            </div>
        </div>
    </div>
</div>