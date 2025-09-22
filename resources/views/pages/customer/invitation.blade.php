<x-app-layout>
    <x-slot name="title">Bidding Invitation</x-slot>
    <x-slot name="url_1">{"link": "/bid/invitation", "text": "Bidding"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/invitation", "text": "Invitation"}</x-slot>
    <x-slot name="active">List</x-slot>
    <x-slot name="buttons"></x-slot>

    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">


    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>Project Bidding Invitations</strong>
                    </h6>
                    <span>You can check and monitor the invitations here.</span>
                    <hr class="mb-3 !mt-3">
                    @include('pages.customer.tables.invites')
                </div>
            </div>
        </div>
    </div>

    <script>
        function preview(encodedRow) {
            console.log("Encoded Row:", encodedRow);

            try {
                const row = JSON.parse(decodeURIComponent(encodedRow));
                console.log("Decoded Row:", row);

                const projectId = row.pid;
                const iframeHTML = `
            <iframe 
                src="https://portal.hillbcs.com/bid/preview/projects/${projectId}" 
                style="width: 100%; height: 560px; border: none;" 
                loading="lazy"
            ></iframe>
        `;

                document.getElementById('preview-container').innerHTML = iframeHTML;
                document.getElementById('project_name').innerHTML = row.name;

                // Show modal
                const modal = document.querySelector('#info');
                window.HSOverlay.open(modal);

            } catch (e) {
                console.error("Failed to decode row:", e);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.HSOverlay?.init();
        });
    </script>


    <div id="info" class="hs-overlay ti-modal pointer-events-none hidden mt-6">
        <div class="hs-overlay ti-modal-box mt-0 lg:!max-w-4xl lg:w-full m-3  items-center justify-center">
            <div class="max-h-full w-full overflow-hidden ti-modal-content">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="form-header">
                        <b id="project_name">-</b>
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#info">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>

                <div id="preview-container" class="space-y-6 p-6 bg-white shadow-md rounded-lg">
                    <!-- iframe will be injected here -->
                </div>


            </div>
        </div>
    </div>

    
    <script>
        function invitation(id, type, category, subject) {
            Swal.fire({
                title: type === 'Bidding' ? 'Bid on this Project?' : `${type} on this Project?`,
                // text: "Please note that this action is irreversible.",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Confirmed"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/bid/invitation/update',
                        type: 'post',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: {
                            id: id,
                            type: type,
                            category: category,
                            subject: subject
                        },
                        success: function(resp) {
                            //console.log(resp)
                            Swal.fire({
                                title: "Success!",
                                // text: "Your record has been " + type,
                                icon: "success"
                            });
                            console.log(resp)
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "There was a problem your record. " + error,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>

</x-app-layout>
