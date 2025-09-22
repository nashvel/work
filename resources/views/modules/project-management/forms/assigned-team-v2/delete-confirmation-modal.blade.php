{{-- Delete Confirmation Modal --}}
<div id="deleteConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="bi bi-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Selected Tasks</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>
            
            <div class="mb-4">
                <p class="text-gray-700 mb-3">
                    You are about to delete <span id="selectedTaskCount" class="font-semibold">0</span> task(s). 
                    This will permanently remove them from the project.
                </p>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                    <p class="text-sm text-yellow-800">
                        <i class="bi bi-exclamation-triangle mr-1"></i>
                        To confirm this action, please type <strong>"confirm"</strong> in the field below:
                    </p>
                </div>
                
                <input type="text" 
                       id="confirmationInput" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                       placeholder="Type 'confirm' to proceed"
                       autocomplete="off"
                       oninput="toggleDeleteButton()"
                       onkeyup="toggleDeleteButton()"
                       onchange="toggleDeleteButton()"
                       onpaste="setTimeout(toggleDeleteButton, 10)"
                       tabindex="0">
            </div>
            
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" 
                        onclick="confirmDelete()" 
                        disabled
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all disabled:bg-gray-300 disabled:cursor-not-allowed">
                    <i class="bi bi-trash mr-1"></i>
                    Delete Tasks
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Success Message Modal --}}
<div id="deleteSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-sm w-full mx-4">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-check-circle text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tasks Deleted Successfully</h3>
            <p class="text-gray-600 mb-4">
                <span id="deletedTaskCount">0</span> task(s) have been permanently removed from the project.
            </p>
            <button onclick="closeSuccessModal()" 
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-all">
                OK
            </button>
        </div>
    </div>
</div>
