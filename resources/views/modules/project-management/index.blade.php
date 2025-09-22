<x-app-layout>
    <x-slot name="title">Project Management</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project Management"}</x-slot>
    <x-slot name="active">Project List</x-slot>
    <x-slot name="buttons">
        <div class="btn-list shrink-0">
            <button data-hs-overlay="#create-project"
                class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50  items-center gap-2 bg-white">
                <i class="bi bi-plus-circle me-1"></i>
                <span class="mx-1" style="font-weight: 400">Register New</span>
            </button>
            <a href="/project-management/ai"
                class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-blue-600  items-center gap-2 bg-blue-500 text-white">
                <i class="bi bi-robot me-1"></i>
                <span class="mx-1" style="font-weight: 400">AI Assistant</span>
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box shadow-none border custom-box">
                <div class="box-body">
                    
                    <h1 class="font-bold text-2xl text-gray-700 dark:text-white mt-4"><strong>Project Management</strong>
                    </h1>
                    <span>You can manage and assign projects to your team members</span>
                    <hr class="mb-3 mt-3">
                    
                    @include('modules.project-management.components.widgets.quick-actions-small', [
                        'title' => 'Quick Actions',
                        'actions' => [
                            [
                                'url' => '/project-management/overview',
                                'icon' => 'bi bi-house',
                                'text' => 'Overview',
                                'color' => 'text-purple-600'
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
                    
                    <div class="mt-6">
                        @include('modules.project-management.tables.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modules.project-management.partials.scripts')
    @include('modules.project-management.create-modal')
    @include('modules.project-management.team-assignment-modal')

</x-app-layout>

