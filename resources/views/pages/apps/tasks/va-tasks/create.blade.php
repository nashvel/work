<x-app-layout>

    <x-slot name="title">Register New VA's Task</x-slot>
    <x-slot name="url_1">{"link": "/virtual-assistant/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/task-list-view", "text": "Virtual Assistant"}</x-slot>
    <x-slot name="active">New Task</x-slot>

    <!-- Node Waves Css -->
    <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
    <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
    <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

    <form action="{{ route('task.create') }}" method="POST" enctype="multipart/form-data" autocapitalize="true"
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

                            <!-- Task Name -->
                            <div class="xl:col-span-12 col-span-12">
                                <label for="task_name" class="form-label">Task Name :</label>
                                <input type="text" name="task_name" class="form-control form-control-lg"
                                    id="task_name" required placeholder="Enter Task Name">
                            </div>

                            <!-- Task ID -->
                            <div class="xl:col-span-6 col-span-12" style="display: none">
                                <label for="task_id" class="form-label">Task ID :</label>
                                <input type="text" name="task_id" class="form-control font-800" readonly
                                    id="task_id" value="{{ uniqid() }}" required placeholder="Enter Task ID">
                            </div>

                            <!-- Assigned Date -->
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Assigned Date :</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text text-textmuted dark:text-textmuted/50">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                        <input type="date" name="assigned_date" value="{{ date('Y-m-d') }}"
                                            class="form-control" id="assigned_date" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Due Date -->
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Due Date :</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text text-textmuted dark:text-textmuted/50">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                        <input type="date" name="due_date" class="form-control" id="due_date"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="xl:col-span-6 col-span-12">
                                <label for="status" class="form-label">Status :</label>
                                <select name="status" id="status" class="form-select p-2 px-4" required>
                                    <option value="" disabled selected>-</option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <option value="On Hold">On Hold</option>
                                </select>
                            </div>

                            <!-- Priority -->
                            <div class="xl:col-span-6 col-span-12">
                                <label for="priority" class="form-label">Priority :</label>
                                <select name="priority" id="priority" class="form-select p-2 px-4" required>
                                    <option value="" disabled selected>-</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </div>



                            <input class="form-control xl:col-span-12 hidden" name="status_update" id="status_update"
                                class="" style="width: 200% !important" required>
                            <span id="description-error" class="text-red-500 hidden">Task description is
                                required.</span>
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Task Description :</label>
                                <div contenteditable="false" id="project-descriptioin-editor"
                                    oninput="updateDescription()" class=" border p-2 min-h-[00px]">
                                </div>
                            </div>

                            <!-- Assigned To -->

                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Assigned To (Virtual Assistant)</label>
                                <select class="form-control" name="assigned_to[]" id="assigned_to" multiple required>
                                    @foreach (App\Models\VirtualAssistant::get() as $va)
                                        <option value="{{ $va->id }}">
                                            {{ $va->first_name }} {{ $va->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Assigned To (Project Related)</label>
                                <select class="form-control" name="project_id[]" multiple id="project_id">
                                    @foreach (App\Models\ProjectBidding::get() as $project)
                                        <option value="{{ $project->id }}">({{ $project->proj_code }})
                                            {{ $project->proj_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Assigned To (Clients)</label>
                                <select class="form-control" name="assigned_client[]" id="assigned_client" multiple>
                                    @foreach (App\Models\Clients::get() as $client)
                                        <option value="{{ $client->id }}">
                                            {{ $client->first_name }} {{ $client->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}



                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="ti-btn ti-btn-primary btn-wave ms-auto float-end">Create
                            Task</button>
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

            // const multipleCancelButton_y = new Choices('#assigned_client', {
            //     allowHTML: true,
            //     removeItemButton: true,
            // });

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
