<x-app-layout>

    <x-slot name="title">Register New Bidding</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage Projects"}</x-slot>
    <x-slot name="active">Projects</x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-body overflow-y-auto">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div>
                            <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                                <strong>Manage Projects</strong>
                            </h6>
                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                You can monitor your projects here.
                            </span>
                        </div>
                        <div class="inline-flex items-center gap-2">
                            <a href="/project/list/register"
                                class="inline-flex items-center gap-2 rounded-md border bg-white border-slate-300  px-3 py-2 text-sm font-medium text-slate-700 hover:bg-gray-500">
                                <i class="bi bi-plus-lg"></i> New Project
                            </a>
                        </div>
                    </div>
                    <hr class="mb-3 !mt-3">
                    @include('pages.apps.bids.tables.list')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
