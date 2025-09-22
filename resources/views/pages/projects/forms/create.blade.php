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

<form action="{{ route('project-bidding.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @php
        $client_info = App\Models\Lead::where('email', Auth::user()->email)->first();
    @endphp
    <input type="hidden" name="client_id" value="{{ $client_info->id }}">

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
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
                $base_code = substr(date('Y'), 2, 4);
                $get_project = App\Models\ProjectBidding::where(
                    'proj_code',
                    'LIKE',
                    $base_code . '%',
                )->where('client_id', $client_info->id);
                $def_id = $base_code . sprintf('%04d', 1);
                if ($get_project->count() !== 0) {
                    $gen_id =
                        $get_project
                            ->select('proj_code')
                            ->where('client_id', $client_info->id)
                            ->orderBy('id', 'DESC')
                            ->first()->proj_code + 1;
                } else {
                    $gen_id = $def_id;
                }
            @endphp
            <input type="text" name="proj_code" class="form-control form-control-lg"
                style="font-weight: bold !important" id="proj_code" value="{{ $gen_id }}" required>
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
            <input type="date" name="proj_due_date" class="form-control form-control-lg" required>
        </div>

        <!-- Project Stages -->
        <div class="xl:col-span-6 col-span-12">
            <label class="form-label">Project Stages:</label>
            <select name="proj_stages" id="proj_stages" class="form-select">
                <option value="" disabled >-</option>
                <option value="Upload" selected>Upload</option>
                <option value="Measure">Measure</option>
                <option value="Spec'ed">Spec'ed</option>
                <option value="PHL">PHL</option>
                <option value="Ready">Ready</option>
            </select>
        </div>

        <!-- Bidders -->
        <div class="xl:col-span-12 col-span-12">
            <label class="form-label">Bidders:</label>
            <div id="customSelectWrapper" class="form-control custom-multi-select "
                data-hs-overlay="#hs-extralarge-modal">Click to select bidders</div>
            <select class="form-control hidden" name="proj_bidders[]" id="assigned-team-members" multiple></select>
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
                    background: #007bff;
                    color: #fff;
                    padding: 5px 10px;
                    border-radius: 3px;
                    display: flex;
                    align-items: center;
                }

                .remove-item {
                    margin-left: 5px;
                    cursor: pointer;
                    font-weight: bold;
                }

                .assigned-team-members {
                    display: none !important;
                }
            </style>
        </div>

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

    <!-- Submit Button -->
    <div class="box-footer">
        <button type="submit" class="ti-btn ti-btn-primary btn-wave ms-auto float-end">Create
            Bidding</button>
    </div>
    @include('pages.projects.raw-files.plan-panther.create-js')
</form>
