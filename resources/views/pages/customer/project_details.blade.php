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

        $status = App\Models\Invite::where('project_id', $id)
            ->where('email', Auth::user()->email)
            ->first();

    @endphp

    <x-slot name="title">{{ $project->proj_name }}</x-slot>
    <x-slot name="url_1">{"link": "/bid/projects", "text": "My Projects"}</x-slot>
    <x-slot name="active">Details</x-slot>
    <x-slot name="buttons">

    </x-slot>

    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-7 xl:col-span-6 xxl:col-span-12">
            <div class="box">
                <div class="box-body" style="">

                    <div class="flex items-center mb-4 gap-2 flex-wrap">
                        <span class="avatar avatar-lg me-1 bg-gradient-to-br from-primary to-secondary"><i
                                class="ri-stack-line text-2xl leading-none"></i></span>
                        <div class="mx-3">
                            <h6 class="font-medium mb-2 task-title">
                                {{ $project->proj_name }}
                            </h6>
                            <span class="text-textmuted dark:text-textmuted/50 text-xs">
                                <i class="ri-circle-fill text-info text-[0.5625rem]"></i>
                                <span
                                    class="mx-2">{{ formatTime($project->created_at) . ' - ' . date_format($project->created_at, 'D, M. d, Y h:i A') }}</span>
                            </span>
                        </div>
                        <div class="ms-auto align-self-start">

                            @php
                                // Set the badge status, defaulting to 'Invited' if status is null
                                $badgeStatus = $status && $status->status !== null ? $status->status : 'Invited';

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
                                        $badgeColor = 'light'; // Default color if status is unknown or null
                                        break;
                                }

                                // Set selected attribute if the status matches certain conditions
                                $status_partial = in_array($status->status, ['Accepted', null]) ? 'selected' : '';
                            @endphp
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="xxl:col-span-8 col-span-12">
                        <div class="mb-6 border border-gray-200 rounded-lg bg-white">
                            <div class="box-body p-6">
                                <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                                    <i class="bi bi-hammer text-yellow-500"></i>Project Details
                                </h2>

                                <table
                                    class="ti-custom-table ti-custom-table-head !border  border-defaultborder dark:border-defaultborder/10">
                                    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                        <td width="180"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Project Code :
                                        </td>
                                        <td colspan="3"
                                            class="border-2 border-defaultborder dark:border-defaultborder/10 font-bold">
                                            <i class="bi bi-hash mx-2"></i><b>{{ $project->proj_code }}</b>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                        <td width="180"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Project Name :
                                        </td>
                                        <td colspan="3"
                                            class="border-2 border-defaultborder dark:border-defaultborder/10 font-bold">
                                            <i class="bi bi-hammer mx-2"></i> {{ $project->proj_name }}
                                        </td>
                                    </tr>
                                    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                        <td width="180"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Project Stage :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-circle-square mx-2"></i> {{ $project->proj_stages }}
                                        </td>
                                        <td width="100"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Project Type :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-cone-striped mx-2"></i> {{ $project->proj_status }}
                                        </td>
                                    </tr>
                                    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                        <td width="180"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Due Date :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-calendar-event mx-2"></i>
                                            {{ date_format(date_create($project->proj_due_date), 'D, M. d Y') }}
                                        </td>
                                        <td width="100"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Walkthrogh Date :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-calendar-week mx-2"></i>
                                            {{ date_format(date_create($project->proj_walkthrough_date), 'D, M. d Y') }}
                                        </td>
                                    </tr>
                                    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                        <td width="180"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Site Address :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-pin-map mx-2"></i> {{ $project->proj_address }}
                                        </td>
                                        <td width="100"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            City :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-pin-map mx-2"></i> {{ $project->proj_city }}
                                        </td>
                                    </tr>
                                    <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                                        <td width="180"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            State :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-pin-map mx-2"></i> {{ $project->proj_state }}
                                        </td>
                                        <td width="100"
                                            class="text-end border-2 border-defaultborder dark:border-defaultborder/10">
                                            Zip Code :
                                        </td>
                                        <td class="border-2 border-defaultborder dark:border-defaultborder/10">
                                            <i class="bi bi-pin-map mx-2"></i> {{ $project->proj_zip }}
                                        </td>
                                    </tr>
                                </table>
                                {{-- <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <thead class="bg-gray-100 text-gray-700 text-sm">
                                            <tr>
                                                <th class="px-4 py-2 text-left">Title</th>
                                                <th class="px-4 py-2 text-left">Notes</th>
                                                <th class="px-4 py-2 text-left">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-t hover:bg-gray-50 transition">
                                                <td class="px-4 py-2 font-medium text-gray-800">
                                                    -
                                                </td>
                                                <td class="px-4 py-2 font-medium text-gray-800">
                                                    -
                                                </td>
                                                <td class="px-4 py-2 text-xs text-gray-500">
                                                    1 week ago</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5 mb-4 flex-wrap">
                        <div class="flex items-center gap-2 me-3"> <span
                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint1color/10 !text-primarytint1color"><i
                                    class="ri-calendar-event-line text-lg leading-none align-middle"></i></span>
                            <div>
                                <div class="font-medium mb-0 task-title"> Date Uploaded</div> <span
                                    class="text-xs text-textmuted dark:text-textmuted/50">
                                    {{ date_format(date_create($project->created_at), 'D, d F, Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 me-3"> <span
                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint2color/10 !text-primarytint2color"><i
                                    class="ri-time-line text-lg leading-none align-middle"></i></span>
                            <div>
                                <div class="font-medium mb-0 task-title"> Due Date </div> <span
                                    class="text-xs text-textmuted dark:text-textmuted/50">
                                    {{ date_format(date_create($project->proj_due_date), 'D, d F, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="mb-4">
                        <div class="grid grid-cols-12 sm:gap-x-6">
                            <div class="xl:col-span-8 col-span-8">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-[15px] font-medium">Documents :</div>
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
                            @php
                                $stage_descriptions = $project->stage_descriptions;
                                $invite_clients = $project->invite_clients;
                            @endphp
                            <div class="xl:col-span-4 col-span-4">
                                <div class="text-[15px] font-medium mb-2">Scopes :</div>
                                <ul class="task-details-key-tasks mb-0 ps-8">
                                    @php
                                        $stage_descriptions = $project->stage_descriptions;
                                        $invite_clients = $project->invite_clients;
                                    @endphp
                                    @foreach ($stage_descriptions as $stage => $description)
                                        <li>{{ str_replace('_', ' ', $stage) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-span-12 sm:col-span-12 md:col-span-10 lg:col-span-8 xl:col-span-6 xxl:col-span-8">
            <script>
                window.savedDocs = @json($project->stage_proj_documents ?? []);

                window.addEventListener('DOMContentLoaded', function() {
                    if (typeof savedDocs === 'object') {
                        for (const [stageKey, documents] of Object.entries(savedDocs)) {
                            const tableBodyId = `document-table-body-${stageKey}`;
                            const tableBody = document.getElementById(tableBodyId);

                            if (!tableBody) continue;

                            tableBody.innerHTML = documents.map((doc, index) => `
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="px-4 py-2 font-medium text-gray-800">${index + 1}</td>
                        <td class="px-4 py-2 font-medium text-gray-800">
                            ${doc.name ?? doc.path.split('/').pop()}
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-800 text-center">
                            <a href="/file-manager/preview/${doc.google_drive_id}" class="btn btn-sm btn-primary" target="_blank">
                                View
                            </a>
                        </td>
                    </tr>
                `).join('');
                        }
                    }
                });
            </script>

            <link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
            <link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
            <script src="/assets/libs/quill/quill.js"></script>

            <style>
                .ql-container.ql-snow.ql-disabled {
                    border: none !important;
                    width: 100% !important;
                    padding: 0 !important;
                    background: transparent !important;
                }

                .ql-editor {
                    padding: 0 !important;
                }
            </style>

            @foreach ($stage_descriptions as $stage => $description)
                @php
                    $check = App\Models\Invite::where('project_id', $id)
                        ->where('email', Auth::user()->email)
                        ->where('category', str_replace('_', ' ', $stage))
                        ->whereIn('status', [
                            'Bidding',
                            'Proposal Sent',
                            'Negotiating',
                            'Closed Won',
                            'Closed Lost',
                            'Time Out',
                        ])
                        ->first();
                @endphp
                @if ($check)
                    <div class="box justify-between">
                        <div class="box-header justify-between">
                            <div class="box-title p-5 pb-0 pt-2 w-full">
                                <h3>
                                    <strong>
                                        {{ str_replace('_', ' ', $stage) }}
                                    </strong>
                                </h3>
                                <hr class="mt-3 mb-3">
                               <div class="prose custom-description"
                                style="border: none !important; width: 100% !important;">
                                <div id="{{ $stage }}" class="">
                                    {!! $description !!}</div>
                                <script>
                                    const quill = new Quill(`#{{ $stage }}`, {
                                        theme: "snow",
                                        readOnly: true, // disables editing
                                        modules: {
                                            toolbar: false // disables (hides) the ribbon
                                        }
                                    });
                                </script>
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

                        </div>
                        <div class="box-body overflow-y-auto" id="discussion-container" style="max-height: 630px">

                            <hr class="mb-3">

                            <div class="overflow-x-auto mt-3">
                                <table
                                    class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm table-bordered">
                                    <thead class="bg-gray-100 text-gray-700 text-sm">
                                        <tr>
                                            <th width="10" class="px-4 py-2 text-left">#</th>
                                            <th class="px-4 py-2 text-left">File Name</th>
                                            <th width="100" class="px-4 py-2 text-left">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="document-table-body-{{ $stage }}">
                                        <!-- Documents will be dynamically inserted here -->
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="mb-3 mt-3 border border-gray-200 rounded-lg bg-white">
                                <div class="box-body p-6">


                                    <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                                        <i class="bi bi-stickies text-yellow-500"></i>Notes
                                    </h2>

                                </div>
                            </div> --}}

                            <br>

                            <ul class="ti-list-group list-group-flush !rounded-none">
                                @php
                                    $stageKey = str_replace('_', ' ', $stage);
                                @endphp

                                @if (isset($invite_clients[$stageKey]) && is_array($invite_clients[$stageKey]))
                                    @foreach ($invite_clients[$stageKey] as $email)
                                        @if ($email == Auth::user()->email)
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
                                                        <div class="flex-auto">
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
                                                                            $badgeColor = 'light'; // Default color if status is unknown or null
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

                                                                <i
                                                                    class="ri-circle-fill text-{{ $badgeColor }} mx-2 text-[0.5625rem]"></i>
                                                                <span
                                                                    class="badge bg-{{ $badgeColor }}/10 mt-1 text-[12px] p-2 text-{{ $badgeColor }}">
                                                                    <i>{{ $badgeStatus }}</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <div class="ms-auto inline-flex gap-2">

                                                            <select name="" id="status-select"
                                                                class="ti-form-select"
                                                                onchange="change_status({{ $status->id ?? null }}, this.value)">
                                                                <option value="" disabled selected>- Select Stage
                                                                    -
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
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    No clients invited.
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach

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
                $invited = App\Models\Invite::where('email', Auth::user()->email)
                    ->where('category', $stage)
                    ->where('project_id', $id)
                    ->count();
            @endphp


            @php
                $parent_id = $_GET['f'] ?? null;
                $files = App\Models\FileManager::where('parent_id', $parent_id)
                    ->where('user_id', Auth::user()->id)
                    ->get();
                $parent = $parent_id ? App\Models\FileManager::findOrFail($parent_id) : null;
            @endphp


            <!-- Emoji Script -->
            <script>
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
        <div class="col-span-12 sm:col-span-12 md:col-span-10 lg:col-span-8 xl:col-span-6 xxl:col-span-4">

            {{-- <div class="box main-dashboard-banner project-dashboard-banner overflow-hidden shadow">
                <div class="box-body p-[1.5rem]">
                    <div class="grid grid-cols-12 gap-x-6 justify-between">
                        <div
                            class="xxl:col-span-8 xl:col-span-5 lg:col-span-5 md:col-span-5 sm:col-span-5 col-span-12">
                            <h4 class="mb-1 font-medium text-white">Assistance ?</h4>
                            <p class="mb-3 text-white opacity-70">Looking for Support ? Chat with our
                                Us now!</p>
                            <a href="/chat/2" class="ti-btn ti-btn-sm bg-primarytint1color text-white">Chat with Us<i
                                    class="ti ti-arrow-narrow-right"></i></a>
                        </div>
                        <div
                            class="xxl:col-span-4 xl:col-span-7 lg:col-span-7 md:col-span-7 sm:col-span-7 col-span-12 sm:block hidden text-end my-auto">
                            <img src="/assets/images/media/media-85.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div> --}}



            @foreach ($stage_descriptions as $stage => $description)
                @if ($invited != 0)
                    <div class="box justify-between">
                        <div class="box-header justify-between">
                            <div class="box-title p-5 pb-0 pt-2">
                                <h4><strong>📌 {{ $stage }}</strong></h4>
                            </div>
                        </div>
                        <hr class="w-full ">
                        <div class="box-header justify-between">
                            <div class="box-title p-5 pb-0 pt-0">
                                {!! $description !!}
                            </div>
                        </div>
                        <div class="box-body overflow-y-auto" id="discussion-container" style="max-height: 630px">
                        </div>
                    </div>
                @endif
            @endforeach


            <div class="box overflow-hidden">
                <div class="box-body p-0">
                    <ul class="ti-list-group list-group-flush !rounded-none">
                        <li class="ti-list-group-item bg-light text-dark font-semibold text-lg py-2 px-3">
                            General Contractors (Bidders)
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
                                    ->select(
                                        't_contacts.*',
                                        't_contact_person.email as email',
                                        't_contact_person.first_name as first_name',
                                        't_contact_person.last_name as last_name',
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
        <div class="col-span-12 sm:col-span-12 md:col-span-10 lg:col-span-8 xl:col-span-6 xxl:col-span-12">


            <div class="box justify-between">

                <div class="box-header">
                    <div class="box-title p-5 pb-0 pt-2">
                        <h3 class="mx-3"><strong>File Manager</strong></h3>
                    </div>
                    &ensp;
                    &ensp;
                    <button class="ti-btn ti-btn-light text-dark bg-white border-1 btn-wave me-0"
                        style="border-color: #eee" data-hs-overlay="#create-folder">
                        <i class="bi bi-folder-plus align-middle"></i>Create Folder
                    </button>
                    &ensp;
                    <button class="ti-btn ti-btn-light text-dark bg-white border-1 btn-wave me-0"
                        style="border-color: #eee" data-hs-overlay="#create-file">
                        <i class="bi bi-upload align-middle"></i>Upload File
                    </button>
                </div>
                <div class="box-body overflow-y-auto" id="discussion-container" style="max-height: 630px">
                    <hr>
                    <div class="file-manager-folders">
                        <div
                            class="flex p-4 flex-wrap gap-6 items-center justify-between border-b border-defaultborder dark:border-defaultborder/10">
                            @include('pages.customer.project_file_header')
                        </div>

                        <div class="p-4 file-folders-container">
                            @php
                                $files = App\Models\FileManager::where('parent_id', $parent_id)
                                    ->where('user_id', auth()->id())
                                    ->get();
                                $parent = $parent_id ? App\Models\FileManager::findOrFail($parent_id) : null;

                                // Generate breadcrumbs
                                $breadcrumbs = [];
                                $current = $parent;
                                while ($current) {
                                    $breadcrumbs[] = $current;
                                    $current = $current->parent; // Traverse up to root
                                }
                                $breadcrumbs = array_reverse($breadcrumbs); // Reverse for correct order
                            @endphp

                            <nav aria-label="breadcrumb mb-3">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/bid/projects/{{ $id }}">
                                            <i class="bi bi-folder px-2"></i>
                                            File Manager
                                        </a>
                                    </li>
                                    @foreach ($breadcrumbs as $crumb)
                                        <li class="breadcrumb-item">
                                            <a
                                                href="/bid/view/{{ $id }}?f={{ $crumb->id }}&{{ md5($crumb->id) }}">{{ $crumb->name }}</a>
                                        </li>
                                    @endforeach
                                </ol>
                            </nav>

                            <div class="grid grid-cols-12 sm:gap-x-6 mb-2 mt-3">
                                @include('pages.customer.project_folders')
                            </div>

                            <div class="grid grid-cols-12 gap-x-6">
                                <div class="xl:col-span-12 col-span-12">
                                    @include('pages.customer.project_files')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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


    @include('pages.members.forms.credits')
    <script>
        function credit_type(type) {
            document.getElementById('type').value = type;
            document.getElementById('client_type').value = 'client';
        }
    </script>



    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops! Something went wrong.</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <hr>
    @endif

    </div>
    <!-- Emoji Script -->
    <script>
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

    @include('pages.filemanager.create_folder')
    @include('pages.filemanager.create_files')

    <br><br>
</x-app-layout>
