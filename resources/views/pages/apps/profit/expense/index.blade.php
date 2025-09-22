<x-app-layout>

    <x-slot name="title">Manage Expense</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Expense"}</x-slot>
    <x-slot name="active">Expense</x-slot>
    <x-slot name="buttons">
        <a href="/profit-tracker/expense/list/create" class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0">
            <i class="bi bi-folder-plus align-middle"></i>New Expense
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-2">
            <div class="box justify-between">
                <div class="box-body overflow-y-auto" id="discussion-container" style="min-height: 530px">
                    <center>
                        <br>
                        <i class="pt-6 text-danger">No Available Features Yet!</i>
                    </center>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
