 @if (session('manage_portal_id'))
     @php
         $user_info = App\Models\User::where('id', session('manage_portal_id'))->first();
     @endphp
     @if ($user_info->role == 'Sub-Client')
         <li class="slide">
             <a href="/dashboard/member" class="side-menu__item">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                 </svg>
                 <span class="side-menu__label">Dashboard</span>
             </a>
         </li>
         <li class="slide__category"><span class="category-name">CRM</span></li>
         <li class="slide">
             <a href="/relationship/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-person-video2" style="color: #5D66F7"></i>
                 <span class="side-menu__label">
                     Relationships
                 </span>
             </a>
         </li>
         <li class="slide__category"><span class="category-name">Project Management</span></li>
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
                         ->where('status', 'Ready')
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
                     Projects Accepted
                 </span>
             </a>
         </li>
         <li class="slide" id="manage-projects-menu">
             <a href="/project/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-journal-bookmark" style="color: #5D66F7"></i>
                 <span class="side-menu__label">
                     My Projects
                 </span>
             </a>
         </li>
         {{-- <li class="slide">
         <a href="/crm/profit/tracker" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i>
             <span class="side-menu__label">
                 Profit Tracker
             </span>
         </a>
     </li> --}}

         @if ($lead_profile->company_name !== 'Plan Panther')
             @if (Auth::user()->emal !== 'hr@hillbcs.com')
                 <li class="slide has-sub">
                     <a href="javascript:void(0);" class="side-menu__item">
                         <i class="ri-arrow-down-s-line side-menu__angle"></i>
                         <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i>
                         <span class="side-menu__label">Profit Tracker</span>
                     </a>
                     <ul class="slide-menu child1">
                         <li class="slide side-menu__label1">
                             <a href="javascript:void(0)">Profit Tracker</a>
                         </li>
                         <li class="slide">
                             <a href="/crm/profit/tracker" class="side-menu__item">Profit Tracker</a>
                         </li>
                         {{-- <li class="slide">
                     <a href="/profit-tracker/bids" class="side-menu__item">Bids Sents</a>
                 </li>
                 <li class="slide">
                     <a href="/profit-tracker/cors" class="side-menu__item">CORs Pending</a>
                 </li> --}}

                         <li class="slide">
                             <a href="/profit-tracker/income" class="side-menu__item">Income Tracking</a>
                         </li>
                         <li class="slide">
                             <a href="/profit-tracker/expense" class="side-menu__item">Expense Tracking</a>
                         </li>
                     </ul>
                 </li>
             @endif
         @endif
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
         @php
             $id = Auth::user()->id;
             $token = Crypt::encryptString("user:{$id}|time:" . now()->timestamp);
             $url = url("/api/launch-chat/{$token}/{$id}");
         @endphp
         {{-- <li class="slide" id="messages-menu">
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
     </li> --}}
         <li class="slide">
             <a href="/chats/message" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Messages</span>
             </a>
         </li>
         <li class="slide">
             <a href="/todo/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-list-check" style="color: #5D66F7"></i>
                 <span class="side-menu__label">To do List</span>
                 {{-- @if ($last_chat_count != 0)
                    <span class="mx-2 translate-middle badge !rounded-full bg-warning">
                        7
                    </span>
                @endif --}}
             </a>
         </li>
     @endif
 @endif
 @if (Auth::user()->role == 'Sub-Client')
     <li class="slide">
         <a href="/dashboard/member" class="side-menu__item">
             <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round"
                     d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
             </svg>
             <span class="side-menu__label">Dashboard</span>
         </a>
     </li>
     <li class="slide__category"><span class="category-name">CRM</span></li>
     <li class="slide">
         <a href="/relationship/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-person-video2" style="color: #5D66F7"></i>
             <span class="side-menu__label">
                 Relationships
             </span>
         </a>
     </li>
     <li class="slide__category"><span class="category-name">Project Management</span></li>
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
                     ->where('status', 'Ready')
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
                 Projects Accepted
             </span>
         </a>
     </li>
     <li class="slide" id="manage-projects-menu">
         <a href="/project/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-journal-bookmark" style="color: #5D66F7"></i>
             <span class="side-menu__label">
                 My Projects
             </span>
         </a>
     </li>
     {{-- <li class="slide">
         <a href="/crm/profit/tracker" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i>
             <span class="side-menu__label">
                 Profit Tracker
             </span>
         </a>
     </li> --}}

     @if ($lead_profile->company_name !== 'Plan Panther')
         @if (Auth::user()->emal !== 'hr@hillbcs.com')
             <li class="slide has-sub">
                 <a href="javascript:void(0);" class="side-menu__item">
                     <i class="ri-arrow-down-s-line side-menu__angle"></i>
                     <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i>
                     <span class="side-menu__label">Profit Tracker</span>
                 </a>
                 <ul class="slide-menu child1">
                     <li class="slide side-menu__label1">
                         <a href="javascript:void(0)">Profit Tracker</a>
                     </li>
                     <li class="slide">
                         <a href="/crm/profit/tracker" class="side-menu__item">Profit Tracker</a>
                     </li>
                     {{-- <li class="slide">
                     <a href="/profit-tracker/bids" class="side-menu__item">Bids Sents</a>
                 </li>
                 <li class="slide">
                     <a href="/profit-tracker/cors" class="side-menu__item">CORs Pending</a>
                 </li> --}}

                     <li class="slide">
                         <a href="/profit-tracker/income" class="side-menu__item">Income Tracking</a>
                     </li>
                     <li class="slide">
                         <a href="/profit-tracker/expense" class="side-menu__item">Expense Tracking</a>
                     </li>
                 </ul>
             </li>
         @endif
     @endif
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
     @php
         $id = Auth::user()->id;
         $token = Crypt::encryptString("user:{$id}|time:" . now()->timestamp);
         $url = url("/api/launch-chat/{$token}/{$id}");
     @endphp
     {{-- <li class="slide" id="messages-menu">
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
     </li> --}}
     <li class="slide">
         <a href="/chats/message" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
             <span class="side-menu__label">Messages</span>
         </a>
     </li>
     <li class="slide">
         <a href="/todo/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-list-check" style="color: #5D66F7"></i>
             <span class="side-menu__label">To do List</span>
             {{-- @if ($last_chat_count != 0)
                    <span class="mx-2 translate-middle badge !rounded-full bg-warning">
                        7
                    </span>
                @endif --}}
         </a>
     </li>
 @endif
