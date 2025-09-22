<div class="flex justify-between items-center py-2">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Project Management</h1>
        <p class="text-gray-600 mt-1">You can manage and assign projects to your team members</p>
    </div>
    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
            <span>{{ count($users ?? []) }} Active Users</span>
        </div>
        <button onclick="openCreateModal()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-lg font-medium text-white hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            New Project
        </button>
    </div>
</div>
