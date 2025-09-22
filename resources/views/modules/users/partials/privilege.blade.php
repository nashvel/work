@php
    $user = App\Models\User::with('permissions.route')->findOrFail($id);
    $routes = App\Models\Privilege\Route::where('is_active', true)->orderBy('sort_order')->get();

    $currentPermissions = $user->permissions->pluck('is_allowed', 'route_id')->toArray();

    //return view('manager.permissions', compact('user', 'routes', 'currentPermissions'));

    use Illuminate\Support\Str;

    /** @var \Illuminate\Database\Eloquent\Collection $routes */
    // Group routes by group_label (fallback = "Ungrouped")
    $grouped = collect($routes)->groupBy(fn($r) => trim($r->group_label ?? '') ?: 'Ungrouped');
@endphp

<div class="space-y-8">

    @foreach ($grouped as $groupLabel => $items)
        @php $groupId = Str::slug($groupLabel) ?: 'group-ungrouped'; @endphp

        <!-- Group header -->
        <hr class="!mb-3" style="margin-top: 15px">

        <div class="flex items-center justify-between gap-3 !mt-0">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                {{ $groupLabel }}
                <span class="ml-2 text-sm text-gray-400">({{ $items->count() }})</span>
            </h3>

            <div class="inline-flex gap-2">
                <button type="button" onclick="window.permissionsHook?.toggleGroup('{{ $groupId }}', true)"
                    class="inline-flex items-center gap-1 rounded-lg border border-emerald-300/70 bg-emerald-50 px-2.5 py-1.5 text-xs font-medium text-gray-700 hover:bg-emerald-100">
                    <i class="bi bi-check2-circle"></i> Allow all
                </button>

                <button type="button" onclick="window.permissionsHook?.toggleGroup('{{ $groupId }}', false)"
                    class="inline-flex items-center gap-1 rounded-lg border border-red-300/70 bg-rose-50 px-2.5 py-1.5 text-xs font-medium text-gray-700 hover:bg-rose-100">
                    <i class="bi bi-x-circle"></i> Deny all
                </button>

            </div>
        </div>

        <!-- Group body -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 !mt-3" id="routes-{{ $groupId }}">
            @foreach ($items as $route)
                @php
                    // If you don't already have $groupId in scope, derive a safe one per route:
// use Illuminate\Support\Str;
// $groupId = Str::slug($route->group_label ?? 'general', '-');
                    $isAllowed = !empty($currentPermissions[$route->id]);
                @endphp

                <div class="flex items-start justify-between bg-gray-50 dark:bg-gray-700 rounded-lg p-5">
                    <!-- Left: name + description + path -->
                    <div class="mail-notification-settings">
                        <p class="text-2xl mb-1 text-gray-700 dark:text-gray-100">
                            <strong>{{ $route->title }}</strong>
                        </p>
                        @if (!empty($route->description))
                            <p class="text-md mb-1 text-gray-600 dark:text-gray-300/80">{{ $route->description }}</p>
                        @endif
                        {{-- <p class="text-[11px] text-gray-500 dark:text-gray-300/60 font-mono">
                            <span
                                class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-600/60">{{ $route->path }}</span>
                        </p> --}}
                    </div>

                    <!-- Right: the switch + status -->
                    <div class="mb-0 sm:float-end text-right pt-3">
                        <div class="relative inline-block align-middle">
                            <input type="checkbox" id="route-{{ $route->id }}" name="routes[{{ $route->id }}]"
                                value="1"
                                class="permission-toggle peer relative shrink-0 w-[4.25rem] h-9 p-px
                                    bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer
                                    transition-colors ease-in-out duration-200 focus:ring-primary
                                    disabled:opacity-50 disabled:pointer-events-none
                                    checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary
                                    dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                                    before:inline-block before:w-8 before:h-8 before:bg-white
                                    checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full
                                    before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200
                                    dark:before:bg-black/20 dark:checked:before:bg-white"
                                data-group-id="{{ $groupId ?? '' }}" data-route-id="{{ $route->id }}"
                                data-user-id="{{ $user->id }}" {{ $isAllowed ? 'checked' : '' }}
                                data-initial-state="{{ $isAllowed ? 'true' : 'false' }}"
                                onchange="window.permissionsHook && window.permissionsHook.handleToggleChange(this)">
                            <label for="route-{{ $route->id }}" class="sr-only">Toggle {{ $route->title }}</label>

                            <!-- X icon (left) -->
                            <span
                                class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5
                   flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </span>

                            <!-- Check icon (right) -->
                            <span
                                class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5
                   flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </span>
                        </div>

                        <!-- Status text (updated by your JS) -->
                        <div class="mt-1 text-[11px]">
                            <span class="permission-status {{ $isAllowed ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $isAllowed ? 'Allowed' : 'Denied' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

</div>

<script>
    // Augment your existing permissionsHook with group helpers
    window.permissionsHook = window.permissionsHook || {};

    // Toggle an entire group (allow=true to check, false to uncheck)
    window.permissionsHook.toggleGroup = function(groupId, allow) {
        const container = document.getElementById('routes-' + groupId);
        if (!container) return;

        const boxes = container.querySelectorAll('input.permission-toggle[data-group-id="' + groupId + '"]');
        boxes.forEach(cb => {
            // Skip if it already matches target state
            if (!!cb.checked === !!allow) return;
            cb.checked = allow;

            // Fire the same change handler you already use so UI + server stay in sync
            const evt = new Event('change', {
                bubbles: true
            });
            cb.dispatchEvent(evt);
        });
    };
</script>

<script src="{{ asset('js/toast.js') }}"></script>
<script src="{{ asset('js/permissions-hook.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.toast = new Toast();
        window.permissionsHook = new PermissionsHook({
            updateUrl: '{{ route('manager.permissions.update', $user) }}',
            previewUrl: '{{ route('manager.preview', $user) }}',
            csrfToken: '{{ csrf_token() }}'
        });

        // Initialize styles on first paint
        document.querySelectorAll('.permission-toggle').forEach(t => {
            window.permissionsHook.updateToggleStyle(t);
        });
    });
</script>


{{-- <div class="grid grid-cols-12 gap-x-6">
     <div class="xxl:col-span-5 col-span-5">
         <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Portal Privilege</strong>
         </h6>
         <span>You can modify the user portal privilege here.</span>
         <hr class="mb-3 !mt-3">
         @if ($errors->any())
             <div
                 class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                 <div>
                     <strong class="text-danger">Whoops! Something went wrong:</strong>
                     <ul class="list-disc list-inside mt-2 mx-4">
                         @foreach ($errors->all() as $error)
                             <li class="text-dark"><i>{{ $error }}</i></li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         @endif
         <p class="text-[1rem] mb-1 font-lg text-gray-700"> <strong>Email Notifications</strong></p>
         <p class="text-xs mb-0 dark:/50">
             Email notifications are the notifications you will receeive
             when you are offline, you can customize them by enabling or
             disabling them.</p>
     </div>
     <div class="xxl:col-span-7 col-span-7">
         <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Tools</strong>
         </h6>
         <span>You can adjust credit here.</span>
         <hr class="mb-3 !mt-3">

         <div class="flex items-top justify-between mt-3">
             <div class="mail-notification-settings">
                 <p class="text-[14px] mb-1 text-gray-700">
                     <strong>Early Access</strong>
                 </p>
                 <p class="text-xs mb-0  dark:/50">
                     Users are selected for beta testing of new
                     update,notifications relating or participate in any
                     of paid product promotion.</p>
             </div>
             <div class="mb-0 sm:float-end">
                 <div class="relative inline-block">
                     <input type="checkbox" id="hs-large-solid-switch-with-icons"
                         class="peer relative shrink-0 w-[4.25rem] h-9 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                    
                      before:inline-block before:w-8 before:h-8 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-black/20 dark:checked:before:bg-white">
                     <label for="hs-large-solid-switch-with-icons" class="sr-only">switch</label>
                     <span
                         class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                         <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                             <path d="M18 6 6 18" />
                             <path d="m6 6 12 12" />
                         </svg>
                     </span>
                     <span
                         class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                         <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                             <polyline points="20 6 9 17 4 12" />
                         </svg>
                     </span>
                 </div>
             </div>
         </div>
         <div class="flex items-top justify-between mt-3">
             <div class="mail-notification-settings">
                 <p class="text-[14px] mb-1 text-gray-700">
                     <strong> Email Shortcuts</strong>
                 </p>
                 <p class="text-xs mb-0  dark:/50">
                     Shortcut notifications for email.</p>
             </div>
             <div class="mb-0 sm:float-end">
                 <div class="relative inline-block">
                     <input type="checkbox" checked id="hs-large-solid-switch-with-icons"
                         class="peer relative shrink-0 w-[4.25rem] h-9 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                    
                      before:inline-block before:w-8 before:h-8 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-black/20 dark:checked:before:bg-white">
                     <label for="hs-large-solid-switch-with-icons" class="sr-only">switch</label>
                     <span
                         class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                         <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                             <path d="M18 6 6 18" />
                             <path d="m6 6 12 12" />
                         </svg>
                     </span>
                     <span
                         class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                         <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                             <polyline points="20 6 9 17 4 12" />
                         </svg>
                     </span>
                 </div>
             </div>
         </div>
     </div>

     
 </div> --}}


{{-- @php
     $groupedModules = [
         'CRM' => [
             'crm_engagement' => [
                 'label' => 'CRM Engagement',
                 'desc' =>
                     'Monitor and manage ongoing customer relationship activities, follow-ups, and engagement logs.',
             ],
             'relationships' => [
                 'label' => 'Relationships',
                 'desc' => 'Track and manage professional relationships with partner companies and clients.',
             ],
             'clients' => [
                 'label' => 'Clients',
                 'desc' => 'Access, organize, and update detailed records of all registered clients.',
             ],
         ],
         'Projects' => [
             'projects' => [
                 'label' => 'Manage Projects',
                 'desc' => 'View, organize, and track all assigned or initiated projects within your portal.',
             ],
             'bid_invitations' => [
                 'label' => 'Project Invitations',
                 'desc' => 'Review and respond to invitations for bidding on upcoming projects.',
             ],
             'projects_accepted' => [
                 'label' => 'Projects Accepted',
                 'desc' => 'List and manage projects you’ve accepted to work on as a contractor or sub-client.',
             ],
             'profit_tracker' => [
                 'label' => 'Profit Tracker',
                 'desc' => 'Track revenue, expenses, and generate profitability reports for business activities.',
             ],
             'income_tracking' => [
                 'label' => 'Income Tracking',
                 'desc' => 'Record and analyze all incoming financial data for accurate profit monitoring.',
             ],
             'expense_tracking' => [
                 'label' => 'Expense Tracking',
                 'desc' => 'Manage and categorize operational and project-related expenses.',
             ],
         ],
         'Leads' => [
             'leads_facebook' => [
                 'label' => 'Facebook Leads',
                 'desc' => 'Collect and manage lead data generated through Facebook ad campaigns.',
             ],
             'leads_youtube' => [
                 'label' => 'YouTube Leads',
                 'desc' => 'Handle leads sourced from YouTube marketing or video content engagement.',
             ],
             'leads_tiktok' => [
                 'label' => 'TikTok Leads',
                 'desc' => 'Track outreach and lead capture through TikTok content campaigns.',
             ],
             'leads_linkedin' => [
                 'label' => 'LinkedIn Leads',
                 'desc' => 'Manage leads from professional LinkedIn outreach and advertising.',
             ],
             'leads_instagram' => [
                 'label' => 'Instagram Leads',
                 'desc' => 'Engage with and convert Instagram-based marketing leads.',
             ],
             'leads_x' => [
                 'label' => 'X (Twitter) Leads',
                 'desc' => 'Track and manage social media leads generated from X (formerly Twitter).',
             ],
             'leads_generic' => [
                 'label' => 'Actionable Leads',
                 'desc' => 'Filter, tag, and manage general or manually captured leads.',
             ],
         ],
         'Tools' => [
             'file_manager' => [
                 'label' => 'File Manager',
                 'desc' => 'Upload, download, and organize shared documents and media files.',
             ],
             'live_chat' => [
                 'label' => 'Live Portal Chat',
                 'desc' => 'Real-time support and communication with other portal users or teams.',
             ],
             'todo' => [
                 'label' => 'To-do List',
                 'desc' => 'Assign, monitor, and complete personal or team-based task items.',
             ],
         ],
         'Content Management' => [
             'cms_banner' => [
                 'label' => 'Banner',
                 'desc' => 'Update homepage banners and key visuals displayed on the website.',
             ],
             'cms_about_us' => [
                 'label' => 'About Us',
                 'desc' => 'Edit and maintain information shown on the “About Us” section.',
             ],
             'cms_clients' => [
                 'label' => 'Client Section',
                 'desc' => 'Manage client logos, testimonials, or recognition in the client showcase.',
             ],
             'cms_teams' => [
                 'label' => 'Team Member',
                 'desc' => 'Update team profiles including names, titles, and bios.',
             ],
             'cms_gallery' => [
                 'label' => 'Image Gallery',
                 'desc' => 'Upload and manage photos displayed on the portal’s image gallery.',
             ],
             'cms_partners' => [
                 'label' => 'Partners Section',
                 'desc' => 'Showcase partners, collaborators, or stakeholders involved in the business.',
             ],
             'cms_inquiry_logs' => [
                 'label' => 'Inquiry Logs',
                 'desc' => 'Track and view messages sent through the website’s inquiry forms.',
             ],
             'chatbot' => [
                 'label' => 'Chatbot',
                 'desc' => 'Configure auto-response and guided chat flows using the system chatbot.',
             ],
         ],
         'Workspace Access' => [
             'virtual_assistants' => [
                 'label' => 'Virtual Assistant Access',
                 'desc' => 'Control workspace access for assigned virtual assistants.',
             ],
             'directors_workspace' => [
                 'label' => 'Director\'s Workspace',
                 'desc' => 'Portal space for directors to view high-level company and client data.',
             ],
             'client_workspace' => [
                 'label' => 'Client Workspace',
                 'desc' => 'Access and manage the workspace interface for client-side activities.',
             ],
             'crm_workspace' => [
                 'label' => 'CRM Workspace',
                 'desc' => 'Access portal area focused on CRM tasks and customer information.',
             ],
         ],
         'Management' => [
             'client_management' => [
                 'label' => 'Manage Clients',
                 'desc' => 'Administer client data including onboarding and access permissions.',
             ],
             'virtual_assistant_management' => [
                 'label' => 'Virtual Assistant',
                 'desc' => 'List and manage all virtual assistants working under the system.',
             ],
             'task_assignment' => [
                 'label' => 'Assign VA\'s Tasks',
                 'desc' => 'Create, assign, and monitor tasks for virtual assistants.',
             ],
         ],
     ];

     // Enable all by default
     $enabledModules = [];
     foreach ($groupedModules as $modules) {
         foreach ($modules as $key => $item) {
             $enabledModules[$key] = true;
         }
     }
 @endphp --}}

{{-- @foreach ($groupedModules as $group => $modules)
     <div class="grid grid-cols-12 gap-x-6 ">
      
         <div class="xxl:col-span-5 col-span-5">

             <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                 <strong>{{ $group }} Modules</strong>
             </h6>
             <span>You can modify {{ strtolower($group) }} module privileges here.</span>
             <hr class="mb-3 !mt-3">

         </div>

         <div class="xxl:col-span-7 col-span-7">
             <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                 <strong>{{ $group === 'Tools' ? 'Tools' : 'Modules' }}</strong>
             </h6>
             <span>Toggle access for the modules below.</span>
             <hr class="mb-3 !mt-3">
             @foreach ($modules as $key => $mod)
                 <div class="flex items-top justify-between mt-3">
                     <div class="mail-notification-settings">
                         <p class="text-[14px] mb-1 text-gray-700">
                             <strong>{{ $mod['label'] }}</strong>
                         </p>
                         <p class="text-xs mb-0 dark:/50">{{ $mod['desc'] }}</p>
                     </div>
                     <div class="mb-0 sm:float-end">
                         <div class="relative inline-block">
                             <input type="checkbox" name="modules[{{ $key }}]" id="module-{{ $key }}"
                                 value="1"
                                 class="peer relative shrink-0 w-[4.25rem] h-9 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                                before:inline-block before:w-8 before:h-8 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-black/20 dark:checked:before:bg-white"
                                 {{ isset($enabledModules[$key]) && $enabledModules[$key] ? 'checked' : '' }}>
                             <label for="module-{{ $key }}" class="sr-only">Toggle {{ $mod['label'] }}</label>
                             <span
                                 class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                     <path d="M18 6 6 18" />
                                     <path d="m6 6 12 12" />
                                 </svg>
                             </span>
                             <span
                                 class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                     <polyline points="20 6 9 17 4 12" />
                                 </svg>
                             </span>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 @endforeach --}}
