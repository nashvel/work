
@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height:  120px;;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th class="text-start">Complete Name</th>
                <th class="text-start">Position</th>
                <th class="text-start">Email Address</th>
                <th class="text-start">Phone Number</th>
                <th class="text-start" style="width: 90px;"><center>Actions</center></th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $(document).ready(function() {
        var table = $('#clientTable').DataTable({
            processing: true, 
            serverSide: false,
            ajax: {
                url: "{{ route('va.list') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
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
                    width: '10px',
                    render: function(data) {
                        return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}">`;
                    },
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name',
                    className: "text-start"
                },
                {
                    data: 'position',
                    name: 'position',
                    className: "text-start"
                },
                {
                    data: 'email',
                    name: 'email',
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
                [1, "asc"]
            ],
            rowCallback: function(row, data) {
                $(row).attr('data-href', `/hbcs/clients/details/${data.id}`); // Set row link
            },
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });
       
    });
</script>