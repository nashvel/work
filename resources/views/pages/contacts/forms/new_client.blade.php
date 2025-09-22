<x-app-layout>

    <x-slot name="title">New Client Registration</x-slot>
    <x-slot name="url_1">{"link": "/contact/list", "text": "Relationship"}</x-slot>
    <x-slot name="url_2">{"link": "/client/list", "text": "Manage"}</x-slot>
    <x-slot name="url_3">{"link": "/contact/person/list/{{ $company_id }}", "text": "Contact"}</x-slot>
    <x-slot name="active">Registration</x-slot>
    <x-slot name="buttons">

    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">


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

                        <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data"
                            autocomplete="on">
                            @csrf
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
                                                    class="ti-btn ti-btn-sm ti-btn-light btn-wave waves-effect waves-light">
                                                    <i class="ri-upload-2-line me-1"></i>Change Image
                                                </label>
                                                <input type="file" name="photo" id="profile-change" class="hidden"
                                                    accept="image/*">
                                                <button type="button"
                                                    class="ti-btn ti-btn-sm ti-btn-soft-light text-dark btn-wave waves-effect waves-light"><i
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
                                        <input type="text" name="last_name" id="last-name"
                                            placeholder="Enter Last Name"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Company -->
                                <div class="xl:col-span-6 col-span-12">
                                    <label for="company" class="form-label">Position : <strong
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

                                <input type="hidden" name="company_id" value="{{ $company_id }}">

                                <!-- Email -->
                                <div class="xl:col-span-6 col-span-12">
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

                                <!-- Phone -->
                                <div class="xl:col-span-6 col-span-12">
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

                                <!-- Website -->
                                <div class="xl:col-span-6 col-span-12">
                                    <label for="website" class="form-label">Website :</label>
                                    <div class="relative">
                                        <input type="text" name="website" id="website"
                                            placeholder="Website URL"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-globe"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="xl:col-span-12 col-span-12">
                                    <label for="location" class="form-label">Location :</label>
                                    <div class="relative">
                                        <input type="text" name="location" id="location"
                                            placeholder="City, Country"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                </div>


                                <!-- Facebook -->
                                <div class="xl:col-span-6 col-span-12">
                                    <label for="facebook" class="form-label">Facebook :</label>
                                    <div class="relative">
                                        <input type="text" name="facebook" id="facebook"
                                            placeholder="Facebook Profile"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-facebook"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Twitter / X -->
                                <div class="xl:col-span-6 col-span-12">
                                    <label for="twitter" class="form-label">Twitter / X : </label>
                                    <div class="relative">
                                        <input type="text" name="twitter" id="twitter"
                                            placeholder="Twitter Handle"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-twitter"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="xl:col-span-6 col-span-12">
                                    <label for="linkedin" class="form-label">LinkedIn : </label>
                                    <div class="relative">
                                        <input type="text" name="linkedin" id="linkedin"
                                            placeholder="LinkedIn Profile"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-linkedin"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Portfolio -->
                                <div class="xl:col-span-6 col-span-12">
                                    <label for="portfolio" class="form-label">Portfolio : </label>
                                    <div class="relative">
                                        <input type="text" name="portfolio" id="portfolio"
                                            placeholder="Portfolio URL"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Biography -->
                                <div class="xl:col-span-12 col-span-12">
                                    <label for="biography" class="form-label">Biographical Info : </label>
                                    <textarea class="form-control" name="biography" id="biography" rows="4" placeholder="Write a short bio..."></textarea>
                                </div>

                            </div>

                            <!-- Form Buttons -->
                            <div class="ti-modal-footer mt-3">
                                <center>
                                    <button type="reset"
                                        class="hs-dropdown-toggle ti-btn ti-btn-soft-secondary">Reset</button>
                                    <button type="submit" class="ti-btn ti-btn-primary">Submit Record</button>
                                </center>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
