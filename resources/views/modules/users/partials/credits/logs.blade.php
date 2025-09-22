@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="creditTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th scope="col" class="text-start">Remarks</th>
                <th scope="col" class="text-start">Type</th>
                <th scope="col" class="text-start">Hours</th>
                <th scope="col" class="text-start">Balance (Hrs)</th>
                <th scope="col" class="text-start">Timestamp</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $(document).ready(function () {
        const table = $('#creditTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('credit.logs') }}",
                beforeSend: () => $("#customLoader").show(),
                complete: () => $("#customLoader").hide()
            },
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search credit logs...",
            },
            columns: [
                {
                    data: 'id',
                    orderable: false,
                    render: data => `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}">`,
                },
                { data: 'remarks', className: "text-start" },
                { data: 'type', className: "text-start text-muted" },
                {
                    data: 'hours',
                    className: "text-end",
                    render: data => `${parseFloat(data).toFixed(1)} hrs`
                },
                {
                    data: 'balance',
                    className: "text-end",
                    render: data => `${parseFloat(data).toFixed(1)} hrs`
                },
                { data: 'created_at', className: "text-start" },
            ],
            order: [[5, "desc"]], // Sort by Timestamp column
            rowCallback: (row, data) => {
                $(row).attr('data-href', `/credit-hours/view/${data.id}`);
            },
            initComplete: () => {
                $("#customSearchWrapper").html($("#creditTable_filter"));
                $("#customLengthWrapper").html($("#creditTable_length"));
            }
        });

        $('#creditTable tbody').on('click', 'tr', function (e) {
            const $row = $(this);
            const link = $row.data('href');
            if (!$(e.target).closest('button, input[type="checkbox"], a').length) {
                window.location.href = link;
            }
        });
    });
</script>

<style>
    #action_th {
        width: 80px !important;
    }
</style>
