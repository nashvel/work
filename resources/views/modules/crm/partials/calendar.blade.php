<style>
    /* When the modal is shown (no .hidden), allow interactions */
    #chatDetails:not(.hidden),
    #chatDetails.hs-overlay-open {
        pointer-events: auto;
    }

    /* Keep Select2 on top */
    .select2-container,
    .select2-container .select2-dropdown {
        z-index: 10000 !important;
    }

    /* FullCalendar minimal Tailwind-like cosmetics (pure CSS, no @apply) */
    .fc {
        --fc-border-color: rgb(229 231 235);
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, Arial;
    }

    .fc .fc-toolbar-title {
        font-size: 1rem;
        font-weight: 600;
    }

    .fc .fc-button {
        background: #fff;
        border: 1px solid #d1d5db;
        color: #374151;
        font-size: .875rem;
        border-radius: .375rem;
        padding: .375rem .75rem;
        transition: background .15s ease;
    }

    .fc .fc-button:hover {
        background: #f9fafb;
    }

    .fc .fc-button.fc-button-primary {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
    }

    .fc .fc-button.fc-button-primary:hover {
        background: #1d4ed8;
    }

    .fc .fc-daygrid-day.fc-day-today {
        background: rgba(59, 130, 246, .08);
    }

    .fc .fc-timegrid-now-indicator-line {
        border-color: #ef4444;
    }

    .fc .fc-timegrid-now-indicator-arrow {
        border-top-color: #ef4444;
    }
</style>
<style>
    /* make list view rows inherit the bg color */
    .fc-list-event .fc-event-main {
        padding: 2px 6px;
        border-radius: 4px;
    }
</style>
<style>
    .sw-modal {
        max-width: 680px !important;
        width: 90% !important;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    .swal2-popup.sw-modal {
        height: auto !important;
        overflow: visible !important;
    }

    .sw-title {
        font-weight: 700 !important;
        font-size: 1.25rem !important;
        color: #111827 !important;
        margin-bottom: 10px;
    }

    /* Two-column balanced form */
    .sw-form {
        display: grid;
        grid-template-columns: 120px 1fr;
        /* fixed label col + flexible input col */
        gap: 10px 10px;
        /* 10px spacing */
        align-items: center;
        margin: 0;
        padding: 0;
    }

    .sw-form label {
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        text-align: right;
    }

    .sw-form input,
    .sw-form select,
    .sw-form textarea {
        width: 100% !important;
        box-sizing: border-box;
        color: #111827 !important;
        margin: 0;
    }

    /* For time row */
    .sw-row-time {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .swal2-html-container {
        margin: 0 !important;
        padding-right: 25px !important;
    }

    .swal2-title {
        padding: 0px !important;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }
</style>



<style>
    /* Soft color classes for month view */
    .status-pending {
        background-color: #FEF3C7 !important;
        border-color: #FDE68A !important;
        color: #111827 !important;
    }

    .status-done {
        background-color: #DCFCE7 !important;
        border-color: #BBF7D0 !important;
        color: #065F46 !important;
    }

    .status-close {
        background-color: #DBEAFE !important;
        border-color: #BFDBFE !important;
        color: #1E3A8A !important;
    }

    .status-unattended {
        background-color: #FFE4E6 !important;
        border-color: #FECDD3 !important;
        color: #7F1D1D !important;
    }

    /* Make month events look like soft pills */
    .fc-daygrid-event {
        border-width: 1px !important;
        border-style: solid !important;
        border-radius: 8px !important;
        padding: 2px 6px !important;
        font-weight: bold;
        line-height: 1.2;
    }

    /* Ensure month view shows only the title text nicely */
    .fc-daygrid-event .fc-event-title {
        white-space: nowrap;
    }

    /* In list view, we do NOT color the background; we only color the dot */
    .fc-list-event .fc-event-main {
        background: transparent !important;
        color: inherit !important;
    }

    /* Color the dot in list view by status */
    .fc-list-event .fc-list-event-dot.status-pending {
        border-color: #F59E0B !important;
        background-color: #F59E0B !important;
    }

    .fc-list-event .fc-list-event-dot.status-done {
        border-color: #16A34A !important;
        background-color: #16A34A !important;
    }

    .fc-list-event .fc-list-event-dot.status-close {
        border-color: #2563EB !important;
        background-color: #2563EB !important;
    }

    .fc-list-event .fc-list-event-dot.status-unattended {
        border-color: #DC2626 !important;
        background-color: #DC2626 !important;
    }

    /* Small helper for Swal “chip” preview */
    .chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid transparent;
    }

    .chip.pending {
        background: #FEF3C7;
        border-color: #FDE68A;
        color: #92400E;
    }

    .chip.done {
        background: #DCFCE7;
        border-color: #BBF7D0;
        color: #065F46;
    }

    .chip.close {
        background: #DBEAFE;
        border-color: #BFDBFE;
        color: #1E3A8A;
    }

    .chip.unattended {
        background: #FFE4E6;
        border-color: #FECDD3;
        color: #7F1D1D;
    }
</style>
<style>
    .swal2-container {
        z-index: 11050 !important;
    }

    /* above your modal overlay */
</style>
<style>
    /* Layout: left / centered title / right */
    .fc-tailwind-toolbar {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .toolbar-left {
        justify-self: start;
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .toolbar-center {
        justify-self: center;
    }

    .toolbar-right {
        justify-self: end;
        display: flex;
        gap: 8px;
        align-items: center;
    }

    /* Buttons */
    .tw-btn {
        border: 1px solid #d1d5db;
        background: #fff;
        padding: .375rem .75rem;
        border-radius: .375rem;
        font-size: .875rem;
        line-height: 1.25rem;
        color: #374151;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .375rem;
        cursor: pointer;
    }

    .tw-btn:hover {
        background: #f9fafb
    }

    .tw-toggle[aria-pressed="true"] {
        background: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }

    /* Badge */
    .tw-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 1.25rem;
        height: 1.25rem;
        padding: 0 .25rem;
        margin-left: .375rem;
        background: #111827;
        color: #fff;
        border-radius: 9999px;
        font-size: .75rem;
        line-height: 1rem;
    }

    /* Calendar look: black text & normal-weight events; hide FC header */
    .fc {
        color: #111827;
    }

    .fc a {
        color: inherit;
    }

    .fc .fc-daygrid-event {
        font-weight: 400;
    }

    .fc .fc-event-title,
    .fc .fc-list-event-title {
        font-weight: 400;
    }

    .fc .fc-toolbar {
        display: none !important;
    }

    /* ensure built-in header hidden */

    /* If you use soft status backgrounds, keep text readable */
    .status-pending,
    .status-done,
    .status-close,
    .status-unattended {
        color: #111827;
    }

    /* Color the list view dot (you already map classes): keep as-is */
</style>
<style>
  /* Legend layout (align right; tweak to start/center if you prefer) */
  .status-legend{
    display:flex; flex-wrap:wrap; gap:12px; justify-content:flex-end;
    align-items:center; margin-bottom:10px; color:#111827;
  }
  .status-legend .item{
    display:inline-flex; align-items:center; gap:6px; font-size:.875rem;
  }

  /* Month-view soft swatch (pastel) */
  .status-legend .swatch{
    width:16px; height:12px; border-radius:4px; border:1px solid transparent; display:inline-block;
  }
  .status-legend .swatch.pending    { background:#FEF3C7; border-color:#FDE68A; }
  .status-legend .swatch.done       { background:#DCFCE7; border-color:#BBF7D0; }
  .status-legend .swatch.close      { background:#DBEAFE; border-color:#BFDBFE; }
  .status-legend .swatch.unattended { background:#FFE4E6; border-color:#FECDD3; }

  /* List-view dot (solid) */
  .status-legend .dot{
    width:10px; height:10px; border-radius:9999px; display:inline-block;
  }
  .status-legend .dot.pending    { background:#F59E0B; }
  .status-legend .dot.done       { background:#16A34A; }
  .status-legend .dot.close      { background:#2563EB; }
  .status-legend .dot.unattended { background:#DC2626; }
</style>


<!-- Put this once in your layout head -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<!-- Tailwind toolbar (put this just above #calendarHost) -->
<div id="calendarToolbar" class="fc-tailwind-toolbar">
    <div class="toolbar-left">
        <button data-act="prev" class="tw-btn">« Prev</button>
        <button data-act="today" class="tw-btn">Today</button>
        <button data-act="next" class="tw-btn">Next »</button>
    </div>

    <div class="toolbar-center">
        <strong id="calTitle" class="cal-title text-2xl text-dark"></strong>
    </div>

    <div class="toolbar-right">
        <button data-view="dayGridMonth" class="tw-btn tw-toggle" aria-pressed="true">Month</button>
        <button data-view="listWeek" class="tw-btn tw-toggle">Weekly</button>
        <button data-view="listDay" id="btnTodaySchedules" class="tw-btn tw-toggle">
            Today
            <span id="todayBadge" class="tw-badge bg-danger">0</span>
        </button>
    </div>
</div>


<div id="calendarHost"></div>

<!-- Status Legend -->
<div id="statusLegend" class="status-legend mt-5">
  <span class="item">
    <span class="swatch pending"></span>
    <span class="dot pending"></span>
    Pending
  </span>
  <span class="item">
    <span class="swatch done"></span>
    <span class="dot done"></span>
    Done
  </span>
  <span class="item">
    <span class="swatch close"></span>
    <span class="dot close"></span>
    Close
  </span>
  <span class="item">
    <span class="swatch unattended"></span>
    <span class="dot unattended"></span>
    Unattended
  </span>
</div>

<script>
    (function() {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
        const calendarHost = document.getElementById('calendarHost');
        let calendar = null;

        // endpoints
        function ep(convId) {
            convId = (convId ?? '').toString();
            return {
                evList: `/chats/conversations/${convId}/schedule/events`,
                evCreate: `/chats/conversations/${convId}/schedule/events`,
                evUpdate: (id) => `/chats/conversations/${convId}/schedule/events/${id}`,
                evRemove: (id) => `/chats/conversations/${convId}/schedule/events/${id}`,
            };
        }

        // helpers
        const pad2 = n => String(n).padStart(2, '0');
        const fmtDateLabel = d => `${d.getFullYear()}-${pad2(d.getMonth()+1)}-${pad2(d.getDate())}`;
        const fmtTimeHHMM = d => `${pad2(d.getHours())}:${pad2(d.getMinutes())}`;
        const ok = (msg) => (window.Swal?.fire({
            icon: 'success',
            title: msg,
            timer: 1200,
            showConfirmButton: false
        }) || alert(msg));
        const err = (msg) => (window.Swal?.fire({
            icon: 'error',
            title: msg
        }) || alert(msg));

        // Title Case utility for event titles
        function toTitleCase(str = '') {
            return str.replace(/\w\S*/g, (txt) => txt.charAt(0).toUpperCase() + txt.slice(1).toLowerCase());
        }

        // --- improved Swal forms ---
        async function openCreateDialog(dateLabel, defaultFrom = '09:00', defaultTo = '10:00') {
            const htmlCreate = `
  <div class="sw-form">
    <label>Date : </label>
    <input class="swal2-input" value="${dateLabel}" disabled>

    <label class="hidden">Type : </label>
    <input id="evt-type" class="swal2-input hidden" placeholder="e.g., Meeting, Task">

    <label>Title : </label>
    <input id="evt-title" class="swal2-input" placeholder="Event title">

    <label>Time : </label>
    <div class="sw-row-time">
      <input id="evt-time-from" class="swal2-input" type="time" value="${defaultFrom}">
      <input id="evt-time-to" class="swal2-input" type="time" value="${defaultTo}">
    </div>

    <label>Status : </label>
    <select id="evt-status" class="swal2-input">
      <option value="pending" selected>Pending</option>
      <option value="done">Done</option>
      <option value="close">Close</option>
      <option value="unattended">Unattended</option>
    </select>

    <label>Description : </label>
    <textarea id="evt-desc" class="swal2-textarea" rows="3" placeholder="Notes"></textarea>
  </div>`;




            const {
                value
            } = await Swal.fire({
                title: 'Create Schedule',
                html: htmlCreate,
                customClass: {
                    popup: 'sw-modal',
                    title: 'sw-title'
                },
                didOpen: () => {
                    const sel = document.getElementById('evt-status');
                    const chip = document.getElementById('status-chip-create');
                    sel.addEventListener('change', () => {
                        chip.className = 'chip ' + sel.value;
                        chip.textContent = sel.options[sel.selectedIndex].text;
                    });
                },
                focusConfirm: false,
                preConfirm: () => {
                    const title = (document.getElementById('evt-title').value || '').trim();
                    const type = (document.getElementById('evt-type').value || '').trim();
                    const from = document.getElementById('evt-time-from').value;
                    const to = document.getElementById('evt-time-to').value;
                    const status = document.getElementById('evt-status').value || 'pending';
                    const desc = document.getElementById('evt-desc').value || null;
                    if (!title || !from) {
                        Swal.showValidationMessage('Title and From time are required');
                        return false;
                    }
                    if (to && to < from) {
                        Swal.showValidationMessage('End time must be after start time');
                        return false;
                    }
                    return {
                        title,
                        type,
                        from,
                        to,
                        status,
                        description: desc
                    };
                },
                confirmButtonText: 'Save',
                showCancelButton: true
            });
            return value || null;
        }

        async function openEditDialog(dateLabel, current) {
            const html = `
  <div class="sw-form">
    <label>Date : </label>
    <input class="swal2-input" value="${dateLabel}" disabled>

    <label class="hidden">Type : </label>
    <input id="evt-type" class="swal2-input hidden" value="${current.type || ''}" placeholder="e.g., Meeting, Task">

    <label>Title : </label>
    <input id="evt-title" class="swal2-input" value="${current.title || ''}" placeholder="Event title">

    <label>Time : </label>
    <div class="sw-row-time">
      <input id="evt-time-from" class="swal2-input" type="time" value="${current.from}">
      <input id="evt-time-to" class="swal2-input" type="time" value="${current.to || ''}">
    </div>

    <label>Status : </label>
    <select id="evt-status" class="swal2-input">
      <option value="pending" ${current.status==='pending'?'selected':''}>Pending</option>
      <option value="done" ${current.status==='done'?'selected':''}>Done</option>
      <option value="close" ${current.status==='close'?'selected':''}>Close</option>
      <option value="unattended" ${current.status==='unattended'?'selected':''}>Unattended</option>
    </select>

    <label>Description : </label>
    <textarea id="evt-desc" class="swal2-textarea" rows="3" placeholder="Notes">${current.description || ''}</textarea>
  </div>`;


            const res = await Swal.fire({
                title: 'Edit Schedule',
                html,
                didOpen: () => {
                    const sel = document.getElementById('evt-status');
                    const chip = document.getElementById('status-chip-edit');
                    sel.addEventListener('change', () => {
                        chip.className = 'chip ' + sel.value;
                        chip.textContent = sel.options[sel.selectedIndex].text;
                    });
                },
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: 'Delete',
                focusConfirm: false,
                preConfirm: () => {
                    const title = (document.getElementById('evt-title').value || '').trim();
                    const type = (document.getElementById('evt-type').value || '').trim();
                    const from = document.getElementById('evt-time-from').value;
                    const to = document.getElementById('evt-time-to').value;
                    const status = document.getElementById('evt-status').value || 'pending';
                    const desc = document.getElementById('evt-desc').value || null;
                    if (!title || !from) {
                        Swal.showValidationMessage('Title and From time are required');
                        return false;
                    }
                    if (to && to < from) {
                        Swal.showValidationMessage('End time must be after start time');
                        return false;
                    }
                    return {
                        title,
                        type,
                        from,
                        to,
                        status,
                        description: desc
                    };
                }
            });

            if (res.isDenied) return {
                action: 'delete'
            };
            if (!res.value) return {
                action: null
            };
            return {
                action: 'save',
                ...res.value
            };
        }

        // Status → CSS class (for month background & list dot)
        function statusClass(status) {
            switch ((status || '').toLowerCase()) {
                case 'done':
                    return 'status-done';
                case 'close':
                    return 'status-close';
                case 'unattended':
                    return 'status-unattended';
                default:
                    return 'status-pending';
            }
        }

        // apply server event to existing FullCalendar event & classes
        function applyServerEvent(evt, json) {
            const title = toTitleCase(json.title || '');
            evt.setProp('title', title);
            evt.setStart(json.start);
            evt.setEnd(json.end || null);
            const st = json.extendedProps?.status || 'pending';
            evt.setExtendedProp('status', st);

            // Update DOM classes for month view background
            const cls = statusClass(st);
            evt.setProp('classNames', [cls]);

            // For list view, color the dot
            const dot = evt.el?.querySelector?.('.fc-list-event-dot');
            if (dot) {
                dot.classList.remove('status-pending', 'status-done', 'status-close', 'status-unattended');
                dot.classList.add(cls);
            }
        }



        function initCalendar() {
            if (!calendarHost || calendar) return;

            calendar = new FullCalendar.Calendar(calendarHost, {
                height: 'auto',
                initialView: 'dayGridMonth',
                nowIndicator: true,
                navLinks: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEventRows: true,
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                timeZone: 'local',
                customButtons: {
                    monthView: {
                        text: '📅 Month',
                        click() {
                            calendar.changeView('dayGridMonth');
                        }
                    },
                    listView: {
                        text: '🧾 List',
                        click() {
                            calendar.changeView('listWeek');
                        }
                    },
                    todaySchedules: {
                        text: '📌 Today Schedules',
                        click() {
                            calendar.today();
                            calendar.changeView('listDay');
                        }
                    }
                },
                firstDay: 1,
                dayHeaderFormat: {
                    weekday: 'long'
                }, // Monday ... Sunday
                views: {
                    dayGridMonth: {
                        displayEventTime: false
                    },
                    listWeek: {
                        eventTimeFormat: {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true, // switch to 12h
                            meridiem: 'long', // AM/PM
                            omitZeroMinute: false // "10 PM" instead of "10:00 PM"
                        }
                    },
                    listDay: {
                        buttonText: 'Today Schedules',
                        eventTimeFormat: {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true,
                            meridiem: 'long',
                            omitZeroMinute: false
                        },
                    }
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                // Remove the built-in FC header
                headerToolbar: false,

                // headerToolbar: {
                //     left: 'prev,next today',
                //     center: 'title',
                //     right: 'dayGridMonth,listWeek,todaySchedules'
                // },
                buttonText: {
                    today: 'Today',
                    month: 'Calendar',
                    week: 'Week',
                    day: 'Day',
                    list: 'Schedules'
                },

                // Render title in Title Case (month/list). We keep only title markup here.
                eventContent: function(arg) {
                    const t = toTitleCase(arg.event.title || '');
                    return {
                        html: `<span class="fc-event-title fc-sticky">${t}</span>`
                    };
                },

                // Add proper classes & dot coloring when element mounts
                eventDidMount: function(arg) {
                    const st = arg.event.extendedProps?.status || 'pending';
                    const cls = statusClass(st);

                    // Month view: add bg class to the event element
                    if (!arg.view.type.startsWith('list')) {
                        arg.el.classList.add(cls);
                    } else {
                        // List view: colorize only the dot
                        const dot = arg.el.querySelector('.fc-list-event-dot');
                        if (dot) {
                            dot.classList.add(cls);
                        }
                    }
                },

                // Load from backend
                events: async (info, success, failure) => {
                    try {
                        const convId = window.ACTIVE_CONV_ID ?? 0;
                        const url = ep(convId).evList +
                            `?start=${info.startStr}&end=${info.endStr}`;
                        const res = await fetch(url, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();

                        // Normalize titles to Title Case before render
                        const normalized = (Array.isArray(data) ? data : []).map(e => {
                            e.title = toTitleCase(e.title || '');
                            // ensure class for month view background on initial load
                            const st = (e.extendedProps && e.extendedProps.status) ||
                                'pending';
                            e.classNames = [statusClass(st)];
                            return e;
                        });
                        success(normalized);
                    } catch (e) {
                        failure(e);
                    }
                },

                // Create
                select: async (arg) => {
                    const startDate = new Date(arg.start);
                    const dateLabel = fmtDateLabel(startDate);
                    const defaultFrom = arg.allDay ? '09:00' : fmtTimeHHMM(startDate);
                    const defaultTo = arg.allDay ? '10:00' : fmtTimeHHMM(new Date(startDate
                        .getTime() +
                        60 * 60000));

                    const values = await openCreateDialog(dateLabel, defaultFrom, defaultTo);
                    calendar.unselect();
                    if (!values) return;

                    try {
                        const convId = window.ACTIVE_CONV_ID ?? 0;
                        const payload = {
                            title: values.title,
                            type: values.type || null,
                            description: values.description || null,
                            date: dateLabel,
                            from: values.from,
                            to: values.to || null,
                            status: values.status
                        };

                        const res = await fetch(ep(convId).evCreate, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            body: JSON.stringify(payload)
                        });
                        if (!res.ok) {
                            const e = await res.json().catch(() => ({}));
                            return err(e.message || 'Failed to save schedule.');
                        }
                        const saved = await res.json();
                        saved.title = toTitleCase(saved.title || '');
                        saved.classNames = [statusClass(saved.extendedProps?.status || 'pending')];

                        const added = calendar.addEvent(saved);

                        // Color list dot if currently in list view
                        const dot = added.el?.querySelector?.('.fc-list-event-dot');
                        if (dot) dot.classList.add(statusClass(saved.extendedProps?.status ||
                            'pending'));

                        if (calendar.view?.type?.startsWith('list')) calendar.refetchEvents();
                        ok('Saved');
                    } catch (e) {
                        console.error(e);
                        err('Failed to save schedule.');
                    }
                },

                // Edit / Delete
                eventClick: async (info) => {
                    const evt = info.event;
                    const start = evt.start || new Date();
                    const end = evt.end || null;

                    const dateLabel = fmtDateLabel(start);
                    const current = {
                        title: evt.title || '',
                        type: evt.extendedProps?.type || '',
                        from: fmtTimeHHMM(start),
                        to: end ? fmtTimeHHMM(end) : '',
                        status: evt.extendedProps?.status || 'pending',
                        description: evt.extendedProps?.description || ''
                    };

                    const res = await openEditDialog(dateLabel, current);
                    if (!res || !res.action) return;

                    const convId = window.ACTIVE_CONV_ID ?? 0;

                    if (res.action === 'delete') {
                        try {
                            const del = await fetch(ep(convId).evRemove(evt.id), {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrf
                                }
                            });
                            if (!del.ok) return err('Delete failed.');
                            evt.remove();
                            ok('Deleted');
                        } catch (e) {
                            err('Delete failed.');
                        }
                        return;
                    }

                    // Save updates
                    try {
                        const payload = {
                            title: res.title,
                            type: res.type || null,
                            description: res.description || null,
                            date: dateLabel,
                            from: res.from,
                            to: res.to || null,
                            status: res.status
                        };
                        const r = await fetch(ep(convId).evUpdate(evt.id), {
                            method: 'PUT',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            body: JSON.stringify(payload)
                        });
                        if (!r.ok) return err('Update failed.');
                        const updated = await r.json();
                        applyServerEvent(evt, updated);
                        ok('Updated');
                    } catch (e) {
                        err('Update failed.');
                    }
                },

                // Drag/Resize persist (keep date exactly as shown)
                eventDrop: async (info) => {
                    const evt = info.event;
                    try {
                        const convId = window.ACTIVE_CONV_ID ?? 0;
                        const date = fmtDateLabel(evt.start);
                        const from = fmtTimeHHMM(evt.start);
                        const to = evt.end ? fmtTimeHHMM(evt.end) : null;
                        const payload = {
                            title: evt.title,
                            type: evt.extendedProps?.type || null,
                            description: evt.extendedProps?.description || null,
                            date,
                            from,
                            to,
                            status: evt.extendedProps?.status || 'pending'
                        };

                        const r = await fetch(ep(convId).evUpdate(evt.id), {
                            method: 'PUT',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            body: JSON.stringify(payload)
                        });
                        if (!r.ok) throw new Error('Update failed');
                        const updated = await r.json();
                        applyServerEvent(evt, updated);
                    } catch (e) {
                        info.revert();
                        err('Could not save new time.');
                    }
                },

                eventResize: async (info) => {
                    const evt = info.event;
                    try {
                        const convId = window.ACTIVE_CONV_ID ?? 0;
                        const date = fmtDateLabel(evt.start);
                        const from = fmtTimeHHMM(evt.start);
                        const to = evt.end ? fmtTimeHHMM(evt.end) : null;
                        const payload = {
                            title: evt.title,
                            type: evt.extendedProps?.type || null,
                            description: evt.extendedProps?.description || null,
                            date,
                            from,
                            to,
                            status: evt.extendedProps?.status || 'pending'
                        };

                        const r = await fetch(ep(convId).evUpdate(evt.id), {
                            method: 'PUT',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            body: JSON.stringify(payload)
                        });
                        if (!r.ok) throw new Error('Update failed');
                        const updated = await r.json();
                        applyServerEvent(evt, updated);
                    } catch (e) {
                        info.revert();
                        err('Could not save new duration.');
                    }
                },
            });

            calendar.render();
            wireToolbar(calendar);
        }

        function wireToolbar(calendar) {
            const bar = document.getElementById('calendarToolbar');
            if (!bar) return;

            // Helpers
            const pad2 = n => String(n).padStart(2, '0');
            const ymd = d => `${d.getFullYear()}-${pad2(d.getMonth()+1)}-${pad2(d.getDate())}`;

            function updateTitle() {
                const el = document.getElementById('calTitle');
                if (el) el.textContent = calendar.view.title || '';
            }

            function isSameOrBefore(a, b) {
                return a <= b;
            }

            function isSameOrAfter(a, b) {
                return a >= b;
            }

            function dateOnly(d) {
                return new Date(d.getFullYear(), d.getMonth(), d.getDate());
            }

            // Count schedules that occur today (local). Includes spanning events.
            function updateTodayBadge() {
                const badge = document.getElementById('todayBadge');
                if (!badge) return;

                const today = dateOnly(new Date());
                let count = 0;

                calendar.getEvents().forEach(evt => {
                    const s = evt.start ? dateOnly(evt.start) : null;
                    let e = evt.end ? dateOnly(evt.end) : null;

                    // If no end, treat as same-day
                    if (s && !e) {
                        e = s;
                    }

                    if (s && e && isSameOrBefore(s, today) && isSameOrAfter(e, today)) {
                        count++;
                    }
                });

                badge.textContent = String(count);
            }

            function syncToggles() {
                const active = calendar.view.type;
                bar.querySelectorAll('.tw-toggle').forEach(b => {
                    const isActive = b.getAttribute('data-view') === active;
                    b.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });
            }

            // Nav buttons
            bar.querySelector('[data-act="prev"]')?.addEventListener('click', () => {
                calendar.prev();
                updateTitle();
            });
            bar.querySelector('[data-act="today"]')?.addEventListener('click', () => {
                calendar.today();
                updateTitle();
                syncToggles();
            });
            bar.querySelector('[data-act="next"]')?.addEventListener('click', () => {
                calendar.next();
                updateTitle();
            });

            // View buttons
            bar.querySelectorAll('[data-view]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const view = btn.getAttribute('data-view');
                    if (view === 'listDay') {
                        calendar.today();
                    } // jump to today for "Today Schedules"
                    calendar.changeView(view);
                    updateTitle();
                    syncToggles();
                });
            });

            // Keep title/toggles/badge up-to-date as the calendar changes
            calendar.on('datesSet', () => {
                updateTitle();
                syncToggles();
                updateTodayBadge();
            });
            calendar.on('eventsSet', () => {
                updateTodayBadge();
            }); // after events load/refetch

            // Initial
            updateTitle();
            syncToggles();
            updateTodayBadge();
        }


        // When you create/update/delete events in code, call this to refresh the badge:
        function refreshTodayBadge() {
            const ev = new Event('eventsSet');
            // trigger our listener by dispatching a synthetic event handler,
            // or simply call the same function if you exposed it.
        }
        // (Alternatively, after add/remove/refetch, just call calendar.batchRendering(()=>{}); and wireToolbar handles eventsSet.)


        // init
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCalendar);
        } else {
            initCalendar();
        }
    })();
</script>
