@props([
    'title' => 'Project Calendar',
    'fullViewUrl' => '/project-management/calendar',
    'projects' => []
])

<div class="box">
    <div class="box-header justify-between">
        <div class="box-title">
            {{ $title }}
        </div>
        <div>
            <a href="{{ $fullViewUrl }}" class="ti-btn ti-btn-light text-textmuted dark:text-textmuted/50 ti-btn-sm">
                Full View
            </a>
        </div>
    </div>
    <div class="box-body p-4">
        <div class="calendar-widget">
            <div class="calendar-header mb-3">
                <div class="flex items-center justify-between">
                    <h4 class="font-medium text-sm">{{ date('F Y') }}</h4>
                    <div class="flex gap-1">
                        <button class="ti-btn ti-btn-sm ti-btn-light"><i class="bi bi-chevron-left"></i></button>
                        <button class="ti-btn ti-btn-sm ti-btn-light"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="calendar-body">
                <div class="grid grid-cols-7 gap-0.5 text-xs font-medium text-gray-500 mb-1">
                    <div class="text-center py-1 text-xs">Sun</div>
                    <div class="text-center py-1 text-xs">Mon</div>
                    <div class="text-center py-1 text-xs">Tue</div>
                    <div class="text-center py-1 text-xs">Wed</div>
                    <div class="text-center py-1 text-xs">Thu</div>
                    <div class="text-center py-1 text-xs">Fri</div>
                    <div class="text-center py-1 text-xs">Sat</div>
                </div>
                <div class="grid grid-cols-7 gap-0.5 text-xs">
                    @php
                        $today = date('j');
                        $month = date('n');
                        $year = date('Y');
                        $firstDay = date('w', mktime(0, 0, 0, $month, 1, $year));
                        $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
                        
                        $projectsByDate = [];
                        foreach($projects as $project) {
                            if($project->due_date) {
                                $dueDay = date('j', strtotime($project->due_date));
                                $dueMonth = date('n', strtotime($project->due_date));
                                $dueYear = date('Y', strtotime($project->due_date));
                                
                                if($dueMonth == $month && $dueYear == $year) {
                                    if(!isset($projectsByDate[$dueDay])) {
                                        $projectsByDate[$dueDay] = [];
                                    }
                                    $projectsByDate[$dueDay][] = $project;
                                }
                            }
                        }
                    @endphp
                    
                    @for($i = 0; $i < $firstDay; $i++)
                        <div class="text-center py-1"></div>
                    @endfor
                    
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $hasProjects = isset($projectsByDate[$day]);
                            $isToday = $day == $today;
                        @endphp
                        <div class="text-center py-1 relative cursor-pointer
                            {{ $isToday ? 'bg-primary text-white rounded-full font-medium' : 'hover:bg-gray-100 rounded-full' }}
                            {{ $hasProjects && !$isToday ? 'bg-red-100 text-red-800 font-medium rounded-full' : '' }}"
                            @if($hasProjects)
                                title="{{ count($projectsByDate[$day]) }} project(s) due: {{ implode(', ', array_column($projectsByDate[$day]->toArray(), 'name')) }}"
                            @endif>
                            {{ $day }}
                            @if($hasProjects)
                                <div class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></div>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
            
            <div class="mt-3">
                <h5 class="font-medium text-xs mb-2">Upcoming Due Dates</h5>
                <div class="space-y-1 max-h-24 overflow-y-auto">
                    @if($projects->count() > 0)
                        @foreach($projects->take(5) as $project)
                            @php
                                $daysUntilDue = $project->due_date ? \Carbon\Carbon::parse($project->due_date)->diffInDays(now(), false) : null;
                                $isOverdue = $daysUntilDue !== null && $daysUntilDue < 0;
                                $daysText = $daysUntilDue !== null ? 
                                    ($isOverdue ? abs($daysUntilDue) . ' days overdue' : 
                                     ($daysUntilDue == 0 ? 'Due today' : $daysUntilDue . ' days left')) : 'No due date';
                                $bgColor = $isOverdue ? 'bg-red-50' : ($daysUntilDue !== null && $daysUntilDue <= 3 ? 'bg-orange-50' : 'bg-blue-50');
                                $textColor = $isOverdue ? 'text-red-500' : ($daysUntilDue !== null && $daysUntilDue <= 3 ? 'text-orange-500' : 'text-blue-500');
                                $iconClass = $isOverdue ? 'bi-exclamation-triangle' : ($daysUntilDue !== null && $daysUntilDue <= 3 ? 'bi-clock' : 'bi-info-circle');
                            @endphp
                            @if($project->due_date)
                                <div class="flex items-center gap-2 p-1.5 {{ $bgColor }} rounded text-xs">
                                    <i class="bi {{ $iconClass }} {{ $textColor }}"></i>
                                    <span class="font-medium truncate">{{ $project->name }}</span>
                                    <span class="{{ $textColor }} ml-auto whitespace-nowrap">{{ $daysText }}</span>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="text-center py-4 text-gray-500">
                            <i class="bi bi-calendar-x text-2xl mb-2"></i>
                            <p class="text-xs">No upcoming due dates</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>