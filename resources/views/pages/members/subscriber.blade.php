<x-app-layout>

    @php
        $user = Auth::user();

        $clientId = null;
        $user_id = $user->id;

        $clientId = App\Models\Clients::where('email', $user->email)->value('lead_id');

        $id = $clientId;

        $lead_profile = App\Models\Lead::where('id', $id)->first();

        $client_profile = App\Models\ContactPerson::where('user_id', $user_id)->first();
        $company_profile = App\Models\Contact::where('id', $client_profile->company_id)->first();

        $credit_total = App\Models\Credit::where('client_id', $user_id)->where('type', 'add')->sum('amount');
        $credit_charge = App\Models\Credit::where('client_id', $user_id)->where('type', 'charge')->sum('amount');

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

    <x-slot name="title">
        <h1 class="text-2xl">Welcome back! {{ $user->name ?? '' }} 
        </h1>
    </x-slot>
    <x-slot name="url_1">{"link": "/user/dashboard", "text": "Dashboard"}</x-slot>
    <x-slot name="active">{{ $user->name ?? '' }} </x-slot>
    <x-slot name="buttons">
        <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#purchase">
            <i class="bi bi-cart-plus-fill me-1"></i> Purchase VA Credit Hours
        </button>
    </x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-3 col-span-12">
            {{-- <div class="box overflow-hidden main-content-card">
                <div class="box-body text-center p-5">
                    <center>
                        <img src="{{ asset('storage/' . $lead_profile->photo) }}" style="height: 110px" alt=""
                            class="transparent-logo">
                    </center>
                </div>
            </div> --}}
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Your Credit Requests
                    </div>
                    <div>
                        <button type="button" class="ti-btn ti-btn-sm ti-btn-light">View All</button>
                    </div>
                </div>
                <div class="box-body bg-white p-4 rounded-lg shadow-sm" style="min-height: 705px;">
                    <hr class="mb-6">
                    @php
                        $requests = App\Models\RequestCredit::where('user_id', Auth::id())->latest()->limit(3)->get();
                    @endphp

                    @if ($requests->isEmpty())
                        <p class="text-center text-gray-500">You have no previous credit requests.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($requests as $request)
                                <div class="p-4 bg-gray-50 border rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <p class="font-semibold text-md">Requested Hours: <span
                                                class="text-blue-500">{{ number_format($request->requested_hours, 0) }}
                                                hrs</span></p>
                                        <span class="text-sm text-gray-500">{{ ucfirst($request->status) }}</span>
                                    </div>
                                    <p class="mt-2 text-xs text-gray-600">Reason:
                                        {{ $request->reason ?? 'No reason provided' }}</p>
                                    <div class="text-xs text-gray-400 mt-2">
                                        Requested on: {{ $request->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <div class="xxl:col-span-9 col-span-12">
            <div class="grid grid-cols-12 gap-x-6">
                <div class="sm:col-span-6 xl:col-span-3 col-span-12">
                    <div class="box overflow-hidden  main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-primary svg-white avatar-rounded">
                                <i class="bi bi-people text-[20px]"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">Total Relationship</p>
                            @php
                                $client_count = App\Models\Clients::where('lead_id', $user_id)->count();
                            @endphp
                            <h4 class="font-semibold mb-1">{{ $client_count }}</h4>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-6 xl:col-span-3 col-span-12">
                    <div class="box overflow-hidden  main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-primarytint3color svg-white avatar-rounded">
                                <i class="bi bi-hammer text-[20px]"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">Total Projects</p>
                            @php
                                $project_count = App\Models\ProjectBidding::where('client_id', $user_id)->count();
                            @endphp
                            <h4 class="font-semibold mb-1">{{ $project_count }}</h4>
                        </div>
                    </div>
                </div>
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
                <div class="xxl:col-span-12 col-span-12">
                    <div class="box">
                        <hr class="mt-3 mb-3">
                        <div
                            class="flex gap-5 items-center p-4 justify-around bg-light mx-2 flex-wrap flex-xl-nowrap rounded-md">

                            <div class="flex gap-4 items-center flex-wrap">
                                <div
                                    class="avatar avatar-lg flex-shrink-0 bg-primary/10 avatar-rounded svg-primary shadow-sm border border-primary border-opacity-25">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M184,89.57V84c0-25.08-37.83-44-88-44S8,58.92,8,84v40c0,20.89,26.25,37.49,64,42.46V172c0,25.08,37.83,44,88,44s88-18.92,88-44V132C248,111.3,222.58,94.68,184,89.57ZM232,132c0,13.22-30.79,28-72,28-3.73,0-7.43-.13-11.08-.37C170.49,151.77,184,139,184,124V105.74C213.87,110.19,232,122.27,232,132ZM72,150.25V126.46A183.74,183.74,0,0,0,96,128a183.74,183.74,0,0,0,24-1.54v23.79A163,163,0,0,1,96,152,163,163,0,0,1,72,150.25Zm96-40.32V124c0,8.39-12.41,17.4-32,22.87V123.5C148.91,120.37,159.84,115.71,168,109.93ZM96,56c41.21,0,72,14.78,72,28s-30.79,28-72,28S24,97.22,24,84,54.79,56,96,56ZM24,124V109.93c8.16,5.78,19.09,10.44,32,13.57v23.37C36.41,141.4,24,132.39,24,124Zm64,48v-4.17c2.63.1,5.29.17,8,.17,3.88,0,7.67-.13,11.39-.35A121.92,121.92,0,0,0,120,171.41v23.46C100.41,189.4,88,180.39,88,172Zm48,26.25V174.4a179.48,179.48,0,0,0,24,1.6,183.74,183.74,0,0,0,24-1.54v23.79a165.45,165.45,0,0,1-48,0Zm64-3.38V171.5c12.91-3.13,23.84-7.79,32-13.57V172C232,180.39,219.59,189.4,200,194.87Z">
                                        </path>
                                    </svg>
                                </div>
                                <div> <span class="mb-1 block">Total Revenue</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">$0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4 items-center flex-wrap">
                                <div
                                    class="avatar avatar-lg flex-shrink-0 bg-successtint1color/10 avatar-rounded svg-successtint1color shadow-sm border border-success border-opacity-25">
                                    <span class="bi bi-cash text-2xl text-success"></span>
                                </div>
                                <div> <span class="mb-1 block">Total Income</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">$0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4 items-center flex-wrap">
                                <div
                                    class="avatar avatar-lg flex-shrink-0 bg-dangertint1color/10 avatar-rounded svg-dangertint1color shadow-sm border border-danger border-opacity-25">
                                    <span class="bi bi-wallet2 text-2xl text-danger"></span>
                                </div>
                                <div> <span class="mb-1 block">Total Expense</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">$0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-4 items-center flex-wrap">
                                <div
                                    class="avatar avatar-lg flex-shrink-0 bg-primarytint1color/10 avatar-rounded svg-primarytint1color shadow-sm border border-primarytint1color border-opacity-25">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M230.91,172A8,8,0,0,1,228,182.91l-96,56a8,8,0,0,1-8.06,0l-96-56A8,8,0,0,1,36,169.09l92,53.65,92-53.65A8,8,0,0,1,230.91,172ZM220,121.09l-92,53.65L36,121.09A8,8,0,0,0,28,134.91l96,56a8,8,0,0,0,8.06,0l96-56A8,8,0,1,0,220,121.09ZM24,80a8,8,0,0,1,4-6.91l96-56a8,8,0,0,1,8.06,0l96,56a8,8,0,0,1,0,13.82l-96,56a8,8,0,0,1-8.06,0l-96-56A8,8,0,0,1,24,80Zm23.88,0L128,126.74,208.12,80,128,33.26Z">
                                        </path>
                                    </svg>
                                </div>
                                @php
                                    $prj = App\Models\V2_ProfitTracker::where('user_id', $id)
                                        ->select(DB::raw('COUNT(DISTINCT row_index) as count'))
                                        ->value('count');
                                @endphp

                                <div> <span class="mb-1 block">Total Projects</span>
                                    <div class="flex align-items-end gap-2">
                                        <h4 class="mb-0">{{ number_format($prj, 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-3 mb-3">
                        <div class="box-header justify-between">
                            <div class="box-title">Profit Tracker Overview as of <i>{{ date('D, F d, Y h:i A') }}</i>
                            </div>
                            <div class="flex gap-2">
                                <div class="ti-btn ti-btn-outline-light border ti-btn-full ti-btn-sm">Today</div>
                                <div class="ti-btn ti-btn-outline-light border ti-btn-full ti-btn-sm">Weekly</div>
                                <div class="ti-btn ti-btn-light border ti-btn-full ti-btn-sm">Yearly</div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id="earning"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End::Row-1 -->

        <!-- Start::Row-2 -->
        {{-- <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-3 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Your Credit Requests
                    </div>
                    <div>
                        <button type="button" class="ti-btn ti-btn-sm ti-btn-light">View All</button>
                    </div>
                </div>
                <div class="box-body bg-white p-4 rounded-lg shadow-sm" style="min-height: 390px;">
                    <hr class="mb-6">
                    @php
                        $requests = App\Models\RequestCredit::where('user_id', Auth::id())->latest()->limit(3)->get();
                    @endphp
                
                    @if ($requests->isEmpty())
                        <p class="text-center text-gray-500">You have no previous credit requests.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($requests as $request)
                                <div class="p-4 bg-gray-50 border rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <p class="font-semibold text-md">Requested Hours: <span class="text-blue-500">{{ number_format( $request->requested_hours, 0) }} hrs</span></p>
                                        <span class="text-sm text-gray-500">{{ ucfirst($request->status) }}</span>
                                    </div>
                                    <p class="mt-2 text-xs text-gray-600">Reason: {{ $request->reason ?? 'No reason provided' }}</p>
                                    <div class="text-xs text-gray-400 mt-2">
                                        Requested on: {{ $request->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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

    </div> --}}

        <div id="purchase-credit" class="hs-overlay ti-modal pointer-events-none hidden mt-6">
            <div class="hs-overlay ti-modal-box mt-0 lg:!max-w-4xl lg:w-full m-3  items-center justify-center">
                <div class="max-h-full w-full overflow-hidden ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="form-header">
                            Purchase Credit Hours
                        </h6>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                            data-hs-overlay="#purchase-credit">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>

                    <div class="ti-modal-body">


                        @if (session('success'))
                            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('request.credit.store') }}" method="POST" class="">
                            @csrf
                            <div>
                                <label for="requested_hours" class="block text-md  mb-2">Requested Hours</label>
                                <input type="number" name="requested_hours" id="requested_hours"
                                    class="w-full border p-2 rounded" required min="1"
                                    placeholder="Enter number of hours">
                            </div>

                            <div>
                                <label for="reason" class="block text-md mt-3 mb-2">Reason</label>
                                <textarea name="reason" id="reason" rows="4" class="w-full border p-2 rounded"
                                    placeholder="Enter your reason"></textarea>
                            </div>
                            <br>
                            <center>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit
                                    Request</button>
                            </center>
                        </form>

                    </div>
                </div>
            </div>

            @include('pages.members.payment.modal')

            <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
            <script src="/assets/js/courses-dashboard.js"></script>

        </div>
    </div>
</x-app-layout>
