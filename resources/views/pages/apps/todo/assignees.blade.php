<div id="assignees" class="hs-overlay ti-modal pointer-events-none hidden mt-6">
    <div class="hs-overlay ti-modal-box mt-0 lg:!max-w-2xl lg:w-full m-3  items-center justify-center">
        <div class="max-h-full w-full overflow-hidden ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="form-header">
                    Assignees
                </h6>
                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#assignees">
                    <span class="sr-only">Close</span>
                    <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                            fill="currentColor" />
                    </svg>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="va_form" autocomplete="off"
                class="space-y-6 p-6 pt-0 bg-white shadow-md rounded-lg">
                @csrf
                <input type="hidden" id="_id" name="id">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="assignees-select" class="block text-sm font-medium text-gray-700">
                            Assignees: <strong class="text-danger">*</strong>
                        </label>

                        <div class="relative">
                            <select id="assignees-select"
                                class="form-select mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="" disabled selected>- Assignee -</option>
                                @php
                                    $roles = ['Directors', 'Manager', 'Virtual Assistant', 'Client', 'Sub-Client'];
                                @endphp

                                @foreach ($roles as $role)
                                    @php
                                        $users = App\Models\User::where('role', $role)->get();
                                    @endphp

                                    @if ($users->count())
                                        <optgroup label="{{ $role }}">
                                            @foreach ($users as $user)
                                                @if ($user->name !== 'Sofia Dima-ano')
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach

                            </select>
                            <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <table class="min-w-full text-sm border border-gray-300" id="assignee-table">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-2 text-left border">Name</th>
                                    <th class="p-2 text-left border w-24">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <input type="hidden" name="assign_ids" id="assign_ids" />

                <hr class="border-gray-300" />
                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md"
                        data-hs-overlay="#assignees">
                        Cancel
                    </button>
                    <button type="submit" id="submit_btn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Save Assignees
                    </button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const select = document.getElementById('assignees-select');
                        const tableBody = document.querySelector('#assignee-table tbody');
                        const hiddenInput = document.getElementById('assign_ids');

                        updateHiddenInput();

                        selectedIds.forEach(id => {
                            const option = select.querySelector(`option[value="${id}"]`);
                            if (option) {
                                option.disabled = true;
                                addAssigneeRow(id, option.text);
                            }
                        });

                        select.addEventListener('change', function() {
                            const selectedOption = this.options[this.selectedIndex];
                            const userId = selectedOption.value;
                            const userName = selectedOption.text;

                            if (!userId || selectedIds.includes(userId)) return;

                            selectedIds.push(userId);
                            updateHiddenInput();
                            selectedOption.disabled = true;
                            this.selectedIndex = 0;
                            addAssigneeRow(userId, userName);
                        });

                        function addAssigneeRow(userId, userName) {
                            const row = document.createElement('tr');
                            row.setAttribute('data-id', userId);
                            row.innerHTML = `
                                <td class="p-2 border">${userName}</td>
                                <td class="p-2 border">
                                    <button type="button" class="text-red-600 hover:underline text-xs text-danger" onclick="removeAssignee('${userId}')">Remove</button>
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
                    });
                </script>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('va_form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch("/todo/assigned", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error('Request failed');
                    return response.json();
                })
                .then(data => {
                    const modal = document.querySelector('#assignees');
                    const backdrop = document.querySelector('.hs-overlay-backdrop');

                    modal?.classList.add('hidden');
                    backdrop?.remove();

                    load_task();
                })

                .catch(error => {
                    console.error(error);
                });
        });
    });
</script>
