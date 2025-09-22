<x-app-layout>

    @php
        $lead = App\Models\Lead::where('email', Auth::user()->email)
            ->select('id')
            ->first();

        if (Auth::user()->role == 'Virtual Assistant') {
            $id = Auth::user()->company;
        }elseif (Auth::user()->role == 'Sub-Client') { 
            $id = 9;
        }else {
            $id = $lead->id ?? 0;
        }

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

    <x-slot name="title">Profile Settings</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Profile"}</x-slot>
    <x-slot name="active">Settings</x-slot>
    <x-slot name="buttons"></x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box profile-card">
                <div class="profile-banner-imgx">
                    <img src="/banner.png?{{ time() }}" class="card-img-bottom" alt="...">
                </div>
                <div class="box-body pb-0 relative">
                    <div class="grid grid-cols-12 sm:gap-x-6 profile-content">
                        <div class="xl:col-span-3 col-span-12">

                            <div class="box overflow-hidden border border-defaultborder dark:border-defaultborder/10">
                                <div
                                    class="box-body border-b border-dashed border-defaultborder dark:border-defaultborder/10">
                                    <div class="text-center">
                                        <center>
                                            <img src="{{ asset('storage/' . ($lead_profile->photo ?? '')) }}"
                                                style="height: 130px" alt="" class="transparent-logo mt-3 mb-5">
                                        </center>
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
                                                    class="text-textmuted dark:text-textmuted/50">{{ $lead_profile->company_name ?? '' }}</span>
                                            </div>
                                        </li>
                                        <li class="ti-list-group-item pt-2 border-0">
                                            <div><span class="font-medium me-2">Email :</span><span
                                                    class="text-textmuted dark:text-textmuted/50">{{ $lead_profile->email ?? '' }}</span>
                                            </div>
                                        </li>
                                        <li class="ti-list-group-item pt-2 border-0">
                                            <div><span class="font-medium me-2">Phone :</span><span
                                                    class="text-textmuted dark:text-textmuted/50">
                                                    {{ $lead_profile->phone ?? '' }}
                                                </span></div>
                                        </li>
                                    </ul>
                                </div>


                            </div>


                            {{-- <div class="box overflow-hidden">
                                    <div class="box-header justify-between">
                                        <div class="box-title">
                                            Documents
                                        </div>
                                    </div>
                                    <div class="box-body p-0">
                                        <ul class="ti-list-group list-group-flush !rounded-none">
                                            <li class="ti-list-group-item">
                                                <div class="flex items-center flex-wrap gap-2">
                                                    <span
                                                        class="avatar avatar-md avatar-rounded p-2 bg-light leading-none">
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
                                </div> --}}

                        </div>
                        <div class="xl:col-span-9 col-span-12">
                            <div class="box overflow-hidden border border-defaultborder dark:border-defaultborder/10"
                                style="min-height: 700px">
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
                                                role="tab">Profile Information</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link w-full text-start rounded-md"
                                                data-hs-tab="#edit-profile-tab-pane" type="button" role="tab">
                                                Update Password
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link w-full text-start rounded-md"
                                                data-hs-tab="#two-factor" type="button" role="tab">
                                                Two Factor Authentication
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link w-full text-start rounded-md"
                                                data-hs-tab="#browser-session" type="button" role="tab">
                                                Browser Sessions
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="profile-tabs">
                                        <div class="tab-pane show active p-0 border-0" id="profile-about-tab-pane"
                                            role="tabpanel">
                                            <ul class="ti-list-group list-group-flush border rounded-3">
                                                <li class="ti-list-group-item p-4">
                                                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                                        @livewire('profile.update-profile-information-form')
                                                        <x-section-border />
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane p-0 border-0 hidden" id="edit-profile-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <ul class="ti-list-group list-group-flush border rounded-3">
                                                <li class="ti-list-group-item p-4">
                                                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                                        @livewire('profile.update-password-form')
                                                        <x-section-border />
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane p-0 border-0 hidden" id="two-factor" role="tabpanel"
                                            tabindex="0">
                                            <ul class="ti-list-group list-group-flush border rounded-3">
                                                <li class="ti-list-group-item p-4">
                                                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                                        @livewire('profile.two-factor-authentication-form')
                                                        <x-section-border />
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane p-0 border-0 hidden" id="browser-session" role="tabpanel"
                                            tabindex="0">
                                            <ul class="ti-list-group list-group-flush border rounded-3">
                                                <li class="ti-list-group-item p-4">
                                                    <div class="mt-10 sm:mt-0">
                                                        @livewire('profile.logout-other-browser-sessions-form')
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
    </div>

    <script>
        function credit_type(type) {
            document.getElementById('type').value = type;
            document.getElementById('client_type').value = 'sub-client';
        }
    </script>
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/js/sales-dashboard.js"></script>
    <script src="/assets/js/crm-leads.js"></script>



    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div>
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')
        
                        <x-section-border />
                    @endif
        
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.update-password-form')
                        </div>
        
                        <x-section-border />
                    @endif
        
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.two-factor-authentication-form')
                        </div>
        
                        <x-section-border />
                    @endif
        
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>
        
                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <x-section-border />
        
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}

</x-app-layout>
