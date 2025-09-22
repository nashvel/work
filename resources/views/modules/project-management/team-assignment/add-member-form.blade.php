{{-- Add New Team Member Form Component --}}
<div class="mb-6 bg-white border border-gray-200 rounded-lg p-4">
    <h4 class="text-md font-medium text-gray-900 mb-3">Add New Team Member</h4>
    <div class="space-y-3">
        <div>
            <select id="newMemberSelect" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Select a user...</option>
            </select>
        </div>
        <div>
            <select id="newMemberRole" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="member">Member</option>
                <option value="lead">Lead</option>
                <option value="viewer">Viewer</option>
            </select>
        </div>
        <div>
            <button type="button" onclick="addTeamMember()" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors font-medium">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Team Member
            </button>
        </div>
    </div>
</div>
