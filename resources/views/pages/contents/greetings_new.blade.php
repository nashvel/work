<x-app-layout>

    <x-slot name="title">Automated Greetings</x-slot>
    <x-slot name="url_1">{"link": "/content/client/greetings", "text": "Automated Greetings"}</x-slot>
    <x-slot name="active"> {{ isset($id) ? 'Details' : 'Register' }} </x-slot>
    <x-slot name="buttons"></x-slot>

    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">
    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
    <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
    <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

    <div class="grid grid-cols-12 gap-6">

        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body">
                        <form
                            action="{{ isset($id) ? route('content.contact.greetings.update', $id) : route('content.contact.greetings.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($welcomeMessage))
                                @method('PUT')
                            @endif

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

                            <div class="grid grid-cols-12 gap-6">
                                <div class="xl:col-span-12 col-span-8">
                                    <div class="mb-3">
                                        <label for="client_id" class="form-label">Client Informartion</label>
                                        @if (isset($id))
                                            @php
                                                $info = App\Models\Lead::join(
                                                    'welcome_messages',
                                                    'welcome_messages.client_id',
                                                    'leads.id',
                                                )
                                                    ->where('welcome_messages.id', $id)
                                                    ->first();
                                            @endphp
                                            <input type="text" name="client_id" id="client_id"
                                                class="form-control form-control-lg bg-white text-dark" readonly
                                                value="{{ $info->company_name }}">
                                        @else
                                            <select name="client_id" id="client_id" class="form-select ">
                                                <option value="">-</option>
                                                <optgroup label="Client Portal">
                                                    @foreach (App\Models\Lead::get() as $client)
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->company_name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="CRM Portal">
                                                    @php
                                                        $clients = App\Models\Contact::where('isDeleted', 0)
                                                            ->where('lead_source', 'Plan Panther Subscription')
                                                            ->orWhere(
                                                                'lead_source',
                                                                'Potential Plan Panther Subscription',
                                                            )
                                                            ->get();
                                                    @endphp
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->company_name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                @php
                                    if (isset($id)) {
                                        $content = App\Models\WelcomeMessage::where('id', $id)
                                            ->where('status', 'Active')
                                            ->first();
                                        $message = $content->welcome_message;
                                        preg_match('/<div class="ql-editor"[^>]*>(.*?)<\/div>/s', $message, $matches);
                                    }
                                @endphp
                                <div class="xl:col-span-4 col-span-4" style="display: none">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" name="status" class="form-select" required>
                                            <option value="Active"
                                                {{ old('status', $welcomeMessage->status ?? '') == 'Active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="Inactive"
                                                {{ old('status', $welcomeMessage->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="welcome_message" class="block text-sm font-medium text-gray-700">Upload
                                    Multimedia</label>
                                <input type="file" name="welcome_message" id="welcome_message"
                                    accept="image/*,video/*,audio/*"
                                   class="block w-full border border-gray-200 rounded-sm text-sm file:border-0 file:bg-light file:me-4 file:py-3 file:px-4">
                            </div>

                            <!-- Preview container -->
                            <div id="preview-container" class="mt-4 space-y-2">
                                <img id="image-preview" class="hidden max-h-48 rounded border border-gray-300" />
                                <video id="video-preview" class="hidden w-full max-h-48 rounded border border-gray-300"
                                    controls></video>
                                <audio id="audio-preview" class="hidden w-full rounded border border-gray-300"
                                    controls></audio>
                            </div>

                            <script>
                                document.getElementById('welcome_message').addEventListener('change', function(event) {
                                    const file = event.target.files[0];

                                    const imagePreview = document.getElementById('image-preview');
                                    const videoPreview = document.getElementById('video-preview');
                                    const audioPreview = document.getElementById('audio-preview');

                                    // Hide all previews first
                                    imagePreview.classList.add('hidden');
                                    videoPreview.classList.add('hidden');
                                    audioPreview.classList.add('hidden');

                                    if (!file) return;

                                    const url = URL.createObjectURL(file);

                                    if (file.type.startsWith('image/')) {
                                        imagePreview.src = url;
                                        imagePreview.classList.remove('hidden');
                                    } else if (file.type.startsWith('video/')) {
                                        videoPreview.src = url;
                                        videoPreview.classList.remove('hidden');
                                    } else if (file.type.startsWith('audio/')) {
                                        audioPreview.src = url;
                                        audioPreview.classList.remove('hidden');
                                    }
                                });
                            </script>


                            {{-- <div class="mb-3 mt-2">

                                <input class="form-control xl:col-span-12 hidden" name="welcome_message"
                                    id="welcome_message" class="" style="width: 200% !important" required
                                    value="{{ $message ?? '' }}">
                                <div class="xl:col-span-12 col-span-12">
                                    <label class="form-label">Welcome Greetings : </label>
                                    <div contenteditable="false" id="project-descriptioin-editor"
                                        style="min-height: 350px" oninput="updateDescription()"
                                        class=" border p-2 min-h-[00px]">
                                        {!! $matches[1] ?? '' !!}
                                    </div>
                                </div>

                                {{ old('welcome_message', $welcomeMessage->welcome_message ?? '') }}

                            </div> --}}

                            <div class="box-footer">
                                <button type="submit" class="ti-btn ti-btn-success btn-wave ms-auto float-end">
                                    <i class="bi bi-save me-1"></i>
                                    {{ isset($id) ? 'Update' : 'Create' }} Greetings
                                </button>
                                @if (isset($id))
                                    <a href="#" class="ti-btn ti-btn-primary btn-wave ms-auto float-end"
                                        data-hs-overlay="#welcome-message-preview">
                                        <i class="bi bi-card-image me-1"></i> Preview
                                    </a>
                                @endif
                            </div>

                            {{-- <button type="submit"
                                class="ti-btn ti-btn-primary">{{ isset($welcomeMessage) ? 'Update' : 'Create' }}</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>



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

            // const multipleCancelButton = new Choices('#assigned-team-members', {
            //     allowHTML: true,
            //     removeItemButton: true,
            // });

            // const multipleCancelButton_x = new Choices('#invite-client', {
            //     allowHTML: true,
            //     removeItemButton: true,
            // });

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
                document.querySelector('#welcome_message').value = quill.root.innerHTML;
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
            document.querySelector('#welcome_message').value = document.querySelector('#project-descriptioin-editor')
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

        .choices__button {
            padding-left: 30px !important;
            color: #000 !important;
        }
    </style>

    @if (isset($id))
        @include('pages.contents.welcome_preview')
    @endif

</x-app-layout>
