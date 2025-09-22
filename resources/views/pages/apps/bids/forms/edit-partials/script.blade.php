@php
    $user = Auth::user();
    $clientId = null;

    // Determine client ID based on user role
    if ($user->role === 'Virtual Assistant') {
        $clientId = $user->company;
    } elseif ($user->role === 'Administrator') {
        $clientId = $request->id;
    } elseif ($user->role === 'Sub-Client') {
        $clientId = App\Models\Clients::where('email', $user->email)->value('id');
    } else {
        $clientId = App\Models\Lead::where('email', $user->email)->value('id');
    }

    // Fetch clients with user and company data in one query
    $clients = App\Models\ContactPerson::with(['company:id,company_name,city,state,lead_source'])
        ->whereHas('company', function ($query) {
            $query->where('lead_source', 'Plan Panther Subscription');
        })
        ->when($clientId, function ($query) use ($clientId) {
            return $query->where('lead_id', $clientId);
        })
        ->get();
@endphp
<script>
    window.savedSubject = @json($details->stage_subject ?? []);
    window.savedStages = @json($details->stage_descriptions ?? []);
    window.savedDocs = @json($details->stage_proj_documents ?? []);
    window.savedInvites = @json($details->invite_clients ?? []);
    console.log('data', savedStages)
</script>

<script>
    let addedStages = [];

    window.addEventListener('DOMContentLoaded', function() {
        if (typeof savedStages === 'object') {
            for (const [stageKey, description] of Object.entries(savedStages)) {
                const originalStageName = stageKey.replace(/_/g, ' ');

                if (document.querySelector(`[data-stage="${stageKey}"]`)) continue;

                const invitedEmails = savedInvites?.[originalStageName] || [];
                const StageDocs = savedDocs?.[stageKey] || [];
                const StageSubject = String(savedSubject?.[stageKey] ?? '');

                console.log('Dcouments', StageDocs)

                renderSavedStage(originalStageName, stageKey, description, invitedEmails, StageSubject,
                    StageDocs);
                //renderDocumentsAsTable(originalStageName, stageDocs);
            }
        }
    });

    function renderSavedStage(originalStageName, sanitizedStage, description, invitedEmails, StageSubject, StageDocs) {
        const stageSelect = document.getElementById('proj_stage');
        if (!addedStages.includes(originalStageName)) {
            addedStages.push(originalStageName);
            stageSelect.querySelector(`option[value="${originalStageName}"]`)?.setAttribute('disabled', 'true');
        }

        const stageBlock = document.createElement('div');
        stageBlock.classList.add("border-none", "p-2", "rounded", "mt-0", "pt-0");
        stageBlock.setAttribute("data-stage", sanitizedStage);

        const editorId = `quill-editor-${sanitizedStage}`;
        const hiddenInputId = `hidden-description-${sanitizedStage}`;
        const selectId = `invite_clients_${sanitizedStage}`;

        const hasTParam = {{ request()->has('t') ? 'true' : 'false' }};
        const tParamValue = "{{ request()->get('t') }}";

        const shouldShow = hasTParam && tParamValue === originalStageName;

        stageBlock.innerHTML = `
                <div style="display: ${shouldShow ? 'block' : 'none'};">
                    <div class="flex justify-between items-center">
                        <strong class="text-2xl">${originalStageName} </strong>
                        <button type="button" onclick="removeStage('${sanitizedStage}')" class="text-red-500">Remove</button>
                    </div>

                    <hr class="mt-2 mb-2">
                    <label class="form-label mt-2">Scope Subject:</label>
                    <input class="form-control" placeholder="Write Subject here.." value="${StageSubject}" name="stage_subject[${sanitizedStage}]"/>

                    <div class="xl:col-span-12 col-span-12 mt-2">
                        <label class="form-label">Attached Documents:</label>
                        <input type="file" name="stage_proj_documents[${sanitizedStage}][]" multiple
                            class="block w-full border border-gray-200 rounded-sm text-sm file:border-0 file:bg-light file:me-4 file:py-3 file:px-4">
                    </div>
                    
                    <!-- Document Table -->
                    <div class="overflow-x-auto mt-3">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm table-bordered">
                            <thead class="bg-gray-100 text-gray-700 text-sm">
                                <tr>
                                    <th width="10" class="px-4 py-2 text-left">#</th>
                                    <th class="px-4 py-2 text-left">File Name</th>
                                    <th width="100" class="px-4 py-2 text-center ">Action</th>
                                </tr>
                            </thead>
                            <tbody id="document-table-body-${sanitizedStage}">
                                <!-- Documents will be dynamically inserted here -->
                            </tbody>
                        </table>
                    </div>

                    <hr class="mt-4 mb-4">

                    <label class="form-label mt-2" >Scope Description:</label>
                    <div id="${editorId}" class="border p-2 min-h-[100px]"></div>
                    <input type="hidden" name="stage_descriptions[${sanitizedStage}]" id="${hiddenInputId}">

                    <label class="form-label mt-2">Invite Client for <b>${originalStageName}</b>:</label>
                    <select class="form-control invite-client" id="${selectId}" name="invite_clients[${originalStageName}][]" multiple>
                        @foreach ($clients as $client)
                            <option value="{{ $client->email }}">{{ $client->first_name }} {{ $client->last_name }} ({{ $client->company->company_name }})</option>
                        @endforeach
                    </select>
                </div>
                `;

        document.getElementById('scope-container').appendChild(stageBlock);

        // Dynamically populate the document table
        const documentTableBody = document.getElementById(`document-table-body-${sanitizedStage}`);
        documentTableBody.innerHTML = StageDocs.map((doc, index) => `
                        <tr class="border-t hover:bg-gray-50 transition" data-doc-id="${doc.id}">
                            <td class="p-2 px-4 font-medium text-gray-800" class="doc-index">${index + 1}.</td>
                            <td class="p-2 px-4 font-medium text-gray-800">
                                ${doc.name ?? doc.path.split('/').pop()}
                            </td>
                            <td class="font-medium text-gray-800 text-center">
                                <a href="/file-manager/preview/${doc.google_drive_id}" class="ti-btn ti-btn-sm ti-btn-soft-info bg-info/10" target="_blank">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button"
                                    onclick="removeDocument('${sanitizedStage}', ${doc.id})"
                                    class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10">
                                    <i class="bi bi-trash"></i>
                                </button>
                        </td>
                    </tr>
                `).join('');

        var toolbarOptions = [
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            [{
                'font': []
            }],
            ["bold", "italic", "underline", "strike"],
            ["blockquote", "code-block"],
            [{
                'list': "ordered"
            }, {
                'list': "bullet"
            }],
            [{
                'indent': "-1"
            }, {
                'indent': "+1"
            }],
            [{
                'direction': "rtl"
            }],
            [{
                'color': []
            }, {
                'background': []
            }],
            [{
                'align': []
            }],
            ["image", "video", 'link'],
            ["clean"],
        ];

        // Initialize Quill
        const quill = new Quill(`#${editorId}`, {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: "snow",
        });

        quill.root.innerHTML = description;
        quill.on('text-change', function() {
            document.getElementById(hiddenInputId).value = quill.root.innerHTML;
        });
        document.getElementById(hiddenInputId).value = description;

        // Pre-select invited clients
        const selectElement = document.getElementById(selectId);
        invitedEmails.forEach(email => {
            const option = [...selectElement.options].find(o => o.value === email);
            if (option) option.selected = true;
        });

        // Initialize Choices.js
        new Choices(selectElement, {
            allowHTML: true,
            removeItemButton: true,
            searchEnabled: true,
            searchChoices: true,
            shouldSort: false,
            itemSelectText: '',
            noResultsText: 'No clients found',
            placeholder: true,
            placeholderValue: '',
            searchFloor: 1,
            searchResultLimit: 5,
            fuseOptions: {
                threshold: 0.3
            }
        });
    }

    function removeDocument(stageKey, docId) {
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
                fetch(`/project/stage/file/remove`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            stageKey,
                            docId,
                            id: {{ $id }}
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const tableBody = document.getElementById(`document-table-body-${stageKey}`);
                            const row = tableBody.querySelector(`tr[data-doc-id="${docId}"]`);
                            if (row) row.remove();

                            // Update savedDocs
                            if (window.savedDocs && window.savedDocs[stageKey]) {
                                window.savedDocs[stageKey] = window.savedDocs[stageKey].filter(doc => doc
                                    .id !== docId);
                            }

                            // 🔁 Re-align index/serial numbers
                            const rows = tableBody.querySelectorAll('tr');
                            rows.forEach((tr, index) => {
                                const indexCell = tr.querySelector('.doc-index');
                                if (indexCell) {
                                    indexCell.textContent = index + 1;
                                }
                            });

                            Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", data.message || "Failed to remove document.", "error");
                        }
                    })
                    .catch(() => {
                        Swal.fire("Error!", "Network error, try again later.", "error");
                    });
            }
        });
    }

    function removeStage(sanitizedStage) {
        const stageBlock = document.querySelector(`[data-stage="${sanitizedStage}"]`);
        if (stageBlock) {
            stageBlock.remove();
        }

        // Optionally re-enable it in dropdown
        const originalName = sanitizedStage.replace(/_/g, ' ');
        addedStages = addedStages.filter(s => s !== originalName);
        document.querySelector(`#proj_stage option[value="${originalName}"]`)?.removeAttribute('disabled');
    }
</script>


<script>
    function removeProjectDoc(googleDriveId) {
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
                fetch(`/project/file/remove`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            google_drive_id: googleDriveId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Remove row from DOM
                            const row = document.querySelector(
                                `#project-document-table-body tr[data-doc-id="${googleDriveId}"]`);
                            if (row) row.remove();

                            // Realign row numbers
                            const rows = document.querySelectorAll('#project-document-table-body tr');
                            rows.forEach((tr, i) => {
                                const indexCell = tr.querySelector('.doc-index');
                                if (indexCell) indexCell.textContent = `${i + 1}.`;
                            });

                            Swal.fire("Deleted!", "The file has been removed.", "success");
                        } else {
                            Swal.fire("Error!", data.message || "Failed to delete the file.", "error");
                        }
                    })
                    .catch(() => {
                        Swal.fire("Error!", "Network error. Please try again.", "error");
                    });
            }
        });
    }
</script>
