<x-app-layout>

    <x-slot name="title">Manage Relationships</x-slot>
    <x-slot name="url_1">{"link": "/relationship/list", "text": "Relationship"}</x-slot>
    <x-slot name="url_2">{"link": "/relationship/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Company</x-slot>
    <x-slot name="buttons">
        <a href="/relationship/create" class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0">
            <i class="bi bi-plus-lg me-1"></i>
            <span class="mx-1">Register Company</span>
        </a>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

    <link rel="stylesheet" href="/assets/libs/shepherd.js/css/shepherd.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> <span id="step-1">You can manage the relationship here.</span>
                    <hr class="mb-3 mt-3">
                    {{-- @include('pages.contacts.tables.company') --}}


                    <b id="step-2">xxxxxxxxxx</b>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
