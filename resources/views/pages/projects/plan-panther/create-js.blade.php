 <!-- JavaScript for Dynamic Scopes -->
 <script>
    // let addedStages = [];

    // function addStage() {
    //     const stageSelect = document.getElementById('proj_stage');
    //     const selectedStage = stageSelect.value;

    //     if (!selectedStage || addedStages.includes(selectedStage)) {
    //         alert("Please select a valid and unique stage.");
    //   
    //       return;
    //     }

    //     addedStages.push(selectedStage);
    //     stageSelect.querySelector(`option[value="${selectedStage}"]`).disabled = true;

    //     const stageBlock = document.createElement('div');
    //     stageBlock.classList.add("border", "p-3", "rounded", "mt-3");
    //     stageBlock.setAttribute("data-stage", selectedStage);

    //     stageBlock.innerHTML = `
    //         <div class="flex justify-between items-center">
    //             <strong>${selectedStage}</strong>
    //             <button type="button" onclick="removeStage('${selectedStage}')" class="text-red-500">Remove</button>
    //         </div>
    //         <label class="form-label mt-2">Stage Description:</label>
    //         <input name="stage_descriptions[${selectedStage}]" placeholder="Enter Notes for ${selectedStage} here.." class="form-control form-control-lg" required/>

    //         <label class="form-label mt-2">Invite Client for <b>${selectedStage}</b> (Notify via Email Address):</label>
    //         <select class="form-control invite-client" name="invite_clients[${selectedStage}][]" multiple>
    //              @foreach (App\Models\Clients::get() as $client)
    //                 <option value="{{ $client->email }}">
    //                     {{ $client->first_name }} {{ $client->last_name }} ({{ $client->company }})
    //                 </option>
    //             @endforeach
    //         </select>
    //     `;

    //     document.getElementById('scope-container').appendChild(stageBlock);
    //     initializeClientSelection();
    // }

    // function removeStage(stage) {
    //     addedStages = addedStages.filter(s => s !== stage);
    //     document.querySelector(`div[data-stage="${stage}"]`).remove();
    //     document.getElementById('proj_stage').querySelector(`option[value="${stage}"]`).disabled = false;
    // }

    // function initializeClientSelection() {
    //     document.querySelectorAll('.invite-client').forEach(select => {
    //         if (!select.classList.contains('initialized')) {
    //             select.classList.add('initialized');
    //             new Choices(select, { allowHTML: true, removeItemButton: true });
    //         }
    //     });
    // }
</script>
<script>
    let addedStages = [];

    function addStage() {
        const stageSelect = document.getElementById("proj_stage");
        const selectedStage = stageSelect.value;

        if (!selectedStage || addedStages.includes(selectedStage)) {
            alert("Please select a valid and unique stage.");
            return;
        }

        addedStages.push(selectedStage);
        stageSelect.querySelector(`option[value="${selectedStage}"]`).disabled = true;

        const stageBlock = document.createElement("div");
        stageBlock.classList.add("border", "p-3", "rounded", "mt-3");
        stageBlock.setAttribute("data-stage", selectedStage);

        // Unique IDs for Quill editor and hidden input
        const editorId = `quill-editor-${selectedStage.replace(/\s+/g, '-')}`; // Remove spaces from ID
        const hiddenInputId = `hidden-description-${selectedStage.replace(/\s+/g, '-')}`;

        stageBlock.innerHTML = `
            <div class="flex justify-between items-center">
                <strong>${selectedStage}</strong>
                <button type="button" onclick="removeStage('${selectedStage}')" class="text-red-500">Remove</button>
            </div>

            <label class="form-label mt-2">Stage Description:</label>
            <div id="${editorId}" class="border p-2 min-h-[100px]"></div>
            <input type="hidden" name="stage_descriptions[${selectedStage}]" id="${hiddenInputId}">

            <label class="form-label mt-2">Invite Client for <b>${selectedStage}</b> (Notify via Email Address):</label>
            <select class="form-control invite-client" name="invite_clients[${selectedStage}][]" multiple>
                
            </select>
        `;

        document.getElementById("scope-container").appendChild(stageBlock);

        // Wait for the new element to be added before initializing Quill
        setTimeout(() => initializeQuillEditor(editorId, hiddenInputId), 100);

        // Initialize Multi-Select for Clients
        initializeClientSelection();
    }

    function removeStage(stage) {
        addedStages = addedStages.filter((s) => s !== stage);
        document.querySelector(`div[data-stage="${stage}"]`).remove();
        document.getElementById("proj_stage").querySelector(`option[value="${stage}"]`).disabled = false;
    }

    function initializeClientSelection() {
        document.querySelectorAll(".invite-client").forEach((select) => {
            if (!select.classList.contains("initialized")) {
                select.classList.add("initialized");
                new Choices(select, {
                    allowHTML: true,
                    removeItemButton: true,
                });
            }
        });
    }

    function initializeQuillEditor(editorId, hiddenInputId) {
        const editorContainer = document.getElementById(editorId);
        if (!editorContainer) {
            console.error(`Quill container not found: #${editorId}`);
            return;
        }

        const quill = new Quill(`#${editorId}`, {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: "snow",
        });

        quill.on("text-change", function () {
            document.getElementById(hiddenInputId).value = quill.root.innerHTML;
        });
    }

    var toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'font': [] }],
        ["bold", "italic", "underline", "strike"],
        ["blockquote", "code-block"],
        [{ 'list': "ordered" }, { 'list': "bullet" }],
        [{ 'indent': "-1" }, { 'indent': "+1" }],
        [{ 'direction': "rtl" }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'align': [] }],
        ["image", "video"],
        ["clean"],
    ];
</script>
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

        flatpickr("#startDate", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        flatpickr("#endDate", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        const multipleCancelButton = new Choices('#assigned-team-members', {
            allowHTML: true,
            removeItemButton: true,
        });

        // const multipleCancelButton_x = new Choices('#invite-client', {
        //     allowHTML: true,
        //     removeItemButton: true,
        // });

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
        // var quill = new Quill('#project-descriptioin-editor', {
        //     modules: {
        //         toolbar: toolbarOptions
        //     },
        //     theme: 'snow'
        // });

        document.querySelector('form').addEventListener('submit', function() {
            document.querySelector('#project_description').value = quill.root.innerHTML;
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
        document.querySelector('#project_description').value = document.querySelector('#project-descriptioin-editor')
            .innerHTML;
    }
</script>

{{-- 

 @foreach (App\Models\Clients::where('lead_id', $client_info->id)->limit(5)->get() as $client)
                    @php
                        $company = App\Models\Contact::where('id', $client->company_id)->first();
                    @endphp
                    <option value="{{ $client->email }}" {{ $client->id == 11 ? 'selected' : '' }}>
                        {{ $client->first_name }} {{ $client->last_name }} ({{ $company->company_name ?? 'N/A' }})
                    </option>
                @endforeach
                --}}