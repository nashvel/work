<x-app-layout>

    <x-slot name="title">Manage Virtual Assistant</x-slot>
    <x-slot name="url_1">{"link": "/virtual-assistant/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Virtual Assistant Information</x-slot>
    <x-slot name="buttons">
        @if (Auth::user()->role == 'Administrator')
            <button class="ti-btn text-white !border-0 btn-wave me-0 waves-effect waves-light"  style="background-color: #2563eb" data-hs-overlay="#create-va">
                <i class="bi bi-person-plus-fill me-1"></i> Register New Virtual Assistant
            </button>
        @endif
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the virtual assistant here.
                    <hr class="mb-3 mt-3">
                    <div class="custom-box">
                    @include('pages.apps.va.list')
                </div>
                </div>
            </div>
        </div>
    </div>

    
    @include('pages.apps.va.modal')

</x-app-layout>
