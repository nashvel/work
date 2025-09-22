<x-app-layout>

    <x-slot name="title">Manage Clients</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Clients</x-slot>
    <x-slot name="buttons">
        <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#create-va">
            <i class="bi bi-person-plus-fill me-1"></i> Add Contact Person
        </button>
    </x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-8 col-span-12">
            <div class="box custom-box">
                <div class="box-body">

                    @php
                        $company = App\Models\Contact::where('id', $id)->first();
                    @endphp

                    <div class="flex items-center mb-4 gap-2 flex-wrap"> <span
                            class="avatar avatar-lg me-1 bg-gradient-to-br from-primary to-secondary"><i
                                class="ri-stack-line text-2xl leading-none"></i></span>
                        <div>
                            <h6 class="font-medium mb-1 task-title">{{ $company->company_name }}</h6>
                            <span class="text-textmuted dark:text-textmuted/50 text-xs">
                                <i class="ri-circle-fill text-primary text-[0.5625rem]"></i>
                                <span class="mx-2">{{ $company->address }}, {{ $company->city }},
                                    {{ $company->state }}, {{ $company->zip }}</span>
                            </span>
                        </div>
                        <div class="ms-auto align-self-start">
                            <div class="ti-dropdown hs-dropdown"> <a aria-label="anchor" href="javascript:void(0);"
                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary ti-dropdown-toggle hs-dropdown-toggle">
                                    <i class="fe fe-more-vertical"></i> </a>
                                <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                    <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                class="ri-eye-line align-middle me-1 inline-block"></i>View</a></li>
                                    <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                class="ri-edit-line align-middle me-1 inline-block"></i>Edit</a></li>
                                    <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                class="ri-delete-bin-line me-1 align-middle inline-block"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>



                    <hr class="mt-5 mb-5">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Whoops! Something went wrong.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <hr>
                    @endif
                    @include('pages.contacts.partials.company-details')
                </div>

                <div class="box-footer flex gap-3 justify-end ">
                    <button type="submit"
                        class="bg-gray-100 text-dark px-4 py-2 rounded-md !hover:bg-green-800 transition">
                        <i class="bi bi-check2-circle"></i>
                        <span class="mx-1">Save Changes</span>
                    </button>
                </div>
            </div>

            <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-clock-history px-1"></i> Transaction Logs here.
                    <hr class="mb-3 mt-3">
                    @include('pages.contacts.tables.companycontacts')
                </div>
            </div>
        </div>
        <div class="xxl:col-span-4 col-span-12">

            <div class="grid grid-cols-12 gap-x-6">
                <div class="xxl:col-span-6 col-span-12">
                    <div class="box crm-card text-center justify-center">
                        <div class="box-body">
                            <div class="flex justify-center mb-2">
                                <div class="p-2 border border-secondary/10 bg-secondary/10  rounded-full">
                                    <span class="avatar avatar-rounded avatar-md bg-secondary svg-white mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="#000000" viewBox="0 0 256 256">
                                            <path
                                                d="M256,136a8,8,0,0,1-8,8H232v16a8,8,0,0,1-16,0V144H200a8,8,0,0,1,0-16h16V112a8,8,0,0,1,16,0v16h16A8,8,0,0,1,256,136Zm-57.87,58.85a8,8,0,0,1-12.26,10.3C165.75,181.19,138.09,168,108,168s-57.75,13.19-77.87,37.15a8,8,0,0,1-12.25-10.3c14.94-17.78,33.52-30.41,54.17-37.17a68,68,0,1,1,71.9,0C164.6,164.44,183.18,177.07,198.13,194.85ZM108,152a52,52,0,1,0-52-52A52.06,52.06,0,0,0,108,152Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <p class="flex-auto text-textmuted dark:text-textmuted/50 text-[14px] mb-0 mt-1">No. of
                                Contacts</p>
                        </div>
                        <div class="flex items-center justify-center mt-0">
                            <h4 class="mb-3 flex items-center">968</h4>
                        </div>
                    </div>
                </div>

                <div class="xxl:col-span-6 col-span-12">
                    <div class="box crm-card text-center justify-center">
                        <div class="box-body">
                            <div class="flex justify-center mb-2">
                                <div class="p-2 border border-secondary/10 bg-secondary/10  rounded-full">
                                    <span class="avatar avatar-rounded avatar-md bg-primarytint2color svg-white mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="#000000" viewBox="0 0 256 256">
                                            <path
                                                d="M224,200h-8V40a8,8,0,0,0-8-8H152a8,8,0,0,0-8,8V80H96a8,8,0,0,0-8,8v40H48a8,8,0,0,0-8,8v64H32a8,8,0,0,0,0,16H224a8,8,0,0,0,0-16ZM160,48h40V200H160ZM104,96h40V200H104ZM56,144H88v56H56Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <p class="flex-auto text-textmuted dark:text-textmuted/50 text-[14px] mb-0 mt-1">No. of
                                Projects
                            </p>
                        </div>
                        <div class="flex items-center justify-center mt-1">
                            <h4 class="mb-3 flex items-center">968</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-clock-history px-1"></i> Related Projects
                    <hr class="mb-3 mt-3">
                </div>
            </div>
        </div>
    </div>


    @include('pages.contacts.partials.company-contact')

</x-app-layout>


{{-- 
<div class="table-controls flex justify-between items-center mb-3">
    <div class="flex items-center gap-3">
        <select id="bulkAction" class="border rounded px-3 py-2">
            <option value="" disabled selected>Action</option>
            <option value="delete">🗑️ Move to Trash</option>
            <option value="export">📥 Export to CSV</option>
        </select>
        <button id="applyAction" class="bg-white text-dark px-4 py-2 rounded">
            <i class="bi bi-send"></i>
        </button>
        <div id="customSearchWrapper"></div>
    </div>

    <div class="flex items-center gap-3">
        <div id="customLengthWrapper"></div>
    </div>
</div>

<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height:  120px;;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th class="text-start">Name</th>
                <th class="text-start" id="action_th_credit"  style="width: 50px">Credit</th>
                <th class="text-start" style="width: 100px">Remaining</th>
                <th class="text-start" id="action_th">Actions</th>
            </tr>
        </thead>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#clientTable').DataTable({
            processing: true,
            serverSide: false, // Since we are loading all data at once
            ajax: {
                url: "{{ route('relationship.contacts') }}",
                type: "GET",
                data: {
                    id: {{ $id }}
                },
                beforeSend: function() {
                    $("#customLoader").removeClass("hidden");
                },
                complete: function() {
                    $("#customLoader").addClass("hidden");
                },
                dataSrc: function(json) {
                    console.log("API Response:", json); // 🔴 LOG RESPONSE TO CONSOLE
                    return json.data || []; // Ensure it returns an array
                },
                error: function(xhr, error, thrown) {
                    console.error("AJAX Error:", xhr.responseText); // 🔴 LOG ERROR
                }
            },
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here...",
            },
            columns: [{
                    data: 'id',
                    render: function(data) {
                        return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}">`;
                    },
                    orderable: false
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        let photoUrl = row.photo ? row.photo :
                            '/user.png'; // Fallback to default image

                        return `
                            <span style="display: flex; align-items: center;" class="!text-dark">
                                <span class="avatar me-2 avatar-sm avatar-rounded"> 
                                    <img src="${photoUrl}" alt="Profile" onerror="this.onerror=null;this.src='/user.png';">
                                </span>
                                ${data}
                                <span class="text-muted mx-3">(${row.company})</span>                    
                            </span>
                        `;
                    }
                },
                {
                    data: 'credit',
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                        <center>
                            <div class="progress progress-lg p-1">
                                <div class="progress-bar progress-bar-striped progress-bar-animated x"
                                    role="progressbar" style="width:0%;" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </center>
                    `;
                    }
                },
                {
                    data: 'credit',
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                        <center>
                             0 / <strong>0</strong> (<span class="text-dark">0%</span>)
                        </center>
                    `;
                    }
                },
                {

                    data: 'actions',
                    orderable: false,
                }
            ],
            order: [
                [1, "asc"]
            ],
            
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });

        $("#selectAll").on("click", function() {
            $(".rowCheckbox").prop("checked", this.checked);
        });

        // Apply Bulk Action
        $("#applyAction").on("click", function() {
            let selectedIds = $(".rowCheckbox:checked").map(function() {
                return this.value;
            }).get();
            let action = $("#bulkAction").val();

            if (selectedIds.length === 0 || !action) {
                alert("Select at least one record and an action.");
                return;
            }

            if (action === "delete") {
                if (confirm("Are you sure you want to delete selected clients?")) {
                    $.ajax({
                        url: "{{ route('clients.delete') }}",
                        type: "POST",
                        data: {
                            ids: selectedIds,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert(response.success);
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            alert("Error: " + xhr.responseText);
                        }
                    });
                }
            } else if (action === "export") {
                alert("Exporting: " + selectedIds.join(", "));
            }
        });

        // Delete Single Client
        $(document).on("click", ".deleteClient", function() {
            let clientId = $(this).data("id");
            if (confirm("Delete this client?")) {
                $.ajax({
                    url: "{{ route('clients.delete') }}",
                    type: "POST",
                    data: {
                        ids: [clientId],
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.success);
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        });

        function boldNumbersInInfo() {
            let info = $('.dataTables_info').html();
            info = info.replace(/(\d+)/g, '<strong>$1</strong>'); // Wrap numbers in <strong>
            $('.dataTables_info').html(info);
        }

        // Reapply bold effect every time the table updates
        $('#clientTable').on('draw.dt', function() {
            boldNumbersInInfo();
        });

        // Edit Button Click (Just Alert for Now)
        $(document).on("click", ".editClient", function() {
            let clientId = $(this).data("id");
            alert("Edit client with ID: " + clientId);
        });
    });
</script>

<style>
    #action_th_credit {
        width: 100px !important;
    }
</style> --}}
