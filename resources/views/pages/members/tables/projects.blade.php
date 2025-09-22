@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="projectTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" id="action_th"><span class="mx-3">Code</span></th>
                <th class="text-start">Project</th>
                <th class="text-start">Due Date</th>
                <th class="text-start">Stage</th>
                <th class="text-start" id="action_th">Bidders</th>
                <th class="text-start" id="action_th">Scopes</th>
                <th class="text-start" id="action_th">Invited</th>
                <th class="text-start" style="width: 160px;">Created At</th>
                <th class="text-start" id="action_th_s">...</th>
            </tr>
        </thead>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#projectTable').DataTable({
            processing: true,
            serverSide: false, // Since we are loading all data at once
            ajax: {
                url: "{{ route('api.client.projects') }}",
                type: "POST",
                data: {
                    email: '{{ $client->email }}',
                    _token: "{{ csrf_token() }}"
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
                    data: 'code',
                    render: function(data, type, row) {
                        return `<span class="mx-3 text-center">#${data}</span>`
                    }
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        let photoUrl = row.photo ? row.photo :
                            '/user.png'; // Fallback to default image

                        return `
                            <span style="display: flex; align-items: center;" class="!text-dark">
                                ${data}                        
                            </span>
                        `;
                    }
                },
                {
                    data: 'due',
                    className: "text-start"
                },
                {
                    data: 'stage',
                    className: "text-start"
                },
                {
                    data: 'bidders',
                    className: "text-start",
                    render: function(data, type, row) {
                        return  `<span class="block mx-3 mb-1 p-0">
                            <i class="bi bi-people me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                            <a href="#" class="text-dark">${data}</a>
                        </span>`
                    }
                },
                {
                    data: 'scopes',
                    className: "text-start",
                    render: function(data, type, row) {
                        return  `<span class="block mx-3 mb-1 p-0">
                            <i class="bi bi-stickies me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                            <a href="#" class="text-dark">${data}</a>
                        </span>`
                    }
                },
                {
                    data: 'invited',
                    className: "text-start",
                    render: function(data, type, row) {
                        return  `<span class="block mx-3 mb-1 p-0">
                            <i class="ri-mail-line me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                            <a href="#" class="text-dark">${data}</a>
                        </span>`
                    }
                },
                {
                    data: 'created_at',
                    className: "text-start"
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,

                    render: function(data, type, row) {
                        return `<div class="hstack gap-1 text-[.9375rem]">
                            <center>
                                <div class="hs-tooltip ti-main-tooltip [--placement:left]">
                                    <a href="#"
                                        class="ti-btn ti-btn-sm bg-info/10">
                                        <i class="bi bi-eye text-info"></i>
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
            initComplete: function() {
                $("#customSearchWrapper").html($("#projectTable_filter"));
                $("#customLengthWrapper").html($("#projectTable_length"));
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
        $('#projectTable').on('draw.dt', function() {
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
    #action_th_s {
        width: 5px !important;
        text-align: center !important;
    }
</style>
