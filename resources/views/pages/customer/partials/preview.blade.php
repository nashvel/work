@php
    use Carbon\Carbon;
@endphp
@php
    $project = App\Models\ProjectBidding::where('id', $id)->first();
    function formatTime($timestamp)
    {
        $timestamp = Carbon::parse($timestamp); // Convert string to Carbon instance

        return $timestamp->diffInSeconds(now()) < 60 ? 'Just Now' : $timestamp->diffForHumans();
    }

    $status = App\Models\Invite::where('project_id', $id)
        // ->where('email', Auth::user()->email)
        ->first();

@endphp

<style>
    * {
        background-color: #fff;
    }
</style>

@include('components.nav-link')



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

<!-- Start::row-1 -->
<div class="grid grid-cols-12 gap-x-6">
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 xxl:col-span-12">
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

    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 xxl:col-span-12">
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
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm table-bordered">
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
                </div>
            </div>
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
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 xxl:col-span-12">

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


        <div class="box">
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

    <div class="hs-overlay ti-modal hidden" id="header-responsive-search" tabindex="-1"
        aria-labelledby="header-responsive-search" aria-hidden="true">
        <div class="ti-modal-box">
            <div class="ti-modal-dialog">
                <div class="ti-modal-content">
                    <div class="ti-modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0 !border-s"
                                placeholder="Search Anything ..." aria-label="Search Anything ..."
                                aria-describedby="button-addon2">
                            <button class="ti-btn ti-btn-primary !m-0" type="button" id="button-addon2"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function remove_data(id, type) {
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
                    $.ajax({
                        url: '/delete',
                        type: 'post',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: {
                            id: id,
                            type: type
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your record has been deleted.",
                                icon: "success"
                            });
                            setTimeout(() => {
                                window.location.href = response;
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "There was a problem deleting your record. " + error,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }


        function invitation(id, type) {
            Swal.fire({
                title: "Are you sure you want to " + type + " this?",
                text: "Please note that this action is irreversible.",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Confirmed"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/bid/invitation/update',
                        type: 'post',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: {
                            id: id,
                            type: type
                        },
                        success: function(resp) {
                            //console.log(resp)
                            Swal.fire({
                                title: "Success!",
                                text: "Your record has been " + type,
                                icon: "success"
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "There was a problem your record. " + error,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentURL = window.location.pathname;

            const menuItems = document.querySelectorAll(".side-menu__item");

            menuItems.forEach(item => {
                const href = item.getAttribute("href");

                // Skip invalid links
                if (!href || href === "#" || href.startsWith("javascript")) return;

                // Match full URL or partial (you can tweak this logic)
                if (currentURL === href || currentURL.startsWith(href)) {
                    // Add submenu highlight
                    item.classList.add("active-menu");

                    // If this item is inside a submenu, open its parent
                    const submenu = item.closest("ul.slide-menu");
                    if (submenu) {
                        submenu.style.display = "block";

                        const parentLi = submenu.closest("li.slide.has-sub");
                        if (parentLi) {
                            parentLi.classList.add("open");

                            const parentLink = parentLi.querySelector("> a.side-menu__item");
                            if (parentLink) {
                                parentLink.classList.add("active-parent-menu");
                            }
                        }
                    }
                }
            });
        });
    </script>


    <style>
        /* Initial state of the .custom-box (hidden and shifted down) */
        .custom-box {
            opacity: 0;
            /* Initially hidden */
            transform: translateY(20px);
            /* Initially moved down */
            animation: fadeUp 0.6s ease-out forwards;
            /* Trigger fade-up animation */
        }

        /* Define the fade-up animation */
        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
                /* Starts down */
            }

            100% {
                opacity: 1;
                transform: translateY(0);
                /* Ends at normal position */
            }
        }
    </style>

    <style>
        .active-menu {
            background-color: #EEF0FE !important;
            color: #5C66F6 !important;
            border-radius: 5px;
            padding: 10px 15px 10px 20px;
            margin-right: 5px;
            transition: 0.3s ease;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            position: relative;
        }

        .slide.has-sub .slide-menu .active-menu {
            background-color: #EEF0FE !important;
        }

        .active-parent-menu {
            background-color: #FFBC58 !important;
            color: #5C66F6 !important;
            font-weight: 500;
            border-radius: 5px;
            padding: 10px 15px 10px 20px;
            margin-right: 5px;
            position: relative;
        }

        .active-parent-menu::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 5px;
            background-color: #FFBC58 !important;
            border-radius: 5px 0 0 5px;
        }
    </style>


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Saved Successfully',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
