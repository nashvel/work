@php
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Contracts\Encryption\DecryptException;
    use App\Models\User;
@endphp
<x-app-layout>

    @php

    $info = User::find($id);

    @endphp

    <x-slot name="return">{"link": "/users/manage", "text": "back"}</x-slot>
    <x-slot name="url_1">{"link": "/users/manage", "text": "User Management"}</x-slot>
    <x-slot name="url_2">{"link": "/users/manage/{{ $id }}/details", "text": "{{ $info->name }}"}</x-slot>
    <x-slot name="active">Details</x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box shadow-none border">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>{{ $info->name }} – Profile Summary</strong>
                    </h6>
                    <hr class="!mt-3">
                    @if ($errors->any())
                        <div
                            class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                            <div>
                                <strong class="text-danger">Whoops! Something went wrong:</strong>
                                <ul class="list-disc list-inside mt-2 mx-4">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-dark"><i>{{ $error }}</i></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="sm:border-b-2 border-gray-200 dark:border-white/10">
                        <nav class="-mb-0.5 sm:flex sm:space-x-6 rtl:space-x-reverse" role="tablist">
                            @php
                                $tabs = [
                                    ['id' => 'icon-1', 'icon' => 'bi-info-circle', 'label' => 'Overview'],
                                    // ['id' => 'icon-credit', 'icon' => 'bi-wallet2', 'label' => 'Credits'],
                                    // ['id' => 'icon-va', 'icon' => 'bi-person-badge', 'label' => 'Virtual Assistant'],
                                    // ['id' => 'icon-browser', 'icon' => 'bi-pin-map-fill', 'label' => 'GPS Tracker'],
                                    // ['id' => 'icon-time-tracker', 'icon' => 'bi-clock', 'label' => 'Time Tracker'],
                                    // ['id' => 'icon-chats.old', 'icon' => 'bi-chat-dots', 'label' => 'Chats'],
                                    // ['id' => 'icon-payments', 'icon' => 'bi-coin', 'label' => 'Payments'],
                                    ['id' => 'icon-privilege', 'icon' => 'bi-gear', 'label' => 'Privilege'],
                                    // ['id' => 'icon-files', 'icon' => 'bi-folder', 'label' => 'File System'],
                                    // ['id' => 'icon-password', 'icon' => 'bi-unlock', 'label' => 'Change Password'],
                                    // ['id' => 'icon-activity', 'icon' => 'bi-activity', 'label' => 'Activity Logs'],
                                ];
                            @endphp

                            @foreach ($tabs as $index => $tab)
                                <a class="w-full sm:w-auto hs-tab-active:font-semibold hs-tab-active:border-primary hs-tab-active:text-primary py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50 hover:text-primary {{ $index === 0 ? 'active' : '' }}"
                                    href="javascript:void(0);" id="icon-item-{{ $index + 1 }}"
                                    data-hs-tab="#{{ $tab['id'] }}" aria-controls="{{ $tab['id'] }}">
                                    <span class="bi {{ $tab['icon'] }}"></span>
                                    {{ $tab['label'] }}
                                </a>
                            @endforeach


                        </nav>
                    </div>

                    <div class="mt-3">
                        @foreach ($tabs as $index => $tab)
                            <div id="{{ $tab['id'] }}" class="{{ $index === 0 ? '' : 'hidden' }}" role="tabpanel"
                                aria-labelledby="icon-item-{{ $index + 1 }}">
                                <div
                                    class="text-gray-500 dark:text-[#8c9097] dark:text-white/50 p-5 border rounded-sm dark:border-white/10 border-gray-200">
                                    @includeIf(
                                        'modules.users.partials.' .
                                            \Illuminate\Support\Str::slug($tab['label'], '_'))
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
