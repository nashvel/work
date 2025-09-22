@include('modules.project-management.forms.assigned-team-v2.timeline-view.styles')

<div id="timelineView" class="hidden bg-white rounded-lg shadow-sm border border-gray-200">
    @include('modules.project-management.forms.assigned-team-v2.timeline-view.header')
    @include('modules.project-management.forms.assigned-team-v2.timeline-view.timeline-grid')
    @include('modules.project-management.forms.assigned-team-v2.timeline-view.workload-panel')
</div>

@include('modules.project-management.forms.assigned-team-v2.timeline-view.scripts')