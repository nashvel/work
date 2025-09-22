<x-app-layout>

    <x-slot name="title">Register New Bidding</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Construction Bidding"}</x-slot>
    <x-slot name="active">New Bidding</x-slot>

    <!-- Node Waves Css -->
    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
    <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
    <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" autocapitalize="true"
        autocomplete="off">
        @csrf
        <div class="grid grid-cols-12 gap-x-6">
            <div class="xl:col-span-12 col-span-12">
                <div class="box">
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

                        <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3">
                            <div class="xl:col-span-7 col-span-7">
                                <label for="project_name" class="form-label">Bidding Name :</label>
                                <input type="text" name="project_name" class="form-control" id="project_name"
                                    style="min-height: 40px"
                                    placeholder="Bidding (e,i: Construction Cleanup, Epoxy Coating, Floor Area, (Square Footage), Measure Tiles, (Qty)"
                                    required>
                            </div>

                            <div class="xl:col-span-3 col-span-3">
                                <label for="project_name" class="form-label">Building Type :</label>
                                <select name="building_type" id="building_type" class="form-select p-2 px-4" required>
                                    <option value="" disabled selected>-</option>

                                    <!-- Residential Buildings -->
                                    <optgroup label="Residential Buildings">
                                        <option value="Single-family Home">Single-family Home</option>
                                        <option value="Apartment Building">Apartment Building</option>
                                        <option value="Condominium">Condominium (Condo)</option>
                                        <option value="Townhouse">Townhouse</option>
                                        <option value="Duplex/Triplex">Duplex/Triplex</option>
                                        <option value="Mobile Home">Mobile Home</option>
                                    </optgroup>

                                    <!-- Commercial Buildings -->
                                    <optgroup label="Commercial Buildings">
                                        <option value="Office Building">Office Building</option>
                                        <option value="Retail Store">Retail Store</option>
                                        <option value="Shopping Mall">Shopping Mall</option>
                                        <option value="Restaurant/Café">Restaurant/Café</option>
                                        <option value="Hotel/Resort">Hotel/Resort</option>
                                        <option value="Mixed-Use Building">Mixed-Use Building</option>
                                    </optgroup>

                                    <!-- Industrial Buildings -->
                                    <optgroup label="Industrial Buildings">
                                        <option value="Factory/Manufacturing Plant">Factory/Manufacturing Plant</option>
                                        <option value="Warehouse/Storage Facility">Warehouse/Storage Facility</option>
                                        <option value="Data Center">Data Center</option>
                                        <option value="Distribution Center">Distribution Center</option>
                                    </optgroup>

                                    <!-- Institutional Buildings -->
                                    <optgroup label="Institutional Buildings">
                                        <option value="School/University">School/University</option>
                                        <option value="Hospital/Clinic">Hospital/Clinic</option>
                                        <option value="Church/Mosque/Temple">Church/Mosque/Temple</option>
                                        <option value="Library">Library</option>
                                        <option value="Government Building">Government Building</option>
                                    </optgroup>

                                    <!-- Recreational & Cultural Buildings -->
                                    <optgroup label="Recreational & Cultural Buildings">
                                        <option value="Theater/Cinema">Theater/Cinema</option>
                                        <option value="Stadium/Sports Complex">Stadium/Sports Complex</option>
                                        <option value="Museum/Exhibition Hall">Museum/Exhibition Hall</option>
                                        <option value="Convention Center">Convention Center</option>
                                    </optgroup>

                                    <!-- Special Purpose Buildings -->
                                    <optgroup label="Special Purpose Buildings">
                                        <option value="Skyscraper">Skyscraper</option>
                                        <option value="Airport Terminal">Airport Terminal</option>
                                        <option value="Train/Bus Station">Train/Bus Station</option>
                                        <option value="Parking Garage">Parking Garage</option>
                                        <option value="Lighthouse">Lighthouse</option>
                                    </optgroup>
                                </select>

                            </div>

                            <div class="xl:col-span-2 col-span-2">
                                <label for="project_name" class="form-label">Status :</label>
                                <select name="building_status" id="building_status" class="form-select p-2 px-4" required>
                                    <option value="" disabled selected>-</option>

                                    <!-- Residential Buildings -->
                                    <optgroup label="Status">
                                        <option value="Private">Private</option>
                                        <option value="Public">Public</option>
                                    </optgroup>
                                </select>
                            </div>

                            <input class="form-control xl:col-span-12 hidden" name="project_description"
                                id="project_description" class="" style="width: 200% !important" required>
                            <span id="description-error" class="text-red-500 hidden">Bidding description is
                                required.</span>
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Bidding Description :</label>
                                <div contenteditable="false" id="project-descriptioin-editor"
                                    oninput="updateDescription()" class=" border p-2 min-h-[00px]">

                                </div>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Start Date :</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text text-textmuted dark:text-textmuted/50">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                        <input type="text" name="start_date" class="form-control" id="startDate"
                                            placeholder="Choose date and time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Due Date :</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text text-textmuted dark:text-textmuted/50">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                        <input type="text" name="end_date" class="form-control" id="endDate"
                                            placeholder="Choose date and time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Upload Thumbnail</label>
                                <input
                                    class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/50 file:border-0 file:bg-light file:me-4 file:py-3 file:px-4 dark:file:bg-black/20 dark:file:text-white/50"
                                    type="file" name="thumbnail" id="thumbnail">
                            </div>
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Assigned To (Virtual Assistant)</label>
                                <select class="form-control" name="assigned_team_members[]"
                                    id="assigned-team-members" multiple>
                                    @foreach (App\Models\VirtualAssistant::get() as $va)
                                        <option value="{{ $va->id }}">
                                            {{ $va->first_name }} {{ $va->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Invite Client (Notify via Email Address)</label>
                                <select class="form-control" name="invite_client[]" id="invite-client" multiple>
                                    @foreach (App\Models\Clients::get() as $client)
                                        <option value="{{ $client->email }}">
                                            {{ $client->first_name }} {{ $client->last_name }} ({{ $client->company }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="ti-btn ti-btn-warning btn-wave ms-auto float-end">Create
                            Project</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Custom-Switcher JS -->
    <script src="/assets/js/custom-switcher.min.js"></script>

    <!-- Quill Editor JS -->
    <script src="/assets/libs/quill/quill.js"></script>

    <!-- Filepond JS -->
    <script src="/assets/libs/filepond/filepond.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js"></script>
    <script src="/assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="/assets/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js"></script>

    <!-- Flat Picker JS -->
    <script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

    <script>
        (function() {
            "use strict"

            flatpickr("#startDate", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            flatpickr("#endDate", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            const multipleCancelButton = new Choices('#assigned-team-members', {
                allowHTML: true,
                removeItemButton: true,
            });

            const multipleCancelButton_x = new Choices('#invite-client', {
                allowHTML: true,
                removeItemButton: true,
            });

            var toolbarOptions = [
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'font': []
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'direction': 'rtl'
                }],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'align': []
                }],
                ['image', 'video'],
                ['clean']
            ];
            var quill = new Quill('#project-descriptioin-editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            document.querySelector('form').addEventListener('submit', function() {
                document.querySelector('#project_description').value = quill.root.innerHTML;
            });

            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginFileEncode,
                FilePondPluginImageEdit,
                FilePondPluginFileValidateType,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform
            );

            const MultipleElement = document.querySelector('.multiple-filepond');
            FilePond.create(MultipleElement);
        })();

        function updateDescription() {
            document.querySelector('#project_description').value = document.querySelector('#project-descriptioin-editor')
                .innerHTML;
        }
    </script>

    <style>
        .choices__list--multiple .choices__item {
            border-width: 1px !important;
            border-style: solid !important;
            border-color: rgb(255, 255, 255) !important;
            background-color: #FFBE5F !important;
            color: #303030;
            padding-top: 2px !important;
        }
        .choices__button{
            padding-left: 30px !important;
            color: #000 !important;
        }
    </style>
</x-app-layout>
