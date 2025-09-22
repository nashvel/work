@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
@endphp
<x-app-layout>

    @php
        $user = Auth::user();
        $clientId = null;

        if ($user->role === 'Virtual Assistant') {
            $clientId = $user->company;
        } elseif ($user->role === 'Sub-Client') {
            $clientId = App\Models\Clients::where('email', $user->email)->value('lead_id');
        } else {
            $clientId = App\Models\Lead::where('email', $user->email)->value('id');
        }

        $id = $clientId;

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
    @php
        function getCompletion($task)
        {
            $total = $task->subtasks->count();
            if ($total == 0) {
                return 0;
            }
            $completed = $task->subtasks->where('status', 'completed')->count();
            return round(($completed / $total) * 100);
        }

        function getColor($task)
        {
            $progress = getCompletion($task);
            if ($progress < 30) {
                return '#f44336';
            } // red
            if ($progress < 60) {
                return '#ff9800';
            } // orange
            return '#4caf50'; // green
        }

        function getStatusTextColor($status)
        {
            return match ($status) {
                'completed' => 'text-success',
                'pending' => 'text-warning',
                'in_progress' => 'text-blue-600',
                default => 'text-gray-700',
            };
        }

        function getPriorityTextColor($priority)
        {
            return match ($priority) {
                'low' => 'text-dark',
                'medium' => 'text-primary',
                'high' => 'text-danger',
                default => 'text-gray-700',
            };
        }

    @endphp
    <x-slot name="title">
        <h1 class="text-2xl">{{ $lead_profile->company_name }}</h1>
    </x-slot>
    <x-slot name="url_1">{"link": "/user/dashboard", "text": "Dashboard"}</x-slot>
    <x-slot name="active">{{ $lead_profile->company_name }}</x-slot>
    <x-slot name="buttons"> </x-slot>


    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-9 col-span-12">
            <div class="xl:col-span-12 col-span-12">
                <div class="grid grid-cols-12 gap-x-6">
                    <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
                        <div class="box overflow-hidden main-content-card">
                            <div class="box-body bg-soft-danger">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total
                                            Products</span>
                                        <h4 class="font-medium mb-0">854</h4>
                                    </div>
                                    <div class="leading-none">
                                        <span class="avatar avatar-md avatar-rounded bg-primary">
                                            <i class="ti ti-shopping-cart text-[1.25rem]"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Increased By <span
                                        class="text-success">2.56%<i
                                            class="ti ti-arrow-narrow-up text-[16px]"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
                        <div class="box overflow-hidden main-content-card">
                            <div class="box-body">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="block text-textmuted dark:text-textmuted/50 mb-1">Total
                                            Customer</span>
                                        <h4 class="font-medium mb-0">31,876</h4>
                                    </div>
                                    <div class="leading-none">
                                        <span class="avatar avatar-md avatar-rounded bg-primarytint1color">
                                            <i class="ti ti-users text-[1.25rem]"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Increased By <span
                                        class="text-success">0.34%<i
                                            class="ti ti-arrow-narrow-up text-[16px]"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
                        <div class="box overflow-hidden main-content-card">
                            <div class="box-body">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total
                                            Revenue</span>
                                        <h4 class="font-medium mb-0">$34,241</h4>
                                    </div>
                                    <div class="leading-none">
                                        <span class="avatar avatar-md avatar-rounded bg-primarytint2color">
                                            <i class="ti ti-currency-dollar text-[1.25rem]"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Increased By <span
                                        class="text-success">7.66%<i
                                            class="ti ti-arrow-narrow-up text-[16px]"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
                        <div class="box overflow-hidden main-content-card">
                            <div class="box-body">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total
                                            Sales</span>
                                        <h4 class="font-medium mb-0">$176,586</h4>
                                    </div>
                                    <div class="leading-none">
                                        <span class="avatar avatar-md avatar-rounded bg-primarytint3color">
                                            <i class="ti ti-chart-bar text-[1.25rem]"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Decreased By <span
                                        class="text-danger">0.74%<i
                                            class="ti ti-arrow-narrow-down text-[16px]"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-12 xl:col-span-12 col-span-12">

                        <div class="box pt-3">
                            <div
                                class="flex gap-5 items-center p-4 justify-around bg-light mx-2 flex-wrap flex-xl-nowrap rounded-md">

                                <div class="flex gap-4 items-center flex-wrap">
                                    <div
                                        class="avatar avatar-lg flex-shrink-0 bg-primarytint1color/10 avatar-rounded svg-primarytint1color shadow-sm border border-primarytint1color border-opacity-25">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="#000000" viewBox="0 0 256 256">
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
                                        class="avatar avatar-lg flex-shrink-0 bg-primary/10 avatar-rounded svg-primary shadow-sm border border-primary border-opacity-25">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="#000000" viewBox="0 0 256 256">
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
                            </div>

                            <hr class="mt-3">

                        </div>
                    </div>
                    <div class="xxl:col-span-12 xl:col-span-12 col-span-12">
                        <div class="box">
                            <div class="box-header justify-between">
                                <div class="box-title">
                                    Sales Overview
                                </div>
                                <div class="ti-dropdown hs-dropdown">
                                    <a href="javascript:void(0);"
                                        class="ti-btn ti-btn-light ti-btn-sm text-textmuted dark:text-textmuted/50 ti-dropdown-toggle hs-dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="true"> Sort By <i
                                            class="ri-arrow-down-s-line align-middle fs-13 d-inline-block"></i></a>
                                    <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu"
                                        data-popper-placement="bottom-end">
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">This Week</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">Last Week</a></li>
                                        <li><a class="ti-dropdown-item" href="javascript:void(0);">This Month</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box-body">
                                <div id="sales-overview"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-12 gap-x-6">
                    <div class="xl:col-span-12 col-span-12">
                        <div class="box overflow-hidden">
                            <div class="box-header justify-between">
                                <div class="box-title">
                                    Recent Orders
                                </div>
                                <a href="javascript:void(0);"
                                    class="ti-btn ti-btn-light btn-wave px-2 py-[0.26rem] text-textmuted dark:text-textmuted/50 waves-effect waves-light">View
                                    All</a>
                            </div>
                            <div class="box-body p-0">
                                <div class="table-responsive">
                                    <table class="ti-custom-table text-nowrap">
                                        <thead>
                                            <tr class="border !border-defaultborder dark:!border-defaultborder/10">
                                                <th class="!text-center flex items-center justify-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkboxNoLabel1" value="" aria-label="...">
                                                </th>
                                                <th>Customer</th>
                                                <th>Product</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Amount</th>
                                                <th>Status</th>
                                                <th>Date Ordered</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkboxNoLabel02" value="" aria-label="..."
                                                        checked>
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-4">
                                                        <div class="leading-none">
                                                            <span class="avatar avatar-sm">
                                                                <img src="../assets/images/faces/1.jpg"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="block font-medium">Elena smith</span>
                                                            <span
                                                                class="block text-[11px] text-textmuted dark:text-textmuted/50">elenasmith387@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    All-Purpose Cleaner
                                                </td>
                                                <td class="text-center">
                                                    3
                                                </td>
                                                <td class="text-center">
                                                    $9.99
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary/10 text-primary">In Progress</span>
                                                </td>
                                                <td>
                                                    03,Sep 2024
                                                </td>
                                                <td>
                                                    <div class="ti-btn-list">
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-success"><i
                                                                class="ri-pencil-line"></i></button>
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger"><i
                                                                class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkboxNoLabel12" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-4">
                                                        <div class="leading-none">
                                                            <span class="avatar avatar-sm">
                                                                <img src="../assets/images/faces/12.jpg"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="block font-medium">Nelson Gold</span>
                                                            <span
                                                                class="block text-[11px] text-textmuted dark:text-textmuted/50">noahrussell556@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    Kitchen Knife Set
                                                </td>
                                                <td class="text-center">
                                                    4
                                                </td>
                                                <td class="text-center">
                                                    $49.99
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-primarytint1color/10 text-primarytint1color">Pending</span>
                                                </td>
                                                <td>
                                                    26,Jul 2024
                                                </td>
                                                <td>
                                                    <div class="ti-btn-list">
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-success"><i
                                                                class="ri-pencil-line"></i></button>
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger"><i
                                                                class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkboxNoLabel42" value="" aria-label="..."
                                                        checked>
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-4">
                                                        <div class="leading-none">
                                                            <span class="avatar avatar-sm">
                                                                <img src="../assets/images/faces/6.jpg"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="block font-medium">Grace Mitchell</span>
                                                            <span
                                                                class="block text-[11px] text-textmuted dark:text-textmuted/50">gracemitchell79@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    Velvet Throw Blanket
                                                </td>
                                                <td class="text-center">
                                                    2
                                                </td>
                                                <td class="text-center">
                                                    $29.99
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-primarytint2color/10 text-primarytint2color">Success</span>
                                                </td>
                                                <td>
                                                    12,May 2024
                                                </td>
                                                <td>
                                                    <div class="ti-btn-list">
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-success"><i
                                                                class="ri-pencil-line"></i></button>
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger"><i
                                                                class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkboxNoLabel32" value="" aria-label="..."
                                                        checked>
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-4">
                                                        <div class="leading-none">
                                                            <span class="avatar avatar-sm">
                                                                <img src="../assets/images/faces/14.jpg"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="block font-medium">Spencer Robin</span>
                                                            <span
                                                                class="block text-[11px] text-textmuted dark:text-textmuted/50">leophillips124@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    Aromatherapy Diffuser
                                                </td>
                                                <td class="text-center">
                                                    4
                                                </td>
                                                <td class="text-center">
                                                    $19.99
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-primarytint2color/10 text-primarytint2color">Success</span>
                                                </td>
                                                <td>
                                                    15,Aug 2024
                                                </td>
                                                <td>
                                                    <div class="ti-btn-list">
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-success"><i
                                                                class="ri-pencil-line"></i></button>
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger"><i
                                                                class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border !border-defaultborder dark:!border-defaultborder/10">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkboxNoLabel2" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-4">
                                                        <div class="leading-none">
                                                            <span class="avatar avatar-sm">
                                                                <img src="../assets/images/faces/3.jpg"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="block font-medium">Chloe Lewis</span>
                                                            <span
                                                                class="block text-[11px] text-textmuted dark:text-textmuted/50">chloelewis67@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    Insulated Water Bottle
                                                </td>
                                                <td class="text-center">
                                                    2
                                                </td>
                                                <td class="text-center">
                                                    $14.99
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-primarytint3color/10 text-primarytint3color">Pending</span>
                                                </td>
                                                <td>
                                                    11,Oct 2024
                                                </td>
                                                <td>
                                                    <div class="ti-btn-list">
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-success"><i
                                                                class="ri-pencil-line"></i></button>
                                                        <button
                                                            class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger"><i
                                                                class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <div class="col-span-3">

            @include('modules.calendar.sales')

            <div class="xxl:col-span-12 xl:col-span-12 col-span-12">
                <div class="box overflow-hidden">
                    <div class="box-header pb-0 justify-between">
                        <div class="box-title">
                            Order Statistics
                        </div>
                        <div class="ti-dropdown hs-dropdown">
                            <a aria-label="anchor" href="javascript:void(0);"
                                class="ti-btn ti-btn-light ti-btn-sm ti-btn-icon text-textmuted dark:text-textmuted/50 hs-dropdown-toggle ti-dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                                <li class="ti-dropdown-item"><a href="javascript:void(0);">Today</a></li>
                                <li class="ti-dropdown-item"><a href="javascript:void(0);">This Week</a></li>
                                <li class="ti-dropdown-item"><a href="javascript:void(0);">Last Week</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-body py-4 px-3">
                        <div class="flex gap-4 mb-3">
                            <div class="avatar avatar-md bg-primary/10 !w-[3rem]">
                                <i class="ti ti-trending-up text-[1.25rem] text-primary"></i>
                            </div>
                            <div class="flex-auto flex items-start justify-between w-full flex-wrap">
                                <div>
                                    <span class="text-[11px] mb-1 block font-medium">TOTAL ORDERS</span>
                                    <div class="flex items-center justify-between">
                                        <h4 class="mb-0 flex items-center">3,736<span
                                                class="text-success text-xs ms-2 inline-flex items-center"><i
                                                    class="ti ti-trending-up align-middle me-1"></i>0.57%</span></h4>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="text-success text-xs decoration-solid">Earnings
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
            {{-- <div class="grid grid-cols-12 gap-x-6">


                <div class="sm:col-span-12 xl:col-span-12 col-span-12">

                    <div class="box pt-3">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        fill="#000000" viewBox="0 0 256 256">
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

                        <hr class="mt-3">

                    </div>
                </div>



            </div> --}}


        </div>
    </div>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
            <div class="box overflow-hidden">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Latest Transactions
                    </div>
                    <a href="javascript:void(0);"
                        class="ti-btn ti-btn-light btn-wave text-textmuted dark:text-textmuted/50 ti-btn-sm">View All<i
                            class="ti ti-arrow-narrow-right"></i></a>
                </div>
                <div class="box-body p-0 pb-1">
                    <div class="table-responsive">
                        @php
                            $products = [
                                [
                                    'name' => 'Heavy-Duty Mop',
                                    'price' => '$18.99',
                                    'status' => 'In Stock',
                                    'status_class' => 'bg-primary',
                                    'img' => '../assets/images/ecommerce/jpg/4.jpg',
                                ],
                                [
                                    'name' => 'Latex Gloves (Box)',
                                    'price' => '$7.50',
                                    'status' => 'Pending',
                                    'status_class' => 'bg-primarytint1color',
                                    'img' => '../assets/images/ecommerce/jpg/4.jpg',
                                ],
                                [
                                    'name' => 'Disinfectant Spray',
                                    'price' => '$5.25',
                                    'status' => 'Out of Stock',
                                    'status_class' => 'bg-primarytint2color',
                                    'img' => '../assets/images/ecommerce/jpg/4.jpg',
                                ],
                                [
                                    'name' => 'Cleaning Cart',
                                    'price' => '$159.00',
                                    'status' => 'In Stock',
                                    'status_class' => 'bg-primarytint3color',
                                    'img' => '../assets/images/ecommerce/jpg/4.jpg',
                                ],
                                [
                                    'name' => 'Floor Cleaner (1L)',
                                    'price' => '$3.95',
                                    'status' => 'In Stock',
                                    'status_class' => 'bg-secondary',
                                    'img' => '../assets/images/ecommerce/jpg/4.jpg',
                                ],
                                [
                                    'name' => 'Industrial Trash Bags',
                                    'price' => '$12.50',
                                    'status' => 'In Stock',
                                    'status_class' => 'bg-warning',
                                    'img' => '../assets/images/ecommerce/jpg/4.jpg',
                                    'no_border' => true,
                                ],
                            ];
                        @endphp

                        <table class="ti-custom-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td @if (!empty($item['no_border'])) class="border-b-0" @endif>
                                            <div class="flex items-center gap-2">
                                                <div class="leading-none">
                                                    <span class="avatar avatar-sm">
                                                        <img src="{{ $item['img'] }}" alt="">
                                                    </span>
                                                </div>
                                                <div class="font-medium">{{ $item['name'] }}</div>
                                            </div>
                                        </td>
                                        <td @if (!empty($item['no_border'])) class="border-b-0" @endif>
                                            <span class="font-medium">{{ $item['price'] }}</span>
                                        </td>
                                        <td @if (!empty($item['no_border'])) class="border-b-0" @endif>
                                            <span
                                                class="badge {{ $item['status_class'] }}">{{ $item['status'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Recent Activity
                    </div>
                    <a href="javascript:void(0);"
                        class="ti-ti-btn ti-btn-light btn-wave   text-textmuted dark:text-textmuted/50 waves-effect waves-light px-2 py-[0.26rem]">View
                        All</a>
                </div>
                <div class="box-body">
                    <ul class="list-none recent-activity-list">
                        <li>
                            <div>
                                <div>
                                    <div class="font-medium text-[14px]">John Doe</div>
                                    <span class="text-xs activity-time">
                                        12 Hrs
                                    </span>
                                </div>
                                <span class="block text-textmuted dark:text-textmuted/50">
                                    Updated the product description for <br> <span
                                        class="text-primary font-medium">Widget X</span>.
                                </span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div>
                                    <div class="font-medium text-[14px]">Jane Smith</div>
                                    <span class="text-xs activity-time">
                                        4:32pm
                                    </span>
                                </div>
                                <span class="block text-textmuted dark:text-textmuted/50">
                                    added a <span class="font-medium text-dark">new user</span> with username <span
                                        class="font-medium text-primarytint1color">janesmith89.</span>
                                </span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div>
                                    <div class="font-medium text-[14px]">Michael Brown</div>
                                    <span class="text-xs activity-time">
                                        11:45am
                                    </span>
                                </div>
                                <span class="block text-textmuted dark:text-textmuted/50">
                                    Changed the status of order <a href="javascript:void(0);"
                                        class="font-medium text-dark decoration-solid">#12345</a> to <span
                                        class="font-medium text-primarytint2color">Shipped.</span>
                                </span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div>
                                    <div class="font-medium text-[14px]">David Wilson</div>
                                    <span class="text-xs activity-time">
                                        9:27am
                                    </span>
                                </div>
                                <span class="block text-textmuted dark:text-textmuted/50">
                                    added <span class="font-medium text-primarytint3color">John Smith</span> to academy
                                    group this day.
                                </span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div>
                                    <div class="font-medium text-[14px]">Robert Jackson</div>
                                    <span class="text-xs activity-time">
                                        8:56pm
                                    </span>
                                </div>
                                <span class="block text-textmuted dark:text-textmuted/50">
                                    added a comment to the task <span class="font-medium text-secondary">Update website
                                        layout.</span>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Sales Statistics
                    </div>
                    <div class="ti-dropdown hs-dropdown">
                        <a href="javascript:void(0);"
                            class="ti-ti-btn ti-btn-light text-textmuted dark:text-textmuted/50 ti-dropdown-toggle gap-0 hs-dropdown-toggle px-2 py-[0.26rem]"
                            data-bs-toggle="dropdown" aria-expanded="true"> Sort By <i
                                class="ri-arrow-down-s-line align-middle ms-1 inline-block"></i></a>
                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu"
                            data-popper-placement="bottom-end">
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">This Week</a></li>
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Last Week</a></li>
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">This Month</a></li>
                        </ul>
                    </div>
                </div>
                <div class="box-body">
                    <div class="flex flex-wrap gap-2 justify-between flex-auto pb-3">
                        <div
                            class="py-4 px-6 rounded-sm border border-defaultborder dark:border-defaultborder/10 border-dashed bg-light">
                            <span>Total Sales</span>
                            <p class="font-medium text-[14px] mb-0">$3.478B</p>
                        </div>
                        <div
                            class="py-4 px-6 rounded-sm border border-defaultborder dark:border-defaultborder/10 border-dashed bg-light">
                            <span>This Year</span>
                            <p class="text-success font-medium text-[14px] mb-0">4,25,349</p>
                        </div>
                        <div
                            class="py-4 px-6 rounded-sm border border-defaultborder dark:border-defaultborder/10 border-dashed bg-light">
                            <span>Last Year</span>
                            <p class="text-danger font-medium text-[14px] mb-0">3,41,622</p>
                        </div>
                    </div>
                    <div id="sales-statistics"></div>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-3 xl:col-span-6 col-span-12">
            <div class="box overflow-hidden">
                <div class="box-header pb-0 justify-between">
                    <div class="box-title">
                        Overall Statistics
                    </div>
                    <a href="javascript:void(0);"
                        class="ti-ti-btn ti-btn-light btn-wave text-textmuted dark:text-textmuted/50 waves-effect waves-light gap-0 px-2 py-[0.26rem]">View
                        All</a>
                </div>
                <div class="box-body">
                    <ul class="ti-list-group activity-feed">
                        <li class="ti-list-group-item !m-0">
                            <div class="flex items-center justify-between">
                                <div class="leading-none">
                                    <p class="mb-2 text-[13px] text-textmuted dark:text-textmuted/50">Total Expenses
                                    </p>
                                    <h6 class="font-medium mb-0">$134,032<span
                                            class="text-xs text-success ms-2 font-normal inline-block">0.45%<i
                                                class="ti ti-trending-up mx-1"></i></span></h6>
                                </div>
                                <div class="text-end">
                                    <div id="line-graph1"></div>
                                    <a href="javascript:void(0);" class="text-xs">
                                        <span>See more</span>
                                        <span class="table-icon"><i
                                                class="ms-1 inline-block ri-arrow-right-line"></i></span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="ti-list-group-item !m-0">
                            <div class="flex items-center justify-between">
                                <div class="leading-none">
                                    <p class="mb-2 text-[13px] text-textmuted dark:text-textmuted/50">General Leads</p>
                                    <h6 class="font-medium mb-0">74,354<span
                                            class="text-xs text-danger ms-2 font-normal inline-block">3.84%<i
                                                class="ti ti-trending-down mx-1"></i></span></h6>
                                </div>
                                <div class="text-end">
                                    <div id="line-graph2"></div>
                                    <a href="javascript:void(0);" class="text-xs">
                                        <span>See more</span>
                                        <span class="table-icon"><i
                                                class="ms-1 inline-block ri-arrow-right-line"></i></span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="ti-list-group-item !m-0">
                            <div class="flex items-center justify-between">
                                <div class="leading-none">
                                    <p class="mb-2 text-[13px] text-textmuted dark:text-textmuted/50">Churn Rate</p>
                                    <h6 class="font-medium mb-0">6.02%<span
                                            class="text-xs text-success ms-2 font-normal inline-block">0.72%<i
                                                class="ti ti-trending-up mx-1"></i></span></h6>
                                </div>
                                <div class="text-end">
                                    <div id="line-graph3"></div>
                                    <a href="javascript:void(0);" class="text-xs">
                                        <span>See more</span>
                                        <span class="table-icon"><i
                                                class="ms-1 inline-block ri-arrow-right-line"></i></span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="ti-list-group-item !m-0">
                            <div class="flex items-center justify-between">
                                <div class="leading-none">
                                    <p class="mb-2 text-[13px] text-textmuted dark:text-textmuted/50">New Users</p>
                                    <h6 class="font-medium mb-0">7,893<span
                                            class="text-xs text-success ms-2 font-normal inline-block">11.05%<i
                                                class="ti ti-trending-up mx-1"></i></span></h6>
                                </div>
                                <div class="text-end">
                                    <div id="line-graph4"></div>
                                    <a href="javascript:void(0);" class="text-xs">
                                        <span>See more</span>
                                        <span class="table-icon"><i
                                                class="ms-1 inline-block ri-arrow-right-line"></i></span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="ti-list-group-item !m-0">
                            <div class="flex items-center justify-between">
                                <div class="leading-none">
                                    <p class="mb-2 text-[13px] text-textmuted dark:text-textmuted/50">Returning Users
                                    </p>
                                    <h6 class="font-medium mb-0">3,258<span
                                            class="text-xs text-success ms-2 font-normal inline-block">1.69%<i
                                                class="ti ti-trending-up mx-1"></i></span></h6>
                                </div>
                                <div class="text-end">
                                    <div id="line-graph5"></div>
                                    <a href="javascript:void(0);" class="text-xs">
                                        <span>See more</span>
                                        <span class="table-icon"><i
                                                class="ms-1 inline-block ri-arrow-right-line"></i></span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-4 col-span-12">
            @php
                $projects = [
                    [
                        'title' => 'Disinfection Service - Office 12F',
                        'info' => 'Full-room sanitation including door handles, switches, and air vents.',
                        'status_text' => '75% completed',
                        'status_color' => 'text-success',
                        'progress_value' => 75,
                        'progress_bar_class' => 'progress-bar-striped progress-bar-animated !rounded-full',
                        'progress_bg' => 'bg-primary/10',
                        'avatar_list' => ['11.jpg', '2.jpg', '5.jpg', '6.jpg'],
                        'time' => '2mins ago',
                    ],
                    [
                        'title' => 'Deep Carpet Cleaning - Lobby',
                        'info' => 'Scheduled rug shampooing with drying by industrial blower.',
                        'status_text' => '45% completed',
                        'status_color' => 'text-warning',
                        'progress_value' => 45,
                        'progress_bar_class' =>
                            'bg-primarytint1color progress-bar-striped progress-bar-animated !rounded-full',
                        'progress_bg' => 'bg-primarytint1color/10',
                        'avatar_list' => ['11.jpg', '8.jpg', '2.jpg'],
                        'time' => '15mins ago',
                    ],
                    [
                        'title' => 'Window Washing - Exterior Panels',
                        'info' => 'Safety equipment prepared. Upper floor cleaning ongoing.',
                        'status_text' => '65% completed',
                        'status_color' => 'text-success',
                        'progress_value' => 65,
                        'progress_bar_class' =>
                            'bg-primarytint2color progress-bar-striped progress-bar-animated !rounded-full',
                        'progress_bg' => 'bg-primarytint2color/10',
                        'avatar_list' => ['15.jpg', '3.jpg'],
                        'extra_avatar' => '2+',
                        'time' => '20mins ago',
                    ],
                ];
            @endphp

            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">Running Projects List</div>
                    <button type="button" class="ti-btn ti-btn-sm bg-primary/10 text-primary">View All</button>
                </div>

                @foreach ($projects as $proj)
                    <div class="p-4">
                        <div class="flex items-start gap-4 mb-3">
                            <div class="grow">
                                <div class="flex items-center gap-1">
                                    <p class="font-medium mb-1 text-[14px]">{{ $proj['title'] }}</p>
                                    <div class="hs-tooltip ti-main-tooltip">
                                        <a href="javascript:void(0);" class="text-info">
                                            <i
                                                class="ri-information-2-line text-[13px] opacity-70 leading-none align-middle mb-1"></i>
                                            <span
                                                class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-black !text-xs !font-medium !text-white shadow-sm"
                                                role="tooltip">Get Info</span>
                                        </a>
                                    </div>
                                </div>
                                <p class="text-textmuted dark:text-textmuted/50 mb-1 text-xs">{{ $proj['info'] }}</p>
                                <div>Status: <span
                                        class="{{ $proj['status_color'] }} font-medium text-xs">{{ $proj['status_text'] }}</span>
                                </div>
                            </div>

                            <div class="flex-shrink-0 text-end ms-auto">
                                <p class="mb-3 text-[11px] text-textmuted dark:text-textmuted/50">
                                    <i class="ri-time-line text-[11px] me-1"></i>{{ $proj['time'] }}
                                </p>
                                <div class="avatar-list-stacked">
                                    @foreach ($proj['avatar_list'] as $avatar)
                                        <span class="avatar avatar-sm avatar-rounded">
                                            <img src="../assets/images/faces/{{ $avatar }}" alt="img">
                                        </span>
                                    @endforeach
                                    @if (isset($proj['extra_avatar']))
                                        <a class="avatar avatar-sm bg-primary border-2 avatar-rounded text-white"
                                            href="javascript:void(0);">{{ $proj['extra_avatar'] }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="progress progress-lg !rounded-full p-1 ms-auto flex-auto {{ $proj['progress_bg'] }}"
                                role="progressbar" aria-valuenow="{{ $proj['progress_value'] }}" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar {{ $proj['progress_bar_class'] }}"
                                    style="width: {{ $proj['progress_value'] }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="xxl:col-span-3 lg:col-span-6 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">Monthly Targets</div>
                    <a href="javascript:void(0);" class="ti-btn ti-btn-sm bg-light">View All</a>
                </div>
                <div class="box-body">
                    <div id="monthly-target">
                    </div>
                    <div class="flex gap-4 items-center justify-between text-center p-4 bg-light rounded-md">
                        <div>
                            <span class="mb-1 block"><i
                                    class="ri-circle-fill text-[8px] align-middle leading-none text-primary"></i> New
                                Projects</span>
                            <h6 class="mb-1">4,896</h6>
                            <span class="text-success font-medium"><i class="ri-arrow-up-s-fill"></i> 3.5%</span>
                        </div>
                        <div>
                            <span class="mb-1 block"><i
                                    class="ri-circle-fill text-[8px] align-middle leading-none text-primarytint1color"></i>
                                Completed</span>
                            <h6 class="mb-1">2,475</h6>
                            <span class="text-danger font-medium"><i class="ri-arrow-down-s-fill"></i> 1.5%</span>
                        </div>
                        <div>
                            <span class="mb-1 block"><i
                                    class="ri-circle-fill text-[8px] align-middle leading-none text-primarytint2color"></i>
                                Pending</span>
                            <h6 class="mb-1">456</h6>
                            <span class="text-success font-medium"><i class="ri-arrow-up-s-fill"></i> 0.1%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-5 lg:col-span-6 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Daily Tasks
                    </div>
                    <div class="ti-dropdown hs-dropdown">
                        <a href="javascript:void(0);" class="ti-btn ti-btn-sm bg-light" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            View All<i class="ri-arrow-down-s-line align-middle ms-1 inline-block"></i>
                        </a>
                        <ul class="ti-dropdown-menu hs-dropdown-menu hidden" role="menu">
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Download</a></li>
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Import</a></li>
                            <li><a class="ti-dropdown-item" href="javascript:void(0);">Export</a></li>
                        </ul>
                    </div>
                </div>
                <?php
                $tasks = [
                    [
                        'time' => '06:30 AM',
                        'title' => 'Restroom Sanitization',
                        'info' => ['Disinfectant', 'Checklist', 'Assigned Staff'],
                        'bg' => 'bg-primary/10',
                        'border' => 'border-primary/25',
                        'text_color' => 'text-primary',
                        'avatars' => ['2.jpg', '12.jpg', '8.jpg'],
                    ],
                    [
                        'time' => '08:00 AM',
                        'title' => 'Window Glass Cleaning - Lobby',
                        'info' => ['Glass Cleaner', 'Wiper Kit'],
                        'bg' => 'bg-primarytint1color/10',
                        'border' => 'border-primarytint1color/25',
                        'text_color' => 'text-primarytint1color',
                        'avatars' => ['11.jpg', '4.jpg'],
                    ],
                    [
                        'time' => '11:15 AM',
                        'title' => 'Carpet Vacuuming - 2F',
                        'info' => ['Industrial Vacuum', 'Safety Signs'],
                        'bg' => 'bg-primarytint2color/10',
                        'border' => 'border-primarytint2color/25',
                        'text_color' => 'text-primarytint2color',
                        'avatars' => ['7.jpg', '1.jpg', '3.jpg'],
                    ],
                    [
                        'time' => '03:30 PM',
                        'title' => 'Trash Collection - Entire Floor',
                        'info' => ['Bin Replacement', 'Gloves'],
                        'bg' => 'bg-primarytint3color/10',
                        'border' => 'border-primarytint3color/25',
                        'text_color' => 'text-primarytint3color',
                        'avatars' => ['2.jpg', '12.jpg', '8.jpg'],
                    ],
                ];
                ?>

                <div class="box-body">
                    <ul class="ti-list-group ti-list-group-flush list-none">
                        <?php foreach ($tasks as $task): ?>
                        <li class="ti-list-group-item !border-b-0 flex gap-4 !p-0 items-start mb-2">
                            <div class="flex-shrink-0 daily-tasks-time">
                                <span
                                    class="text-textmuted dark:text-textmuted/50 ms-auto text-[11px]"><?= $task['time'] ?></span>
                            </div>
                            <div class="box border <?= $task['border'] ?> shadow-none mb-0 <?= $task['bg'] ?> w-full">
                                <div class="box-body">
                                    <div class="flex items-center gap-2 justify-between">
                                        <p class="font-medium mb-2 leading-none"><?= $task['title'] ?></p>
                                        <div class="hs-tooltip ti-main-tooltip">
                                            <a href="javascript:void(0);"
                                                class="float-end text-[1rem] <?= $task['text_color'] ?>">
                                                <i class="ri-add-circle-fill"></i>
                                                <span
                                                    class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-black !text-xs !font-medium !text-white shadow-sm"
                                                    role="tooltip">
                                                    View Details
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-2 items-center">
                                        <?php foreach ($task['info'] as $tag): ?>
                                        <span class="badge leading-none bg-info/10 text-info"><?= $tag ?></span>
                                        <?php endforeach; ?>
                                        <div class="avatar-list-stacked ms-auto">
                                            <?php foreach ($task['avatars'] as $avatar): ?>
                                            <span class="avatar avatar-xs avatar-rounded">
                                                <img src="../assets/images/faces/<?= $avatar ?>" alt="img">
                                            </span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- End:: row-2 -->

    <!-- Start:: row-3 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-9 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Projects Summary
                    </div>
                    <div class="flex flex-wrap">
                        <div class="me-3 my-1">
                            <input class="form-control form-control-sm" type="text" placeholder="Search Here"
                                aria-label=".form-control-sm example">
                        </div>
                        <div class="ti-dropdown hs-dropdown my-1">
                            <a href="javascript:void(0);"
                                class="ti-btn bg-primary !m-0 text-white ti-btn-sm ti-dropdown-toggle hs-dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
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
                    @php
                        $janitorialProjects = [
                            [
                                'title' => 'Office Floor Cleaning',
                                'tasks_done' => 30,
                                'tasks_total' => 50,
                                'progress' => 60,
                                'avatars' => ['8.jpg', '4.jpg', '6.jpg'],
                                'status' => ['label' => 'In Progress', 'class' => 'bg-primary/10 text-primary'],
                                'due_date' => '2025-08-10',
                            ],
                            [
                                'title' => 'Restroom Sanitization',
                                'tasks_done' => 25,
                                'tasks_total' => 25,
                                'progress' => 100,
                                'avatars' => ['8.jpg', '4.jpg'],
                                'status' => ['label' => 'Completed', 'class' => 'bg-success/10 text-success'],
                                'due_date' => '2025-07-30',
                            ],
                            [
                                'title' => 'Window Washing - HQ Building',
                                'tasks_done' => 10,
                                'tasks_total' => 20,
                                'progress' => 50,
                                'avatars' => ['6.jpg', '7.jpg', '16.jpg'],
                                'status' => ['label' => 'In Progress', 'class' => 'bg-primary/10 text-primary'],
                                'due_date' => '2025-08-12',
                            ],
                            [
                                'title' => 'Warehouse Disinfection',
                                'tasks_done' => 0,
                                'tasks_total' => 40,
                                'progress' => 0,
                                'avatars' => ['8.jpg', '14.jpg'],
                                'status' => ['label' => 'Pending', 'class' => 'bg-warning/10 text-warning'],
                                'due_date' => '2025-08-15',
                            ],
                            [
                                'title' => 'Carpet Deep Cleaning',
                                'tasks_done' => 45,
                                'tasks_total' => 50,
                                'progress' => 90,
                                'avatars' => ['8.jpg', '4.jpg', '16.jpg', '14.jpg'],
                                'status' => ['label' => 'In Progress', 'class' => 'bg-primary/10 text-primary'],
                                'due_date' => '2025-08-05',
                            ],
                            [
                                'title' => 'Parking Lot Sweeping',
                                'tasks_done' => 12,
                                'tasks_total' => 20,
                                'progress' => 60,
                                'avatars' => ['21.jpg', '11.jpg', '6.jpg'],
                                'status' => ['label' => 'In Progress', 'class' => 'bg-primary/10 text-primary'],
                                'due_date' => '2025-08-18',
                            ],
                        ];
                    @endphp


                    <div class="table-responsive overflow-auto table-bordered-default">
                        <table class="ti-custom-table text-nowrap">
                            <thead>
                                <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                    <th>S.No</th>
                                    <th>Project Title</th>
                                    <th>Tasks</th>
                                    <th>Progress</th>
                                    <th>Assigned Team</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($janitorialProjects as $index => $project)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><span class="font-medium">{{ $project['title'] }}</span></td>
                                        <td>{{ $project['tasks_done'] }} <span class="opacity-70">/
                                                {{ $project['tasks_total'] }}</span></td>
                                        <td>
                                            <div class="flex items-center">
                                                <div class="progress progress-sm w-full" role="progressbar"
                                                    aria-valuenow="{{ $project['progress'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ $project['progress'] }}%"></div>
                                                </div>
                                                <div class="ms-2">{{ $project['progress'] }}%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-list-stacked">
                                                @foreach ($project['avatars'] as $avatar)
                                                    <span class="avatar avatar-xs avatar-rounded">
                                                        <img src="../assets/images/faces/{{ $avatar }}"
                                                            alt="img">
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge leading-none {{ $project['status']['class'] }}">
                                                {{ $project['status']['label'] }}
                                            </span>
                                        </td>
                                        <td>{{ $project['due_date'] }}</td>
                                        <td>
                                            <div class="btn-list">
                                                @foreach (['eye' => 'View', 'pencil' => 'Edit', 'trash' => 'Delete'] as $icon => $label)
                                                    <div class="hs-tooltip ti-main-tooltip [--placement:top]">
                                                        <a href="javascript:void(0);"
                                                            class="hs-tooltip-toggle ti-btn ti-btn-icon ti-btn-sm !rounded-full me-2 ti-btn-soft-{{ $icon == 'eye' ? 'primary' : ($icon == 'pencil' ? 'secondary' : 'danger') }} !m-0">
                                                            <i class="ti ti-{{ $icon }}"></i>
                                                            <span
                                                                class="hs-tooltip-content ti-main-tooltip-content py-1 px-2 !bg-black !text-xs !font-medium !text-white shadow-sm dark:bg-slate-700"
                                                                role="tooltip">
                                                                {{ $label }}
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a>
                                    </li>

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
        <div class="xxl:col-span-3 col-span-12">
            <div class="box overflow-hidden">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Task Summary
                    </div>
                    <a href="javascript:void(0);" class="ti-btn ti-btn-sm bg-light">View All</a>
                </div>
                <div class="box-body">
                    <div class="flex gap-4 items-center justify-between p-4 bg-light mb-4 rounded-md">
                        <div>
                            <h6 class="mb-1">Tasks Completed Rate</h6>
                            <p class="mb-0 text-textmuted dark:text-textmuted/50">Within the Deadline</p>
                        </div>
                        <div>
                            <h5 class="mb-0">85%<span
                                    class="badge leading-none bg-success text-white font-medium text-[8px] ms-2"><i
                                        class="ri-arrow-up-s-fill"></i> 1.5%</span></h5>
                        </div>
                    </div>
                    <div id="tasks-report">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End::Row-1 -->

    <!-- Start::Row-2 -->
    <div class="grid grid-cols-12 gap-x-6">

        <div class="xxl:col-span-9 col-span-12">

        </div>

    </div>

    @include('pages.members.payment.modal')

    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/js/courses-dashboard.js"></script>

    <!-- Apex Charts JS -->
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Sales Dashboard -->
    <script src="/assets/js/sales-dashboard.js"></script>
    <!-- Projects Dashboard -->
    <script src="/assets/js/projects-dashboard.js"></script>

</x-app-layout>
