<x-app-layout>
    <x-slot name="title">Project Reports</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project Management"}</x-slot>
    <x-slot name="active">Reports</x-slot>
    <x-slot name="buttons">
        <div class="btn-list shrink-0">
            <a href="/project-management/analytics"
                class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 items-center gap-2 bg-white">
                <i class="bi bi-arrow-left me-1"></i>
                <span class="mx-1" style="font-weight: 400">Back to Analytics</span>
            </a>
            <button class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-blue-600 items-center gap-2 bg-blue-500 text-white">
                <i class="bi bi-download me-1"></i>
                <span class="mx-1" style="font-weight: 400">Export Report</span>
            </button>
        </div>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box shadow-none border custom-box">
                <div class="box-body">
                    {{-- Header Component --}}
                    @include('modules.project-management.reports.header')
                    
                    {{-- Report Filters Component --}}
                    @include('modules.project-management.reports.filters')

                    {{-- Report Sections --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        {{-- Executive Summary Component --}}
                        @include('modules.project-management.reports.executive-summary')

                        {{-- Financial Overview Component --}}
                        @include('modules.project-management.reports.financial-overview')
                    </div>

                    {{-- Detailed Project Report Component --}}
                    @include('modules.project-management.reports.project-table')

                    {{-- Key Metrics Component --}}
                    @include('modules.project-management.reports.key-metrics')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>