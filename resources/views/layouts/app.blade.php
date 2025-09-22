<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/assets/raw/new.png" type="image/x-icon">
    <title>{{ config('app.name', 'Hill Business Consulting Services') }}</title>
    <meta name="Description"
        content="The history of Hill Business Consulting Services began with two business owners, Joe and Douglas, who both worked in the janitorial industry and were challenged by rising labor costs and the pressure these costs placed on profitability. Recognizing the need for a fresh approach, they sought a better solution. Drawing from Mr. Hill's extensive background in the high-tech industry, they introduced processes, methods, and technologies typically used by world-class Silicon Valley companies and applied these innovations to the janitorial sector. This innovative shift proved highly successful, demonstrating that advanced technology isn’t just for billion-dollar enterprises but can be effectively implemented at any scale when supported by experienced professionals. This laid the groundwork for outsourcing high-quality talent, utilizing internet technologies and software tools to provide cost-effective, top-notch support services. Today, IOS works closely with clients, ensuring they benefit from continuous advancements and the efficiencies of an ever-changing global market.">
    <meta name="Author" content="Hill Business Consulting Services">
    <meta name="keywords" content="iosbiz.com, iosbiz, Hill Business Consulting Services">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    @include('components.nav-link')
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mogra&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet"> --}}
    @livewireStyles
    @stack('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

        body {
            font-family: "Roboto", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
    </style>
    {{-- <!-- Phones -->
    <link rel="stylesheet" href="{{ asset('dist/style.css') }}" media="(max-width: 480px)">

    <!-- Tablets -->
    <link rel="stylesheet" href="{{ asset('dist/style.css') }}" media="(min-width: 768px) and (max-width: 1024px)"> --}}

    <style>
        /* Default (desktop) */
        .mobile-response {
            display: none !important;
        }

        /* Mobile */
        @media (max-width: 480px) {
            .mobile-response {
                display: block !important;
            }

            .desktop-response {
                display: none !important;
            }
        }

        /* Tablet */
        @media (min-width: 768px) and (max-width: 1024px) {
            .mobile-response {
                display: block !important;
            }

            .desktop-response {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div id="loader">
        <center class="flex flex-col items-center space-y-4">
            <div class="relative w-24 h-24 flex items-center justify-center">
                <div
                    class="absolute w-full h-full border-2 !border-yellow-400 border-t-transparent rounded-full animate-spin">
                </div>
                <img src="/assets/logo.png" alt="Logo" class="h-16 z-10">
            </div>

            <div class="text-center text-gray-700 text-sm">
                Please wait a moment... <br />
                We are securely processing your request. <br />
                Retrieving large files may take a few minutes.
            </div>
        </center>
    </div>

    <style>
        /* .box {
            box-shadow: none !important;
        } */
    </style>

    <div class="mobile-response">
        <div class="header-area" id="headerArea">
            <div class="container">
                <!-- Paste your Header Content from here -->
                <!-- Header Content -->
                <div
                    class="header-content header-style-three position-relative d-flex align-items-center justify-content-between">
                    <!-- Back Button -->
                    <div class="back-button">
                        <a id="affanNavbarToggler" href="#" data-bs-toggle="offcanvas"
                            data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
                            <i class="bi bi-text-left"></i>
                        </a>
                    </div>

                    <!-- Page Title -->
                    <div class="page-heading">
                        <h6 class="mb-0">Welcome Back!</h6>
                    </div>

                    <!-- User Profile -->
                    <div class="user-profile-wrapper">
                        <a class="user-profile-trigger-btn" href="#">
                            <img src="/assets/images/faces/2.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- # Sidenav Left -->
        <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
            aria-labelledby="affanOffcanvsLabel">

            <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>

            <div class="offcanvas-body p-0">
                <div class="sidenav-wrapper">
                    <!-- Sidenav Profile -->
                    <div class="sidenav-profile bg-gradient">
                        <div class="sidenav-style1"></div>

                        <!-- User Thumbnail -->
                        <div class="user-profile">
                            <img src="/assets/images/faces/2.jpg" alt="">
                        </div>
                    </div>

                    <!-- Sidenav Nav -->
                    <ul class="sidenav-nav ps-0">
                        <li>
                            <a href="home.html"><i class="bi bi-house-door"></i> x</a>
                        </li>
                        <li>
                            <a href="elements.html"><i class="bi bi-heart"></i> x
                                <span class="badge bg-danger rounded-pill ms-2">220+</span>
                            </a>
                        </li>
                        <li>
                            <a href="pages.html"><i class="bi bi-folder2-open"></i> x
                                <span class="badge bg-success rounded-pill ms-2">100+</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-cart-check"></i> x</a>
                            <ul>
                                <li>
                                    <a href="shop-grid.html"> x</a>
                                </li>
                                <li>
                            </ul>
                        </li>
                        <li>
                            <a href="settings.html"><i class="bi bi-gear"></i> Settings</a>
                        </li>
                        <li>
                            <a href="login.html"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-content-wrapper">
            <!-- Breadcrumb Area -->
            <div class="breadcrumb-wrapper breadcrumb-two">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 px-1 py-4">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="elements.html">Elements</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">XXX</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </div>

    <div class="page">

        <div class="desktop-response">
            @include('components.nav-top')
            @include('components.nav-sidemenu')
        </div>

        <div class="main-content app-content pt-0 mt-4">
            <div class="container-fluid">

                @if (session('manage_portal_id'))
                    <div class="alert alert-img alert-dark alert-dismissible fase show !rounded-full flex-wrap relative"
                        role="alert" id="dismiss-alert45">
                        <div class="avatar avatar-sm me-3 avatar-rounded"> <img src="/star.png" alt="img">
                        </div>
                        <div class="sm:flex-shrink-0">You are managing
                            <strong>{{ session()->get('manage_portal_email') }}</strong> account.
                        </div>
                        <a href="/hook/reset/access"
                            class="m-2 p-3 absolute end-0 top-0 inline-flex  rounded-sm  focus:outline-none focus:ring-0 focus:ring-offset-0 ">
                            <span class="sr-only">Dismiss</span> <svg class="h-3 w-3" width="16" height="16"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path
                                    d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                                    fill="currentColor"></path>
                            </svg> </a>
                    </div>
                @endif

                <div class="flex items-center justify-between flex-wrap gap-2 mb-3">
                    <div class="flex-grow min-w-0">
                        <div class="w-full">
                            @include('layouts.partials.breadcrumbs')
                        </div>
                    </div>
                    <div class="btn-list shrink-0">
                        {{ $buttons ?? '' }}
                    </div>
                </div>


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

                @endphp

                @auth
                    @php
                        $user = Auth::user();
                        $isVerified = !is_null($user->email_verified_at);
                    @endphp

                    @if ($remaining_credit <= 0)
                        @if ($user->role === 'Administrator' || $user->role === 'Virtual Assistant')
                            @if (!$isVerified)
                                {{-- Email Not Verified Notice --}}
                                <div class="grid grid-cols-12 gap-6">
                                    <div class="xl:col-span-12 col-span-12">
                                        <div class="flex flex-col items-center text-center py-12">
                                            <br><br><br>
                                            <img src="/media/emails/undraw_envelope_hem0.svg" style="height: 300px"
                                                alt="" class="mb-6" />

                                            @if (session('status') == 'verification-link-sent')
                                                <div class="alert alert-success !border-success/10 flex items-center"
                                                    role="alert">
                                                    <svg class="sm:flex-shrink-0 me-2 fill-success"
                                                        xmlns="http://www.w3.org/2000/svg" height="1.5rem"
                                                        viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                                                        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M16.59 7.58L10 14.17l-3.59-3.58L5 12l5 5 8-8zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
                                                    </svg>
                                                    <div>A new verification link has been sent to your email.</div>
                                                </div>
                                            @endif

                                            <h1 class="text-4xl font-bold mb-2"><strong>Email Verification Needed</strong>
                                            </h1>
                                            <p>Please check your inbox and click the verification link we sent.</p>

                                            <form method="POST" action="{{ route('verification.send') }}"
                                                class="mt-4">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">
                                                    Resend verification email
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{ $slot }}
                            @endif
                        @elseif ($user->role === 'Developer')
                            {{ $slot }}
                        @else
                            {{-- Not Admin/VA with zero credit --}}
                            <div class="grid grid-cols-12 gap-x-6">
                                <div class="xxl:col-span-12 col-span-12">
                                    <div class="box">
                                        <div class="box-header justify-center p-5">
                                            <center>
                                                <img src="/empty-box.png" style="height: 350px" alt="">
                                                <h2 class="text-bold" style="font-family: Rubik"><strong>Insufficient
                                                        Credit</strong></h2>
                                                <span class="text-lg" style="font-family: Rubik">
                                                    Unfortunately, you currently have no available credits. <br>
                                                    Please contact your Virtual Assistant (VA) for assistance in continuing
                                                    to use the portal.
                                                </span>
                                            </center>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        @endif
                    @else
                        {{-- Has Credit --}}
                        @if (!$isVerified)
                            {{-- Email not verified notice --}}
                            <div class="grid grid-cols-12 gap-6">
                                <div class="xl:col-span-12 col-span-12">
                                    <div class="flex flex-col items-center text-center py-12">
                                        <br><br><br>
                                        <img src="/media/emails/undraw_envelope_hem0.svg" style="height: 300px"
                                            alt="" class="mb-6" />

                                        @if (session('status') == 'verification-link-sent')
                                            <div class="alert alert-success !border-success/10 flex items-center"
                                                role="alert">
                                                <svg class="sm:flex-shrink-0 me-2 fill-success"
                                                    xmlns="http://www.w3.org/2000/svg" height="1.5rem"
                                                    viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                                                    <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M16.59 7.58L10 14.17l-3.59-3.58L5 12l5 5 8-8zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
                                                </svg>
                                                <div>A new verification link has been sent to your email.</div>
                                            </div>
                                        @endif

                                        <h1 class="text-4xl font-bold mb-2">Email Verification Needed</h1>
                                        <p>Please check your inbox and click the verification link we sent.</p>

                                        <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">
                                                Resend verification email
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{ $slot }}
                        @endif
                        <br><br>
                    @endif
                @endauth


            </div>
        </div>

        {{-- @include('components.welcome_message') --}}


        @include('components.nav-footer')

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const mobileNavToggleBtn = document.querySelector('.sidemenu-toggle');

                if (mobileNavToggleBtn) {
                    // Trigger the click once on page load
                    mobileNavToggleBtn.click();

                    // Add the normal event listener (if needed)
                    mobileNavToggleBtn.addEventListener('click', function() {
                        document.body.classList.toggle('mobile-nav-active');

                        const sidebar = document.getElementById('sidebar');
                        const page = document.querySelector('.page');

                        if (sidebar) sidebar.classList.toggle('collapsed');
                        if (page) page.classList.toggle('sidebar-collapsed');
                    });
                }
            });
        </script>


    </div>

    <!-- Style CSS -->
    {{-- <link rel="stylesheet" href="/dist/style.css">
    <link rel="manifest" href="/dist/manifest.json"> --}}

    <div class="footer-nav-area mobile-response" id="footerNav">
        <div class="container px-0">
            <!-- Footer Content -->
            <div class="footer-nav position-relative">
                <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                    <li class="active">
                        <a href="/dashboard">
                            <i class="bi bi-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="/file-manager/list">
                            <i class="bi bi-folder2-open"></i>
                            <span>File Manager</span>
                        </a>
                    </li>
                    @php
                        $id = Auth::user()->id;
                        $token = Crypt::encryptString("user:{$id}|time:" . now()->timestamp);
                        $url = url("/api/launch-chat/{$token}/{$id}");
                    @endphp
                    <li>
                        <a href="{{ $url }}">
                            <i class="bi bi-chat-dots"></i>
                            <span>Chat</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-power"></i>
                            <span>
                                {{ __('Log Out') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- @stack('modals') --}}

    {{-- <script src="/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/js/slideToggle.min.js"></script>
    <script src="/dist/js/internet-status.js"></script>
    <script src="/dist/js/tiny-slider.js"></script>
    <script src="/dist/js/venobox.min.js"></script>
    <script src="/dist/js/countdown.js"></script>
    <script src="/dist/js/rangeslider.min.js"></script>
    <script src="/dist/js/vanilla-dataTables.min.js"></script>
    <script src="/dist/js/index.js"></script>
    <script src="/dist/js/imagesloaded.pkgd.min.js"></script>
    <script src="/dist/js/isotope.pkgd.min.js"></script>
    <script src="/dist/js/dark-rtl.js"></script>
    <script src="/dist/js/active.js"></script>
    <script src="/dist/js/pwa.js"></script> --}}

    <!-- Scroll To Top -->
    @include('components.nav-footer-link')

    @stack('scripts')

    <div class="desktop-response">
        @include('chats.index')

        @if (Auth::user()->role == 'Client' || Auth::user()->role == 'Sub-Client')
            {{-- @include('modules.chats.old.widget') --}}
        @elseif (Auth::user()->role == 'Virtual Assistant')
      
        @else
            @include('chats.index')
        @endif
    </div>


</body>

</html>
