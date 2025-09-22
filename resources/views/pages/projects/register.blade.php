<x-app-layout>
    <x-slot name="title">Register New Bidding</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Bidding"}</x-slot>
    <x-slot name="active">New Bidding</x-slot>
    <x-slot name="buttons">

    </x-slot>

    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    @include('pages.projects.forms.create')
                </div>
            </div>
        </div>
    </div>

    @include('pages.projects.partials.contacts')

</x-app-layout>