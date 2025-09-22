{{-- All Projects Summary Table Component --}}
<div class="box mb-6">
    <div class="box-header justify-between">
        <div class="box-title">All Projects Summary</div>
        <div>
            <a href="/project-management/list" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]">
                <i class="bi bi-list-ul align-middle inline-block"></i> View Detailed List
            </a>
        </div>
    </div>
    <div class="box-body">
        @if($projects->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Manager</th>
                            <th>Tasks</th>
                            <th>Budget</th>
                            <th>Deadline</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects->take(10) as $project)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <a href="/project-management/{{ $project->id }}/dashboard" class="fw-semibold text-primary" style="cursor: pointer !important; text-decoration: none;">{{ $project->name }}</a>
                                            <br>
                                            <small class="text-muted">{!! Str::limit(strip_tags($project->description, '<strong><b><em><i><u>'), 30) !!}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $status = strtolower($project->status ?: 'planning');
                                        $statusConfig = match($status) {
                                            'active', 'in_progress' => [
                                                'class' => 'badge bg-success',
                                                'icon' => 'bi bi-play-circle-fill',
                                                'label' => 'Active'
                                            ],
                                            'planning' => [
                                                'class' => 'badge bg-warning',
                                                'icon' => 'bi bi-lightbulb-fill',
                                                'label' => 'Planning'
                                            ],
                                            'completed' => [
                                                'class' => 'badge bg-success',
                                                'icon' => 'bi bi-check-circle-fill',
                                                'label' => 'Completed'
                                            ],
                                            'on_hold' => [
                                                'class' => 'badge bg-warning',
                                                'icon' => 'bi bi-pause-circle-fill',
                                                'label' => 'On Hold'
                                            ],
                                            'cancelled' => [
                                                'class' => 'badge bg-danger',
                                                'icon' => 'bi bi-x-circle-fill',
                                                'label' => 'Cancelled'
                                            ],
                                            default => [
                                                'class' => 'badge bg-secondary',
                                                'icon' => 'bi bi-question-circle-fill',
                                                'label' => ucfirst($status)
                                            ]
                                        };
                                    @endphp
                                    <span class="{{ $statusConfig['class'] }} d-flex align-items-center gap-1">
                                        <i class="{{ $statusConfig['icon'] }} text-xs"></i>
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            @php
                                                $priorityLevel = match($project->priority) {
                                                    'critical' => 5,
                                                    'high' => 4,
                                                    'medium' => 3,
                                                    'low' => 2,
                                                    default => 1
                                                };
                                            @endphp
                                            @if($i <= $priorityLevel)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-xs me-1 avatar-rounded">
                                            <img src="/assets/images/faces/2.jpg" alt="manager">
                                        </span>
                                        <span class="fw-semibold">{{ $project->manager->name ?? 'Unassigned' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $project->tasks->count() }}</span>
                                    @if($project->tasks->count() > 0)
                                        <small class="text-muted">
                                            ({{ $project->tasks->where('status', 'completed')->count() }} done)
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if($project->budget)
                                        <span class="fw-semibold">${{ number_format($project->budget) }}</span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($project->end_date)
                                        @php
                                            $daysLeft = now()->diffInDays($project->end_date, false);
                                        @endphp
                                        <span class="
                                            @if($daysLeft < 0) text-danger
                                            @elseif($daysLeft <= 3) text-warning
                                            @else text-success
                                            @endif">
                                            {{ $project->end_date->format('M j, Y') }}
                                        </span>
                                        @if($daysLeft < 0)
                                            <br><small class="text-danger">Overdue</small>
                                        @elseif($daysLeft <= 7)
                                            <br><small class="text-warning">{{ $daysLeft }} days left</small>
                                        @endif
                                    @else
                                        <span class="text-muted">No deadline</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $totalTasks = $project->tasks->count();
                                        $completedTasks = $project->tasks->where('status', 'completed')->count();
                                        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                                    @endphp
                                    <div class="progress progress-xs">
                                        <div class="progress-bar 
                                            @if($progress >= 80) bg-success
                                            @elseif($progress >= 50) bg-primary
                                            @elseif($progress >= 25) bg-warning
                                            @else bg-danger
                                            @endif" 
                                            style="width: {{ $progress }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $progress }}%</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($projects->count() > 10)
                <div class="text-center mt-3">
                    <small class="text-muted">Showing first 10 of {{ $projects->count() }} projects</small>
                </div>
            @endif
        @else
            <div class="text-center py-4">
                <i class="bi bi-folder-x text-4xl text-muted mb-3"></i>
                <h5 class="text-muted">No Projects Found</h5>
                <p class="text-muted">Create your first project to get started</p>
                <a href="/project-management/list" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus me-1"></i> Create Project
                </a>
            </div>
        @endif
    </div>
</div>
