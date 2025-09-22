
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
                <th scope="col" class="text-start">Company</th>
                <th scope="col" class="text-start" id="type_th" style=" color: #364051 !important">Type</th>
                <th scope="col" class="text-start">Zip Code</th>
                <th scope="col" class="text-start">City</th>
                <th scope="col" class="text-start">State</th>
                <th scope="col" class="text-start">Phone</th>
                <th scope="col" class="text-start" id="action_th">Actions</th>
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
                url: "{{ route('relationship.company') }}",
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
                    render: function(data) {
                        return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}">`;
                    },
                    orderable: false
                },
                {
                    data: 'company_name',
                    name: 'company_name',
                    className: "text-start",
                    
                },
                {
                    data: 'type',
                    name: 'type',
                    className: "text-start text-muted"
                },
                {
                    data: 'zip_code',
                    name: 'zip_code',
                    className: "text-start"
                },
                {
                    data: 'city',
                    name: 'city',
                    className: "text-start"
                },
                {
                    data: 'state',
                    name: 'state',
                    className: "text-start"
                },
                {
                    data: 'phone',
                    name: 'phone',
                    className: "text-start"
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <div class="hstack gap-1 text-[.9375rem]">
                        <center>
                            <div class="hs-tooltip ti-main-tooltip [--placement:left]">
                                <a href="/relationship/person/list/${row.id}" target="_blank" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10" data-id="' .
                                $client->id .
                                '">
                                    <i class="bi bi-eye text-success"></i>
                                    <span class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-info !text-xs !font-medium !text-white shadow-sm dark:bg-slate-700 hidden"
                                        role="tooltip"> View </span>
                                </a>
                            </div>
                            <div class="hs-tooltip ti-main-tooltip [--placement:left]">
                                <a href="javascript:void(0);" class="editClient ti-btn ti-btn-icon ti-btn-sm bg-info/10" data-id="${row.id}">
                                    <i class="ri-edit-line text-info"></i>
                                    <span class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-info 
                                        !text-xs !font-medium !text-white shadow-sm dark:bg-slate-700 hidden"
                                        role="tooltip" data-popper-placement="top"> Edit </span>
                                </a>
                            </div>
                            <div class="hs-tooltip ti-main-tooltip [--placement:left]">
                                <a href="javascript:void(0);" class="deleteClient ti-btn ti-btn-icon ti-btn-sm bg-danger/10" data-id="${row.id}">
                                    <i class="ri-delete-bin-line text-danger"></i>
                                    <span class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-danger 
                                        !text-xs !font-medium !text-white shadow-sm dark:bg-slate-700 hidden"
                                        role="tooltip" data-popper-placement="top"> Delete </span>
                                </a>
                            </div>
                        </center>
                    </div>
                `;
                    }
                }
            ],
            order: [
                [7, "asc"]
            ],
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
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
    #action_th{
        width: 100px !important;
    }
</style>