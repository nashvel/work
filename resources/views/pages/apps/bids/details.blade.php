@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    @php
        $project = App\Models\ProjectBidding::where('id', $id)->first();
        function formatTime($timestamp)
        {
            $timestamp = Carbon::parse($timestamp); // Convert string to Carbon instance

            return $timestamp->diffInSeconds(now()) < 60 ? 'Just Now' : $timestamp->diffForHumans();
        }
    @endphp
    <x-slot name="title">Project Information</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage Project"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/details/{{ $id }}", "text": "Details"}</x-slot>
    <x-slot name="active">{{ $project->proj_name }}</x-slot>

    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-8 col-span-12">
            <div class="box">
                <div class="box-body" style="">

                    <div class="flex items-center mb-4 gap-2 flex-wrap">
                        <span class="avatar avatar-lg me-1 bg-gradient-to-br from-primary to-secondary"><i
                                class="ri-stack-line text-2xl leading-none"></i></span>
                        <div class="mx-3">
                            <h6 class="font-medium mb-2 task-title">
                                {{ $project->proj_name }}
                            </h6>
                            <span class="badge bg-warning/10 text-info">{{ $project->proj_stages }}</span>
                            <span class="text-textmuted dark:text-textmuted/50 text-xs">
                                <i class="ri-circle-fill text-info mx-2 text-[0.5625rem]"></i>
                                {{ formatTime($project->created_at) }}
                            </span>
                        </div>

                        <div class="ms-auto align-self-start">
                            <a href="/project/edit/{{ $id }}"
                                class="bg-gray-200 hover:bg-purple-700 text-dark mx-3 px-5 py-2 rounded-md transition duration-150 ease-in-out">
                                <i class="bi bi-pen me-1"></i> Edit
                            </a>
                            <button onclick="remove_data({{ $id }}, 'project')"
                                class="bg-gray-200 hover:bg-red-700 text-dark px-5 py-2 rounded-md transition duration-150 ease-in-out">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="text-[15px] font-medium mb-2">Project Details :</div>

                    <div class="xxl:col-span-8 col-span-12">
                        <div class="mb-6 border border-gray-200 rounded-lg bg-white">
                            <div class="box-body p-6">
                                <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                                    <i class="bi bi-stickies text-yellow-500"></i>To do List : Task
                                </h2>

                                @php
                                    $notes = App\Models\Task::latest()->get();
                                @endphp

                                @if ($notes->count())
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                                            <thead class="bg-gray-100 text-gray-700 text-sm">
                                                <tr>
                                                    <th class="px-4 py-2 text-left">Task</th>
                                                    <th class="px-4 py-2 text-left">Date</th>
                                                    <th class="px-4 py-2 text-left" width="100">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notes as $note)
                                                    <tr class="border-t hover:bg-gray-50 transition">
                                                        <td class="px-4 py-2 font-medium text-gray-800">
                                                            {{ $note->task_name }}</td>
                                                        <td class="px-4 py-2 text-xs text-gray-500">
                                                            {{ $note->created_at->diffForHumans() }}</td>
                                                        <td class="px-4 py-2">
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700 text-xs flex items-center gap-1">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">No task yet. Start by adding a note on the left.
                                    </p>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="flex gap-5 mb-4 flex-wrap">
                        <div class="flex items-center gap-2 me-3"> <span
                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint1color/10 !text-primarytint1color"><i
                                    class="ri-calendar-event-line text-lg leading-none align-middle"></i></span>
                            <div>
                                <div class="font-medium mb-0 task-title"> Date Uploaded</div> <span
                                    class="text-xs text-textmuted dark:text-textmuted/50">{{ date_format($project->created_at, 'D, M. d, Y h:s A') }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 me-3"> <span
                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint2color/10 !text-primarytint2color"><i
                                    class="ri-time-line text-lg leading-none align-middle"></i></span>
                            <div>
                                <div class="font-medium mb-0 task-title"> Due Date </div> <span
                                    class="text-xs text-textmuted dark:text-textmuted/50">{{ date_format(date_create($project->proj_due_date), 'D, F d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="mb-4">
                        <div class="grid grid-cols-12 sm:gap-x-6">
                            <div class="xl:col-span-8 col-span-12">
                                <div class="flex items-center justify-between mb-2">
                                    {{-- <div class="text-[15px] font-medium">Documents :</div> --}}
                                </div>
                                <ul class="ti-list-group">
                                    @php
                                        $docs = $project->proj_documents ?? [];
                                    @endphp
                                    @foreach ($docs as $doc)
                                        <li class="ti-list-group-item">
                                            <div class="flex items-center">
                                                <div class="me-2">
                                                    <i
                                                        class="ri-link text-[15px] text-secondary leading-none p-1 bg-secondary/10 rounded-full"></i>
                                                </div>
                                                <div class="font-medium">
                                                    <a href="/file-manager/preview/{{ $doc['google_drive_id'] }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        {{ $doc['name'] ?? basename($doc['path']) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="xl:col-span-4 col-span-12">
                                <div class="text-[15px] font-medium mb-2">Scopes :</div>
                                <ul class="task-details-key-tasks mb-0 ps-8">
                                    @php
                                        $stage_descriptions = $project->stage_descriptions;
                                    @endphp

                                    @if (is_array($stage_descriptions) && count($stage_descriptions))
                                        @foreach ($stage_descriptions as $stage => $description)
                                            <li>{{ str_replace('_', ' ', $stage) }}</li>
                                        @endforeach
                                    @else
                                        <li>No stage descriptions found.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $stage_descriptions = $project->stage_descriptions;

                // Decode if it's JSON and ensure it's an array
                if (is_string($stage_descriptions)) {
                    $stage_descriptions = json_decode($stage_descriptions, true);
                }

                // Fallback to empty array if still null
                $stage_descriptions = $stage_descriptions ?? [];
            @endphp
            @foreach ($stage_descriptions as $stage => $description)
                <div class="box justify-between">
                    <div class="box-header justify-between">
                        <div class="box-title p-5 pb-0 pt-2">
                            <h3>
                                <strong>
                                    {{ str_replace('_', ' ', $stage) }}
                                </strong>
                            </h3>
                            <div class="prose custom-description">
                                {!! $description !!}
                            </div>
                            <style>
                                .custom-description a {
                                    display: inline-block;
                                    padding: 0.35em 0.75em;
                                    color: #2563eb;
                                    font-weight: 400;
                                    /* Semi-normal weight */
                                    font-style: italic;
                                    border-radius: 0.375rem;
                                    /* Rounded corners */
                                    text-decoration: none;
                                    transition: background-color 0.3s ease, color 0.3s ease;
                                    cursor: pointer;
                                }

                                .custom-description a:hover {
                                    background-color: #1e40af;
                                    /* Tailwind blue-800 */
                                    color: #e0e7ff;
                                    /* Light blue text on hover */
                                    text-decoration: none;
                                }
                            </style>
                        </div>
                        <a href="/project/edit/{{ $id }}?t={{ str_replace('_', ' ', $stage) }}"
                            class="bg-gray-200 hover:bg-purple-700 text-dark mx-3 px-5 py-2 rounded-md transition duration-150 ease-in-out">
                            <i class="bi bi-pen me-1"></i> Edit Notes
                        </a>
                    </div>
                    <div class="box-body overflow-y-auto" id="discussion-container" style="max-height: 630px">
                        <hr class="mb-3">
                        <div class="mb-3 mt-3 border border-gray-200 rounded-lg bg-white">
                            <div class="box-body p-6">
                                <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                                    <i class="bi bi-stickies text-yellow-500"></i>Short Notes
                                </h2>

                                @php
                                    $notes = App\Models\Note::where('type', str_replace('_', ' ', $stage))
                                        ->latest()
                                        ->get();
                                @endphp

                                @if ($notes->count())
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                                            <thead class="bg-gray-100 text-gray-700 text-sm">
                                                <tr>
                                                    <th class="px-4 py-2 text-left">Ttile</th>
                                                    <th class="px-4 py-2 text-left">Notes</th>
                                                    <th class="px-4 py-2 text-left">Date</th>
                                                    <th class="px-4 py-2 text-left" width="100">Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notes as $note)
                                                    <tr class="border-t hover:bg-gray-50 transition">
                                                        <td class="px-4 py-2 font-medium text-gray-800">
                                                            {{ $note->title }}</td>
                                                        <td class="px-4 py-2 font-medium text-gray-800">
                                                            @php
                                                                $dom = new DOMDocument();
                                                                libxml_use_internal_errors(true); // avoid warnings
                                                                $dom->loadHTML($note->content);
                                                                $paragraphs = $dom->getElementsByTagName('p');
                                                                $content = '';
                                                                foreach ($paragraphs as $p) {
                                                                    $content .= $dom->saveHTML($p);
                                                                }
                                                            @endphp
                                                            {!! $content !!}</td>
                                                        <td class="px-4 py-2 text-xs text-gray-500">
                                                            {{ $note->created_at->diffForHumans() }}</td>
                                                        <td class="px-4 py-2">
                                                            <form action="{{ route('notes.destroy', $note->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    onclick="return confirm('Are you sure you want to delete this note?')"
                                                                    class="text-red-500 hover:text-red-700 text-xs">
                                                                    <i class="bi bi-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">
                                        No notes available yet. Get started by adding one on the left.
                                    </p>
                                @endif

                            </div>
                        </div>

                        <ul class="ti-list-group list-group-flush !rounded-none">
                            @php
                                $stageKey = str_replace('_', ' ', $stage);
                            @endphp
                            @php
                                $stage_descriptions = $project->stage_descriptions;
                                $invite_clients = $project->invite_clients;
                            @endphp

                            @if (isset($invite_clients[$stageKey]) && is_array($invite_clients[$stageKey]))
                                @foreach ($invite_clients[$stageKey] as $email)
                                    @php
                                        $user = App\Models\User::where('email', $email)->first();

                                        $status = App\Models\Invite::where('project_id', $project->id)
                                            ->where('email', $email)
                                            ->where('category', $stageKey)
                                            ->first();

                                    @endphp
                                    @if ($user)
                                        <li class="ti-list-group-item">
                                            <div class="flex items-center flex-wrap gap-2">
                                                <div class="me-2">
                                                    <span class="avatar avatar-md avatar-rounded mt-2">
                                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}g"
                                                            onerror="this.src='/user.png'" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-auto"> <a href="javascript:void(0);"><span
                                                            class="block font-medium">{{ $user->name }}</span></a>
                                                    <span
                                                        class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">

                                                        @php
                                                            // Set the badge status, defaulting to 'Invited' if status is null
                                                            $badgeStatus =
                                                                $status && $status->status !== null
                                                                    ? $status->status
                                                                    : 'Invited';

                                                            // Assign badge color based on status
                                                            switch ($status->status ?? '') {
                                                                case 'Bidding':
                                                                    $badgeColor = 'primary';
                                                                    break;
                                                                case 'Proposal Sent':
                                                                    $badgeColor = 'info';
                                                                    break;
                                                                case 'Negotiating':
                                                                    $badgeColor = 'warning';
                                                                    break;
                                                                case 'Closed Won':
                                                                    $badgeColor = 'success';
                                                                    break;
                                                                case 'Closed Lost':
                                                                    $badgeColor = 'danger';
                                                                    break;
                                                                case 'Time Out':
                                                                    $badgeColor = 'secondary';
                                                                    break;
                                                                default:
                                                                    $badgeColor = 'dark'; // Default color if status is unknown or null
                                                                    break;
                                                            }

                                                            // Set selected attribute if the status matches certain conditions
                                                            $status_partial = in_array($status->status, [
                                                                'Accepted',
                                                                null,
                                                            ])
                                                                ? 'selected'
                                                                : '';
                                                        @endphp


                                                        <span
                                                            class="badge bg-{{ $badgeColor }}/10 mt-1 text-{{ $badgeColor }}">
                                                            {{ $badgeStatus }}
                                                        </span>

                                                        <i
                                                            class="ri-circle-fill text-{{ $badgeColor }} mx-2 text-[0.5625rem]"></i>
                                                        {{ $email }}
                                                    </span>
                                                </div>
                                                <div class="ms-auto inline-flex gap-2">

                                                    <select name="" id="status-select" class="ti-form-select"
                                                        onchange="change_status({{ $status->id ?? null }}, this.value)">
                                                        <option value="" disabled selected>- Select Stage -
                                                        </option>

                                                        <optgroup label="Bidding Status">
                                                            <option value="Bidding"
                                                                {{ $status && $status->status === 'Bidding' ? 'selected' : '' }}>
                                                                Bidding</option>
                                                            <option value="Proposal Sent"
                                                                {{ $status && $status->status === 'Proposal Sent' ? 'selected' : '' }}>
                                                                Proposal Sent</option>
                                                            <option value="Negotiating"
                                                                {{ $status && $status->status === 'Negotiating' ? 'selected' : '' }}>
                                                                Negotiating</option>
                                                        </optgroup>

                                                        <optgroup label="Closed Status">
                                                            <option value="Closed Won"
                                                                {{ $status && $status->status === 'Closed Won' ? 'selected' : '' }}>
                                                                Closed Won</option>
                                                            <option value="Closed Lost"
                                                                {{ $status && $status->status === 'Closed Lost' ? 'selected' : '' }}>
                                                                Closed Lost</option>
                                                        </optgroup>

                                                        <optgroup label="Other Status">
                                                            <option value="Time Out"
                                                                {{ $status && $status->status === 'Time Out' ? 'selected' : '' }}>
                                                                Time Out</option>
                                                        </optgroup>

                                                    </select>

                                                    <a href="/chat/{{ $user->id }}"
                                                        class="header-link hs-dropdown-toggle ti-dropdown-toggle border border-gray-50">
                                                        <i class="bi bi-chat header-link text-lg"></i>
                                                    </a>

                                                    <a href="javascript:void(0);"
                                                        class="header-link hs-dropdown-toggle ti-dropdown-toggle border border-gray-50">
                                                        <i class="bi bi-person-circle header-link text-lg p-0"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                No clients invited.
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
            <!-- Emoji Script -->
            <script>
                function change_status(id, value) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You can revert this status anytime",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Update it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('invitation.project.update') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    id: id,
                                    type: value
                                },
                                success: function() {
                                    Swal.fire({
                                        title: "Updated!",
                                        text: "The status has been dpdated.",
                                        icon: "success"
                                    });
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                }
                            });

                        }
                    });
                }

                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelector('input[name="message"]').addEventListener('input', function(event) {
                        this.value = this.value.replace(/:smile:/g, '😊').replace(/:heart:/g, '❤️');
                    });
                });

                function displayFileName(input) {
                    let fileName = input.files.length ? input.files[0].name : '';
                    document.getElementById('file-name-display').innerText = fileName ? `Selected File: ${fileName}` : '';
                }
            </script>
        </div>

        <div class="xxl:col-span-4 col-span-12">

            <div class="xxl:col-span-4 col-span-12">
                <div class="box custom-box shadow-md border border-gray-200 rounded-lg bg-white">
                    <div class="box-body p-6">
                        @if (session('success'))
                            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded flex items-center gap-2">
                                <i class="bi bi-check-circle-fill text-green-500"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                            <i class="bi bi-journal-text text-blue-600"></i> Add a New Short Note
                        </h2>

                        <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <hr class="mt-2 mb-2">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Type :
                                </label>
                                <select name="type" id="type"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 px-3"
                                    required>
                                    @foreach ($stage_descriptions as $stage => $description)
                                        <option value="{{ str_replace('_', ' ', $stage) }}">
                                            {{ str_replace('_', ' ', $stage) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title :
                                </label>
                                <input type="text" name="title" id="title" placeholder="e.g. Meeting Notes"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                    required>
                            </div>

                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Short Notes
                                    :
                                </label>
                                <input type="hidden" name="id" value="{{ $id }}">
                                <textarea name="content" id="content" placeholder="Write your note here..."
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" rows="5"
                                    required></textarea>


                                <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
                                <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
                                <link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
                                <link rel="stylesheet"
                                    href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
                                <link rel="stylesheet"
                                    href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

                                {{-- <input class="form-control xl:col-span-12 hidden" name="content" id="status_update"
                                    class="" style="width: 200% !important" required>
                                <div class="xl:col-span-12 col-span-12">
                                    <div contenteditable="false" id="project-descriptioin-editor"
                                        oninput="updateDescription()" class=" border p-2 min-h-[00px]">
                                    </div>
                                </div> --}}


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
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md transition duration-150 ease-in-out">
                                    <i class="bi bi-plus-circle me-1"></i> Add Note
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box overflow-hidden">
                <div class="box-body p-0">
                    <ul class="ti-list-group list-group-flush !rounded-none">
                        <li class="ti-list-group-item bg-light text-dark font-semibold text-lg py-2 px-3">
                            Contractors (Bidders)
                        </li>
                    </ul>
                    <div class="container">
                        <ul class="list-none courses-instructors mb-0 pt-4 px-2">
                            @php
                                $bidders = $project->proj_bidders; // No need to decode
                                $gcs = App\Models\ContactPerson::join(
                                    't_contacts',
                                    't_contacts.id',
                                    '=',
                                    't_contact_person.company_id',
                                )
                                    ->whereIn('t_contact_person.id', $bidders)
                                    ->get();

                            @endphp

                            @foreach ($gcs as $gc)
                                <li>
                                    <div class="flex">

                                        <div class="flex flex-auto items-center">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded">
                                                    <img src="{{ asset('storage/' . $gc->profile_photo_path) }}"
                                                        onerror="this.src='/user.png'" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <span class="block font-medium">
                                                    {{ $gc->first_name ?? '' }}
                                                    {{ $gc->last_name ?? '' }}
                                                    ({{ ltrim($gc->company_name) }})
                                                </span>
                                                <span
                                                    class="text-textmuted dark:text-textmuted/50">{{ $gc->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        {{-- <div class="box overflow-hidden">
                <div class="box-body p-0">
                    <ul class="ti-list-group list-group-flush !rounded-none">
                        <li class="ti-list-group-item bg-light text-dark font-semibold text-lg py-2 px-3">
                            General Contractors
                        </li>
                    </ul>
                    <div class="container">
                        <ul class="list-none courses-instructors mb-0 pt-4 px-2">
                            @php
                                $gcs = App\Models\Bid::join('users', 'users.id', 'bids.user_id')
                                    ->join('clients', 'clients.user_id', 'bids.user_id')
                                    ->where('project_id', $id)
                                    ->select('bids.*', 'users.*', 'clients.*', 'bids.created_at as bid_created')
                                    ->get();

                                function formatTime($timestamp)
                                {
                                    $timestamp = Carbon::parse($timestamp); // Convert string to Carbon instance

                                    return $timestamp->diffInSeconds(now()) < 60
                                        ? 'Just Now'
                                        : $timestamp->diffForHumans();
                                }

                            @endphp
                            @foreach ($gcs as $gc)
                                <li>
                                    <div class="flex">
                                        <div class="flex flex-auto items-center">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded">
                                                    <img src="{{ asset('storage/' . $gc->profile_photo_path) }}"
                                                        onerror="this.src='/user.png'" alt="">
                                                </span>
                                            </div>
                                            <div> <span class="block font-medium">{{ $gc->name }}</span> <span
                                                    class="text-textmuted dark:text-textmuted/50">{{ $gc->company }}</span>
                                            </div>
                                        </div>
                                        <div class="text-end ms-auto">
                                            <span class="block font-medium">
                                                {{ formatTime($gc->bid_created) }}
                                            </span>
                                            <span class="text-textmuted dark:text-textmuted/50">
                                                <i>
                                                    <small>
                                                        {{ Carbon::parse($gc->bid_created)->format('D, M. d, Y - h:i A') }}
                                                    </small>
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <br>
                </div>
            </div> --}}


        {{-- <div class="xxl:col-span-4 col-span-12">

                    <div class="box-body p-0">
                        @php
                            $constructionBiddingDocuments = [
                                'Legal Documents' => [
                                    'Business Registration Certificate',
                                    'Tax Identification Number (TIN)',
                                    'Company Profile',
                                    // 'List of Completed Projects',
                                    // 'List of Key Personnel and Their Qualifications',
                                    // 'Certificate of Good Standing (if applicable)',
                                    // 'Power of Attorney (if applicable)',
                                ],

                                'Financial Documents' => [
                                    'Audited Financial Statements (Last 3 Years)',
                                    'Bank Guarantee or Bid Security',
                                    // 'Credit Line Certificate',
                                    // 'Net Financial Contracting Capacity (NFCC)',
                                    // 'Statement of Ongoing and Completed Contracts',
                                ],

                                'Technical Documents' => [
                                    'Detailed Project Proposal',
                                    'Work Plan and Schedule',
                                    'Methodology and Construction Approach',
                                    // 'List of Equipment and Tools',
                                    // 'Health and Safety Plan',
                                    // 'Quality Assurance Plan',
                                    // 'Environmental Impact Assessment (if required)',
                                ],

                                'Bidding Forms' => [
                                    'Bid Submission Form',
                                    'Bid Security Declaration',
                                    // 'Bill of Quantities (BOQ)',
                                    // 'Statement of Compliance - Tech. Specifications',
                                    // 'Affidavit of Site Inspection',
                                    // 'Joint Venture Agreement (if applicable)',
                                ],

                                'Permits and Licenses' => [
                                    'Contractor’s License',
                                    'Building Permit (if required before bidding)',
                                    // 'Environmental Clearance Certificate',
                                    // 'Labor and Employment Clearance',
                                    // 'Insurance Certificates',
                                ],
                            ];

                        @endphp
                        <ul class="ti-list-group list-group-flush !rounded-none">
                            @foreach ($constructionBiddingDocuments as $category => $documents)
                                <!-- Category Header -->
                                <li class="ti-list-group-item bg-light text-dark font-semibold text-lg py-2 px-3">
                                    {{ $category }}
                                </li>

                                @foreach ($documents as $document)
                                    <li class="ti-list-group-item">
                                        <div class="flex items-center flex-wrap gap-2">
                                            <span class="avatar avatar-md avatar-rounded p-2 bg-light leading-none">
                                                <img src="/assets/images/media/file-manager/1.png" alt="">
                                            </span>
                                            <div class="flex-auto">
                                                <label class="flex items-center">
                                                  
                                                    <span class="block font-medium">
                                                        {{ $document }}
                                                    </span>
                                                </label>
                                                <span
                                                    class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">
                                                  
                                                </span>
                                            </div>
                                            <div class="ms-auto">
                                                <button class="ti-btn ti-btn-sm ti-btn-iconx ti-btn-soft-info btn-wave"
                                                    data-hs-overlay="#upload-document"
                                                    onclick="upload_file('{{ $document }}')"><i
                                                        class="ri-upload-line"></i>
                                                    <span>Upload</span></button>
                                              
                                            </div>
                                        </div>

                                        @php
                                            $documents = App\Models\Document::where('document_name', $document)->get();
                                        @endphp
                                        @foreach ($documents as $files)
                                    <li class="ti-list-group-item">
                                        <div class="flex items-center flex-wrap gap-2">
                                            <span class="avatar avatar-md avatar-rounded p-2 bg-light leading-none">
                                                <img src="/assets/images/media/file-manager/attached.png"
                                                    alt="">
                                            </span>
                                            <div class="flex-auto">
                                                <label class="flex items-center">
                                                   
                                                    <span class="block font-medium">
                                                        <a href="{{ asset('storage/' . $files->file_path) }}"
                                                            target="_blank">{{ date_format($files->created_at, 'D, M. d, Y - h:i A') }}</a>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="ms-auto">
                                                <button onclick="remove_data({{ $files->id }}, 'file')"
                                                    class="ti-btn ti-btn-sm ti-btn-iconx ti-btn-soft-danger btn-wave">
                                                    <i class="ri-delete-bin-line"></i>
                                                    <span>Delete &nbsp;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                </li>
                            @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> --}}
    </div>
    <!--End::row-1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <div id="upload-document" class="hs-overlay hidden ti-modal">
        <div
            class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="max-h-full w-full overflow-hidden ti-modal-content">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semiboldmodal-title">
                        Upload Documents (<b id="docs_name"></b>)
                    </h6>
                </div>
                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="ti-modal-body overflow-y-auto">
                        <div class="grid grid-cols-12 gap-x-6 gap-y-3">
                            <div class="xl:col-span-12 col-span-12">
                                <input type="hidden" class="form-control" name="document_name" id="document_name"
                                    placeholder="Enter Document Name" required>
                            </div>

                            <div class="xl:col-span-12 col-span-12">
                                <input type="file"
                                    class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/50 file:border-0 file:bg-light file:me-4 file:py-3 file:px-4 dark:file:bg-black/20 dark:file:text-white/50 mb-3"
                                    name="document_file" id="document_file" required
                                    accept=".pdf,.doc,.docx,.jpg,.png">
                                <span class="text-md mt-3 text-textmuted dark:text-textmuted/50">Allowed types:
                                    PDF,
                                    DOC,
                                    DOCX, JPG, PNG | Max Size: 50MB</span>
                                <p id="file-size-display" class="text-sm text-gray-600 mt-1"></p>
                            </div>
                        </div>
                    </div>
                    <div class="ti-modal-footer">
                        <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-soft-secondary"
                            data-hs-overlay="#upload-document">
                            Cancel
                        </button>
                        <button type="submit" class="ti-btn ti-btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function upload_file(docs) {
            document.getElementById('document_name').value = docs
            document.getElementById('docs_name').innerHTML = docs
        }
        document.getElementById('document_file').addEventListener('change', function() {
            let file = this.files[0];
            if (file) {
                let fileSize = (file.size / 1024).toFixed(2); // Convert to KB
                document.getElementById('file-size-display').innerText = `File Size: ${fileSize} KB`;
            }
        });
    </script>


    <script src="./assets/js/switch.js"></script>
    <script src="./assets/libs/@popperjs/core/umd/popper.min.js"></script>
    <script src="./assets/libs/preline/preline.js"></script>
    <script src="./assets/js/defaultmenu.min.js"></script>
    <script src="./assets/libs/node-waves/waves.min.js"></script>
    <script src="./assets/js/sticky.js"></script>
    <script src="./assets/libs/simplebar/simplebar.min.js"></script>
    <script src="./assets/js/simplebar.js"></script>
    <script src="./assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>
    <script src="./assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
    <script src="./assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="./assets/js/custom-switcher.min.js"></script>
    <script src="./assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="./assets/js/crm-leads.js"></script>
    <script src="./assets/js/custom.js"></script>

</x-app-layout>
