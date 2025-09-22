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

<div class="table-responsive-x">
    <table id="clientTable"
        class="table wrap table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height: 120px;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 10px; white-space: nowrap;">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Complete Name</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Portal</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Email Address</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Phone Number</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Clients</th>
                <th scope="col" class="text-start" id="action_th" style="white-space: nowrap;">Actions</th>
            </tr>
        </thead>
    </table>
</div>


<!-- JavaScript -->
<script>
    $(document).ready(function() {
        var table = $('#clientTable').DataTable({
            processing: true, // Disables the built-in loader
            serverSide: false,
            ajax: {
                url: "{{ route('api.hbcs.data') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: 'directors'
                },
                beforeSend: function() {
                    $("#customLoader").show(); // Show custom loader before request
                },
                complete: function() {
                    $("#customLoader").hide(); // Hide custom loader after request
                }
            },
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here...",
            },
            columns: [{
                    data: 'id',
                    width: '10px',
                    render: function(data) {
                        return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}">`;
                    },
                    orderable: false
                },
                {
                    data: 'owner',
                    name: 'owner',
                    className: "text-start"
                },
                {
                    data: 'company_name',
                    name: 'company_name',
                    className: "text-start"
                },
                {
                    data: 'email_address',
                    name: 'email_address',
                    className: "text-start"
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number',
                    className: "text-start"
                },
                {
                    data: 'client_count',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="hstack gap-1 text-[.9375rem] text-sm">
                            <i class="bi bi-people-fill mx-1"></i> ${row.client_count}
                        </div>`;
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
                                <span class="tooltip-text">Edit</span>
                            </span>

                            <span class="custom-tooltip">
                                <a href="/file-manager/preview/${row.google_drive_id}" target="_blank" class="ti-btn ti-btn-sm ti-btn-soft-success bg-success/10">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <span class="tooltip-text">View</span>
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
                $(row).attr('data-href', `/hbcs/clients/details/${data.id}`); // Set row link
            },
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });

        // ✅ Click Event for Row Navigation (Excluding Buttons & Checkboxes)
        $(document).on('click', '#clientTable tbody tr', function(e) {
            let $row = $(this);
            let link = $row.data('href');

            // Prevent redirection when clicking buttons, checkboxes, or links
            if (!$(e.target).closest('button, input[type="checkbox"], a').length) {
                //window.open(link, '_blank'); // Open link in a new tab
                window.location.href = link;
            }
        });

    });
</script>
<style>
    #action_th {
        width: 120px !important;
    }
</style>
