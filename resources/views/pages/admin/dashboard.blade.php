<x-app-layout>

    @php
    $lead = App\Models\Lead::where('email', Auth::user()->email)
        ->select('id')
        ->first();
    $id = $lead->id;

    $lead_profile = App\Models\Lead::where('id', $id)->first();

    $credit_total = App\Models\Credit::where('client_id', $id)->where('type', 'add')->sum('amount');
    $credit_charge = App\Models\Credit::where('client_id', $id)->where('type', 'charge')->sum('amount');

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

    <x-slot name="title"><h1 class="text-2xl">{{ $lead_profile->company_name }}</h1> </x-slot>
    <x-slot name="url_1">{"link": "/user/dashboard", "text": "Dashboard"}</x-slot>
    <x-slot name="active">{{ $lead_profile->company_name }}</x-slot>
    <x-slot name="buttons"> </x-slot>

   
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-3 col-span-12">
            <div class="box overflow-hidden main-content-card">
                <div class="box-body text-center p-5">
                    <center>
                        <img src="{{ asset('storage/' . $lead_profile->photo) }}" style="height: 110px" alt="" class="transparent-logo">
                        {{-- <p class="mt-2 mb-0"><span style="letter-spacing: 1px"><i>Welcome back! to {{ $lead_profile->company_name }}
                                </i></span></p> --}}
                    </center>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-9 col-span-12">
            <div class="grid grid-cols-12 gap-x-6">


                <div class="sm:col-span-6 xl:col-span-6 col-span-12">
                    <div class="box overflow-hidden main-content-card">
                        <div class="box-body">
                            <div class="flex items-start justify-between ">
                                <div>
                                    <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total
                                        Credit</span>
                                    <h4 class="font-medium mb-0">{{ number_format($remaining_credit, 0) }} /
                                        <b>{{ number_format($credit_total, 0) }}</b> hours
                                    </h4>
                                </div>

                            </div>
                            <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Remaining Credit
                                <span class="{{ $progressClassText }}">{{ number_format($percentage, 0) }}%</span>
                            </div>
                            <div class="progress progress-lg !rounded-full p-1 ms-auto bg-primary/10 mb-2 mt-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $progressClass }}"
                                    role="progressbar" style="width: {{ number_format($percentage, 0) }}%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-6 xl:col-span-3 col-span-12">
                    <div class="box overflow-hidden  main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-warning svg-white avatar-rounded">
                                <i class="bi bi-people text-[20px]"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">Total Clients</p>
                            @php
                                $client_count = App\Models\Clients::where('lead_id', 9)->count();
                            @endphp
                            <h4 class="font-semibold mb-1">{{ $client_count }}</h4>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-6 xl:col-span-3 col-span-12">
                    <div class="box overflow-hidden  main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-primarytint3color svg-white avatar-rounded">
                                <i class="bi bi-person-rolodex text-[20px]"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">Virtual Assistance</p>
                            <h4 class="font-semibold mb-1">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End::Row-1 -->

    <!-- Start::Row-2 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-3 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Upcoming Tasks
                    </div>
                    <div>
                        <button type="button" class="ti-btn ti-btn-sm ti-btn-light">View All</button>
                    </div>
                </div>
                <div class="box-body" style="min-height: 390px">
                    <hr class=" mb-4">
                    <p class="text-danger text-center">No Task Available Yet!</p>
                    <hr class="mt-4 mb-4">
                    {{-- @include('pages.clients.dashboard_task') --}}
                </div>
            </div>
        </div>
        <div class="xxl:col-span-9 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">Credit Overview as of <i>{{ date('D, F d, Y h:i A') }}</i></div>
                    <div class="flex gap-2">
                        <div class="ti-btn ti-btn-outline-light border ti-btn-full ti-btn-sm">Today</div>
                        <div class="ti-btn ti-btn-outline-light border ti-btn-full ti-btn-sm">Weakly</div>
                        <div class="ti-btn ti-btn-light border ti-btn-full ti-btn-sm">Yearly</div>
                    </div>
                </div>
                <div class="box-body">
                    <div id="earning"></div>
                </div>
            </div>
        </div>
       
    </div>


    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/js/courses-dashboard.js"></script>


</x-app-layout>
