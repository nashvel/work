 <!-- Modal for Logo Change -->
 <div id="change-logo" class="hs-overlay hidden ti-modal">
     <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
         <div class="ti-modal-content">
             <!-- Modal Header -->
             <div class="ti-modal-header">
                 <h6 class="ti-modal-title">Change Logo</h6>
                 <button type="button" class="ti-modal-close-btn" data-hs-overlay="#change-logo">
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
             <form id="logoForm" method="POST" enctype="multipart/form-data"
                 action="{{ route('cms.partners.logo.update') }}">
                 @csrf
                 <input type="hidden" id="itemId" name="itemId" value="">
                 <!-- Modal Body -->
                 <div class="ti-modal-body">
                     <!-- Image Preview Section -->
                     <div id="logoPreviewWrapper" class="mb-4">
                         <img id="logoPreview" src="" alt="Current Logo"
                             class="media-preview rounded-md w-full" />
                     </div>

                     <!-- Form for Logo Upload -->

                     <hr class="mb-3">
                     <!-- File Upload Section -->
                     <div id="logoUploadSection" class="text-center">
                        <p class="text-gray-600 mt-2 mb-3">Choose a new logo to upload.</p>
                         <input type="file" id="logoFile" name="logo"
                             class="video-upload-input border border-gray-300 p-2 rounded-md shadow-sm text-sm text-gray-700 bg-white w-full" />
                     </div>

                     <!-- No Logo Message -->
                     <div id="noLogoMessage" class="text-center text-gray-600 text-lg pb-6" style="display: none;">
                         <center>
                             <img src="/v1/modal/sad.png" style="height: 125px" class="mb-3">
                             <i>Apologies, no logo is uploaded yet.</i><br>
                             <i>No logo available for this company.</i>
                         </center>
                     </div>
                 </div>
                 
                 <!-- Submit Button -->
                 <div class="ti-modal-footer justify-end">
                     <button type="submit" id="upload-btn" class="bg-green-500 text-white px-6 py-2 rounded-md">Upload
                         Logo</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <div id="watch-video" class="hs-overlay hidden ti-modal">
     <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
         <div class="ti-modal-content">
             <!-- 🔹 Modal Header -->
             <div class="ti-modal-header">
                 <h6 class="ti-modal-title">Watch Video</h6>
                 <button type="button" class="ti-modal-close-btn" data-hs-overlay="#watch-video">
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
             <div class="ti-modal-body">
                 <video id="videoPlayer" controls class="w-full">
                     <source id="videoSource" src="" type="video/mp4">
                     Your browser does not support the video tag.
                 </video>

                 <div id="noVideoMessage" class="text-center text-gray-600 text-lg pb-6" style="display: none;">
                     <center>
                         <img src="/v1/modal/sad.png" style="height: 125px" class="mb-3">
                         <i>Apologies, a video has not been uploaded yet.</i><br>
                         <i>No video available for this company.</i>
                     </center>
                 </div>

             </div>
         </div>
     </div>
 </div>

 <div id="hs-extralarge-modal" class="hs-overlay hidden ti-modal">
     <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
         <div class="ti-modal-content">

             <!-- 🔹 Modal Header -->
             <div class="ti-modal-header">
                 <h6 class="ti-modal-title">Upload Partner Logo</h6>
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
             <div class="ti-modal-body">
                 <!-- Image Upload Form -->
                 <form id="imageUploadForm" enctype="multipart/form-data"
                     class="p-4 border rounded-md shadow-md bg-white">

                     <!-- Drag & Drop + File Input -->
                     <div id="dropArea"
                         class="border-2 border-dashed border-gray-400 p-6 rounded-md text-center bg-gray-50 hover:bg-gray-100 transition cursor-pointer">
                         <p class="text-gray-600">Drag & Drop images here or</p>
                         <label for="imageInput" class="cursor-pointer text-blue-600 font-semibold underline">Browse
                             Files</label>
                         <input type="file" id="imageInput" multiple accept="image/*" class="hidden">
                     </div>

                     <!-- Preview Container -->
                     <div id="imagePreviewContainer"
                         class="grid grid-cols-4 gap-4 mt-4 p-2 border border-gray-300 rounded-md bg-gray-50">
                     </div>

                     <!-- Buttons -->
                     <div class="flex items-center justify-between mt-4">
                         <button type="submit"
                             class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition">
                             <i class="bi bi-upload px-1"></i>
                             Upload
                         </button>
                         <button type="button" id="clearImages"
                             class="bg-gray-200 text-dark px-4 py-2 rounded-md hidden">
                             <i class="bi bi-trash px-1"></i>
                             Clear All
                         </button>
                     </div>

                     <!-- Progress Bar -->
                     <div id="uploadProgressContainer" class="hidden w-full bg-gray-300 rounded-md mt-2">
                         <div id="uploadProgressBar" class="h-2 bg-blue-500 rounded-md" style="width: 0%;"></div>
                     </div>

                 </form>
             </div>

             <script>
                 document.addEventListener("DOMContentLoaded", function() {
                     const dropArea = document.getElementById("dropArea");
                     const imageInput = document.getElementById("imageInput");
                     const previewContainer = document.getElementById("imagePreviewContainer");
                     const uploadForm = document.getElementById("imageUploadForm");
                     const clearImagesButton = document.getElementById("clearImages");
                     const progressContainer = document.getElementById("uploadProgressContainer");
                     const progressBar = document.getElementById("uploadProgressBar");

                     let selectedFiles = [];

                     // ✅ Drag & Drop Event Listeners
                     dropArea.addEventListener("dragover", (e) => {
                         e.preventDefault();
                         dropArea.classList.add("bg-gray-200");
                     });

                     dropArea.addEventListener("dragleave", () => {
                         dropArea.classList.remove("bg-gray-200");
                     });

                     dropArea.addEventListener("drop", (e) => {
                         e.preventDefault();
                         dropArea.classList.remove("bg-gray-200");

                         const files = Array.from(e.dataTransfer.files);
                         handleFiles(files);
                     });

                     // ✅ Handle File Selection (Browse)
                     imageInput.addEventListener("change", function() {
                         const files = Array.from(this.files);
                         handleFiles(files);
                         this.value = ""; // Reset input
                     });

                     // ✅ Function to Handle Selected Files
                     function handleFiles(files) {
                         files.forEach((file) => {
                             if (!file.type.startsWith("image/")) return;

                             selectedFiles.push(file);

                             const reader = new FileReader();
                             reader.onload = function(e) {
                                 const imgWrapper = document.createElement("div");
                                 imgWrapper.classList.add("relative");

                                 imgWrapper.innerHTML = `
                                    <img src="${e.target.result}" class="card-img !rounded-md">
                                    <button type="button" class="delete-btn-preview absolute top-2 right-2 bg-red-500 text-white p-2 rounded delete-preview">
                                    ✖
                                    </button>
                                `;

                                 previewContainer.appendChild(imgWrapper);

                                 imgWrapper.querySelector(".delete-preview").addEventListener("click",
                                     function() {
                                         const index = selectedFiles.indexOf(file);
                                         if (index !== -1) selectedFiles.splice(index, 1);
                                         imgWrapper.remove();
                                         toggleClearButton();
                                     });
                             };
                             reader.readAsDataURL(file);
                         });

                         toggleClearButton();
                     }

                     // ✅ Show or Hide Clear Button
                     function toggleClearButton() {
                         clearImagesButton.classList.toggle("hidden", selectedFiles.length === 0);
                     }

                     // ✅ Clear All Images
                     clearImagesButton.addEventListener("click", function() {
                         selectedFiles = [];
                         previewContainer.innerHTML = "";
                         toggleClearButton();
                     });

                     // ✅ Handle Form Submission with Real Upload Progress
                     uploadForm.addEventListener("submit", function(e) {
                         e.preventDefault();

                         if (selectedFiles.length === 0) {
                             Swal.fire("No images selected!", "Please select some images first.", "warning");
                             return;
                         }

                         const formData = new FormData();
                         selectedFiles.forEach((file) => formData.append("images[]", file));

                         // Show Progress Bar
                         progressContainer.classList.remove("hidden");
                         progressBar.style.width = "0%";

                         // Use XMLHttpRequest for Real-Time Progress Tracking
                         const xhr = new XMLHttpRequest();
                         xhr.open("POST", "{{ route('cms.partners.store') }}", true);
                         xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

                         // ✅ Update Progress Bar Dynamically
                         xhr.upload.addEventListener("progress", function(e) {
                             if (e.lengthComputable) {
                                 const percent = (e.loaded / e.total) * 100;
                                 progressBar.style.width = percent + "%";
                             }
                         });

                         xhr.onload = function() {
                             if (xhr.status === 200) {
                                 try {
                                     const response = JSON.parse(xhr.responseText);
                                     if (response.success) {
                                         Swal.fire("Success!", "Images uploaded successfully!", "success");
                                         setTimeout(() => location.reload(), 2000);
                                     } else {
                                         throw new Error(response.error || "Unknown error occurred");
                                     }
                                 } catch (error) {
                                     Swal.fire("Upload Failed!", "Invalid server response.", "error");
                                 }
                             } else {
                                 Swal.fire("Upload Failed!", "Server error: " + xhr.status, "error");
                             }
                         };

                         xhr.onerror = function() {
                             Swal.fire("Upload Failed!", "Network error occurred.", "error");
                         };

                         xhr.send(formData);
                     });
                 });
             </script>


         </div>
     </div>
 </div>
