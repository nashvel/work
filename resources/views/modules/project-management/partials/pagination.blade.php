<div class="bg-white px-6 py-4 border-t border-gray-100 flex-shrink-0">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <p class="text-sm text-gray-600">
                Showing <span class="font-semibold text-gray-900">1</span> to <span class="font-semibold text-gray-900">{{ count($users ?? []) }}</span> of <span class="font-semibold text-gray-900">{{ count($users ?? []) }}</span> team members
            </p>
        </div>
        
        <div class="flex items-center space-x-2">
            <button class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Previous
            </button>
            
            <div class="flex items-center space-x-1">
                <button class="inline-flex items-center px-3 py-2 border border-blue-500 rounded-lg text-sm font-medium text-blue-600 bg-blue-50">
                    1
                </button>
            </div>
            
            <button class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                Next
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
