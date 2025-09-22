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
    <x-slot name="buttons">
        <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#purchase">
            <i class="bi bi-cart-plus-fill me-1"></i> Purchase VA Credit Hours
        </button>
    </x-slot>


    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-4 col-span-12">

            <div class="sm:col-span-6 xl:col-span-6 col-span-12">
                <div class="box overflow-hidden main-content-card">
                    <div class="box-body">
                        <div class="flex items-start justify-between ">
                            <div>
                                @php
                                    $client_count = 0;
                                    $project_count = 0;
                                @endphp
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
            <div class="grid grid-cols-12 gap-x-6">
                <div class="col-span-6">
                    <div class="box overflow-hidden  main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-warning svg-white avatar-rounded">
                                <i class="bi bi-people text-[20px]"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">Total Clients</p>
                            @php
                                //$client_count = App\Models\Clients::where('lead_id', $id)->count();
                            @endphp
                            <h4 class="font-semibold mb-1">{{ $client_count }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="box overflow-hidden  main-content-card">
                        <div class="box-body text-center">
                            <span class="avatar avatar-md bg-primarytint3color svg-white avatar-rounded">
                                <i class="bi bi-hammer text-[20px]"></i>
                            </span>
                            <p class="mb-1 mt-3 font-medium">Total Projects</p>
                            @php
                                //$project_count = App\Models\ProjectBidding::where('client_id', $id)->count();
                            @endphp
                            <h4 class="font-semibold mb-1">{{ $project_count }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xxl:col-span-3 col-span-12">
                <div class="box">
                    <div class="box-header justify-between">
                        <div class="box-title">
                            <span class="bi bi-pin-angle mx-1"></span>
                            Upcoming Tasks
                        </div>

                        @if (session('connect_google'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'question',
                                        title: 'Connect Google Account?',
                                        html: `This email is registered but not connected to Google login.<br><br>
                       Do you want to link this Google account to <b>{{ session('connect_google.email') }}</b>?`,
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, Connect',
                                        cancelButtonText: 'Cancel'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Redirect to connect route
                                            window.location.href =
                                                '{{ route('google.connect', [
                                                    'email' => session('connect_google.email'),
                                                    'google_id' => session('connect_google.google_id'),
                                                    'avatar' => session('connect_google.avatar'),
                                                ]) }}';
                                        }
                                    });
                                });
                            </script>
                        @endif
                        <div>
                            <button type="button" class="ti-btn ti-btn-sm ti-btn-light">Connect Goggle Account</button>
                        </div>
                    </div>
                    <div class="box-body" style="min-height: 470px">
                        <hr class=" mb-4">


                        <table class="min-w-full table-auto  table-bordered border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="border border-gray-300 p-2 w-8">Done</th>
                                    <th class="border border-gray-300 p-2">Title</th>
                                    <th class="border border-gray-300 p-2 w-20">Status</th>
                                </tr>
                            </thead>
                            <tbody id="task-list">
                                @php
                                    $tasks = App\Models\V3_Task::with(['subtasks', 'users'])
                                        ->where('isDeleted', 0)
                                        ->where('user_id', Auth::id())
                                        ->get();
                                @endphp
                                @foreach ($tasks as $task)
                                    <tr data-id="{{ $task->id }}" class="border border-gray-300">

                                        {{-- Checkbox --}}
                                        <td class="p-0 text-center">
                                            <input type="checkbox" class="form-check-input mx-3"
                                                {{ $task->status === 'completed' ? 'checked' : '' }}
                                                onchange="toggleTaskStatus(this, {{ $task->id }})" />
                                        </td>

                                        {{-- Title --}}
                                        <td class="p-0">
                                            <input type="text" class="w-full border-none"
                                                value="{{ $task->title }}"
                                                onblur="saveTask(this, {{ $task->id }})" />
                                        </td>

                                        {{-- Status --}}
                                        <td class="p-2 {{ getStatusTextColor($task->status) }}">
                                            @php
                                                $statusText = [
                                                    'pending' => 'Pending',
                                                    'completed' => 'Completed',
                                                    'in_progress' => 'In Progress',
                                                ];
                                            @endphp
                                            {{ $statusText[$task->status] ?? $task->status }}
                                        </td>
                                @endforeach
                            </tbody>
                        </table>


                        {{-- @php
                            $notes = App\Models\Task::latest()->get();
                        @endphp

                        @if ($notes->count())
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <thead class="bg-gray-100 text-gray-700 text-sm">
                                        <tr>
                                            <th class="px-4 py-2 text-left ">Task</th>
                                            <th class="px-4 py-2 text-left">Status</th>
                                            <th class="px-4 py-2 text-left">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" text-xs">
                                        @foreach ($notes as $note)
                                            <tr class="border-t hover:bg-gray-50 transition">
                                                <td class="px-4 py-2 font-medium text-gray-800">
                                                    {{ $note->task_name }}</td>
                                                @php
                                                    $statusClasses = match ($note->status) {
                                                        'In Progress' => 'text-primary',
                                                        'Completed' => 'text-success',
                                                        'Pending' => 'text-warning',
                                                        default => 'text-gray-500',
                                                    };
                                                @endphp

                                                <td class="px-4 py-2 font-medium {{ $statusClasses }}">
                                                     <i class="ri-circle-fill {{ $statusClasses }} mx-2 text-[0.5625rem]"></i>
                                                    {{ $note->status }}
                                                </td>

                                                <td class="px-4 py-2 text-xs text-gray-500">
                                                    {{ $note->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 italic">No task yet. Start by adding a note on the left.
                            </p>
                        @endif --}}

                        {{-- <p class="text-danger text-center">No Task Available Yet!</p> --}}
                        <hr class="mt-4 mb-4">
                        {{-- @include('pages.clients.dashboard_task') --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="xxl:col-span-8 col-span-12">

            <div class="grid grid-cols-12 gap-x-6">


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



            </div>
            <div class="box shadow-none border custom-box">
                <div class="box-body overflow-y-auto">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div>
                            <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                                <strong>Dashboard</strong>
                            </h6>
                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                You can monitor your overall records here.
                            </span>
                        </div>
                    </div>
                    <hr class="mb-3 !mt-3">
                    <div class="sm:border-b-2 border-gray-200 dark:border-white/10">
                        <nav class="-mb-0.5 sm:flex sm:space-x-6 rtl:space-x-reverse" role="tablist">
                            @php
                                $tabs = [
                                    ['id' => 'icon-privilege', 'icon' => 'bi-calendar-event', 'label' => 'Calendar'],
                                    ['id' => 'icon-coins', 'icon' => 'bi-coin', 'label' => 'Profit Tracker'],
                                    ['id' => 'icon-hammer', 'icon' => 'bi-hammer', 'label' => 'Project Management'],
                                    [
                                        'id' => 'icon-kanban',
                                        'icon' => 'bi-person-bounding-box',
                                        'label' => 'Customer Relationship',
                                    ],
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
                            <div id="{{ $tab['id'] }}" class="{{ $index === 0 ? '' : 'hidden' }}"
                                role="tabpanel" aria-labelledby="icon-item-{{ $index + 1 }}">
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

            {{-- @include('modules.calendar.widget') --}}
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[data-hs-tab]');
            const tabPanels = document.querySelectorAll('[role="tabpanel"]');
            
            const savedTab = localStorage.getItem('dashboard-active-tab');
            
            if (savedTab) {
                const savedTabElement = document.querySelector(`[data-hs-tab="${savedTab}"]`);
                const savedPanelElement = document.querySelector(savedTab);
                
                if (savedTabElement && savedPanelElement) {
                    tabs.forEach(tab => {
                        tab.classList.remove('active', 'hs-tab-active:font-semibold', 'hs-tab-active:border-primary', 'hs-tab-active:text-primary');
                        tab.classList.add('hs-tab-active:font-semibold', 'hs-tab-active:border-primary', 'hs-tab-active:text-primary');
                    });
                    tabPanels.forEach(panel => {
                        panel.classList.add('hidden');
                    });
                    
                    // Activate saved tab and panel
                    savedTabElement.classList.add('active');
                    savedPanelElement.classList.remove('hidden');
                }
            }
            
            // Add click event listeners to save tab selection
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-hs-tab');
                    localStorage.setItem('dashboard-active-tab', targetTab);
                });
            });
        });
    </script>


</x-app-layout>
