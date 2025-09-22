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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<form id="projectForm" onsubmit="uploadProject(event)" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @php
        $user = Auth::user();
        $clientId = null;

        if (session('manage_portal_id')) {
            $email = session()->get('manage_portal_email');
            $client_info = App\Models\Lead::where('email', $email)->first();
        } else {
            $client_info = App\Models\Lead::where('email', Auth::user()->email)->first();
        }
    @endphp

    <input type="hidden" name="client_id" value="{{ $client_info->id ?? Auth::user()->id }}">

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

    <span id="uploadPercent" class="text-sm text-gray-600 hidden">Uploading: 0%</span>
    <hr class="mt-3 mb-3">

    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3">

        <!-- Project Code -->
        <div class="xl:col-span-6 col-span-12">
            <label for="proj_code" class="form-label">Project Code: <strong class="text-danger">*</strong></label>
            @php
                $geId = App\Models\ProjectBidding::where('client_id', $client_info->id ?? Auth::user()->id)
                    ->where('isDeleted', 0)
                    ->orderBy('proj_code', 'DESC')
                    ->first();

                $base_code = substr(date('Y'), 2, 4);
                $get_project = App\Models\ProjectBidding::where('proj_code', 'LIKE', $base_code . '%')->where(
                    'client_id',
                    $client_info->id ?? Auth::user()->id,
                );
                $nextSprint = 1; // your logic here
                $sprint = $client_info && $client_info->id ? sprintf('%04d', 1) : sprintf('%03d', 1);
                $def_id = $base_code . $sprint;
                if ($get_project->count() !== 0) {
                    $gen_id = $geId->proj_code + 1;
                } else {
                    $gen_id = $def_id;
                }
            @endphp
            <input type="text" name="proj_code" class="form-control form-control-lg"
                style="font-weight: bold !important" id="proj_code" value="{{ $gen_id }}" required>
        </div>

        <!-- Project Name -->
        <div class="xl:col-span-6 col-span-12">
            <label for="proj_name" class="form-label">Project Name: <strong class="text-danger">*</strong></label>
            <input type="text" name="proj_name" placeholder="Enter Project Name here.."
                class="form-control form-control-lg" id="proj_name" required>
        </div>

        <!-- Due Date -->
        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">Due Date: <strong class="text-danger">*</strong></label>
            <input type="date" name="proj_due_date" placeholder="mm/dd/yyyy" id="proj_due_date" required
                class="form-control form-control-lg">
        </div>

        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">Walkthrough Date:</label>
            <input type="date" name="proj_walkthrough_date" id="proj_walkthrough_date" placeholder="mm/dd/yyyy"
                class="form-control form-control-lg">
        </div>

        <script>
            flatpickr("#proj_due_date", {
                dateFormat: "d/m/Y"
            });
            flatpickr("#proj_walkthrough_date", {
                dateFormat: "d/m/Y"
            });
        </script>

        <!-- Project Stages -->
        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">Project Stages:</label>
            <select name="proj_stages" id="proj_stages" class="form-select">
                <option value="" disabled>-</option>
                <option value="Upload" selected>Upload</option>
                <option value="Measure">Measure</option>
                <option value="Spec'ed">Spec'ed</option>
                <option value="PHL">PHL</option>
                <option value="Ready">Ready</option>
            </select>
        </div>

        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">Status:</label>
            <select name="proj_status" id="proj_status" class="form-select">
                <option value="" disabled selected>-</option>
                <option value="Unknown">Unknown</option>
                <option value="Public Work/Prevailing Wage">Public Work/Prevailing Wage</option>
                <option value="Private">Private</option>
            </select>
        </div>

        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">Site Address :</label>
            <input type="text" name="proj_address" placeholder="Site Address here.."
                class="form-control form-control-lg">
        </div>

        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">City :</label>
            <input type="text" name="proj_city" placeholder="City here.." class="form-control form-control-lg">
        </div>

        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">State :</label>
            <input type="text" name="proj_state" placeholder="State here.." class="form-control form-control-lg">
        </div>

        <div class="xl:col-span-3 col-span-12">
            <label class="form-label">Zip Code :</label>
            <input type="text" name="proj_zip" placeholder="Zip Code here.."
                class="form-control form-control-lg">
        </div>

        <!-- Bidders -->
        <div class="xl:col-span-12 col-span-12">
            <label class="form-label">Bidders:</label>
            <div id="customSelectWrapper" class="form-control custom-multi-select "
                data-hs-overlay="#hs-extralarge-modal">Click to Select Bidders</div>
            <select class="form-contro hidden " name="proj_bidders[]" id="bidders-list" multiple></select>
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

        <!-- Documents Upload -->
        <div class="xl:col-span-12 col-span-12">
            <label class="form-label">Documents:</label>
            <input type="file" name="proj_documents[]" multiple
                class="block w-full border border-gray-200 rounded-sm text-sm file:border-0 file:bg-light file:me-4 file:py-3 file:px-4">
        </div>

        @php
            $crm = $client_info && $client_info->id ? 0 : 1;
        @endphp

        <!-- Project Scope Selection -->
        <div class="xl:col-span-{{ $crm == 1 ? 12 : 11 }} col-span-{{ $crm == 1 ? 12 : 11 }}">
            <label class="form-label">Project Scope:</label>
            @if ($crm == 1)
                <textarea name="proj_stage" id="proj_stage" cols="30" rows="10" class="form-control"></textarea>
            @else
                <select id="proj_stage" class="form-select">
                    <option value="" disabled selected>-</option>
                    <option value="Unknown">Unknown</option>
                    <option value="Clean Up">Clean up</option>
                    <option value="General Contracting">General Contracting</option>
                    <option value="Floor Coverings">Floor Coverings – Tiles, Carpet</option>
                    <option value="Floor Coatings">Floor Coatings – Epoxy, Sealed Concrete</option>
                </select>
            @endif
        </div>
        @if ($crm !== 1)
            <!-- Add Scope Button -->
            <div class="xl:col-span-1 col-span-1 pt-4">
                <button type="button" onclick="addStage()"
                    class="ti-btn ti-btn-light text-primary btn-wave mt-3 p-2 w-full border border-white/10">
                    <span class="bi bi-plus"></span> Add
                </button>
            </div>
        @endif
        <!-- Dynamic Scope List -->
        <div id="scope-container" class="xl:col-span-12 col-span-12"></div>

    </div>

    <!-- Submit Button -->
    @php
        $crm = $client_info && $client_info->id ? 0 : 1;
    @endphp
    {{-- @if ($crm == 1)
        <hr class="mt-3 mb-3">
        <button type="button" class="ti-btn ti-btn-primary btn-wave ms-auto float-end">
            <span id="btnLoader" class="hidden animate-spin"><i class="bi bi-opencollective"></i></span>
            <span id="btnText">Create Project (<i>Under Maintenance</i>)</span>
        </button>
    @else
        <hr class="mb-3 mt-5">
        <button type="submit" id="submitBtn" class="bg-green-500 text-white px-4 py-2 rounded-md !hover:bg-green-800 transition float-end">
            <span id="btnLoader" class="hidden animate-spin"><i class="bi bi-opencollective"></i></span>
            <span id="btnText">
                <i class="bi bi-check2-circle mx-2"></i>
                Create Bidding
            </span>
        </button>
    @endif --}}
    <hr class="mb-3 mt-5">
    <button type="submit" id="submitBtn"
        class="bg-green-500 text-white px-4 py-2 rounded-md !hover:bg-green-800 transition float-end">
        <span id="btnLoader" class="hidden animate-spin"><i class="bi bi-opencollective"></i></span>
        <span id="btnText">
            <i class="bi bi-check2-circle mx-2"></i>
            Create Bidding
        </span>
    </button>

    <script>
        function uploadProject(event) {
            event.preventDefault();

            const form = document.getElementById('projectForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const percentText = document.getElementById('uploadPercent');
            const statusText = document.getElementById('statusPercent');
            const uploadPanel = document.getElementById('upload-panel');
            const registerPanel = document.getElementById('register-panel');

            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();

            // Lock UI
            submitBtn.disabled = true;
            btnText.textContent = 'Saving...';
            percentText.classList.add('inline');
            percentText.textContent = 'Uploading: 0%';
            statusText.textContent = 'Please wait...';
            uploadPanel.classList.remove('hidden');
            registerPanel.classList.add('hidden');

            // Show project name dynamically
            const projectName = document.getElementById('proj_name').value;
            document.getElementById('project-name').textContent = projectName;

            // Upload progress feedback
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    const loadedMB = (e.loaded / (1024 * 1024)).toFixed(2);
                    const totalMB = (e.total / (1024 * 1024)).toFixed(2);
                    percentText.textContent = `Uploading: ${percent}% (${loadedMB} MB / ${totalMB} MB)`;
                }
            });

            // Handle successful response
            xhr.addEventListener('load', function() {
                console.log('[Upload Completed]', xhr.status, xhr.responseURL);

                const isAuthIssue = xhr.status === 419 || xhr.responseText.includes('<form') || xhr.responseURL
                    .includes('/login');

                if (xhr.status === 200 || xhr.status === 201) {
                    try {
                        const json = JSON.parse(xhr.responseText);
                        const message = json.message || 'Project created. Upload in background.';

                        percentText.textContent = '';
                        statusText.textContent = 'Project Created. Uploading files in background...';
                        btnText.textContent = 'Saved!';

                        Swal.fire({
                            icon: 'success',
                            title: 'Saved Successfully',
                            text: message,
                            confirmButtonText: 'OK'
                        });

                        setTimeout(() => window.location.href = '/project/list', 2000);
                    } catch (e) {
                        console.error('JSON Parse Error:', e);
                        showError('Response parse failed. Please contact support.');
                    }
                } else if (isAuthIssue) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Authentication Error',
                        text: 'You were logged out. Please log in again.',
                        confirmButtonText: 'Login'
                    }).then(() => {
                        window.location.href = '/login';
                    });
                } else {
                    console.error('[Server Error]', xhr.status, xhr.responseText);
                    showError('Unexpected server error. Please try again.');
                }
            });

            // Handle general network error
            xhr.addEventListener('error', function() {
                console.error('[Network Error]', xhr);
                showError('Network error. Please check your connection.');
            });

            // Helper to show errors and reset UI
            function showError(message) {
                percentText.textContent = 'Upload failed.';
                statusText.textContent = message;

                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: message,
                    confirmButtonText: 'Retry'
                });

                // Reset UI
                btnText.textContent = 'Create Bidding';
                submitBtn.disabled = false;
                uploadPanel.classList.add('hidden');
                registerPanel.classList.remove('hidden');
            }

            // Setup and send request
            xhr.open('POST', "{{ route('project-bidding.store') }}");
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.setRequestHeader('Accept', 'application/json');

            xhr.send(formData);
        }
    </script>


    <style>
        .hidden {
            display: none;
        }
    </style>
    @include('pages.apps.bids.raw.plan-panther.create-js')
    <br>
</form>
