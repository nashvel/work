{{-- Report Filters Component --}}
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
    <h3 class="text-lg font-semibold mb-4">Report Filters</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>Last 3 months</option>
                <option>Last 6 months</option>
                <option>Last year</option>
                <option>Custom range</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Project Status</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option>All statuses</option>
                <option>Active</option>
                <option>Completed</option>
                <option>On Hold</option>
                <option>Planning</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Team</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option>All teams</option>
                <option>Development</option>
                <option>Design</option>
                <option>Marketing</option>
                <option>QA</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option>All priorities</option>
                <option>Critical</option>
                <option>High</option>
                <option>Medium</option>
                <option>Low</option>
            </select>
        </div>
    </div>
    <div class="mt-4 flex space-x-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
            Apply Filters
        </button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm">
            Reset
        </button>
    </div>
</div>
