@if ($user_info->role == 'Administrator')
    <li class="slide">
        <a href="/dashboard/auth" class="side-menu__item">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>
    <li class="slide__category"><span class="category-name">Workspaces</span></li>

    <li class="slide has-sub">
        <a href="javascript:void(0);" class="side-menu__item">
            <i class="ri-arrow-down-s-line side-menu__angle"></i>
            <i class="w-6 h-4 side-menu__icon bi bi-hdd-network" style="color: #5D66F7;"></i>
            <span class="side-menu__label">Portal Access</span>
        </a>
        <ul class="slide-menu child1">
            <li class="slide">
                <a href="/virtual-assistant/list" class="side-menu__item">Virtual Assistant Access</a>
            </li>
            <li class="slide">
                <a href="/hbcs/directors" class="side-menu__item">Director's Workspace</a>
            </li>
            <li class="slide">
                <a href="/hbcs/clients" class="side-menu__item">Client Workspace</a>
            </li>
            <li class="slide">
                <a href="#" class="side-menu__item">CRM Workspace</a>
            </li>
        </ul>
    </li>
    @php
         $id = Auth::user()->id;
         $token = Crypt::encryptString("user:{$id}|time:" . now()->timestamp);
         $url = url("/api/launch-chat/{$token}/{$id}");
     @endphp
     <li class="slide" id="messages-menu">
         <a href="{{ $url }}" target="_blank" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
             @php
                 $last_chat_count = App\Models\Chats::where('receiver_id', Auth::user()->id)
                     ->where('isRead', 0)
                     ->orderBy('id', 'DESC')
                     ->limit(1)
                     ->count();
             @endphp
             <span class="side-menu__label">Live Portal Chat </span>
         </a>
     </li>
    <li class="slide has-sub">
        <a href="javascript:void(0);" class="side-menu__item">
            <i class="ri-arrow-down-s-line side-menu__angle"></i>
            <i class="w-6 h-4 side-menu__icon bi bi-envelope-paper-heart" style="color: #5D66F7"></i>
            <span class="side-menu__label">Quick Greetings</span>
        </a>
        <ul class="slide-menu child1">
            <li class="slide side-menu__label1">
                <a href="javascript:void(0)">Quick Greet</a>
            </li>
            <li class="slide">
                <a href="/content/client/greetings" class="side-menu__item">Client Portal Greetings</a>
            </li>
            <li class="slide">
                <a href="/content/crm/greetings" class="side-menu__item">CRM Portal Greetings</a>
            </li>
        </ul>
    </li>

    <li class="slide__category"><span class="category-name">Content Management</span></li>
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
                <a href="/cms/banner" class="side-menu__item">Banner</a>
            </li>
            <li class="slide">
                <a href="/cms/about-us" class="side-menu__item">About Us</a>
            </li>
            <li class="slide">
                <a href="/cms/clients" class="side-menu__item">Client Section</a>
            </li>
            <li class="slide">
                <a href="/cms/teams" class="side-menu__item">Team Member</a>
            </li>
            <li class="slide">
                <a href="/cms/gallery" class="side-menu__item">Image Gallery</a>
            </li>
            <li class="slide">
                <a href="/cms/partners" class="side-menu__item">Partners Section</a>
            </li>
        </ul>
    </li>
    <li class="slide">
        <a href="/cms/inquiry-logs" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-chat-left-dots" style="color: #5D66F7"></i>
            <span class="side-menu__label">
                Inquiry Logs
            </span>
        </a>
    </li>
    <li class="slide">
        <a href="/chat/questionnaire" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-threads" style="color: #5D66F7"></i>
            <span class="side-menu__label">
                Chatbot
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
    <li class="slide">
        <a href="/virtual-assistant/list" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-robot" style="color: #5D66F7"></i>
            <span class="side-menu__label">
                Virtual Assistant
            </span>
        </a>
    </li>
    <li class="slide">
        <a href="/task/list" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-plugin " style="color: #5D66F7"></i>
            <span class="side-menu__label">
                Assign VA's Tasks
            </span>
        </a>
    </li>
    <li class="slide__category"><span class="category-name">Applications</span></li>
    <li class="slide">
        <a href="/file-manager/list" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-folder-symlink" style="color: #5D66F7"></i>
            <span class="side-menu__label">File Manager</span>
        </a>
    </li>
    {{-- <li class="slide">
        <a href="/chat/{{ Auth::user()->id }}" class="side-menu__item">
            <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
            @php
                $last_chat_count = App\Models\Chats::where('receiver_id', Auth::user()->id)
                    ->where('isRead', 0)
                    ->orderBy('id', 'DESC')
                    ->limit(1)
                    ->count();
            @endphp
            <span class="side-menu__label">Messages </span>
            @if ($last_chat_count != 0)
                <span class="mx-2 translate-middle badge !rounded-full bg-danger">
                    {{ $last_chat_count }}</span>
            @endif
        </a>
    </li> --}}

@endif
