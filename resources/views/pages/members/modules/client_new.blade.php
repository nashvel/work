<x-app-layout>

    <x-slot name="title">New Client Registration</x-slot>
    <x-slot name="url_1">{"link": "/contact/list", "text": "Relationship"}</x-slot>
    <x-slot name="url_2">{"link": "/client/list", "text": "Manage"}</x-slot>
    <x-slot name="url_3">{"link": "/contact/person/list/{{ $company_id }}", "text": "Contact"}</x-slot>
    <x-slot name="active">Registration</x-slot>
    <x-slot name="buttons">

    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                        @include('pages.clients.forms.new_client')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
