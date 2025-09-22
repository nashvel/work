<x-app-layout>

    <x-slot name="title">Email Template</x-slot>
    <x-slot name="url_1">{"link": "/client/list", "text": "Email"}</x-slot>
    <x-slot name="active">Template</x-slot>
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
                            action="#"
                            method="POST">
                            @csrf
                            @if (isset($welcomeMessage))
                                @method('PUT')
                            @endif

                            <div class="mb-3 ">

                                <input class="form-control xl:col-span-12 hidden" name="welcome_message"
                                    id="welcome_message" class="" style="width: 200% !important" required>
                                <div class="xl:col-span-12 col-span-12">
                                    <div contenteditable="false" id="project-descriptioin-editor" style="min-height: 550px"
                                        oninput="updateDescription()" class=" border p-2 min-h-[20px]">

                                        <h2>
                                        <div style="font-family: 'Poppins', sans-serif; background-color: #f4f4f4; margin: 0; padding: 25px;">
                                            <div
                                                style="margin: 20px auto; background: #ffffff; padding: 20px; 
                                                        border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                                <br/>
                                                <!-- Content -->
                                                <div style="padding: 20px; font-size: 16px; color: #333;">
                                                    <p>Dear <strong><i>{{ '<Bidder Name>'}}</i>
                                                            (<i>{{ '<Bidder Company>'}}</i>)</strong>,</p>
                                                                <br/>
                                                    <p>We are pleased to submit our proposal for the <strong><i>{{ '<Project Title>'}}</i></strong> project. Below,
                                                        you
                                                        will find the details of our bid, including our approach, scope of work, and pricing.</p>
                                        
                                        
                                                   
                                                        <div style="margin-top: 20px;">
                                                            <h2 style="color: #2c3e50;">📎 Attached Documents</h2>
                                                            <ul style="padding-left: 20px; list-style: none;">
                                                                    <li style="margin-bottom: 8px; font-size: 32px !important;">
                                                                        🔗 <i>{{ '<Document Attached>'}}</i>
                                                                    </li>
                                                            </ul>
                                                        </div>
                                                        <br/>
                                                    <p>We appreciate the opportunity to submit this proposal and look forward to your review. If you have any
                                                        questions or require further information, please do not hesitate to contact us.</p>
                                                    <br/>
                                                    <p>Best Regards,</p>
                                                    <p><strong><i>{{ '<Client Name>'}}</i></strong><br>
                                                        <i>{{ '<Client Location>'}}</i><br>
                                                        <i>{{ '<Client Email Address>'}}</i><br>
                                                        <i>{{ '<Client Contact No.>'}}</i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        </h2>
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                
                            </div>

                            <div class="col-lg-12 mt-5" style="float: right">
                                <hr class="mt-4 mb-3">
                            </div>

                            <div class="col-lg-10 justify-end  mt-2" style="float: right">
                                <div class="form-group justify-end">
                                    {{-- <button type="reset" class="btn btn-danger mx-3">
                                        <em class="icon ni ni-repeat"></em>&ensp; Reset
                                    </button> --}}
                                    <button type="submit" class="ti-btn bg-primary text-white">
                                        <em class="icon bi bi-save"></em>&ensp; Save Changes
                                    </button>
                                </div>
                            </div>
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
                    toolbar: toolbarOptions,
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
