@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th scope="col" class="text-start">File Name</th>
                <th scope="col" class="text-start" id="type_th" style=" color: #364051 !important">Format</th>
                <th scope="col" class="text-start">Date Uploaded</th>
                <th scope="col" class="text-start">Priority</th>
                <th scope="col" class="text-start">Assign</th>
                <th scope="col" class="text-start">Progress</th>
                <th scope="col" class="text-start" id="action_th">Actions</th>
            </tr>
        </thead>
    </table>
</div>

<script>
     $(document).on('click', '#clientTable tbody tr', function(e) {
            let $row = $(this);
            let link = $row.data('href');

            // Prevent redirection when clicking buttons, checkboxes, or links
            if (!$(e.target).closest('button, input[type="checkbox"], a').length) {
                //window.open(link, '_blank'); // Open link in a new tab
                window.location.href = link;
            }
        });
        
    $(document).ready(function() {
        var table = $('#clientTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('api.task.list') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                data: {
                    id: "{{ request()->query('f') }}"
                },
                beforeSend: function() {
                    $("#customLoader").show();
                },
                complete: function() {
                    $("#customLoader").hide();
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
                    data: 'task',
                    name: 'task',
                    className: "text-start",

                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        let statusColor = "text-gray-500"; // Default color

                        if (data === "In Progress") {
                            statusColor = "text-primary"; // Example: Blue
                        } else if (data === "Completed") {
                            statusColor = "text-success"; // Example: Green
                        } else if (data === "Pending") {
                            statusColor = "text-warning"; // Example: Yellow/Orange
                        }

                        return `
                            <span class="block mb-1">
                                <i class="ri-circle-fill ${statusColor} mx-2 text-[0.5625rem]"></i>
                                <span class="font-medium ${statusColor}">${data}</span>
                            </span>
                        `;
                    }
                },
                {
                    data: 'date',
                    name: 'date',
                    className: "text-start"
                },
                {
                    data: 'priority',
                    name: 'priority',
                    className: "text-start",
                    render: function(data, type, row) {
                        let priorityColor = "text-gray-500"; // Default color

                        if (data === "Low") {
                            priorityColor = "text-success"; // Green
                        } else if (data === "Medium") {
                            priorityColor = "text-warning"; // Yellow/Orange
                        } else if (data === "High") {
                            priorityColor = "text-danger"; // Red
                        } else if (data === "Critical") {
                            priorityColor = "text-danger font-bold"; // Bold Red
                        }

                        return `
                            <span class="block mb-1">
                                <span class="font-medium ${priorityColor}">${data}</span>
                            </span>
                        `;
                    }
                },
                {
                    data: 'assigned',
                    name: 'assigned',
                    className: "text-center items-center font-medium",
                    render: function(data, type, row) {
                        return `
                            <span class="avatar avatar-sm avatar-rounded">
                                <img src="../assets/images/faces/7.jpg" alt="">
                            </span>
                            asdasd
                        `;
                    }
                },
                {
                    data: 'assigned',
                    name: 'assigned',
                    render: function(data, type, row) {
                        return `
                           <div class="flex items-center">
                                <div class="progress progress-animate progress-xs w-full ms-2" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 20%"></div>
                                </div>
                                <div class="mx-2">20%</div>
                            </div>
                        `;
                    }
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                    
                        return `<div class="hstack gap-1 text-[.9375rem]">
                        <center>

                            <span class="custom-tooltip">
                                <a onclick="remove_data(${row.id}, 'greetings')" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-soft-warning bg-warning/20">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <span class="tooltip-text">Rename</span>
                            </span>

                            <span class="custom-tooltip">
                                <a href="/task/list/details/${row.id}" target="_blank" class="ti-btn ti-btn-sm ti-btn-soft-info bg-info/10">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <span class="tooltip-text">Preview</span>
                            </span>

                            <span class="custom-tooltip">
                                <a onclick="remove_data(${row.id}, 'file-manager')" href="javascript:void(0);" class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <span class="tooltip-text">Delete</span>
                            </span>

                        </center>
                    </div>`;
                    }
                }
            ],
            order: [
                [2, "asc"]
            ],
            rowCallback: function(row, data) {
                $(row).attr('data-href', `/task/list/details/${data.id}`); // Set row link
            },
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });
    });
</script>
<style>
    #action_th {
        width: 150px !important;
    }
</style>
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
