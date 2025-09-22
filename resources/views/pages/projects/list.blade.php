<x-app-layout>

    <x-slot name="title">Manage Projects</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Projects"}</x-slot>
    <x-slot name="active">List</x-slot>
    <x-slot name="buttons">
        <a href="/bid/create" class="ti-btn ti-btn-primary !border-0 btn-wave me-0" data-hs-overlay="#modal_default">
            <i class="bi bi-plus-lg me-1"></i> New Projects
        </a>
    </x-slot>



    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body overflow-y-auto">
                        <button
                            class="ti-btn !m-0 ti-btn-light btn-w-md flex items-center justify-center btn-wave waves-light"
                            data-hs-overlay="#create-folder">
                            <i class="bi bi-folder-plus align-middle"></i>Create Folder
                        </button>
                    </div>
                </div>
            </div>
        </div>
<!-- ✅ Button to Open Modal -->


<!-- ✅ JavaScript to Ensure Modal Works -->

    </div>
    {{-- <script src="/assets/libs/gridjs/gridjs.umd.js"></script>
        @php
            if (Auth::user()->role == 'Virtual Assistant') {
                $clientId = Auth::user()->company;
            } elseif (Auth::user()->role == 'Sub-Client') {
                $client = App\Models\Clients::where('email', Auth::user()->email)->first();
                $clientId = $client->id;
            } else {
                $lead = App\Models\Lead::where('email', Auth::user()->email)
                    ->select('id')
                    ->first();
                $clientId = $lead->id;
            }

            //$client_info = App\Models\Lead::where('email', Auth::user()->email)->first();

        @endphp
        @php
            $biddings = App\Models\ProjectBidding::where('client_id', $clientId)
                ->get()
                ->map(function ($proj) {
                    return [
                        'id' => $proj->id,
                        'code' => $proj->proj_code,
                        'name' => $proj->proj_name,
                        'due' => date('D, F d, Y'),
                        'stage' => $proj->proj_stages,
                        'bidders' => count($proj->proj_bidders ?? []),
                        'scopes' => count($proj->stage_descriptions ?? []),
                        'invited' => count($proj->invite_clients ?? []),
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
                    bid.bidders ?? 0,
                    bid.scopes ?? 0,
                    bid.invited ?? 0,
                    0,
                    bid.id
                ]);

                console.log("Grid Data:", data); // Debugging

                new gridjs.Grid({
                    columns: [{
                            name: "Code",
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
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Stages",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    ${cell}
                                </span>
                            `)
                        },
                        {
                            name: "Bidders",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    <i class="bi bi-people me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                                   <a href="#" class="text-primary">${cell}</a>
                                </span>
                            `)
                        },
                        {
                            name: "Scopes",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                     <i class="bi bi-stickies me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                                    <a href="#" class="text-primary">${cell}</a>
                                </span>
                            `)
                        },
                        {
                            name: "Invited",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    <i class="ri-mail-line me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                                   <button class="text-primary" data-hs-overlay="#view-list">${cell}</button>
                                </span>
                            `)
                        }, ,
                        {
                            name: "Clients",
                            formatter: (cell) => gridjs.html(`
                                <span class="block mb-1 p-0">
                                    <i class="bi bi-person-check-fill me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                                   <a href="#" class="text-primary">${cell}</a>
                                </span>
                            `)
                        },
                        {
                            name: "Actions",
                            width: "130px",
                            formatter: (cell) => gridjs.html(`
                                <div class="btn-list p-0">
                                    <center>
                                        <a href="/bid/details/${cell}" class="ti-btn ti-btn-sm ti-btn-soft-primary ti-btn-icon !mb-0">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <button class="ti-btn ti-btn-sm ti-btn-soft-info ti-btn-icon !mb-0">
                                            <i class="ri-pencil-line"></i>
                                        </button>                            
                                        <button class="ti-btn ti-btn-sm ti-btn-soft-danger ti-btn-icon contact-delete !mb-0" data-id="${cell}">
                                            <i class="ri-delete-bin-line"></i>
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

    </div> --}}

</x-app-layout>
