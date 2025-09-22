<x-app-layout>

    <x-slot name="title">Task Details</x-slot>
    <x-slot name="url_1">{"link": "/", "text": "Manage"}</x-slot>
    <x-slot name="active">Manage</x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                        @include('pages.apps.tasks.forms.edit');
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
