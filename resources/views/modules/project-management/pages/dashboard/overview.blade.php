<x-app-layout>
    <x-slot name="title">Project Management Overview</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project Management"}</x-slot>
    <x-slot name="active">Overview</x-slot>
    <x-slot name="buttons">
        <div class="btn-list shrink-0">
            <a href="/project-management/list"
                class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 items-center gap-2 bg-white">
                <i class="bi bi-arrow-left me-1"></i>
                <span class="mx-1" style="font-weight: 400">Back to List</span>
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box shadow-none border custom-box">
                <div class="box-body">
                    
                    <h1 class="font-bold text-2xl text-gray-700 dark:text-white mt-4">
                        <strong>Project Management Overview</strong>
                    </h1>
                    <span>Comprehensive overview of all project management activities and metrics</span>
                    <hr class="mb-3 mt-3">
                    
                    <div class="grid grid-cols-12 gap-x-6 mb-6">
                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'Total Projects',
                            'value' => $totalProjects ?? 24,
                            'subtitle' => 'All Time',
                            'trend' => 'Active',
                            'icon' => 'bx bx-layer',
                            'bgColor' => 'bg-primary',
                            'chartId' => 'project-chart-1'
                        ])

                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'Active Projects',
                            'value' => $activeProjects ?? 18,
                            'subtitle' => 'In Progress',
                            'trend' => ($activeProjects ? round(($activeProjects / ($totalProjects ?: 1)) * 100, 1) : 75) . '%',
                            'icon' => 'bx bx-play-circle',
                            'bgColor' => 'bg-primarytint1color',
                            'chartId' => 'project-chart-2'
                        ])

                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'Team Members',
                            'value' => $teamMembers ?? 42,
                            'subtitle' => 'Contributors',
                            'trend' => 'Active',
                            'icon' => 'bx bx-group',
                            'bgColor' => 'bg-primarytint2color',
                            'chartId' => 'project-chart-3'
                        ])

                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'Completion Rate',
                            'value' => ($completionRate ?? 87) . '%',
                            'subtitle' => 'Overall Success',
                            'trend' => '+2.57%',
                            'icon' => 'bx bx-check-circle',
                            'bgColor' => 'bg-primarytint3color',
                            'chartId' => 'project-chart-4'
                        ])
                    </div>

                    <div class="grid grid-cols-12 gap-x-6">
                        <div class="xxl:col-span-8 col-span-12">
                            {{-- Quick Actions --}}
                            @include('modules.project-management.components.widgets.quick-actions', [
                                'title' => 'Quick Actions',
                                'actions' => [
                                    [
                                        'url' => '/project-management/list',
                                        'icon' => 'bi bi-list-ul',
                                        'text' => 'View All Projects',
                                        'color' => 'text-blue-600'
                                    ],
                                    [
                                        'url' => '/project-management/analytics',
                                        'icon' => 'bi bi-graph-up',
                                        'text' => 'Analytics',
                                        'color' => 'text-green-600'
                                    ],
                                    [
                                        'url' => '/project-management/reports',
                                        'icon' => 'bi bi-file-earmark-bar-graph',
                                        'text' => 'Reports',
                                        'color' => 'text-orange-600'
                                    ]
                                ]
                            ])

                            <div class="box">
                                <div class="box-header justify-between">
                                    <div class="box-title">Recent Activity</div>
                                    <div>
                                        <button type="button" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]"><i class="ri-history-line align-middle inline-block"></i>View All</button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="space-y-4">
                                        <div class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                            <div class="avatar avatar-sm avatar-rounded bg-primary/10 !text-primary flex-shrink-0 mt-1">
                                                <i class="bi bi-plus-circle text-[14px]"></i>
                                            </div>
                                            <div class="flex-auto">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h6 class="mb-0 text-[13px] font-semibold">New project created</h6>
                                                    <span class="text-textmuted dark:text-textmuted/50 text-[11px]">2 hours ago</span>
                                                </div>
                                                <p class="text-textmuted dark:text-textmuted/50 mb-0 text-[11px]">E-commerce platform development project has been initiated with team assignment.</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                            <div class="avatar avatar-sm avatar-rounded bg-success/10 !text-success flex-shrink-0 mt-1">
                                                <i class="bi bi-check-circle text-[14px]"></i>
                                            </div>
                                            <div class="flex-auto">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h6 class="mb-0 text-[13px] font-semibold">Project milestone completed</h6>
                                                    <span class="text-textmuted dark:text-textmuted/50 text-[11px]">5 hours ago</span>
                                                </div>
                                                <p class="text-textmuted dark:text-textmuted/50 mb-0 text-[11px]">API integration phase completed successfully for the mobile app project.</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                            <div class="avatar avatar-sm avatar-rounded bg-warning/10 !text-warning flex-shrink-0 mt-1">
                                                <i class="bi bi-exclamation-triangle text-[14px]"></i>
                                            </div>
                                            <div class="flex-auto">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h6 class="mb-0 text-[13px] font-semibold">Deadline approaching</h6>
                                                    <span class="text-textmuted dark:text-textmuted/50 text-[11px]">1 day ago</span>
                                                </div>
                                                <p class="text-textmuted dark:text-textmuted/50 mb-0 text-[11px]">Website redesign project deadline is in 3 days. Review progress status.</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                            <div class="avatar avatar-sm avatar-rounded bg-info/10 !text-info flex-shrink-0 mt-1">
                                                <i class="bi bi-people text-[14px]"></i>
                                            </div>
                                            <div class="flex-auto">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h6 class="mb-0 text-[13px] font-semibold">Team member added</h6>
                                                    <span class="text-textmuted dark:text-textmuted/50 text-[11px]">2 days ago</span>
                                                </div>
                                                <p class="text-textmuted dark:text-textmuted/50 mb-0 text-[11px]">Sarah Johnson has been assigned to the data analytics project team.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="xxl:col-span-4 col-span-12">
                            @include('modules.project-management.components.widgets.calendar-widget', [
                                'title' => 'Project Calendar',
                                'fullViewUrl' => '/project-management/calendar'
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>