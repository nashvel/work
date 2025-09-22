<x-app-layout>

    <x-slot name="title">Manage Clients</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Clients</x-slot>
    <x-slot name="buttons">
        <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('adjustment')"
            class="ti-btn ti-btn-primary !rounded-full label-ti-btn">
            <i class="bi bi-tools label-ti-btn-icon me-2"></i>
            Credit Adjustment
        </button>
        <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('charge')"
            class="ti-btn ti-btn-danger !rounded-full btn-wave  waves-effect waves-light label-ti-btn">
            <i class="bi bi-clock-history  label-ti-btn-icon "></i>
            Charge Credit
        </button>
        <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('add')"
            class="ti-btn ti-btn-success !rounded-full label-ti-btn">
            <i class="bi bi-window-plus label-ti-btn-icon  me-2"></i>
            Add Credit
        </button>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-8 col-span-12">
            <div class="box custom-box">
                <div class="box-body">
                    @include('pages.clients.details.info')
                </div>
            </div>
        </div>
        <div class="xxl:col-span-4 col-span-12">            
            @include('pages.clients.details.credits')
            <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-clock-history px-1"></i> Transaction Logs here.
                    <hr class="mb-3 mt-3">

                </div>
            </div>
        </div>
    </div>

    @include('pages.clients.modal')
    @include('pages.clients.forms.credits')
    <script>
        function credit_type(type) {
            document.getElementById('type').value = type;
            document.getElementById('client_type').value = 'client';
        }
    </script>
    
</x-app-layout>


{{-- <x-app-layout>
    <x-slot name="title">Client Information</x-slot>
    <x-slot name="url_1">{"link": "/clients", "text": "Client"}</x-slot>
    <x-slot name="active">Overview</x-slot>
    <x-slot name="buttons">
        <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('adjustment')"
            class="ti-btn ti-btn-primary !rounded-full label-ti-btn">
            <i class="bi bi-tools label-ti-btn-icon me-2"></i>
            Credit Adjustment
        </button>
        <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('charge')"
            class="ti-btn ti-btn-danger !rounded-full btn-wave  waves-effect waves-light label-ti-btn">
            <i class="bi bi-clock-history  label-ti-btn-icon "></i>
            Charge Credit
        </button>
        <button data-hs-overlay="#modal-credit" type="button" onclick="credit_type('add')"
            class="ti-btn ti-btn-success !rounded-full label-ti-btn">
            <i class="bi bi-window-plus label-ti-btn-icon  me-2"></i>
            Add Credit
        </button>
    </x-slot>


 
    @php

    @endphp


    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-6">

        @include('pages.clients.details.info')

        <div class="xxl:col-span-4 col-span-12">

            
            <div class="box overflow-hidden">
                <div class="box-header justify-between">
                    <div class="box-title">Transaction Logs</div>
                </div>
                <div class="box-body p-0 relative" id="todo-content">
                    <div>
                        <div class="table-responsive">
                            <table class="ti-custom-table text-nowrap">
                                <thead>
                                    <tr class="border-b !border-defaultborder dark:!border-defaultborder/10">
                                        <th>
                                            <input class="form-check-input check-all" type="checkbox" id="all-tasks"
                                                value="" aria-label="...">
                                        </th>
                                        <th class="todolist-handle-drag">
        
                                        </th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="todo-drag">
        
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>


            <div class="box justify-between">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Discussions
                    </div>
                </div>
                <div class="box-body">
                    {{-- <ul class="list-none profile-timeline">
                        <li>
                            <div>
                                <span
                                    class="avatar avatar-sm shadow-sm bg-primary avatar-rounded profile-timeline-avatar">
                                    <img src="/assets/images/faces/15.jpg" alt="img">
                                </span>
                                </span>
                                <div class="mb-2 flex items-start gap-2">
                                    <div>
                                        <span class="font-medium">Fabian Jones</span>
                                    </div>
                                    <span class="ms-auto bg-light text-textmuted dark:text-textmuted/50 badge">15,Jun
                                        2024 - 06:20</span>
                                </div>
                                <p class="text-textmuted dark:text-textmuted/50 mb-0">
                                    Discuss project scope, objectives, and timelines.
                                </p>
                            </div>
                        </li>
                        
                    </ul> 
                </div>
                <div class="box-footer">
                    <div class="sm:flex items-center leading-none">
                        <div class="sm:me-2 mb-2 sm:mb-0 p-1 rounded-full bg-primary/10 inline-block">
                            <img src="/assets/images/faces/5.jpg" alt=""
                                class="avatar avatar-sm avatar-rounded">
                        </div>
                        <div class="flex-auto">
                            <div class="input-group flex-nowrap">
                                <input type="text"
                                    class="form-control w-sm-50 border !border-s border-defaultborder dark:border-defaultborder/10 shadow-none"
                                    placeholder="Share your thoughts"
                                    aria-label="Recipient's username with two button addons">
                                <button class="ti-btn ti-btn-soft-primary !m-0 btn-wave waves-effect waves-light"
                                    type="button"><i class="bi bi-emoji-smile"></i></button>
                                <button class="ti-btn ti-btn-soft-primary !m-0 btn-wave waves-effect waves-light"
                                    type="button"><i class="bi bi-paperclip"></i></button>
                                <button class="ti-btn ti-btn-soft-primary !m-0 btn-wave waves-effect waves-light"
                                    type="button"><i class="bi bi-camera"></i></button>
                                <button
                                    class="ti-btn bg-primary !m-0 text-white btn-wave waves-effect waves-light text-nowrap"
                                    type="button">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box overflow-hidden">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Documents
                    </div>
                </div>
                <div class="box-body p-0">
                    <ul class="ti-list-group list-group-flush !rounded-none">
                        <li class="ti-list-group-item">
                            <div class="flex items-center flex-wrap gap-2">
                                <span class="avatar avatar-md avatar-rounded p-2 bg-light leading-none">
                                    <img src="/assets/images/media/file-manager/1.png" alt="">
                                </span>
                                <div class="flex-auto">
                                    <a href="javascript:void(0);"><span class="block font-medium">
                                            Invoices - File Manager
                                        </span></a>
                                    <span class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">
                                        Last Updated (1 Month Ago)</span>
                                </div>
                                {{-- <div class="ms-auto">
                                            <button class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-info btn-wave"><i
                                                    class="ri-edit-line"></i></button>
                                            <button class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger btn-wave"><i
                                                    class="ri-delete-bin-line"></i></button>
                                        </div> 
                            </div>
                        </li>
                        <li class="ti-list-group-item">
                            <div class="flex items-center flex-wrap gap-2">
                                <span class="avatar avatar-md avatar-rounded p-2 bg-light leading-none">
                                    <img src="/assets/images/media/file-manager/1.png" alt="">
                                </span>
                                <div class="flex-auto">
                                    <a href="javascript:void(0);"><span class="block font-medium">
                                            Contracts - File Manager
                                        </span></a>
                                    <span class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">
                                        Last Updated (3 Month Ago)</span>
                                </div>
                                {{-- <div class="ms-auto">
                                            <button class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-info btn-wave"><i
                                                    class="ri-edit-line"></i></button>
                                            <button class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger btn-wave"><i
                                                    class="ri-delete-bin-line"></i></button>
                                        </div> 
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Upcoming Tasks
                    </div>
                    <div>
                        <button type="button" class="ti-btn ti-btn-sm ti-btn-light">View All</button>
                    </div>
                </div>
                <div class="box-body" style="min-height: 390px">
                    <hr class=" mb-4">
                    <p class="text-danger text-center">No Task Available Yet!</p>
                    <hr class="mt-4 mb-4">
                    {{-- @include('pages.clients.dashboard_task')
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

<link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                        <b>Clients</b>
                        <hr class="mt-3 mb-3">
                        <div id="grid-loading"></div>
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
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const clients = @json($clients);

                    // Ensure each row matches the correct column index
                    const data = clients.map(client => [
                        [client.name, client.created_at, client.photo ? `{{ asset('storage/') }}/${client.photo}` :
                            "/user.png"
                        ],
                        [client.email, client.phone], // [1] Email & Phone

                        [client.remaining_credit, client.credit_total, client.percentage, client.progressClass,
                            client.progressClassText
                        ], // [3] Email
                        client.id, // [4] ID for actions
                        client.photo ? `{{ asset('storage/') }}/${client.photo}` : "/user.png",

                    ]);

                    console.log("Grid Data:", data); // Debugging

                    new gridjs.Grid({
                        columns: [{
                                name: "Client Information",
                                width: "150px",
                                formatter: (cell, row) => gridjs.html(`
                        <div class="flex items-center gap-2">
                            <div class="leading-none">
                                <span class="avatar avatar-rounded avatar-md">
                                    <img src="${cell[2]}" 
                                        alt="Profile Image" 
                                        onerror="this.src='/user.png'">
                                </span>
                            </div>
                            <div>
                                <a data-bs-toggle="offcanvas" data-hs-overlay="#offcanvasExample">
                                    <span class="block font-medium text-[14px]">${cell[0]}</span>
                                </a>
                                <div class="hs-tooltip ti-main-tooltip">
                                    <span class="block text-textmuted dark:text-textmuted/50 text-[11px]">
                                        <i class="ri-account-circle-line me-1 text-[13px] align-middle"></i>
                                    ${cell[1]}
                                        <span class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-primary !border-primary !text-xs !font-medium !text-white shadow-sm hidden" role="tooltip" style="position: fixed; inset: auto auto 0px 0px; margin: 0px; transform: translate(660px, -531px);" data-popper-placement="top">
                                            Last Updated
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    `)
                            },
                            {
                                name: "Contact Information",
                                width: "200px",
                                formatter: (cell) => gridjs.html(`
                        <span class="block mb-1">
                            <i class="ri-mail-line me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                            ${cell[0]}
                        </span>
                        <span class="block mb-1">
                            <i class="ri-phone-line me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                            ${cell[1]}
                        </span>
                    `)
                            },
                            {
                                name: "Credit",
                                width: "100px",
                                formatter: (cell) => gridjs.html(`
                        <div class="flex mb-1">
                                <span>Credit (<span class="${cell[4]}">${cell[2]}%</span>)</span> 
                                <span class="ms-auto text-[12px]"> ${cell[0]} / <strong class="font-semibold">${cell[1]} </span>
                            </div>
                            <div class="progress progress-md p-1">
                                <div class="progress-bar progress-bar-striped progress-bar-animated ${cell[3]}" role="progressbar" style="width:  ${cell[2]}%;" aria-valuenow="${cell[2]}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                    `)
                            },
                            {
                                name: "Actions",
                                width: "10px",
                                formatter: (cell) => gridjs.html(`
                        <div class="btn-list">
                            <center>
                                <a href="/client/view/${cell}" class="ti-btn ti-btn-sm ti-btn-soft-primary ti-btn-icon !mb-0">
                                    <i class="ri-eye-line"></i>
                                </a>
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
    </div>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-8 col-span-8">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Credit Overview
                    </div>
                </div>
                <div class="box-body">
                    <div id="sales-overview"></div>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-4 col-span-4">
            <div class="box overflow-hidden">
                <div class="box-header pb-0 justify-between">
                    <div class="box-title">
                        Credit Statistics
                    </div>
                </div>
                <div class="box-body py-4 px-3">
                    <div class="flex gap-4 mb-3">
                        <div class="avatar avatar-md bg-primary/10 !w-[3rem]">
                            <i class="ti ti-trending-up text-[1.25rem] text-primary"></i>
                        </div>
                        <div class="flex-auto flex items-start justify-between w-full flex-wrap">
                            <div>
                                <span class="text-[11px] mb-1 block font-medium">TOTAL CREDIT</span>
                                <div class="flex items-center justify-between">
                                    <h4 class="mb-0 flex items-center">3,736<span
                                            class="text-success text-xs ms-2 inline-flex items-center"><i
                                                class="ti ti-trending-up align-middle me-1"></i>0.57%</span>
                                    </h4>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="text-success text-xs decoration-solid">Credit
                                ?</a>
                        </div>
                    </div>
                    <div id="orders" class="my-2"></div>
                </div>
                <div class="box-footer border-t border-dashed">
                    <div class="grid">
                        <button
                            class="ti-btn ti-btn-outline-primary ti-btn-wave btn-wave font-medium waves-effect waves-light table-icon">Complete
                            Statistics<i class="ti ti-arrow-narrow-right ms-2 text-[16px] inline-block"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/js/sales-dashboard.js"></script>

    <div class="box overflow-hidden">
        <div class="box-header justify-between">
            <div class="box-title">Transaction Logs</div>
        </div>
        <div class="box-body p-0 relative" id="todo-content">
            <div>
                <div class="table-responsive">
                    <table class="ti-custom-table text-nowrap">
                        <thead>
                            <tr class="border-b !border-defaultborder dark:!border-defaultborder/10">
                                <th>
                                    <input class="form-check-input check-all" type="checkbox" id="all-tasks"
                                        value="" aria-label="...">
                                </th>
                                <th class="todolist-handle-drag">

                                </th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody id="todo-drag">

                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

 
 
    @include('pages.clients.forms.credits')
    <script>
        function credit_type(type) {
            document.getElementById('type').value = type;
            document.getElementById('client_type').value = 'client';
        }
    </script>

</x-app-layout> --}}
