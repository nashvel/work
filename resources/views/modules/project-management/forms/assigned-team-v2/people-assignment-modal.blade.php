<div id="peopleAssignmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden" style="display: none;">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between pb-3 border-b">
                <h3 class="text-lg font-medium text-gray-900">Assign People</h3>
                <button onclick="closePeopleAssignmentModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div class="mt-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Team Members</label>
                    <div class="relative">
                        <input type="text" id="peopleSearch" placeholder="Search by name..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               oninput="filterPeople()">
                        <i class="bi bi-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                
                <div class="max-h-60 overflow-y-auto">
                    <div id="peopleList" class="space-y-2">
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t">
                    <div id="currentlyAssigned" class="flex flex-wrap gap-2">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pt-4 border-t space-x-2">
                <button onclick="closePeopleAssignmentModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                    Cancel
                </button>
                <button id="saveAssignmentBtn" onclick="savePeopleAssignment()" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed">
                    Save Assignment
                </button>
            </div>
        </div>
    </div>
</div>

<script>
window.checkModalExists = function() {
    const modal = document.getElementById('peopleAssignmentModal');
    console.log('Modal element:', modal);
    return modal !== null;
}

</script>
