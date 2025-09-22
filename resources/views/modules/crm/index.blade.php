<x-app-layout>

    <x-slot name="title">Register New Bidding</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage Projects"}</x-slot>
    <x-slot name="active">Projects</x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            <div class="box shadow-none border custom-box">
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
                     <div class="sm:border-b-2 border-gray-200 dark:border-white/10">
                        <nav class="-mb-0.5 sm:flex sm:space-x-6 rtl:space-x-reverse" role="tablist">
                            @php
                                $tabs = [
                                    ['id' => 'icon-privilege', 'icon' => 'bi-calendar-event', 'label' => 'Calendar'],
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
                                        'modules.crm.partials.' .
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
