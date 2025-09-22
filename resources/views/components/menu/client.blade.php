 <link rel="stylesheet" href="/assets/libs/shepherd.js/css/shepherd.css">
 <script src="/assets/libs/shepherd.js/js/shepherd.min.js"></script>
 <script>
     function tour() {

         "use strict";

         const tour = new Shepherd.Tour({
             defaultStepOptions: {
                 cancelIcon: {
                     enabled: true
                 },
                 classes: 'class-1 class-2',
                 scrollTo: {
                     behavior: 'smooth',
                     block: 'center'
                 }
             },
             useModalOverlay: {
                 enabled: true,
             }
         });

         tour.addStep({
             id: 'dashboard-menu',
             title: '<b style="margin-left: 15px; margin-top: 15px;">Dashboard</b>',
             text: `
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="font-size: 17px; line-height: 25px;  margin-right: -125px; margin-left: 15px; width: 100%; z-index: 1">
                    <strong>Intelligent Workspace Assistant</strong> — Monitor activities, track progress, and navigate your productivity hub from here.
                    </div>
                    <img
                        src="/v1/animated/avatar-point-left.gif"
                        alt="Robot"
                        style="height: 120px; width: auto; object-fit: contain; position: relative; z-index: 0"
                        class="avatar  shadow"
                    />
                </div>

            <hr class="mt-3"/>
             `,
             attachTo: {
                 element: '#dashboard-menu',
                 on: 'right',
             },
             advanceOn: {
                 selector: '#dashboard-menu',
                 event: 'input',
             },
             buttons: [{
                 text: 'Next',
                 action: tour.next,
             }],
         });
         //  <img class="avatar avatar-xl avatar-rounded shadow" src="/storage/profile-photos/VBnWGaMNOkvvXwXLkaqzFGgI9HIF20nsVeIigx62.jpg" alt="Robot">
         // Utility function to reuse common step format
         const createStep = (id, title, description, element) => ({
             id,
             title: `<b style="margin-left: 15px; margin-top: 15px;">${title}</b>`,
             text: `
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 17px; line-height: 25px;  margin-right: -125px; margin-left: 15px; width: 100%; z-index: 1">
                    ${description}
                </div>
                <img
                    src="/v1/animated/avatar-point-left.gif"
                    alt="Robot"
                    style="height: 120px; width: auto; object-fit: contain; position: relative; z-index: 0"
                    class="avatar  shadow"
                />
            </div>
        <hr class="mt-3"/>
    `,
             attachTo: {
                 element,
                 on: 'right',
             },
             advanceOn: {
                 selector: element,
                 event: 'change',
             },
             buttons: [{
                 text: 'Back',
                 action: tour.back,
             }, {
                 text: 'Next',
                 action: tour.next,
             }],
         });

         // Define your steps
         const steps = [{
                 id: 'sales-resources-menu',
                 title: 'Sales Resources',
                 description: 'Track and categorize the origin of your leads to enhance sales efficiency.',
             },
             {
                 id: 'marketing-resources-menu',
                 title: 'Marketing Resources',
                 description: 'Access tools and content to drive your marketing campaigns and lead generation.',
             },
             {
                 id: 'qa-menu',
                 title: 'Quality Assurance',
                 description: 'Ensure the reliability and accuracy of your deliverables with QA checkpoints.',
             },
             {
                 id: 'crm-engagement-menu',
                 title: 'CRM Engagement',
                 description: 'Manage customer interactions and engagement history effectively.',
             },
             {
                 id: 'relationships-menu',
                 title: 'Business Relationships',
                 description: 'View and manage strategic partnerships and client relationships.',
             },
             {
                 id: 'clients-menu',
                 title: 'Clients',
                 description: 'Browse client information, profiles, and communication records.',
             },
             {
                 id: 'manage-projects-menu',
                 title: 'Manage Projects',
                 description: 'Oversee project status, timelines, and assigned team members.',
             },
             {
                 id: 'profit-tracker-menu',
                 title: 'Profit Tracker',
                 description: 'Analyze project margins and profitability in real time.',
             },
             {
                 id: 'file-manager-menu',
                 title: 'File Manager',
                 description: 'Upload, organize, and access project files securely.',
             },
             {
                 id: 'messages-menu',
                 title: 'Messages',
                 description: 'Communicate with your team and clients in a centralized inbox.',
             },
             {
                 id: 'to-do-list-menu',
                 title: 'To-Do List',
                 description: 'Keep track of tasks and subtasks to stay organized and productive.',
             },
             {
                 id: 'social-media-menu',
                 title: 'Social Media',
                 description: 'Manage social accounts and schedule posts from one place.',
             },
             {
                 id: 'generic-leads-menu',
                 title: 'Lead Pool',
                 description: 'View general leads that are not yet categorized or assigned.',
             },
             {
                 id: 'feedback-hub-menu',
                 title: 'Feedback Hub',
                 description: 'Collect and respond to internal and client feedback effectively.',
             },
             {
                 id: 'faq-menu',
                 title: 'FAQ & Help',
                 description: 'Find quick answers to common questions or learn how to use features.',
                 isLast: true
             }
         ];

         // Add steps dynamically
         steps.forEach((step, index) => {
             const config = createStep(step.id, step.title, step.description, `#${step.id}`);
             if (index === steps.length - 1) {
                 config.buttons[1] = {
                     text: 'Finish',
                     action: tour.next,
                 };
             }
             tour.addStep(config);
         });


         tour.start();
     }
 </script>
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
         top: -6px;
         right: -6px;
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
 @if (session('manage_portal_id'))
     @php
         $user_info = App\Models\User::where('id', session('manage_portal_id'))->first();
     @endphp
     @if ($user_info->role == 'Client')
         <li class="slide" id="dashboard-menu">
             <a href="/dashboard" class="side-menu__item">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                 </svg>
                 <span class="side-menu__label mx-2">Dashboard</span>
             </a>
         </li>

         <li class="slide" id="dashboard-menu">
             <a href="/dashboard/sales" class="side-menu__item">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                 </svg>
                 <span class="side-menu__label">Dashboard (Sales)</span>
             </a>
         </li>
         <li class="slide" id="dashboard-menu">
             <a href="https://mail.hostinger.com/" class="side-menu__item">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                 </svg>
                 <span class="side-menu__label">Email Platform (HR)</span>
             </a>
         </li>

         @if (Auth::user()->email == 'demo@hillbcs.com')
             <li class="slide" id="sales-resources-menu">
                 <a href="/file-manager/list/folder?f=1RQtkV94b-2gw-dhKtno3CwxgISEJWC8T&909" class="side-menu__item">
                     <i class="w-6 h-4 side-menu__icon bi bi-bar-chart-line" style="color: #5D66F7"></i>
                     <span class="side-menu__label">Sales Resources</span>
                 </a>
             </li>
             <li class="slide" id="marketing-resources-menu">
                 <a href="/file-manager/list/folder?f=1GjgdzTKANsYqwTVR5ZEtEmMQD0_JDW-y&910" class="side-menu__item">
                     <i class="w-6 h-4 side-menu__icon bi bi-cash-stack" style="color: #5D66F7"></i>
                     <span class="side-menu__label">Marketing Resources</span>
                 </a>
             </li>
             <li class="slide has-sub" id="qa-menu">
                 <a href="javascript:void(0);" class="side-menu__item">
                     <i class="ri-arrow-down-s-line side-menu__angle"></i>
                     <i class="w-6 h-4 side-menu__icon bi bi-layers" style="color: #5D66F7"></i>
                     <span class="side-menu__label">Quality Assurance</span>
                 </a>
                 <ul class="slide-menu child1">
                     <li class="slide" id="qa-photo-menu">
                         <a href="/crm/lead/facebook" class="side-menu__item">Photo</a>
                     </li>
                     <li class="slide" id="qa-reports-menu">
                         <a href="/crm/lead/facebook" class="side-menu__item">Reports</a>
                     </li>
                     <li class="slide" id="qa-feedbacks-menu">
                         <a href="/crm/lead/facebook" class="side-menu__item">Feedbacks</a>
                     </li>
                 </ul>
             </li>
         @endif

         @if (Auth::user()->email == 'cesilia@calcocleaning.net' ||
                 Auth::user()->email == 'douglas.hill2012@gmail.com' ||
                 Auth::user()->email == 'sally.patino71@gmail.com')
             <li class="slide__category" style="color: #09139c !important;"><span
                     class="category-name">Development</span>
             </li>
             <li class="slide">
                 <a href="/project-management/list" class="side-menu__item">
                     <i class="w-6 h-4 side-menu__icon bi bi-receipt-cutoff" style="color: #5D66F7"></i>
                     <span class="side-menu__label">Project Management</span>
                 </a>
             </li>
         @endif
         <li class="slide">
             <a href="/chats/message" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Messages</span>
             </a>
         </li>
         <li class="slide__category"><span class="category-name">Customer Relationships</span> </li>
         <li class="slide" id="crm-engagement-menu">
             <a href="/sales/relationship/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-calendar4-week" style="color: #5D66F7"></i>
                 <span class="side-menu__label">CRM Engagement </span>
             </a>
         </li>
         <li class="slide" id="relationships-menu">
             <a href="/relationship/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-person-square" style="color: #5D66F7"></i>
                 <span class="side-menu__label">
                     Relationships
                 </span>
             </a>
         </li>
         <li class="slide" id="clients-menu">
             <a href="/client/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-people" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Clients</span>
             </a>
         </li>
         <li class="slide__category"><span class="category-name">Project Management</span></li>
         <li class="slide" id="manage-projects-menu">
             <a href="/project/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-journal-bookmark" style="color: #5D66F7"></i>
                 <span class="side-menu__label">
                     Manage Projects
                 </span>
             </a>
         </li>
         {{--     <li class="slide has-sub" id="profit-tracker-menu"> --}}
         {{--                 <a href="javascript:void(0);" class="side-menu__item"> --}}
         {{--                     <i class="ri-arrow-down-s-line side-menu__angle"></i> --}}
         {{--                     <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i> --}}
         {{--                     <span class="side-menu__label">Profit Tracker</span> --}}
         {{--                 </a> --}}
         {{--                 <ul class="slide-menu child1"> --}}
         {{--                     <li class="slide side-menu__label1"> --}}
         {{--                         <a href="javascript:void(0)">Profit Tracker</a> --}}
         {{--                     </li> --}}
         {{--                     <li class="slide" id="profit-tracker-menu-1"> --}}
         {{--                         <a href="/crm/profit/tracker" class="side-menu__item">Profit Tracker</a> --}}
         {{--                     </li> --}}

         {{--                     <li class="slide" id="income-tracking-menu"> --}}
         {{--                         <a href="/profit-tracker/income" class="side-menu__item">Income Tracking</a> --}}
         {{--                     </li> --}}
         {{--                     <li class="slide" id="expense-tracking-menu"> --}}
         {{--                         <a href="/profit-tracker/expense" class="side-menu__item">Expense Tracking</a> --}}
         {{--                     </li> --}}
         {{--                 </ul> --}}
         {{--             </li> --}}

         @if ($lead_profile->company_name !== 'Plan Panther')
             @if (Auth::user()->emal !== 'hr@hillbcs.com')
                 <li class="slide has-sub" id="profit-tracker-menu">
                     <a href="javascript:void(0);" class="side-menu__item">
                         <i class="ri-arrow-down-s-line side-menu__angle"></i>
                         <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i>
                         <span class="side-menu__label">Profit Tracker</span>
                     </a>
                     <ul class="slide-menu child1">
                         <li class="slide side-menu__label1">
                             <a href="javascript:void(0)">Profit Tracker</a>
                         </li>
                         <li class="slide" id="profit-tracker-menu-1">
                             <a href="/crm/profit/tracker" class="side-menu__item">Profit Tracker</a>
                         </li>

                         {{-- <li class="slide" id="income-tracking-menu">
                         <a href="/profit-tracker/income" class="side-menu__item">Income Tracking</a>
                     </li>
                     <li class="slide" id="expense-tracking-menu">
                         <a href="/profit-tracker/expense" class="side-menu__item">Expense Tracking</a>
                     </li> --}}
                     </ul>
                 </li>
             @endif
         @endif
         <li class="slide__category"><span class="category-name">Applications</span></li>
         <li class="slide" id="file-manager-menu">
             <a href="/file-manager/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-folder-symlink" style="color: #5D66F7"></i>
                 <span class="side-menu__label">File Manager</span>
             </a>
         </li>
         {{-- <li class="slide" id="messages-menu">
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
         <li class="slide" id="to-do-list-menu">
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
         <li class="slide__category"><span class="category-name">Generated Leads</span></li>
         <li class="slide has-sub" id="social-media-menu">
             <a href="javascript:void(0);" class="side-menu__item">
                 <i class="ri-arrow-down-s-line side-menu__angle"></i>
                 <i class="w-6 h-4 side-menu__icon bi bi-globe" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Social Media</span>
             </a>
             <ul class="slide-menu child1">
                 <li class="slide" id="profit-tracker-menu-1">
                     <a href="/crm/lead/demo/facebook" class="side-menu__item">Facebook Leads</a>
                 </li>
                 <li class="slide" id="profit-tracker-menu-1">
                     <a href="/crm/lead/demo/youtube" class="side-menu__item">Youtube Leads</a>
                 </li>
                 <li class="slide" id="profit-tracker-menu-1">
                     <a href="/crm/lead/demo/tiktok" class="side-menu__item">TikTok Leads</a>
                 </li>
                 <li class="slide" id="profit-tracker-menu-1">
                     <a href="/crm/lead/demo/linkedin" class="side-menu__item">LinkedIn Leads</a>
                 </li>
                 <li class="slide" id="profit-tracker-menu-1">
                     <a href="/crm/lead/demo/instagram" class="side-menu__item">Instagram Leads</a>
                 </li>
                 <li class="slide" id="profit-tracker-menu-1">
                     <a href="/crm/lead/demo/x" class="side-menu__item">X (Twitter) Leads</a>
                 </li>

             </ul>
         </li>
         <li class="slide" id="generic-leads-menu">
             <a href="/crm/lead/generic" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-database-up" style="color: #5D66F7"></i>
                 <span class="side-menu__label">
                     Actionable Leads
                 </span>
             </a>
         </li>
     @endif
 @endif

 @if (Auth::user()->role == 'Client')
     <li class="slide" id="dashboard-menu">
         <a href="/dashboard" class="side-menu__item">
             <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round"
                     d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
             </svg>
             <span class="side-menu__label mx-2">Dashboard</span>
         </a>
     </li>

     <li class="slide" id="dashboard-menu">
         <a href="/dashboard/sales" class="side-menu__item">
             <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round"
                     d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
             </svg>
             <span class="side-menu__label">Dashboard (Sales)</span>
         </a>
     </li>
     <li class="slide" id="dashboard-menu">
         <a href="https://mail.hostinger.com/" class="side-menu__item">
             <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" style="color: #5D66F7"
                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round"
                     d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
             </svg>
             <span class="side-menu__label">Email Platform (HR)</span>
         </a>
     </li>

     @if (Auth::user()->email == 'demo@hillbcs.com')
         <li class="slide" id="sales-resources-menu">
             <a href="/file-manager/list/folder?f=1RQtkV94b-2gw-dhKtno3CwxgISEJWC8T&909" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-bar-chart-line" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Sales Resources</span>
             </a>
         </li>
         <li class="slide" id="marketing-resources-menu">
             <a href="/file-manager/list/folder?f=1GjgdzTKANsYqwTVR5ZEtEmMQD0_JDW-y&910" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-cash-stack" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Marketing Resources</span>
             </a>
         </li>
         <li class="slide has-sub" id="qa-menu">
             <a href="javascript:void(0);" class="side-menu__item">
                 <i class="ri-arrow-down-s-line side-menu__angle"></i>
                 <i class="w-6 h-4 side-menu__icon bi bi-layers" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Quality Assurance</span>
             </a>
             <ul class="slide-menu child1">
                 <li class="slide" id="qa-photo-menu">
                     <a href="/crm/lead/facebook" class="side-menu__item">Photo</a>
                 </li>
                 <li class="slide" id="qa-reports-menu">
                     <a href="/crm/lead/facebook" class="side-menu__item">Reports</a>
                 </li>
                 <li class="slide" id="qa-feedbacks-menu">
                     <a href="/crm/lead/facebook" class="side-menu__item">Feedbacks</a>
                 </li>
             </ul>
         </li>
     @endif

     @if (Auth::user()->email == 'cesilia@calcocleaning.net' ||
             Auth::user()->email == 'douglas.hill2012@gmail.com' ||
             Auth::user()->email == 'sally.patino71@gmail.com')
         <li class="slide__category" style="color: #09139c !important;"><span
                 class="category-name">Development</span>
         </li>
         <li class="slide">
             <a href="/project-management/list" class="side-menu__item">
                 <i class="w-6 h-4 side-menu__icon bi bi-receipt-cutoff" style="color: #5D66F7"></i>
                 <span class="side-menu__label">Project Management</span>
             </a>
         </li>
     @endif
     <li class="slide">
         <a href="/chats/message" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-chat-dots" style="color: #5D66F7"></i>
             <span class="side-menu__label">Messages</span>
         </a>
     </li>
     <li class="slide__category"><span class="category-name">Customer Relationships</span> </li>
     <li class="slide" id="crm-engagement-menu">
         <a href="/sales/relationship/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-calendar4-week" style="color: #5D66F7"></i>
             <span class="side-menu__label">CRM Engagement </span>
         </a>
     </li>
     <li class="slide" id="relationships-menu">
         <a href="/relationship/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-person-square" style="color: #5D66F7"></i>
             <span class="side-menu__label">
                 Relationships
             </span>
         </a>
     </li>
     <li class="slide" id="clients-menu">
         <a href="/client/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-people" style="color: #5D66F7"></i>
             <span class="side-menu__label">Clients</span>
         </a>
     </li>
     <li class="slide__category"><span class="category-name">Project Management</span></li>
     <li class="slide" id="manage-projects-menu">
         <a href="/project/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-journal-bookmark" style="color: #5D66F7"></i>
             <span class="side-menu__label">
                 Manage Projects
             </span>
         </a>
     </li>
     {{--     <li class="slide has-sub" id="profit-tracker-menu"> --}}
     {{--                 <a href="javascript:void(0);" class="side-menu__item"> --}}
     {{--                     <i class="ri-arrow-down-s-line side-menu__angle"></i> --}}
     {{--                     <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i> --}}
     {{--                     <span class="side-menu__label">Profit Tracker</span> --}}
     {{--                 </a> --}}
     {{--                 <ul class="slide-menu child1"> --}}
     {{--                     <li class="slide side-menu__label1"> --}}
     {{--                         <a href="javascript:void(0)">Profit Tracker</a> --}}
     {{--                     </li> --}}
     {{--                     <li class="slide" id="profit-tracker-menu-1"> --}}
     {{--                         <a href="/crm/profit/tracker" class="side-menu__item">Profit Tracker</a> --}}
     {{--                     </li> --}}

     {{--                     <li class="slide" id="income-tracking-menu"> --}}
     {{--                         <a href="/profit-tracker/income" class="side-menu__item">Income Tracking</a> --}}
     {{--                     </li> --}}
     {{--                     <li class="slide" id="expense-tracking-menu"> --}}
     {{--                         <a href="/profit-tracker/expense" class="side-menu__item">Expense Tracking</a> --}}
     {{--                     </li> --}}
     {{--                 </ul> --}}
     {{--             </li> --}}

     @if ($lead_profile->company_name !== 'Plan Panther')
         @if (Auth::user()->emal !== 'hr@hillbcs.com')
             <li class="slide has-sub" id="profit-tracker-menu">
                 <a href="javascript:void(0);" class="side-menu__item">
                     <i class="ri-arrow-down-s-line side-menu__angle"></i>
                     <i class="w-6 h-4 side-menu__icon bi bi-cash-coin" style="color: #5D66F7"></i>
                     <span class="side-menu__label">Profit Tracker</span>
                 </a>
                 <ul class="slide-menu child1">
                     <li class="slide side-menu__label1">
                         <a href="javascript:void(0)">Profit Tracker</a>
                     </li>
                     <li class="slide" id="profit-tracker-menu-1">
                         <a href="/crm/profit/tracker" class="side-menu__item">Profit Tracker</a>
                     </li>

                     {{-- <li class="slide" id="income-tracking-menu">
                         <a href="/profit-tracker/income" class="side-menu__item">Income Tracking</a>
                     </li>
                     <li class="slide" id="expense-tracking-menu">
                         <a href="/profit-tracker/expense" class="side-menu__item">Expense Tracking</a>
                     </li> --}}
                 </ul>
             </li>
         @endif
     @endif
     <li class="slide__category"><span class="category-name">Applications</span></li>
     <li class="slide" id="file-manager-menu">
         <a href="/file-manager/list" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-folder-symlink" style="color: #5D66F7"></i>
             <span class="side-menu__label">File Manager</span>
         </a>
     </li>
     {{-- <li class="slide" id="messages-menu">
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
     <li class="slide" id="to-do-list-menu">
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
     <li class="slide__category"><span class="category-name">Generated Leads</span></li>
     <li class="slide has-sub" id="social-media-menu">
         <a href="javascript:void(0);" class="side-menu__item">
             <i class="ri-arrow-down-s-line side-menu__angle"></i>
             <i class="w-6 h-4 side-menu__icon bi bi-globe" style="color: #5D66F7"></i>
             <span class="side-menu__label">Social Media</span>
         </a>
         <ul class="slide-menu child1">
             <li class="slide" id="profit-tracker-menu-1">
                 <a href="/crm/lead/demo/facebook" class="side-menu__item">Facebook Leads</a>
             </li>
             <li class="slide" id="profit-tracker-menu-1">
                 <a href="/crm/lead/demo/youtube" class="side-menu__item">Youtube Leads</a>
             </li>
             <li class="slide" id="profit-tracker-menu-1">
                 <a href="/crm/lead/demo/tiktok" class="side-menu__item">TikTok Leads</a>
             </li>
             <li class="slide" id="profit-tracker-menu-1">
                 <a href="/crm/lead/demo/linkedin" class="side-menu__item">LinkedIn Leads</a>
             </li>
             <li class="slide" id="profit-tracker-menu-1">
                 <a href="/crm/lead/demo/instagram" class="side-menu__item">Instagram Leads</a>
             </li>
             <li class="slide" id="profit-tracker-menu-1">
                 <a href="/crm/lead/demo/x" class="side-menu__item">X (Twitter) Leads</a>
             </li>

         </ul>
     </li>
     <li class="slide" id="generic-leads-menu">
         <a href="/crm/lead/generic" class="side-menu__item">
             <i class="w-6 h-4 side-menu__icon bi bi-database-up" style="color: #5D66F7"></i>
             <span class="side-menu__label">
                 Actionable Leads
             </span>
         </a>
     </li>
 @endif
