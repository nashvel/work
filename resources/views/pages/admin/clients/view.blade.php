{{-- @php
    $lead = App\Models\Lead::where('id', $id)->first();    
    $user_id = App\Models\User::where('email', $lead->email)->first();
    
@endphp --}}
@php
     $user = Auth::user();
   if ($user->role === 'Virtual Assistant') {
        $clientId = $user->company;
    } elseif ($user->role === 'Administrator') {
        $clientId = $request->id;
    } elseif ($user->role === 'Sub-Client') {
        $clientId = $user->id; //Clients::where('email', $user->email)->value('id');
    } else {
        $clientId = App\Models\Lead::where('email', $user->email)->value('id');
    }
@endphp
<x-app-layout>

    {{-- <x-slot name="title">{{ $lead->company_name }} </x-slot> --}}
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Client"}</x-slot>
    <x-slot name="active">Workspace</x-slot>
    <x-slot name="buttons">
        <form action="{{ route('grant.access') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $user_id->id ?? $clientId }}">
            <button class="ti-btn ti-btn-soft-primary !rounded-full label-ti-btn">
                <i class="bi bi-magic label-ti-btn-icon me-2"></i>
                Access Portal
            </button>
        </form>

    </x-slot>


    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-4 col-span-4">
            @include('pages.admin.clients.details.credits')

            <div class="box custom-box">
                <div class="box-body">
                    <div class="flex items-center mb-4 gap-2 flex-wrap">
                        <img src="/assets/img/google_drive-logo_brandlogos.net_zrexb.png" style="height: 30px"
                            alt="">
                        <div class="ms-auto align-self-start">
                            <div class="ti-dropdown hs-dropdown">
                                <a aria-label="anchor" href="javascript:void(0);"
                                    class="ti-btn ti-btn-sm ti-btn-soft-light text-dark ti-dropdown-toggle hs-dropdown-toggle">
                                    <i class="fe fe-more-vertical"></i> Settings
                                </a>
                                {{-- <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                    @php
                                        $lead = App\Models\Lead::where('id', $id)->first();
                                    @endphp
                                    @if (App\Models\User::where('email', $lead->email)->first()?->google_drive_id == null)
                                        <li>
                                            <a class="ti-dropdown-item" href="javascript:void(0);"
                                                onclick="activate_google_drive({{ $id }})">
                                                <i class="ri-delete-bin-line me-1 align-middle inline-block"></i>
                                                Activate
                                            </a>
                                        </li>
                                    @endif
                                    <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                class="ri-delete-bin-line me-1 align-middle inline-block"></i>Move to
                                            Trash</a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>

                    <hr class="mb-3 mt-3">
                    <table
                        class="ti-custom-table ti-custom-table-head !border  border-defaultborder dark:border-defaultborder/10">
                        <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                            <td width="180"
                                class="text-end border-2 border-defaultborder dark:border-defaultborder/10 !p-2">
                                Storage Capacity : </td>
                            <td class="border-2 border-defaultborder dark:border-defaultborder/10 font-bold !p-2">
                                <i class="bi bi-database mx-2"></i> 114.23MB / <strong> 15</strong>GB
                            </td>
                        </tr>
                        <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                            <td width="180"
                                class="text-end border-2 border-defaultborder dark:border-defaultborder/10 !p-2">
                                Status : </td>
                            <td class="border-2 border-defaultborder dark:border-defaultborder/10 !p-2">
                                @if (App\Models\User::where('email', $lead->email ?? $user->email)->first()?->google_drive_id == null)
                                    <i class="bi bi-building mx-2"></i>
                                    Disabled
                                    </a>
                                @else
                                    <i class="bi bi-building mx-2"></i>
                                    Activated
                                @endif
                            </td>
                        </tr>
                    </table>
                    <center>

                    </center>
                </div>
            </div>

            {{-- <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-clock-history px-1"></i> Assigned Virtual Assistant
                    <hr class="mb-3 mt-3">
                    @php
                        $yourAssignedVAs = App\Models\User::where('email', $lead->email)->first()?->assign_id;
                        $assignedIds = explode(',', $yourAssignedVAs);
                        $assignedUsers = \App\Models\User::whereIn('id', $assignedIds)->get();
                    @endphp

                    <script>
                        const preAssignedIds = @json(explode(',', $yourAssignedVAs ?? ''));
                    </script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const select = document.getElementById('assignees-select');
                            const hiddenInput = document.getElementById('assign_ids');

                            // Initialize selectedIds from hidden input value
                            let selectedIds = hiddenInput.value ? hiddenInput.value.split(',').filter(id => id.trim()) : [];

                            function updateHiddenInput() {
                                hiddenInput.value = selectedIds.join(',');
                            }

                            updateHiddenInput();

                            select.addEventListener('change', function() {
                                const selectedOption = this.options[this.selectedIndex];
                                const userId = selectedOption.value;
                                const userName = selectedOption.text;

                                if (!userId || selectedIds.includes(userId)) return;

                                selectedIds.push(userId);
                                updateHiddenInput();
                                selectedOption.disabled = true;
                                this.selectedIndex = 0;

                                const tableBody = document.querySelector('#assignee-table tbody');
                                const row = document.createElement('tr');
                                row.setAttribute('data-id', userId);
                                row.innerHTML = `
                                <td class="p-2 border">${userName}</td>
                                <td class="p-2 border">
                                    <button type="button" class="text-red-600 hover:underline text-xs text-danger" onclick="removeAssignee('${userId}')">Remove</button>
                                </td>`;
                                tableBody.appendChild(row);
                            });

                            window.removeAssignee = function(userId) {
                                selectedIds = selectedIds.filter(id => id !== userId);
                                updateHiddenInput();

                                // Remove table row
                                const row = document.querySelector(`#assignee-table tr[data-id="${userId}"]`);
                                if (row) row.remove();

                                // Enable option
                                const option = select.querySelector(`option[value="${userId}"]`);
                                if (option) option.disabled = false;
                            };
                        });
                    </script>

                    <form action="{{ route('assigned.va') }}" method="POST" enctype="multipart/form-data"
                        id="va_form" autocomplete="off">
                        @csrf

                        <input type="hidden" name="id" value="{{ $lead->email }}">

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="assignees-select" class="block text-sm font-medium text-gray-700">
                                    Assignees: <strong class="text-danger">*</strong>
                                </label>

                                <div class="relative">
                                    <select id="assignees-select"
                                        class="form-select mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                        <option value="" disabled selected>- Virtual Assistant -</option>
                                        @foreach (App\Models\User::where('role', 'Virtual Assistant')->get() as $va)
                                            <option value="{{ $va->id }}"
                                                @if (in_array($va->id, $assignedIds)) disabled @endif>
                                                {{ $va->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
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
                                    <tbody>
                                        @foreach ($assignedUsers as $user)
                                            <tr data-id="{{ $user->id }}">
                                                <td class="p-2 border">{{ $user->name }}</td>
                                                <td class="p-2 border">
                                                    <button type="button"
                                                        class="text-red-600 hover:underline text-xs text-danger"
                                                        onclick="removeAssignee('{{ $user->id }}')">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="hidden" name="assign_ids" id="assign_ids" value="{{ $yourAssignedVAs }}" />

                        <hr class="border-gray-300 mb-3 mt-3" />
                        <div class="flex justify-end space-x-3">
                            <button type="submit" id="submit_btn"
                                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-blue-700">
                                Save Assignees
                            </button>
                        </div>
                    </form>
                </div>
            </div> --}}


        </div>
        <div class="xxl:col-span-8 col-span-8">

            <div class="box custom-box">
                <div class="box-body">

                    <div class="grid grid-cols-12 gap-x-6">
                        <div class="col-span-2">
                            <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('adjustment')"
                                class="ti-btn ti-btn-light !rounded-full label-ti-btn w-full">
                                <i class="bi bi-tools label-ti-btn-icon me-2"></i>
                                Credit
                            </button>
                        </div>
                        <div class="col-span-2">
                            <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('charge')"
                                class="ti-btn ti-btn-light !rounded-full btn-wave w-full waves-effect waves-light label-ti-btn">
                                <i class="bi bi-clock-history  label-ti-btn-icon "></i>
                                Charge
                            </button>
                        </div>
                        <div class="col-span-2">
                            <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('add')"
                                class="ti-btn ti-btn-light !rounded-full label-ti-btn w-full">
                                <i class="bi bi-window-plus label-ti-btn-icon  me-2"></i>
                                Add
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3 mb-5">
                    <span class="bi bi-gear mx-1"></span>
                    This tool enables administrators to adjust user credits and gain full access privileges within the
                    portal.
                </div>
            </div>

            <div class="box custom-box">
                <div class="box-body">
                    {{-- @include('pages.admin.clients.details.info') --}}
                </div>
            </div>

            <div class="box custom-box">
                <div class="box-body">
                    <span class="bi bi-info-circle mx-1"></span>
                    Activity Logs
                    <hr class="mt-3 mb-3">
                </div>
            </div>
        </div>

    </div>

    @include('pages.admin.clients.modal')
    @include('pages.admin.clients.forms.credits')
    <script>
        function credit_type(type) {
            document.getElementById('type').value = type;
            document.getElementById('client_type').value = 'client';
        }

        function activate_google_drive(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, activate it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/google-drive-actived',
                        type: 'post',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Activated!",
                                text: "Your record has been deleted.",
                                icon: "success"
                            });
                            setTimeout(() => {
                                window.location.href = response;
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "There was a problem deleting your record. " + error,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
    <br>
</x-app-layout>
