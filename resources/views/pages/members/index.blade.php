<x-app-layout>

    <x-slot name="title">Manage Clients</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Manage Clients"}</x-slot>
    <x-slot name="active">List of Clients</x-slot>
    <x-slot name="buttons"> </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>Client Information</strong>
                    </h6>
                    <span>You can modify the client details here.</span>
                    <hr class="mb-3 !mt-3">
                    <div class="custom-box">
                        @include('pages.members.tables.sub-client')
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
