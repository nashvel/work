@php
    function getCompletion($task)
    {
        $total = $task->subtasks->count();
        if ($total == 0) {
            return 0;
        }
        $completed = $task->subtasks->where('status', 'completed')->count();
        return round(($completed / $total) * 100);
    }

    function getColor($task)
    {
        $progress = getCompletion($task);
        if ($progress < 30) {
            return '#f44336';
        } // red
        if ($progress < 60) {
            return '#ff9800';
        } // orange
        return '#4caf50'; // green
    }

    function getStatusTextColor($status)
    {
        return match ($status) {
            'completed' => 'text-success',
            'pending' => 'text-warning',
            'in_progress' => 'text-blue-600',
            default => 'text-gray-700',
        };
    }

    function getPriorityTextColor($priority)
    {
        return match ($priority) {
            'low' => 'text-dark',
            'medium' => 'text-primary',
            'high' => 'text-danger',
            default => 'text-gray-700',
        };
    }

@endphp
<x-app-layout>
    <x-slot name="title">Todo List</x-slot>
    <x-slot name="url_1">{"link": "/bid/invitation", "text": "Todo List"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/invitation", "text": "Task"}</x-slot>
    <x-slot name="active">List of Task</x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body overflow-auto">
                        <table class="min-w-full table-auto  table-bordered border-collapse border border-gray-300">
                            <thead> 
                                <tr class="bg-gray-100 text-left">
                                    <th class="border border-gray-300 p-2 w-8">Done</th>
                                    <th class="border border-gray-300 p-2">Title</th>
                                    <th class="border border-gray-300 p-2 w-32">Priority</th>
                                    <th class="border border-gray-300 p-2 w-40">Due Date</th>
                                    <th class="border border-gray-300 p-2 w-40">Status</th>
                                    <th class="border border-gray-300 p-2 w-48">Assignees</th>
                                    {{-- <th class="border border-gray-300 p-2 w-48">Progress</th> --}}
                                    <th class="border border-gray-300 p-2 w-24" width="50">Action</th>
                                </tr>
                            </thead>
                            <tbody id="task-list">
                                @foreach ($tasks as $task)
                                    <tr data-id="{{ $task->id }}" class="border border-gray-300">

                                        {{-- Checkbox --}}
                                        <td class="p-0 text-center">
                                            <input type="checkbox" class="form-check-input mx-3"
                                                {{ $task->status === 'completed' ? 'checked' : '' }}
                                                onchange="toggleTaskStatus(this, {{ $task->id }})" />
                                        </td>

                                        {{-- Title --}}
                                        <td class="p-0">
                                            <input type="text" class="w-full border-none" value="{{ $task->title }}"
                                                onblur="saveTask(this, {{ $task->id }})" />
                                        </td>

                                        {{-- Priority --}}
                                        <td class="p-0">
                                            <select
                                                class="border-none w-full {{ getPriorityTextColor($task->priority) }}"
                                                onchange="saveTaskField(this, {{ $task->id }}, 'priority')">
                                                <option value="low"
                                                    {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                                                <option value="medium"
                                                    {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium
                                                </option>
                                                <option value="high"
                                                    {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                                            </select>
                                        </td>


                                        {{-- Due Date --}}
                                        <td class="p-0">
                                            <input type="date" class="border-none w-full"
                                                value="{{ $task->due_date }}"
                                                onchange="saveTaskField(this, {{ $task->id }}, 'due_date')" />
                                        </td>

                                        {{-- Status --}}
                                        <td class="p-0">
                                            <select class="border-none w-full {{ getStatusTextColor($task->status) }}"
                                                onchange="saveTaskField(this, {{ $task->id }}, 'status')">
                                                <option value="pending"
                                                    {{ $task->status === 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="completed"
                                                    {{ $task->status === 'completed' ? 'selected' : '' }}>Completed
                                                </option>
                                                <option value="in_progress"
                                                    {{ $task->status === 'in_progress' ? 'selected' : '' }}>In
                                                    Progress
                                                </option>
                                            </select>
                                        </td>


                                        {{-- Assignees --}}
                                        <td class="p-1">
                                            <div class="flex gap-1">
                                                @php
                                                    $ids = explode(',', $task->assign_id ?? ''); // This could also be a variable like $user_ids
                                                    $users = App\Models\User::whereIn('id', $ids)->get();
                                                @endphp
                                                @foreach ($users as $user)
                                                    <span class="custom-tooltip">
                                                        @if ($user->profile_photo_path)
                                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                                class="w-8 h-8 rounded-full border object-cover" />
                                                        @else
                                                            <div
                                                                class="w-8 h-8 rounded-full bg-gray-300 text-gray-700 flex items-center justify-center text-xs font-semibold border">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                        <span class="tooltip-text">{{ $user->name }}</span>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>

                                        <td>
                                            <div class="hstack gap-1 text-[.9375rem]">
                                                <center>

                                                    <span class="custom-tooltip">
                                                        <a href="javascript:void(0)" data-hs-overlay="#assignees"
                                                            onclick="assign('{{ $task->assign_id ?? '' }}',{{ $task->id ?? '' }})"
                                                            class="ti-btn ti-btn-sm ti-btn-soft-success bg-success/10">
                                                            <i class="bi bi-person-plus"></i>
                                                        </a>
                                                        <span class="tooltip-text">Assignees</span>
                                                    </span>

                                                    <span class="custom-tooltip">
                                                        <a onclick="remove_data({{ $task->id }}, 'task')"
                                                            href="javascript:void(0);"
                                                            class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                        <span class="tooltip-text">Delete</span>
                                                    </span>

                                                </center>
                                            </div>
                                        </td>

                                        {{-- Progress Bar --}}
                                        {{-- <td class="p-1">
                                            <div class="progress progress-animate progress-sm w-full overflow-hidden">
                                                <div class="h-full progress-bar progress-bar-striped progress-bar-animated"
                                                    style="width: {{ getCompletion($task) }}%; background-color: {{ getColor($task) }};">
                                                </div>
                                            </div>


                                            <div class="text-xs text-center text-gray-600 mt-1">
                                                {{ getCompletion($task) }}%
                                            </div>
                                        </td>
                                        --}}
                                    </tr>

                                    {{-- @foreach ($task->subtasks as $sub)
                                        <tr>
                                            <td class="p-1 border-1" style="border: 1px solid #D1D5DB;">

                                            </td>
                                            <td class="p-0" colspan="6" style="border: 1px solid #D1D5DB;">
                                                <input type="checkbox" class="form-check-input mx-3"
                                                    {{ $sub->status === 'completed' ? 'checked' : '' }}
                                                    onchange="toggleSubtaskStatus(this, {{ $sub->id }}, {{ $task->id }})" />
                                                <input type="text" class="flex-1 border-none"
                                                    value="{{ $sub->title }}"
                                                    onblur="saveSubTask(this, {{ $sub->id }}, {{ $task->id }})" />
                                                <div class="space-y-1 max-h-32 overflow-auto">
                                                    <div class="flex items-center gap-1">
                                                        <input type="checkbox" class="form-check-input mx-3"
                                                            {{ $sub->status === 'completed' ? 'checked' : '' }}
                                                            onchange="toggleSubtaskStatus(this, {{ $sub->id }}, {{ $task->id }})" />
                                                        <input type="text" class="flex-1"
                                                            value="{{ $sub->title }}"
                                                            onblur="saveSubTask(this, {{ $sub->id }}, {{ $task->id }})" />
                                                    </div>
                                                </div>
                                            </td>

                                            <td>-</td>
                                            <input type="text" class="w-full mt-1"
                                            onblur="createSubTask(this, {{ $task->id }})"
                                            placeholder="Add sub-task" />

                                        </tr>
                                    @endforeach --}}
                                    {{-- <tr>
                                        <td class="text-center">
                                            <span class="bi bi-plus-lg text-muted"
                                                style="font-weight: bold; font-size: 24px;"></span>
                                        </td>
                                        <td colspan="6" class="p-2">
                                            <input type="text" class="w-full p-2 border rounded"
                                                onblur="createTask(this)" placeholder="New Task" />
                                        </td>

                                        <td>-</td>
                                    </tr> --}}
                                @endforeach

                                {{-- Add New Task Row --}}
                                <tr>
                                    <td class="text-center">
                                        <center>
                                            <button class="ti-btn ti-btn-light ti-btn-xs">
                                                <span class="bi bi-plus-lg text-success"
                                                    style="font-weight: bold;"></span>
                                            </button>
                                        </center>
                                    </td>
                                    <td colspan="6" class="p-2">
                                        <input type="text" class="w-full p-2 border rounded"
                                            onblur="createTask(this)" placeholder="New Task" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if (Auth::user()->role === 'Virtual Assistant')
            <div class="xl:col-span-12 col-span-12">
                <div class="box custom-box">
                    <div class="box-header mb-0 pb-0">
                        <h1 class="text-2xl"><strong>Task Assigned</strong></h1>
                    </div>
                    <div class="box-body overflow-auto pt-0">
                        <hr class="mt-2 mb-4">
                        <table class="min-w-full table-auto  table-bordered border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="border border-gray-300 p-2 w-8">Done</th>
                                    <th class="border border-gray-300 p-2">Title</th>
                                    <th class="border border-gray-300 p-2 w-32">Priority</th>
                                    <th class="border border-gray-300 p-2 w-40">Due Date</th>
                                    <th class="border border-gray-300 p-2 w-40">Status</th>
                                    <th class="border border-gray-300 p-2 w-48">Assignees</th>
                                </tr>
                            </thead>
                            <tbody id="task-list">
                                @php
                                    $userId = Auth::id();

                                    $tasks_assigned = App\Models\V3_Task::with(['subtasks', 'users'])
                                        ->where('isDeleted', 0)
                                        ->whereRaw('FIND_IN_SET(?, assign_id)', [$userId])
                                        ->get();
                                @endphp
                                @foreach ($tasks_assigned as $task)
                                    <tr data-id="{{ $task->id }}" class="border border-gray-300">

                                        {{-- Checkbox --}}
                                        <td class="p-0 text-center">
                                            <input type="checkbox" class="form-check-input mx-3"
                                                {{ $task->status === 'completed' ? 'checked' : '' }}
                                                onchange="toggleTaskStatus(this, {{ $task->id }})" />
                                        </td>

                                        {{-- Title --}}
                                        <td class="p-0">
                                            <input type="text" class="w-full border-none"
                                                value="{{ $task->title }}"
                                                onblur="saveTask(this, {{ $task->id }})" />
                                        </td>

                                        {{-- Priority --}}
                                        <td class="p-2 {{ getPriorityTextColor($task->priority) }}">
                                            {{ ucfirst($task->priority) }}
                                        </td>

                                        {{-- Due Date --}}
                                        <td class="p-2">
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}
                                        </td>

                                        {{-- Status --}}
                                        <td class="p-2 {{ getStatusTextColor($task->status) }}">
                                            @php
                                                $statusText = [
                                                    'pending' => 'Pending',
                                                    'completed' => 'Completed',
                                                    'in_progress' => 'In Progress',
                                                ];
                                            @endphp
                                            {{ $statusText[$task->status] ?? $task->status }}
                                        </td>
                                        {{-- Assignees --}}
                                        <td class="p-1">
                                            <div class="flex gap-1">
                                                @php
                                                    $ids = explode(',', $task->assign_id ?? ''); // This could also be a variable like $user_ids
                                                    $users = App\Models\User::whereIn('id', $ids)->get();
                                                @endphp
                                                @foreach ($users as $user)
                                                    <span class="custom-tooltip">
                                                        @if ($user->profile_photo_path)
                                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                                class="w-8 h-8 rounded-full border object-cover" />
                                                        @else
                                                            <div
                                                                class="w-8 h-8 rounded-full bg-gray-300 text-gray-700 flex items-center justify-center text-xs font-semibold border">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                        <span class="tooltip-text">{{ $user->name }}</span>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        function load_task() {
            $.ajax({
                url: '/todo/create',
                type: 'GET',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#task-list').html(response);
                    setTimeout(() => {
                        window.HSOverlay?.autoInit();
                    }, 100);
                }
            })
        }

        function assign(va, id) {
            const idsx = document.getElementById('assign_ids');
            idsx.value = '';

            const select = document.getElementById('assignees-select');
            const tableBody = document.querySelector('#assignee-table tbody');
            const hiddenInput = document.getElementById('assign_ids');
            const hiddenId = document.getElementById('_id');

            tableBody.innerHTML = ''; // 🧹 Clear all previous rows
            Array.from(select.options).forEach(option => option.disabled = false); // 🔓 Re-enable all options

            const initialAssignIds = va
                .split(',')
                .map(id => id.trim())
                .filter(id => id);

            let selectedIds = [...initialAssignIds];

            updateHiddenInput();

            selectedIds.forEach(id => {
                const option = select.querySelector(`option[value="${id}"]`);
                if (option) {
                    option.disabled = true;
                    addAssigneeRow(id, option.text);
                }
            });

            select.onchange = function() {
                const selectedOption = this.options[this.selectedIndex];
                const userId = selectedOption.value;
                const userName = selectedOption.text;

                if (!userId || selectedIds.includes(userId)) return;

                selectedIds.push(userId);
                updateHiddenInput();
                selectedOption.disabled = true;
                this.selectedIndex = 0;
                addAssigneeRow(userId, userName);
            };

            function addAssigneeRow(userId, userName) {
                const row = document.createElement('tr');
                row.setAttribute('data-id', userId);
                row.innerHTML = `
            <td class="p-2 border">${userName}</td>
            <td class="p-2 border">
                <button type="button" class="text-red-600 hover:underline text-xs text-danger" onclick="removeAssignee('${userId}')">
                    <span class="bi bi-trash mx-1"></span>Remove
                </button>
            </td>`;
                tableBody.appendChild(row);
            }

            function updateHiddenInput() {
                hiddenInput.value = selectedIds.join(',');
            }

            window.removeAssignee = function(userId) {
                selectedIds = selectedIds.filter(id => id !== userId);
                updateHiddenInput();
                const row = document.querySelector(`#assignee-table tr[data-id="${userId}"]`);
                if (row) row.remove();
                const option = select.querySelector(`option[value="${userId}"]`);
                if (option) option.disabled = false;
            };

            hiddenId.value = id;
        }



        function updateStatusColor(select) {
            select.classList.remove('text-success', 'text-warning', 'text-blue-600', 'text-gray-700');
            switch (select.value) {
                case 'completed':
                    select.classList.add('text-success');
                    break;
                case 'pending':
                    select.classList.add('text-warning');
                    break;
                case 'in_progress':
                    select.classList.add('text-blue-600');
                    break;
                default:
                    select.classList.add('text-gray-700');
            }
        }

        function updatePriorityColor(select) {
            select.classList.remove('text-dark', 'text-primary', 'text-danger', 'text-gray-700');
            switch (select.value) {
                case 'low':
                    select.classList.add('text-dark');
                    break;
                case 'medium':
                    select.classList.add('text-primary');
                    break;
                case 'high':
                    select.classList.add('text-danger');
                    break;
                default:
                    select.classList.add('text-gray-700');
            }
        }

        function saveTask(input, id) {
            $.ajax({
                url: `/todo/tasks/${id}`,
                type: 'PUT',
                data: {
                    title: input.value,
                    _token: '{{ csrf_token() }}'
                },
                success: () => console.log('Task title saved'),
            });
        }

        function saveTaskField(select, id, field) {
            const data = {};
            data[field] = select.value;
            data._token = '{{ csrf_token() }}';

            if (field === 'status') updateStatusColor(select);
            if (field === 'priority') updatePriorityColor(select);

            $.ajax({
                url: `/todo/tasks/${id}`,
                type: 'PUT',
                data: data,
                success: () => console.log(`${field} updated`),
            });
        }

        function toggleTaskStatus(checkbox, taskId) {
            $.ajax({
                url: `/todo/tasks/${taskId}`,
                type: 'PUT',
                data: {
                    status: checkbox.checked ? 'completed' : 'pending',
                    _token: '{{ csrf_token() }}'
                },
                success: () => console.log('Task status toggled')
            });
        }

        function saveSubTask(input, id, taskId) {
            $.ajax({
                url: `/todo/subtasks/${id}`,
                type: 'PUT',
                data: {
                    title: input.value,
                    _token: '{{ csrf_token() }}'
                },
                success: () => refreshProgress(taskId),
            });
        }

        function createSubTask(input, taskId) {
            const title = input.value.trim();
            if (!title) return;
            $.post('/todo/subtasks', {
                title,
                v3_task_id: taskId,
                _token: '{{ csrf_token() }}'
            }, () => location.reload()); // Could replace with DOM insert for full SPA
        }

        function toggleSubtaskStatus(checkbox, subtaskId, taskId) {
            $.ajax({
                url: `/todo/subtasks/${subtaskId}`,
                type: 'PUT',
                data: {
                    status: checkbox.checked ? 'completed' : 'pending',
                    _token: '{{ csrf_token() }}'
                },
                success: () => refreshProgress(taskId)
            });
        }

        function createTask(input) {
            const title = input.value.trim();
            if (!title) return;
            $.post('/todo/tasks', {
                title,
                _token: '{{ csrf_token() }}'
            }, () => load_task());
        }

        // Refresh the progress bar after subtask update
        function refreshProgress(taskId) {
            $.get(`/todo/tasks/${taskId}/progress`, function(data) {
                const row = $(`tr[data-id=${taskId}]`);
                row.find('td:nth-child(7) > div > div').css('width', data.percent + '%');
                row.find('td:nth-child(7) > div > div').css('background-color', data.color);
                row.find('td:nth-child(7) > div + div').text(data.percent + '%');
            });
        }
    </script>

    @include('pages.apps.todo.assignees')


    <style>
        .custom-tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .custom-tooltip .tooltip-text {
            visibility: hidden;
            background-color: #222;
            /* Tooltip background */
            color: #fff;
            /* Tooltip text color */
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            text-align: center;
            border-radius: 4px;
            padding: 4px 8px;
            position: absolute;
            z-index: 100;
            bottom: 120%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            white-space: nowrap;
        }

        .custom-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
    </style>

</x-app-layout>
