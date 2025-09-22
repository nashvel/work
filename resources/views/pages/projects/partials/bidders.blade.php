<div class="table-controls flex justify-between items-center mb-3">
    <div class="flex items-center gap-3">
        <div id="customSearchWrapper"></div>
        <button id="applyAction" class="bg-white text-dark px-4 py-2 rounded">
            <i class="bi bi-send"></i>
        </button>
    </div>

    <div class="flex items-center gap-3">
        <div id="customLengthWrapper"></div>
    </div>
</div>

<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height: 120px;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 50px !important">
                    <center>
                        <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                    </center>
                </th>
                <th class="text-start">Name</th>
                <th class="hidden"></th>
            </tr>
        </thead>
    </table>
</div>
<script>
    $(document).ready(function() {
    var selectedBidders = {}; // Store selected bidders across pages

    var table = $('#clientTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('relationship.contacts') }}",
            type: "GET",
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
                data: 'id',
                width: "50px",
                render: function(data) {
                    let checked = selectedBidders[data] ? 'checked' : '';
                    return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}" ${checked}>`;
                },
                orderable: false
            },
            {
                data: 'name',
                render: function(data, type, row) {
                    let photoUrl = row.photo ? row.photo : '/user.png';
                    return `
                        <div class="flex items-center gap-4">
                            <span class="avatar avatar-md"> <img src="${photoUrl}" alt=""> </span>
                            <div> 
                                <span class="block font-lg">${data}</span> 
                                <span class="block text-[14px] text-textmuted dark:text-textmuted/50">
                                    ${row.company}
                                </span> 
                            </div>
                        </div>
                    `;
                }
            },
            {
                data: 'company',
                visible: false
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

    // Handle row click to toggle selection
    $('#clientTable tbody').on('click', 'tr', function(event) {
        if (!$(event.target).is('input[type="checkbox"]')) {
            let $checkbox = $(this).find('.rowCheckbox');
            $checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
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

    // Function to update the selected bidders UI
    function updateSelectedBidders() {
        let $customSelect = $('#customSelectWrapper');
        let $selectElement = $('#assigned-team-members');

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
});

</script>

<style>
    .dataTables_info {
        display: block;
    }

    #clientTable th:nth-child(1),
    #clientTable td:nth-child(1) {
        width: 5px !important;
        min-width: 5px !important;
        max-width: 5px !important;
        text-align: center;
    }
</style>
