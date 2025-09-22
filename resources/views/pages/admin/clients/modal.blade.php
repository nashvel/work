@php
    use Illuminate\Support\Str;
@endphp
<div id="create-contact" class="hs-overlay ti-modal pointer-events-none hidden mt-6">
    <div class="hs-overlay ti-modal-box mt-0 lg:!max-w-4xl lg:w-full m-3  items-center justify-center">
        <div class="max-h-full w-full overflow-hidden ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="form-header">
                    Register New Client
                </h6>
                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#create-contact">
                    <span class="sr-only">Close</span>
                    <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                            fill="currentColor" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data" id="client_form" autocomplete="off"
                class="space-y-6 p-6 bg-white shadow-md rounded-lg">
                @csrf
                <!-- Preview Section -->
                <div class="text-center">
                    <div class="relative inline-block mt-2">
                        <img id="profile-img" src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}"
                            alt="Company Logo" class="mx-auto object-cover rounded-md " style="max-height: 220px;">

                        <label class="block text-sm font-medium mt-3 text-gray-700">Company Logo Preview</label>
                    </div>
                </div>
                <!-- Upload Section -->
                <div class="text-center  justify-center">
                    <div class="border-2 border-gray-300 border-dashed rounded-lg p-3 cursor-pointer bg-gray-100 hover:bg-gray-200"
                        onclick="document.getElementById('profile-change').click()">
                        <input type="file" name="photo" id="profile-change" accept="image/*" class="hidden"
                            onchange="previewImage(event)">
                        <p class="text-gray-500 text-sm">Click to Upload Logo here</p>
                    </div>
                </div>


                <hr class="border-gray-300">

                <div class="grid grid-cols-2 gap-6">
                    <!-- Contact Name -->
                    <div>
                        <label for="contact-name" class="block text-sm font-medium text-gray-700">Contact Name <strong
                                class="text-danger">*</strong></label>
                        <div class="relative">
                            <input type="text" name="contact_name" id="contact-name" placeholder="John Doe" required
                                class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="contact-phone" class="block text-sm font-medium text-gray-700">Phone Number <strong
                                class="text-danger">*</strong></label>
                        <div class="relative">
                            <input type="tel" name="phone" id="contact-phone" placeholder="+1 234 567 8900"
                                required
                                class="mt-1 w-full ti-form-input ps-11 focus:z-10 border border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                <i class="bi bi-telephone"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Name (Full Width) -->
                <div>
                    <label for="company-name" class="block text-sm font-medium text-gray-700">Company Name <strong
                            class="text-danger">*</strong></label>
                    <div class="relative">
                        <input type="text" name="company_name" id="company-name" placeholder="ABC Ltd." required
                            class="mt-1 w-full ti-form-input ps-11 focus:z-10 border border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Email Address -->
                    <div class="relative">
                        <label for="contact-mail" class="block text-sm font-medium text-gray-700">Email Address <strong
                                class="text-danger">*</strong></label>
                        <input type="email" name="email" id="contact-mail" placeholder="email@example.com" required
                            class="mt-2 w-full ti-form-input ps-11 focus:z-10 border border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4 pt-6 mt-1">
                            <i class="bi bi-envelope-at"></i>
                        </div>
                    </div>

                    <!-- Password with Copy & Generate Buttons -->
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password <strong
                                class="text-danger">*</strong></label>
                        <div class="flex items-center space-x-2">
                            <input type="text" name="password" id="password" value="{{ Str::random(10) }}" 
                                class="mt-1 w-full  ti-form-input ps-11 focus:z-10 text-center border border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
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

                <hr class="border-gray-300">

                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md" data-hs-overlay="#create-contact">Cancel</button>
                    <button type="submit" id="submit_btn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700">
                        Create Client
                    </button>
                </div>
            </form>

            <script>
                function previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('profile-img').src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }

                function copyPassword() {
                    const passwordField = document.getElementById('password');
                    passwordField.select();
                    document.execCommand('copy');
                    alert('Password copied to clipboard!');
                }

                function generatePassword() {
                    const newPassword = Math.random().toString(36).slice(-10);
                    document.getElementById('password').value = newPassword;
                }
            </script>

        </div>
    </div>
</div>

<script>
    function edit(data) {
        const header = document.getElementById('form-header');
        header.innerHTML = 'Edit Client Information'
        document.getElementById('contact-name').value = data.contact_name;
        document.getElementById('contact-phone').value = data.phone;
        document.getElementById('company-name').value = data.company_name;
        document.getElementById('contact-mail').value = data.email;
        document.getElementById('profile-img').src = '/storage/' + data.photo;

        document.getElementById('password').value = '***********';
        document.getElementById('password').disabled = true;
        document.getElementById('generate_password').disabled = true;
        document.getElementById('copy_password').disabled = true;
        document.getElementById('submit_btn').innerHTML = 'Save Changes';

        document.getElementById('client_form').action = "/hbcs/client/update/" + data.id;
    }
</script>