@php
    /**
     * Auto-table component (universal).
     *
     * CONFIG (pass as $table):
     * [
     *   'id'         => 'clientTable',
     *   'ajax'       => string | [
     *                      'url'     => route('...'),
     *                      'method'  => 'POST'|'GET',
     *                      'headers' => ['X-CSRF-Token' => csrf_token()],
     *                      'data'    => [...],       // static data
     *                      'dataSrc' => 'data',      // key in JSON response
     *                   ],
     *   'rowLink'    => '/path/{id}',               // optional; click row to open (new tab)
     *   'order'      => [[0,'DESC']],               // DataTables default ordering
     *   'serverSide' => false,                      // set true for backend filtering/paging
     *   'pageLength' => 25,                         // default page size
     *   'persistState' => true,                     // keep state across reloads
     *
     *   // Optional dynamic filters (rendered above the table)
     *   'filters'   => [
     *       // type 'date_range' (ISO-friendly: rows should include created_at)
     *       ['type'=>'date_range', 'from'=>'created_from', 'to'=>'created_to', 'label'=>'Created'],
     *       // type 'select' (value->label map)
     *       ['type'=>'select', 'name'=>'role', 'label'=>'Role', 'options'=>['Administrator'=>'Administrator','Business Client'=>'Business Client','Associated Client'=>'Associated Client']],
     *       // type 'select' for boolean (0/1)
     *       ['type'=>'select', 'name'=>'isActived', 'label'=>'Status', 'options'=>[''=>'All','1'=>'Activated','0'=>'Deactivated']],
     *       // type 'text' (contains)
     *       ['type'=>'text', 'name'=>'company_q', 'label'=>'Company', 'placeholder'=>'e.g. Acme'],
     *   ],
     *
     *   // Columns (examples):
     *   // ['type'=>'checkbox','title'=>'','data'=>'id','width'=>'5px'],
     *   // ['type'=>'avatar_text','title'=>'Name','data'=>'name','avatar_field'=>'profile_photo_path','avatar_prefix'=>'/storage/','avatar_fallback'=>'/user.png','subtitle'=>'email'],
     *   // ['type'=>'email','title'=>'Email','data'=>'email'],
     *   // ['type'=>'date','title'=>'Created','data'=>'created_at','format'=>'MMM D, YYYY'],
     *   // ['type'=>'badge_map','title'=>'Role','data'=>'role','map'=>['Client'=>['label'=>'Business Client','icon'=>'bi-person-circle','class'=>'text-dark']]],
     *   // ['type'=>'boolean_badge','title'=>'Verified','data'=>'is_verified'],
     *   // ['type'=>'dropdown_actions','title'=>'Actions','data'=>'id','menu'=>[ ... ]],
     * ]
     */
    $id = $table['id'] ?? 'autoTable';
    $ajax = $table['ajax'] ?? '#';
    $rowLink = $table['rowLink'] ?? null;
    $columns = $table['columns'] ?? [];
    $order = $table['order'] ?? [];
    $filters = $table['filters'] ?? [];
    $serverSide = (bool) ($table['serverSide'] ?? false);
    $pageLength = (int) ($table['pageLength'] ?? 25);
    $persistState = (bool) ($table['persistState'] ?? true);
@endphp

<style>
    .custom-tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .custom-tooltip .tooltip-text {
        visibility: hidden;
        background-color: #222;
        /* Tooltip background */
        color: #fff;
        /* Tooltip text color */
        font-family: 'Arial', sans-serif;
        font-size: 12px;
        text-align: center;
        border-radius: 4px;
        padding: 4px 8px;
        position: absolute;
        z-index: 100;
        bottom: 120%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.2s ease-in-out;
        white-space: nowrap;
    }

    .custom-tooltip:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }

    tr {
        cursor: pointer;
    }
</style>

{{-- Expect jQuery + DataTables loaded in your layout --}}
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>

{{-- FILTERS BAR --}}
{{-- TOOLBAR: controls + filters (inline & responsive) --}}
{{-- TOOLBAR: full-width, inline & responsive --}}
<div id="{{ $id }}_toolbar" class="mb-3 w-full flex flex-wrap items-end gap-2 lg:flex-nowrap">

    {{-- Left: bulk actions + search --}}
    <div class="flex items-end gap-2 w-full sm:w-auto order-1">
        <select id="{{ $id }}_bulkAction" class="border rounded px-3 py-2">
            <option value="" disabled selected>Action</option>
            <option value="delete">🗑️ Move to Trash</option>
            <option value="export">📥 Export to CSV</option>
        </select>

        <button id="{{ $id }}_applyAction" class="bg-white text-dark px-4 py-2 rounded-sm border">
            <i class="bi bi-send"></i>
        </button>

        <div id="{{ $id }}_customSearchWrapper" class="inline-block"></div>
    </div>

    {{-- Middle: dynamic filters (flex-1 to fill remaining width) --}}
    @if (!empty($filters))
        <div id="{{ $id }}_filters" class="order-2 flex-1 min-w-0 flex flex-wrap items-end gap-2">

            @foreach ($filters as $f)
                @php $type = $f['type'] ?? 'text'; @endphp

                @if ($type === 'date_range')
                    <div class="inline-block">
                        <label class="block text-xs text-slate-500 mb-1">{{ $f['label'] ?? 'Date' }}</label>
                        <div class="flex items-center gap-2">
                            <input type="date" id="{{ $id }}_{{ $f['from'] ?? 'from' }}"
                                class="border rounded px-2 py-2 text-sm w-[11rem]">
                            <span class="text-slate-400">—</span>
                            <input type="date" id="{{ $id }}_{{ $f['to'] ?? 'to' }}"
                                class="border rounded px-2 py-2 text-sm w-[11rem]">
                        </div>
                    </div>
                @elseif($type === 'select')
                    <div class="inline-block">
                        {{-- <label
                            class="block text-xs text-slate-500 mb-1">{{ $f['label'] ?? ($f['name'] ?? 'Select') }}</label> --}}
                        <select id="{{ $id }}_{{ $f['name'] }}"
                            class="border rounded px-2 py-2 text-sm min-w-[12rem]">
                            <option value="" disabled selected>{{ $f['label'] ?? ($f['name'] ?? 'Select') }}</option>
                            @foreach ($f['options'] ?? [] as $val => $lbl)
                                <option value="{{ $val }}">{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif($type === 'text')
                    <div class="inline-block">
                        <label
                            class="block text-xs text-slate-500 mb-1">{{ $f['label'] ?? ($f['name'] ?? 'Text') }}</label>
                        <input type="text" id="{{ $id }}_{{ $f['name'] }}"
                            placeholder="{{ $f['placeholder'] ?? '' }}"
                            class="border rounded px-2 py-2 text-sm min-w-[14rem]" />
                    </div>
                @endif
            @endforeach
            @if (!empty($filters))
                <button id="{{ $id }}_applyFilters" style="height: 42px !important"
                    class="inline-flex items-center gap-2 rounded-sm border border-slate-300 bg-white px-3 py-2 text-sm font-medium hover:bg-slate-50">
                    <i class="bi bi-funnel"></i> Apply Filters
                </button>
                <button id="{{ $id }}_resetFilters"  style="height: 42px !important"
                    class="inline-flex items-center gap-2 rounded-sm border border-slate-300 bg-white px-3 py-2 text-sm font-medium hover:bg-slate-50">
                    <i class="bi bi-x-circle"></i> Reset
                </button>
            @endif
        </div>
    @endif

    {{-- Right: length + view toggle + filter actions --}}
    <div class="flex items-end gap-2 w-full sm:w-auto order-3 sm:ml-auto">


        <div id="{{ $id }}_customLengthWrapper" class="inline-block"></div>

        <div class="segment gap-2 bg-gray-100 dark:bg-gray-700 rounded-md p-1 inline-flex">
            <button class="segment-item h-10 py-2 segment-item-active text-xl px-3" type="button" title="Grid">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                    stroke-linejoin="round" height="1em" width="1em">
                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                    <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                    <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                    <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                </svg>
            </button>
            <button class="rounded-md bg-white segment-item h-10 py-2 text-xl px-3" type="button" title="List">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                    stroke-linejoin="round" height="1em" width="1em">
                    <path d="M9 6l11 0"></path>
                    <path d="M9 12l11 0"></path>
                    <path d="M9 18l11 0"></path>
                    <path d="M5 6l0 .01"></path>
                    <path d="M5 12l0 .01"></path>
                    <path d="M5 18l0 .01"></path>
                </svg>
            </button>
        </div>
    </div>

</div>



{{-- TABLE --}}
<div class="table-responsive-n">
    <table id="{{ $id }}"
        class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10">
                @foreach ($columns as $col)
                    @php
                        $thWidth = $col['width'] ?? null;
                        $align = $col['align'] ?? 'start';
                        $thClass = 'text-' . $align;
                    @endphp
                    <th class="{{ $thClass }}"
                        @if ($thWidth) style="width: {{ $thWidth }}" @endif>
                        {!! $col['title'] ?? '' !!}
                    </th>
                @endforeach
            </tr>
        </thead>
    </table>
</div>

<script>
    (function() {
        const TABLE_ID = @json($id);
        const RAW_AJAX = @json($ajax);
        const ROW_LINK = @json($rowLink);
        const COLS_CFG = @json($columns);
        const DEFAULT_ORDER = @json($order);
        const SERVER_SIDE = @json($serverSide);
        const PAGE_LENGTH = @json($pageLength);
        const PERSIST = @json($persistState);
        const FILTERS = @json($filters);

        // ---------- Helpers ----------
        function classAlign(align) {
            if (align === 'center') return 'text-center';
            if (align === 'end' || align === 'right') return 'text-end';
            return 'text-start';
        }

        function boldNumbersInInfo() {
            let info = $('.dataTables_info').html();
            info = info.replace(/(\d+)/g, '<strong>$1</strong>'); 
            $('.dataTables_info').html(info);
        }

        $('#{{ $id }}').on('draw.dt', function() {
            boldNumbersInInfo();
        });

        function stripHtml(html) {
            const div = document.createElement("div");
            div.innerHTML = html || '';
            return div.textContent || div.innerText || "";
        }

        function fillTpl(str, row) {
            if (!str) return '';
            return String(str)
                .replaceAll('{id}', row?.id ?? '')
                .replaceAll('{name}', (row?.name ?? '').replaceAll('"', '&quot;'))
                .replaceAll('{encrypted_id}', row?.encrypted_id ?? '')
                .replaceAll('{google_drive_id}', row?.google_drive_id ?? '');
        }

        function makeCsv(rows, headers) {
            const esc = v => (v == null) ? '' : `"${String(v).replace(/"/g,'""')}"`;
            const head = headers.map(esc).join(',');
            const body = rows.map(r => headers.map(h => esc(r[h])).join(',')).join('\n');
            return head + '\n' + body;
        }

        function downloadBlob(filename, mime, content) {
            const blob = new Blob([content], {
                type: mime
            });
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            URL.revokeObjectURL(a.href);
            a.remove();
        }

        // Pretty status/priority/stage helpers (edit to taste)
        function priorityStyles(pRaw) {
            const p = String(pRaw || '').toLowerCase();
            if (p === 'low') return {
                text: 'text-green-600',
                icon: 'ri-circle-line text-green-400',
                label: 'Low'
            };
            if (p === 'medium') return {
                text: 'text-blue-600',
                icon: 'ri-circle-line text-blue-400',
                label: 'Medium'
            };
            if (p === 'high') return {
                text: 'text-warning',
                icon: 'ri-circle-line text-warning',
                label: 'High'
            };
            if (p === 'critical') return {
                text: 'text-danger',
                icon: 'ri-circle-line text-danger',
                label: 'Critical'
            };
            return {
                text: 'text-gray-500',
                icon: 'ri-circle-line text-gray-400',
                label: (pRaw || 'Unknown')
            };
        }

        function statusStyles(sRaw) {
            const s = String(sRaw || '').toLowerCase();
            const map = {
                open: {
                    badge: 'bg-blue-100 text-blue-800 border-blue-200',
                    dot: 'bg-blue-400',
                    label: 'Open'
                },
                in_progress: {
                    badge: 'bg-green-100 text-green-800 border-green-200',
                    dot: 'bg-green-400',
                    label: 'In progress'
                },
                review: {
                    badge: 'bg-yellow-100 text-yellow-800 border-yellow-200',
                    dot: 'bg-yellow-400',
                    label: 'Review'
                },
                completed: {
                    badge: 'bg-gray-100 text-gray-800 border-gray-200',
                    dot: 'bg-gray-400',
                    label: 'Completed'
                },
                on_hold: {
                    badge: 'bg-orange-100 text-orange-800 border-orange-200',
                    dot: 'bg-orange-400',
                    label: 'On hold'
                },
                blocked: {
                    badge: 'bg-red-100 text-red-800 border-red-200',
                    dot: 'bg-red-400',
                    label: 'Blocked'
                },
            };
            if (map[s]) return map[s];
            const pretty = s ? s.replace(/_/g, ' ').replace(/\b\w/g, m => m.toUpperCase()) : 'Unknown';
            return {
                badge: 'bg-slate-100 text-slate-800 border-slate-200',
                dot: 'bg-slate-400',
                label: pretty
            };
        }

        function stageStyles(stRaw) {
            const s = String(stRaw || '').toLowerCase();
            const map = {
                planning: {
                    badge: 'bg-blue-100 text-blue-800 border-blue-200',
                    dot: 'bg-blue-400',
                    label: 'Planning'
                },
                in_progress: {
                    badge: 'bg-green-100 text-green-800 border-green-200',
                    dot: 'bg-green-400',
                    label: 'In progress'
                },
                review: {
                    badge: 'bg-yellow-100 text-yellow-800 border-yellow-200',
                    dot: 'bg-yellow-400',
                    label: 'Review'
                },
                completed: {
                    badge: 'bg-gray-100 text-gray-800 border-gray-200',
                    dot: 'bg-gray-400',
                    label: 'Completed'
                },
                on_hold: {
                    badge: 'bg-red-100 text-red-800 border-red-200',
                    dot: 'bg-red-400',
                    label: 'On hold'
                },
            };
            if (map[s]) return map[s];
            const pretty = s ? s.replace(/_/g, ' ').replace(/\b\w/g, m => m.toUpperCase()) : 'Unknown';
            return {
                badge: 'bg-slate-100 text-slate-800 border-slate-200',
                dot: 'bg-slate-400',
                label: pretty
            };
        }

        function progressFromStage(stRaw) {
            const s = String(stRaw || '').toLowerCase();
            if (s === 'completed') return {
                bar: 'bg-green-400',
                width: 'w-full',
                percent: '100%'
            };
            if (s === 'review') return {
                bar: 'bg-yellow-400',
                width: 'w-4/5',
                percent: '80%'
            };
            if (s === 'in_progress') return {
                bar: 'bg-blue-500',
                width: 'w-3/5',
                percent: '60%'
            };
            if (s === 'planning') return {
                bar: 'bg-blue-300',
                width: 'w-1/5',
                percent: '20%'
            };
            if (s === 'on_hold') return {
                bar: 'bg-red-300',
                width: 'w-1/5',
                percent: '20%'
            };
            return {
                bar: 'bg-gray-400',
                width: 'w-1/5',
                percent: '20%'
            };
        }

        // ---------- Column Factory ----------
        function buildDtColumns(cfgList) {
            return cfgList.map(cfg => {
                const type = cfg.type || 'text';
                const dataKey = cfg.data || null;
                const alignCls = classAlign(cfg.align);

                if (type === 'checkbox') {
                    return {
                        data: dataKey,
                        className: alignCls,
                        orderable: false,
                        render: (_, __, row) =>
                            `<input type="checkbox" class="rowCheckbox form-check-input mx-3" value="${row?.id ?? ''}">`
                    };
                }

                if (type === 'badge_map') {
                    const map = cfg.map || {};
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const raw = row?.[dataKey] ?? '';
                            const key1 = raw;
                            const key2 = String(raw);
                            const m = (map[key1] ?? map[key2]) || {
                                label: raw || 'Unknown',
                                icon: 'bi-question-circle',
                                class: 'text-muted'
                            };
                            return `<span class="badge m-w-80 text-[13px] ${m.class}">
              <i class="bi ${m.icon} me-2"></i>${stripHtml(m.label)}
            </span>`;
                        }
                    };
                }

                if (type === 'boolean_badge') {
                    const trueCfg = cfg.true || {
                        text: 'Verified',
                        cls: 'text-success',
                        icon: 'ri-circle-line'
                    };
                    const falseCfg = cfg.false || {
                        text: 'Unverified',
                        cls: 'text-danger',
                        icon: 'ri-circle-line'
                    };
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const v = row?.[dataKey];
                            const c = (v === 1 || v === true || v === '1') ? trueCfg : falseCfg;
                            return `<span class="font-medium ${c.cls} text-xs">
              <i class="${c.icon} font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>
              ${stripHtml(c.text)}
            </span>`;
                        }
                    };
                }

                if (type === 'avatar_text') {
                    const avatarStatic = cfg.avatar || '/user.png';
                    const avatarField = cfg.avatar_field || null;
                    const avatarPrefix = cfg.avatar_prefix || '';
                    const avatarFallback = cfg.avatar_fallback || '/user.png';
                    const subtitleField = cfg.subtitle || null;
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const text = row?.[dataKey] ?? '';
                            const subtitle = subtitleField ? (row?.[subtitleField] ?? '') : '';
                            const avatar = avatarField ? `${avatarPrefix}${row?.[avatarField] ?? ''}` :
                                avatarStatic;
                            return `
              <div class="flex items-center gap-3">
                <span class="avatar avatar-md avatar-rounded leading-none">
                  <img src="${avatar}" onerror="this.onerror=null;this.src='${avatarFallback}';" alt="">
                </span>
                <div class="leading-tight">
                  <span class="block font-medium">${stripHtml(text)}</span>
                  ${subtitle ? `<span class="block text-[12px] text-muted">${stripHtml(subtitle)}</span>` : ''}
                </div>
              </div>
            `;
                        }
                    };
                }

                if (type === 'text_muted') {
                    return {
                        data: dataKey,
                        className: (alignCls ? alignCls + ' ' : '') + 'text-muted',
                        render: (_, __, row) => `${row?.[dataKey] ?? ''}`
                    };
                }

                if (type === 'email') {
                    const ellipsis = parseInt(cfg.truncate || '0', 10);
                    return {
                        data: dataKey,
                        className: (alignCls ? alignCls + ' ' : '') + 'text-dark',
                        render: (_, __, row) => {
                            let email = row?.[dataKey] ?? '';
                            if (!email) return '';
                            if (ellipsis && email.length > ellipsis) {
                                const [user, domain = ''] = email.split('@');
                                const short = user.length > 8 ? (user.slice(0, 8) + '…') : user;
                                email = `${short}@${domain}`;
                            }
                            return `<span class="text-muted">${email}</span>`;
                        },
                    };
                }

                if (type === 'date') {
                    const fmt = cfg.format || 'MMM D, YYYY';
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const val = row?.[dataKey];
                            return val ? dayjs(val).format(fmt) : '—';
                        }
                    };
                }

                if (type === 'priority') {
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const s = priorityStyles(row?.[dataKey]);
                            return `
            <span class="font-medium ${s.text} text-xs">
              <i class="${s.icon} font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>
              ${s.label}
            </span>`;
                        }
                    };
                }

                if (type === 'status') {
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const s = statusStyles(row?.[dataKey]);
                            return `
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${s.badge}">
              <span class="w-1.5 h-1.5 rounded-full m-2 mx-2 ${s.dot}"></span>
              ${s.label}
            </span>`;
                        }
                    };
                }

                if (type === 'stage') {
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const s = stageStyles(row?.[dataKey]);
                            return `
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${s.badge}">
              <span class="w-1.5 h-1.5 rounded-full m-2 mx-2 ${s.dot}"></span>
              ${s.label}
            </span>`;
                        }
                    };
                }

                if (type === 'progress_from_stage') {
                    return {
                        data: dataKey,
                        className: alignCls,
                        render: (_, __, row) => {
                            const p = progressFromStage(row?.[dataKey]);
                            return `
            <div class="flex items-center">
              <div class="w-[100px] bg-gray-200 rounded-full h-3 mx-3">
                <div class="h-3 rounded-full ${p.bar} ${p.width}"></div>
              </div>
              <span class="text-md text-gray-600 font-medium">${p.percent}</span>
            </div>`;
                        }
                    };
                }

                if (type === 'dropdown_actions') {
                    const menu = Array.isArray(cfg.menu) ? cfg.menu : [];
                    return {
                        data: dataKey,
                        className: 'text-center w-4',
                        orderable: false,
                        searchable: false,
                        render: (_, __, row) => {
                            const items = menu.map(m => {
                                const icon = m.icon ?
                                    `<span class="${m.icon} text-lg"></span>` : '';
                                const label = `<span class="text-xs">${m.label || ''}</span>`;
                                const cls =
                                    'ti-dropdown-item flex items-center gap-2 ' +
                                    (m.danger ? 'text-danger hover:text-danger' :
                                        'text-slate-700 hover:bg-slate-100');
                                if (m.href)
                                return `<li><a href="${fillTpl(m.href, row)}" class="${cls}">${icon}${label}</a></li>`;
                                if (m.onclick)
                                return `<li><a onclick="${fillTpl(m.onclick, row)}" href="javascript:void(0);" class="${cls}">${icon}${label}</a></li>`;
                                if (m.overlay)
                                return `<li><a data-hs-overlay="${fillTpl(m.overlay, row)}" class="${cls}" href="javascript:void(0);">${icon}${label}</a></li>`;
                                return '';
                            }).join('');

                            return `
                              <div class="hs-dropdown relative inline-flex w-full justify-center ">
                                <button type="button"
                                        class="inline-flex items-center gap-1.5 rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300"
                                        aria-label="Row actions"
                                        data-hs-dropdown-placement="bottom-right">
                                  <i class="ri-more-2-fill text-base"></i>
                                  <span>More</span>
                                </button>
                                <ul class="hs-dropdown-menu shadow hidden absolute z-50 mt-1 min-w-[11rem] overflow-auto max-h-64 rounded-md border border-slate-200 bg-light p-1">
                                  ${items}
                                </ul>
                              </div>`;
                        }
                    };
                }

                // default 'text' with map support
                const truncate = parseInt(cfg.truncate || '0', 10);
                const prefix = cfg.prefix || '';
                const suffix = cfg.suffix || '';
                const mapObj = cfg.map || null;

                return {
                    data: dataKey,
                    className: alignCls,
                    render: (_, __, row) => {
                        let raw = row?.[dataKey];

                        if (mapObj) {
                            const k1 = raw;
                            const k2 = String(raw);
                            const mapped =
                                (Object.prototype.hasOwnProperty.call(mapObj, k1) ? mapObj[k1] :
                                    (Object.prototype.hasOwnProperty.call(mapObj, k2) ? mapObj[k2] :
                                        (Object.prototype.hasOwnProperty.call(mapObj, '*') ? mapObj[
                                            '*'] : undefined)));
                            if (typeof mapped !== 'undefined') return mapped;
                        }

                        let val = (raw ?? '');
                        if (truncate && String(val).length > truncate) {
                            val = String(val).slice(0, truncate - 1) + '…';
                        }
                        return `${prefix}${val}${suffix}`;
                    }
                };
            });
        }

        // ---------- Init ----------
        $(document).ready(function() {
            const ajaxCfg = (function(a) {
                if (typeof a === 'string') return {
                    url: a,
                    method: 'GET',
                    headers: {},
                    data: {},
                    dataSrc: 'data'
                };
                return {
                    url: a?.url ?? '#',
                    method: (a?.method ?? 'GET').toUpperCase(),
                    headers: a?.headers ?? {},
                    data: a?.data ?? {},
                    dataSrc: a?.dataSrc ?? 'data'
                };
            })(RAW_AJAX);

            const dt = $('#' + TABLE_ID).DataTable({
                processing: true,
                serverSide: SERVER_SIDE,
                stateSave: PERSIST,
                pageLength: PAGE_LENGTH,
                drawCallback: function() {
                    if (window.HSDropdown?.autoInit) HSDropdown.autoInit();
                },
                ajax: {
                    url: ajaxCfg.url,
                    type: ajaxCfg.method,
                    headers: ajaxCfg.headers,
                    data: function(d) {
                        // static data
                        Object.assign(d, ajaxCfg.data || {});
                        // if serverSide, push filters to server
                        if (SERVER_SIDE && Array.isArray(FILTERS)) {
                            FILTERS.forEach(f => {
                                const t = f.type || 'text';
                                if (t === 'date_range') {
                                    const fromKey = f.from || 'from';
                                    const toKey = f.to || 'to';
                                    d[fromKey] = ($('#' + TABLE_ID + '_' + fromKey)
                                    .val() || '').trim();
                                    d[toKey] = ($('#' + TABLE_ID + '_' + toKey).val() ||
                                        '').trim();
                                } else if (t === 'select' || t === 'text') {
                                    const name = f.name;
                                    if (name) d[name] = ($('#' + TABLE_ID + '_' + name)
                                        .val() || '').trim();
                                }
                            });
                        }
                    },
                    dataSrc: function(json) {
                        const key = ajaxCfg.dataSrc;
                        if (key && json && Object.prototype.hasOwnProperty.call(json, key))
                            return json[key] || [];
                        return Array.isArray(json) ? json : (json?.data || []);
                    },
                    error: function(xhr) {
                        console.error('AJAX Error:', xhr?.responseText || xhr?.statusText);
                    }
                },
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search here..."
                },
                columns: buildDtColumns(COLS_CFG),
                order: DEFAULT_ORDER,
                rowCallback: function(row, data) {
                    if (!ROW_LINK) return;
                    $(row).attr('data-href', fillTpl(ROW_LINK, data));
                },
                initComplete: function() {
                    const id = "#" + TABLE_ID;
                    $("#{{ $id }}_customSearchWrapper").html($(id + "_filter"));
                    $("#{{ $id }}_customLengthWrapper").html($(id + "_length"));
                }
            });

            // Client-side filter (if not serverSide)
            if (!SERVER_SIDE && Array.isArray(FILTERS) && FILTERS.length) {
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex, rowData) {
                    if (settings.nTable.id !== TABLE_ID) return true;

                    let pass = true;
                    FILTERS.forEach(f => {
                        if (!pass) return;
                        const t = f.type || 'text';

                        if (t === 'date_range') {
                            const fromKey = f.from || 'from';
                            const toKey = f.to || 'to';
                            const fromVal = ($('#' + TABLE_ID + '_' + fromKey).val() || '')
                                .trim();
                            const toVal = ($('#' + TABLE_ID + '_' + toKey).val() || '')
                                .trim();
                            const field = f.field || 'created_at'; // row field to compare
                            const iso = rowData?.[field] || null;
                            if (fromVal || toVal) {
                                if (!iso) {
                                    pass = false;
                                    return;
                                }
                                const d = dayjs(iso);
                                if (!d.isValid()) {
                                    pass = false;
                                    return;
                                }
                                if (fromVal && d.isBefore(dayjs(fromVal), 'day')) pass =
                                    false;
                                if (toVal && d.isAfter(dayjs(toVal), 'day')) pass = false;
                            }
                        }

                        if (t === 'select') {
                            const name = f.name;
                            const value = name ? ($('#' + TABLE_ID + '_' + name).val() ||
                                '').trim() : '';
                            if (value === '') return;
                            const field = f.field || name;
                            const rowVal = String(rowData?.[field] ?? '');
                            if (rowVal !== value) pass = false;
                        }

                        if (t === 'text') {
                            const name = f.name;
                            const q = name ? ($('#' + TABLE_ID + '_' + name).val() || '')
                                .trim().toLowerCase() : '';
                            if (!q) return;
                            const field = f.field || name;
                            const rowVal = String(rowData?.[field] ?? '').toLowerCase();
                            if (!rowVal.includes(q)) pass = false;
                        }
                    });
                    return pass;
                });

                $('#{{ $id }}_applyFilters').on('click', function() {
                    dt.draw();
                });
                $('#{{ $id }}_resetFilters').on('click', function() {
                    // reset all filter inputs
                    FILTERS.forEach(f => {
                        const t = f.type || 'text';
                        if (t === 'date_range') {
                            const fromKey = f.from || 'from';
                            const toKey = f.to || 'to';
                            $('#' + TABLE_ID + '_' + fromKey).val('');
                            $('#' + TABLE_ID + '_' + toKey).val('');
                        } else if (t === 'select' || t === 'text') {
                            const name = f.name;
                            if (name) $('#' + TABLE_ID + '_' + name).val('');
                        }
                    });
                    dt.draw();
                });
            } else {
                // serverSide apply/reset triggers reload
                $('#{{ $id }}_applyFilters').on('click', function() {
                    dt.ajax.reload();
                });
                $('#{{ $id }}_resetFilters').on('click', function() {
                    FILTERS.forEach(f => {
                        const t = f.type || 'text';
                        if (t === 'date_range') {
                            const fromKey = f.from || 'from';
                            const toKey = f.to || 'to';
                            $('#' + TABLE_ID + '_' + fromKey).val('');
                            $('#' + TABLE_ID + '_' + toKey).val('');
                        } else if (t === 'select' || t === 'text') {
                            const name = f.name;
                            if (name) $('#' + TABLE_ID + '_' + name).val('');
                        }
                    });
                    dt.ajax.reload();
                });
            }

            // Row click -> open in new tab (ignore controls)
            $(document).on('click', `#${TABLE_ID} tbody tr`, function(e) {
                if ($(e.target).closest(
                        'button, input[type="checkbox"], a, .ti-dropdown, .hs-dropdown').length)
                    return;
                const link = $(this).data('href');
                if (link) window.open(link, '_blank');
            });

            // Select all (scoped to this table)
            $(document).on('change', `#${TABLE_ID} #selectAll`, function() {
                const checked = this.checked;
                $(`#${TABLE_ID} .rowCheckbox`).prop('checked', checked);
            });

            // Bulk actions
            const $bulkAction = $(`#${TABLE_ID}_bulkAction`);
            const $applyBtn = $(`#${TABLE_ID}_applyAction`);
            $applyBtn.on('click', function() {
                const action = $bulkAction.val();
                if (!action) return;

                const ids = [];
                const selectedRows = [];
                $(`#${TABLE_ID} .rowCheckbox:checked`).each(function() {
                    const id = $(this).val();
                    ids.push(id);
                    const tr = $(this).closest('tr');
                    const rowData = dt.row(tr).data();
                    if (rowData) selectedRows.push(rowData);
                });

                if (!ids.length) {
                    alert('Please select at least one record.');
                    return;
                }

                if (action === 'delete') {
                    ids.forEach(id => {
                        if (typeof remove_data === 'function') remove_data(id,
                        'auto-table');
                    });
                }

                if (action === 'export') {
                    const headers = COLS_CFG.filter(c => c.data && !['dropdown_actions', 'checkbox']
                        .includes(c.type)).map(c => c.data);
                    const csvRows = selectedRows.map(r => {
                        const o = {};
                        headers.forEach(h => {
                            o[h] = r[h];
                        });
                        return o;
                    });
                    const csv = makeCsv(csvRows, headers);
                    const stamp = dayjs().format('YYYYMMDD_HHmmss');
                    downloadBlob(`export_${TABLE_ID}_${stamp}.csv`, 'text/csv;charset=utf-8;', csv);
                }

                // reset
                $bulkAction.val('');
                $(`#${TABLE_ID} #selectAll`).prop('checked', false);
                $(`#${TABLE_ID} .rowCheckbox`).prop('checked', false);
            });
        });
    })();
</script>
