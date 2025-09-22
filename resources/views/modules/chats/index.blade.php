<x-app-layout>

    <x-slot name="return">{"link": "/relationship/list", "text": "Manage"}</x-slot>
    <x-slot name="title">Chats</x-slot>
    <x-slot name="url_1">{"link": "/relationship/list", "text": "Chats"}</x-slot>
    <x-slot name="active">Messages</x-slot>
    <x-slot name="buttons"> </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box rounded-md shadow-none border"  style="background: linear-gradient(to bottom right, #fff, #ffffff, #F2F7FF);">
                <div class="box-body p-0">
                      @include('modules.chats.partials.messages')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
