{{-- Workflow Visual Component --}}
<div class="flex flex-col items-center space-y-6">
    {{-- Project Node --}}
    @include('modules.project-management.forms.assigned-team.project-node')

    {{-- Connector Line and Team Members --}}
    @if(isset($project->teamMembers) && $project->teamMembers->count() > 0)
        {{-- Simple Line Connector --}}
        <div class="flex flex-col items-center">
            {{-- Single Vertical Line --}}
            <div class="w-1 h-16 bg-gray-600"></div>
        </div>

        {{-- Team Members Flow --}}
        <div class="text-center mb-4">
            <span class="text-sm font-medium text-gray-700 bg-gray-100 px-3 py-1 rounded-full">Assigned To</span>
        </div>

        {{-- Team Members Grid --}}
        @include('modules.project-management.forms.assigned-team.team-nodes')

        {{-- Show more indicator if there are more members --}}
        @if($project->teamMembers->count() > 6)
            <div class="text-center mt-4">
                <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                    +{{ $project->teamMembers->count() - 6 }} more members
                </span>
            </div>
        @endif
    @else
        {{-- No Team Members State --}}
        @include('modules.project-management.forms.assigned-team.empty-state')
    @endif
</div>