@include('pages.actions.table-mod')

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
            processing: true, // Disables the built-in loader
            serverSide: false,
            ajax: {
                url: "{{ route('relationship.company.subscriber') }}",
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
                    data: 'zip',
                    name: 'zip',
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
                        return `<div class="hstack gap-1 text-[.9375rem]">
                            <center>
                                <div class="hs-tooltip ti-main-tooltip [--placement:left]">
                                    <a href="/relationship/list/details/${row.id}" target="_blank" 
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
                [7, "asc"]
            ],
            rowCallback: function(row, data) {
                $(row).attr('data-href', `/relationship/list/details/${data.id}`); // Set row link
            },
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });
    });
</script>
