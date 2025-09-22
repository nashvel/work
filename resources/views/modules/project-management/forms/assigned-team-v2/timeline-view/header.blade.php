<div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <i class="bi bi-calendar-range text-purple-600"></i>
                Timeline / Gantt View
            </h3>
            <p class="text-sm text-gray-600 mt-1">Visual project scheduling with dependencies and resource management</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Time Scale:</label>
                <select id="timelineScale" onchange="changeTimelineScale()" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="days">Days</option>
                    <option value="weeks" selected>Weeks</option>
                    <option value="months">Months</option>
                    <option value="quarters">Quarters</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Group by:</label>
                <select id="timelineGroupBy" onchange="changeTimelineGrouping()" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="none">No Grouping</option>
                    <option value="assignee" selected>Assignee</option>
                    <option value="project">Project</option>
                    <option value="team">Team</option>
                    <option value="priority">Priority</option>
                </select>
            </div>
            <button onclick="toggleDependencies()" id="dependenciesToggle" class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all">
                <i class="bi bi-arrow-right"></i> Dependencies
            </button>
            <button onclick="autoSchedule()" class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all">
                <i class="bi bi-calendar-check"></i> Auto Schedule
            </button>
            <button onclick="closeTimelineView()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    
    <div class="mt-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <button onclick="navigateTimeline('prev')" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-all">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <span id="currentTimeRange" class="text-sm font-medium text-gray-800">September - October 2025</span>
                <button onclick="navigateTimeline('next')" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-all">
                    <i class="bi bi-chevron-right"></i>
                </button>
                <button onclick="goToToday()" class="px-3 py-1 text-sm bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-all">
                    Today
                </button>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Filter:</label>
                <select id="timelineFilter" onchange="filterTimeline()" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="all">All Tasks</option>
                    <option value="overdue">Overdue</option>
                    <option value="this-week">This Week</option>
                    <option value="unassigned">Unassigned</option>
                    <option value="high-priority">High Priority</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">Zoom:</span>
            <button onclick="zoomTimeline('out')" class="p-1 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded transition-all">
                <i class="bi bi-zoom-out"></i>
            </button>
            <button onclick="zoomTimeline('in')" class="p-1 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded transition-all">
                <i class="bi bi-zoom-in"></i>
            </button>
        </div>
    </div>
</div>