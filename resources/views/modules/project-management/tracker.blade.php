<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $project->name }} - Project Tracker
                </h2>
                <p class="text-sm text-gray-600 mt-1">Excel-like interface for comprehensive project management</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('projects.dashboard', $project) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Dashboard
                </a>
                <a href="{{ route('projects.show', $project) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Details
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <button onclick="showTab('tasks')" id="tasks-tab" class="tab-button active whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                        Tasks Overview
                    </button>
                    <button onclick="showTab('expenses')" id="expenses-tab" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                        Expenses Tracker
                    </button>
                    <button onclick="showTab('income')" id="income-tab" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                        Income Tracker
                    </button>
                    <button onclick="showTab('summary')" id="summary-tab" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                        Financial Summary
                    </button>
                </nav>
            </div>

            <div id="tasks-content" class="tab-content">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Tasks Management</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Comprehensive task tracking and management</p>
                        </div>
                        <a href="{{ route('projects.tasks.create', $project) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Task
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Est. Hours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actual Hours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($project->tasks as $task)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($task->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select onchange="updateTaskStatus({{ $task->id }}, this.value)" class="text-sm rounded-md border-gray-300
                                                @if($task->status === 'completed') bg-green-100 text-green-800
                                                @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                @elseif($task->status === 'review') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="review" {{ $task->status === 'review' ? 'selected' : '' }}>Review</option>
                                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $task->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($task->priority === 'critical') bg-red-100 text-red-800
                                                @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                                                @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select onchange="assignTask({{ $task->id }}, this.value)" class="text-sm rounded-md border-gray-300">
                                                <option value="">Unassigned</option>
                                                @foreach($project->teamMembers as $member)
                                                    <option value="{{ $member->id }}" {{ $task->assigned_to == $member->id ? 'selected' : '' }}>
                                                        {{ $member->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $task->due_date ? $task->due_date->format('M j, Y') : '-' }}
                                            @if($task->is_overdue)
                                                <span class="text-red-600 font-medium">(Overdue)</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $task->estimated_hours ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $task->actual_hours ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $task->progress_percentage }}%"></div>
                                                </div>
                                                <span class="text-sm text-gray-900">{{ $task->progress_percentage }}%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form method="POST" action="{{ route('projects.tasks.destroy', [$project, $task]) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">No tasks found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="expenses-content" class="tab-content hidden">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Expenses Tracker</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Track and manage project expenses</p>
                        </div>
                        <a href="{{ route('projects.expenses.create', $project) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Add Expense
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($project->expenses as $expense)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $expense->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($expense->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->category }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">${{ number_format($expense->amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->expense_date->format('M j, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($expense->status === 'approved') bg-green-100 text-green-800
                                                @elseif($expense->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ ucfirst($expense->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->creator->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($expense->status === 'pending')
                                                <button onclick="approveExpense({{ $expense->id }})" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                                <button onclick="rejectExpense({{ $expense->id }})" class="text-red-600 hover:text-red-900 mr-2">Reject</button>
                                            @endif
                                            <a href="{{ route('projects.expenses.edit', [$project, $expense]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No expenses found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="income-content" class="tab-content hidden">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Income Tracker</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Track and manage project income</p>
                        </div>
                        <a href="{{ route('projects.incomes.create', $project) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Add Income
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($project->incomes as $income)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $income->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($income->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $income->source }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">${{ number_format($income->amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $income->income_date->format('M j, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select onchange="updateIncomeStatus({{ $income->id }}, this.value)" class="text-sm rounded-md border-gray-300
                                                @if($income->status === 'received') bg-green-100 text-green-800
                                                @elseif($income->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                <option value="pending" {{ $income->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="received" {{ $income->status === 'received' ? 'selected' : '' }}>Received</option>
                                                <option value="cancelled" {{ $income->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $income->creator->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('projects.incomes.edit', [$project, $income]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No income records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="summary-content" class="tab-content hidden">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Financial Summary</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Comprehensive financial overview of the project</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-green-50 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold text-green-800">Total Income</h4>
                                <p class="text-3xl font-bold text-green-600">${{ number_format($project->incomes->sum('amount'), 2) }}</p>
                                <p class="text-sm text-green-600">{{ $project->incomes->count() }} transactions</p>
                            </div>
                            <div class="bg-red-50 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold text-red-800">Total Expenses</h4>
                                <p class="text-3xl font-bold text-red-600">${{ number_format($project->expenses->sum('amount'), 2) }}</p>
                                <p class="text-sm text-red-600">{{ $project->expenses->count() }} transactions</p>
                            </div>
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold text-blue-800">Net Profit</h4>
                                <p class="text-3xl font-bold {{ $project->net_profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    ${{ number_format($project->net_profit, 2) }}
                                </p>
                                <p class="text-sm text-blue-600">
                                    {{ $project->net_profit >= 0 ? 'Profit' : 'Loss' }}
                                </p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Expenses by Category</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transactions</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $expensesByCategory = $project->expenses->groupBy('category');
                                            $totalExpenses = $project->expenses->sum('amount');
                                        @endphp
                                        @foreach($expensesByCategory as $category => $expenses)
                                            @php
                                                $categoryTotal = $expenses->sum('amount');
                                                $percentage = $totalExpenses > 0 ? ($categoryTotal / $totalExpenses) * 100 : 0;
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">${{ number_format($categoryTotal, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expenses->count() }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($percentage, 1) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-blue-500', 'text-blue-600');
                button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });

            document.getElementById(tabName + '-content').classList.remove('hidden');

            const activeTab = document.getElementById(tabName + '-tab');
            activeTab.classList.add('active', 'border-blue-500', 'text-blue-600');
            activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        }

        function updateTaskStatus(taskId, status) {
            fetch(`/tasks/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function assignTask(taskId, userId) {
            fetch(`/tasks/${taskId}/assign`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ assigned_to: userId || null })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Task assigned successfully');
                }
            });
        }

        function approveExpense(expenseId) {
            fetch(`/expenses/${expenseId}/approve`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function rejectExpense(expenseId) {
            fetch(`/expenses/${expenseId}/reject`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function updateIncomeStatus(incomeId, status) {
            fetch(`/incomes/${incomeId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        // Initialize first tab as active
        document.addEventListener('DOMContentLoaded', function() {
            showTab('tasks');
        });
    </script>

    <style>
        .tab-button.active {
            border-color: #3B82F6;
            color: #3B82F6;
        }
        .tab-button:not(.active) {
            border-color: transparent;
            color: #6B7280;
        }
        .tab-button:not(.active):hover {
            color: #374151;
            border-color: #D1D5DB;
        }
    </style>
</x-app-layout>
