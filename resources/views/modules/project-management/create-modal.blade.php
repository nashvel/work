<div id="create-project" class="hs-overlay ti-modal pointer-events-none hidden mt-6">
    <div class="hs-overlay ti-modal-box mt-0 lg:!max-w-4xl lg:w-full m-3  items-center justify-center">
        <div class="max-h-full w-full overflow-hidden ti-modal-content">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semiboldmodal-title" id="form-header">
                    Create New Project
                </h6>
                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#create-project">
                    <span class="sr-only">Close</span>
                    <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                            fill="currentColor" />
                    </svg>
                </button>
            </div>
            <div class="space-y-6 p-6 pt-0 bg-white shadow-md rounded-lg">
                @csrf
                <form id="project-form" method="POST" action="{{ route('projects.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Project Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter project name">
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Project Name</label>
                        <input type="text" id="location" name="location" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter project location">
                    </div>

                    <div class="mb-4">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <div id="editor"
                            class="w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 min-h-[120px]">
                        </div>

                        <!-- Hidden textarea to store content -->
                        <textarea id="description" name="description" class="hidden">
                            {{ old('description', $project->description ?? '') }}
                        </textarea>

                        @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror

                        {{-- <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter project description"></textarea> --}}
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                        <input type="date" id="due_date" name="due_date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-6">
                        <label for="stage" class="block text-sm font-medium text-gray-700 mb-2">Stage</label>
                        <select id="stage" name="stage" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Stage</option>
                            <option value="planning">Planning</option>
                            <option value="in_progress">In Progress</option>
                            <option value="review">Review</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <hr class="mb-4">

                    <div class="flex items-center justify-end space-x-3">
                        <button type="button" onclick="closeCreateModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Create Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Quill JS (CDN) -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Make sure you have these once on the page -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
(function () {
  // Prevent double-init (e.g., Livewire/Turbo re-renders)
  const mount = document.getElementById('editor');
  if (!mount || mount.dataset.quillInitialized === '1') return;
  mount.dataset.quillInitialized = '1';

  const form   = document.getElementById('project-form');
  const hidden = document.getElementById('description'); // must have name="description"

  // 1) Initialize Quill once
  const quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
      toolbar: [
        ['bold','italic','underline','strike'],
        ['blockquote','code-block'],
        [{ list:'ordered' }, { list:'bullet' }],
        [{ header:[1,2,3,false] }],
        ['link','clean']
      ]
    },
    placeholder: 'Enter project description...'
  });

  // 2) Preload existing HTML into Quill
  quill.clipboard.dangerouslyPasteHTML((hidden?.value || '').trim());

  // 3) Clean paste: keep structure, drop noisy inline styles
  quill.clipboard.addMatcher(Node.ELEMENT_NODE, (node, delta) => {
              // normalize ops array
    delta.ops = (delta.ops || []).map(op => {
      if (op.attributes) {
        delete op.attributes.color;
        delete op.attributes.background;
        delete op.attributes.size;
        delete op.attributes.font;
      }
      return op;
    });
    return delta;
  });

  // Map H1–H3 → Quill headers
  ['H1','H2','H3'].forEach((tag, i) => {
    quill.clipboard.addMatcher(tag, (node, delta) => {
      (delta.ops || []).forEach(op => {
        op.attributes = { ...(op.attributes || {}), header: i + 1 };
      });
      return delta;
    });
  });
  // H4–H6 → paragraphs (no special attrs)
  ['H4','H5','H6'].forEach(tag => {
    quill.clipboard.addMatcher(tag, (node, delta) => delta);
  });

  // 4) Optional: Ctrl+Shift+V → paste as plain text
  quill.root.addEventListener('paste', function (e) {
    const isCtrl = e.ctrlKey || e.metaKey; // support macOS
    if (isCtrl && e.shiftKey) {
      e.preventDefault();
      const text = (e.clipboardData || window.clipboardData).getData('text/plain') || '';
      const range = quill.getSelection(true);
      quill.insertText(range.index, text, 'user');
      quill.setSelection(range.index + text.length, 0, 'user');
    }
  });

  // 5) Keep hidden textarea in sync (extra safe) 
  const syncHidden = () => { if (hidden) hidden.value = quill.root.innerHTML; };
  quill.on('text-change', syncHidden);
  if (form) form.addEventListener('submit', syncHidden);

})();
</script>

