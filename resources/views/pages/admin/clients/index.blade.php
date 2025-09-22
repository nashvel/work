<x-app-layout>

    <x-slot name="title">{{  Auth::user()->role === 'Virtual Assistant' ? 'Assigned Client Workspaces' : 'Client Workspaces' }} </x-slot>
    <x-slot name="url_1">{"link": "/hbcs/clients", "text": "Client"}</x-slot>
    <x-slot name="active">Workspaces</x-slot>
    <x-slot name="buttons">
        <button class="ti-btn text-white !border-0 btn-wave me-0 waves-effect waves-light" style="background-color: #2563eb" data-hs-overlay="#create-contact">
            <i class="bi bi-person-plus-fill me-1"></i>Register New Client
        </button>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the client workspace here.
                    <hr class="mb-3 mt-3">
                    <div class="custom-box">
                        @include('pages.members.tables.clients')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.admin.clients.modal')

    <br>

</x-app-layout>
