<x-app-layout>

    <x-slot name="title">Manage Gallery Section</x-slot>
    <x-slot name="url_1">{"link": "/cms/gallery", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/cms/gallery", "text": "Gallery"}</x-slot>
    <x-slot name="active">Images</x-slot>
    <x-slot name="buttons">
        <button type="button" class="hs-overlay-open ti-btn btn-wave ti-btn-light bg-white text-dark"
            data-hs-overlay="#hs-extralarge-modal">
            <i class="bi bi-upload px-1"></i>
            Upload Images
        </button>
    </x-slot>

    <link rel="stylesheet" href="/assets/libs/dragula/dragula.min.css">

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            
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

            @php
                $galleryItems = App\Models\CMS_Gallery::orderBy('img_column')->orderBy('img_row')->get();
            @endphp

            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the gallery here.
                    <hr class="mb-3 mt-3">
                    <div class="grid grid-cols-4 gap-4 custom-box ">
                        @for ($col = 1; $col <= 4; $col++)
                            @php
                                $columnItems = $galleryItems->where('img_column', $col)->sortBy('img_row');
                            @endphp

                            @if ($columnItems->isNotEmpty())
                                <div class="col-span-1 drag-column bg-white" id="post_{{ $col }}">
                                    @foreach ($columnItems as $item)
                                        <div class="box draggable-item relative text-gray-800"
                                            data-id="{{ $item->id }}" data-row="{{ $item->img_row }}">
                                            <button
                                                class="delete-btn absolute top-2 right-2 z-50 bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700"
                                                data-id="{{ $item->id }}"
                                                onclick="delete_image({{ $item->id }})">
                                                ✖
                                            </button>

                                            <div class="relative group">
                                                <img src="{{ asset('storage/' . $item->image_path) }}"
                                                    class="media-preview rounded-md" alt="{{ $item->title }}">

                                                <!-- Buttons on hover -->
                                                <div
                                                    class="absolute inset-0 bg-black/7 border-radius-20 flex justify-center items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <button
                                                        class="hover-button bg-green-500 text-white px-3 py-1 rounded-md text-sm"
                                                        data-hs-overlay="#change-logo"
                                                        onclick="changeLogo({{ $item->id }}, '{{ asset('storage/' . $item->image_path) }}', '{{ $item->title }}')">
                                                        <center>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-photo-edit">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M15 8h.01" />
                                                                <path
                                                                    d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4" />
                                                                <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3" />
                                                                <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596" />
                                                                <path
                                                                    d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                                            </svg>
                                                            Change
                                                        </center>
                                                    </button>

                                                </div>
                                            </div>


                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.contents.gallery.modal')
    @include('pages.contents.gallery.settings')

    <script src="/assets/libs/dragula/dragula.min.js"></script>
    <script src="/assets/js/draggable-cards.js"></script>

</x-app-layout>



{{-- <x-app-layout>

    <x-slot name="title">Manage Gallery</x-slot>
    <x-slot name="url_1">{"link": "/cms/agallery", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Gallery"}</x-slot>
    <x-slot name="active">Images</x-slot>
    <x-slot name="buttons">
        <button type="button" class="hs-overlay-open ti-btn btn-wave ti-btn-light bg-white text-dark"
            data-hs-overlay="#hs-extralarge-modal">
            <i class="bi bi-upload px-1"></i>
            Upload Images
        </button>
    </x-slot>


    <link rel="stylesheet" href="/assets/libs/dragula/dragula.min.css">

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            
            @php
                $galleryItems = App\Models\GalleryContent::orderBy('img_column')->orderBy('img_row')->get();
            @endphp

            <div class="grid grid-cols-4 gap-4 custom-box ">
                @for ($col = 1; $col <= 4; $col++)
                    <div class="col-span-1 drag-column" id="post_{{ $col }}">
                        @foreach ($galleryItems->where('img_column', $col)->sortBy('img_row') as $item)
                            <div class="box text-white draggable-item relative" data-id="{{ $item->id }}"
                                data-row="{{ $item->img_row }}">
                                <button
                                    class="delete-btn absolute top-2 right-2 z-50 bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700"
                                    data-id="{{ $item->id }}" onclick="delete_image({{ $item->id }})">
                                    ✖
                                </button>
                                <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img !rounded-md"
                                    alt="{{ $item->title }}">
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>

            <style>
                .draggable-item {
                    position: relative;
                }

                .delete-btn {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    background-color: red;
                    color: white;
                    padding: 4px 8px;
                    border-radius: 5px;
                    font-size: 14px;
                    font-weight: bold;
                    opacity: 0;
                    transition: opacity 0.2s ease-in-out;
                }

                .draggable-item:hover .delete-btn {
                    opacity: 1;
                }

                .delete-btn-preview {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    background-color: red;
                    color: white;
                    padding: 4px 8px;
                    border-radius: 5px;
                    font-size: 14px;
                    font-weight: bold;
                    transition: opacity 0.2s ease-in-out;
                }
            </style>



            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // ✅ Delete Function for OnClick
                    window.delete_image = function(itemId) {

                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch("{{ route('gallery.delete') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            id: itemId
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: "Your file has been deleted.",
                                                icon: "success"
                                            });
                                            document.querySelector(`.draggable-item[data-id="${itemId}"]`)
                                                .remove();
                                        }
                                    })
                                    .catch(error => console.error("Error deleting item:", error));

                            }
                        });
                    };

                    // ✅ Prevent Dragula from Dragging when Clicking Delete Button
                    document.querySelectorAll(".delete-btn").forEach(btn => {
                        btn.addEventListener("mousedown", function(e) {
                            e.stopPropagation(); // Stops Dragula from interfering
                        });
                    });

                    // ✅ Dragula Setup
                    let columns = document.querySelectorAll(".drag-column");
                    let drake = dragula([...columns], {
                        moves: function(el, container, handle) {
                            return !handle.classList.contains("delete-btn"); // Prevent drag on delete button
                        }
                    });

                    drake.on("drop", function(el, target) {
                        let positions = [];

                        document.querySelectorAll(".drag-column").forEach((column, colIndex) => {
                            column.querySelectorAll(".draggable-item").forEach((item, rowIndex) => {
                                let id = item.dataset.id;
                                positions.push({
                                    id: id,
                                    column: colIndex + 1, // Column number
                                    row: rowIndex + 1 // Row order inside the column
                                });
                            });
                        });

                        fetch("{{ route('gallery.updatePosition') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    positions: positions
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log("Positions updated successfully!");
                                }
                            })
                            .catch(error => console.error("Error updating positions:", error));
                    });
                });
            </script>




        </div>
    </div>


    <!-- ✅ Modal Structure -->
    <div id="hs-extralarge-modal" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
            <div class="ti-modal-content">

                <!-- 🔹 Modal Header -->
                <div class="ti-modal-header">
                    <h6 class="ti-modal-title">Upload Gallery</h6>
                    <button type="button" class="ti-modal-close-btn" data-hs-overlay="#hs-extralarge-modal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                fill="currentColor" />
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
                            class="grid grid-cols-4 gap-4 mt-4 p-2 border border-gray-300 rounded-md bg-gray-50"></div>

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
                            xhr.open("POST", "{{ route('content.gallery.store') }}", true);
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



    <script src="/assets/libs/dragula/dragula.min.js"></script>
    <script src="/assets/js/draggable-cards.js"></script>

</x-app-layout> --}}
