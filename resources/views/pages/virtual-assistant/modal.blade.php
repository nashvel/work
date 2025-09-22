<div id="create-va" class="hs-overlay hidden ti-modal">
    <div
        class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="max-h-full w-full overflow-hidden ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="staticBackdropLabel3">
                    Create Virtual Assistant
                </h6>
                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#create-va">
                    <span class="sr-only">Close</span>
                </button>
            </div>

            <form action="{{ route('va.store') }}" method="POST" enctype="multipart/form-data" autocapitalize="true" autocomplete="off">
                @csrf
                <div class="ti-modal-body overflow-y-auto">
                    <div class="grid grid-cols-12 gap-x-6 gap-y-3">

                        <!-- First Name -->
                        <div class="xl:col-span-6 col-span-12">
                            <label for="first-name" class="form-label">First Name <strong class="text-danger">*</strong></label>
                            <div class="relative"> 
                                <input type="text" id="first-name" name="first_name"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter First Name" required>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-person-fill text-[18px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="xl:col-span-6 col-span-12">
                            <label for="last-name" class="form-label">Last Name <strong class="text-danger">*</strong></label>
                            <div class="relative"> 
                                <input type="text" id="last-name" name="last_name"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter Last Name" required>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-person-fill text-[18px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="xl:col-span-12 col-span-12">
                            <label for="email" class="form-label">Email Address <strong class="text-danger">*</strong></label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter Email Address"
                                    required>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-envelope-fill text-[15px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Phone No -->
                        <div class="xl:col-span-12 col-span-12">
                            <label for="phone-no" class="form-label">Phone Number <strong class="text-danger">*</strong></label>
                            <div class="relative"> 
                                <input type="text" id="phone-no" name="phone_no"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter Phone Number" required>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                   <i class="bi bi-telephone-fill text-[15px]  text-gray-500 text-textmuted"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Position -->
                        <div class="xl:col-span-12 col-span-12">
                            <label for="position" class="form-label">Position <strong class="text-danger">*</strong></label>
                            <div class="relative"> 
                                <input type="text" id="position" name="position"
                                    class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Enter Position" required>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <i class="bi bi-info-circle-fill text-[15px]  text-gray-500 text-textmuted"></i>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ti-modal-footer">
                    <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-soft-secondary"
                        data-hs-overlay="#create-va">Cancel</button>
                    <button type="submit" class="ti-btn ti-btn-primary">Create Virtual Assistant</button>
                </div>
            </form>
        </div>
    </div>
</div>
