@php

    // $lead = App\Models\Lead::where('email', Auth::user()->email)
    //     ->select('id')
    //     ->first();

    // if (Auth::user()->role == 'Virtual Assistant') {
    //     $clientId = Auth::user()->company;
    // } else {
    //     $clientId = $lead->id;
    // }

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

    $clients = App\Models\VirtualAssistant::select('*')
        //->where('company_id', $clientId)
        ->get()
        ->map(function ($client) {
            $user = App\Models\User::where('company', $client->company_id)->where('email', $client->email)->first();

            return [
                'name' => $client->first_name . ' ' . $client->last_name,
                'id' => $user->id,
                'position' => $client->position,
                'email' => $client->email,
                'phone' => $client->phone_no ?: 'N/A',
                'company' => $client->company ?: 'N/A',
                'location' => $client->location ?: 'N/A',
                'photo' => $user->profile_photo_path,
            ];
        });

@endphp
<script src="/assets/libs/gridjs/gridjs.umd.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const clients = @json($clients);

        // Ensure each row matches the correct column index
        const data = clients.map(client => [
            [client.name, client.position, client.photo ? `{{ asset('storage/') }}/${client.photo}` :
                "/user.png"
            ],
            [client.email, client.phone], // [1] Email & Phone
            [client.email, client.phone], // [1] Email & Phone
            client.id,
            [client.company, client.location], // [2] Company
            [client.remaining_credit, client.credit_total, client.percentage, client.progressClass,
                client.progressClassText
            ], // [3] Email
            client.id, // [4] ID for actions
            client.photo ? `{{ asset('storage/') }}/${client.photo}` : "/user.png",
        ]);

        console.log("Grid Data:", data); // Debugging

        new gridjs.Grid({
            columns: [{
                    name: "Virtual Assitant Information",
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
                                <span class="block font-medium text-[14px]">${cell[0]} (${cell[1]})</span>
                            </a>
                            <div class="hs-tooltip ti-main-tooltip">
                                <span class="block text-textmuted dark:text-textmuted/50 text-[11px]">
                                    <i class="bi bi-info-circle me-1 text-[13px] align-middle"></i>
                                    Virual Assitant
                                </span>
                            </div>
                        </div>                                    
                    </div>
                `)
                },
                {
                    name: "Email Address",
                    width: "180px",
                    formatter: (cell) => gridjs.html(`
                    <span class="block mb-1">
                        <i class="ri-mail-line me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                        ${cell[0]}
                    </span>
                `)
                }, {
                    name: "Phone Number",
                    width: "150px",
                    formatter: (cell) => gridjs.html(`
                     <span class="block mb-1">
                        <i class="ri-phone-line me-2 align-middle text-[14px] text-textmuted dark:text-textmuted/50 inline-block"></i>
                        ${cell[1]}
                    </span>
                `)
                },
                {
                    name: gridjs.html(`<center>Actions</center>`),
                    width: "60px",
                    formatter: (cell) => gridjs.html(`
                    <div class="btn-list">
                        <center>
                            <a href="/chat/${cell}" class="ti-btn ti-btn-sm ti-btn-soft-success ti-btn-iconx !mb-0">
                                <i class="bi bi-chat-dots"></i> Chat
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

{{-- <a href="/client/view/${cell}" class="ti-btn ti-btn-sm ti-btn-soft-primary ti-btn-icon !mb-0">
    <i class="ri-eye-line"></i>
</a>
<button class="ti-btn ti-btn-sm ti-btn-soft-info ti-btn-icon !mb-0">
    <i class="ri-pencil-line"></i>
</button>                            
<button class="ti-btn ti-btn-sm ti-btn-soft-danger ti-btn-icon contact-delete !mb-0" data-id="${cell}">
    <i class="ri-delete-bin-line"></i>
</button> --}}
