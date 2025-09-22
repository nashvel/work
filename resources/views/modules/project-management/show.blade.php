<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $project->name }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">{{ $project->description }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('projects.dashboard', $project) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Dashboard
                </a>
                <a href="{{ route('projects.tracker', $project) }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    Tracker
                </a>
                <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Status</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                @if($project->status === 'active') bg-green-100 text-green-800
                                @elseif($project->status === 'planning') bg-blue-100 text-blue-800
                                @elseif($project->status === 'on_hold') bg-yellow-100 text-yellow-800
                                @elseif($project->status === 'completed') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Priority</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                @if($project->priority === 'critical') bg-red-100 text-red-800
                                @elseif($project->priority === 'high') bg-orange-100 text-orange-800
                                @elseif($project->priority === 'medium') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($project->priority) }}
                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Progress</h4>
                            <div class="mt-1">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $project->progress }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-900">{{ $project->progress }}%</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Budget</h4>
                            <p class="text-lg font-semibold text-gray-900 mt-1">
                                @if($project->budget)
                                    ${{ number_format($project->budget, 2) }}
                                @else
                                    Not set
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($project->start_date || $project->end_date)
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($project->start_date)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Start Date</h4>
                                    <p class="text-lg text-gray-900 mt-1">{{ $project->start_date->format('M j, Y') }}</p>
                                </div>
                            @endif
                            @if($project->end_date)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">End Date</h4>
                                    <p class="text-lg text-gray-900 mt-1">{{ $project->end_date->format('M j, Y') }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Tasks ({{ $project->tasks->count() }})</h3>
                            <a href="{{ route('projects.tasks.create', $project) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                Add Task
                            </a>
                        </div>
                        <div class="p-6">
                            @if($project->tasks->count() > 0)
                                <div class="space-y-4">
                                    @foreach($project->tasks->take(10) as $task)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <h4 class="text-sm font-medium text-gray-900">{{ $task->title }}</h4>
                                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($task->description, 100) }}</p>
                                                    <div class="flex items-center mt-2 space-x-4">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            @if($task->status === 'completed') bg-green-100 text-green-800
                                                            @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                            @elseif($task->status === 'review') bg-yellow-100 text-yellow-800
                                                            @else bg-gray-100 text-gray-800
                                                            @endif">
                                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                        </span>
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            @if($task->priority === 'critical') bg-red-100 text-red-800
                                                            @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                            @else bg-gray-100 text-gray-800
                                                            @endif">
                                                            {{ ucfirst($task->priority) }}
                                                        </span>
                                                        @if($task->assignedUser)
                                                            <span class="text-xs text-gray-500">{{ $task->assignedUser->name }}</span>
                                                        @endif
                                                        @if($task->due_date)
                                                            <span class="text-xs text-gray-500">Due: {{ $task->due_date->format('M j') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($project->tasks->count() > 10)
                                    <div class="mt-4 text-center">
                                        <a href="{{ route('projects.tracker', $project) }}" class="text-blue-600 hover:text-blue-900 text-sm">
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
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Team Members</h3>
                        </div>
                        <div class="p-6">
                            @if($project->teamMembers->count() > 0)
                                <div class="space-y-3">
                                    @foreach($project->teamMembers as $member)
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <img class="h-8 w-8 rounded-full" src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $member->name }}</p>
                                                <p class="text-sm text-gray-500 truncate">{{ ucfirst($member->pivot->role) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">No team members assigned.</p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Financial Summary</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Total Income:</span>
                                <span class="text-sm font-medium text-green-600">${{ number_format($project->incomes->sum('amount'), 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Total Expenses:</span>
                                <span class="text-sm font-medium text-red-600">${{ number_format($project->expenses->sum('amount'), 2) }}</span>
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-900">Net Profit:</span>
                                    <span class="text-sm font-medium {{ $project->net_profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        ${{ number_format($project->net_profit, 2) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 space-y-2">
                                <a href="{{ route('projects.expenses.create', $project) }}" class="w-full flex items-center justify-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Add Expense
                                </a>
                                <a href="{{ route('projects.incomes.create', $project) }}" class="w-full flex items-center justify-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Add Income
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Project Info</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <span class="text-sm text-gray-500">Created by:</span>
                                <p class="text-sm font-medium text-gray-900">{{ $project->creator->name }}</p>
                            </div>
                            @if($project->manager)
                                <div>
                                    <span class="text-sm text-gray-500">Manager:</span>
                                    <p class="text-sm font-medium text-gray-900">{{ $project->manager->name }}</p>
                                </div>
                            @endif
                            <div>
                                <span class="text-sm text-gray-500">Created:</span>
                                <p class="text-sm font-medium text-gray-900">{{ $project->created_at->format('M j, Y') }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Last updated:</span>
                                <p class="text-sm font-medium text-gray-900">{{ $project->updated_at->format('M j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
