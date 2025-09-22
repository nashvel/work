<x-app-layout>

    <x-slot name="title">Manage Clients</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Clients</x-slot>
    <x-slot name="buttons">
        <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#create-contact">
            <i class="bi bi-person-plus-fill me-1"></i>Register New Client
        </button>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the relationship here.
                    <hr class="mb-3 mt-3">
                    @include('pages.clients.table.clients')
                </div>
            </div>
        </div>
    </div>

    @include('pages.clients.modal')

</x-app-layout>


{{-- <x-app-layout>

    <x-slot name="title">Manage Clients</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Clients</x-slot>
    <x-slot name="buttons">
        <button class="ti-btn ti-btn-primary !border-0 btn-wave me-0" data-hs-overlay="#create-contact">
            <i class="bi bi-person-plus-fill me-1"></i> New Client
        </button>
    </x-slot>

    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xl:col-span-12 col-span-12">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Whoops! Something went wrong.</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <hr>
            @endif
        </div>

        @foreach ($leads as $lead)
            <div class="xl:col-span-3 col-span-12">
                <div class="box overflow-hidden border border-defaultborder dark:border-defaultborder/10">
                    <div class="box-body border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                        <div class="text-center">

                            <center>
                                <img src="{{ $lead->photo ? asset('storage/' . $lead->photo) : './assets/images/faces/' . rand(1, 16) . '.jpg' }}"
                                    style="max-height: 120px" class="mb-3">
                            </center>
                            <h5 class="font-semibold mb-1">{{ $lead->company_name }}</h5> <span
                                class="block font-medium text-textmuted dark:text-textmuted/50 mb-2">{{ $lead->email }}</span>
                            <p class="text-xs mb-0 text-textmuted dark:text-textmuted/50">
                                <span class="me-3"><i
                                        class="ri-phone-line me-1 align-middle"></i>{{ $lead->phone }}</span>
                            </p>
                        </div>
                    </div>
                    @php
                        $client_count = App\Models\Clients::where('lead_id', $lead->id)->count();
                    @endphp
                    <div
                        class="flex mb-0 flex-wrap gap-4 p-4 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                        <div class="border-dashed rounded text-center flex-auto">
                            <div class="main-card-icon mb-2 primary1">
                                <div class="avatar avatar-sm bg-primarytint1color"> <i
                                        class="text-[15px] ti ti-user-check"></i> </div>
                            </div>
                            <div class="flex gap-2 justify-center items-end">
                                <p class="font-semibold text-xl mb-0">0</p>
                            </div>
                            <p class="mb-1 text-textmuted dark:text-textmuted/50">Virual Assistant</p>
                        </div>
                        <div class="border-dashed rounded text-center flex-auto">
                            <div class="main-card-icon mb-2 secondary">
                                <div class="avatar avatar-sm bg-warning">
                                    <i class="bi bi-people text-[15px]"></i>
                                </div>
                            </div>
                            <div class="flex gap-2 justify-center items-end">
                                <p class="font-semibold text-xl mb-0">{{ $client_count }}</p>
                            </div>
                            <p class="mb-1 text-textmuted dark:text-textmuted/50">Clients</p>
                        </div>
                    </div>
                    <div class="box-body border-b border-dashed border-defaultborder dark:border-defaultborder/10 p-0">
                        <ul class="ti-list-group list-group-flush !border-0">
                            <li class="ti-list-group-item pt-2 border-0">
                                <div><span class="font-medium me-2">Contact Person :</span><span
                                        class="text-textmuted dark:text-textmuted/50">{{ $lead->contact_name }}</span>
                                </div>
                            </li>
                            <li class="ti-list-group-item pt-2 border-0">
                                <div><span class="font-medium me-2">Created At :</span><span
                                        class="text-textmuted dark:text-textmuted/50">
                                        {{ date_format($lead->updated_at, 'D, M. d, Y - h:i A') }}</span></div>
                            </li>
                        </ul>
                    </div>
                    @php

                        $credit_total = App\Models\Credit::where('client_id', $lead->id)
                            ->where('client_type', 'client')
                            ->where('type', 'add')
                            ->sum('amount');
                        $credit_charge = App\Models\Credit::where('client_id', $lead->id)
                            ->where('client_type', 'client')
                            ->where('type', 'charge')
                            ->sum('amount');

                        $remaining_credit = $credit_total - $credit_charge;
                        $percentage = $credit_total > 0 ? ($remaining_credit / $credit_total) * 100 : 0;

                        $progressClass = 'bg-success'; // Default
                        $progressClassText = 'text-success'; // Default

                        if ($percentage < 20) {
                            $progressClass = 'bg-danger';
                            $progressClassText = 'text-danger';
                        } elseif ($percentage >= 20 && $percentage <= 60) {
                            $progressClass = 'bg-primary';
                            $progressClassText = 'text-primary';
                        }
                    @endphp

                    <div class="p-4 pb-1 flex flex-wrap justify-between">
                        <div class="font-medium text-[15px] text-primarytint1color"> Credits : </div> <a
                            href="javascript:void(0);" class="text-xs text-textmuted dark:text-textmuted/50">
                            <span class="{{ $progressClassText }}">{{ number_format($percentage, 0) }}%</span></a>
                    </div>
                    <div
                        class="flex mb-0 flex-wrap gap-4 p-4 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                        <div class="flex mb-1">
                            <span>Hours</span>&ensp;
                            <span class="ms-auto text-[12px]">( {{ number_format($remaining_credit, 0) }} /
                                <b>{{ number_format($credit_total, 0) }} )</b></span>

                        </div>
                        <div class="progress progress-md p-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated {{ $progressClass }}"
                                role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-wrap justify-between">
                        <a href="/client/details/{{ $lead->id }}"
                            class="ti-btn ti-btn-outline-light !border-1 btn-wave me-0 w-full">
                            <i class="bi bi-eye me-1"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--End::row-1 -->

    <!-- Start:: Create Contact -->
    @include('pages.clients.modal')
    <!-- End:: Create Contact -->

</x-app-layout> --}}
