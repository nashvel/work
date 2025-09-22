<div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-orange-50 to-amber-50">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <i class="bi bi-bar-chart-fill text-orange-600"></i>
                Team Workload Management
            </h3>
            <p class="text-sm text-gray-600 mt-1">Monitor and balance team capacity across projects</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">Time Period:</label>
                <select id="workloadPeriod" onchange="changeWorkloadPeriod()" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="this-week" selected>This Week</option>
                    <option value="next-week">Next Week</option>
                    <option value="this-month">This Month</option>
                    <option value="next-month">Next Month</option>
                    <option value="quarter">This Quarter</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">View Mode:</label>
                <select id="workloadViewMode" onchange="changeWorkloadViewMode()" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="capacity" selected>Capacity View</option>
                    <option value="hours">Hours Breakdown</option>
                    <option value="projects">By Projects</option>
                    <option value="skills">By Skills</option>
                </select>
            </div>
            <button onclick="autoBalanceWorkload()" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-all flex items-center gap-2">
                <i class="bi bi-gear-fill"></i>
                Auto Balance
            </button>
            <button onclick="exportWorkloadReport()" class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all">
                <i class="bi bi-download"></i> Export
            </button>
            <button onclick="closeWorkloadView()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    
    <div class="mt-4 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                <span class="text-sm text-gray-600">Available ({{ rand(2, 4) }})</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                <span class="text-sm text-gray-600">At Capacity ({{ rand(1, 3) }})</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                <span class="text-sm text-gray-600">Overloaded ({{ rand(1, 2) }})</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-600">Team Efficiency:</span>
            <span class="text-lg font-bold text-orange-600">87%</span>
            <button onclick="optimizeEfficiency()" class="px-2 py-1 text-xs bg-orange-100 text-orange-700 rounded hover:bg-orange-200 transition-all">
                Optimize
            </button>
        </div>
    </div>
</div>