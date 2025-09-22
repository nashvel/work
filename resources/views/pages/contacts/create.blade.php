<x-app-layout>

    <x-slot name="title">Register Relationship</x-slot>
    <x-slot name="url_2">{"link": "/contact/list", "text": "Manage"}</x-slot>
    <x-slot name="url_3">{"link": "/contact/list", "text": "Relationship"}</x-slot>
    <x-slot name="active">New</x-slot>

    <!-- Node Waves Css -->
    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
    <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
    <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

    <form action="{{ route('contact.create') }}" method="POST" enctype="multipart/form-data" autocapitalize="true"
        autocomplete="off">
        @csrf
        @php
            if (Auth::user()->role == 'Virtual Assistant') {
                $clientId = Auth::user()->company;
            } elseif (Auth::user()->role == 'Sub-Client') {
                $client = App\Models\Clients::where('email', Auth::user()->email)
                    ->first();
                $clientId = $client->id;
            } else {
                $lead = App\Models\Lead::where('email', Auth::user()->email)
                    ->select('id')
                    ->first();
                $clientId = $lead->id;
            }
        @endphp
        <input type="hidden" name="client_id" value="{{ $clientId }}">
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

                            <!-- Company Name -->
                            <div class="xl:col-span-12 col-span-12">
                                <label for="company_name" class="form-label">Company Name: <strong class="text-danger">*</strong></label>
                                <input type="text" name="company_name" class="form-control form-control-lg"
                                    id="company_name" required placeholder="Enter company name">
                            </div>


                            <!-- Type -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="type" class="form-label">Type: <strong class="text-danger">*</strong></label>
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
                                <label for="lead_source" class="form-label">Lead Source: <strong class="text-danger">*</strong></label>
                                <select name="lead_source" id="lead_source" class="form-select p-2 px-4">
                                    <option value="" disabled selected>-</option>
                                    <option value="Plan Panther Subscription">Plan Panther Subscription</option>
                                    <option value="No Plan Panther Subscription">No Plan Panther Subscription</option>
                                    <option value="Potential Plan Panther Subscription">Potential Plan Panther
                                        Subscription</option>
                                </select>
                            </div>


                            <!-- City & Zip Code -->
                            <div class="xl:col-span-2 col-span-12">
                                <label for="city_zip_code" class="form-label">City: <strong class="text-danger">*</strong></label>
                                <input type="text" name="city_zip_code" id="city_zip_code"
                                    class="form-control form-control-lg" placeholder="Enter city and zip code">
                            </div>

                            <div class="xl:col-span-2 col-span-12">
                                <label for="state" class="form-label">State: <strong class="text-danger">*</strong></label>
                                <input type="text" name="state" id="state" class="form-control form-control-lg"
                                    placeholder="Enter state code">
                            </div>

                            <!-- Address -->
                            <div class="xl:col-span-8 col-span-12">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" name="address" id="address" class="form-control form-control-lg"
                                    placeholder="Enter address">
                            </div>

                            <!-- Phone -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="phone" class="form-label">Phone number: <strong class="text-danger">*</strong></label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-lg"
                                    placeholder="Enter phone number">
                            </div>

                            <div class="xl:col-span-4 col-span-12">
                                <label for="email" class="form-label">Email Address: <strong class="text-danger">*</strong></label>
                                <input type="email" name="email" id="email"
                                    class="form-control form-control-lg" placeholder="Enter Email Address">
                            </div>

                            <!-- Fax -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="fax" class="form-label">Fax:</label>
                                <input type="text" name="fax" id="fax"
                                    class="form-control form-control-lg" placeholder="Enter fax number">
                            </div>

                            <!-- Website -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="website" class="form-label">Website:</label>
                                <input type="url" name="website" id="website"
                                    class="form-control form-control-lg" placeholder="Enter website URL">
                            </div>

                            <!-- License -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="license" class="form-label">License:</label>
                                <input type="text" name="license" id="license"
                                    class="form-control form-control-lg" placeholder="Enter license details">
                            </div>

                            <!-- Insurance -->
                            <div class="xl:col-span-4 col-span-12">
                                <label for="insurance" class="form-label">Insurance:</label>
                                <input type="text" name="insurance" id="insurance"
                                    class="form-control form-control-lg" placeholder="Enter insurance details">
                            </div>

                            <!-- Notes -->
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Notes:</label>
                                <textarea name="notes" id="notes" class="form-control form-control-lg p-2" rows="4"
                                    placeholder="Enter any additional notes"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="ti-btn ti-btn-primary btn-wave ms-auto float-end">
                            <i class="bi bi-check"></i>
                            Create Relationship
                        </button>
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

            const multipleCancelButton = new Choices('#assigned_to', {
                allowHTML: true,
                removeItemButton: true,
            });

            const multipleCancelButton_x = new Choices('#project_id', {
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
                document.querySelector('#status_update').value = quill.root.innerHTML;
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
            document.querySelector('#status_update').value = document.querySelector('#project-descriptioin-editor')
                .innerHTML;
        }
    </script>
</x-app-layout>
