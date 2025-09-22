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
                    
                    {{-- Header Component --}}
                    @include('modules.project-management.overview.header')
                    
                    {{-- Key Metrics Cards Component --}}
                    @include('modules.project-management.overview.metrics-cards')

                    {{-- Projects Table Component --}}
                    @include('modules.project-management.overview.projects-table')

                    {{-- Main Content Grid --}}
                    <div class="grid grid-cols-12 gap-x-6">
                        {{-- Left Side - Quick Actions and Recent Activity --}}
                        <div class="xxl:col-span-8 col-span-12">
                            {{-- Quick Actions Component --}}
                            @include('modules.project-management.overview.quick-actions')

                            {{-- Recent Activity Component --}}
                            @include('modules.project-management.overview.recent-activity')
                        </div>

                        {{-- Right Side - Calendar View --}}
                        <div class="xxl:col-span-4 col-span-12">
                            @include('modules.project-management.components.project-calendar', [
                                'projects' => $projects,
                                'upcomingDeadlines' => $upcomingDeadlines
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>