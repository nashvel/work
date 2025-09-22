<x-app-layout>

    <x-slot name="title">Manage Customer Relationship Engagement</x-slot>
    <x-slot name="url_1">{"link": "/sales/relationship/list", "text": "Customer Relationship Engagement"}</x-slot>
    <x-slot name="active">Engagements</x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>Customer Relationship Engagement</strong>
                    </h6>
                    <span>You can monitor your customer relationship engagement here.</span>
                    <hr class="mb-3 !mt-3">
                    <div class="custom-box">
                        @include('pages.members.tables.sales')
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
