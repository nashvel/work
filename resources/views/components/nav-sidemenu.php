{{-- @php
     session()->put('show_welcome_modal', true);
@endphp --}}
<aside class="app-sidebar" id="sidebar">
    <div class="main-sidebar-header">
        <a href="/" class="header-logo">
            <img src="/assets/raw/logo.png" alt="logo" class="desktop-logo">
        </a>
    </div>
    <div class="main-sidebar" id="sidebar-scroll">
        <nav class="main-menu-container nav nav-pills flex-col sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <li>
                    <a href="">
                        <style>
                            .transparent-shadow {
                                filter: drop-shadow(0px 0px 1px #FFBC58);
                            }
                        </style>
                        <center>
                            @if (Auth::user()->role == 'Client' || Auth::user()->role == 'Virtual Assistant')
                            <img src="{{ asset('storage/' . $lead_profile->photo) }}" style="height: 110px" alt=""
                            class="transparent-logo">
                            @elseif (Auth::user()->role == 'Administrator')
                                <img src="/assets/raw/new.png" style="max-height: 150px" class="transparent-shadow">
                            @else
                                <img src="/assets/raw/new.png" style="max-height: 150px" class="transparent-shadow">
                            @endif
                        </center>
                    </a>
                </li>
                <li>
                    <hr>
                </li>
                <li class="slide__category"><span class="category-name">Main</span></li>
                @if (Auth::user()->role == 'Administrator')
                    <li class="slide">
                        <a href="/dashboard" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                style="color: #5D66F7" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                    <li class="slide__category"><span class="category-name">Content Management</span></li>

                    <li class="slide">
                        <a href="/cms/clients" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-collection-play" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Clients Section
                            </span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/cms/gallery" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-images" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Gallery Section
                            </span>
                        </a>
                    </li>
                    <li class="slide__category"><span class="category-name">Management</span></li>
                    <li class="slide">
                        <a href="/hbcs/clients" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none"
                                style="color: #5D66F7" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z">
                                </path>
                            </svg>
                            <span class="side-menu__label">Manage Clients</span>
                        </a>
                    </li>

                    <li class="slide__category"><span class="category-name">Menu</span></li>
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            <i class="w-6 h-4 side-menu__icon bi bi-layers" style="color: #5D66F7"></i>
                            <span class="side-menu__label">Content Section</span>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Content Section</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('content.hero') }}" class="side-menu__item">Hero Section</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('content.contact') }}" class="side-menu__item">Manage Content</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('content.team_members') }}" class="side-menu__item">Team Member</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('content.gallery') }}" class="side-menu__item">Image Gallery</a>
                            </li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a href="{{ route('content.contact.greetings') }}" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-transparency" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Automated Greetings
                            </span>
                        </a>
                    </li>
                    {{-- <li class="slide">
                        <a href="/task-list-view" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-journal-text " style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Assign VA's Tasks
                        </a>
                    </li> --}}
                    <li class="slide">
                        <a href="/virtual-assistant/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-people " style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Virtual Assistant
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('content.contact') }}" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-envelope-at" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Web Inquiries &ensp;
                                {{-- <span class=" translate-middle  badge !rounded-full bg-danger"> 5+ </span> --}}
                            </span>

                        </a>
                    </li>
                    <li class="slide__category"><span class="category-name">Applications</span></li>
                    <li class="slide">
                        <a href="/chat/{{ Auth::user()->id }}" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
                            @php
                                $last_chat_count = App\Models\Chats::where('receiver_id', Auth::user()->id)
                                    ->where('isRead', 0)
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->count();
                            @endphp
                            <span class="side-menu__label px-1">Chats </span>
                            @if ($last_chat_count != 0)
                                <span class=" translate-middle badge !rounded-full bg-danger">
                                    {{ $last_chat_count }}</span>
                            @endif
                        </a>
                    </li>
                    {{-- <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            <i class="w-6 h-4 side-menu__icon bi bi-vector-pen" style="color: #5D66F7"></i>
                            <span class="side-menu__label">Task Panel</span>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Task Panel</a>
                            </li>
                            <li class="slide">
                                <a href="/task-board" class="side-menu__item">Task Board</a>
                            </li>
                            <li class="slide">
                                <a href="/task-list-view" class="side-menu__item">List View</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="slide">
                        <a href="/file-manager" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-folder" style="color: #5D66F7"></i>
                            <span class="side-menu__label">File Manager</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/to-do-list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-card-checklist" style="color: #5D66F7"></i>
                            <span class="side-menu__label">To do List</span>
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'Client' || Auth::user()->role == 'Virtual Assistant')
                    <li class="slide">
                        <a href="/user/dashboard" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                style="color: #5D66F7" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                    <li class="slide__category"><span class="category-name">Management</span></li>
                    <li class="slide">
                        <a href="/relationship/clients" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-people" style="color: #5D66F7"></i>
                            <span class="side-menu__label">Clients</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/relationship/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-person-video2" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Relationships
                            </span>
                        </a>
                    </li>
                    {{-- <li class="slide">
                        <a href="/virtual-assistant/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-journal-richtext " style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Virtual Assistant
                            </span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/task-list-view" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-journal-text " style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Assign VA's Tasks
                            </span>
                        </a>
                    </li> --}}
                    <li class="slide">
                        <a href="/bid/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-journal-bookmark" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Manage Projects
                            </span>
                        </a>
                    </li>
                    @php
                        $bid = App\Models\Bid::where('project_id', 5)->count();
                    @endphp
                    {{-- <li class="slide">
                        <a href="/client/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-person" style="color: #5D66F7"></i>
                            <span class="side-menu__label px-1">
                                Prospective Bidder</span>
                            <span class=" translate-middle  badge !rounded-full bg-danger"> {{ $bid }}</span>

                        </a>
                    </li> --}}
                    <li class="slide__category"><span class="category-name">Applications</span></li>
                    <li class="slide">
                        <a href="/file-manager" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-folder" style="color: #5D66F7"></i>
                            <span class="side-menu__label">File Manager</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/to-do-list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-card-checklist" style="color: #5D66F7"></i>
                            <span class="side-menu__label">To do List</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/chat/{{ Auth::user()->id }}" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
                            @php
                                $last_chat_count = App\Models\Chats::where('receiver_id', Auth::user()->id)
                                    ->where('isRead', 0)
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->count();
                            @endphp
                            <span class="side-menu__label px-1">Chats </span>
                            @if ($last_chat_count != 0)
                                <span class=" translate-middle badge !rounded-full bg-danger">
                                    {{ $last_chat_count }}</span>
                            @endif
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'Sub-Client')
                    <li class="slide">
                        <a href="/member/dashboard" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                style="color: #5D66F7" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                    <li class="slide__category"><span class="category-name">Manage</span></li>
                    <li class="slide">
                        <a href="/contact/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-person-video2" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Relationships
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/virtual-assistant/list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-journal-richtext " style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Virtual Assistant
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/bid/invitation" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-envelope-check" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                Project Invitation &ensp;
                            </span>
                            @php
                                $invitation = App\Models\ProjectBidding::join(
                                    't_invites',
                                    't_invites.project_id',
                                    't_project_bidding.id',
                                )
                                    ->where('email', Auth::user()->email)
                                    ->where('status', null)
                                    ->count();
                            @endphp
                            @if ($invitation !== 0)
                                <span class=" translate-middle  badge !rounded-full bg-danger">
                                    {{ number_format($invitation, 0) }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/bid/projects" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-person-vcard" style="color: #5D66F7"></i>
                            <span class="side-menu__label">
                                My Current Projects
                            </span>
                        </a>
                    </li>
                    <li class="slide__category"><span class="category-name">Applications</span></li>

                    <li class="slide">
                        <a href="/file-manager" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-folder" style="color: #5D66F7"></i>
                            <span class="side-menu__label">File Manager</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/to-do-list" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-card-checklist" style="color: #5D66F7"></i>
                            <span class="side-menu__label">To do List</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="/chat/{{ Auth::user()->id }}" class="side-menu__item">
                            <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
                            @php
                                $last_chat_count = App\Models\Chats::where('receiver_id', Auth::user()->id)
                                    ->where('isRead', 0)
                                    ->orderBy('id', 'DESC')
                                    ->limit(1)
                                    ->count();
                            @endphp
                            <span class="side-menu__label px-1">Chats </span>
                            @if ($last_chat_count != 0)
                                <span class=" translate-middle badge !rounded-full bg-danger">
                                    {{ $last_chat_count }}</span>
                            @endif
                        </a>
                    </li>
                @endif

                <li class="slide__category"><span class="category-name">Tools</span></li>
                <li class="slide">
                    <a href="{{ route('email.setup') }}" class="side-menu__item">
                        <i class="w-6 h-4 side-menu__icon bi bi-envelope" style="color: #5D66F7"></i>
                        <span class="side-menu__label">
                            Email Template
                        </span>
                    </a>
                </li>

                <li class="slide__category"><span class="category-name">Enhancements & Suggestions</span></li>
                <li class="slide">
                    <a href="/feedback-hub" class="side-menu__item">
                        <i class="w-6 h-4 side-menu__icon bi bi-send" style="color: #5D66F7"></i>
                        <span class="side-menu__label">Feedback Hub</span>
                    </a>
                </li>
                <li class="slide__category"><span class="category-name">Frequently Asked Question</span></li>
                <li class="slide">
                    <a href="/FAQ" class="side-menu__item">
                        <i class="w-6 h-4 side-menu__icon bi bi-question-circle" style="color: #5D66F7"></i>
                        <span class="side-menu__label">FAQ's</span>
                    </a>
                </li>      
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
    </div>
</aside>
