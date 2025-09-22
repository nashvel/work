<div class="timeline-container">
    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.time-header')
    
    <div class="timeline-content flex">
        @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-sidebar')
        
        @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.chart-area')
    </div>
    
    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.dependencies')
</div>