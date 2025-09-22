<x-app-layout>

    <x-slot name="title">Bidding Invitation</x-slot>
    <x-slot name="url_1">{"link": "/bid/invitation", "text": "Bidding"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/invitation", "text": "Invitation"}</x-slot>
    <x-slot name="active">List</x-slot>
    <x-slot name="buttons"></x-slot>

    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                        <div id="grid-loading"></div>
                    </div>
                </div>
            </div>
        </div>


        <div id="modal" class="hs-overlay hidden ti-modal">
            <div
                class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="max-h-full w-full overflow-hidden ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="modal-form-title"></h6>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                    <script>
                        document.getElementById('modal-form-title').innerHTML = 'New Client Registration';
                    </script>
                </div>
            </div>
        </div>

        <div id="view-list" class="hs-overlay hidden ti-modal">
            <div
                class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="max-h-full w-full overflow-hidden ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="modal-form-title"></h6>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                    <script>
                        document.getElementById('modal-form-title').innerHTML = 'New Client Registration';
                    </script>
                </div>
            </div>
        </div>


        <style>
            .gridjs-table tbody tr {
                padding: 1px 1px;
                height: 5px;
            }
        </style>
        <script src="/assets/libs/gridjs/gridjs.umd.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        @php
            $biddings = App\Models\ProjectBidding::join('t_invites', 't_invites.project_id', 't_project_bidding.id')
                ->where('email', Auth::user()->email)
                ->where('status',null)
                ->get()
                ->map(function ($proj) {
                    return [
                        'id' => $proj->id,
                        'code' => $proj->proj_code,
                        'name' => $proj->proj_name,
                        'due' => date('D, F d, Y'),
                        'stage' => $proj->proj_stages,
                        'category' => $proj->category,
                        'subject' => $proj->subject,
                    ];
                });

        @endphp
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const clients = @json($biddings);

                // Ensure each row matches the correct column index
                const data = clients.map(bid => [
                    bid.code,
                    bid.name,
                    bid.due,
                    bid.stage,
                    bid.category,
                    bid.subject,
                    bid.id
                ]);

                console.log("Grid Data:", data); // Debugging

                new gridjs.Grid({
                    columns: [{
                            name: "Code",
                            width: "100px",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    # ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Name",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Due Date",
                            width: "150px",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Stages",
                            width: "100px",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                   ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Category",
                            width: "150px",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    <i class="ri-circle-fill text-warning mx-2 text-[0.5625rem]"></i>
                                    ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Subject",
                            width: "150px",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Actions",
                            width: "90px",
                            formatter: (cell) => gridjs.html(`
                                <div class="btn-list p-0">
                                    <center>
                                        <div class="ti-btn-list text-nowrap ms-auto">
                                            <button onclick="invitation(${cell}, 'accept')" aria-label="buton" type="button"
                                                class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-success"> <i
                                                    class="ri-check-line"></i> 
                                                </button> 
                                            <button onclick="invitation(${cell}, 'decline')" aria-label="buton" type="button"
                                            class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-danger me-0"> <i
                                                class="ri-close-line"></i> </button> 
                                        </div>
                                    </center>
                                </div>
                            `)
                        }
                    ],
                    pagination: true,
                    search: true,
                    sort: true,
                    data: () => {
                        return new Promise(resolve => {
                            setTimeout(() => resolve(data), 500);
                        });
                    }
                }).render(document.getElementById("grid-loading"));
            });
        </script>

    </div>
</x-app-layout>
