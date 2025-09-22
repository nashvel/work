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
                <th scope="col" class="text-start" style="white-space: nowrap;">Company</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Owner</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Email Address</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Phone Number</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Clients</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Percentage</th>
                <th scope="col" class="text-start" style="white-space: nowrap;"><center>Credit</center></th>
                <th scope="col" class="text-start" style="white-space: nowrap;"><center>Remaining</center></th>
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
                url: "{{ route('hbcs.clients.data') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
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
                    data: 'company_name',
                    name: 'company_name',
                    className: "text-start"
                },
                {
                    data: 'owner',
                    name: 'owner',
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
                    data: 'credit_percentage',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="progress progress-md p-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated ${row.progress_class}"
                                role="progressbar" style="width: ${row.credit_percentage}%;" 
                                aria-valuenow="${row.credit_percentage}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>`;
                    }
                },
                {
                    data: 'credit_total',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="hstack gap-1 text-[.9375rem] text-center">
                            <span class="text-sm ${row.progress_class_text}">${row.credit_percentage}%</span>
                        </div>`;
                    }
                },
                {
                    data: 'remaining_credit',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="hstack gap-1 text-[.9375rem] text-sm text-center">
                            ${row.remaining_credit} / <strong>${row.credit_total}</strong>
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
                                <div class="hs-tooltip ti-main-tooltip [--placement:left]">
                                    <a href="/hbcs/clients/details/${row.id}" target="_blank" 
                                        class="ti-btn ti-btn-sm bg-info/10">
                                        <i class="bi bi-eye text-info"></i>
                                        <span class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-info 
                                            !text-xs !font-medium !text-white shadow-sm dark:bg-slate-700 hidden"
                                            role="tooltip"> View </span>
                                          View
                                    </a>
                                </div>
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

        // Select/Deselect All Checkboxes
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
    #action_th {
        width: 100px !important;
    }
</style>
