{{-- Project Workflow Diagram --}}
<div class="bg-white border rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Project Assignment Workflow</h3>
        <p class="text-sm text-gray-500 mt-1">Visual representation of project team structure and assignments</p>
    </div>
    <div class="p-6">
        @if(isset($project))
            <div class="grid grid-cols-12 gap-8">
                {{-- Left Side: Workflow Diagram --}}
                <div class="col-span-8">
                    @include('modules.project-management.forms.assigned-team.workflow-visual')
                </div>

                {{-- Right Side: Team Management --}}
                <div class="col-span-4">
                    @include('modules.project-management.forms.assigned-team.team-management')
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Project information not available</p>
            </div>
        @endif
    </div>
</div>