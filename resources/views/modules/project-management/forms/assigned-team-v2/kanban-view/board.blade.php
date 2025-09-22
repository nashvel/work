<div class="p-6">
    <div id="kanbanBoard" class="flex gap-6 overflow-x-auto min-h-[600px] pb-4">
        @include('modules.project-management.forms.assigned-team-v2.kanban-view.columns.backlog')
        @include('modules.project-management.forms.assigned-team-v2.kanban-view.columns.in-progress')
        @include('modules.project-management.forms.assigned-team-v2.kanban-view.columns.review')
        @include('modules.project-management.forms.assigned-team-v2.kanban-view.columns.done')
    </div>
</div>