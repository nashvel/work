{{-- Team Members List Component --}}
<div class="bg-gray-50 border rounded-lg">
    <div class="px-4 py-3 border-b border-gray-200">
        <div>
            <h4 class="text-lg font-medium text-gray-900">Assigned Team Members</h4>
            <p class="text-sm text-gray-500 mt-1">Manage team members and their roles for this project</p>
        </div>
    </div>
    
    {{-- Inline Add Team Member Form --}}
    @if(isset($project) && $project->id)
        <div class="px-4 py-3 bg-blue-50 border-b border-gray-200">
            <h5 class="text-sm font-medium text-gray-900 mb-3">Add New Team Member</h5>
            <form id="addTeamMemberForm" class="space-y-3">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label for="user_select" class="block text-xs font-medium text-gray-700 mb-1">Select User</label>
                        <select id="user_select" name="user_id" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Choose a user...</option>
                            {{-- Users will be populated via JavaScript --}}
                        </select>
                    </div>
                    
                    <div>
                        <label for="role_select" class="block text-xs font-medium text-gray-700 mb-1">Role</label>
                        <select id="role_select" name="role" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="member">Member</option>
                            <option value="lead">Lead</option>
                            <option value="viewer">Viewer</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors font-medium">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Member
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    
    <div class="p-4">
        @if(isset($project) && $project->teamMembers && $project->teamMembers->count() > 0)
            <div class="space-y-3">
                @foreach($project->teamMembers as $member)
                    @include('modules.project-management.forms.assigned-team.team-member-card', ['member' => $member])
                @endforeach
            </div>
        @else
            @include('modules.project-management.forms.assigned-team.team-list-empty')
        @endif
    </div>
</div>