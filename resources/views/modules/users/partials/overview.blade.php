 <div class="grid grid-cols-12 gap-x-6">
     <div class="xxl:col-span-7 col-span-7">
         <div class="box shadow-none border">
             <div class="box-body">
                 <form action="{{ route('relationship.contact.update', $info->id) }}" method="POST"
                     enctype="multipart/form-data" autocomplete="on">
                     @csrf
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


                     <div class="xl:col-span-12 col-span-12">
                         <div class="flex items-start flex-wrap gap-4">
                             <div>
                                 <span class="avatar avatar-xxl">
                                     <img src="{{ asset('storage/' . $info->profile_photo_path) }}"
                                         onerror="this.src ='/user.png'" alt="Avatar" id="profile-img">
                                 </span>
                             </div>
                             <div>
                                 <span class="font-medium block mb-2">Profile Picture</span>
                                 <div class="btn-list mb-1">
                                     <label for="profile-change"
                                         class="ti-btn ti-btn-sm ti-btn-soft-light text-dark btn-wave waves-effect waves-light">
                                         <i class="ri-upload-2-line me-1"></i>Change Image
                                     </label>
                                     <input type="file" name="photo" id="profile-change" class="hidden"
                                         accept="image/*">
                                     <button type="button"
                                         class="ti-btn ti-btn-sm ti-btn-light btn-wave waves-effect waves-light"><i
                                             class="ri-delete-bin-line me-1"></i>Remove</button>
                                 </div>
                                 <span class="block text-xs text-textmuted dark:text-textmuted/50">
                                     Use JPEG, PNG, or GIF. Best size: 200x200 pixels. Keep it under 5MB
                                 </span>
                             </div>
                         </div>
                     </div>

                     <!-- JavaScript to handle image preview -->
                     <script>
                         document.getElementById('profile-change').addEventListener('change', function(event) {
                             const file = event.target.files[0];
                             if (file) {
                                 const reader = new FileReader();
                                 reader.onload = function(e) {
                                     document.getElementById('profile-img').src = e.target.result;
                                 };
                                 reader.readAsDataURL(file);
                             }
                         });

                         document.getElementById('remove-img').addEventListener('click', function() {
                             document.getElementById('profile-img').src = "/assets/images/faces/9.jpg"; // Default image
                             document.getElementById('profile-change').value = ''; // Clear file input
                         });
                     </script>
                     <br>
                     {{-- {{ $info }}
                     <hr>
                     {{ $lead = App\Models\Lead::where('email', $info->email)->first() }} --}}

                     <table class="ti-custom-table !border border-defaultborder dark:border-defaultborder/10">
                         <tbody>
                             <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10"
                                     width="120">
                                     First Name:</td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="first_name" value="{{ $info->first_name }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Enter first name">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-person"></i>
                                         </div>
                                     </div>
                                 </td>
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10"
                                     width="120">
                                     Last Name:
                                 </td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="last_name" value="{{ $info->last_name }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Enter last name">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-person"></i>
                                         </div>
                                     </div>
                                 </td>
                             </tr>

                             <!-- Position / Location -->
                             <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10">
                                     Position:</td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="position" value="{{ $info->position }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Enter position">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-building"></i>
                                         </div>
                                     </div>
                                 </td>
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10">
                                     Location:</td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="location" value="{{ $info->location }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Enter location">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-geo-alt"></i>
                                         </div>
                                     </div>
                                 </td>
                             </tr>

                             <!-- Phone / Facebook -->
                             <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10">
                                     Phone:</td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="phone" value="{{ $info->phone }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Phone number">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-telephone"></i>
                                         </div>
                                     </div>
                                 </td>
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10">
                                     Facebook:</td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="facebook" value="{{ $info->facebook }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Facebook URL">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-facebook"></i>
                                         </div>
                                     </div>
                                 </td>
                             </tr>

                             <!-- Twitter / LinkedIn -->
                             <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10">
                                     Twitter / X:</td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="twitter" value="{{ $info->twitter }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Twitter handle">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-twitter"></i>
                                         </div>
                                     </div>
                                 </td>
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10">
                                     LinkedIn:</td>
                                 <td
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <input type="text" name="linkedin" value="{{ $info->linkedin }}"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="LinkedIn profile">
                                         <div
                                             class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-linkedin"></i>
                                         </div>
                                     </div>
                                 </td>
                             </tr>

                             <!-- Bio -->
                             <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                 <td class="text-end border border-defaultborder dark:border-defaultborder/10">
                                     Bio:</td>
                                 <td colspan="3"
                                     class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-0 !m-0">
                                     <div class="relative p-1">
                                         <textarea name="biography" rows="2"
                                             class="ti-form-input border bg-gray-50 border-gray-300 rounded-md  text-dark ps-11 focus:z-10"
                                             placeholder="Write a short bio...">{{ $info->biography }}</textarea>
                                         <div
                                             class="absolute top-4 start-0 flex items-center ps-4 pointer-events-none">
                                             <i class="bi bi-pencil-square"></i>
                                         </div>
                                     </div>
                                 </td>
                             </tr>

                             <input type="hidden" name="contact_id" value="{{ $id }}">
                         </tbody>
                     </table>

                     <div class="pt-4 flex gap-3 justify-end">
                         <button type="submit" id="step-3"
                             class="bg-gray-50 text-dark px-4 py-2 rounded-md hover:bg-green-800 transition">
                             <i class="bi bi-check2-circle"></i>
                             <span class="mx-1">Save Changes</span>
                         </button>
                         <button type="submit" id="step-3"
                             class="bg-gray-50 text-dark px-4 py-2 rounded-md hover:bg-green-800 transition">
                             <i class="bi bi-upload"></i>
                             <span class="mx-1">Update Welcome Greetings</span>
                         </button>
                     </div>
                 </form>

                 <hr class="mt-3 mb-3">



                 <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                     <strong>Activity Logs</strong>
                 </h6>
                 <span>You can track the activties here.</span>
                 <hr class="mb-3 !mt-3">

             </div>
         </div>
     </div>
     <div class="xxl:col-span-5 col-span-5">


         <div class="border rounded-lg">
             <div class="box-body ">
                 <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                     <strong>Linked Accounts</strong>
                 </h6>
                 <p class="text-sm text-gray-500 dark:text-white/60 mb-0 me-3">We use this to let you sign in and
                     populate your profile information</a>
                     <hr class="mb-3 !mt-3">
                 <div class="box border shadow-none p-4">
                     <div class="flex items-start justify-between gap-4">
                         {{-- Left: Text content --}}
                         <div class="flex flex-col">
                             <p class="text-[16px] mb-1 text-gray-700 font-semibold dark:text-white">
                                 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/640px-Google_2015_logo.svg.png"
                                     style="height: 35px" alt="">
                             </p>
                             <p class="text-sm text-gray-500 dark:text-white/60 mb-0 pt-3 me-3">
                                 Enable Google Account integration for secure, one-click sign-in and smoother user
                                 onboarding.
                             </p>
                         </div>

                         {{-- Right: Toggle Switch --}}
                         <div class="relative inline-block">
                             <input type="checkbox" name="modules[1]" id="module-1" value="1"
                                 class="peer relative shrink-0 w-[4.25rem] h-9 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                before:inline-block before:w-8 before:h-8 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-black/20 dark:checked:before:bg-white"
                                 checked>
                             <label for="module-1" class="sr-only">asd</label>

                             {{-- Cross icon (off) --}}
                             <span
                                 class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <!-- Off icon here if needed -->
                             </span>

                             {{-- Check icon (on) --}}
                             <span
                                 class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <!-- On icon here if needed -->
                             </span>
                         </div>
                     </div>
                 </div>
                 <div class="box border shadow-none p-4">
                     <div class="flex items-start justify-between gap-4">
                         {{-- Left: Text content --}}
                         <div class="flex flex-col">
                             <p class="text-[16px] mb-1 text-gray-700 font-semibold dark:text-white">
                                 <img src="/assets/img/google_drive-logo_brandlogos.net_zrexb.png"
                                     style="height: 35px" alt="">
                             </p>
                             <p class="text-sm text-gray-500 dark:text-white/60 mb-0 pt-3 me-3">
                                 Integrate Google Drive effortlessly to support cloud storage and optimize customer
                                 success workflows.
                             </p>
                         </div>

                         {{-- Right: Toggle Switch --}}
                         <div class="relative inline-block">
                             <input type="checkbox" name="modules[1]" id="module-1" value="1"
                                 class="peer relative shrink-0 w-[4.25rem] h-9 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                before:inline-block before:w-8 before:h-8 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-black/20 dark:checked:before:bg-white"
                                 checked>
                             <label for="module-1" class="sr-only">asd</label>

                             {{-- Cross icon (off) --}}
                             <span
                                 class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <!-- Off icon here if needed -->
                             </span>

                             {{-- Check icon (on) --}}
                             <span
                                 class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <!-- On icon here if needed -->
                             </span>
                         </div>
                     </div>
                 </div>
                 <div class="box border shadow-none p-4">
                     <div class="flex items-start justify-between gap-4">
                         {{-- Left: Text content --}}
                         <div class="flex flex-col">
                             <p class="text-[16px] mb-1 text-gray-700 font-semibold dark:text-white">
                                 <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTu0Q9Xz_K6V8PDieZ95uJmdGCgRVaV0GX8hA&s"
                                     style="height: 45px" alt="">
                             </p>
                             <p class="text-sm text-gray-500 dark:text-white/60 mb-0 pt-3 me-3">
                                 Enable QuickBooks integration to manage expenses, track transactions, and stay
                                 financially organized.
                             </p>
                         </div>

                         {{-- Right: Toggle Switch --}}
                         <div class="relative inline-block">
                             <input type="checkbox" name="modules[1]" id="module-1" value="1"
                                 class="peer relative shrink-0 w-[4.25rem] h-9 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                before:inline-block before:w-8 before:h-8 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-black/20 dark:checked:before:bg-white">
                             <label for="module-1" class="sr-only">asd</label>

                             {{-- Cross icon (off) --}}
                             <span
                                 class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <!-- Off icon here if needed -->
                             </span>

                             {{-- Check icon (on) --}}
                             <span
                                 class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                 <!-- On icon here if needed -->
                             </span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         {{-- <div class="sm:col-span-6 xl:col-span-6 col-span-12">
             <div class="border">
                 <div class="box-body">
                     @php
                         $groupedModules = [
                             'Customer Relationship Management' => [
                                 'crm_engagement' => [
                                     'label' => 'CRM Engagement',
                                     'desc' =>
                                         'Monitor and manage ongoing customer relationship activities, follow-ups, and engagement logs.',
                                 ],
                                 'relationships' => [
                                     'label' => 'Relationships',
                                     'desc' =>
                                         'Track and manage professional relationships with partner companies and clients.',
                                 ],
                                 'clients' => [
                                     'label' => 'Clients',
                                     'desc' =>
                                         'Access, organize, and update detailed records of all registered clients.',
                                 ],
                             ],
                             'Leads' => [
                                 'leads_facebook' => [
                                     'label' => 'Facebook Leads',
                                     'desc' => 'Collect and manage lead data generated through Facebook ad campaigns.',
                                 ],
                                 'leads_youtube' => [
                                     'label' => 'YouTube Leads',
                                     'desc' =>
                                         'Handle leads sourced from YouTube marketing or video content engagement.',
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
                                     'desc' =>
                                         'Track and manage social media leads generated from X (formerly Twitter).',
                                 ],
                                 'leads_generic' => [
                                     'label' => 'Actionable Leads',
                                     'desc' => 'Filter, tag, and manage general or manually captured leads.',
                                 ],
                             ],
                             'Projects' => [
                                 'projects' => [
                                     'label' => 'Manage Projects',
                                     'desc' =>
                                         'View, organize, and track all assigned or initiated projects within your portal.',
                                 ],
                                 'bid_invitations' => [
                                     'label' => 'Project Invitations',
                                     'desc' => 'Review and respond to invitations for bidding on upcoming projects.',
                                 ],
                                 'projects_accepted' => [
                                     'label' => 'Projects Accepted',
                                     'desc' =>
                                         'List and manage projects you’ve accepted to work on as a contractor or sub-client.',
                                 ],
                                 'profit_tracker' => [
                                     'label' => 'Profit Tracker',
                                     'desc' =>
                                         'Track revenue, expenses, and generate profitability reports for business activities.',
                                 ],
                                 'income_tracking' => [
                                     'label' => 'Income Tracking',
                                     'desc' =>
                                         'Record and analyze all incoming financial data for accurate profit monitoring.',
                                 ],
                                 'expense_tracking' => [
                                     'label' => 'Expense Tracking',
                                     'desc' => 'Manage and categorize operational and project-related expenses.',
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
                            //  'Content Management' => [
                            //      'cms_banner' => [
                            //          'label' => 'Banner',
                            //          'desc' => 'Update homepage banners and key visuals displayed on the website.',
                            //      ],
                            //      'cms_about_us' => [
                            //          'label' => 'About Us',
                            //          'desc' => 'Edit and maintain information shown on the “About Us” section.',
                            //      ],
                            //      'cms_clients' => [
                            //          'label' => 'Client Section',
                            //          'desc' =>
                            //              'Manage client logos, testimonials, or recognition in the client showcase.',
                            //      ],
                            //      'cms_teams' => [
                            //          'label' => 'Team Member',
                            //          'desc' => 'Update team profiles including names, titles, and bios.',
                            //      ],
                            //      'cms_gallery' => [
                            //          'label' => 'Image Gallery',
                            //          'desc' => 'Upload and manage photos displayed on the portal’s image gallery.',
                            //      ],
                            //      'cms_partners' => [
                            //          'label' => 'Partners Section',
                            //          'desc' =>
                            //              'Showcase partners, collaborators, or stakeholders involved in the business.',
                            //      ],
                            //      'cms_inquiry_logs' => [
                            //          'label' => 'Inquiry Logs',
                            //          'desc' => 'Track and view messages sent through the website’s inquiry forms.',
                            //      ],
                            //      'chatbot' => [
                            //          'label' => 'Chatbot',
                            //          'desc' =>
                            //              'Configure auto-response and guided chat flows using the system chatbot.',
                            //      ],
                            //  ],
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
                     @endphp

                     @foreach ($groupedModules as $group => $modules)
                         <div class="grid grid-cols-12 gap-x-1 ">
                             {{-- Left Section --}}
         {{-- <div class="xxl:col-span-5 col-span-5">

             <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                 <strong>{{ $group }} Modules</strong>
             </h6>
             <span>You can modify {{ strtolower($group) }} module privileges here.</span>
             <hr class="mb-3 !mt-3">

         </div> 

                             <div class="xxl:col-span-12 col-span-12">
                                 <hr class="mb-3 !mt-3">
                                 <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                                     <strong>{{ $group }}</strong>
                                 </h6>
                                 <span>Toggle access for the modules below.</span>
                                 <hr class="mb-3 !mt-3">
                                 @foreach ($modules as $key => $mod)
                                     <div class="flex items-start gap-x-4 mt-4">
                                         <div class="pt-1">
                                             <div class="relative inline-block">
                                                 <input type="checkbox" name="modules[{{ $key }}]"
                                                     id="module-{{ $key }}" value="1"
                                                     class="peer relative shrink-0 w-[4.25rem] h-9 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary checked:border-primary focus:checked:border-primary dark:bg-bodybg dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-gray-600
                    before:inline-block before:w-8 before:h-8 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full rtl:checked:before:-translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-black/20 dark:checked:before:bg-white"
                                                     {{ isset($enabledModules[$key]) && $enabledModules[$key] ? 'checked' : '' }}>
                                                 <label for="module-{{ $key }}" class="sr-only">Toggle
                                                     {{ $mod['label'] }}</label>

                                                 <span
                                                     class="peer-checked:text-white text-gray-500 dark:text-white/70 size-8 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">

                                                 </span>

                                                 <span
                                                     class="peer-checked:text-primary text-gray-500 dark:text-white/70 size-8 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">

                                                 </span>
                                             </div>
                                         </div>

                                         <div class="flex flex-col">
                                             <p class="text-[16px] mb-1 text-gray-700 font-semibold dark:text-white">
                                                 {{ $mod['label'] }}
                                             </p>
                                             <p class="text-sm text-gray-500 dark:text-white/60 mb-0">
                                                 {{ $mod['desc'] }}
                                             </p>
                                         </div>
                                     </div>
                                 @endforeach

                             </div>
                         </div>
                     @endforeach





                     <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                         <strong>Welcome Greetings</strong>
                     </h6>
                     <span>You can monitor welcome greetings here.</span>
                     <hr class="mb-3 !mt-3">
                     <div class=" main-content-card">
                         <video id="player" autoplay muted playsinline controls
                             data-poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                             <source src="/media/welcome_message/default.mp4" type="video/mp4">
                         </video>

                         <link rel="stylesheet" href="/assets/libs/plyr/plyr.css">
                         <script src="/assets/libs/plyr/plyr.min.js"></script>
                         <script>
                             document.addEventListener('DOMContentLoaded', () => {
                                 const player = new Plyr('#player');

                                 // Try to play with sound
                                 player.muted = false;

                                 player.play().then(() => {
                                     console.log("Autoplay with sound succeeded");
                                 }).catch((error) => {
                                     console.warn("Autoplay with sound failed, falling back to muted autoplay");

                                     // Try muted fallback
                                     player.muted = true;
                                     player.play();
                                 });
                             });
                         </script>
                         <script src="/assets/js/media-player.js"></script>

                     </div>
                     <br>
                     <h6 class="font-bold text-2xl text-gray-700 dark:text-white mt-6">
                         <strong>Overview</strong>
                     </h6>
                     <span>You can monitor overview details here.</span>
                     <hr class="mb-3 !mt-3">

                     @include('modules.users.partials.credits.widget')

                     <div class="mt-5 main-content-card">
                         <div class="box-body">
                             <div class="flex items-center mb-4 gap-2 flex-wrap">
                                 <img src="/assets/img/google_drive-logo_brandlogos.net_zrexb.png"
                                     style="height: 30px" alt="">
                                 <div class="ms-auto align-self-start">
                                     <div class="ti-dropdown hs-dropdown">
                                         <a aria-label="anchor" href="javascript:void(0);"
                                             class="ti-btn ti-btn-sm ti-btn-soft-light text-dark ti-dropdown-toggle hs-dropdown-toggle">
                                             <i class="fe fe-more-vertical"></i> Settings
                                         </a>
                                         <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                             @php
                                                 $lead = App\Models\Lead::where('id', $id)->first();
                                             @endphp
                                             {{-- @if (App\Models\User::where('email', $lead->email)->first()?->google_drive_id == null)
                                        <li>
                                            <a class="ti-dropdown-item" href="javascript:void(0);"
                                                onclick="activate_google_drive({{ $id }})">
                                                <i class="ri-delete-bin-line me-1 align-middle inline-block"></i>
                                                Activate
                                            </a>
                                        </li>
                                    @endif 
                                             <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                         class="ri-delete-bin-line me-1 align-middle inline-block"></i>Move
                                                     to
                                                     Trash</a>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <hr class="mb-3 mt-3">
                             <table
                                 class="ti-custom-table ti-custom-table-head !border  border-defaultborder dark:border-defaultborder/10">
                                 <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                     <td width="180"
                                         class="text-end border border-defaultborder dark:border-defaultborder/10 !p-2">
                                         Storage Capacity : </td>
                                     <td
                                         class="border border-defaultborder dark:border-defaultborder/10 font-bold !p-2">
                                         <i class="bi bi-database mx-2"></i> 114.23MB / <strong> 15</strong>GB
                                     </td>
                                 </tr>
                                 <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                     <td width="180"
                                         class="text-end border border-defaultborder dark:border-defaultborder/10 !p-2">
                                         Status : </td>
                                     <td class="border border-defaultborder dark:border-defaultborder/10 !p-2">
                                         {{-- @if (App\Models\User::where('email', $lead->email)->first()?->google_drive_id == null)
                                    <i class="bi bi-building mx-2"></i>
                                    Disabled
                                    </a>
                                @else
                                    <i class="bi bi-building mx-2"></i>
                                    Activated
                                @endif -
                                     </td>
                                 </tr>
                             </table>
                             <center>

                             </center>
                         </div>
                     </div>

                     <div class="mt-5 main-content-card">
                         <div class="box-body">
                             <i class="bi bi-clock-history px-1"></i> Assigned Virtual Assistant
                             <hr class="mb-3 mt-3">
                             <div>
                                 <table class="min-w-full text-sm border border-gray-300" id="assignee-table">
                                     <thead>
                                         <tr class="bg-gray-50">
                                             <th class="p-2 text-left border">Name</th>
                                             <th class="p-2 text-left border w-24">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @php
                                             $assignedUsers = [];
                                         @endphp
                                         @foreach ($assignedUsers as $user)
                                             <tr data-id="">
                                                 <td class="p-2 border"></td>
                                                 <td class="p-2 border">
                                                     <button type="button"
                                                         class="text-red-600 hover:underline text-xs text-danger"
                                                         onclick="removeAssignee('0')">Remove</button>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div> --}}
     </div>
 </div>
