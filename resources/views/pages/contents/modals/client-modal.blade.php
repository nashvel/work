<div id="hs-extralarge-modal" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
        <div class="ti-modal-content">

            <!-- 🔹 Modal Header -->
            <div class="ti-modal-header">
                <h6 class="ti-modal-title inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-palette">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                        <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
                    <span class="mx-2" id="formTitle">Upload Client Logo for Landing Page Preview</span>
                </h6>
                <button type="button" class="ti-modal-close-btn" data-hs-overlay="#hs-extralarge-modal">
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

            <!-- 🔹 Modal Body -->

            <!-- Image Upload Form -->

            <!-- ✅ Client Form -->
            <form id="clientForm" action="{{ route('cms.clients.store') }}" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                <div class="ti-modal-body">
                    @csrf
                    <input type="hidden" id="clientId" name="client_id">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Client Logo</label>

                        <!-- Upload Box -->
                        <div id="logoUploadContainer"
                            class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition cursor-pointer">

                            <input type="file" id="clientLogo" name="client_logo" accept="image/*" class="hidden" />

                            <!-- Upload Placeholder -->
                            <div id="uploadPlaceholder" class="flex flex-col items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <p class="text-gray-600 text-sm mt-2">Click & Select to Upload Logo the here.</p>
                            </div>
                        </div>

                        <!-- Image Preview (Hidden Initially) -->
                        <div id="logoPreviewContainer" class="hidden relative w-full flex justify-center mt-2">
                            <img id="logoPreview" src="" class="object-cover cursor-pointer" />
                        </div>
                    </div>

                    <hr class="mb-3 mt-3">



                    <!-- Client Name -->
                    <div class="mb-4">
                        <label for="clientName" class="block text-gray-700 font-medium mb-1">
                            Client Name : <strong class="text-danger">*</strong>
                        </label>

                        <div class="relative">
                            <input type="tel" name="client_name" id="clientName"
                                placeholder="Write the Client Name here.."
                                class="ti-form-input rounded-sm ps-11 focus:z-10">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                <i class="bi bi-person text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Ads Video Link -->
                    <div class="mb-4">
                        <label for="adsVideoLink" class="block text-gray-700 font-medium mb-1">
                            Ads Video Link : (optional)
                        </label>

                        <div class="relative">
                            <input type="url" name="ads_video_link" id="adsVideoLink" placeholder="https://"
                                class="ti-form-input rounded-sm ps-11 focus:z-10">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                <i class="bi bi-link-45deg text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ti-modal-footer">
                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            class="bg-gray-100 text-dark px-4 py-2 rounded-md hover:bg-gray-300 transition"
                            data-hs-overlay="#hs-extralarge-modal">
                            Cancel
                        </button>               
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-800 transition">
                            <i class="bi bi-check2-circle"></i>
                            <span class="mx-1">Save</span>
                        </button>
                    </div>
                </div>
            </form>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const clientLogoInput = document.getElementById("clientLogo");
                    const logoPreview = document.getElementById("logoPreview");
                    const logoPreviewContainer = document.getElementById("logoPreviewContainer");
                    const logoUploadContainer = document.getElementById("logoUploadContainer");
                    const uploadPlaceholder = document.getElementById("uploadPlaceholder");

                    // ✅ Make Upload Box Clickable
                    logoUploadContainer.addEventListener("click", function() {
                        clientLogoInput.click();
                    });

                    // ✅ Handle Image Preview & Hide Upload Box
                    clientLogoInput.addEventListener("change", function() {
                        const file = this.files[0];
                        if (file && file.type.startsWith("image/")) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                logoPreview.src = e.target.result;
                                logoPreviewContainer.classList.remove("hidden");
                                logoUploadContainer.classList.add("hidden");
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    // ✅ Clicking on the image allows replacing it
                    logoPreview.addEventListener("click", function() {
                        clientLogoInput.click();
                    });

                });
            </script>


        </div>
    </div>
</div>
