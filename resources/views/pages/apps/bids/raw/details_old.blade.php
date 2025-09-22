@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    @php
        $project = App\Models\Project::where('id', $id)->first();
    @endphp
    <x-slot name="title">Project Information</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Available Bidding"}</x-slot>
    <x-slot name="active">{{ $project->name }}</x-slot>

    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-8 col-span-12">
            <div class="box">
                <div class="box-body" style="">

                    <div class="flex items-center mb-4 gap-2 flex-wrap">
                        <img src="/assets/images/company-logos/panther.png" style="height: 55px" alt="">
                        <div class="mx-3">
                            <h6 class="font-medium mb-2 task-title">
                                Plan Panthers
                            </h6>
                            <span class="text-textmuted dark:text-textmuted/50 text-xs">
                                Status
                                <i class="ri-circle-fill text-warning mx-2 text-[0.5625rem]"></i>
                            </span>
                            <span class="badge bg-warning/10 text-warning">Pending</span>

                        </div>

                        <div class="ms-auto align-self-start">
                            <div class="ti-dropdown hs-dropdown">
                                <a aria-label="anchor" href="javascript:void(0);"
                                    class="ti-btn ti-btn-icon ti-btn-sm ti-btn-soft-primary ti-dropdown-toggle hs-dropdown-toggle">
                                    <i class="fe fe-more-vertical"></i>
                                </a>
                                <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
                                    {{-- <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                class="ri-eye-line align-middle me-1 inline-block"></i>View</a>
                                    </li> --}}
                                    <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                class="ri-edit-line align-middle me-1 inline-block"></i>Edit Bidding</a>
                                    </li>
                                    <li><a class="ti-dropdown-item" href="javascript:void(0);"><i
                                                class="ri-delete-bin-line me-1 align-middle inline-block"></i>Move to
                                            Trash</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <h3 class="px-5">{{ $project->name }}</h3>
                    <hr class="mt-3 ">



                    @php
                        // Extract content inside <div class="ql-clipboard">
                        preg_match('/<div class="ql-clipboard"[^>]*>(.*?)<\/div>/s', $project->description, $matches);
                    @endphp

                    <style>
                        .project-description p {
                            font-size: 16px;
                        }

                        .project-description ul {
                            list-style-type: disc;
                            /* Ensures bullets are visible */
                            padding-left: 40px !important;
                            /* Indents list for proper alignment */
                            margin-top: 5px;
                            margin-bottom: 10px;
                        }

                        .project-description li {
                            font-size: 16px;
                            /* Adjusts text size */
                            line-height: 1.5;
                            /* Improves readability */
                            color: #333;
                            /* Sets a dark gray text color */
                            margin-bottom: 5px;
                            /* Adds spacing between list items */
                        }

                        /* Optional: Custom bullet styling */
                        .project-description ul li::marker {
                            color: #007bff;
                            /* Blue bullet points */
                            font-size: 18px;
                        }
                    </style>

                    <div class="project-description p-5">
                        {!! $matches[1] ?? '' !!} {{-- Render the extracted content --}}
                    </div>
                </div>
                <div class="box-footer">
                    <div class="flex items-center justify-between gap-2 flex-wrap">
                        <div class="flex gap-4 items-center"> <span class="text-xs">Virtual Assistant :</span>
                            <div class="avatar-list-stacked -space-x-3">
                                @php
                                    $project = App\Models\Project::where('id', $id)->first();

                                    $teamMembers = json_decode($project->assigned_team_members, true); // true to get an array
                                @endphp
                                @foreach ($teamMembers as $va)
                                    @php
                                        $VAs_raw = App\Models\VirtualAssistant::where('id', $va)->first();

                                        $VAs = App\Models\VirtualAssistant::where('company_id', $VAs_raw->company_id)
                                            ->where('id', $va)
                                            ->first();
                                        $user = App\Models\User::where('company', $VAs_raw->company_id)
                                            ->where('email', $VAs->email)
                                            ->first();
                                    @endphp
                                    <div class="hs-tooltip ti-main-tooltip">
                                        <a href="/chat/{{ $user->id }}">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                    onerror="this.src='/user.png'" alt="img">
                                                <span
                                                    class="hs-tooltip-content  ti-main-tooltip-content py-1 px-2 !bg-primary !text-xs !font-medium !text-white shadow-sm "
                                                    role="tooltip"
                                                    style="position: fixed; inset: auto auto 0px 0px; margin: 0px; transform: translate(365px, -131px);"
                                                    data-popper-placement="top">
                                                    {{ $VAs->first_name }} {{ $VAs->last_name }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="box justify-between">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Discussions
                    </div>
                </div>
                <div class="box-body overflow-y-auto" id="discussion-container" style="max-height: 630px">
                    <ul class="list-none profile-timeline">
                        <div id="discussion-list">
                            @php
                                $discussions = App\Models\Discussion::orderBy('id', 'ASC')->get();
                            @endphp
                            @foreach ($discussions as $discussion)
                                <li>
                                    <div>
                                        <span
                                            class="avatar avatar-sm shadow-sm bg-light avatar-rounded profile-timeline-avatar">
                                            <img src="{{ $discussion->avatar }}" alt="{{ $discussion->username }}">
                                        </span>
                                        <div class="mb-2 flex items-start gap-2">
                                            <div>
                                                <span class="font-medium">{{ $discussion->username }}</span>
                                            </div>
                                            <span class="ms-auto bg-light text-textmuted dark:text-textmuted/50 badge">
                                                {{ $discussion->created_at->format('D, F d, Y - h:i A') }}
                                            </span>
                                        </div>
                                        <p class="text-textmuted dark:text-textmuted/50 mb-0">
                                            {{ $discussion->message }}
                                        </p>

                                        @if ($discussion->file_path)
                                            <p>
                                                <a href="{{ asset('storage/' . $discussion->file_path) }}"
                                                    target="_blank" class="text-blue-500">
                                                    {{ $discussion->file_type == 'jpg' || $discussion->file_type == 'png' ? 'View Image' : 'Download File' }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>

                @auth
                    <div class="box-footer">
                        <form id="discussion-form" enctype="multipart/form-data" autocapitalize="off">
                            @csrf
                            <div class="sm:flex items-center leading-none">
                                <div class="sm:me-2 mb-2 sm:mb-0 p-1 rounded-full bg-light/10 inline-block">
                                    <img src="{{ Auth::user()->avatar ?? '/user.png' }}" alt="User"
                                        class="avatar avatar-sm avatar-rounded">
                                </div>
                                <div class="flex-auto">
                                    <div class="input-group flex-nowrap">
                                        <input type="text" name="message" id="message-input" required
                                            class="form-control w-sm-50 border !border-s border-defaultborder dark:border-defaultborder/10 shadow-none"
                                            placeholder="Share your thoughts">

                                        <button type="button"
                                            class="ti-btn ti-btn-soft-primary !m-0 btn-wave waves-effect waves-light"
                                            onclick="document.getElementById('file-input').click();">
                                            <i class="bi bi-paperclip"></i>
                                            <span>Attach</span>
                                        </button>

                                        <!-- Hidden File Input -->
                                        <input type="file" name="file" id="file-input" class="hidden"
                                            accept="image/*,.pdf,.docx">

                                        <button type="submit"
                                            class="ti-btn bg-primary !m-0 text-white btn-wave waves-effect waves-light text-nowrap">
                                            Post
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Container to Update -->


                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            function scrollToBottom() {
                                var container = document.getElementById("discussion-container");
                                container.scrollTop = container.scrollHeight;
                            }

                            // Scroll to bottom on page load
                            document.addEventListener("DOMContentLoaded", scrollToBottom);

                            $(document).ready(function() {
                                $("#discussion-form").submit(function(e) {
                                    e.preventDefault(); // Prevent default form submission

                                    let formData = new FormData(this);

                                    $.ajax({
                                        url: "{{ route('discussions.store') }}", // Laravel route
                                        type: "POST",
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        headers: {
                                            'X-CSRF-TOKEN': $('input[name="_token"]').val() // CSRF protection
                                        },
                                        success: function(response) {
                                            //$("#discussion-list").html(response);
                                            $("#discussion-list").append(response.html);
                                            $("#message-input").val("");
                                            $("#file-input").val("");
                                            scrollToBottom();
                                        },
                                        error: function(xhr) {
                                            alert("Something went wrong! Please try again.");
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                @endauth
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


            {{-- <div class="box justify-between">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Discussions
                    </div>
                </div>
                <div class="box-body">
                    <ul class="list-none profile-timeline">
                        <!-- Agent Welcomes You -->
                        <li>
                            <div>
                                <span
                                    class="avatar avatar-sm shadow-sm bg-light avatar-rounded profile-timeline-avatar">
                                    <img src="/assets/images/faces/5.jpg" alt="Agent">
                                </span>
                                <div class="mb-2 flex items-start gap-2">
                                    <div>
                                        <span class="font-medium">Agent Smith</span>
                                    </div>
                                    <span class="ms-auto bg-light text-textmuted dark:text-textmuted/50 badge">
                                        {{ date('D, F d, Y - h:i A') }}
                                    </span>
                                </div>
                                <p class="text-textmuted dark:text-textmuted/50 mb-0">
                                    We are thrilled to have you participate in this competitive bidding opportunity.
                                    Your expertise and commitment to excellence are highly valued, and we look forward
                                    to reviewing your proposal. Before you proceed, please take a moment to carefully
                                    review the bidding guidelines, eligibility requirements, and submission criteria to
                                    ensure your compliance with the project specifications. This process is designed to
                                    be transparent, fair, and competitive, ensuring that the best-suited contractor is
                                    selected for the project.
                                </p>
                            </div>
                        </li>

                        <!-- You Responding -->
                        <li>
                            <div>
                                <span
                                    class="avatar avatar-sm shadow-sm bg-light avatar-rounded profile-timeline-avatar">
                                    <img src="/user.png" alt="You">
                                </span>
                                <div class="mb-2 flex items-start gap-2">
                                    <div>
                                        <span class="font-medium">You</span>
                                    </div>
                                    <span class="ms-auto bg-light text-textmuted dark:text-textmuted/50 badge">
                                        15, Jun 2024 - 06:18
                                    </span>
                                </div>
                                <p class="text-textmuted dark:text-textmuted/50 mb-0">
                                    Thank you! I’m looking forward to participating. Could you provide an overview of
                                    the key project details and timelines?
                                </p>
                            </div>
                        </li>
                    </ul>

                </div>
                <div class="box-footer">
                    <div class="sm:flex items-center leading-none">
                        <div class="sm:me-2 mb-2 sm:mb-0 p-1 rounded-full bg-light/10 inline-block">
                            <img src="/user.png" alt="" class="avatar avatar-sm avatar-rounded">
                        </div>
                        <div class="flex-auto">
                            <div class="input-group flex-nowrap">
                                <input type="text"
                                    class="form-control w-sm-50 border !border-s border-defaultborder dark:border-defaultborder/10 shadow-none"
                                    placeholder="Share your thoughts"
                                    aria-label="Recipient's username with two button addons">
                                <button class="ti-btn ti-btn-soft-primary !m-0 btn-wave waves-effect waves-light"
                                    type="button"><i class="bi bi-emoji-smile"></i></button>
                                <button class="ti-btn ti-btn-soft-primary !m-0 btn-wave waves-effect waves-light"
                                    type="button"><i class="bi bi-paperclip"></i></button>
                                <button class="ti-btn ti-btn-soft-primary !m-0 btn-wave waves-effect waves-light"
                                    type="button"><i class="bi bi-camera"></i></button>
                                <button
                                    class="ti-btn bg-primary !m-0 text-white btn-wave waves-effect waves-light text-nowrap"
                                    type="button">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="xxl:col-span-4 col-span-12">

            <div class="box overflow-hidden">
                {{-- <div class="box-header justify-between">
                    <div class="box-title">
                        Documents
                    </div>
                </div> --}}
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
                                {{-- <li>
                                <div class="flex">
                                    <div class="flex flex-auto items-center">
                                        <div class="me-2"> <span class="avatar avatar-md avatar-rounded"> <img
                                                    src="{{ asset('storage/' . $gc->profile_photo_path )}}" onerror="this.src='/user.png'" alt=""> </span> </div>
                                        <span class="block font-medium">{{ $gc->name }}</span> <span
                                                class="text-textmuted dark:text-textmuted/50">M.Tech</span> </div>
                                    </div>
                                    <div class="text-end ms-auto"> <span class="block font-medium">321 Classes</span>
                                        <span class="text-textmuted dark:text-textmuted/50">Digital Marketing</span>
                                    </div>
                                </div>
                            </li>  --}}
                            @endforeach

                        </ul>
                    </div>
                    <br>
                </div>
            </div>


            <div class="xxl:col-span-4 col-span-12">

                <div class="box overflow-hidden">
                    {{-- <div class="box-header justify-between">
                    <div class="box-title">
                        Documents
                    </div>
                </div> --}}
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
                                                    {{-- <input type="checkbox" class="mr-2"> --}}
                                                    <span class="block font-medium">
                                                        {{ $document }}
                                                    </span>
                                                </label>
                                                <span
                                                    class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">
                                                    {{-- Last Updated ({{ rand(1, 12) }} Month(s) Ago) --}}
                                                </span>
                                            </div>
                                            <div class="ms-auto">
                                                <button class="ti-btn ti-btn-sm ti-btn-iconx ti-btn-soft-info btn-wave"
                                                    data-hs-overlay="#upload-document"
                                                    onclick="upload_file('{{ $document }}')"><i
                                                        class="ri-upload-line"></i>
                                                    <span>Upload</span></button>
                                                {{-- <button class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger btn-wave"><i
                                                    class="ri-delete-bin-line"></i></button> --}}
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
                                                    {{-- <input type="checkbox" class="mr-2"> --}}
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
                                    <input type="hidden" class="form-control" name="document_name"
                                        id="document_name" placeholder="Enter Document Name" required>
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


        @include('pages.clients.forms.credits')
        <script>
            function credit_type(type) {
                document.getElementById('type').value = type;
                document.getElementById('client_type').value = 'client';
            }
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
