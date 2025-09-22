@include('pages.actions.table-mod')
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
<div class="table-responsive-n">
    <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
        <thead>
            <tr class="border-b border-defaultborder dark:border-defaultborder/10" style="text-transform: uppercase">
                <th class="text-start" style="width: 5px">
                    <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                </th>
                <th scope="col" class="text-start">Project</th>
                <th scope="col" class="text-start">Due Date</th>
                <th scope="col" class="text-start">Stages</th>
                <th scope="col" class="text-start">Status</th>
                <th scope="col" class="text-start">Progress</th>
                <th scope="col" class="text-start" id="action_th">Actions</th>
            </tr>
        </thead>
    </table>
</div>


<!-- JavaScript -->
<script>
    $(document).on('click', '#clientTable tbody tr', function(e) {
        let $row = $(this);
        let link = $row.data('href');

        // Prevent redirection when clicking buttons, checkboxes, or links
        if (!$(e.target).closest('button, input[type="checkbox"], a').length) {
            //window.open(link, '_blank'); // Open link in a new tab
            window.location.href = link;
        }
    });

    $(document).ready(function() {
        let table = $('#clientTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('projects.fetch') }}",
                beforeSend: function() {
                    $("#customLoader").show();
                },
                complete: function() {
                    $("#customLoader").hide();
                }
            },
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here...",
            },
            columns: [{
                    data: 'id',
                    render: function(data) {
                        return `<input type='checkbox' class='rowCheckbox form-check-input mx-3' value='${data}'>`;
                    },
                    orderable: false
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        const member = row.team_members?.[0] || row.creator || row.manager;
                        const name = member?.name || 'Unknown';
                        const desc = row.description || '';
                        const stage = (row.stage || '').toLowerCase();

                        // Stage → Color mapping
                        let colorClass = "bg-blue-500"; // default
                        if (stage === "in_progress") {
                            colorClass = "bg-green-500";
                        } else if (stage === "review") {
                            colorClass = "bg-yellow-500";
                        } else if (stage === "completed") {
                            colorClass = "bg-gray-500";
                        } else if (stage === "planning") {
                            colorClass = "bg-blue-500";
                        } else if (stage === "on_hold") {
                            colorClass = "bg-red-500";
                        }

                        function stripHtml(html) {
                            let div = document.createElement("div");
                            div.innerHTML = html;
                            return div.textContent || div.innerText || "";
                        }

                        const cleanDesc = stripHtml(desc);

                        return `
                        <div class="flex items-center gap-4">
                            <div class="leading-none">                               
                                <span class="avatar avatar-md avatar-rounded ${colorClass} text-white flex items-center justify-center">
                                    ${row.name.charAt(0).toUpperCase()}
                                </span>
                            </div>
                            <div>
                                <span class="block font-medium">${row.name}</span>
                               <p class="text-xs text-gray-500 mt-1 force-gray">
                                    ${cleanDesc.length > 100 ? cleanDesc.substring(0, 100) + "..." : cleanDesc}
                                </p>
                            </div>
                        </div>
                        `;
                    }
                },

                {
                    data: 'due_date',
                    render: (data, type, row) => {
                        if (!row.due_date) {
                            return `<span class="text-gray-400">No due date</span>`;
                        }

                        const formatted = dayjs(row.due_date).format('MMM D, YYYY');
                        // Example: "Aug 19, 2025"

                        return `
                            <div class="flex items-center">
                                <span class="text-gray-500 text-xs mx-2">
                                    <i class="bi bi-calendar-event"></i></span
                                <span class="block font-medium text-muted">${formatted}</span>
                            </div>
                        `;
                    }
                },
                {
                    data: 'stage',
                    render: (data, type, row) => {
                        const stage = String(row.stage || '').toLowerCase();

                        const map = {
                            in_progress: {
                                badge: 'bg-green-100 text-green-800 border-green-200',
                                dot: 'bg-green-400',
                                label: 'In progress'
                            },
                            planning: {
                                badge: 'bg-blue-100 text-blue-800 border-blue-200',
                                dot: 'bg-blue-400',
                                label: 'Planning'
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
                            }
                        };

                        const cfg = map[stage] || {
                            badge: 'bg-red-100 text-red-800 border-red-200',
                            dot: 'bg-red-400',
                            label: stage ? stage.replace(/_/g, ' ').replace(/\b\w/g, m => m.toUpperCase()) : 'Unknown'
                        };

                        return `
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${cfg.badge}">
                                <span class="w-1.5 h-1.5 rounded-full m-2 mx-2 ${cfg.dot}"></span>
                                ${cfg.label}
                            </span>
                        `;
                    }
                },
                {
                    data: 'priority',
                    render: (data, type, row) => {
                        const priority = (row.priority || '').toLowerCase();

                        let textClass = "text-gray-500";
                        let iconClass = "ri-circle-line text-gray-400";
                        let label = "Unknown";

                        if (priority === "low") {
                            textClass = "text-green-600";
                            iconClass = "ri-circle-line text-green-400";
                            label = "Low";
                        } else if (priority === "medium") {
                            textClass = "text-blue-600";
                            iconClass = "ri-circle-line text-blue-400";
                            label = "Medium";
                        } else if (priority === "high") {
                            textClass = "text-warning";
                            iconClass = "ri-circle-line text-warning";
                            label = "High";
                        } else if (priority === "critical") {
                            textClass = "text-danger";
                            iconClass = "ri-circle-line text-danger";
                            label = "Critical";
                        }

                        return `
                            <span class="font-medium ${textClass} text-xs">
                                <i class="${iconClass} font-semibold text-[0.4375rem] me-2 leading-none align-middle"></i>
                                ${label}
                            </span>
                        `;
                    }
                },
                {
                    data: 'progress',
                    render: (data, type, row) => {
                        const stage = String(row.stage || '').toLowerCase();

                        let barClass = 'bg-gray-400';
                        let width = 'w-1/5';
                        let percent = '20%';

                        if (stage === 'completed') {
                            barClass = 'bg-green-400';
                            width = 'w-full';
                            percent = '100%';
                        } else if (stage === 'review') {
                            barClass = 'bg-yellow-400';
                            width = 'w-4/5';
                            percent = '80%';
                        } else if (stage === 'in_progress') {
                            barClass = 'bg-blue-500';
                            width = 'w-3/5';
                            percent = '60%';
                        }

                        return `
                            <div class="flex items-center">
                                <div class="w-[100px] bg-gray-200 rounded-full h-3 mx-3">
                                    <div class="h-3 rounded-full ${barClass} ${width}"></div>
                                </div>
                                <span class="text-md text-gray-600 font-medium">${percent}</span>
                            </div>
                        `;
                    }
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class='hstack gap-1 text-[.9375rem] text-center action-group' id='action-group-${row.id}'>
                            <a href='/project-management/${row.id}/dashboard' class='ti-btn ti-btn-sm ti-btn-soft-info bg-info/10 view-btn'><i class='bi bi-eye'></i></a>
                            <a onclick='remove_data(${row.id}, "user")' class='ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10 delete-btn'><i class='bi bi-trash'></i></a>
                        </div>`;
                    }
                }
            ],
            rowCallback: function(row, data) {
                $(row).attr('data-href', `/project-management/${data.id}/dashboard`);
            },
            initComplete: function() {
                $("#customSearchWrapper").html($("#clientTable_filter"));
                $("#customLengthWrapper").html($("#clientTable_length"));
            }
        });
    });
</script>


<style>
    #action_th {
        width: 80px !important;
    }

    .force-gray {
        color: #6b7280 !important;
        /* Tailwind gray-500 */
    }
</style>
