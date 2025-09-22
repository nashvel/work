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
        <div class="segment gap-2 bg-gray-100 dark:bg-gray-700 rounded-md p-1">
            <button
                class="segment-item  h-10 py-2 segment-item-active text-xl px-3"><svg stroke="currentColor"
                    fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                    <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                    <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                    <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                </svg>
            </button>
            <button class="rounded-md bg-white segment-item h-10 py-2 text-xl px-3">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                    stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 6l11 0"></path>
                    <path d="M9 12l11 0"></path>
                    <path d="M9 18l11 0"></path>
                    <path d="M5 6l0 .01"></path>
                    <path d="M5 12l0 .01"></path>
                    <path d="M5 18l0 .01"></path>
                </svg>
            </button>
        </div>
    </div>
</div>


<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th scope="col" class="text-start">File Name</th>
                <th scope="col" class="text-start" style="width: 150px">Uploaded</th>
                <th scope="col" class="text-start" style=" color: #364051 !important width: 50px">Type</th>
                <th scope="col" class="text-start" style="width: 60px">Size</th>
                <th scope="col" class="text-start" style="width: 100px">Uploaded</th>
                <th scope="col" class="text-center text-gray-600" id="action_th">Action</th>
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
            window.open(link, '_blank');
        }
    });



    $(document).ready(function() {
        var table = $('#clientTable').DataTable({
            processing: true,
            serverSide: false,
            drawCallback: function() {
                if (window.HSDropdown) {
                    HSDropdown.autoInit();
                }
            },
            ajax: {
                url: "{{ route('api.filemanager.files') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                data: {
                    id: "{{ $folderId }}"
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
                    render: function(data) {
                        return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}">`;
                    },
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name',
                    className: "text-start",
                    render: function(data, type, row) {
                        return `${data}`;
                    }
                },
                {
                    data: 'uploaded',
                    name: 'uploaded',
                    className: "text-start",
                    render: function(data, type, row) {
                        return `<img src="/user.png" alt="${data}" onerror="this.onerror=null; this.src='/user.png';" class="avatar avatar-sm mb-0 mx-1"> ${data}`;
                    }
                },
                {
                    data: 'format',
                    name: 'format',
                    className: "text-start text-muted"
                },
                {
                    data: 'size',
                    name: 'size',
                    className: "text-start"
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: "text-start"
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                        <div class="ti-dropdown hs-dropdown w-full justify-center">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="inline-flex justify-center w-8 h-8 items-center rounded-full bg-gray-100 hover:bg-gray-200">
                                <i class="ri-more-fill font-semibold text-textmuted dark:text-dark"></i>
                            </a>
                            <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                <li>
                                    <a data-hs-overlay="#move-files-folder"  class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                                        <span class="bi bi-arrows-move text-lg"></span>
                                        <span class="text-sm">Move</span>
                                    </a>
                                </li>
                                <li>
                                    <a  href="/download-file/${row.google_drive_id}" class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                                        <span class="bi bi-cloud-download text-lg"></span>
                                        <span class="text-sm">Download</span>
                                    </a>
                                </li>
                                <li>
                                    <a  onclick="rename_ff(${row.id}, 'Folder', '${row.name}')" class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                                        <span class="bi bi-pen text-lg"></span>
                                        <span class="text-sm">Rename</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                                        <span class="bi bi-send-plus text-lg"></span>
                                        <span class="text-sm">Share</span>
                                    </a>
                                </li>
                                <li>
                                    <a  onclick="remove_data(${row.id}, 'file-manager')" class="ti-dropdown-item flex items-center gap-2 text-danger" href="javascript:void(0);">
                                        <span class="bi bi-trash text-lg"></span>
                                        <span class="text-sm">Delete</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        `;
                    }
                }
            ],
            order: [
                [6, "asc"]
            ],
            rowCallback: function(row, data) {
                $(row).attr('data-href',
                    `/file-manager/preview/${data.google_drive_id}`); // Set row link
            },
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });
    });
</script>

<style>
    #action_th {
        width: 55px !important;
    }
</style>
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
</style>