@php
    $details = App\Models\ProjectBidding::where('id', $id)->first();
@endphp

<form id="projectForm" onsubmit="uploadProject(event)" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @php
        $user = Auth::user();
        if (session('manage_portal_id')) {
            $email = session()->get('manage_portal_email');
            $client_info = App\Models\Lead::where('email', $email)->first();
        } else {
            if ($user->role === 'Virtual Assistant') {
                $clientId = $user->company;
            } elseif ($user->role === 'Administrator') {
                $clientId = $request->id;
            } elseif ($user->role === 'Sub-Client') {
                $clientId = $user->id; //Clients::where('email', $user->email)->value('id');
            } else {
                $clientId = App\Models\Lead::where('email', $user->email)->value('id');
            }

            $client_info = App\Models\Lead::where('email', Auth::user()->email)->first();
        }
    @endphp
    <input type="hidden" name="client_id" value="{{ $client_info->id ?? $clientId }}">

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

    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3 ">

        <!-- Project Code -->

        <div class="xl:col-span-6 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label for="proj_code" class="form-label">Project Code:</label>
            @php
                $base_code = substr(date('Y'), 2, 4);
                $get_project = App\Models\ProjectBidding::where('proj_code', 'LIKE', $base_code . '%')->where(
                    'client_id',
                    $client_info->id ?? $clientId,
                );
                $def_id = $base_code . sprintf('%04d', 1);
                if ($get_project->count() !== 0) {
                    $gen_id =
                        $get_project
                            ->select('proj_code')
                            ->where('client_id', $client_info->id ?? $clientId)
                            ->orderBy('id', 'DESC')
                            ->first()->proj_code + 1;
                } else {
                    $gen_id = $def_id;
                }
            @endphp
            <input type="text" name="proj_code" class="form-control form-control-lg" readonly
                style="font-weight: bold !important" id="proj_code" value="{{ $details->proj_code }}" required>
        </div>

        <!-- Project Name -->
        <div class="xl:col-span-6 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label for="proj_name" class="form-label">Project Name:</label>
            <input type="text" name="proj_name" placeholder="Enter Project Name here.."
                class="form-control form-control-lg" id="proj_name" required value="{{ $details->proj_name }}">
        </div>

        <!-- Due Date -->
        {{-- <div class="xl:col-span-6 col-span-12">
            <label class="form-label">Due Date:</label>
            <input type="date" name="proj_due_date" class="form-control form-control-lg" required
                value="{{ $details->proj_due_date }}">
            </div> --}}

        <div class="xl:col-span-3 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Due Date: <strong class="text-danger">*</strong></label>
            <input type="date" name="proj_due_date" placeholder="mm/dd/yyyy" id="proj_due_date"
                class="form-control form-control-lg" required>

        </div>

        <div class="xl:col-span-3 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Walkthrough Date:</label>
            <input type="date" name="proj_walkthrough_date" id="proj_walkthrough_date" placeholder="mm/dd/yyyy"
                class="form-control form-control-lg">
        </div>

        <script>
            flatpickr("#proj_due_date", {
                dateFormat: "d/m/Y",
                defaultDate: "{{ \Carbon\Carbon::parse($details->proj_due_date)->format('d/m/Y') }}"
            });
            flatpickr("#proj_walkthrough_date", {
                dateFormat: "d/m/Y",
                defaultDate: "{{ $details->proj_walkthrough_date ? \Carbon\Carbon::parse($details->proj_walkthrough_date)->format('d/m/Y') : '' }}"
            });
        </script>

        <!-- Project Stages -->
        <div class="xl:col-span-3 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Project Stages:</label>
            <select name="proj_stages" id="proj_stages" class="form-select">
                <option value="" disabled>-</option>
                <option value="Upload" {{ $details->proj_stages == 'Upload' ? 'selected' : '' }}>Upload</option>
                <option value="Measure" {{ $details->proj_stages == 'Measure' ? 'selected' : '' }}>Measure</option>
                <option value="Spec'ed" {{ $details->proj_stages == "Spec'ed" ? 'selected' : '' }}>Spec'ed</option>
                <option value="PHL" {{ $details->proj_stages == 'PHL' ? 'selected' : '' }}>PHL</option>
                <option value="Ready" {{ $details->proj_stages == 'Ready' ? 'selected' : '' }}>Ready</option>

            </select>
        </div>

        <div class="xl:col-span-3 col-span-12 {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Project Status:</label>
            <select name="proj_status" id="proj_status" class="form-select">
                <option value="" disabled selected>-</option>
                <option value="Unknown" {{ $details->proj_status == 'Unknown' ? 'selected' : '' }}>Unknown</option>
                <option value="Public Work/Prevailing Wage"
                    {{ $details->proj_status == 'Public Work/Prevailing Wage' ? 'selected' : '' }}>Public
                    Work/Prevailing Wage</option>
                <option value="Private" {{ $details->proj_status == 'Private' ? 'selected' : '' }}>Private</option>
            </select>
        </div>

        <div class="xl:col-span-3 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Site Address : <strong class="text-danger">*</strong></label>
            <input type="text" name="proj_address" placeholder="Site Address here.."
                class="form-control form-control-lg" value="{{ $details->proj_address }}">
        </div>

        <div class="xl:col-span-3 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">City : <strong class="text-danger">*</strong></label>
            <input type="text" name="proj_city" placeholder="City here.." class="form-control form-control-lg"
                value="{{ $details->proj_city }}">
        </div>

        <div class="xl:col-span-3 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">State : <strong class="text-danger">*</strong></label>
            <input type="text" name="proj_state" placeholder="State here.." class="form-control form-control-lg"
                value="{{ $details->proj_state }}">
        </div>

        <div class="xl:col-span-3 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Zip Code : <strong class="text-danger">*</strong></label>
            <input type="text" name="proj_zip" placeholder="Zip Code here.." class="form-control form-control-lg"
                value="{{ $details->proj_zip }}">
        </div>

        <!-- Bidders -->
        <div class="xl:col-span-12 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Bidders:</label>
            <div id="customSelectWrapper" class="form-control custom-multi-select "
                data-hs-overlay="#hs-extralarge-modal">Click to Select Bidders</div>
            <select class="form-control hidden" name="proj_bidders[]" id="bidders-list" multiple></select>

            @include('pages.apps.bids.forms.edit-partials.mod-bidders')
        </div>

        <!-- Documents Upload -->
        <div class="xl:col-span-12 col-span-12  {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Documents:</label>
            <input type="file" name="proj_documents[]" multiple
                class="block w-full border border-gray-200 rounded-sm text-sm file:border-0 file:bg-light file:me-4 file:py-3 file:px-4">
            @php
                $documents = is_array($details->proj_documents)
                    ? $details->proj_documents
                    : json_decode($details->proj_documents, true);
            @endphp

            @if (!empty($documents))
                <div class="overflow-x-auto mt-3">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm table-bordered">
                        <thead class="bg-gray-100 text-gray-700 text-sm">
                            <tr>
                                <th width="10" class="px-4 py-2 text-left">#</th>
                                <th class="px-4 py-2 text-left">File Name</th>
                                <th width="110" class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="project-document-table-body">
                            @foreach ($documents as $index => $doc)
                                <tr class="border-t hover:bg-gray-50 transition"
                                    data-doc-id="{{ $doc['google_drive_id'] ?? '' }}">
                                    <td class="px-4 p-2 font-medium text-gray-800 doc-index">{{ $index + 1 }}.
                                    </td>
                                    <td class="px-4 p-2 font-medium text-gray-800">
                                        {{ $doc['name'] ?? basename($doc['path'] ?? '') }}
                                    </td>
                                    <td class="font-medium text-gray-800 text-center">
                                        <a href="/file-manager/preview/{{ $doc['google_drive_id'] ?? '' }}"
                                            class="ti-btn ti-btn-sm ti-btn-soft-info bg-info/10" target="_blank">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10"
                                            type="button"
                                            onclick="removeProjectDoc('{{ $doc['google_drive_id'] ?? '' }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @else
                <p class="text-muted mt-3">No documents uploaded.</p>
            @endif


        </div>

        <!-- Project Scope Selection -->
        <div class="xl:col-span-11 col-span-11 {{ request()->has('t') ? 'hidden' : '' }}">
            <label class="form-label">Project Scope:</label>
            <select id="proj_stage" class="form-select">
                <option value="" disabled selected>-</option>
                <option value="Unknown">Unknown</option>
                <option value="Clean Up">Clean up</option>
                <option value="General Contracting">General Contracting</option>
                <option value="Floor Coverings">Floor Coverings – Tiles, Carpet</option>
                <option value="Floor Coatings">Floor Coatings – Epoxy, Sealed Concrete</option>
            </select>
        </div>


        <!-- Add Scope Button -->
        <div class="xl:col-span-1 col-span-1 pt-4 {{ request()->has('t') ? 'hidden' : '' }}">
            <button type="button" onclick="addStage()"
                class="ti-btn ti-btn-light text-primary btn-wave mt-3 p-2 w-full border border-white/10">
                <span class="bi bi-plus"></span> Add
            </button>
        </div>

        {{-- {{ request()->has('t') ? 'hidden' : '' }} --}}

        <!-- Dynamic Scope List -->
        <div id="scope-container" class="xl:col-span-12 col-span-12"></div>

    </div>

    <div class="grid grid-cols-12 sm:gap-x-6 gap-y-3">

        <!-- Project Code -->
        <div class="xl:col-span-12 col-span-12 mt-3">
            <div id="stageContainer"></div>
            <hr class="mb-5">
            <button type="submit" id="submitBtn"
                class="bg-green-400 hover:bg-green-700 text-white px-5 py-2 rounded-md transition duration-150 ease-in-out float-end">
                <span id="btnLoader" class="hidden animate-spin"><i class="bi bi-opencollective"></i></span>
                <span id="btnText"><span class="bi bi-check-lg mx-2"></span> Update Bidding</span>
            </button>

        </div>
    </div>

    <!-- Submit Button -->

</form>
