<div class="bg-white overflow-hidden sm:rounded-lg border mb-8 rounded-lg">
    <div class="p-6">
        <div class="grid grid-cols-5 md:grid-cols-5 gap-2">

            <!-- Status -->
            <div>
                <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-success" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Status
                </h4>
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2 text-white 
                    @if ($project->status === 'active') bg-success text-green-800
                    @elseif($project->status === 'planning') bg-primary text-blue-800
                    @elseif($project->status === 'on_hold') bg-warning text-yellow-800
                    @elseif($project->status === 'completed') bg-secondary text-gray-800
                    @else bg-danger text-red-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>

            <!-- Priority -->
            <div>
                <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-danger" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667
                              1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464
                              0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Priority
                </h4>
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2 text-white
                    @if ($project->priority === 'critical') bg-danger text-red-800
                    @elseif($project->priority === 'high') bg-warning text-yellow-800
                    @elseif($project->priority === 'medium') bg-info text-cyan-800
                    @else bg-secondary text-gray-800 @endif">
                    {{ ucfirst($project->priority) }}
                </span>
            </div>

            <!-- Progress -->
            <div>
                <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 114 0v6m4 0V9a2 2 0 114 0v8m-12
                              0v-4a2 2 0 114 0v4" />
                    </svg>
                    Progress
                </h4>
                <div class="mt-2 flex items-center">
                    <div class="w-20 bg-gray-200 rounded-full h-3 mx-2">
                        <div class="bg-primary h-3 rounded-full" style="width: {{ $project->progress }}%"></div>
                    </div>
                    <span class="text-sm text-gray-900">{{ $project->progress }}%</span>
                </div>
            </div>

            <!-- Budget -->
            <div>
                <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-success" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3
                              2s1.343 2 3 2 3 .895 3
                              2-1.343 2-3 2m0-8c1.11
                              0 2.08.402 2.599 1M12
                              8V7m0 1v8m0 0v1m0-1c-1.11
                              0-2.08-.402-2.599-1" />
                    </svg>
                    Contract Amount
                </h4>
                <p class="text-lg font-semibold text-gray-900 mt-2 px-6">
                    &nbsp;
                    @if ($project->budget)
                        ${{ number_format($project->budget, 2) }}
                    @else
                        @if ($project->id == 1)
                            $ 54,770.00
                        @else
                            Not Set
                        @endif
                    @endif
                </p>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-success" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3
                              2s1.343 2 3 2 3 .895 3
                              2-1.343 2-3 2m0-8c1.11
                              0 2.08.402 2.599 1M12
                              8V7m0 1v8m0 0v1m0-1c-1.11
                              0-2.08-.402-2.599-1" />
                    </svg>
                    Prevailing Wage
                </h4>
                <p class="text-lg font-semibold text-gray-900 mt-2">
                     Yes
                </p>
            </div>
        </div>

        <!-- Dates -->
        @if ($project->start_date || $project->end_date)
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                @if ($project->start_date)
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-info" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5
                                      21h14a2 2 0 002-2V7a2
                                      2 0 00-2-2H5a2 2 0
                                      00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Start Date
                        </h4>
                        <p class="text-lg text-gray-900 mt-2">{{ $project->start_date->format('M j, Y') }}</p>
                    </div>
                @endif
                @if ($project->end_date)
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-danger" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5v14M5 5l7-2v14l-7-2" />
                            </svg>
                            End Date
                        </h4>
                        <p class="text-lg text-gray-900 mt-2">{{ $project->end_date->format('M j, Y') }}</p>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-5">
    <div class="lg:col-span-2">
        <div class="bg-white border rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Tasks ({{ $project->tasks->count() }})</h3>
                <a href="{{ route('projects.tasks.create', $project) }}"
                    class=" text-dark border  py-2 px-4 rounded-lg text-sm">
                    <span class="bi bi-plus-lg"></span>
                    Add Task
                </a>
            </div>
            <div class="p-6">
                @if ($project->tasks->count() > 0)
                    <div class="space-y-4">
                        @foreach ($project->tasks->take(10) as $task)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $task->title }}</h4>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ Str::limit($task->description, 100) }}</p>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            @if ($task->status === 'completed') bg-green-100 text-green-800
                                                            @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                            @elseif($task->status === 'review') bg-yellow-100 text-yellow-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            @if ($task->priority === 'critical') bg-red-100 text-red-800
                                                            @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                            @if ($task->assignedUser)
                                                <span
                                                    class="text-xs text-gray-500">{{ $task->assignedUser->name }}</span>
                                            @endif
                                            @if ($task->due_date)
                                                <span class="text-xs text-gray-500">Due:
                                                    {{ $task->due_date->format('M j') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($project->tasks->count() > 10)
                        <div class="mt-4 text-center">
                            <a href="{{ route('projects.tracker', $project) }}"
                                class="text-blue-600 hover:text-blue-900 text-sm">
                                View all {{ $project->tasks->count() }} tasks
                            </a>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 text-center py-8">No tasks created yet.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white border rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Team Members</h3>
            </div>
            <div class="p-6">
                @if ($project->teamMembers->count() > 0)
                    <div class="space-y-3">
                        @foreach ($project->teamMembers as $member)
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="{{ $member->profile_photo_url }}"
                                        alt="{{ $member->name }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $member->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                        {{ ucfirst($member->pivot->role) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No team members assigned.</p>
                @endif
            </div>
        </div>

        <div class="bg-white border rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Financial Summary</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">Total Income:</span>
                    <span
                        class="text-sm font-medium text-success">${{ number_format($project->incomes->sum('amount'), 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">Total Expenses:</span>
                    <span
                        class="text-sm font-medium text-danger">${{ number_format($project->expenses->sum('amount'), 2) }}</span>
                </div>
                <div class="border-t pt-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-900">Net Profit:</span>
                        <span
                            class="text-sm font-medium {{ $project->net_profit >= 0 ? 'text-info' : 'text-danger' }}">
                            ${{ number_format($project->net_profit, 2) }}
                        </span>
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <a href="{{ route('projects.expenses.create', $project) }}"
                        class="w-full flex items-center justify-center px-3 py-2 border border-gray-300 rounded-md border-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Add Expense
                    </a>
                    <a href="{{ route('projects.incomes.create', $project) }}"
                        class="w-full flex items-center justify-center px-3 py-2 border border-gray-300 rounded-md border-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Add Income
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white border rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Project Info</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <span class="text-sm text-gray-500">Created by:</span>
                    <p class="text-sm font-medium text-gray-900">{{ $project->creator->name }}</p>
                </div>
                @if ($project->manager)
                    <div>
                        <span class="text-sm text-gray-500">Manager:</span>
                        <p class="text-sm font-medium text-gray-900">{{ $project->manager->name }}</p>
                    </div>
                @endif
                <div>
                    <span class="text-sm text-gray-500">Created:</span>
                    <p class="text-sm font-medium text-gray-900">{{ $project->created_at->format('M j, Y') }}
                    </p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Last updated:</span>
                    <p class="text-sm font-medium text-gray-900">{{ $project->updated_at->format('M j, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
