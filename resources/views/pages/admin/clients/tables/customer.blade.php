@include('pages.@components.table-actions')

<div class="table-responsive-x">
    <table id="clientTable"
        class="table wrap table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height: 120px;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 10px; white-space: nowrap;">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Name</th>
                <th scope="col" class="text-start" style="white-space: nowrap; color: #364051 !important;">Type</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Company</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Postion</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Address</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Phone Number</th>
                <th scope="col" class="text-start" style="white-space: nowrap;">Email Address</th>
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
                url: "{{ route('clients.data') }}",
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
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        return `
                        <div class="flex items-center gap-2">
                        <div class="leading-none">
                            <span class="avatar avatar-rounded avatar-sm border border-container !border-dark">
                                <img src="${row.photo}" 
                                    alt="Profile Image" 
                                    onerror="this.src='/user.png'">
                            </span>
                        </div>
                        <div>
                            <a data-bs-toggle="offcanvas" data-hs-overlay="#offcanvasExample">
                                <span class="block font-medium text-[14px]">${data}</span>
                            </a>
                        </div>                                    
                    </div>
                        `;
                    },
                },
                {
                    data: 'type',
                    className: "text-start text-muted"
                },
                {
                    data: 'company',
                    name: 'company',
                    className: "text-start"
                },
                {
                    data: 'position',
                    className: "text-start"
                },
                {
                    data: 'zip',
                    className: "text-start",
                    render: function(data, type, row) {
                        return `
                             ${row.city}, ${row.state}, ${row.zip}
                        `;
                    }
                },
                {
                    data: 'phone',
                    name: 'phone',
                    className: "text-start"
                },
                {
                    data: 'email',
                    name: 'email',
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
    });
</script>
