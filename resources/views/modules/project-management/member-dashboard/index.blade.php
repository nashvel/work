<x-app-layout>
    <x-slot name="url_0">{"link": "{{ route('project-management.list') }}", "text": "Projects"}</x-slot>
    <x-slot name="active">My Tasks</x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-4 col-span-12">
            <!-- Task Stats -->
            <div class="sm:col-span-6 xl:col-span-6 col-span-12">
                <div class="box overflow-hidden main-content-card">
                    <div class="box-body">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total Tasks</span>
                                <h4 class="font-medium mb-0">{{ $assignedTasks->count() }} tasks</h4>
                            </div>
                        </div>
                        <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Assigned to you
                            <span class="text-primary">{{ $assignedTasks->where('status', 'completed')->count() }} completed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Grid -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="col-span-6">
                    <div class="box overflow-hidden main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-warning svg-white avatar-rounded">
                                <i class="bi bi-clock text-[20px]" style="color: #fff; font-weight: 600;"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">In Progress</p>
                            <h4 class="font-semibold mb-1">{{ $assignedTasks->where('status', 'in_progress')->count() }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="box overflow-hidden main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-danger svg-white avatar-rounded">
                                <i class="bi bi-exclamation-triangle text-[20px]" style="color: #fff; font-weight: 600;"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">Overdue</p>
                            <h4 class="font-semibold mb-1">{{ $assignedTasks->where('due_date', '<', now())->whereNotIn('status', ['completed'])->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Tasks Table -->
            <div class="xxl:col-span-3 col-span-12">
                <div class="box">
                    <div class="box-header justify-between">
                        <div class="box-title">
                            <span class="bi bi-list-task mx-1" style="color: #3b82f6; font-weight: 600;"></span>
                            My Tasks
                        </div>
                        <div>
                            <select id="statusFilter" class="ti-btn ti-btn-sm ti-btn-light">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body" style="min-height: 470px">
                        <hr class="mb-4">

                        @if($assignedTasks->count() > 0)
                            <table class="min-w-full table-auto table-bordered border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="border border-gray-300 p-2 w-8">Done</th>
                                        <th class="border border-gray-300 p-2">Title</th>
                                        <th class="border border-gray-300 p-2 w-20">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="task-list">
                                    @foreach($assignedTasks as $task)
                                        <tr data-id="{{ $task->id }}" class="border border-gray-300 task-row" 
                                            data-status="{{ $task->status }}" data-priority="{{ $task->priority }}">
                                            <!-- Checkbox -->
                                            <td class="p-0 text-center">
                                                <input type="checkbox" class="form-check-input mx-3"
                                                    {{ $task->status === 'completed' ? 'checked' : '' }}
                                                    onchange="toggleTaskStatus(this, {{ $task->id }})" />
                                            </td>

                                            <!-- Title -->
                                            <td class="p-2">
                                                <div class="font-medium text-sm">{{ Str::limit($task->title, 40) }}</div>
                                                @if($task->project)
                                                    <div class="text-xs text-gray-500">{{ Str::limit($task->project->name, 30) }}</div>
                                                @endif
                                                @if($task->due_date)
                                                    <div class="text-xs text-gray-400">Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M j') }}</div>
                                                @endif
                                            </td>

                                            <!-- Status -->
                                            <td class="p-2">
                                                @php
                                                    $statusClasses = match($task->status) {
                                                        'completed' => 'text-success',
                                                        'in_progress' => 'text-primary',
                                                        'pending' => 'text-warning',
                                                        'on_hold' => 'text-secondary',
                                                        default => 'text-gray-700'
                                                    };
                                                    $statusText = match($task->status) {
                                                        'in_progress' => 'In Progress',
                                                        'on_hold' => 'On Hold',
                                                        default => ucfirst($task->status)
                                                    };
                                                @endphp
                                                <span class="{{ $statusClasses }} text-xs">
                                                    <i class="bi bi-circle-fill {{ $statusClasses }} mx-1" style="font-size: 0.4rem; color: currentColor;"></i>
                                                    {{ $statusText }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500 italic text-center py-8">No tasks assigned yet.</p>
                        @endif

                        <hr class="mt-4 mb-4">
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="xxl:col-span-8 col-span-12">
            <!-- Stats Cards -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="sm:col-span-12 xl:col-span-12 col-span-12">
                    <div class="box pt-3">
                        <div class="flex gap-5 items-center p-4 justify-around bg-light mx-2 flex-wrap flex-xl-nowrap rounded-md">
                            <div class="flex gap-4 items-center flex-wrap">
                                <div class="avatar avatar-lg flex-shrink-0 bg-primary/10 avatar-rounded svg-primary shadow-sm border border-primary border-opacity-25">
                                    <i class="bi bi-list-task text-2xl text-primary" style="color: #3b82f6; font-weight: 600;"></i>
                                </div>
                                <div>
                                    <span class="mb-1 block">Total Tasks</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">{{ $assignedTasks->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4 items-center flex-wrap">
                                <div class="avatar avatar-lg flex-shrink-0 bg-successtint1color/10 avatar-rounded svg-successtint1color shadow-sm border border-success border-opacity-25">
                                    <i class="bi bi-check-circle text-2xl text-success" style="color: #10b981; font-weight: 600;"></i>
                                </div>
                                <div>
                                    <span class="mb-1 block">Completed</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">{{ $assignedTasks->where('status', 'completed')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4 items-center flex-wrap">
                                <div class="avatar avatar-lg flex-shrink-0 bg-dangertint1color/10 avatar-rounded svg-dangertint1color shadow-sm border border-danger border-opacity-25">
                                    <i class="bi bi-clock text-2xl text-warning" style="color: #f59e0b; font-weight: 600;"></i>
                                </div>
                                <div>
                                    <span class="mb-1 block">In Progress</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">{{ $assignedTasks->where('status', 'in_progress')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4 items-center flex-wrap">
                                <div class="avatar avatar-lg flex-shrink-0 bg-primarytint1color/10 avatar-rounded svg-primarytint1color shadow-sm border border-primarytint1color border-opacity-25">
                                    <i class="bi bi-exclamation-triangle text-2xl text-danger" style="color: #ef4444; font-weight: 600;"></i>
                                </div>
                                <div>
                                    <span class="mb-1 block">Overdue</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">{{ $assignedTasks->where('due_date', '<', now())->whereNotIn('status', ['completed'])->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-3">
                    </div>
                </div>
            </div>

            <!-- Task Management Dashboard -->
            <div class="box shadow-none border custom-box">
                <div class="box-body overflow-y-auto">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div>
                            <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                                <strong>My Task Dashboard</strong>
                            </h6>
                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                Manage and track your assigned tasks efficiently.
                            </span>
                        </div>
                    </div>
                    <hr class="mb-3 !mt-3">

                    <!-- Task Cards Grid -->
                    @if($assignedTasks->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($assignedTasks as $task)
                                @include('modules.project-management.member-dashboard.task-card', ['task' => $task])
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="bi bi-clipboard-check text-6xl text-gray-400" style="color: #9ca3af; font-weight: 400;"></i>
                            <h5 class="mt-4 text-gray-600">No tasks assigned</h5>
                            <p class="text-gray-500">You don't have any tasks assigned to you yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('modules.project-management.member-dashboard.scripts')
</x-app-layout>
