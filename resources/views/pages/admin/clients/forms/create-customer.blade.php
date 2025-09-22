<x-app-layout>

    <x-slot name="title">New Client Registration</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/client/list", "text": "Client"}</x-slot>
    <x-slot name="active">Registration</x-slot>
    <x-slot name="buttons">

    </x-slot>

    @include('pages.@components.toast-actions')

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data" autocomplete="on">
                    @csrf
                    <div class="box-body p-5">
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
                                <strong class="font-bold">Whoops! Something went wrong.</strong>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                        @endif
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
                                <hr>
                            </div>


                            <!-- First Name -->
                            <div class="xl:col-span-6 col-span-12">
                                <label for="first-name" class="form-label">First Name : <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="first_name" id="first-name"
                                        placeholder="Enter First Name"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="xl:col-span-6 col-span-12">
                                <label for="last-name" class="form-label">Last Name : <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="last_name" id="last-name" placeholder="Enter Last Name"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="xl:col-span-12 col-span-12">
                                <label for="company" class="form-label">Company Name : <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="company" id="company" placeholder="Company"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-building"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="xl:col-span-2 col-span-12">
                                <label for="position" class="form-label">Position : <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="position" id="position" placeholder="Position"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-building"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="xl:col-span-2 col-span-12">
                                <label for="type" class="form-label">Type: <strong
                                        class="text-danger">*</strong></label>
                                <select name="type" id="type" class="form-select p-2 px-4" required>
                                    <option value="" disabled selected>-</option>
                                    <option value="Supplier">Supplier</option>
                                    <option value="Distributor">Distributor</option>
                                    <option value="General Contractor">General Contractor</option>
                                    <option value="Subcontractor">Subcontractor</option>
                                    {{-- <option value="DFO – Commercial">DFO – Commercial</option>
                                    <option value="DFO – Residential">DFO – Residential</option>
                                    <option value="Locked Vendor">Locked Vendor</option> --}}
                                    <option value="Other">Other</option>
                                    <option value="Architect">Architect</option>
                                    <option value="Owner">Owner</option>
                                </select>
                            </div>

                            <!-- Lead Source -->
                            <div class="xl:col-span-8 col-span-12">
                                <label for="lead_source" class="form-label">Lead Source: <strong
                                        class="text-danger">*</strong></label>
                                <select name="lead_source" id="lead_source" class="form-select p-2 px-4">
                                    <option value="" disabled selected>-</option>
                                    <option value="Plan Panther Subscription">Plan Panther Subscription</option>
                                    <option value="No Plan Panther Subscription">No Plan Panther Subscription</option>
                                    <option value="Potential Plan Panther Subscription">Potential Plan Panther
                                        Subscription</option>
                                </select>
                            </div>


                            <div class="xl:col-span-4 col-span-12">
                                <label for="city" class="form-label">City: <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="city" id="city"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10"
                                        placeholder="Enter city and zip code">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="xl:col-span-4 col-span-12">
                                <label for="state" class="form-label">State: <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="state" id="state"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10"
                                        placeholder="Enter state code">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-map"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="xl:col-span-4 col-span-12">
                                <label for="zip" class="form-label">Zip Code: <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="text" name="zip" id="zip"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10" placeholder="Code">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-123"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="contact-phone" class="form-label">Phone : <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="tel" name="phone" id="contact-phone"
                                        placeholder="Enter Phone Number"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                </div>
                            </div>


                            <!-- Email -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="contact-mail" class="form-label">Email Address : <strong
                                        class="text-danger">*</strong></label>
                                <div class="relative">
                                    <input type="email" name="email" id="contact-mail"
                                        placeholder="Enter Email Address"
                                        class="ti-form-input rounded-sm ps-11 focus:z-10">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Website -->
                            <div class="xl:col-span-4 col-span-12">
                                <div class="relative">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password
                                        <strong class="text-danger">*</strong></label>
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="password" id="password"
                                            value="{{ Str::random(10) }}"
                                            class="mt-1 w-full text-lg ti-form-input ps-11 focus:z-10 text-start border border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
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

                        </div>
                    </div>
                    <div class="box-footer flex gap-3 justify-end">
                        <a href="/client/list/" style="border-color: #FF6B54; "
                            class="bg-gray-100 text-danger px-4 py-2 rounded-md hover:bg-gray-300 transition">
                            <i class="bi bi-trash"></i>
                            <span class="mx-1">Discard</span>
                        </a>
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
</x-app-layout>
