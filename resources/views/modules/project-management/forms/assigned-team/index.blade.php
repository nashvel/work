{{-- Assigned Team Tab Content --}}
<div class="grid grid-cols-1 gap-6">
    {{-- Project Workflow Diagram --}}
    @include('modules.project-management.forms.assigned-team.workflow-diagram')
</div>

{{-- Include Team Assignment Modal if it exists --}}
@includeIf('modules.project-management.team-assignment-modal')

{{-- Include JavaScript for Team Management --}}
@include('modules.project-management.forms.assigned-team.scripts')