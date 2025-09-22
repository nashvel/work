<div class="table-controls flex justify-between items-center mb-3">
    <div class="flex items-center gap-3">
        <div id="customSearchWrapper"></div>
    </div>

    <div class="flex items-center gap-3">
        <div id="customLengthWrapper"></div>
        <button onclick="load_contacts_refresh()" class="bg-white text-dark px-4 py-2 rounded-md transition">
            <i class="bi bi-arrow-clockwise me-1"></i> Refresh
        </button>
    </div>
</div>

<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start"><span class="mx-4">General Contractors</span></th>
                <th class="hidden"></th> <!-- hidden column for ordering -->
                <th class="text-end"></th>
            </tr>
        </thead>
    </table>
</div>
<script>

    function load_contacts_refresh(){
        load_contacts();
        document.getElementById('customSearchWrapper').style.display = 'none'
        document.getElementById('customLengthWrapper').style.display = 'none'
    }
    var selectedBidders = {};

    function load_contacts() {
        console.log('refresh');

        if ($.fn.DataTable.isDataTable('#clientTable')) {
            $('#clientTable').DataTable().clear().destroy();
        }

        var table = $('#clientTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('project.relationship.contacts') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    $("#customLoader").removeClass("hidden");
                },
                complete: function() {
                    $("#customLoader").addClass("hidden");
                },
                dataSrc: function(json) {
                    console.log("API Response:", json);
                    return json.data || [];
                },
                error: function(xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here...",
            },
            lengthChange: true,
            columns: [{
                    data: 'name',
                    render: function(data, type, row) {
                        let photoUrl = row.photo ? row.photo : '/user.png';
                        return `
                <div class="flex items-center gap-4 mx-4">
                    <span class="avatar avatar-md"> <img src="${photoUrl}" alt=""> </span>
                    <div>
                        <span class="block font-lg">${row.first_name ?? ''} ${row.last_name ?? ''}  </span>
                        <span class="block text-[14px] text-textmuted dark:text-textmuted/50">
                            ${row.company} <small> - ${row.email}</small>
                        </span>
                    </div>
                </div>
            `;
                    }
                },
                {
                    data: 'company', // still used for ordering, just hidden
                    visible: false
                },
                {
                    data: 'id',
                    width: "50px",
                    render: function(data, type, row) {
                        let checked = selectedBidders[row.email] ? 'checked' : '';
                        return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${row.pid}" ${checked}>`;
                    },
                    orderable: false
                }
            ],
            order: [
                [2, "asc"]
            ],
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });

        // Handle checkbox selection
        $('#clientTable tbody').on('change', '.rowCheckbox', function() {
            let bidderId = $(this).val();
            let $row = $(this).closest('tr');
            let bidderName = $row.find('.font-lg').text().trim();
            let companyName = $row.find('.text-textmuted').text().trim();
            let displayText = `${bidderName} (${companyName})`;

            if (this.checked) {
                selectedBidders[bidderId] = {
                    id: bidderId,
                    text: displayText
                };
            } else {
                delete selectedBidders[bidderId];
            }
            updateSelectedBidders();
        });

        // Restore checked state when table redraws
        table.on('draw', function() {
            $('#clientTable tbody .rowCheckbox').each(function() {
                let bidderId = $(this).val();
                if (selectedBidders[bidderId]) {
                    $(this).prop('checked', true);
                }
            });
        });

        // Update selected bidders UI
        function updateSelectedBidders() {
            let $customSelect = $('#customSelectWrapper');
            let $selectElement = $('#bidders-list');

            $customSelect.empty();
            $selectElement.empty();

            let biddersArray = Object.values(selectedBidders);
            if (biddersArray.length === 0) {
                $customSelect.text("Click to select bidders");
            } else {
                biddersArray.forEach((bidder) => {
                    let $item = $(`
                    <span class="selected-item">${bidder.text} <span class="remove-item" data-id="${bidder.id}">×</span></span>
                `);
                    $customSelect.append($item);
                    $selectElement.append(
                        `<option value="${bidder.id}" selected>${bidder.text}</option>`
                    );
                });
            }
        }

        // Remove selected bidder when clicking "×"
        $(document).on('click', '.remove-item', function(event) {
            event.stopPropagation();
            let bidderId = $(this).data('id');

            delete selectedBidders[bidderId];
            $('#clientTable tbody .rowCheckbox[value="' + bidderId + '"]').prop('checked', false);
            updateSelectedBidders();
        });
    }

    // Delegate row click globally — outside of load_contacts — to survive redraws
    $(document).on('click', '#clientTable tbody tr', function(event) {
        if (!$(event.target).is('input[type="checkbox"]')) {
            let $checkbox = $(this).find('.rowCheckbox');
            $checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
        }
    });

    // Call loader on page ready
    $(document).ready(function() {
        load_contacts();
    });
</script>

<style>
    #checked_box {
        width: 50px !important;
    }

    .dataTables_info {
        display: block;
    }

    #clientTable th:last-child,
    #clientTable td:last-child {
        text-align: right;
    }


    /* ✅ Add this for the length dropdown width */
    select[name="clientTable_length"] {
        width: 55px !important;
    }

    tr{
        cursor: pointer;
    }
</style>
