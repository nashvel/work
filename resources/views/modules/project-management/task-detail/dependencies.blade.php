{{-- Task Dependencies --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
        <i class="bi bi-diagram-2 text-orange-600"></i>
        Dependencies
    </h3>
    
    {{-- Blocking Tasks --}}
    <div class="mb-6">
        <h4 class="text-sm font-medium text-gray-700 mb-3">Blocked By</h4>
        <div class="space-y-2">
            <div class="flex items-center gap-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                <i class="bi bi-exclamation-triangle text-red-500"></i>
                <div class="flex-1">
                    <div class="font-medium text-red-900">Purchase cleaning supplies</div>
                    <div class="text-sm text-red-700">Must be completed first</div>
                </div>
                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Pending</span>
            </div>
        </div>
    </div>
    
    {{-- Dependent Tasks --}}
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-3">Blocks These Tasks</h4>
        <div class="space-y-2">
            <div class="flex items-center gap-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <i class="bi bi-clock text-yellow-600"></i>
                <div class="flex-1">
                    <div class="font-medium text-yellow-900">Office inspection</div>
                    <div class="text-sm text-yellow-700">Waiting for this task</div>
                </div>
                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Waiting</span>
            </div>
            
            <div class="flex items-center gap-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <i class="bi bi-clock text-yellow-600"></i>
                <div class="flex-1">
                    <div class="font-medium text-yellow-900">Final cleanup report</div>
                    <div class="text-sm text-yellow-700">Waiting for this task</div>
                </div>
                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Waiting</span>
            </div>
        </div>
    </div>
    
    {{-- Add Dependency Button --}}
    <div class="mt-4 pt-4 border-t border-gray-200">
        <button onclick="openDependencyModal()" class="w-full px-3 py-2 text-sm bg-gray-50 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition-all">
            <i class="bi bi-plus mr-2"></i>Add Dependency
        </button>
    </div>
</div>
