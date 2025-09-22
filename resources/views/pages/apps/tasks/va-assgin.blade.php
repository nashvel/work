<x-app-layout>
    <x-slot name="title">Assigned VA's Task</x-slot>
    <x-slot name="url_1">{"link": "/virtual-assistant/list", "text": "Manage"}</x-slot>
    <x-slot name="url_3">{"link": "/task-list-view", "text": "Virtual Assistant"}</x-slot>
    <x-slot name="active">Task List</x-slot>
    <x-slot name="buttons">
        <a class="ti-btn ti-btn-primary !border-0 btn-wave me-0" href="/task/create">
            <i class="bi bi-plus-lg me-1"></i> Create Task
        </a>
    </x-slot>

    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xxl:col-span-3 col-span-12">
            <div class="box overflow-hidden main-content-card">
                <div class="box-body">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="text-textmuted dark:text-textmuted/50 block mb-1">Pending</span>
                            <h4 class="font-medium mb-0 mt-3">{{ App\Models\Task::where('status', 'Pending')->count() }}</h4>
                        </div>
                        <div class="leading-none">
                            <span class="avatar avatar-md avatar-rounded bg-primarytint2color">
                                <i class="ri-time-line text-xl"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-3 col-span-12">
            <div class="box overflow-hidden main-content-card">
                <div class="box-body">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="text-textmuted dark:text-textmuted/50 block mb-1">In Progress
                                Tasks</span>
                            <h4 class="font-medium mb-0 mt-3">{{ App\Models\Task::where('status', 'In Progress')->count() }}</h4>
                        </div>
                        <div class="leading-none">
                            <span class="avatar avatar-md avatar-rounded bg-primarytint3color">
                                <i class="ri-loader-line text-xl"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-3 col-span-12">
            <div class="box overflow-hidden main-content-card">
                <div class="box-body">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="text-textmuted dark:text-textmuted/50 block mb-1">On Hold</span>
                            <h4 class="font-medium mb-0 mt-3">{{ App\Models\Task::where('status', 'On Hold')->count() }}</h4>
                        </div>
                        <div class="leading-none">
                            <span class="avatar avatar-md avatar-rounded bg-primary">
                                <i class="ri-task-line text-xl"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-3 col-span-12">
            <div class="box overflow-hidden main-content-card">
                <div class="box-body">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="text-textmuted dark:text-textmuted/50 block mb-1">Completed
                                Tasks</span>
                            <h4 class="font-medium mb-0 mt-3">{{ App\Models\Task::where('status', 'Completed')->count() }}</h4>
                        </div>
                        <div class="leading-none">
                            <span class="avatar avatar-md avatar-rounded bg-primarytint1color">
                                <i class="ri-check-line text-xl"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    <!-- Start::row-2 -->
    <div class="grid grid-cols-12 gap-x-6">

        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                        <div id="grid-loading"></div>
                    </div>
                </div>
            </div>
        </div>

        @include('pages.apps.tasks.va-tasks.list')
        
    </div>



</x-app-layout>
