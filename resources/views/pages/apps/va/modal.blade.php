<div id="create-va" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
        <div class="ti-modal-content">

            <!-- 🔹 Modal Header -->
            <div class="ti-modal-header">
                <h6 class="ti-modal-title inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-message-chatbot">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                        <path d="M9.5 9h.01" />
                        <path d="M14.5 9h.01" />
                        <path d="M9.5 13a3.5 3.5 0 0 0 5 0" />
                    </svg>
                    <span class="mx-2" id="formTitle">Virtual Assistant</span>
                </h6>
                <button type="button" class="ti-modal-close-btn" data-hs-overlay="#create-va">
                    <span class="sr-only">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('va.store') }}" method="POST" enctype="multipart/form-data" autocapitalize="true"
                autocomplete="off">
                @csrf
                <div class="ti-modal-body overflow-y-auto">

                    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3">

                        <!-- Profile Image Upload -->
                        <div class="xl:col-span-12 col-span-12">
                            <div class="flex items-start flex-wrap gap-4">
                                <div>
                                    <span class="avatar avatar-xxl">
                                        <img src="/avatar.png" alt="" id="profile-img">
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

                        <div class="xl:col-span-12 col-span-12">
                            <hr class="mb-4">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-x-6 gap-y-3">

                        <!-- First Name -->
                        <div class="xl:col-span-6 col-span-12">
                            <label for="first-name" class="form-label">First Name <strong
                                    class="text-danger">*</strong></label>
                            <div class="relative">
                                <input type="text" id="first-name" name="first_name"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter First Name"
                                    required>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-person text-[18px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="xl:col-span-6 col-span-12">
                            <label for="last-name" class="form-label">Last Name <strong
                                    class="text-danger">*</strong></label>
                            <div class="relative">
                                <input type="text" id="last-name" name="last_name"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter Last Name"
                                    required>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-person text-[18px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>


                        <!-- Phone No -->
                        <div class="xl:col-span-6 col-span-12">
                            <label for="phone-no" class="form-label">Phone Number <strong
                                    class="text-danger">*</strong></label>
                            <div class="relative">
                                <input type="text" id="phone-no" name="phone_no"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter Phone Number"
                                    required>
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-telephone text-[15px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Position -->
                        <div class="xl:col-span-6 col-span-12">
                            <label for="position" class="form-label">Position <strong
                                    class="text-danger">*</strong></label>
                            <div class="relative">
                                <select id="position" name="position"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <option value="" disabled selected>- SELECT -</option>

                                    <optgroup label="General Admin">
                                        <option value="Administrative Assistant">Administrative Assistant</option>
                                        <option value="Executive Assistant">Executive Assistant</option>
                                        <option value="Personal Assistant">Personal Assistant</option>
                                        <option value="Office Assistant">Office Assistant</option>
                                        <option value="Calendar Manager">Calendar Manager</option>
                                        <option value="Email Manager">Email Manager</option>
                                        <option value="Data Entry Specialist">Data Entry Specialist</option>
                                        <option value="Virtual Receptionist">Virtual Receptionist</option>
                                    </optgroup>

                                    <optgroup label="Customer Support">
                                        <option value="Customer Service Representative">Customer Service Representative
                                        </option>
                                        <option value="Chat Support Agent">Chat Support Agent</option>
                                        <option value="Email Support Specialist">Email Support Specialist</option>
                                        <option value="Help Desk Assistant">Help Desk Assistant</option>
                                        <option value="Technical Support VA">Technical Support VA</option>
                                    </optgroup>

                                    <optgroup label="Social Media & Marketing">
                                        <option value="Social Media Manager">Social Media Manager</option>
                                        <option value="Social Media Assistant">Social Media Assistant</option>
                                        <option value="Digital Marketing VA">Digital Marketing VA</option>
                                        <option value="Content Scheduler">Content Scheduler</option>
                                        <option value="Engagement Specialist">Engagement Specialist</option>
                                        <option value="Influencer Outreach Coordinator">Influencer Outreach Coordinator
                                        </option>
                                    </optgroup>

                                    <optgroup label="Sales & Lead Generation">
                                        <option value="Lead Generation Specialist">Lead Generation Specialist</option>
                                        <option value="Appointment Setter">Appointment Setter</option>
                                        <option value="CRM Manager">CRM Manager</option>
                                        <option value="Cold Email VA">Cold Email VA</option>
                                        <option value="Sales Support Assistant">Sales Support Assistant</option>
                                    </optgroup>

                                    <optgroup label="Finance">
                                        <option value="Bookkeeping Assistant">Bookkeeping Assistant</option>
                                        <option value="Invoicing VA">Invoicing VA</option>
                                        <option value="Payroll Support VA">Payroll Support VA</option>
                                        <option value="Financial Data Entry">Financial Data Entry</option>
                                    </optgroup>

                                    <optgroup label="Tech & Creative">
                                        <option value="Graphic Design VA">Graphic Design VA</option>
                                        <option value="Video Editing VA">Video Editing VA</option>
                                        <option value="Web Research Assistant">Web Research Assistant</option>
                                        <option value="WordPress Assistant">WordPress Assistant</option>
                                        <option value="Shopify Product Uploader">Shopify Product Uploader</option>
                                        <option value="SEO Assistant">SEO Assistant</option>
                                        <option value="IT Support VA">IT Support VA</option>
                                    </optgroup>

                                    <optgroup label="Writing">
                                        <option value="Content Writer">Content Writer</option>
                                        <option value="Copywriter">Copywriter</option>
                                        <option value="Blog Manager">Blog Manager</option>
                                        <option value="Proofreading Assistant">Proofreading Assistant</option>
                                        <option value="Transcriptionist">Transcriptionist</option>
                                    </optgroup>

                                    <optgroup label="Specialized">
                                        <option value="Real Estate VA">Real Estate VA</option>
                                        <option value="eCommerce VA">eCommerce VA</option>
                                        <option value="Project Manager VA">Project Manager VA</option>
                                        <option value="Medical VA">Medical VA</option>
                                        <option value="Legal VA">Legal VA</option>
                                        <option value="HR Assistant">HR Assistant</option>
                                    </optgroup>

                                    <optgroup label="Others">
                                        <option value="Others">Others</option>
                                    </optgroup>
                                </select>

                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-info-circle text-[15px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>


                        <!-- Email Address -->
                        <div class="xl:col-span-6 col-span-12">
                            <label for="email" class="form-label">Email Address <strong
                                    class="text-danger">*</strong></label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10"
                                    placeholder="Enter Email Address" required>
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-envelope text-[15px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>


                        <div class="xl:col-span-6 col-span-12">
                            <div class="relative">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password <strong
                                        class="text-danger">*</strong></label>
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="password" id="password"
                                        value="{{ Str::random(10) }}"
                                        class="mt-1 w-full  ti-form-input ps-11 focus:z-10 text-start border border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-2 pt-6 mt-1">
                                        <i class="bi bi-unlock"></i>
                                    </div>
                                    <button type="button" id="generate_password" onclick="generatePassword()"
                                        class="px-3 py-2 ti-btn ti-btn-light border-2 shadow border-gray-400 text-dark rounded-md">
                                        <i class="bi bi-magic"></i>
                                    </button>
                                    <button type="button" id="copy_password" onclick="copyPassword()"
                                        class="px-3 py-2 ti-btn ti-btn-light text-dark shadow rounded-md">
                                        <i class="bi bi-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="xl:col-span-12 col-span-12">
                            <label for="address" class="form-label">Complete Address <strong
                                    class="text-danger">*</strong></label>
                            <div class="relative">
                                <input type="text" id="address" name="address"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10"
                                    placeholder="Enter Complete Address" required>
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-pin-map text-[15px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

              

                @include('pages.actions.toast-mod')

                <div class="ti-modal-footer">
                    <button type="button"
                        class="bg-gray-100 text-dark px-4 py-2 rounded-md hover:bg-gray-300 transition"
                        data-hs-overlay="#create-va">Cancel</button>
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-800 transition">
                        <i class="bi bi-check2-circle"></i>
                        <span class="mx-1">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
