@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th scope="col" class="text-start">File Name</th>
                <th scope="col" class="text-start" id="action_th">Action</th>
            </tr>
        </thead>
    </table>
</div>
<!-- JavaScript -->
<script>
    $(document).ready(function() {
        var table = $('#clientTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('api.content.client.greetings') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                data: {
                    id: 1
                },
                beforeSend: function(res) {
                    console.log(res.data)
                    $("#customLoader").show();
                },
                complete: function() {
                    console.log(res.data)
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
                    data: 'company',
                    name: 'company',
                    className: "text-start",

                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="hstack gap-1 text-[.9375rem]">
                            <center>
                                <a href="/content/client/greetings/${row.id}/edit" 
                                    class="ti-btn ti-btn-sm ti-btn-soft-info bg-info/10">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                    <a onclick="remove_data(${row.id}, 'greetings')" href="javascript:void(0);"
                                    class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10 hover: ti-btn-soft-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </center>
                        </div>`;
                    }
                }
            ],
            order: [
                [2, "asc"]
            ],
            rowCallback: function(row, data) {
                $(row).attr('data-href',
                `/content/client/greetings/${data.id}/edit`); // Set row link
            },
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });
    });
</script>
<style>
    #action_th{
        width: 150px !important;
    }
</style>
