<div class="container mx-auto">

    <div class="md:w-1/4 w-full bg-gray-50 p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-3">Today’s Schedule</h3>
        <ul id="today-events" class="space-y-2 text-sm text-gray-700"></ul>
    </div>

    <h1 class="text-xl font-bold mb-4">My Calendar</h1>
    <div id="calendar" class="bg-white shadow rounded p-4"></div>
</div>

<!-- FullCalendar CDN -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<!-- Modal Styles -->
<style>
    #eventModal {
        display: none;
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -20%);
        z-index: 9999;
        background: white;
        border: 1px solid #ccc;
        padding: 20px;
        width: 300px;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    }

    .fc-event,
    .fc-event-time,
    .fc-event-title {
        color: #fff !important;
    }

    .fc-event {
        text-transform: uppercase;
    }
</style>

<!-- Custom Event Modal -->
<div id="eventModal">
    <h3 class="text-lg font-bold mb-2">New Event</h3>
    <form id="eventForm">
        <input type="text" id="modal-title" class="w-full border p-2 mb-2 rounded" placeholder="Event Title"
            required>
        <textarea id="modal-description" class="w-full border p-2 mb-2 rounded" placeholder="Description"></textarea>

        <label class="block text-sm mb-1">Color</label>
        <input type="color" id="modal-color" class="w-full mb-3">

        <label class="block text-sm font-medium mb-1">Font Color</label>
        <input type="color" id="modal-font-color" class="w-full mb-3" value="#ffffff">

        <label>Start Time</label>
        <input type="datetime-local" id="modal-start" class="w-full mb-2" required>

        <label>End Time</label>
        <input type="datetime-local" id="modal-end" class="w-full mb-4">

        <label>Meeting Link (optional)</label>
        <input type="url" id="modal-link" class="w-full mb-2 rounded border p-2"
            placeholder="https://meet.hillbcs.com/code..." />

        <label class="inline-flex items-center mb-4">
            <input type="checkbox" id="modal-appointment" class="mr-2" />
            Mark as Appointment
        </label>

        <div class="flex justify-end gap-2">
            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Save</button>
            <button type="button" id="cancelModal" class="text-gray-500 px-3 py-1">Cancel</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const modal = document.getElementById('eventModal');
        const form = document.getElementById('eventForm');
        const cancelBtn = document.getElementById('cancelModal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

        const modalFields = {
            title: document.getElementById('modal-title'),
            description: document.getElementById('modal-description'),
            color: document.getElementById('modal-color'),
            fontColor: document.getElementById('modal-font-color'),
            start: document.getElementById('modal-start'),
            end: document.getElementById('modal-end'),
            link: document.getElementById('modal-link'),
            appointment: document.getElementById('modal-appointment'),
        };

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            editable: true,
            selectable: true,
            selectMirror: true,
            nowIndicator: true,
            slotMinTime: "06:00:00",
            slotMaxTime: "22:00:00",
            eventDisplay: 'block',
            dayMaxEventRows: true,
            // timeZone: 'local',

            eventDidMount: function(info) {
                const titleEl = info.el.querySelector('.fc-event-title');
                const timeEl = info.el.querySelector('.fc-event-time');

                if (timeEl && info.event.start) {
                    const localTime = new Date(info.event.start);
                    const formatted = localTime.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true,
                    });
                    timeEl.innerText = formatted;
                }

                if (titleEl && info.event.extendedProps.text_color) {
                    titleEl.style.color = info.event.extendedProps.text_color;
                }

                if (titleEl) {
                    titleEl.style.display = 'none';
                }
            },

            events: function(fetchInfo, successCallback) {
                fetch('/calendar-events')
                    .then(res => res.json())
                    .then(data => {
                        const formatted = data.map(event => ({
                            id: event.id,
                            title: event.title,
                            start: event.start_time,
                            end: event.end_time,
                            color: event.color || '#3b82f6',
                            textColor: event.text_color || '#ffffff',
                            extendedProps: {
                                description: event.description,
                                meeting_link: event.meeting_link,
                                is_appointment: event.is_appointment,
                                text_color: event.text_color
                            }
                        }));
                        renderTodayEvents(formatted);
                        successCallback(formatted);
                    });
            },

            select: function(info) {
                const start = new Date(info.start);
                const end = new Date(start);
                end.setHours(start.getHours() + 8);

                const format = (d) => d.toISOString().slice(0, 16);

                form.reset();
                delete form.dataset.editing;

                modalFields.start.value = format(start);
                modalFields.end.value = format(end);

                modal.style.display = 'block';
                modalFields.title.focus();
            },

            eventClick: function(info) {
                const props = info.event.extendedProps;

                Swal.fire({
                    title: info.event.title,
                    html: `
                    <div class="text-left">
                        <p><b>Description:</b> ${props.description || 'N/A'}</p>
                        <p><b>Meeting:</b> ${props.meeting_link || 'None'}</p>
                        <p><b>Type:</b> ${props.is_appointment ? 'Appointment' : 'Event'}</p>
                        <p><b>Start:</b> ${info.event.start.toLocaleString()}</p>
                        ${info.event.end ? `<p><b>End:</b> ${info.event.end.toLocaleString()}</p>` : ''}
                    </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'Edit',
                    cancelButtonText: 'Close',
                    showDenyButton: true,
                    denyButtonText: 'Delete',
                    icon: 'info'
                }).then(result => {
                    if (result.isConfirmed) {
                        openEditModal(info.event);
                    } else if (result.isDenied) {
                        confirmDelete(info.event.id);
                    }
                });
            },

            eventDrop: function(info) {
                updateEventTime(info.event);
            },

            eventResize: function(info) {
                updateEventTime(info.event);
            }
        });

        calendar.render();

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const data = {
                title: modalFields.title.value,
                description: modalFields.description.value,
                color: modalFields.color.value,
                text_color: modalFields.fontColor.value,
                meeting_link: modalFields.link.value,
                is_appointment: modalFields.appointment.checked,
                start_time: modalFields.start.value,
                end_time: modalFields.end.value || null,
            };

            const eventId = form.dataset.editing;
            const method = eventId ? 'PUT' : 'POST';
            const url = eventId ? `/calendar-events/${eventId}` : '/calendar-events';

            fetch(url, {
                method,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(res => {
                if (res.ok) {
                    calendar.refetchEvents();
                    modal.style.display = 'none';
                    form.reset();
                    delete form.dataset.editing;
                    Swal.fire({
                        icon: 'success',
                        title: eventId ? 'Updated!' : 'Saved!',
                        text: eventId ? 'Event updated.' : 'Event added.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });

        cancelBtn.addEventListener('click', function() {
            modal.style.display = 'none';
            form.reset();
            delete form.dataset.editing;
        });

        function updateEventTime(event) {
            fetch(`/calendar-events/${event.id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    start_time: event.start.toISOString(),
                    end_time: event.end ? event.end.toISOString() : null
                })
            }).then(() => calendar.refetchEvents());
        }

        function openEditModal(event) {
            const format = (d) => d.toISOString().slice(0, 16);

            form.dataset.editing = event.id;
            modalFields.title.value = event.title;
            modalFields.description.value = event.extendedProps.description || '';
            modalFields.color.value = event.backgroundColor || event.color || '#3b82f6';
            modalFields.fontColor.value = event.extendedProps.text_color || '#ffffff';
            modalFields.link.value = event.extendedProps.meeting_link || '';
            modalFields.appointment.checked = event.extendedProps.is_appointment || false;
            modalFields.start.value = format(event.start);
            modalFields.end.value = event.end ? format(event.end) : '';

            modal.style.display = 'block';
            modalFields.title.focus();
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Delete this event?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/calendar-events/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }).then(() => {
                        calendar.refetchEvents();
                        Swal.fire('Deleted!', 'The event has been removed.', 'success');
                    });
                }
            });
        }

        function renderTodayEvents(events) {
            const container = document.getElementById('today-events');
            if (!container) return;

            container.innerHTML = '';
            const today = new Date().toISOString().split('T')[0];

            const todaysEvents = events.filter(e => e.start.startsWith(today));
            if (todaysEvents.length === 0) {
                container.innerHTML = '<li>No events today.</li>';
                return;
            }

            todaysEvents.forEach(e => {
                const time = new Date(e.start).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
                container.innerHTML += `<li><b>${time}</b> - ${e.title}</li>`;
            });
        }
    });
</script>
