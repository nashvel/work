 <header class="app-header sticky shadow-noneww" id="header">
     <div class="main-header-container container-fluid">
         <div class="header-content-left">
             <div class="header-element bg-[#202947]">
                 <div class="horizontal-logo">
                     <a href="index.html" class="header-logo">
                         {{-- <img src="../assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                         <img src="../assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
                         <img src="../assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
                         <img src="../assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
                         <img src="../assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
                         <img src="../assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white"> --}}
                     </a>
                 </div>
             </div>
             <div class="header-element mx-lg-0">
                 <a aria-label="Hide Sidebar"
                     class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                     data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
             </div>
             <i class="mx-2  text-muted">@include('version')</i>
         </div>

         <!-- End::header-content-left -->

         <!-- Start::header-content-right -->
         <ul class="header-content-right">

             {{-- <div id="serviceButtonsContainer">
    <button class="service-btn"
        onclick="openServiceModal('HR Services help with recruitment, payroll, and employee relations. Please contact your virtual assistant for more information and get started')">HR</button>
    <button class="service-btn"
        onclick="openServiceModal('Accounting Services include bookkeeping, tax filing, and financial reports. Please contact your virtual assistant for more information and get started')">Accounting</button>
    <button class="service-btn"
        onclick="openServiceModal('Marketing Services help promote your brand, manage social media, and drive sales. Please contact your virtual assistant for more information and get started')">Marketing</button>
    <button class="service-btn"
        onclick="openServiceModal('Consulting Services guide your business with expert strategies and improvements. Please contact your virtual assistant for more information and get started')">Consulting</button>
    <button class="service-btn"
        onclick="openServiceModal('Sales Services help generate leads, manage pipelines, and close deals efficiently. Please contact your virtual assistant for more information and get started')">Sales</button>
    <button class="service-btn"
        onclick="openServiceModal('Social Media Services manage your platforms, schedule content, and grow your online presence. Please contact your virtual assistant for more information and get started')">Social
        Media</button>
    <button class="service-btn"
        onclick="openServiceModal('Legal Advice Services provide assistance with contracts, compliance, and legal representation. Please contact your virtual assistant for more information and get started')">Legal Advice</button>
    <button class="service-btn"
        onclick="openServiceModal('IT Consulting Services support your technology strategy, infrastructure, and cybersecurity needs. Please contact your virtual assistant for more information and get started')">IT Consulting</button>
</div> --}}


             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('HR Services help with recruitment, payroll, and employee relations. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave  waves-effect waves-light text-gray-700 text-xs">
                         Human Resource
                     </div>
                 </a>
             </li>

             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('Accounting Services include bookkeeping, tax filing, and financial reports. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave waves-effect waves-light text-gray-700 text-xs">
                         Accounting
                     </div>
                 </a>
             </li>

             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('Marketing Services help promote your brand, manage social media, and drive sales. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave waves-effect waves-light text-gray-700 text-xs">
                         Marketing
                     </div>
                 </a>
             </li>

             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('Consulting Services guide your business with expert strategies and improvements. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave waves-effect waves-light text-gray-700 text-xs">
                         Consulting
                     </div>
                 </a>
             </li>

             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('Sales Services help generate leads, manage pipelines, and close deals efficiently. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave waves-effect waves-light text-gray-700 text-xs">
                         Sales
                     </div>
                 </a>
             </li>

             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('Social Media Services manage your platforms, schedule content, and grow your online presence. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave waves-effect waves-light text-gray-700 text-xs">
                         Social Media
                     </div>
                 </a>
             </li>

             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('Legal Advice Services provide assistance with contracts, compliance, and legal representation. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave waves-effect waves-light text-gray-700 text-xs">
                         Legal Advice
                     </div>
                 </a>
             </li>

             <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <a href="javascript:void(0);"
                     onclick="openServiceModal('IT Consulting Services support your technology strategy, infrastructure, and cybersecurity needs. Please contact your virtual assistant for more information and get started')"
                     class="header-link hs-dropdown-toggle ti-dropdown-toggle !p-0">
                     <div
                         class="ti-btn ti-btn-outline-light !rounded-full btn-wave waves-effect waves-light text-gray-700 text-xs">
                         IT Consulting
                     </div>
                 </a>
             </li>

             <li class="p-2 pt-3 text-gray-500">|</li>

             {{-- <li class="header-element">
                 <div id="google_translate_element"></div>
             </li>
             <!-- Scripts -->
             <script type="text/javascript">
                 function googleTranslateElementInit() {
                     new google.translate.TranslateElement({
                         pageLanguage: 'en',
                         includedLanguages: 'en,es,fr,de,zh-CN,ar,it,ru',
                         layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
                     }, 'google_translate_element');
                 }
             </script>
             <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

             <script>
                 function translatePage(langName) {
                     setTimeout(() => {
                         const iframe = document.querySelector('iframe.goog-te-menu-frame');
                         if (!iframe) return;

                         const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                         const langSpans = innerDoc.querySelectorAll('.goog-te-menu2-item span.text');

                         langSpans.forEach(span => {
                             if (span.innerText.trim().toLowerCase() === langName.toLowerCase()) {
                                 span.click();
                             }
                         });
                     }, 300);
                 }

                 // Initialize English as default only once
                 window.addEventListener('load', () => {
                     setTimeout(() => {
                         document.querySelector('#google_translate_element').style.display = 'block';
                     }, 500);

                     if (!localStorage.getItem('default_language_set')) {
                         setTimeout(() => {
                             const iframe = document.querySelector('iframe.goog-te-menu-frame');
                             if (!iframe) return;

                             const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                             const langSpans = innerDoc.querySelectorAll('.goog-te-menu2-item span.text');

                             langSpans.forEach(span => {
                                 if (span.innerText.trim().toLowerCase() === 'english') {
                                     span.click();
                                 }
                             });

                             localStorage.setItem('default_language_set', 'true');
                         }, 1500);
                     }
                 });
             </script> --}}
             <style>
                 /* Hide Google Translate Branding */
                 .goog-te-gadget>span:last-child {
                     display: none !important;
                 }

                 /* Optional: style the combo box */
                 .goog-te-combo {
                     background-color: white;
                     border: 1px solid #ccc;
                     padding: 4px 8px;
                     border-radius: 4px;
                     font-size: 14px;
                 }

                 /* Hide extra margins/spacing */
                 #google_translate_element {
                     margin: 0 !important;
                     padding: 0 !important;
                 }

                 .VIpgJd-ZVi9od-ORHb {
                     display: none;
                 }
             </style>







             <!-- End::header-element -->
             {{-- <li class="header-element">
                 <!-- Start::header-link|switcher-icon -->
                 <button class="ti-btn ti-btn-light bg-white !border-2" onclick="tour()">User Guide</button>
                 <!-- End::header-link|switcher-icon -->
             </li> --}}
             <!-- Start::header-element -->
             {{-- <li
                 class="header-element country-selector hs-dropdown ti-dropdown  hidden sm:block [--placement:bottom-right] rtl:[--placement:bottom-left]">
                 <div class="ti-dropdown-divider divide-y divide-gray-200 dark:divide-white/10"></div>
                 <!-- Start::header-link|dropdown-toggle -->
                 <a href="javascript:void(0);" class="header-link hs-dropdown-toggle ti-dropdown-toggle"
                     data-bs-auto-close="outside" data-bs-toggle="dropdown">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                     </svg>
                 </a>
                 <!-- End::header-link|dropdown-toggle -->
                 <ul class="main-header-dropdown hs-dropdown-menu ti-dropdown-menu min-w-[10rem] hidden"
                     data-popper-placement="none">

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('en')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/us_flag.jpg" alt="English">
                             </span> English
                         </a></li>

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('es')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/spain_flag.jpg" alt="Español">
                             </span> Español
                         </a></li>

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('fr')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/french_flag.jpg" alt="Français">
                             </span> Français
                         </a></li>

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('ar')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/uae_flag.jpg" alt="عربي">
                             </span> عربي
                         </a></li>

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('de')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/germany_flag.jpg" alt="Deutsch">
                             </span> Deutsch
                         </a></li>

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('zh-CN')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/china_flag.jpg" alt="中文">
                             </span> 中文
                         </a></li>

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('it')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/italy_flag.jpg" alt="Italiano">
                             </span> Italiano
                         </a></li>

                     <li><a class="ti-dropdown-item flex items-center" href="javascript:void(0);"
                             onclick="translatePage('ru')">
                             <span class="avatar avatar-rounded avatar-xs leading-none me-2">
                                 <img src="/assets/images/flags/russia_flag.jpg" alt="Русский">
                             </span> Русский
                         </a></li>
                 </ul>

                 <div id="google_translate_element" style="display: none;"></div>

                 <script type="text/javascript">
                     function googleTranslateElementInit() {
                         new google.translate.TranslateElement({
                             pageLanguage: 'en',
                             includedLanguages: 'en,es,fr,de,zh-CN,ar,it,ru',
                             layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
                         }, 'google_translate_element');
                     }
                 </script>

                 <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                 <script>
                     function translatePage(lang) {
                         const frame = document.querySelector('iframe.goog-te-menu-frame');
                         if (!frame) return;

                         const innerDoc = frame.contentDocument || frame.contentWindow.document;
                         const langLinks = innerDoc.querySelectorAll('.goog-te-menu2-item span.text');

                         langLinks.forEach(function(el) {
                             if (el.innerText.toLowerCase().indexOf(lang.toLowerCase()) !== -1) {
                                 el.click();
                             }
                         });
                     }

                     // Auto-show Google Translate once initialized
                     window.addEventListener('load', () => {
                         setTimeout(() => {
                             document.querySelector('#google_translate_element').style.display = 'block';
                         }, 1000);
                     });
                 </script>


             </li> --}}
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <!-- light and dark theme -->
             <li class="header-element header-theme-mode hidden !items-center sm:block md:!px-[0.5rem] px-2">
                 <a aria-label="anchor"
                     class="hs-dark-mode-active:hidden flex hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 text-textmuted dark:text-textmuted/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                     href="javascript:void(0);" data-hs-theme-click-value="dark">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                     </svg>
                 </a>
                 <a aria-label="anchor"
                     class="hs-dark-mode-active:flex hidden hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium text-defaulttextcolor  transition-all text-xs dark:bg-bodybg dark:bg-bgdark dark:hover:bg-black/20  dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                     href="javascript:void(0);" data-hs-theme-click-value="light">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                     </svg>
                 </a>
             </li>
             <!-- End light and dark theme -->

             <!-- Start::header-element -->
             {{-- <li
                 class="header-element notifications-dropdown !hidden xl:!block hs-dropdown ti-dropdown [--auto-close:inside]">
                 <!-- Start::header-link|dropdown-toggle -->
                 <a href="javascript:void(0);" class="header-link hs-dropdown-toggle ti-dropdown-toggle"
                     data-bs-toggle="dropdown" data-bs-auto-close="outside" id="messageDropdown"
                     aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                     </svg>

                     <span class="header-icon-pulse bg-danger rounded pulse pulse-secondary"></span>

                 </a>
                 <!-- End::header-link|dropdown-toggle -->
                 <!-- Start::main-header-dropdown -->
                 <div class="main-header-dropdown hs-dropdown-menu ti-dropdown-menu hidden"
                     data-popper-placement="none">
                     <div class="p-4">
                         <div class="flex items-center justify-between">
                             <p class="mb-0 text-[15px] font-medium">Notifications</p>
                             <span class="badge bg-secondary text-white rounded-sm" id="notifiation-data">1
                                 Unread</span>
                         </div>
                     </div>
                     <div class="dropdown-divider"></div>
                     <ul class="list-none mb-0" id="header-notification-scroll">
                         @php
                             if (Auth::user()->role == 'Client') {
                                 $notification = App\Models\Notification::rightJoin(
                                     'projects',
                                     'projects.id',
                                     'project_id',
                                 )
                                     ->select('notifications.*', 'projects.name')
                                     ->orderBy('id', 'DESC')
                                     ->get();
                             } else {
                                 $notification = App\Models\Notification::rightJoin(
                                     't_project_bidding',
                                     't_project_bidding.id',
                                     'project_id',
                                 )
                                     ->select('notifications.*', 't_project_bidding.proj_name')
                                     ->where('user_id', Auth::user()->id)
                                     ->orderBy('id', 'DESC')
                                     ->get();
                             }

                         @endphp
                         @php
                             $last_chat_count = App\Models\Chats::where('receiver_id', Auth::user()->id)
                                 ->where('isRead', 0)
                                 ->orderBy('id', 'DESC')
                                 ->limit(1)
                                 ->count();
                         @endphp
                         @if ($last_chat_count != 0)
                             <li class="ti-dropdown-item block">
                                 <div class="flex items-center">
                                     <div class="pe-2 leading-none">

                                         <span class="avatar avatar-md bg-danger avatar-rounded text-xl">
                                             <i class="bi bi-chat-dots text-[24px] leading-none "></i>
                                         </span>
                                     </div>
                                     <div class="grow flex items-center justify-between">
                                         <div>

                                             <p class="mb-0 font-medium"><a href="/chat/{{ Auth::user()->id }}">
                                                     New Message Received.
                                                 </a>
                                             </p>
                                             <div
                                                 class="text-textmuted dark:text-textmuted/50 font-normal text-xs header-notification-text truncate">

                                             </div>
                                             <div
                                                 class="font-normal text-[10px] text-textmuted dark:text-textmuted/50 op-8">
                                                 You have new message. Read more..
                                             </div>
                                         </div>
                                         <div>
                                             <a href="javascript:void(0);"
                                                 class="min-w-fit-content dropdown-item-close1">
                                                 <i class="ri-close-line"></i>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                         @endif

                         @foreach ($notification as $notify)
                             @if ($notify->created_at != null)
                                 <li class="ti-dropdown-item block">
                                     <div class="flex items-center">
                                         <div class="pe-2 leading-none">
                                             @if ($notify->details === 'You Removed your bid.')
                                                 <span class="avatar avatar-md bg-danger avatar-rounded text-xl">
                                                     <i class="fe fe-trash leading-none "></i>
                                                 </span>
                                             @else
                                                 <span class="avatar avatar-md bg-danger avatar-rounded text-xl">
                                                     <i class="fe fe-mail leading-none "></i>
                                                 </span>
                                             @endif
                                         </div>
                                         <div class="grow flex items-center justify-between">
                                             <div>

                                                 <p class="mb-0 font-medium"><a href="/bid/invitation">
                                                         @if (Auth::user()->role == 'Client')
                                                             @if ($notify->details === 'You place a bid for project...')
                                                                 @php
                                                                     $user = App\Models\User::where(
                                                                         'id',
                                                                         $notify->user_id,
                                                                     )->first();
                                                                 @endphp
                                                                 {{ $user->name }} has place a bid.
                                                             @elseif($notify->details === 'You Removed your bid.')
                                                                 {{ $user->name }} has cancel the bid.
                                                             @endif
                                                         @else
                                                             {{ $notify->details }}
                                                         @endif
                                                     </a>
                                                 </p>
                                                 <div
                                                     class="text-textmuted dark:text-textmuted/50 font-normal text-xs header-notification-text truncate">
                                                     {{ $notify->name }}
                                                 </div>
                                                 <div
                                                     class="font-normal text-[10px] text-textmuted dark:text-textmuted/50 op-8">
                                                     @if ($notify->created_at != null)
                                                         {{ $notify->created_at->diffForHumans() ?? '' }}
                                                     @endif
                                                 </div>
                                             </div>
                                             <div>
                                                 <a href="javascript:void(0);"
                                                     class="min-w-fit-content dropdown-item-close1">
                                                     <i class="ri-close-line"></i>
                                                 </a>
                                             </div>
                                         </div>
                                     </div>
                                 </li>
                             @endif
                         @endforeach
                     </ul>

                     <div class="p-4 empty-header-item1 border-t">
                         <div class="grid">
                             <a href="javascript:void(0);" class="ti-btn ti-btn-primary btn-wave">View All</a>
                         </div>
                     </div>
                     <div class="p-[3rem] empty-item1 hidden">
                         <div class="text-center">
                             <span class="avatar avatar-xl avatar-rounded bg-secondary/10 !text-secondary">
                                 <i class="ri-notification-off-line fs-2"></i>
                             </span>
                             <h6 class="font-medium mt-3">No New Notifications</h6>
                         </div>
                     </div>
                 </div>
                 <!-- End::main-header-dropdown -->
             </li> --}}
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <li class="header-element header-fullscreen">
                 <!-- Start::header-link -->
                 <a onclick="openFullscreenOption()" href="javascript:void(0);" class="header-link">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 full-screen-open header-link-icon"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                     </svg>
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 full-screen-close header-link-icon hidden"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                     </svg>
                 </a>
                 <!-- End::header-link -->
             </li>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <li class="header-element ti-dropdown hs-dropdown">
                 <!-- Start::header-link|dropdown-toggle -->
                 <a href="javascript:void(0);" class="header-link hs-dropdown-toggle ti-dropdown-toggle"
                     id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                     aria-expanded="false">
                     <div class="flex items-center">
                         <div>
                             <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                 alt="{{ Auth::user()->name }}"
                                 onerror="this.onerror=null; this.src='{{ asset('/user.png') }}';"
                                 class="avatar avatar-sm mb-0">
                         </div>
                     </div>
                 </a>
                 <!-- End::header-link|dropdown-toggle -->
                 <ul class="main-header-dropdown hs-dropdown-menu ti-dropdown-menu pt-0 overflow-hidden header-profile-dropdown hidden"
                     aria-labelledby="mainHeaderProfile">
                     <li>
                         <div
                             class="ti-dropdown-item text-center border-b border-defaultborder dark:border-defaultborder/10 block">
                             <span>
                                 {{ Auth::user()->name }}
                             </span>
                             <span
                                 class="block text-xs text-textmuted dark:text-textmuted/50">{{ Auth::user()->email }}</span>
                         </div>
                     </li>
                     <li><a class="ti-dropdown-item flex items-center" href="/user/profile"><i
                                 class="fe fe-user p-1 rounded-full bg-primary/10 text-primary me-2 text-[1rem]"></i>Profile
                             Settings</a>
                     </li>
                     <li>
                         <a href="{{ route('logout') }}" class="ti-dropdown-item flex items-center"
                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                             <i class="fe fe-lock p-1 rounded-full bg-primary/10 text-primary ut me-2 text-[1rem]"></i>
                             <span>
                                 {{ __('Log Out') }}
                             </span>
                         </a>
                         <form id="logout-form" method="POST" action="{{ route('logout') }}"
                             style="display: none;">
                             @csrf
                         </form>
                     </li>
                 </ul>
             </li>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <li class="header-element">
                 <!-- Start::header-link|switcher-icon -->
                 <a href="/user/profile" class="header-link switcher-icon" data-hs-overlay="#hs-overlay-switcher">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                     </svg>
                 </a>
                 <!-- End::header-link|switcher-icon -->
             </li>
             <!-- End::header-element -->

         </ul>
         <!-- End::header-content-right -->

     </div>
     <!-- End::main-header-container -->

 </header>

<script>
  // Toggle fullscreen on/off
  function openFullscreenOption() {
    const doc = document;
    const el  = doc.documentElement; // whole page

    const isFs =
      doc.fullscreenElement ||
      doc.webkitFullscreenElement ||
      doc.msFullscreenElement;

    if (!isFs) {
      // enter
      const req =
        el.requestFullscreen ||
        el.webkitRequestFullscreen ||
        el.msRequestFullscreen;

      if (req) {
        Promise.resolve(req.call(el)).catch(console.warn);
      }
    } else {
      // exit
      const exit =
        doc.exitFullscreen ||
        doc.webkitExitFullscreen ||
        doc.msExitFullscreen;

      if (exit) {
        Promise.resolve(exit.call(doc)).catch(console.warn);
      }
    }
  }

  // Keep the icons in sync even if user presses Esc or browser UI
  (function bindFullscreenIconSync() {
    const doc = document;
    const updateIcons = () => {
      const isFs =
        doc.fullscreenElement ||
        doc.webkitFullscreenElement ||
        doc.msFullscreenElement;

      const openIcon  = document.querySelector('.full-screen-open');
      const closeIcon = document.querySelector('.full-screen-close');

      if (openIcon)  openIcon.classList.toggle('hidden', !!isFs);
      if (closeIcon) closeIcon.classList.toggle('hidden', !isFs);
    };

    ['fullscreenchange','webkitfullscreenchange','msfullscreenchange']
      .forEach(evt => doc.addEventListener(evt, updateIcons, false));

    // initialize on load
    updateIcons();
  })();
</script>

