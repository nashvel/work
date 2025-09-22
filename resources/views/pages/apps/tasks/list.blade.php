@php
    use Carbon\Carbon;
    $lead = App\Models\Lead::where('email', Auth::user()->email)
        ->select('id')
        ->first();

    if (Auth::user()->role == 'Virtual Assistant') {
        $clientId = Auth::user()->company;
    } else {
        $clientId = $lead->id;
    }

    $clients = App\Models\Task::select('*')
        ->get()
        ->map(function ($client) {
            return [
                'id' => $client->task_id ?: 'N/A',
                'task' => $client->task_name ?: 'N/A',
                'date' => Carbon::parse($client->assigned_date)->diffForHumans() ?: 'N/A',
                'status' => $client->status ?: 'N/A',
                'due' => date_format(date_create($client->due_date), 'D, M. d, Y') ?: 'N/A',
                'priority' => $client->priority ?: 'N/A',
                'assigned' => is_array($client->assigned_to)
                    ? $client->assigned_to
                    : explode(',', $client->assigned_to ?? ''),
            ];
        });

@endphp
<style>
    .gridjs-table tbody tr {
        padding: 1px 1px;
        height: 5px;
    }
</style>
<script src="/assets/libs/gridjs/gridjs.umd.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const clients = @json($clients);

        // Ensure each row matches the correct column index
        const data = clients.map(task => [
            [task.task, task.date],
            task.status,
            task.due,
            task.priority,
            Array.isArray(task.assigned) ? task.assigned : (task.assigned !== 'N/A' ? [task.assigned] :
                []),
        ]);

        console.log("Grid Data:", data); // Debugging

        new gridjs.Grid({
            columns: [{
                name: "Assign Task Information",
                formatter: (cell, row) => gridjs.html(`
                    <div class="flex items-center gap-2">
                        <div>
                            <a data-bs-toggle="offcanvas" data-hs-overlay="#offcanvasExample">
                                <span class="block font-medium text-[14px]">${cell[0]}</span>
                            </a>
                            <div class="hs-tooltip ti-main-tooltip">
                                <span class="block text-textmuted dark:text-textmuted/50 text-[11px]">
                                   ${cell[1]}
                                </span>
                            </div>
                        </div>                                    
                    </div>
                `)
            }, {
                name: "Status",
                width: "100px",
                formatter: (cell) => {
                    let statusColor = "text-gray-500"; // Default color

                    if (cell === "In Progress") {
                        statusColor = "text-primary"; // Change color for "In Progress"
                    } else if (cell === "Completed") {
                        statusColor = "text-success"; // Example: Green for "Completed"
                    } else if (cell === "Pending") {
                        statusColor = "text-warning"; // Example: Red for "Pending"
                    }

                    return gridjs.html(`
                            <span class="block mb-1">
                                <span class="font-medium ${statusColor}">${cell}</span>
                            </span>
                        `);
                }
            }, {
                name: "Due Date",
                width: "120px",
                formatter: (cell) => gridjs.html(`
                     <span class="block mb-1">
                        ${cell}
                    </span>
                `)
            }, {
                name: "Priority",
                width: "70px",
                formatter: (cell) => {
                    let priorityColor = "bg-gray-200 text-gray-700"; // Default style

                    if (cell === "Low") {
                        priorityColor = "text-primary"; // 🟢 Green for Low
                    } else if (cell === "Medium") {
                        priorityColor = "text-info"; // 🟡 Yellow for Medium
                    } else if (cell === "High") {
                        priorityColor = "text-danger"; // 🟠 Orange for High
                    } else if (cell === "Critical") {
                        priorityColor = "text-danger"; // 🔴 Red for Critical
                    }

                    return gridjs.html(`
                            <span class="badge bg-secondary/10 ${priorityColor} ">
                                ${cell}
                            </span>
                        `);
                }
            }, {
                name: "Assigned To",
                width: "100px",
                formatter: (cell) => {
                    console.log("Assigned Data:", cell); // Debugging output

                    if (!Array.isArray(cell) || cell.length === 0) {
                        return gridjs.html(`<span class="text-gray-500">N/A</span>`);
                    }

                    return gridjs.html(`
                            <span class="block mb-1">
                                ${cell.map(() => `
                                    <span class="avatar avatar-sm avatar-rounded">
                                        <img src="/user.png" alt="User">
                                    </span>
                                `).join('')}
                            </span>
                        `);
                }
            }, {
                name: gridjs.html(`<center>Actions</center>`),
                width: "100px",
                formatter: (cell) => gridjs.html(`
                    <div class="btn-list">
                        <center>
                            <a href="/client/view/${cell}" class="ti-btn ti-btn-sm ti-btn-soft-primary ti-btn-icon !mb-0">
                                <i class="ri-eye-line"></i>
                            </a>
                            <button class="ti-btn ti-btn-sm ti-btn-soft-info ti-btn-icon !mb-0">
                                <i class="ri-pencil-line"></i>
                            </button>                            
                            <button class="ti-btn ti-btn-sm ti-btn-soft-danger ti-btn-icon contact-delete !mb-0" data-id="${cell}">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </center>
                    </div>
                `)
            }],
            pagination: true,
            search: true,
            sort: true,
            data: () => {
                return new Promise(resolve => {
                    setTimeout(() => resolve(data), 500);
                });
            }
        }).render(document.getElementById("grid-loading"));
    });
</script>
