<x-app-layout>

    <x-slot name="title">Client Portal Automated Greetings</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Client Portal Greetings</x-slot>
    <x-slot name="buttons">
        <a href="{{ route('content.client.greetings.new') }}" class="ti-btn ti-btn-primary !border-0 btn-wave me-0">
            <i class="bi bi-plus-lg me-1"></i> New Greetings
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                       @include('pages.contents.greeting.tables.list_client')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
