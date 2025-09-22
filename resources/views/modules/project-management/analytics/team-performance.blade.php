{{-- Team Performance --}}
<div class="box">
    <div class="box-header justify-between">
        <div class="box-title">
            Team Performance
        </div>
    </div>
    <div class="box-body">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="avatar avatar-sm bg-primary/10 text-primary">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="flex-auto">
                    <div class="font-medium text-sm">Active Team Members</div>
                    <div class="text-xs text-textmuted">Currently working on projects</div>
                </div>
                <div class="text-lg font-bold text-primary">{{ $teamMetrics['active_members'] }}</div>
            </div>
            <div class="flex items-center gap-3">
                <div class="avatar avatar-sm bg-success/10 text-success">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="flex-auto">
                    <div class="font-medium text-sm">Productivity Score</div>
                    <div class="text-xs text-textmuted">Based on task completion</div>
                </div>
                <div class="text-lg font-bold text-success">{{ $teamMetrics['productivity_score'] }}/10</div>
            </div>
            <div class="flex items-center gap-3">
                <div class="avatar avatar-sm bg-warning/10 text-warning">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="flex-auto">
                    <div class="font-medium text-sm">Avg. Task Time</div>
                    <div class="text-xs text-textmuted">Per task completion</div>
                </div>
                <div class="text-lg font-bold text-warning">{{ $teamMetrics['avg_task_time'] }}d</div>
            </div>
            <div class="flex items-center gap-3">
                <div class="avatar avatar-sm bg-info/10 text-info">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div class="flex-auto">
                    <div class="font-medium text-sm">Deadline Adherence</div>
                    <div class="text-xs text-textmuted">On-time delivery rate</div>
                </div>
                <div class="text-lg font-bold text-info">{{ $teamMetrics['deadline_adherence'] }}%</div>
            </div>
        </div>
    </div>
</div>