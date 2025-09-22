{{-- Time Header Grid --}}
<div class="timeline-header bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
    <div class="flex">
        {{-- Task Names Column Header --}}
        <div class="w-80 px-4 py-3 bg-white border-r border-gray-200 flex-shrink-0">
            <div class="flex items-center justify-between">
                <h4 class="font-medium text-gray-800">Tasks & Assignees</h4>
                <button onclick="collapseAllGroups()" class="text-xs text-gray-500 hover:text-gray-700">
                    <i class="bi bi-arrows-collapse"></i> Collapse
                </button>
            </div>
        </div>
        
        {{-- Time Scale Headers --}}
        <div class="flex-1 overflow-x-auto">
            <div id="timeHeaders" class="flex min-w-full">
                {{-- September 2025 --}}
                <div class="timeline-month flex-1 min-w-[200px] px-4 py-3 border-r border-gray-300 bg-purple-50 text-center">
                    <div class="font-semibold text-purple-800">September 2025</div>
                    <div class="flex mt-2">
                        <div class="flex-1 text-xs text-purple-600 border-r border-purple-200 py-1">Week 1</div>
                        <div class="flex-1 text-xs text-purple-600 border-r border-purple-200 py-1">Week 2</div>
                        <div class="flex-1 text-xs text-purple-600 border-r border-purple-200 py-1">Week 3</div>
                        <div class="flex-1 text-xs text-purple-600 py-1">Week 4</div>
                    </div>
                </div>
                
                {{-- October 2025 --}}
                <div class="timeline-month flex-1 min-w-[200px] px-4 py-3 border-r border-gray-300 bg-pink-50 text-center">
                    <div class="font-semibold text-pink-800">October 2025</div>
                    <div class="flex mt-2">
                        <div class="flex-1 text-xs text-pink-600 border-r border-pink-200 py-1">Week 1</div>
                        <div class="flex-1 text-xs text-pink-600 border-r border-pink-200 py-1">Week 2</div>
                        <div class="flex-1 text-xs text-pink-600 border-r border-pink-200 py-1">Week 3</div>
                        <div class="flex-1 text-xs text-pink-600 py-1">Week 4</div>
                    </div>
                </div>
                
                {{-- November 2025 --}}
                <div class="timeline-month flex-1 min-w-[200px] px-4 py-3 border-r border-gray-300 bg-blue-50 text-center">
                    <div class="font-semibold text-blue-800">November 2025</div>
                    <div class="flex mt-2">
                        <div class="flex-1 text-xs text-blue-600 border-r border-blue-200 py-1">Week 1</div>
                        <div class="flex-1 text-xs text-blue-600 border-r border-blue-200 py-1">Week 2</div>
                        <div class="flex-1 text-xs text-blue-600 border-r border-blue-200 py-1">Week 3</div>
                        <div class="flex-1 text-xs text-blue-600 py-1">Week 4</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>