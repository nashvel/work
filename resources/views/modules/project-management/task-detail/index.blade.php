@php
    use Illuminate\Support\Facades\Crypt;
    use App\Models\User;
@endphp
<x-app-layout>

    <x-slot name="title">{{ $task->title }} - Task Detail</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project Management"}</x-slot>
    <x-slot name="url_2">{"link": "/project-management/{{ $project->id }}/dashboard", "text": "{{ $project->name }}"}</x-slot>
    <x-slot name="active">{{ $task->title }}</x-slot>
    <x-slot name="buttons">
        <div class="btn-list shrink-0">
            <a href="/project-management/{{ $project->id }}/dashboard"
                class="px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 items-center gap-2 bg-white">
                <i class="bi bi-arrow-left me-1"></i>
                <span class="mx-1" style="font-weight: 400">Back to Project</span>
            </a>
        </div>
    </x-slot>

    <div class="w-full max-w-none">
        <div class="w-full max-w-none">
            <div class="w-full max-w-none overflow-visible">
                <div class="w-full max-w-none p-0 m-0" style="box-shadow: none !important; border: none !important; background: transparent !important;">
                    
                    {{-- Task Header --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-2xl font-semibold text-gray-800">Task Details</h2>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-sm text-gray-600">{{ $project->name }}</span>
                                        <i class="bi bi-chevron-right text-gray-400 text-xs"></i>
                                        <span class="text-sm font-medium text-blue-600">{{ $task->title }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button onclick="editTask({{ $task->id }})" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center gap-2">
                                        <i class="bi bi-pencil"></i>
                                        Edit Task
                                    </button>
                                    <button onclick="assignMorePeople({{ $task->id }})" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all flex items-center gap-2">
                                        <i class="bi bi-person-plus"></i>
                                        Assign People
                                    </button>
                                </div>  
                            </div>
                            
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1 text-sm font-medium rounded-full 
                                            @if($task->status === 'completed') bg-green-100 text-green-800
                                            @elseif($task->status === 'in_progress') bg-orange-100 text-orange-800
                                            @elseif($task->status === 'review') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            <i class="bi bi-circle-fill text-xs mr-1"></i>
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($task->priority === 'critical') bg-red-100 text-red-800
                                            @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            <i class="bi bi-star-fill text-xs mr-1"></i>
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-6 text-sm text-gray-500">
                                        <div class="flex items-center gap-2">
                                            <i class="bi bi-calendar"></i>
                                            <span>Created {{ $task->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if($task->due_date)
                                        <div class="flex items-center gap-2">
                                            <i class="bi bi-calendar-check"></i>
                                            <span>Due {{ $task->due_date->format('M j, Y') }}</span>
                                        </div>
                                        @endif
                                        @if($task->estimated_hours)
                                        <div class="flex items-center gap-2">
                                            <i class="bi bi-clock"></i>
                                            <span>{{ $task->estimated_hours }}h estimated</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-gray-600">Actions:</span>
                                    <button onclick="duplicateTask({{ $task->id }})" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                                        <i class="bi bi-files"></i>
                                        Duplicate
                                    </button>
                                    <button onclick="deleteTask({{ $task->id }})" class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        @if($task->description)
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Description</h4>
                            <p class="text-gray-700 text-sm">{{ $task->description }}</p>
                        </div>
                        @endif
                    </div>

                    {{-- Task Detail Content - Table Layout --}}
                    <table style="width: 100%; table-layout: fixed; border-collapse: collapse; margin-top: 16px;">
                        <tr>
                            <td style="width: 50%; vertical-align: top; padding-right: 12px;">
                                @include('modules.project-management.task-detail.team-diagram')
                            </td>
                            <td style="width: 50%; vertical-align: top; padding-left: 12px;">
                                <div style="margin-bottom: 16px;">
                                    @include('modules.project-management.task-detail.progress-timeline')
                                </div>
                                <div style="margin-bottom: 16px;">
                                    @include('modules.project-management.task-detail.activity-feed')
                                </div>
                                <div style="margin-bottom: 16px;">
                                    @include('modules.project-management.task-detail.team-metrics')
                                </div>
                                <div style="margin-bottom: 16px;">
                                    @include('modules.project-management.task-detail.task-info')
                                </div>
                                <div>
                                    @include('modules.project-management.task-detail.dependencies')
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Load Task Detail Scripts --}}
    <script src="{{ asset('modules/project-management/task-detail/scripts/main.js') }}"></script>

</x-app-layout>
