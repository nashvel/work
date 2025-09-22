<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Start::page-header -->
            <div class="flex items-center justify-between page-header-breadcrumb flex-wrap gap-2">
                <div>
                    <h1 class="page-title font-medium text-lg mb-3">Dashboard</h1>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">
                                    Dashboards
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-list">
                    <button class="ti-btn bg-white dark:bg-bodybg border border-defaultborder dark:border-defaultborder/10 btn-wave !my-0">
                        <i class="ri-filter-3-line align-middle me-1 leading-none"></i> Filter
                    </button>
                    <button class="ti-btn ti-btn-primary !border-0 btn-wave me-0">
                        <i class="ri-share-forward-line me-1"></i> Share
                    </button>
                </div>
            </div>
            <!-- End::page-header -->

            <!-- Start::row-1 -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="xxl:col-span-4 col-span-12">
                    <div class="box main-dashboard-banner main-dashboard-banner2 overflow-hidden">
                        <div class="box-body p-6">
                            <div class="grid grid-cols-12 sm:gap-x-6 justify-between">
                                <div class="xxl:col-span-8 xl:col-span-4 lg:col-span-5 md:col-span-5 sm:col-span-5 col-span-12">
                                    <h4 class="mb-3 font-medium text-white">Upgrade to get more</h4>
                                    <p class="mb-3 text-white text-[11px]">Upgrade Now for Premium Access and Unlock Exclusive Features!</p>
                                    <a href="javascript:void(0);" class="font-medium text-white underline">Upgrade Now<i class="ti ti-arrow-narrow-right"></i></a>
                                </div>
                                <div class="xxl:col-span-4 xl:col-span-7 lg:col-span-7 md:col-span-7 sm:col-span-7 col-span-12 sm:block hidden text-end my-auto">
                                    <img src="./assets/images/media/media-91.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-8 col-span-12">
                    <div class="grid grid-cols-12 gap-x-6">
                        <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                            <div class="box overflow-hidden">
                                <div class="box-body pb-0 pe-0">
                                    <div class="mb-4">
                                        <div class="flex justify-between flex-wrap">
                                            <span class="avatar avatar-rounded bg-primary svg-white">
                                                <i class="bx bx-group text-[22px]"></i>
                                            </span>
                                            <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Total Followers</span>
                                        </div>
                                    </div>
                                    <div class="flex items-end justify-between">
                                        <div class="pb-3">
                                            <span class="text-[20px] font-medium mb-0 flex items-center">13,124
                                            </span>
                                            <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Increased By </div>
                                            <span class="text-success">2.62%<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                                        </div>
                                        <div id="chart-21"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                            <div class="box overflow-hidden">
                                <div class="box-body pb-0 pe-0">
                                    <div class="mb-4">
                                        <div class="flex justify-between flex-wrap">
                                            <span class="avatar avatar-rounded bg-primarytint1color svg-white">
                                                <i class="bx bx-trending-up text-[22px]"></i>
                                            </span>
                                            <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Session Rate</span>
                                        </div>
                                    </div>
                                    <div class="flex items-end justify-between">
                                        <div class="pb-3">
                                            <span class="text-[20px] font-medium mb-0 flex items-center">11,287
                                            </span>
                                            <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Increased By </div>
                                            <span class="text-success">0.56%<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                                        </div>
                                        <div id="chart-22"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                            <div class="box overflow-hidden">
                                <div class="box-body pb-0 pe-0">
                                    <div class="mb-4">
                                        <div class="flex justify-between flex-wrap">
                                            <span class="avatar avatar-rounded bg-primarytint2color svg-white"> 
                                                <i class="bx bx-dollar text-[22px]"></i>
                                            </span>
                                            <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Conversion Rate</span>
                                        </div>
                                    </div>
                                    <div class="flex items-end justify-between">
                                        <div class="pb-3">
                                            <span class="text-[20px] font-medium mb-0 flex items-center">17,658
                                            </span>
                                            <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Decreased By </div>
                                            <span class="text-danger">3.76%<i class="ti ti-arrow-narrow-down text-[16px]"></i></span>
                                        </div>
                                        <div id="chart-23"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xxl:col-span-3 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                            <div class="box overflow-hidden">
                                <div class="box-body pb-0 pe-0">
                                    <div class="mb-4">
                                        <div class="flex justify-between flex-wrap">
                                            <span class="avatar avatar-rounded bg-primarytint3color svg-white">
                                                <i class="bx bx-like text-[22px]"></i>
                                            </span>
                                            <span class="font-medium text-[13px] text-textmuted dark:text-textmuted/50 pe-3">Total Review</span>
                                        </div>
                                    </div>
                                    <div class="flex items-end justify-between">
                                        <div class="pb-3">
                                            <span class="text-[20px] font-medium mb-0 flex items-center">5,124
                                            </span>
                                            <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Increased By </div>
                                            <span class="text-success">2.57%<i class="ti ti-arrow-narrow-up text-[16px]"></i></span>
                                        </div>
                                        <div id="chart-24"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--End::row-1 -->

            <!-- Start::row-2 -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="xxl:col-span-3 col-span-12">
                    <div class="box">
                        <div class="box-header justify-between flex-wrap pb-1">
                            <div class="box-title">
                                Activity
                            </div>
                            <div class="ti-dropdown hs-dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-light ti-btn-icons ti-btn-sm text-textmuted dark:text-textmuted/50 ti-dropdown-toggle hs-dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fe fe-more-vertical fs-14"></i>
                                </a>
                                <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                    <li class="border-b border-defaultborder dark:border-defaultborder/10"><a class="ti-dropdown-item" href="javascript:void(0);">Today</a></li>
                                    <li class="border-b border-defaultborder dark:border-defaultborder/10"><a class="ti-dropdown-item" href="javascript:void(0);">This Week</a></li>
                                    <li><a class="ti-dropdown-item" href="javascript:void(0);">Last Week</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="analytics-timeline">
                                <ul class="list-none analytics-activity mb-0">
                                    <li>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-primary/10 !text-primary">
                                                    <i class="ri-timer-2-line text-[18px]"></i>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <span class="block font-medium">Avg. Session Duration</span>
                                                <span class="text-[13px] text-textmuted dark:text-textmuted/50">Increased by <span class="text-success font-medium ms-1">5.2% <i class="ti ti-arrow-narrow-up"></i></span></span>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="block text-[15px] mb-0 font-medium">2m 35s</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-primarytint1color/10 !text-primarytint1color">
                                                    <i class="ri-user-add-line text-[18px]"></i>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <span class="block font-medium">New Users</span>
                                                <span class="text-[13px] text-textmuted dark:text-textmuted/50">Increased by  <span class="text-success font-medium ms-1">10.3%<i class="ti ti-arrow-narrow-up"></i></span></span>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="block text-[15px] mb-0 font-medium">5,621</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-primarytint2color/10 !text-primarytint2color">
                                                    <i class="ri-eye-line text-[18px]"></i>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <span class="block font-medium">Page Views</span>
                                                <span class="text-[13px] text-textmuted dark:text-textmuted/50">Decreased by <span class="text-danger font-medium ms-1"> 2.15% <i class="ti ti-arrow-narrow-down"></i></span></span>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="block text-[15px] mb-0 font-medium">45,890</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-primarytint3color/10 !text-primarytint3color">
                                                    <i class="ri-line-chart-line text-[18px]"></i>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <span class="block font-medium">Conversion Rate</span>
                                                <span class="text-[13px] text-textmuted dark:text-textmuted/50">Increased by <span class="text-success font-medium ms-1">1.5% <i class="ti ti-arrow-narrow-up"></i></span></span>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="block text-[15px] mb-0 font-medium">4.8%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-secondary/10 !text-secondary">
                                                    <i class="ri-arrow-down-s-line text-[18px]"></i>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <span class="block font-medium">Bounce Rate</span>
                                                <span class="text-[13px] text-textmuted dark:text-textmuted/50">Decreased by <span class="text-danger font-medium ms-1"> 3.8%<i class="ti ti-arrow-narrow-down"></i></span></span>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="block text-[15px] mb-0 font-medium">32.5%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-warning/10 !text-warning">
                                                    <i class="ri-user-line text-[18px]"></i>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <span class="block font-medium">Returning Visitors</span>
                                                <span class="text-[13px] text-textmuted dark:text-textmuted/50">Increased by<span class="text-success font-medium ms-1">  7.2% <i class="ti ti-arrow-narrow-up"></i></span></span>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="block text-[15px] mb-0 font-medium">8,932</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="!mb-0">
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="avatar avatar-md avatar-rounded bg-info/10 !text-info">
                                                    <i class="ri-money-dollar-circle-line text-[18px]"></i>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <span class="block font-medium">Avg. Order Value</span>
                                                <span class="text-[13px] text-textmuted dark:text-textmuted/50">Decreased by<span class="text-danger font-medium ms-1">  2.7%<i class="ti ti-arrow-narrow-down"></i></span></span>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="block text-[15px] mb-0 font-medium">$56.78</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-6 col-span-12">
                    <div class="box">
                        <div class="box-header justify-between">
                            <div class="box-title">
                                Visitor Analytics
                            </div>
                            <div>
                                <button type="button" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]"><i class="ri-share-forward-line align-middle inline-block"></i>Export</button>
                            </div>
                        </div>
                        <div class="box-body pb-0">
                            <div id="audienceMetric"></div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-3 col-span-12">
                    <div class="box">
                        <div class="box-header justify-between">
                            <div class="box-title">
                                Users By Countries
                            </div>
                            <div class="">
                                <a href="javascript:void(0);" class="ti-btn ti-btn-light text-textmuted dark:text-textmuted/50 ti-btn-sm">
                                    View All
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <ul class="list-none mb-0 analytics-visitors-countries">
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/us_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">United States</span>
                                        </div>
                                        <div class="text-success ms-auto">5.1%<i class="ti ti-arrow-narrow-up"></i></div>
                                        <div>
                                            <span class="text-defaulttextcolor badge bg-light font-medium">26,890</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/germany_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">Germany</span>
                                        </div>
                                        <div class="text-success ms-auto">1.3%<i class="ti ti-arrow-narrow-up"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">12,345</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/spain_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">Spain</span>
                                        </div>
                                        <div class="text-success ms-auto">2.7%<i class="ti ti-arrow-narrow-up"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">18,765</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/china_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">China</span>
                                        </div>
                                        <div class="text-danger ms-auto">1.0%<i class="ti ti-arrow-narrow-down"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">9,874</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/mexico_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">Mexico</span>
                                        </div>
                                        <div class="text-success ms-auto">2.7%<i class="ti ti-arrow-narrow-up"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">21,456</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/canada_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">Canada</span>
                                        </div>
                                        <div class="text-success ms-auto">2.1%<i class="ti ti-arrow-narrow-up"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">28,976</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/argentina_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">Argentina</span>
                                        </div>
                                        <div class="text-success ms-auto ">5.4%<i class="ti ti-arrow-narrow-up"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">21,456</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/singapore_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">Singapore</span>
                                        </div>
                                        <div class="text-success ms-auto">0.7%<i class="ti ti-arrow-narrow-up"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">16,789</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="!mb-0">
                                    <div class="flex items-center gap-2">
                                        <div class="leading-none">
                                            <span class="avatar avatar-xs avatar-rounded text-defaulttextcolor">
                                                <img src="../assets/images/flags/italy_flag.jpg" alt="">
                                            </span>
                                        </div>
                                        <div class="ms-1 flex-auto leading-none">
                                            <span class="text-[14px]">Italy</span>
                                        </div>
                                        <div class="text-danger ms-auto">0.3%<i class="ti ti-arrow-narrow-down"></i></div>
                                        <div class="ms-1">
                                            <span class="text-defaulttextcolor badge bg-light font-medium">21,456</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            
                        </div>
                     </div>
                </div>
            </div>
            <!--End::row-2 -->

            <!-- Start::row-3 -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="xxl:col-span-5 col-span-12">
                    <div class="box">
                        <div class="box-header justify-between">
                            <div class="box-title">
                                Site Referrals
                            </div>
                            <a href="javascript:void(0);" class="ti-btn ti-btn-light btn-wave text-textmuted dark:text-textmuted/50 waves-effect ti-btn-sm waves-light">View All</a>
                        </div>
                        <div class="box-body sm:flex items-center">
                            <div id="referrals-chart" class="p-4 flex-shrink-0 px-0"></div>
                            <div class="table-responsive overflow-auto table-bordered-default">
                                <table class="ti-custom-table text-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="border-b border-defaultborder dark:border-defaultborder/10">Source</th>
                                        <th class="border-b border-defaultborder dark:border-defaultborder/10">Total</th>
                                        <th class="border-b border-defaultborder dark:border-defaultborder/10">Growth</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Search Engines</td>
                                        <td class="text-center font-medium">300</td>
                                        <td class="text-success">+5.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Social Media</td>
                                        <td class="text-center font-medium">450</td>
                                        <td class="text-success">+10.3%</td>
                                    </tr>
                                    <tr>
                                        <td>Direct</td>
                                        <td class="text-center font-medium">200</td>
                                        <td class="text-success">+2.5%</td>
                                    </tr>
                                    <tr>
                                        <td>Referral Sites</td>
                                        <td class="text-center font-medium">150</td>
                                        <td class="text-danger">-1.2%</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td class="text-center font-medium">100</td>
                                        <td class="text-success">+3.8%</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-4 col-span-12">
                    <div class="box">
                        <div class="box-header justify-between">
                        <h5 class="box-title">Top Landing Pages</h5>
                        <a href="javascript:void(0);" class="ti-btn ti-btn-light btn-wave text-textmuted dark:text-textmuted/50 ti-btn-sm waves-effect waves-light">View All</a>
                        </div>
                        <div class="box-body">
                            <div class="mb-3">
                                <div class="flex mb-1">
                                    <span>main/landing-page/home</span>
                                    <span class="ms-auto text-[14px] font-semibold">2,345 Visits</span>
                                </div>
                                <div class="progress progress-md p-1">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="flex mb-1">
                                    <span>main/landing-page/products/popular-category</span>
                                    <span class="ms-auto text-[14px] font-semibold">1,987 Visits</span>
                                </div>
                                <div class="progress progress-md p-1">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primarytint1color" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="flex mb-1">
                                    <span>main/landing-page/blog/latest-article</span>
                                    <span class="ms-auto text-[14px] font-semibold">1,532 Visits</span>
                                </div>
                                <div class="progress progress-md p-1">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primarytint2color" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="flex mb-1">
                                    <span>main/landing-page/about-us/team-page</span>
                                    <span class="ms-auto text-[14px] font-semibold">1,254 Visits</span>
                                </div>
                                <div class="progress progress-md p-1">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primarytint3color" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="flex mb-1">
                                    <span>main/landing-page/about-us/profile</span>
                                    <span class="ms-auto text-[14px] font-semibold">1,103 Visits</span>
                                </div>
                                <div class="progress progress-md p-1">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primarytint3color" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="flex mb-1">
                                    <span>main/landing-page/contact/support</span>
                                    <span class="ms-auto text-[14px] font-semibold">985 Visits</span>
                                </div>
                                <div class="progress progress-md p-1">
                                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-3 col-span-12">
                    <div class="box">
                        <div class="box-header justify-between pb-0">
                           <div class="box-title">
                            Sales Growth Rate
                           </div>
                            <div class="ti-dropdown hs-dropdown">
                               <a aria-label="anchor" href="javascript:void(0);" class="ti-btn ti-btn-light ti-btn-icons ti-btn-sm text-textmuted dark:text-textmuted/50 ti-dropdown-toggle hs-dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                   <i class="fe fe-more-vertical"></i>
                               </a>
                               <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                   <li class="border-b border-defaultborder dark:border-defaultborder/10"><a class="ti-dropdown-item" href="javascript:void(0);">Today</a></li>
                                   <li class="border-b border-defaultborder dark:border-defaultborder/10"><a class="ti-dropdown-item" href="javascript:void(0);">This Week</a></li>
                                   <li><a class="ti-dropdown-item" href="javascript:void(0);">Last Week</a></li>
                               </ul>
                            </div>
                       </div>
                       <div class="box-body pb-1">
                            <div class="flex items-center p-4 bg-light rounded-sm">
                                <div>
                                    <p class="mb-1 text-[13px]">Comparison: 2024 vs. 2023</p>
                                    <div class="text-textmuted dark:text-textmuted/50 text-xs mb-2">Increased By <span class="text-success"> 2.62%<i class="ti ti-arrow-narrow-up text-[16px]"></i></span></div>
                                    <h5 class="mb-0">20%</h5>
                                </div>
                                <div class="ms-auto">
                                    <div class="p-2 bg-primary/10 rounded-full">
                                        <div class="avatar-md avatar bg-primary svg-white avatar-rounded shadow-sm mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M232,208a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V48a8,8,0,0,1,16,0V156.69l50.34-50.35a8,8,0,0,1,11.32,0L128,132.69,180.69,80H160a8,8,0,0,1,0-16h40a8,8,0,0,1,8,8v40a8,8,0,0,1-16,0V91.31l-58.34,58.35a8,8,0,0,1-11.32,0L96,123.31l-56,56V200H224A8,8,0,0,1,232,208Z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sales-growth" class="mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
             <!--End::row-3 -->

            <!-- Start::row-4 -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="xl:col-span-12 col-span-12">
                    <div class="box">
                        <div class="box-header justify-between">
                            <div class="box-title">
                                Visitors Statistics
                            </div>
                            <div class="flex flex-wrap">
                                <div class="ti-dropdown hs-dropdown my-1">
                                    <a href="javascript:void(0);" class="ti-btn ti-btn-light ti-dropdown-toggle hs-dropdown-toggle px-2 py-[0.26rem]" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort By<i class="ri-arrow-down-s-line align-middle ms-1 inline-block"></i>
                                    </a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">New</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">Popular</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">Relevant</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive overflow-auto table-bordered-default">
                                <table class="ti-custom-table text-nowrap ti-custom-table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">Total Visitors</th>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">Sessions Duration</th>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">New Visitors</th>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">Returning Visitors</th>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">Bounce Rate</th>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">Conversion Rate</th>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">Average Session Duration</th>
                                            <th class="border-b border-defaultborder dark:border-defaultborder/10">Top Referral Sources</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-success">32,190</td>
                                            <td>15m 30s</td>
                                            <td>12,345</td>
                                            <td>19,845</td>
                                            <td class="table-danger">45%</td>
                                            <td>3.5%</td>
                                            <td>3m 45s</td>
                                            <td>Google, Facebook</td>
                                        </tr>
                                        <tr>
                                            <td>28,674</td>
                                            <td>13m 25s</td>
                                            <td>10,432</td>
                                            <td>18,242</td>
                                            <td>47%</td>
                                            <td class="table-warning">3.8%</td>
                                            <td>3m 10s</td>
                                            <td>Twitter, LinkedIn</td>
                                        </tr>
                                        <tr>
                                            <td>35,789</td>
                                            <td class="table-warning">16m 10s</td>
                                            <td>13,567</td>
                                            <td class="table-success">22,222</td>
                                            <td>43%</td>
                                            <td>3.2%</td>
                                            <td class="table-success">4m 05s</td>
                                            <td>Bing, YouTube</td>
                                        </tr>
                                        <tr>
                                            <td>30,234</td>
                                            <td>14m 50s</td>
                                            <td>11,678</td>
                                            <td>18,556</td>
                                            <td>46%</td>
                                            <td>3.6%</td>
                                            <td>3m 30s</td>
                                            <td>Instagram, Reddit</td>
                                        </tr>
                                        <tr>
                                            <td class="table-danger">33,456</td>
                                            <td>15m 45s</td>
                                            <td>12,890</td>
                                            <td>20,566</td>
                                            <td>44%</td>
                                            <td>3.4%</td>
                                            <td>3m 55s</td>
                                            <td class="table-success">Yahoo, Pinterest</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="flex items-center flex-wrap">
                                <div>
                                    Showing 6 Entries <i class="bi bi-arrow-right ms-2 font-medium"></i>
                                </div>
                                <div class="ms-auto">
                                   
                                    <nav aria-label="Page navigation" class="pagination-style-4">
                                        <ul class="ti-pagination mb-0 flex-wrap">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0);">
                                                    Prev
                                                </a>
                                            </li>
                                            <li class="page-item "><a class="page-link active"
                                                    href="javascript:void(0);">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                            
                                            <li class="page-item">
                                                <a class="page-link !text-primary" href="javascript:void(0);">
                                                    next
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End::row-4 -->

        </div>
    </div>

    
    <script src="./assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="./assets/js/analytics-dashboard.js"></script>
</x-app-layout>