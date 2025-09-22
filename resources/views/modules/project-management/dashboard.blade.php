@php
    use Illuminate\Support\Facades\Crypt;
    use App\Models\User;
@endphp
<x-app-layout>

    <x-slot name="title">{{ $project->name }} - Dashboard</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project Management"}</x-slot>
    <x-slot name="active">{{ $project->name }} Dashboard</x-slot>
    <x-slot name="buttons">
        <div class="btn-list shrink-0">
            <a href="/project-management/list"
                class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 items-center gap-2 bg-white">
                <i class="bi bi-arrow-left me-1"></i>
                <span class="mx-1" style="font-weight: 400">Back to Projects</span>
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    
                    {{-- Header Component --}}
                    @include('modules.project-management.dashboard.header')
                    
                    {{-- Error Handling Component --}}
                    @include('modules.project-management.dashboard.error-handling')
                    
                    {{-- Navigation Component --}}
                    @include('modules.project-management.dashboard.navigation')

                    {{-- Tab Content Component --}}
                    @include('modules.project-management.dashboard.tab-content')

                </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dashboard JavaScript Component --}}
    @include('modules.project-management.dashboard.scripts')

</x-app-layout>
