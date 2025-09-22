{{-- Project Node Component --}}
<div class="relative">
    <div class="bg-blue-100 border-2 border-blue-300 rounded-lg p-4 min-w-[200px] text-center">
        <div class="flex items-center justify-center mb-2">
            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <span class="font-semibold text-blue-800">PROJECT</span>
        </div>
        <h4 class="font-medium text-gray-900 text-sm">{{ $project->name ?? 'Project Name' }}</h4>
        <p class="text-xs text-gray-600 mt-1">{{ $project->status ?? 'Active' }}</p>
    </div>
</div>