<x-app-layout>
    <x-slot name="title">Project Analytics</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project Management"}</x-slot>
    <x-slot name="active">Analytics</x-slot>
    <x-slot name="buttons">
        <div class="btn-list shrink-0">
            <a href="/project-management/overview"
                class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 items-center gap-2 bg-white">
                <i class="bi bi-arrow-left me-1"></i>
                <span class="mx-1" style="font-weight: 400">Back to Overview</span>
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box shadow-none border custom-box">
                <div class="box-body">
                    
                    <h1 class="font-bold text-2xl text-gray-700 dark:text-white mt-4">
                        <strong>Project Analytics Dashboard</strong>
                    </h1>
                    <span>Advanced analytics and insights for project performance</span>
                    <hr class="mb-3 mt-3">
                    
                    <div class="grid grid-cols-12 gap-x-6 mb-6">
                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'Avg. Completion Time',
                            'value' => '45 days',
                            'subtitle' => 'Project Duration',
                            'trend' => '12% faster',
                            'icon' => 'bx bx-speedometer',
                            'bgColor' => 'bg-primary',
                            'chartId' => 'completion-chart'
                        ])

                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'On-Time Delivery',
                            'value' => '87%',
                            'subtitle' => 'Delivery Rate',
                            'trend' => '+5%',
                            'icon' => 'bx bx-target-lock',
                            'bgColor' => 'bg-primarytint1color',
                            'chartId' => 'delivery-chart'
                        ])

                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'Team Utilization',
                            'value' => '92%',
                            'subtitle' => 'Resource Usage',
                            'trend' => '+3%',
                            'icon' => 'bx bx-group',
                            'bgColor' => 'bg-primarytint2color',
                            'chartId' => 'utilization-chart'
                        ])

                        @include('modules.project-management.components.metrics.metric-card', [
                            'title' => 'Budget Efficiency',
                            'value' => '94%',
                            'subtitle' => 'Budget Usage',
                            'trend' => 'Efficient',
                            'icon' => 'bx bx-dollar',
                            'bgColor' => 'bg-primarytint3color',
                            'chartId' => 'budget-chart'
                        ])
                    </div>

                    <div class="grid grid-cols-12 gap-x-6">
                        <div class="xxl:col-span-8 col-span-12">
                            <div class="box mb-6">
                                <div class="box-header justify-between">
                                    <div class="box-title">
                                        Project Status Distribution
                                    </div>
                                    <div>
                                        <button type="button" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]"><i class="ri-refresh-line align-middle inline-block"></i>Refresh</button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="space-y-3">
                                            <div class="flex items-center justify-between p-3 bg-success/10 rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <span class="avatar avatar-sm bg-success text-white rounded-full">
                                                        <i class="bi bi-check-circle"></i>
                                                    </span>
                                                    <span class="font-medium">Completed</span>
                                                </div>
                                                <div class="text-end">
                                                    <span class="text-lg font-bold text-success">12</span>
                                                    <div class="text-xs text-textmuted">(50%)</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between p-3 bg-primary/10 rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <span class="avatar avatar-sm bg-primary text-white rounded-full">
                                                        <i class="bi bi-play-circle"></i>
                                                    </span>
                                                    <span class="font-medium">In Progress</span>
                                                </div>
                                                <div class="text-end">
                                                    <span class="text-lg font-bold text-primary">8</span>
                                                    <div class="text-xs text-textmuted">(33%)</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between p-3 bg-warning/10 rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <span class="avatar avatar-sm bg-warning text-white rounded-full">
                                                        <i class="bi bi-hourglass-split"></i>
                                                    </span>
                                                    <span class="font-medium">Planning</span>
                                                </div>
                                                <div class="text-end">
                                                    <span class="text-lg font-bold text-warning">3</span>
                                                    <div class="text-xs text-textmuted">(13%)</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between p-3 bg-danger/10 rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <span class="avatar avatar-sm bg-danger text-white rounded-full">
                                                        <i class="bi bi-pause-circle"></i>
                                                    </span>
                                                    <span class="font-medium">On Hold</span>
                                                </div>
                                                <div class="text-end">
                                                    <span class="text-lg font-bold text-danger">1</span>
                                                    <div class="text-xs text-textmuted">(4%)</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center">
                                            <div class="w-full">
                                                <h4 class="font-medium text-center mb-4">Quick Actions</h4>
                                                <div class="space-y-3">
                                                    <a href="/project-management/list" class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                                        <i class="bi bi-list-ul text-xl text-blue-600"></i>
                                                        <span class="font-medium text-gray-700">View All Projects</span>
                                                    </a>
                                                    <a href="/project-management/analytics" class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                                        <i class="bi bi-graph-up text-xl text-green-600"></i>
                                                        <span class="font-medium text-gray-700">Analytics</span>
                                                    </a>
                                                    <a href="/project-management/reports" class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                                        <i class="bi bi-file-earmark-bar-graph text-xl text-orange-600"></i>
                                                        <span class="font-medium text-gray-700">Reports</span>
                                                    </a>
                                                    <a href="/project-management/overview" class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                                        <i class="bi bi-house text-xl text-purple-600"></i>
                                                        <span class="font-medium text-gray-700">Overview</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box mb-6">
                                <div class="box-header justify-between">
                                    <div class="box-title">
                                        Performance Trends
                                    </div>
                                    <div>
                                        <button type="button" class="ti-btn ti-btn-soft-secondary text-xs px-2 py-[0.26rem]">Last 6 Months</button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="flex items-center justify-center h-64 bg-gray-50 rounded-lg">
                                        <div class="text-center">
                                            <i class="bi bi-bar-chart text-4xl text-gray-400 mb-3"></i>
                                            <p class="text-gray-500">Performance trends chart will be displayed here</p>
                                            <small class="text-gray-400">Integration with charting library required</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="xxl:col-span-4 col-span-12">
                            <div class="box mb-6">
                                <div class="box-header justify-between">
                                    <div class="box-title">
                                        Top Performers
                                    </div>
                                    <div>
                                        <button type="button" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]">View All</button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                            <div class="flex items-center gap-3">
                                                <div class="avatar avatar-sm bg-success text-white rounded-full">
                                                    <span class="text-xs font-bold">JD</span>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-sm">John Doe</div>
                                                    <div class="text-xs text-textmuted">Project Manager</div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <div class="text-sm font-bold text-success">98%</div>
                                                <div class="text-xs text-textmuted">Efficiency</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                            <div class="flex items-center gap-3">
                                                <div class="avatar avatar-sm bg-primary text-white rounded-full">
                                                    <span class="text-xs font-bold">SJ</span>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-sm">Sarah Johnson</div>
                                                    <div class="text-xs text-textmuted">Lead Developer</div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <div class="text-sm font-bold text-primary">95%</div>
                                                <div class="text-xs text-textmuted">Efficiency</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                            <div class="flex items-center gap-3">
                                                <div class="avatar avatar-sm bg-warning text-white rounded-full">
                                                    <span class="text-xs font-bold">MB</span>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-sm">Mike Brown</div>
                                                    <div class="text-xs text-textmuted">UI/UX Designer</div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <div class="text-sm font-bold text-warning">92%</div>
                                                <div class="text-xs text-textmuted">Efficiency</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-header">
                                    <div class="box-title">
                                        Analytics Summary
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="space-y-4">
                                        <div class="border-l-4 border-primary pl-4">
                                            <div class="font-medium text-sm">Project Success Rate</div>
                                            <div class="text-xs text-textmuted mb-1">Last 30 days</div>
                                            <div class="text-lg font-bold text-primary">87.5%</div>
                                        </div>
                                        <div class="border-l-4 border-success pl-4">
                                            <div class="font-medium text-sm">Average Delivery Time</div>
                                            <div class="text-xs text-textmuted mb-1">Compared to estimates</div>
                                            <div class="text-lg font-bold text-success">12% faster</div>
                                        </div>
                                        <div class="border-l-4 border-warning pl-4">
                                            <div class="font-medium text-sm">Resource Utilization</div>
                                            <div class="text-xs text-textmuted mb-1">Team efficiency</div>
                                            <div class="text-lg font-bold text-warning">92.3%</div>
                                        </div>
                                        <div class="border-l-4 border-info pl-4">
                                            <div class="font-medium text-sm">Client Satisfaction</div>
                                            <div class="text-xs text-textmuted mb-1">Average rating</div>
                                            <div class="text-lg font-bold text-info">4.8/5</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>