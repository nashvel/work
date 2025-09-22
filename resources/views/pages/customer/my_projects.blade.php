<x-app-layout>
    <x-slot name="url_1">{"link": "/bid/projects", "text": "Manage Projects"}</x-slot>
    <x-slot name="active">My Projects</x-slot>
    <x-slot name="buttons"></x-slot>

    {{-- <a href="/project/list/register"
        class="ti-btn ti-btn-soft-success !text-default !rounded-full btn-wave waves-effect waves-light">
        <i class="bi bi-plus-circle me-1"></i>
        <span class="mx-1">New Project</span>
    </a> --}}

    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>Project Accepted</strong>
                    </h6>
                    <span>You can manage & add new projects here.</span>
                    <hr class="mb-3 mt-3">
                    @include('pages.customer.tables.projects')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
