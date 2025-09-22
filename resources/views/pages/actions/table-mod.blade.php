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

<script>


    $(document).ready(function() {

        $("#selectAll").on("click", function() {
            $(".rowCheckbox").prop("checked", this.checked);
        });
        
        $("#selectAll").on("click", function() {
            $(".rowCheckbox").prop("checked", this.checked);
        });

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
            info = info.replace(/(\d+)/g, '<strong>$1</strong>'); 
            $('.dataTables_info').html(info);
        }

        $('#clientTable').on('draw.dt', function() {
            boldNumbersInInfo();
        });

    });
</script>
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

    tr {
        cursor: pointer;
    }
</style>