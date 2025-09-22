<x-app-layout>
    <x-slot name="header">Compose Email</x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
    <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
    <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="grid grid-cols-12 gap-6">

        <div class="xl:col-span-12 col-span-12">
            <div class="box" id="register-panel">
                <div class="box-body">
                    @if ($errors->any())
                        <div
                            class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                            <div>
                                <strong class="text-danger">Whoops! Something went wrong:</strong>
                                <ul class="list-disc list-inside mt-2 mx-4">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-dark"><i>{{ $error }}</i></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('emails.send') }}">
                        @csrf
                        <div class="xl:col-span-12 col-span-12">
                            <div class="mb-3">
                                <label class="form-label">Send To:</label>

                                <div class="flex items-center gap-4 mb-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="email_mode" value="selection" checked
                                            class="form-radio toggle-email-mode">
                                        <span class="ml-2">Select from List</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="email_mode" value="manual"
                                            class="form-radio toggle-email-mode">
                                        <span class="ml-2">Manual Entry</span>
                                    </label>
                                </div>

                                {{-- Selection Mode --}}
                                <div id="select-email-mode">
                                    <div id="customSelectWrapper" class="form-control custom-multi-select"
                                        data-hs-overlay="#hs-extralarge-modal">
                                        Email Address
                                    </div>
                                    <select class="form-control hidden" name="to[]" id="assigned-team-members"
                                        multiple></select>
                                </div>

                                {{-- Manual Mode --}}
                                <div id="manual-email-mode" class="hidden">
                                    <textarea name="to_raw" rows="3" class="form-control"
                                        placeholder="Enter one or more email addresses separated by commas, spaces, or new lines"></textarea>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const radios = document.querySelectorAll('.toggle-email-mode');
                                    const selectWrapper = document.getElementById('select-email-mode');
                                    const manualWrapper = document.getElementById('manual-email-mode');

                                    radios.forEach(radio => {
                                        radio.addEventListener('change', () => {
                                            if (radio.value === 'manual' && radio.checked) {
                                                manualWrapper.classList.remove('hidden');
                                                selectWrapper.classList.add('hidden');
                                            } else {
                                                selectWrapper.classList.remove('hidden');
                                                manualWrapper.classList.add('hidden');
                                            }
                                        });
                                    });
                                });
                            </script>



                            <label class="mt-3 mb-3 form-label">Subject:</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject here.."
                                required><br>

                            <div class="mb-3 mt-5">

                                <input class="form-control xl:col-span-12 hidden" name="body" id="welcome_message"
                                    class="" style="width: 200% !important" required>
                                <div class="xl:col-span-12 col-span-12">
                                    <label class="form-label">Body : </label>
                                    <div id="project-descriptioin-editor" oninput="updateDescription()"
                                        class=" border p-2 min-h-[00px]">

                                    </div>
                                </div>

                                {{ old('welcome_message', $welcomeMessage->welcome_message ?? '') }}

                            </div>

                            <button type="submit"
                                class="ti-btn ti-btn-soft-success !text-default !rounded-full btn-wave waves-effect waves-light justify-end">
                                <span class="bi bi-send"></span>
                                Send Emails
                            </button>
                        </div>
                    </form>
                    <style>
                        .custom-multi-select {
                            border: 1px solid #eee;
                            padding: 8px;
                            border-radius: 5px;
                            cursor: pointer;
                            min-height: 40px;
                            display: flex;
                            flex-wrap: wrap;
                            align-items: center;
                            gap: 5px;
                            background: #fff;
                        }

                        .selected-item {
                            background: #f5f5f5;
                            color: #202020;
                            padding: 5px 10px;
                            border-radius: 3px;
                            display: flex;
                            align-items: center;
                        }

                        .remove-item {
                            margin-left: 5px;
                            cursor: pointer;
                            font-weight: bold;
                            display: none;
                        }

                        .assigned-team-members {
                            display: none !important;
                        }
                    </style>
                </div>

            </div>
        </div>
    </div>
    </div>

    @include('pages.apps.bids.partials.contacts')


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
                    'font': ['Rubic']
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
                ['image', 'video', 'link'],
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
</x-app-layout>
