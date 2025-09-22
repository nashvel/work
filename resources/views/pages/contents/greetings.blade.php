<x-app-layout>

    <x-slot name="title">Automated Greetings</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Greetings</x-slot>
    <x-slot name="buttons">
        <a href="{{ route('content.contact.greetings.new') }}" class="ti-btn ti-btn-primary !border-0 btn-wave me-0">
            <i class="bi bi-plus-lg me-1"></i> New Greetings
        </a>
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
    </div>

    @php
        $data = App\Models\WelcomeMessage::join('leads', 'leads.id', '=', 'welcome_messages.client_id')
            ->select('welcome_messages.id', 'leads.id as client_id', 'leads.company_name', 'welcome_messages.client_id as i') // Select necessary fields
            ->get()
            ->map(function ($rw) {
                return [
                    'id' => $rw->id,
                    'client_id' => $rw->i,
                    'company' => $rw->company_name,
                ];
            });
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

            const result = @json($data);

            const data = result.map(resp => [
                resp.company ,
                resp.id,
                resp.client_id,
            ]);

            new gridjs.Grid({
                columns: [{
                        name: "Company Name",
                        formatter: (cell) => gridjs.html(`
                        <span class="block mb-1">
                                <i class="bi bi-info-circle text-[18px] px-2"></i> ${cell}
                        </span>
                    `)
                    },
                    {
                        name: "Actions",
                        width: "140px",
                        formatter: (cell) => gridjs.html(`
                        <div class="btn-list">
                            <center>
                                <a href="/content/client/greetings/${cell}/edit" class="ti-btn ti-btn-sm ti-btn-light border-gray-300 !mb-0">
                                    <i class="ri-eye-line"></i> Preview & Update 
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



</x-app-layout>
