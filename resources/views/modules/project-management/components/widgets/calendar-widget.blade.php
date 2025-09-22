@props([
    'title' => 'Project Calendar',
    'fullViewUrl' => '/project-management/calendar'
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
    <div class="box-body">
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
                    @endphp
                    
                    @for($i = 0; $i < $firstDay; $i++)
                        <div class="text-center p-1"></div>
                    @endfor
                    
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        <div class="text-center p-1 {{ $day == $today ? 'bg-primary text-white rounded-full font-medium' : 'hover:bg-gray-100 rounded-full' }} cursor-pointer">
                            {{ $day }}
                        </div>
                    @endfor
                </div>
            </div>
            
            <div class="mt-4">
                <h5 class="font-medium text-sm mb-3">Upcoming Deadlines</h5>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 p-2 bg-red-50 rounded text-xs">
                        <i class="bi bi-exclamation-triangle text-red-500"></i>
                        <span class="font-medium">API Integration</span>
                        <span class="text-red-500 ml-auto">3 days</span>
                    </div>
                    <div class="flex items-center gap-2 p-2 bg-orange-50 rounded text-xs">
                        <i class="bi bi-clock text-orange-500"></i>
                        <span class="font-medium">Website Redesign</span>
                        <span class="text-orange-500 ml-auto">1 week</span>
                    </div>
                    <div class="flex items-center gap-2 p-2 bg-blue-50 rounded text-xs">
                        <i class="bi bi-info-circle text-blue-500"></i>
                        <span class="font-medium">Mobile App</span>
                        <span class="text-blue-500 ml-auto">2 weeks</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>