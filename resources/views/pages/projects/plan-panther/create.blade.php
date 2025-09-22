<x-app-layout>

    <x-slot name="title">Register New Bidding</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Bidding"}</x-slot>
    <x-slot name="active">New Bidding</x-slot>
    <x-slot name="buttons">
        <button type="button" class="hs-overlay-open ti-btn btn-wave ti-btn-primary" data-hs-overlay="#hs-extralarge-modal">
            Open Extra Large Modal
        </button>
    </x-slot>
    
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

    
    
    
    <!-- ✅ Modal Structure -->
    <div id="hs-extralarge-modal" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
            <div class="ti-modal-content">
                
                <!-- 🔹 Modal Header -->
                <div class="ti-modal-header">
                    <h6 class="ti-modal-title">Modal Title</h6>
                    <button type="button" class="ti-modal-close-btn" data-hs-overlay="#hs-extralarge-modal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
    
                <!-- 🔹 Modal Body -->
                <div class="ti-modal-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the client information here.
                        <hr class="mb-3 mt-3">
                        @include('pages.projects.partials.bidders')
                </div>
    
            </div>
        </div>
    </div>

    <form action="{{ route('project-bidding.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @php
            $client_info = App\Models\Lead::where('email', Auth::user()->email)->first();
        @endphp
        <input type="hidden" name="client_id" value="{{ $client_info->id }}">
        <div class="grid grid-cols-12 gap-x-6">
            <div class="xl:col-span-12 col-span-12">
                <div class="box">
                    <div class="box-body">

                        <!-- Display Errors -->
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
                        @endif

                        <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3">

                            <!-- Project Code -->
                            <div class="xl:col-span-6 col-span-12">
                                <label for="proj_code" class="form-label">Project Code:</label>
                                @php
                                    // $base_code = substr(date('Y'), 2, 4);
                                    // $get_project = App\Models\ProjectBidding::where(
                                    //     'proj_code',
                                    //     'LIKE',
                                    //     $base_code . '%',
                                    // )->where('client_id', $client_info->id);
                                    // $def_id = $base_code . sprintf('%04d', 1);
                                    // if ($get_project->count() !== 0) {
                                    //     $gen_id =
                                    //         $get_project
                                    //             ->select('proj_code')
                                    //             ->where('client_id', $client_info->id)
                                    //             ->orderBy('id', 'DESC')
                                    //             ->first()->proj_code + 1;
                                    // } else {
                                    //     $gen_id = $def_id;
                                    // }
                                    $gen_id = 1;
                                @endphp
                                <input type="text" name="proj_code" class="form-control form-control-lg"
                                    style="font-weight: bold !important" id="proj_code" value="{{ $gen_id }}"
                                    required>
                            </div>

                            <!-- Project Name -->
                            <div class="xl:col-span-6 col-span-12">
                                <label for="proj_name" class="form-label">Project Name:</label>
                                <input type="text" name="proj_name" placeholder="Enter Project Name here.."
                                    class="form-control form-control-lg" id="proj_name" required>
                            </div>

                            <!-- Due Date -->
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Due Date:</label>
                                <input type="date" name="proj_due_date" class="form-control form-control-lg"
                                    required>
                            </div>

                            <!-- Project Stages -->
                            <div class="xl:col-span-6 col-span-12">
                                <label class="form-label">Project Stages:</label>
                                <select name="proj_stages" id="proj_stages" class="form-select">
                                    <option value="" disabled selected>-</option>
                                    <option value="Upload">Upload</option>
                                    <option value="Measure">Measure</option>
                                    <option value="Spec'ed">Spec'ed</option>
                                    <option value="PHL">PHL</option>
                                    <option value="Ready">Ready</option>
                                </select>
                            </div>

                            <!-- Bidders -->
                            {{-- <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Bidders:</label>
                                <select class="form-control" name="proj_bidders[]" id="assigned-team-members" multiple>
                                    @foreach (App\Models\Clients::join('t_contacts', 't_contacts.id', 'clients.company_id')->where('t_contacts.client_id', $client_info->id)->limit(5)->get() as $va)
                                        <option value="{{ $va->id }}">{{ $va->first_name }} {{ $va->last_name }} ({{ $va->company_name }})</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Bidders:</label>
                                <select class="form-control" name="proj_bidders[]" id="assigned-team-members"
                                    multiple></select>
                            </div>

                            <script>
                                $(document).ready(function() {


                                    $('#assigned-team-members').select2({
                                        placeholder: "Search for bidders...",
                                        minimumInputLength: 2, // Wait until 2 characters are typed
                                        ajax: {
                                            url: "{{ route('fetch.clients') }}", // Route to get bidders
                                            dataType: "json",
                                            delay: 250, // Delay to reduce server requests
                                            data: function(params) {

                                                return {
                                                    search: params.term
                                                }; // Send search query
                                            },
                                            processResults: function(data) {


                                                return {
                                                    results: data.map(function(bidder) {
                                                        return {
                                                            id: bidder.id,
                                                            text: `${bidder.first_name} ${bidder.last_name} (${bidder.company_name})`
                                                        };
                                                    })
                                                };
                                            },
                                            cache: true
                                        }
                                    });

                                    $('#assigned-team-members').on('select2:select', function(e) {
                                        
                                    });

                                    $('#assigned-team-members').on('select2:clear', function() {
                                        
                                    });
                                });
                            </script>


                            <!-- Documents Upload -->
                            <div class="xl:col-span-12 col-span-12">
                                <label class="form-label">Documents:</label>
                                <input type="file" name="proj_documents[]" multiple required
                                    class="block w-full border border-gray-200 rounded-sm text-sm file:border-0 file:bg-light file:me-4 file:py-3 file:px-4">
                            </div>

                            <!-- Project Scope Selection -->
                            <div class="xl:col-span-11 col-span-11">
                                <label class="form-label">Project Scope:</label>
                                <select id="proj_stage" class="form-select">
                                    <option value="" disabled selected>-</option>
                                    <option value="Clean Up">Clean up</option>
                                    <option value="General Contracting">General Contracting</option>
                                    <option value="Floor Coverings">Floor coverings – tiles, carpet</option>
                                    <option value="Cover Floor Coatings">Cover floor coatings – epoxy, sealed concrete
                                    </option>
                                </select>
                            </div>

                            <!-- Add Scope Button -->
                            <div class="xl:col-span-1 col-span-1 pt-4">
                                <button type="button" onclick="addStage()"
                                    class="ti-btn ti-btn-light btn-wave mt-3 p-2 w-full border border-white/10">
                                    <span class="bi bi-plus"></span> Add
                                </button>
                            </div>

                            <!-- Dynamic Scope List -->
                            <div id="scope-container" class="xl:col-span-12 col-span-12"></div>

                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="box-footer">
                        <button type="submit" class="ti-btn ti-btn-primary btn-wave ms-auto float-end">Create
                            Bidding</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('pages.projects.plan-panther.create-js')


</x-app-layout>
