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
                    
                    {{-- Analytics Header --}}
                    @include('modules.project-management.analytics.header')
                    
                    {{-- Key Performance Metrics --}}
                    @include('modules.project-management.analytics.kpi-metrics')

                    {{-- Main Analytics Grid --}}
                    <div class="grid grid-cols-12 gap-x-6">
                        {{-- Left Side - Charts and Status --}}
                        <div class="xxl:col-span-8 col-span-12">
                            {{-- Project Status Distribution --}}
                            @include('modules.project-management.analytics.status-distribution')

                            {{-- Budget Performance Chart --}}
                            @include('modules.project-management.analytics.budget-performance')
                        </div>

                        {{-- Right Side - Performance Summary --}}
                        <div class="xxl:col-span-4 col-span-12">
                            {{-- Top Performing Projects --}}
                            @include('modules.project-management.analytics.top-performers')

                            {{-- Team Performance --}}
                            @include('modules.project-management.analytics.team-performance')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>