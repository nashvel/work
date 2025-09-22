<x-app-layout>
    <x-slot name="title">Client Information</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Client"}</x-slot>
    <x-slot name="active">Details</x-slot>
    <x-slot name="buttons">
    </x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box profile-card">
                <div class="profile-banner-imgx">
                    <img src="/banner.png?{{ time() }}" class="card-img-bottom" alt="...">
                </div>
                <div class="box-body pb-0 relative">
                    <div class="grid grid-cols-12 sm:gap-x-6 profile-content">
                        <div class="xl:col-span-3 col-span-12">

                            @php
                                $client = App\Models\Clients::where('user_id', Auth::user()->id)
                                    ->select('id')
                                    ->first();
                                $id = $client->id;

                                $credit_total = App\Models\Credit::where('client_id', $id)
                                    ->where('type', 'add')
                                    ->sum('amount');
                                $credit_charge = App\Models\Credit::where('client_id', $id)
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
                            <div class="box overflow-hidden main-content-card">
                                <div class="box-body">
                                    <div class="flex items-start justify-between ">
                                        <div>
                                            <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total
                                                Credit</span>
                                            <h4 class="font-medium mb-0">
                                                {{ number_format($remaining_credit, 0) }} /
                                                <b>{{ number_format($credit_total, 0) }}</b> hours

                                            </h4>
                                        </div>
                                        <div class="leading-none mt-4">
                                            <span class="avatar avatar-md avatar-rounded bg-primary">
                                                <i class="ti ti-clock text-[1.25rem]"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-textmuted dark:text-textmuted/50 text-[13px]">
                                        Remaining Credit <span
                                            class="{{ $progressClassText }}">{{ number_format($percentage, 0) }}%</span>
                                    </div>

                                    <div class="progress progress-lg p-1 mt-3">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $progressClass }}"
                                            role="progressbar" style="width: {{ $percentage }}%;"
                                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="box overflow-hidden main-content-card" style="border: 1px solid #ECF3FB">
                                <div
                                    class="box-body border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                                    <div class="text-center">
                                        <span class="avatar avatar-xxl avatar-rounded online mb-3">
                                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                                onerror="this.src='/user.png'" alt="">
                                        </span>
                                        <h5 class="font-semibold mb-1">{{ Auth::user()->name }}</h5>
                                        @php
                                            $info = App\Models\Clients::where('user_id', Auth::user()->id)->first();
                                        @endphp
                                        <span
                                            class="block font-medium text-textmuted dark:text-textmuted/50 ">{{ Auth::user()->email }}</span>
                                        {{-- <p class="text-xs mb-0 text-textmuted dark:text-textmuted/50"> <span
                                                class="me-3"><i
                                                    class="ri-building-line me-1 align-middle"></i>{{ $info->company_name }}</span>
                                            <br>
                                            <span><i
                                                    class="ri-map-pin-line me-1 align-middle"></i>{{ $info->type }}</span> --}}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex mb-0 flex-wrap gap-4 p-4 border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                                    <div class="border-dashed rounded text-center flex-auto">
                                        <span
                                            class="avatar avatar-md avatar-rounded me-1 bg-primarytint1color/10 !text-primarytint1color"><i
                                                class="ri-calendar-event-line text-lg leading-none align-middle"></i></span>
                                        <div>
                                            <div class="font-medium mb-0 task-title">
                                                Contract Start Date
                                            </div>
                                            <span class="text-xs text-textmuted dark:text-textmuted/50">Tue, 28
                                                January,
                                                2025</span>
                                        </div>
                                    </div>
                                    <div class="border-dashed rounded text-center flex-auto">
                                        <span
                                            class="avatar avatar-md avatar-rounded me-1 bg-primarytint2color/10 !text-primarytint2color"><i
                                                class="ri-time-line text-lg leading-none align-middle"></i></span>
                                        <div>
                                            <div class="font-medium mb-0 task-title">
                                                Contract End Date
                                            </div>
                                            <span class="text-xs text-textmuted dark:text-textmuted/50">Fri, 30
                                                October, 2026</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 pb-1 flex flex-wrap justify-between">
                                    <div class="font-medium text-[15px] text-primarytint1color">
                                        Basic Info :
                                    </div>
                                </div>
                                <div
                                    class="box-body border-b border-dashed border-defaultborder dark:border-defaultborder/10 p-0">
                                    <ul class="ti-list-group list-group-flush !border-0">
                                        <li class="ti-list-group-item pt-2 border-0">
                                            <div><span class="font-medium me-2">Name :</span><span
                                                    class="text-textmuted dark:text-textmuted/50">{{ Auth::user()->name }}</span>
                                            </div>
                                        </li>
                                        <li class="ti-list-group-item pt-2 border-0">
                                            <div>
                                                <span class="font-medium me-2">Company :</span>
                                                <span class="text-textmuted dark:text-textmuted/50">
                                                    {{-- {{ $info->company }} --}} -
                                                </span>
                                            </div>
                                        </li>
                                        <li class="ti-list-group-item pt-2 border-0">
                                            <div>
                                                <span class="font-medium me-2">Company Address :</span>
                                                <span class="text-textmuted dark:text-textmuted/50">
                                                    {{ $info->location }}
                                                </span>
                                            </div>
                                        </li>
                                        <li class="ti-list-group-item pt-2 border-0">
                                            <div>
                                                <span class="font-medium me-2">Email Address:</span>
                                                <span class="text-textmuted dark:text-textmuted/50">
                                                    {{ Auth::user()->email }}
                                                </span>
                                            </div>
                                        </li>
                                        <li class="ti-list-group-item pt-2 border-0">
                                            <div>
                                                <span class="font-medium me-2">Phone No. :</span>
                                                <span class="text-textmuted dark:text-textmuted/50">
                                                    {{ $info->phone }}
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>


                            </div>

                            <div class="box overflow-hidden main-content-card" style="border: 1px solid #ECF3FB">
                                <div class="box-header pb-0 justify-between">
                                    <div class="box-title">
                                        Credit Statistics
                                    </div>
                                </div>
                                <div class="box-body py-4 px-3">
                                    <div class="flex gap-4 mb-3">
                                        <div class="avatar avatar-md bg-primary/10 !w-[3rem]">
                                            <i class="ti ti-trending-up text-[1.25rem] text-primary"></i>
                                        </div>
                                        <div class="flex-auto flex items-start justify-between w-full flex-wrap">
                                            <div>
                                                <span class="text-[11px] mb-1 block font-medium">TOTAL
                                                    CREDIT</span>
                                                <div class="flex items-center justify-between">
                                                    <h4 class="mb-0 flex items-center">
                                                        3,736
                                                    </h4>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);"
                                                class="text-success text-xs decoration-solid">Credit
                                                ?</a>
                                        </div>
                                    </div>
                                    <div id="orders" class="my-2"></div>
                                </div>
                            </div>



                            <div class="box overflow-hidden">
                                <div class="box-header justify-between">
                                    <div class="box-title">
                                        Documents
                                    </div>
                                </div>
                                <div class="box-body p-0">
                                    <ul class="ti-list-group list-group-flush !rounded-none">
                                        <li class="ti-list-group-item">
                                            <div class="flex items-center flex-wrap gap-2">
                                                <span class="avatar avatar-md avatar-rounded p-2 bg-light leading-none">
                                                    <img src="/assets/images/media/file-manager/1.png" alt="">
                                                </span>
                                                <div class="flex-auto">
                                                    <a href="javascript:void(0);"><span class="block font-medium">
                                                            Invoices - File Manager
                                                        </span></a>
                                                    <span
                                                        class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">
                                                        Last Updated (1 Month Ago)</span>
                                                </div>

                                            </div>
                                        </li>
                                        <li class="ti-list-group-item">
                                            <div class="flex items-center flex-wrap gap-2">
                                                <span
                                                    class="avatar avatar-md avatar-rounded p-2 bg-light leading-none">
                                                    <img src="/assets/images/media/file-manager/1.png" alt="">
                                                </span>
                                                <div class="flex-auto">
                                                    <a href="javascript:void(0);"><span class="block font-medium">
                                                            Contracts - File Manager
                                                        </span></a>
                                                    <span
                                                        class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">
                                                        Last Updated (3 Month Ago)</span>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="box main-dashboard-banner project-dashboard-banner overflow-hidden">
                                <div class="box-body p-[1.5rem]">
                                    <div class="grid grid-cols-12 gap-x-6 justify-between">
                                        <div
                                            class="xxl:col-span-8 xl:col-span-5 lg:col-span-5 md:col-span-5 sm:col-span-5 col-span-12">
                                            <h4 class="mb-1 font-medium text-white">Assistance ?</h4>
                                            <p class="mb-3 text-white opacity-70">Looking for Support ? Chat with our
                                                virtual assistant now!</p>
                                            <a href="javascript:void(0);"
                                                class="ti-btn ti-btn-sm bg-primarytint1color text-white">Chat with Us<i
                                                    class="ti ti-arrow-narrow-right"></i></a>
                                        </div>
                                        <div
                                            class="xxl:col-span-4 xl:col-span-7 lg:col-span-7 md:col-span-7 sm:col-span-7 col-span-12 sm:block hidden text-end my-auto">
                                            <img src="/assets/images/media/media-85.png" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="xl:col-span-9 col-span-12">
                            <div class="box overflow-hidden border border-defaultborder dark:border-defaultborder/10">
                                <div class="box-body">
                                    {{-- <center>
                                    <img src="/assets/images/company-logos/panther.png" class="h-100" alt="...">
                                </center> --}}
                                    <hr>
                                    <ul class="nav nav-tabs tab-style-6 mb-3 p-0 flex bg-white dark:bg-bodybg flex-wrap"
                                        id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link w-full text-start rounded-md active"
                                                data-hs-tab="#profile-about-tab-pane" type="button"
                                                role="tab">About</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link w-full text-start rounded-md"
                                                data-hs-tab="#edit-profile-tab-pane" type="button"
                                                role="tab">Edit
                                                Profile</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link w-full text-start rounded-md"
                                                data-hs-tab="#edit-profile-tab-pane" type="button"
                                                role="tab">Transaction Logs
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="profile-tabs">
                                        <div class="tab-pane show active p-0 border-0" id="profile-about-tab-pane"
                                            role="tabpanel">
                                            <ul class="ti-list-group list-group-flush border rounded-3">
                                                <li class="ti-list-group-item p-4">
                                                    <div class="flex items-center mb-4 gap-2 flex-wrap">
                                                        <img src="/assets/images/company-logos/panther.png"
                                                            style="height: 55px" alt="">
                                                    </div>
                                                    <hr class="mb-3">
                                                    <span class="font-medium text-[15px] block mb-3"><strong><span
                                                                class="me-1">&#10024;</span>About Plan Panthers
                                                            :</strong></span>
                                                    <p class="text-dark dark:text-textmuted/50 mb-2 text-[15px]">
                                                        With Plan Panther you can now bid more projects in your area,
                                                        thereby increasing your chances of wining more projects that
                                                        interest you.
                                                    </p>
                                                    <p class="text-dark dark:text-textmuted/50 mb-2 text-[15px]">
                                                        Tell us what type of work you would like to bid, and we will
                                                        find it, spec it, and measure it for you. We'll even find all
                                                        prospective bidders contact info so you can send your proposal
                                                        to all GCs interested on the project.
                                                    </p>
                                                    <p class="text-dark dark:text-textmuted/50 mb-0 text-[15px]">
                                                        All you have to do is estimate your labor and product quantities
                                                        and submit a price to the Prospective bidders GCs.
                                                    </p>
                                                    <p class="text-dark dark:text-textmuted/50 mb-0 text-[15px]">
                                                        All floor finishes are supported.
                                                    </p>
                                                    <span class="font-medium text-[15px] block mb-3 mt-4"><strong><span
                                                                class="me-1">🚀</span>We do the hard work so that you
                                                            don't have to :</strong>
                                                    </span>
                                                    <style>
                                                        .project-description p {
                                                            font-size: 15px;
                                                        }

                                                        .project-description ul {
                                                            list-style-type: disc;
                                                            /* Ensures bullets are visible */
                                                            padding-left: 60px !important;
                                                            /* Indents list for proper alignment */
                                                            margin-top: 5px;
                                                            margin-bottom: 10px;
                                                        }

                                                        .project-description li {
                                                            font-size: 15px;
                                                            /* Adjusts text size */
                                                            line-height: 1.5;
                                                            /* Improves readability */
                                                            color: #333;
                                                            /* Sets a dark gray text color */
                                                            margin-bottom: 5px;
                                                            /* Adds spacing between list items */
                                                        }

                                                        /* Optional: Custom bullet styling */
                                                        .project-description ul li::marker {
                                                            color: #007bff;
                                                            /* Blue bullet points */
                                                            font-size: 15px;
                                                        }
                                                    </style>

                                                    <div class="project-description">
                                                        <ul>
                                                            <li>Scrub through various databases to find projects that
                                                                match your scope and distance requirements.</li>
                                                            <li>Carefully read the specifications and provide a summary
                                                                of the product requirements to help you bid more easily.
                                                            </li>
                                                            <li>Acquire the plan holders list so you can send your
                                                                proposal to all the possible GCs working on this
                                                                project.</li>
                                                            <li>Perform the takeoff to give you accurate measurements of
                                                                your scope.</li>
                                                            <li>Provide a "cutsheet" with the specification summary, the
                                                                quantities for your scope of work, and a list of GCs who
                                                                will be bidding on this project (prospective bidders).
                                                            </li>
                                                            <li>Provide a takeoff plan with clear measurements.</li>
                                                        </ul>
                                                    </div>
                                                    <span class="font-medium text-[15px] block mb-3 mt-4"><strong><span
                                                                class="me-1">🏤</span>Do you already have estimators
                                                            at your office?</strong>
                                                    </span>
                                                    <p class="text-dark dark:text-textmuted/50 mb-0 text-[15px]">
                                                        No problem! Send us the bids you don't have time for, we'll
                                                        speed you up and get the refined data back quickly so you can
                                                        maximize your efforts and get those bids out you otherwise
                                                        needed to skip.
                                                    </p>
                                                    <hr class="mt-4">
                                                    <img class="img-fluid" src="/assets/plan-panthers/a6d2a92d.jpg"
                                                        alt="">
                                                    <hr class="">
                                                    <img class="img-fluid" src="/assets/plan-panthers/44382698.jpg"
                                                        alt="">
                                                    <hr class="">
                                                    <img class="img-fluid" src="/assets/plan-panthers/ae2b8af0.jpg"
                                                        alt="">
                                                    <hr class="">
                                                    <img class="img-fluid" src="/assets/plan-panthers/d54f726c.jpg"
                                                        alt="">
                                                    {{-- <div class="flex gap-5 mb-4 flex-wrap">
                                                        <div class="flex items-center gap-2 me-3">
                                                            <span
                                                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint1color/10 !text-primarytint1color"><i
                                                                    class="ri-calendar-event-line text-lg leading-none align-middle"></i></span>
                                                            <div>
                                                                <div class="font-medium mb-0 task-title">
                                                                    Start Date
                                                                </div>
                                                                <span
                                                                    class="text-xs text-textmuted dark:text-textmuted/50">28
                                                                    August,
                                                                    2024</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-2 me-3">
                                                            <span
                                                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint2color/10 !text-primarytint2color"><i
                                                                    class="ri-time-line text-lg leading-none align-middle"></i></span>
                                                            <div>
                                                                <div class="font-medium mb-0 task-title">
                                                                    End Date
                                                                </div>
                                                                <span
                                                                    class="text-xs text-textmuted dark:text-textmuted/50">30
                                                                    Oct, 2024</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-2">
                                                            <span
                                                                class="avatar avatar-md p-1 avatar-rounded me-1 bg-primary/10"><img
                                                                    src="/assets/images/faces/15.jpg"
                                                                    alt=""></span>
                                                            <div>
                                                                <span class="block text-[14px] font-medium">Fabian
                                                                    Jones</span>
                                                                <span
                                                                    class="text-xs text-textmuted dark:text-textmuted/50">
                                                                    Contact Person
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </li>
                                                {{-- <li class="ti-list-group-item p-4">

                                                    <div class="grid grid-cols-12 gap-x-6">
                                                        <div class="xxl:col-span-8 col-span-8">
                                                            <div class="border-1 #10024"
                                                                style="border: 1px solid #ECF3FB">
                                                                <div class="box-header justify-between">
                                                                    <div class="box-title">
                                                                        Credit Overview
                                                                    </div>
                                                                </div>
                                                                <div class="box-body">
                                                                    <div id="sales-overview"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="xxl:col-span-4 col-span-4">
                                                            <div class="boxx overflow-hidden"
                                                                style="border: 1px solid #ECF3FB">
                                                                <div class="box-header pb-0 justify-between">
                                                                    <div class="box-title">
                                                                        Credit Statistics
                                                                    </div>
                                                                </div>
                                                                <div class="box-body py-4 px-3">
                                                                    <div class="flex gap-4 mb-3">
                                                                        <div
                                                                            class="avatar avatar-md bg-primary/10 !w-[3rem]">
                                                                            <i
                                                                                class="ti ti-trending-up text-[1.25rem] text-primary"></i>
                                                                        </div>
                                                                        <div
                                                                            class="flex-auto flex items-start justify-between w-full flex-wrap">
                                                                            <div>
                                                                                <span
                                                                                    class="text-[11px] mb-1 block font-medium">TOTAL
                                                                                    CREDIT</span>
                                                                                <div
                                                                                    class="flex items-center justify-between">
                                                                                    <h4 class="mb-0 flex items-center">
                                                                                        3,736<span
                                                                                            class="text-success text-xs ms-2 inline-flex items-center"><i
                                                                                                class="ti ti-trending-up align-middle me-1"></i>0.57%</span>
                                                                                    </h4>
                                                                                </div>
                                                                            </div>
                                                                            <a href="javascript:void(0);"
                                                                                class="text-success text-xs decoration-solid">Credit
                                                                                ?</a>
                                                                        </div>
                                                                    </div>
                                                                    <div id="orders" class="my-2"></div>
                                                                </div>
                                                                <div class="box-footer border-t border-dashed">
                                                                    <div class="grid">
                                                                        <button
                                                                            class="ti-btn ti-btn-outline-primary ti-btn-wave btn-wave font-medium waves-effect waves-light table-icon">Complete
                                                                            Statistics<i
                                                                                class="ti ti-arrow-narrow-right ms-2 text-[16px] inline-block"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="ti-list-group-item p-4">
                                                    <span class="font-medium text-[15px] block mb-3">Social Media
                                                        :</span>
                                                    <div class="flex items-center gap-5 flex-wrap">
                                                        <div class="flex items-center gap-4 me-2 flex-wrap">
                                                            <div>
                                                                <span class="avatar avatar-md bg-primary"><i
                                                                        class="ri-github-line text-[1rem]"></i></span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="block font-medium text-primay">Github</span>
                                                                <span
                                                                    class="text-textmuted dark:text-textmuted/50 font-medium">github.com/spruko</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-4 me-2 flex-wrap">
                                                            <div>
                                                                <span class="avatar avatar-md bg-primarytint1color"><i
                                                                        class="ri-twitter-x-line text-[1rem]"></i></span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="block font-medium text-primay1">Twitter</span>
                                                                <span
                                                                    class="text-textmuted dark:text-textmuted/50 font-medium">twitter.com/spruko.me</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-4 me-2 flex-wrap">
                                                            <div>
                                                                <span class="avatar avatar-md bg-primarytint2color"><i
                                                                        class="ri-linkedin-line text-[1rem]"></i></span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="block font-medium text-primay2">Linkedin</span>
                                                                <span
                                                                    class="text-textmuted dark:text-textmuted/50 font-medium">linkedin.com/in/spruko</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-4 flex-wrap">
                                                            <div>
                                                                <span class="avatar avatar-md bg-primarytint3color"><i
                                                                        class="ri-briefcase-line text-[1rem]"></i></span>
                                                            </div>
                                                            <div>
                                                                <span class="block font-medium text-primay3">My
                                                                    Portfolio</span>
                                                                <span
                                                                    class="text-textmuted dark:text-textmuted/50 font-medium">spruko.com/</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li> --}}
                                            </ul>
                                        </div>
                                        <div class="tab-pane p-0 border-0 hidden" id="edit-profile-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <ul class="ti-list-group list-group-flush border rounded-3">
                                                <li class="ti-list-group-item p-4">
                                                    <span class="font-medium text-[15px] block mb-3">Personal Info
                                                        :</span>
                                                    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3 items-center">
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">User Name :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder" value="Spencer Robin">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">First Name :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder" value="Spencer">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Last Name :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder" value="Robin">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Company :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder"
                                                                value="Software Development Manager">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="ti-list-group-item p-4">
                                                    <span class="font-medium text-[15px] block mb-3">Contact Info
                                                        :</span>
                                                    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3 items-center">
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Email :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="email" class="form-control"
                                                                placeholder="Placeholder"
                                                                value="spencer. robin22@example.com">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Phone :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder"
                                                                value="+1 (222) 111 - 57840">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Website :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder"
                                                                value="www.yourwebsite .com">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Location :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder" value="City, Country">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="ti-list-group-item p-4">
                                                    <span class="font-medium text-[15px] block mb-3">Social Info
                                                        :</span>
                                                    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3 items-center">
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Facebook :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder" value="github.com/spruko">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Twitter / X :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder"
                                                                value="twitter.com/spruko.me">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Linkedin :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder"
                                                                value="linkedin.com/in/spruko">
                                                        </div>
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Portfolio :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Placeholder" value="spruko.com/">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="ti-list-group-item p-4">
                                                    <span class="font-medium text-[15px] block mb-3">About Info
                                                        :</span>
                                                    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3 items-center">
                                                        <div class="xl:col-span-3 col-span-12">
                                                            <div class="leading-none">
                                                                <span class="font-medium">Biographical Info :</span>
                                                            </div>
                                                        </div>
                                                        <div class="xl:col-span-9 col-span-12">
                                                            <textarea class="form-control" id="text-area" rows="4">Hello, I'm [Your Name], a dedicated [Your Profession/Interest] based in [Your Location]. I have a genuine passion for [Your Hobbies/Interests] and enjoy delving into the nuances of [Your Industry/Field].

                                                            Specializing in [Your Specialization/Area of Expertise], I strive to infuse innovation into every project I undertake. With a track record of [Key Achievements] and valuable experiences, I'm committed to continual growth and eagerly anticipate the opportunities that lie ahead.
                                                        </textarea>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.clients.forms.credits')
    <script>
        function credit_type(type) {
            document.getElementById('type').value = type;
            document.getElementById('client_type').value = 'sub-client';
        }
    </script>
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/js/sales-dashboard.js"></script>
    <script src="/assets/js/crm-leads.js"></script>

</x-app-layout>
