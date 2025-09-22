<x-app-layout>

    <x-slot name="title">Manage Relationships</x-slot>
    <x-slot name="url_1">{"link": "/relationship/list", "text": "Manage Relationship"}</x-slot>
    <x-slot name="active">Relationship</x-slot>
    <x-slot name="buttons">
        <a href="/relationship/create"
            class="ti-btn text-dark ti-btn-light shadow-none rounded-lg btn-wave me-0">
            <i class="bi bi-plus-circle me-1"></i>
            <span class="mx-1">New Relationship</span>
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>Manage Relationships</strong>
                    </h6>
                    <span>You can manage & add new relationship here.</span>
                    <hr class="mb-3 mt-3">
                    <div class="custom-box">
                        @include('pages.relationships.tables.company')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
