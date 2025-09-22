@props([
    'projects' => collect(),
    'upcomingDeadlines' => collect()
])

<div class="box">
    <div class="box-header justify-between">
        <div class="box-title">
            Project Calendar
        </div>
        <div>
            <a href="/project-management/calendar" class="ti-btn ti-btn-light text-textmuted dark:text-textmuted/50 ti-btn-sm">
                Full View
            </a>
        </div>
    </div>
    <div class="box-body">
        {{-- Mini Calendar --}}
        <div class="calendar-widget">
            <div class="calendar-header mb-4">
                <div class="flex items-center justify-between">
                    <h4 class="font-medium">{{ date('F Y') }}</h4>
                    <div class="flex gap-1">
                        <button class="ti-btn ti-btn-sm ti-btn-light"><i class="bi bi-chevron-left"></i></button>
                        <button class="ti-btn ti-btn-sm ti-btn-light"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="calendar-body">
                <div class="grid grid-cols-7 gap-1 text-xs font-medium text-gray-500 mb-2">
                    <div class="text-center p-1">Sun</div>
                    <div class="text-center p-1">Mon</div>
                    <div class="text-center p-1">Tue</div>
                    <div class="text-center p-1">Wed</div>
                    <div class="text-center p-1">Thu</div>
                    <div class="text-center p-1">Fri</div>
                    <div class="text-center p-1">Sat</div>
                </div>
                <div class="grid grid-cols-7 gap-1 text-xs">
                    @php
                        $today = date('j');
                        $month = date('n');
                        $year = date('Y');
                        $firstDay = date('w', mktime(0, 0, 0, $month, 1, $year));
                        $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
                        
                        // Group projects by date
                        $projectsByDate = [];
                        foreach($projects as $project) {
                            if ($project->start_date) {
                                $startDay = date('j', strtotime($project->start_date));
                                if (date('n', strtotime($project->start_date)) == $month && date('Y', strtotime($project->start_date)) == $year) {
                                    $projectsByDate[$startDay][] = ['project' => $project, 'type' => 'start'];
                                }
                            }
                            if ($project->end_date) {
                                $endDay = date('j', strtotime($project->end_date));
                                if (date('n', strtotime($project->end_date)) == $month && date('Y', strtotime($project->end_date)) == $year) {
                                    $projectsByDate[$endDay][] = ['project' => $project, 'type' => 'end'];
                                }
                            }
                        }
                    @endphp
                    
                    {{-- Empty cells for days before month starts --}}
                    @for($i = 0; $i < $firstDay; $i++)
                        <div class="text-center p-1"></div>
                    @endfor
                    
                    {{-- Days of the month --}}
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        <div class="relative text-center p-1 {{ $day == $today ? 'bg-primary text-white rounded-full font-medium' : 'hover:bg-gray-100 rounded-full' }} cursor-pointer">
                            {{ $day }}
                            
                            {{-- Project indicators --}}
                            @if(isset($projectsByDate[$day]))
                                <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 flex gap-0.5">
                                    @foreach(array_slice($projectsByDate[$day], 0, 3) as $item)
                                        @php
                                            $status = $item['project']->status ?? 'planning';
                                            $color = match($status) {
                                                'active' => 'bg-green-400',
                                                'planning' => 'bg-yellow-400', 
                                                'completed' => 'bg-gray-400',
                                                'on_hold' => 'bg-red-400',
                                                'cancelled' => 'bg-gray-300',
                                                default => 'bg-blue-400'
                                            };
                                        @endphp
                                        <div class="w-2 h-2 rounded-full {{ $color }}" 
                                             title="{{ $item['project']->name }} ({{ $item['type'] === 'start' ? 'Start' : 'Due' }}) - {{ ucfirst($status) }}"></div>
                                    @endforeach
                                    @if(count($projectsByDate[$day]) > 3)
                                        <div class="w-1 h-1 rounded-full bg-gray-300" title="+{{ count($projectsByDate[$day]) - 3 }} more"></div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
            
            {{-- Upcoming Deadlines --}}
            <div class="mt-4">
                <h5 class="font-medium text-sm mb-3">Upcoming Deadlines</h5>
                <div class="space-y-2">
                    @forelse($upcomingDeadlines as $deadline)
                        @php
                            $daysLeft = now()->diffInDays($deadline->end_date, false);
                            $urgencyClass = $daysLeft <= 3 ? 'red' : ($daysLeft <= 7 ? 'orange' : 'blue');
                            $urgencyIcon = $daysLeft <= 3 ? 'exclamation-triangle' : ($daysLeft <= 7 ? 'clock' : 'info-circle');
                        @endphp
                        <div class="flex items-center gap-2 p-2 bg-{{ $urgencyClass }}-50 rounded text-xs hover:bg-{{ $urgencyClass }}-100 transition-colors cursor-pointer"
                             onclick="window.location.href='/project-management/{{ $deadline->id }}/dashboard'">
                            <i class="bi bi-{{ $urgencyIcon }} text-{{ $urgencyClass }}-500"></i>
                            <span class="font-medium flex-1">{{ $deadline->name }}</span>
                            <span class="text-{{ $urgencyClass }}-500">
                                @if($daysLeft <= 0)
                                    Overdue
                                @elseif($daysLeft == 1)
                                    Tomorrow
                                @elseif($daysLeft <= 7)
                                    {{ $daysLeft }} days
                                @else
                                    {{ $deadline->end_date->format('M j') }}
                                @endif
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-2 text-textmuted text-xs">
                            <i class="bi bi-calendar-check"></i>
                            No upcoming deadlines
                        </div>
                    @endforelse
                </div>
            </div>
            
            {{-- Project Legend --}}
            <div class="mt-4 pt-3 border-t border-gray-200">
                <h6 class="text-xs font-medium text-gray-600 mb-2">Project Status Legend</h6>
                <div class="flex flex-wrap gap-2 text-xs">
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-green-400"></div>
                        <span class="text-gray-600">Active</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                        <span class="text-gray-600">Planning</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                        <span class="text-gray-600">Completed</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-red-400"></div>
                        <span class="text-gray-600">On Hold</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
