{{-- @php
    session()->put('show_welcome_modal', true);
@endphp --}}



<style>
    /* SIGNAL EFFECT (PULSING HIGHLIGHT) */
    @keyframes pulse-ring {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 102, 239, 0.5);
        }

        70% {
            box-shadow: 0 0 0 12px rgba(0, 102, 239, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(0, 102, 239, 0);
        }
    }

    /* TARGET ELEMENT BEING HIGHLIGHTED */
    .shepherd-enabled,
    .shepherd-target {
        position: relative;
        background-color: #f5f5f5;
        color: #333 !important;
        animation: pulse-ring 1.5s infinite;
        border-radius: 8px;
        z-index: 9999;
        transition: background-color 0.3s ease;
    }

    .shepherd-content button:hover {
        background-color: #e0e0e0;
    }

    .shepherd-target {

        background-color: #EEF1FF !important;
    }
</style>
<style>
    /* Soft pulse glow */
    @keyframes pulse-glow {
        0% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.55);
        }

        70% {
            box-shadow: 0 0 0 8px rgba(239, 68, 68, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
        }
    }

    /* Ensure badge is never clipped */
    .slide,
    .side-menu__item {
        overflow: visible !important;
        position: relative;
    }

    /* Icon container */
    .icon-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        padding: 0.5rem;
        background-color: #3b82f6;
        /* blue-500 */
    }

    /* Badge styling */
    .icon-badge {
        position: absolute;
        /* top: -6px;
        left: -6px; */
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        font-size: 10px;
        color: #fff;
        background-color: #dc2626;
        /* red-600 */
        border-radius: 9999px;
        animation: pulse-glow 1.6s infinite;
        z-index: 10;
    }
</style>
<aside class="app-sidebar desktop-response" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="/dashboard" class="header-logo">
            <img src="/assets/raw/logo.png" alt="logo" class="desktop-logo">
            <img src="/assets/raw/logo.png" alt="logo" class="toggle-dark">
            <img src="/assets/raw/logo.png" alt="logo" class="desktop-dark">
            <img src="/assets/raw/new.png" alt="logo" class="toggle-logo">
            <img src="/assets/raw/new.png" alt="logo" class="toggle-white">
            <img src="/assets/raw/logo.png" alt="logo" class="desktop-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar shadow-none" id="sidebar-scroll">

        @php

            // session()->get('manage_portal_id');
            // session()->get('manage_portal_email');
            // session()->get('manage_orignal_id');

            $user = Auth::user();
            $clientId = null;

            if ($user->role === 'Developer') {
                $user_info = $user;
                $lead_profile = null;
            } else {
                if (session('manage_portal_id')) {
                    $clientId = session()->get('manage_portal_id');
                    $user_info = App\Models\User::where('id', $clientId)->first();
                    $lead_profile = App\Models\Lead::where('email', $user_info->email)->first();
                } else {
                    if ($user->role === 'Virtual Assistant') {
                        $company = $user->company;
                        $clientId = $user->id;
                        $lead_profile = App\Models\Lead::where('id', $company)->first();
                        $user_info = App\Models\User::where('id', $clientId)->first();
                    } elseif ($user->role === 'Sub-Client') {
                        $clientId = App\Models\Clients::where('email', $user->email)->value('lead_id');
                        $lead_profile = App\Models\Lead::where('id', $clientId)->first();
                        $user_info = App\Models\User::where('email', $lead_profile->email)->first();
                    } else {
                        $clientId = App\Models\Lead::where('email', $user->email)->value('id');
                        $lead_profile = App\Models\Lead::where('id', $clientId)->first();
                        $user_info = App\Models\User::where('email', $lead_profile->email)->first();
                    }
                }
            }

            $id = $clientId;

            if ($user->role === 'Developer') {
                $id = $user->id;
            }

        @endphp

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-col sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <li class="slide">
                    <a href="/dashboard">
                        <style>
                            .transparent-shadow {
                                filter: drop-shadow(0px 0px 1px #FFBC58);
                            }
                        </style>
                        <center>
                            <div class="p-4 mb-2 m-3">
                                @if ($user_info->role !== 'Developer')
                                    @if ($user_info->role == 'Client')
                                        <img src="{{ asset('storage/' . $lead_profile->photo) }}"
                                            style="max-height: 100px" alt="" class="transparent-logo">
                                    @elseif ($user_info->role == 'Administrator' || $user_info->role == 'Virtual Assistant')
                                        <img src="/assets/raw/new.png" style="max-height: 150px"
                                            class="transparent-shadow">
                                    @else
                                        <img src="{{ asset('storage/' . $lead_profile->photo) }}"
                                            style="max-height: 100px" alt="" class="transparent-logo">
                                    @endif
                                @endif
                            </div>
                        </center>
                    </a>
                </li>
                <li>
                    <hr>
                </li>


                @if ($user_info->role != 'Developer')
                    <li class="slide__category" style="color: #09139c !important;">
                        <span class="category-name">Main</span>
                    </li>

                    @include('components.menu.admin')
                    @include('components.menu.client')
                    @include('components.menu.va')
                    @include('components.menu.subclient')


                    @auth
                        @php
                            // Pull allowed + active routes for the user
                            $userRoutes = auth()
                                ->user()
                                ->permissions()
                                ->where('is_allowed', true)
                                ->with('route')
                                ->get()
                                ->pluck('route')
                                ->filter(fn($r) => $r && $r->is_active);

                            // Group label fallback
                            $labelFor = fn($r) => trim($r->group_label ?? '') ?: 'General';

                            // Group, sort groups by label, and sort items inside by sort_order then title
                            $grouped = $userRoutes
                                ->groupBy($labelFor)
                                ->sortKeys() // sort groups alphabetically; remove if you prefer original order
                                ->map(fn($items) => $items->sortBy([['sort_order', 'asc'], ['title', 'asc']]));
                        @endphp

                        @foreach ($grouped as $groupLabel => $routesInGroup)
                            {{-- Group header --}}
                            <li class="slide__category">
                                <span class="category-name">{{ $groupLabel }}</span>
                            </li>

                            {{-- Group items --}}
                            @foreach ($routesInGroup as $route)
                                @php
                                    // Mark active link (simple matcher; tweak to your routing)
                                    $isActive = request()->is(ltrim($route->path, '/') . '*');
                                @endphp
                                <li class="slide">
                                    <a href="{{ $route->path }}" class="side-menu__item">
                                        <i class="w-6 h-4 side-menu__icon bi {{ $route->icon }}" style="color:#5D66F7"></i>
                                        <span class="side-menu__label">{{ $route->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                    @endauth

                    <li class="slide">
                        <a href="/tickets/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-terminal" style="color: #5D66F7"></i>
                            <span class="side-menu__label">IT Support Ticket</span>
                        </a>
                    </li>

                    <li class="slide">
                        <a href="https://swamp-revenge.hillbcs.com/" target="_blank" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-joystick" style="color: #5D66F7"></i>
                            <span class="side-menu__label">Swamp Revenge</span>
                        </a>
                    </li>

                    <li class="slide__category"><span class="category-name">FAQ's & Suggestions</span></li>
                    <li class="slide" id="feedback-hub-menu">
                        <a href="/feedback-hub" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-send" style="color: #5D66F7"></i>
                            <span class="side-menu__label">Feedback Hub</span>
                        </a>
                    </li>
                    <li class="slide" id="faq-menu">
                        <a href="/FAQ" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-question-circle" style="color: #5D66F7"></i>
                            <span class="side-menu__label">FAQ's</span>
                        </a>
                    </li>

                    {{-- <li class="slide__category"><span class="category-name">Temporary</span></li>
                    <li class="slide">
                        <a href="/emails" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-question-circle" style="color: #5D66F7"></i>
                            <span class="side-menu__label">Emails</span>
                        </a>
                    </li> --}}
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        @else
            @include('components.menu.developer')
            @endif
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
