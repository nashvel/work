<x-app-layout>

    <x-slot name="title">Manage Virtual Assistant</x-slot>
    <x-slot name="url_1">{"link": "/virtual-assistant/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Virtual Assistant Information</x-slot>
    <x-slot name="buttons">
        @if (Auth::user()->role == 'Administrator')
            <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#create-va">
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
                        @include('pages.admin.virtual-assistant.list')
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('pages.admin.virtual-assistant.modal')

</x-app-layout>
