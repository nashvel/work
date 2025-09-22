<x-app-layout>

    <x-slot name="title">Manage Clients</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Clients</x-slot>
    <x-slot name="buttons">
        {{-- <a href="/client/new" class="ti-btn ti-btn-primary !border-0 btn-wave me-0" data-hs-overlay="#modal_default">
            <i class="bi bi-person-plus-fill me-1"></i> New Client
        </a> --}}
    </x-slot>

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

        @php

            $lead = App\Models\Lead::where('email', Auth::user()->email)
                ->select('id')
                ->first();

            if (Auth::user()->role == 'Virtual Assistant') {
                $clientId = Auth::user()->company;
            } else {
                $clientId = $lead->id;
            }

            $clients = App\Models\Clients::select(
                'id',
                'first_name',
                'last_name',
                'email',
                'phone',
                'position',
                'location',
                'created_at',
                'photo',
                'company_id',
            )
                ->where('lead_id', $clientId)
                ->get()
                ->map(function ($client) {
                    $credit_total = App\Models\Credit::where('client_id', $client->id)
                        ->where('type', 'add')
                        ->sum('amount');

                    $credit_charge = App\Models\Credit::where('client_id', $client->id)
                        ->where('type', 'charge')
                        ->sum('amount');

                    $remaining_credit = $credit_total - $credit_charge;
                    $percentage = $credit_total > 0 ? ($remaining_credit / $credit_total) * 100 : 0;

                    // Determine progress bar color
                    $progressClass = 'bg-success'; // Default
                    $progressClassText = 'text-success'; // Default

                    if ($percentage < 20) {
                        $progressClass = 'bg-danger';
                        $progressClassText = 'text-danger';
                    } elseif ($percentage >= 20 && $percentage <= 60) {
                        $progressClass = 'bg-primary';
                        $progressClassText = 'text-primary';
                    }

                    $user = App\Models\User::where('email', $client->email)->first();

                    $company = App\Models\Contact::where('id', $client->company_id)->first();

                    return [
                        'name' => $client->first_name . ' ' . $client->last_name,
                        'id' => $user->id,
                        'created_at' => $client->created_at->format('M d, Y - h:i A'),
                        'email' => $client->email,
                        'phone' => $client->phone ?: 'N/A',
                        'position' => $client->position ?: 'N/A',
                        'location' => $client->location ?: 'N/A',
                        'photo' => $client->photo,
                        'company' => $company->company_name ?? 'N/A',
                        'company_address' => ($company->city_zip_code ?? 'N/A') . ', ' . ($company->state ?? 'N/A'),

                        // Credit Data
                        'credit_total' => number_format($credit_total, 0),
                        'credit_charge' => $credit_charge,
                        'remaining_credit' => number_format($remaining_credit, 0),
                        'percentage' => number_format($percentage, 0),
                        'progressClass' => $progressClass,
                        'progressClassText' => $progressClassText,
                    ];
                });

        @endphp
        @php

        @endphp
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
                        "/user.png", client.location
                    ],
                    [client.email, client.phone], // [1] Email & Phone
                    [client.company, client.position], // [2] Company
                    [client.remaining_credit, client.credit_total, client.percentage, client.progressClass,
                        client.progressClassText
                    ], // [3] Email
                    client.id, // [4] ID for actions
                    client.photo ? `{{ asset('storage/') }}/${client.photo}` : "/user.png",

                ]);

                new gridjs.Grid({
                    columns: [{
                            name: "Contact Information",
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
                                                <i class="bi me-1 bi-pin-map align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                                                ${cell[3]}
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
                            name: "Email / Phone",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1">
                                    <i class="ri-building-line me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                                    ${cell[0]}
                                </span>
                                    <span class="block mb-1">
                                    <i class="bi bi-info-circle me-2 text-[13px] align-middle"></i>
                                    ${cell[1]}
                                </span>
                            `)
                        },
                        {
                            name: "Status",
                            width: "100px",
                            formatter: (cell) => gridjs.html(`
                                <div style="margin-top: 6px;">
                                        <center>
                                    <span class="badge leading-none bg-primary/10 text-primary w-full !mb-0">
                                            <i class="bi bi-check text-[18px] "></i>
                                            Active
                                    </span>
                                        </center>
                                </div>
                            `)
                        },
                        {
                            name: gridjs.html(`<div style="text-align:center;">Actions</div>`),
                            width: "190px",
                            formatter: (cell) => gridjs.html(`
                                <div class="btn-list">
                                    <center>
                                        <a href="/chat/${cell}" class="ti-btn ti-btn-sm ti-btn-soft-success !mb-0">
                                            <i class="bi bi-chat-dots"></i>
                                            Chat
                                        </a>
                                        <a href="/client/view/${cell}" class="ti-btn ti-btn-sm ti-btn-soft-info !mb-0">
                                            <i class="ri-eye-line"></i>
                                            View
                                        </a>
                                        <button class="ti-btn ti-btn-sm ti-btn-soft-warning !mb-0">
                                            <i class="ri-pencil-line"></i>
                                            Edit
                                        </button>
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
