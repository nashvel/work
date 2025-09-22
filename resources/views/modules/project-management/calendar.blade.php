<x-app-layout>
    <x-slot name="title">Project Calendar</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project Management"}</x-slot>
    <x-slot name="active">Calendar</x-slot>
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
                        <strong>Project Calendar</strong>
                    </h1>
                    <span>Timeline view of all projects and deadlines</span>
                    <hr class="mb-3 mt-3">
                    
                    {{-- Include the Project Calendar Component --}}
                    @include('modules.project-management.components.project-calendar', [
                        'projects' => $projects,
                        'upcomingDeadlines' => $upcomingDeadlines
                    ])
                </div>
            </div>
        </div>
    </div>

</x-app-layout>