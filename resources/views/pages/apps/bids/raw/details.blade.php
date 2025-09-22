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
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Bidding"}</x-slot>
    <x-slot name="url_3">{"link": "/bid/details/{{$id}}", "text": "Details"}</x-slot>
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
                    <div class="text-[15px] font-medium mb-2">Project Description :</div>
                    <p class="text-textmuted dark:text-textmuted/50 mb-4">The Customer Feedback Dashboard Development
                        project aims to create a comprehensive dashboard that aggregates and visualizes customer
                        feedback data. This will enable our team to gain actionable insights and improve customer
                        satisfaction.</p>
                    <div class="flex gap-5 mb-4 flex-wrap">
                        <div class="flex items-center gap-2 me-3"> <span
                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint1color/10 !text-primarytint1color"><i
                                    class="ri-calendar-event-line text-lg leading-none align-middle"></i></span>
                            <div>
                                <div class="font-medium mb-0 task-title"> Date Uploaded</div> <span
                                    class="text-xs text-textmuted dark:text-textmuted/50">28 August, 2024</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 me-3"> <span
                                class="avatar avatar-md avatar-rounded me-1 bg-primarytint2color/10 !text-primarytint2color"><i
                                    class="ri-time-line text-lg leading-none align-middle"></i></span>
                            <div>
                                <div class="font-medium mb-0 task-title"> Due Date </div> <span
                                    class="text-xs text-textmuted dark:text-textmuted/50">30 Oct, 2024</span>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3 mb-3">
                    <div class="mb-4">
                        <div class="grid grid-cols-12 sm:gap-x-6">
                            <div class="xl:col-span-6 col-span-12">
                                <div class="text-[15px] font-medium mb-2">Scopes :</div>
                                <ul class="task-details-key-tasks mb-0 ps-8">
                                    @php
                                        $stage_descriptions = $project->stage_descriptions;
                                        $invite_clients = $project->invite_clients;
                                    @endphp
                                    @foreach ($stage_descriptions as $stage => $description)
                                        <li>{{ $stage }} : {{ $description }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="xl:col-span-6 col-span-12">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-[15px] font-medium">Documents :</div>
                                </div>
                                <ul class="ti-list-group">
                                    @php
                                        $docs = $project->proj_documents ;
                                    @endphp
                                    @foreach ($docs as $doc)
                                        <li class="ti-list-group-item">
                                            <div class="flex items-center">
                                                <div class="me-2"><i
                                                        class="ri-link text-[15px] text-secondary leading-none p-1 bg-secondary/10 rounded-full"></i>
                                                </div>
                                                <div class="font-medium">
                                                    <a href="{{ asset('storage/' . $doc) }}" target="_blank"
                                                        rel="noopener noreferrer">{{ substr($doc, 10) }}</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($stage_descriptions as $stage => $description)
                <div class="box justify-between">
                    <div class="box-header justify-between">
                        <div class="box-title p-5 pb-0 pt-2">
                            <h3><strong>{{ $stage }}</strong></h3>
                            {{ $description }}
                        </div>
                    </div>
                    <div class="box-body overflow-y-auto" id="discussion-container" style="max-height: 630px">
                        <hr>
                        <ul class="ti-list-group list-group-flush !rounded-none">
                            @if (isset($invite_clients[$stage]) && is_array($invite_clients[$stage]))
                                @foreach ($invite_clients[$stage] as $email)
                                @php
                                    $user = App\Models\User::where('email', $email)->first();
                                @endphp
                                    <li class="ti-list-group-item">
                                        <div class="flex items-center flex-wrap gap-2">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded">
                                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}g" onerror="this.src='/user.png'" alt="">
                                                </span>
                                            </div>
                                            <div class="flex-auto"> <a href="javascript:void(0);"><span
                                                        class="block font-medium">{{ $user->name }}</span></a> <span
                                                    class="block text-textmuted dark:text-textmuted/50 text-xs font-normal">
                                                    <span class="badge bg-warning/10 text-warning">Invited</span>
                                                    <i class="ri-circle-fill text-warning mx-2 text-[0.5625rem]"></i>
                                                    {{ $email }}
                                                </span>
                                            </div>
                                            <div class="ms-auto">
                                                

                                                <a href="/chat/{{ $user->id }}" class="header-link hs-dropdown-toggle ti-dropdown-toggle border border-gray-50">
                                                    <i class="bi bi-chat header-link text-lg"></i>
                                                    {{-- <span class=" translate-middle  badge !rounded-full bg-danger">3</span> --}}
                                                </a>
                                                
                                                <a href="javascript:void(0);" class="header-link hs-dropdown-toggle ti-dropdown-toggle border border-gray-50">
                                                    <i class="bi bi-person-circle header-link text-lg p-0"></i>
                                                </a>

                                                {{-- <button aria-label="button" type="button"
                                                    class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-info btn-wave waves-effect waves-light"><i
                                                        class="ri-edit-line"></i></button> <button aria-label="button"
                                                    type="button"
                                                    class="ti-btn ti-btn-sm ti-btn-icon ti-btn-soft-danger btn-wave waves-effect waves-light"><i
                                                        class="ri-delete-bin-line"></i></button>  --}}
                                                    </div>
                                        </div>
                                    </li>
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
                                $gcs = App\Models\Contact::whereIn('id', $bidders)->get();
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
                                            <div> <span class="block font-medium">{{ $gc->company_name }}</span> <span
                                                    class="text-textmuted dark:text-textmuted/50">{{ $gc->type }}</span>
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
