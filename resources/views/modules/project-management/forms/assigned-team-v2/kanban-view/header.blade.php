<div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <i class="bi bi-kanban text-blue-600"></i>
                Kanban Board View
            </h3>
            <p class="text-sm text-gray-600 mt-1">Visual workflow management with drag & drop functionality</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Group by:</label>
                <select id="kanbanGroupBy" onchange="changeKanbanGrouping()" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="status">Status</option>
                    <option value="assignee">Assignee</option>
                    <option value="priority">Priority</option>
                    <option value="project">Project</option>
                </select>
            </div>
            <button onclick="toggleWIPLimits()" id="wipToggle" class="px-3 py-1 text-sm bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-all">
                <i class="bi bi-speedometer2"></i> WIP Limits
            </button>
            <button onclick="addKanbanColumn()" class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all">
                <i class="bi bi-plus-lg"></i> Add Column
            </button>
            <button onclick="closeKanbanView()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
</div>