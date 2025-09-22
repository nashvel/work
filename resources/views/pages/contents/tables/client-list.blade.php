
@include('pages.actions.table-mod')

<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10"
        style="min-height:  120px;;">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th class="text-start">Company</th>
                <th class="text-start" style="width: 160px;">Advertisement</th>
                <th class="text-start" style="width: 200px;">Date Uploaded</th>
                <th class="text-start" style="width: 90px;">Actions</th>
            </tr>
        </thead>
    </table>
</div>

<style>
    .zoomable img {
        transition: transform 0.3s ease-in-out;
        max-width: 150px;
        /* Adjust as needed */
        max-height: 100px;
    }

    .zoomable:hover img {
        transform: scale(2);
        /* Zoom effect */
    }
</style>

<script>
    $(document).ready(function() {
        var table = $('#clientTable').DataTable({
            processing: true,
            serverSide: false, // Since we are loading all data at once
            ajax: {
                url: "{{ route('cms.clients.data') }}",
                type: "GET",
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
                    data: 'id',
                    render: function(data) {
                        return `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${data}">`;
                    },
                    orderable: false
                },
                {
                    data: 'client_name',
                    className: "text-start"
                },
                {
                    data: 'ads_video_link',
                    render: function(data, type, row) {
                        return row.ads_video_link ? `
                            <button class="ti-btn ti-btn-outline-light !rounded-full btn-wave watch-video"
                                    data-video="${row.ads_video_link}">
                                    <i class="bi bi-collection-play mx-1"></i> Watch Video
                                </button>
                            ` : '-';
                    }
                },
                {
                    data: 'date_created',
                    className: "text-start"
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function(data) {
                        return `
                        <div class="hs-tooltip ti-main-tooltip [--placement:top]">
                            <a href="javascript:void(0);" onclick="editClient(${data})" data-hs-overlay="#hs-extralarge-modal" class="ti-btn ti-btn-icon ti-btn-sm bg-info/10">
                                <i class="ri-edit-line text-info"></i>
                                <span class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-info !text-xs !font-medium !text-white shadow-sm dark:bg-slate-700 hidden"
                                    role="tooltip"> Edit </span>
                            </a>
                        </div>
                        <div class="hs-tooltip ti-main-tooltip [--placement:top]">
                            <a href="javascript:void(0);" class="deleteClient ti-btn ti-btn-icon ti-btn-sm bg-danger/10" data-id="' .
                            $client->id .
                            '">
                                <i class="ri-delete-bin-line text-danger"></i>
                                <span class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-danger !text-xs !font-medium !text-white shadow-sm dark:bg-slate-700 hidden"
                                    role="tooltip"> Delete </span>
                            </a>
                        </div>
                        `;
                    }
                }
            ],
            order: [
                [1, "asc"]
            ],
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });

        // Edit Button Click (Just Alert for Now)
        $(document).on("click", ".editClient", function() {
            let clientId = $(this).data("id");
            alert("Edit client with ID: " + clientId);
        });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("hs-extralarge-modal");
        var modalTitle = modal.querySelector(".ti-modal-title");
        var modalBody = modal.querySelector(".ti-modal-body");

        // Open Modal and Set Content
        function openModal(title, content) {
            modalTitle.innerText = title;
            modalBody.innerHTML = content;
            modal.classList.remove("hidden"); // Show modal
        }

        // Handle Logo Button Click
        document.addEventListener("click", function(event) {
            if (event.target.closest(".view-logo")) {
                let logoUrl = event.target.closest("button").getAttribute("data-logo");

                openModal("Client Logo",
                    `<img src="${logoUrl}" class="w-full rounded-lg" alt="Client Logo">`);
            }

            // Handle Video Button Click
            if (event.target.closest(".watch-video")) {
                let videoUrl = event.target.closest("button").getAttribute("data-video");

                openModal("Watch Video", `
                    <video width="100%" controls autoplay>
                        <source src="${videoUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `);
            }
        });

        // Close Modal When Clicking Outside
        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });


    });
</script>
