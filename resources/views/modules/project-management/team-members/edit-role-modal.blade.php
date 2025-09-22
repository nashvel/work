<div id="editRoleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Member Role</h3>
                <button onclick="closeEditRoleModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <div class="mb-4">
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <img id="editMemberAvatar" class="w-10 h-10 rounded-full object-cover flex-shrink-0" src="" alt="">
                    <div>
                        <div id="editMemberName" class="font-medium text-gray-900"></div>
                        <div id="editMemberEmail" class="text-sm text-gray-500"></div>
                    </div>
                </div>
            </div>
            
            <form id="editRoleForm">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Select Role</label>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="role" value="member" class="text-blue-600 focus:ring-blue-500">
                            <div class="ml-3">
                                <div class="font-medium text-gray-900">Member</div>
                                <div class="text-sm text-gray-500">Can view and contribute to project tasks</div>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="role" value="lead" class="text-blue-600 focus:ring-blue-500">
                            <div class="ml-3">
                                <div class="font-medium text-gray-900">Lead</div>
                                <div class="text-sm text-gray-500">Can manage tasks and guide team members</div>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="role" value="viewer" class="text-blue-600 focus:ring-blue-500">
                            <div class="ml-3">
                                <div class="font-medium text-gray-900">Viewer</div>
                                <div class="text-sm text-gray-500">Can only view project information</div>
                            </div>
                        </label>
                    </div>
                </div>
                
                <input type="hidden" id="editUserId">
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEditRoleModal()" 
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
