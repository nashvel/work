{{-- Timeline Chart Area --}}
<div class="chart-area flex-1 overflow-x-auto bg-white relative">
    <div class="timeline-grid min-w-full h-full">
        {{-- Current Date Indicator --}}
        <div class="current-date-line absolute top-0 bottom-0 w-0.5 bg-red-500 z-20" style="left: 25%;"></div>
        <div class="current-date-label absolute top-2 text-xs text-red-600 font-medium z-20" style="left: 25%; transform: translateX(-50%);">
            Today
        </div>
        
        {{-- Task Bars Container --}}
        <div class="task-bars-container">
            {{-- John Smith's Tasks --}}
            <div class="assignee-section">
                <div class="section-spacer h-12"></div> {{-- Group header spacing --}}
                
                {{-- Task 1: User authentication flow --}}
                <div class="task-bar-row h-12 flex items-center relative border-b border-gray-100">
                    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-bar', [
                        'taskId' => 'task-001',
                        'startPercent' => 10,
                        'widthPercent' => 15,
                        'color' => 'green',
                        'status' => 'done',
                        'progress' => 100
                    ])
                </div>
                
                {{-- Task 5: Database optimization --}}
                <div class="task-bar-row h-12 flex items-center relative border-b border-gray-100">
                    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-bar', [
                        'taskId' => 'task-005',
                        'startPercent' => 20,
                        'widthPercent' => 20,
                        'color' => 'blue',
                        'status' => 'in-progress',
                        'progress' => 60
                    ])
                </div>
            </div>
            
            {{-- Sarah Adams' Tasks --}}
            <div class="assignee-section">
                <div class="section-spacer h-12"></div> {{-- Group header spacing --}}
                
                {{-- Task 2: Design system documentation --}}
                <div class="task-bar-row h-12 flex items-center relative border-b border-gray-100">
                    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-bar', [
                        'taskId' => 'task-002',
                        'startPercent' => 15,
                        'widthPercent' => 25,
                        'color' => 'pink',
                        'status' => 'in-progress',
                        'progress' => 70
                    ])
                </div>
                
                {{-- Task 6: Mobile app wireframes --}}
                <div class="task-bar-row h-12 flex items-center relative border-b border-gray-100">
                    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-bar', [
                        'taskId' => 'task-006',
                        'startPercent' => 45,
                        'widthPercent' => 18,
                        'color' => 'pink',
                        'status' => 'not-started',
                        'progress' => 0
                    ])
                </div>
            </div>
            
            {{-- Mike Johnson's Tasks --}}
            <div class="assignee-section">
                <div class="section-spacer h-12"></div> {{-- Group header spacing --}}
                
                {{-- Task 3: API integration testing --}}
                <div class="task-bar-row h-12 flex items-center relative border-b border-gray-100">
                    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-bar', [
                        'taskId' => 'task-003',
                        'startPercent' => 30,
                        'widthPercent' => 22,
                        'color' => 'red',
                        'status' => 'stuck',
                        'progress' => 30
                    ])
                </div>
            </div>
            
            {{-- Unassigned Tasks --}}
            <div class="assignee-section">
                <div class="section-spacer h-12"></div> {{-- Group header spacing --}}
                
                {{-- Task 4: Security audit --}}
                <div class="task-bar-row h-12 flex items-center relative border-b border-gray-100">
                    @include('modules.project-management.forms.assigned-team-v2.timeline-view.components.task-bar', [
                        'taskId' => 'task-004',
                        'startPercent' => 65,
                        'widthPercent' => 15,
                        'color' => 'gray',
                        'status' => 'not-started',
                        'progress' => 0
                    ])
                </div>
            </div>
        </div>
        
        {{-- Grid Lines --}}
        <div class="grid-lines absolute inset-0 pointer-events-none">
            {{-- Month separators --}}
            <div class="absolute top-0 bottom-0 w-px bg-gray-300" style="left: 33.33%;"></div>
            <div class="absolute top-0 bottom-0 w-px bg-gray-300" style="left: 66.66%;"></div>
            
            {{-- Week separators --}}
            @for($i = 1; $i <= 12; $i++)
                <div class="absolute top-0 bottom-0 w-px bg-gray-200" style="left: {{ $i * 8.33 }}%;"></div>
            @endfor
        </div>
    </div>
</div>