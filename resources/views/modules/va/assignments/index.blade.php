@php
    // AutoTable config for "Virtual Assistant Assignment"
    $table = [
        'id' => 'vaAssignments',
        'ajax' => ['url' => url('/va/assignments/fetch'), 'method' => 'GET', 'dataSrc' => 'data'],
        'rowLink' => null, // don't navigate on row click; we manage via actions
    'order' => [[1, 'asc']],
    'pageLength' => 10,   
    'filters' => [
        [
            'type' => 'select',
            'name' => 'role',
            'label' => 'Account Role/Type',
            'options' => [
                '' => 'All',
                'Business Client' => 'Business Client',
                'Associated Client' => 'Associated Client',
            ],
            'field' => 'role_label',
        ],
    ],
    'columns' => [
        [
            'type' => 'checkbox',
            'title' => '<input type="checkbox" class="form-check-input mx-3" id="selectAll">',
            'data' => 'id',
            'width' => '5px',
        ],
        [
            'type' => 'avatar_text',
            'title' => 'Name',
            'data' => 'name',
            'align' => 'start',
            'avatar_field' => 'profile_photo_path',
            'avatar_prefix' => '/storage/',
            'avatar_fallback' => '/user.png',
        ],
        ['type' => 'email', 'title' => 'Email Address', 'data' => 'email', 'align' => 'start'],
        [
            'type' => 'badge_map',
            'title' => 'Account Role',
            'data' => 'role',
            'align' => 'start',
            'map' => [
                'Administrator' => ['label' => 'Administrator', 'icon' => 'bi-magic', 'class' => 'text-dark'],
                'BusinessClient' => [
                    'label' => 'Business Client',
                    'icon' => 'bi-person-circle',
                    'class' => 'text-dark',
                ],
                'Client' => ['label' => 'Business Client', 'icon' => 'bi-person-circle', 'class' => 'text-dark'],
                'AssociatedClient' => [
                    'label' => 'Associated Client',
                    'icon' => 'bi-person-square',
                    'class' => 'text-dark',
                ],
                'SubClient' => [
                    'label' => 'Associated Client',
                    'icon' => 'bi-person-square',
                    'class' => 'text-dark',
                ],
                'VirtualAssistant' => [
                    'label' => 'Virtual Assistant',
                    'icon' => 'bi-person-badge',
                    'class' => 'text-dark',
                ],
                'Developer' => ['label' => 'Development Team', 'icon' => 'bi-code-slash', 'class' => 'text-dark'],
            ],
        ],
        // NEW: Assigned VAs column (server returns "assigned_vas_html")
        ['type' => 'html', 'title' => 'Assigned VAs', 'data' => 'assigned_vas_html', 'align' => 'center'],
        [
            'type' => 'dropdown_actions',
            'title' => 'Actions',
            'data' => 'id',
            'align' => 'center',
            'menu' => [
                ['onclick' => 'openAssignModal({id})', 'icon' => 'bi bi-pencil-square', 'label' => 'Assign / Edit'],
                ],
            ],
        ],
    ];
@endphp

<x-app-layout>
    <x-slot name="return">{"link": "/va/assignments", "text": "Manage"}</x-slot>
    <x-slot name="title">Manage VA Assignments</x-slot>
    <x-slot name="url_1">{"link": "/va/assignments", "text": "Manage VA Assignments"}</x-slot>
    <x-slot name="active">VA Assignments</x-slot>
    <x-slot name="buttons">
        <a href="{{ route('va.my_clients') }}" class="ti-btn text-white !border-0 btn-wave me-0"
            style="background-color:#2563eb">
            <i class="bi bi-people me-1"></i>
            <span class="mx-1" style="font-weight:400">My Assigned Clients</span>
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i>
                    <span>You can manage the Virtual Assistant assignments here.</span>
                    <hr class="mb-3 mt-3">
                    @include('modules.developer.helper.auto-table', ['table' => $table])
                </div>
            </div>
        </div>
    </div>

    {{-- HS Overlay Modal (VA Assign) --}}
    <div id="assignModal" class="hs-overlay ti-modal pointer-events-none hidden">
        <div
            class="hs-overlay ti-modal-box hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
            <div class="ti-modal-content w-full overflow-hidden bg-white rounded-xl shadow-2xl">

                <!-- Header -->
                <div class="ti-modal-header sticky top-0 z-10 bg-white/80 backdrop-blur border-b">
                    <h6 class="modal-title text-[1rem] font-semibold" id="form-header">
                        <i class="bi bi-people-fill me-2"></i> <span id="assignModalUser">—</span>
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#assignModal"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.5 1.4 6.6.5 4 3.1 1.4.5.5 1.4 3.1 4 .5 6.6l.9.9L4 4.9 6.6 7.5l.9-.9L4.9 4 7.5 1.4Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-0">

                    <!-- Toolbar -->
                    <div class="px-6 pb-3 pt-3">
                        <div class="flex flex-col md:flex-row gap-2 md:items-center">
                            <div class="flex-1 flex items-center gap-2">
                                <div class="relative w-full">
                                    <input id="vaSearch" type="text" class="form-control ps-9"
                                        placeholder="Search VAs (name/email)…">
                                </div>
                                <select id="vaRoleFilter" class="form-control w-44 hidden">
                                    <option value="">All roles</option>
                                    <option value="Virtual Assistant">Virtual Assistant</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Developer">Development Team</option>
                                    <option value="Business Client">Business Client</option>
                                    <option value="Associated Client">Associated Client</option>
                                </select>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" class="ti-btn btn-wavehidden hidden" id="btnSelectAllVisible">
                                    <i class="bi bi-check2-square me-1"></i> Select all visible
                                </button>
                                <button type="button" class="ti-btn ti-btn-ghost btn-wave" id="btnClearSelected">
                                    <i class="bi bi-trash3 me-1"></i> Clear
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-3">
                    <!-- Two-pane content -->
                    <div class="px-6 pb-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 min-h-[480px]">

                            <!-- Left: available VAs (scrollable) -->
                            <div class="lg:col-span-2">
                                <div class="sticky top-[4.25rem] z-10 bg-white pb-2">
                                    <div class="text-xs text-gray-500 flex items-center justify-between">
                                        <span>Available VAs</span>
                                        <span>Showing <span id="vaVisibleCount">0</span></span>
                                    </div>
                                </div>

                                <div class="rounded-xl ring-1 ring-gray-200 overflow-hidden border">
                                    <div id="vaListWrap" class="max-h-[60vh] overflow-auto"
                                        style="max-height: 50vh !important;">
                                        <div id="vaList" class="divide-y divide-gray-100">
                                            @foreach ($vas as $va)
                                                <label
                                                    class="flex items-center gap-3 p-3 hover:bg-gray-50 cursor-pointer">
                                                    <input type="checkbox" class="form-check-input va-check shrink-0"
                                                        value="{{ (int) $va->id }}" data-name="{{ $va->name }}"
                                                        data-email="{{ $va->email }}"
                                                        data-role="{{ $va->role ?? '' }}">
                                                    <div
                                                        class="h-9 w-9 rounded-full bg-gray-100 flex items-center justify-center text-sm font-semibold shrink-0">
                                                        {{ strtoupper(mb_substr($va->name, 0, 1)) }}
                                                    </div>
                                                    <div class="min-w-0">
                                                        <div class="font-medium truncate">{{ $va->name }}</div>
                                                        <div class="text-xs text-gray-500 truncate">{{ $va->email }}
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto text-xs text-gray-500">{{ $va->role ?? '' }}
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: selected (scrollable) -->
                            <div class="lg:col-span-1">
                                <div class="sticky top-[4.25rem] z-10 bg-white pb-2">
                                    <div class="text-xs text-gray-500">Selected (<span id="vaSelectedCount">0</span>)
                                    </div>
                                </div>
                                <div class="rounded-xl ring-1 ring-gray-200 overflow-hidden border">
                                    <div id="vaSelectedPanel" class="max-h-[60vh] overflow-auto p-2">
                                        <div id="vaSelectedChips" class="flex flex-wrap gap-1"></div>
                                        <div id="vaSelectedEmpty" class="text-xs text-gray-400 p-3">Nothing selected
                                            yet.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between gap-3 px-6 py-4 border-t bg-gray-50">
                    <div class="text-xs text-gray-500">
                        Tip: Use the search and role filter to narrow down the list. “Select all visible” respects your
                        filters.
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="ti-btn btn-wave" data-hs-overlay="#assignModal">Cancel</button>
                        <button type="button" class="ti-btn ti-btn-primary !border-0 btn-wave"
                            onclick="saveAssignments()">
                            <i class="bi bi-save2 me-1"></i> Save
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
        let currentUserId = null;

        function parseCsvIds(csv) {
            if (!csv || typeof csv !== 'string') return [];
            return csv.split(',').map(s => parseInt(String(s).trim(), 10)).filter(n => Number.isFinite(n) && n > 0);
        }

        // Open modal + load current CSV
        function openAssignModal(userId) {
            currentUserId = userId;
            document.querySelectorAll('.va-check').forEach(cb => cb.checked = false);

            const url = `{{ url('/va/assignments') }}/${userId}?t=${Date.now()}`;

            fetch(url, {
                    method: 'GET',
                    cache: 'no-store',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Cache-Control': 'no-store, no-cache, must-revalidate, max-age=0',
                        'Pragma': 'no-cache',
                    },
                })
                .then(r => {
                    if (!r.ok) throw new Error('Failed to load assignments');
                    return r.json();
                })
                .then(data => {
                    const user = data?.user || {};
                    const ids = parseCsvIds(data?.assign_id || '');
                    document.getElementById('assignModalUser').textContent = `Client: ${user.name} (${user.email})`;

                    ids.forEach(id => {
                        const cb = document.querySelector('.va-check[value="' + id + '"]');
                        if (cb) cb.checked = true;
                    });
                    refreshVaSelectionSummary();

                    // open via HS
                    window.HSOverlay?.open('#assignModal');
                })
                .catch(err => {
                    console.error(err);
                    alert('Failed to load assignments');
                });
        }

        function filterVaList() {
            const q = document.getElementById('vaSearch').value.toLowerCase().trim();
            const labels = [...document.querySelectorAll('#vaList label')];
            labels.forEach(l => {
                const t = l.textContent.toLowerCase();
                l.style.display = t.includes(q) ? '' : 'none';
            });
        }

        function getCheckedVaIds() {
            return [...document.querySelectorAll('.va-check:checked')].map(cb => Number(cb.value));
        }

        function refreshVaSelectionSummary() {
            const chipsWrap = document.getElementById('vaSelectedChips');
            const countEl = document.getElementById('vaSelectedCount');
            const cbs = [...document.querySelectorAll('.va-check:checked')];
            countEl.textContent = String(cbs.length);
            chipsWrap.innerHTML = '';
            cbs.forEach(cb => {
                const name = cb.getAttribute('data-name') || ('#' + cb.value);
                const span = document.createElement('span');
                span.className =
                    'inline-flex items-center gap-1 px-2 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-xs';
                span.innerHTML = `<i class="bi bi-person-badge"></i> ${name}`;
                chipsWrap.appendChild(span);
            });
        }
        document.addEventListener('change', (e) => {
            if (e.target?.classList.contains('va-check')) refreshVaSelectionSummary();
        }, true);

        function saveAssignments() {
            if (!currentUserId) return;
            const ids = getCheckedVaIds();

            fetch(`{{ url('/va/assignments') }}/${currentUserId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        assign_id: ids
                    }),
                })
                .then(async r => {
                    const json = await r.json().catch(() => ({}));
                    if (!r.ok) throw new Error('Save failed');

                    // close modal
                    window.HSOverlay?.close('#assignModal');

                    // show success swal
                    Swal.fire({
                        icon: 'success',
                        title: 'Assignments Updated',
                        text: 'Virtual Assistant(s) were successfully assigned!',
                        timer: 1800,
                        showConfirmButton: false,
                    });

                    // refresh AutoTable or fallback to reload
                    if (window.autoTable && typeof window.autoTable.reload === 'function') {
                        window.autoTable.reload('vaAssignments');
                    } else {
                        location.reload();
                    }
                })

                .catch(err => {
                    console.error(err);
                    alert('Failed to save assignments');
                });
        }
    </script>
    <script>
        // --- Debounce utility ---
        function debounce(fn, ms = 250) {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), ms);
            };
        }

        // --- Filter logic: search + role ---
        function applyVaFilters() {
            const q = document.getElementById('vaSearch').value.toLowerCase().trim();
            const role = document.getElementById('vaRoleFilter').value;
            let visible = 0;

            document.querySelectorAll('#vaList > label').forEach(l => {
                const text = l.textContent.toLowerCase();
                const r = (l.querySelector('.va-check')?.dataset.role || '').trim();
                const roleMatch = !role || r === role;
                const textMatch = !q || text.includes(q);
                const show = roleMatch && textMatch;
                l.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            document.getElementById('vaVisibleCount').textContent = String(visible);
        }
        const debouncedApply = debounce(applyVaFilters, 120);

        // --- Select all visible ---
        function selectAllVisible() {
            let changed = false;
            document.querySelectorAll('#vaList > label').forEach(l => {
                if (l.style.display === 'none') return;
                const cb = l.querySelector('.va-check');
                if (cb && !cb.checked) {
                    cb.checked = true;
                    changed = true;
                }
            });
            if (changed) refreshVaSelectionSummary();
        }

        // --- Clear selection ---
        function clearSelected() {
            let changed = false;
            document.querySelectorAll('.va-check:checked').forEach(cb => {
                cb.checked = false;
                changed = true;
            });
            if (changed) refreshVaSelectionSummary();
        }

        // Hook up toolbar
        document.getElementById('vaSearch').addEventListener('input', debouncedApply);
        document.getElementById('vaRoleFilter').addEventListener('change', applyVaFilters);
        document.getElementById('btnSelectAllVisible').addEventListener('click', selectAllVisible);
        document.getElementById('btnClearSelected').addEventListener('click', clearSelected);

        // --- Override your summary to also toggle empty state ---
        function refreshVaSelectionSummary() {
            const chipsWrap = document.getElementById('vaSelectedChips');
            const countEl = document.getElementById('vaSelectedCount');
            const emptyEl = document.getElementById('vaSelectedEmpty');

            const cbs = [...document.querySelectorAll('.va-check:checked')];
            countEl.textContent = String(cbs.length);

            chipsWrap.innerHTML = '';
            cbs.forEach(cb => {
                const name = cb.getAttribute('data-name') || ('#' + cb.value);
                const email = cb.getAttribute('data-email') || '';
                const chip = document.createElement('span');
                chip.className =
                    'inline-flex items-center gap-1 px-2 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-xs';
                chip.innerHTML = `<i class="bi bi-person-badge"></i> ${name}
      <button type="button" class="ms-1 text-red-600 hover:text-red-700" title="Remove"
              onclick="uncheckVa(${Number(cb.value)})">
        <i class="bi bi-x-lg"></i>
      </button>`;
                chipsWrap.appendChild(chip);
            });

            emptyEl.style.display = cbs.length ? 'none' : '';
        }

        // uncheck via chip “x”
        function uncheckVa(id) {
            const cb = document.querySelector(`.va-check[value="${id}"]`);
            if (cb) {
                cb.checked = false;
                refreshVaSelectionSummary();
            }
        }

        // Keep summary in sync
        document.addEventListener('change', (e) => {
            if (e.target?.classList.contains('va-check')) refreshVaSelectionSummary();
        }, true);

        // Recalculate “visible count” initially
        document.addEventListener('DOMContentLoaded', applyVaFilters);
    </script>

</x-app-layout>
