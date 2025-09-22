<div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6 mb-8">

    <!-- Tasks Overview -->
    <div class="bg-blue-50 overflow-hidden border border-blue-200 rounded-lg border-sm" style="background-color: #eff6ff; border-color: #bfdbfe;">
        <div class="p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2
                            2 0 002 2h8a2 2 0 002-2V7a2
                            2 0 00-2-2h-2M9 5a2 2 0
                            002 2h2a2 2 0 002-2M9 5a2
                            2 0 012-2h2a2 2 0 012
                            2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-600  mx-3">Tasks Completed</dt>
                    <dd class="text-lg font-semibold text-gray-900   mx-3">
                        {{ $stats['completed_tasks'] }}/{{ $stats['total_tasks'] }}
                    </dd>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full"
                        style="width: {{ $stats['total_tasks'] > 0 ? ($stats['completed_tasks'] / $stats['total_tasks']) * 100 : 0 }}%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Budget Overview -->
    <div class="bg-green-50 overflow-hidden border border-green-200 rounded-lg border-sm" style="background-color: #f0fdf4; border-color: #bbf7d0;">
        <div class="p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3
                            2s1.343 2 3 2 3 .895 3
                            2-1.343 2-3 2m0-8c1.11 0
                            2.08.402 2.599 1M12
                            8V7m0 1v8m0 0v1m0-1c-1.11
                            0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                @php
                    $totalExpenses = DB::table('sheets_project_management')
                        ->selectRaw('SUM(amt * qty) AS total_expenses')
                        ->fromSub(function ($q) use ($project) {
                            $q->from('sheets_project_management')
                                ->selectRaw(
                                    "
                                    row_index,
                                    COALESCE(MAX(CASE WHEN column_index = 1 THEN CAST(REPLACE(value, ',', '') AS DECIMAL(18,4)) END), 0) AS amt,
                                    COALESCE(MAX(CASE WHEN column_index = 2 THEN CAST(REPLACE(value, ',', '') AS DECIMAL(18,4)) END), 0) AS qty
                                ",
                                )
                                ->where('proj_id', $project->id)
                                ->groupBy('row_index');
                        }, 't')
                        ->value('total_expenses');
                @endphp
                <div class="ml-4 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-600  mx-3">Net Profit</dt>
                    <dd class="text-lg font-semibold text-dark  mx-3">
                        ${{ number_format($project->budget - $totalExpenses, 2) }}
                    </dd>
                </div>
            </div>
            <div class="mt-2 text-sm text-gray-600">
                Contract: <span class="text-success">${{ number_format($project->budget, 2) }}</span> |
                Expenses: <span class="text-danger">${{ number_format($totalExpenses, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Team Members -->
    <div class="bg-purple-50 overflow-hidden border border-purple-200 rounded-lg border-sm" style="background-color: #faf5ff; border-color: #d8b4fe;">
        <div class="p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0
                            00-5.356-1.857M17 20H7m10
                            0v-2c0-.656-.126-1.283-.356-1.857M7
                            20H2v-2a3 3 0 015.356-1.857M7
                            20v-2c0-.656.126-1.283.356-1.857m0
                            0a5.002 5.002 0 019.288
                            0M15 7a3 3 0 11-6 0 3
                            3 0 016 0zm6 3a2 2 0 11-4
                            0 2 2 0 014 0zM7 10a2 2 0
                            11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 mx-3">Assigned Team</dt>
                    <dd class="text-lg font-semibold text-gray-900 mx-3">
                        {{ $stats['team_members'] }}
                    </dd>
                </div>
            </div>
        </div>
    </div>

    <!-- Overdue Tasks -->
    <div class="bg-red-50 overflow-hidden border border-red-200 rounded-lg border-sm" style="background-color: #fef2f2; border-color: #fecaca;">
        <div class="p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0
                            4h.01M21 12a9 9 0 11-18
                            0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-700 mx-3">Overdue Tasks</dt>
                    <dd class="text-lg font-semibold text-danger mx-3">
                        {{ $stats['overdue_tasks'] }}
                    </dd>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="xl:col-span-9 col-span-9">
        <div class="col-span-9">
            <!-- Recent Tasks -->
            <div class="bg-white border rounded-lg mb-5" style="min-height: 165px">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Recent Tasks</h3>
                        @if ($project->tasks->count() > 3)
                            <div class="flex items-center gap-2">
                                <button onclick="prevTaskPage()" id="prevTaskBtn" class="p-1 text-gray-400 hover:text-gray-600 disabled:opacity-50" disabled>
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <span id="taskPageInfo" class="text-sm text-gray-500">1 of {{ ceil($project->tasks->count() / 3) }}</span>
                                <button onclick="nextTaskPage()" id="nextTaskBtn" class="p-1 text-gray-400 hover:text-gray-600">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    @if ($project->tasks->count() > 0)
                        @php
                            $allTasks = $project->tasks->sortByDesc('created_at');
                            $tasksArray = $allTasks->values()->all();
                        @endphp
                        <div id="tasksContainer" class="space-y-4">
                            @foreach ($allTasks as $index => $task)
                                <div class="task-item" data-page="{{ floor($index / 3) + 1 }}" 
                                     style="{{ $index >= 3 ? 'display: none;' : '' }}">
                                    <div class="flex items-center justify-between p-4 border rounded-lg transition-all hover:shadow-md"
                                         style="@if ($task->priority === 'critical') background-color: #fef2f2; border-color: #fecaca;
                                                @elseif($task->priority === 'high') background-color: #fff7ed; border-color: #fed7aa;
                                                @elseif($task->priority === 'medium') background-color: #fefce8; border-color: #fde047;
                                                @elseif($task->priority === 'low') background-color: #eff6ff; border-color: #bfdbfe;
                                                @else background-color: #f9fafb; border-color: #e5e7eb; @endif">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            @if ($task->status === 'completed') bg-green-100 text-green-800
                                                            @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                                            @elseif($task->status === 'review') bg-yellow-100 text-yellow-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $task->title }}</p>
                                                <p class="text-sm text-gray-500">
                                                    @if ($task->assignedUser)
                                                        Assigned to {{ $task->assignedUser->name }}
                                                    @else
                                                        Unassigned
                                                    @endif
                                                    @if ($task->due_date)
                                                        • Due {{ $task->due_date->format('M j') }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if ($task->priority === 'critical') bg-red-100 text-red-800
                                                        @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                                                        @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No tasks created yet.</p>
                    @endif
                </div>
            </div>

            <script>
            let currentTaskPage = 1;
            const tasksPerPage = 3;
            const totalTasks = {{ $project->tasks->count() }};
            const totalPages = Math.ceil(totalTasks / tasksPerPage);

            function showTaskPage(page) {
                document.querySelectorAll('.task-item').forEach(item => {
                    item.style.display = 'none';
                });
                
                document.querySelectorAll(`.task-item[data-page="${page}"]`).forEach(item => {
                    item.style.display = 'block';
                });
                
                document.getElementById('taskPageInfo').textContent = `${page} of ${totalPages}`;
                
                document.getElementById('prevTaskBtn').disabled = page === 1;
                document.getElementById('nextTaskBtn').disabled = page === totalPages;
                
                if (page === 1) {
                    document.getElementById('prevTaskBtn').classList.add('opacity-50');
                } else {
                    document.getElementById('prevTaskBtn').classList.remove('opacity-50');
                }
                
                if (page === totalPages) {
                    document.getElementById('nextTaskBtn').classList.add('opacity-50');
                } else {
                    document.getElementById('nextTaskBtn').classList.remove('opacity-50');
                }
            }

            function nextTaskPage() {
                if (currentTaskPage < totalPages) {
                    currentTaskPage++;
                    showTaskPage(currentTaskPage);
                }
            }

            function prevTaskPage() {
                if (currentTaskPage > 1) {
                    currentTaskPage--;
                    showTaskPage(currentTaskPage);
                }
            }
            </script>

            <!-- Project Progress Chart -->
            <div class="bg-white border rounded-lg mb-5">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Project Progress</h3>
                </div>
                <div class="p-6">
                    @php
                        $totalTasks = $project->tasks->count();
                        $completedTasks = $project->tasks->where('status', 'completed')->count();
                        $calculatedProgress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                        
                        $progressColor = '';
                        if ($calculatedProgress >= 80) {
                            $progressColor = 'from-green-500 to-emerald-600';
                        } elseif ($calculatedProgress >= 60) {
                            $progressColor = 'from-blue-500 to-cyan-600';
                        } elseif ($calculatedProgress >= 40) {
                            $progressColor = 'from-yellow-500 to-orange-500';
                        } elseif ($calculatedProgress >= 20) {
                            $progressColor = 'from-orange-500 to-red-500';
                        } else {
                            $progressColor = 'from-red-500 to-red-600';
                        }
                    @endphp
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Overall Progress</span>
                            <span class="font-semibold text-blue-600" style="color: #2563eb;">{{ $calculatedProgress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 shadow-inner">
                            <div class="bg-gradient-to-r {{ $progressColor }} h-4 rounded-full transition-all duration-500 shadow-sm"
                                style="width: {{ $calculatedProgress }}%; 
                                       @if ($calculatedProgress >= 80) background: linear-gradient(to right, #10b981, #059669);
                                       @elseif ($calculatedProgress >= 60) background: linear-gradient(to right, #3b82f6, #0891b2);
                                       @elseif ($calculatedProgress >= 40) background: linear-gradient(to right, #eab308, #f97316);
                                       @elseif ($calculatedProgress >= 20) background: linear-gradient(to right, #f97316, #ef4444);
                                       @else background: linear-gradient(to right, #ef4444, #dc2626); @endif"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-2">
                            <span>{{ $completedTasks }} of {{ $totalTasks }} tasks completed</span>
                            <span class="flex items-center gap-1">
                                @if ($calculatedProgress >= 80)
                                    <i class="bi bi-trophy-fill text-yellow-500"></i>
                                    Excellent Progress!
                                @elseif ($calculatedProgress >= 60)
                                    <i class="bi bi-check-circle-fill text-green-500"></i>
                                    Good Progress
                                @elseif ($calculatedProgress >= 40)
                                    <i class="bi bi-graph-up-arrow text-blue-500"></i>
                                    Making Progress
                                @elseif ($calculatedProgress >= 20)
                                    <i class="bi bi-rocket-takeoff text-purple-500"></i>
                                    Getting Started
                                @else
                                    <i class="bi bi-play-circle text-gray-500"></i>
                                    Just Started
                                @endif
                            </span>
                        </div>
                    </div>

                    @if ($project->start_date && $project->end_date)
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Start Date</p>
                                <p class="text-lg text-gray-900">{{ $project->start_date->format('M j, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">End Date</p>
                                <p class="text-lg text-gray-900">{{ $project->end_date->format('M j, Y') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <div class="bg-white border rounded-lg" style="min-height: 165px">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Project Details</h3>
                </div>
                <div class="p-6 text-dark text-[15px] prose prose-sm max-w-none">
                    {!! $project->description !!}
                    <hr class="mb-4">
                   
                    @php
                        $url = $project->folder_id ?? '';

                        // 1) Parse query string into an array
                        $query = parse_url($url, PHP_URL_QUERY); // "f=...&139"
                        parse_str($query, $params); // ['f' => '1yWO...', '139' => '']

                        $f = $params['f'] ?? null; // value of "f"
                        $amp139 = array_key_exists('139', $params) ? '139' : null; // orphan token

                        // 2) (Optional) If you want to find *any* orphan token(s) like "&139"
                        $orphans = array_values(
                            array_filter(
                                explode('&', $query),
                                fn($part) => $part !== '' && strpos($part, '=') === false,
                            ),
                        );
                    @endphp

                    <div class="pt-1">

                        @php
                            $clientId = Auth::id();
                            $folderId =  $f; // Get folder ID from URL
                            $currentFolder = $folderId ? App\Models\FileManager::find($folderId) : null;
                            $parentFolder = $currentFolder ? $currentFolder->parent_id : null;

                            // Fetch files inside the current folder
                            $files = App\Models\FileManager::where('parent_id', $folderId)
                                ->where('user_id', $clientId)
                                ->where('isDeleted', 0)
                                ->orderBy('id', 'DESC')
                                ->get();

                            // Generate breadcrumbs
                            $breadcrumbs = [];
                            $current = $currentFolder;

                            while ($current) {
                                $breadcrumbs[] = $current;
                                $current = $current->parent ?? null;
                            }

                            $breadcrumbs = array_reverse($breadcrumbs);
                        @endphp
                        <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                            <strong>File Manager</strong>
                        </h6>
                        <hr class="mb-6 mt-4">

                        <div class="grid grid-cols-12 gap-x-6">
                            <div class="xl:col-span-12 col-span-12">
                                @include('pages.apps.storage.tables.files')
                            </div>
                        </div>
                    </div>

                </div>
                <style>
                    .p-6 ol {
                        list-style-type: decimal;
                        /* 1. 2. 3. */
                        margin-left: 1.5rem;
                        padding-left: 1rem;
                    }

                    .p-6 ul {
                        list-style-type: disc;
                        /* • bullets */
                        margin-left: 1.5rem;
                        padding-left: 1rem;
                    }

                    .p-6 li {
                        margin-bottom: 0.25rem;
                        /* spacing between list items */
                    }
                </style>
            </div>

        </div>
    </div>
    <div class="xl:col-span-3 col-span-3">
        <div class="col-span-3">
            <!-- Team Members -->
            <div class="bg-white border rounded-lg mb-5">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Assigned Team</h3>
                        @if ($project->teamMembers->count() > 3)
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-500">Showing 3 of {{ $project->teamMembers->count() }}</span>
                                <button onclick="prevTeamPage()" id="prevTeamBtn" class="p-1 text-gray-400 hover:text-gray-600 disabled:opacity-50" disabled>
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <span id="teamPageInfo" class="text-sm text-gray-500">1 of {{ ceil($project->teamMembers->count() / 3) }}</span>
                                <button onclick="nextTeamPage()" id="nextTeamBtn" class="p-1 text-gray-400 hover:text-gray-600">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    @if ($project->teamMembers->count() > 0)
                        @php
                            $facesPath = public_path('assets/images/faces');
                            $availableFaces = [];
                            
                            if (is_dir($facesPath)) {
                                $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                $availableFaces = array_map(function($file) {
                                    return '/assets/images/faces/' . basename($file);
                                }, $files);
                            }
                            
                            if (empty($availableFaces)) {
                                for ($i = 1; $i <= 16; $i++) {
                                    $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
                                }
                            }
                        @endphp
                        <div id="teamContainer" class="space-y-3">
                            @foreach ($project->teamMembers as $index => $member)
                                @php
                                    $avatarUrl = '';
                                    
                                    if ($member->profile_photo_path) {
                                        $profilePath = public_path('storage/' . $member->profile_photo_path);
                                        if (file_exists($profilePath) && is_readable($profilePath)) {
                                            $avatarUrl = '/storage/' . $member->profile_photo_path;
                                        }
                                    }
                                    
                                    if (!$avatarUrl) {
                                        $faceIndex = abs(crc32($member->name)) % count($availableFaces);
                                        $avatarUrl = $availableFaces[$faceIndex];
                                    }
                                @endphp
                                <div class="team-member" data-page="{{ floor($index / 3) + 1 }}" 
                                     style="{{ $index >= 3 ? 'display: none;' : '' }}">
                                    <div class="flex items-center space-x-3 p-3 rounded-lg border transition-all hover:shadow-sm"
                                         style="@if ($member->pivot->role === 'manager') background-color: #faf5ff; border-color: #d8b4fe;
                                                @elseif($member->pivot->role === 'lead') background-color: #f0f9ff; border-color: #bae6fd;
                                                @elseif($member->pivot->role === 'member') background-color: #f0fdf4; border-color: #bbf7d0;
                                                @elseif($member->pivot->role === 'viewer') background-color: #f8fafc; border-color: #e2e8f0;
                                                @else background-color: #f9fafb; border-color: #e5e7eb; @endif">
                                        <div class="flex-shrink-0">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ $avatarUrl }}"
                                                alt="{{ $member->name }}">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $member->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ ucfirst($member->pivot->role) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No team members assigned.</p>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white border rounded-lg mb-5">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('projects.tasks.create', $project) }}"
                        class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md border-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2 mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create New Task
                    </a>
                    <a href="#"
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md border-sm text-sm font-medium text-white bg-blue-600 hover:bg-gray-50">
                        <span class="bi bi-folder-symlink mx-3"></span>
                        Connect Folder
                    </a>
                    <a href="{{ route('projects.expenses.create', $project) }}"
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md border-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2 mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                        Add Expense
                    </a>
                    <a href="{{ route('projects.edit', $project) }}"
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md border-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Project
                    </a>
                </div>
            </div>

            <!-- Project Status -->
            <div class="bg-white border rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Project Status</h3>
                </div>
                <div class="p-6">
                    <div class="text-center">
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                    @if ($project->status === 'active') bg-green-100 text-green-800
                                    @elseif($project->status === 'planning') bg-blue-100 text-blue-800
                                    @elseif($project->status === 'on_hold') bg-yellow-100 text-yellow-800
                                    @elseif($project->status === 'completed') bg-gray-100 text-gray-800
                                    @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                        <p class="text-sm text-gray-500 mt-2">
                            Priority: <span class="font-medium">{{ ucfirst($project->priority) }}</span>
                        </p>
                        @if ($project->budget)
                            <p class="text-sm text-gray-500">
                                Budget: <span class="font-medium">${{ number_format($project->budget, 2) }}</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentTeamPage = 1;
const membersPerPage = 3;
const totalMembers = {{ $project->teamMembers->count() }};
const totalTeamPages = Math.ceil(totalMembers / membersPerPage);

function showTeamPage(page) {
    document.querySelectorAll('.team-member').forEach(member => {
        member.style.display = 'none';
    });
    
    document.querySelectorAll(`.team-member[data-page="${page}"]`).forEach(member => {
        member.style.display = 'block';
    });
    
    document.getElementById('teamPageInfo').textContent = `${page} of ${totalTeamPages}`;
    
    document.getElementById('prevTeamBtn').disabled = page === 1;
    document.getElementById('nextTeamBtn').disabled = page === totalTeamPages;
    
    if (page === 1) {
        document.getElementById('prevTeamBtn').classList.add('opacity-50');
    } else {
        document.getElementById('prevTeamBtn').classList.remove('opacity-50');
    }
    
    if (page === totalTeamPages) {
        document.getElementById('nextTeamBtn').classList.add('opacity-50');
    } else {
        document.getElementById('nextTeamBtn').classList.remove('opacity-50');
    }
}

function nextTeamPage() {
    if (currentTeamPage < totalTeamPages) {
        currentTeamPage++;
        showTeamPage(currentTeamPage);
    }
}

function prevTeamPage() {
    if (currentTeamPage > 1) {
        currentTeamPage--;
        showTeamPage(currentTeamPage);
    }
}

setTimeout(function() {
    window.updateTaskStatus = function(taskId, newStatus) {
        console.log(`Dashboard updateTaskStatus called with: ${taskId}, ${newStatus}`);
        
        const taskRow = document.querySelector(`[data-task-id="${taskId}"]`);
        if (!taskRow) {
            console.error(`Task row not found for task ${taskId}`);
            return;
        }
        
        const statusSelect = taskRow.querySelector('select');
        if (statusSelect) {
            statusSelect.value = newStatus;
            
            const statusClasses = {
                'not-started': { bg: 'bg-gray-100', text: 'text-gray-800', color: 'gray' },
                'working': { bg: 'bg-blue-100', text: 'text-blue-800', color: 'blue' },
                'stuck': { bg: 'bg-red-100', text: 'text-red-800', color: 'red' },
                'done': { bg: 'bg-green-100', text: 'text-green-800', color: 'green' }
            };
            
            const statusClass = statusClasses[newStatus] || statusClasses['not-started'];
            
            statusSelect.className = `pr-2 pl-2 py-1 text-xs rounded-full ${statusClass.bg} ${statusClass.text} border-0 focus:ring-2 focus:ring-${statusClass.color}-500 appearance-none whitespace-nowrap`;
            statusSelect.style.cssText = "-webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: none; width: auto; min-width: max-content;";
        }
        
        const progressBar = taskRow.querySelector('.col-span-2 .bg-blue-500, .col-span-2 .bg-green-500, .col-span-2 .bg-red-500, .col-span-2 .bg-gray-300, .col-span-2 [style*="width"]');
        const progressText = taskRow.querySelector('.col-span-2 .text-xs.text-gray-500');
        
        let progress = 0;
        let progressColor = 'bg-gray-300';
        
        switch(newStatus) {
            case 'working':
                progress = 50;
                progressColor = 'bg-blue-500';
                break;
            case 'stuck':
                progress = 25;
                progressColor = 'bg-red-500';
                break;
            case 'done':
                progress = 100;
                progressColor = 'bg-green-500';
                break;
            default:
                progress = 0;
                progressColor = 'bg-gray-300';
        }
        
        if (progressBar) {
            progressBar.className = progressBar.className.replace(/bg-(blue|green|red|gray)-(300|500)/g, '') + ` ${progressColor}`;
            progressBar.style.width = `${progress}%`;
        }
        
        if (progressText) {
            progressText.textContent = `${progress}% complete`;
        }
        
        updateProjectProgress();
        
        // Save to database
        const numericTaskId = taskId.replace('task-', '');
        fetch(`/project-management/tasks/${numericTaskId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ 
                status: newStatus === 'working' ? 'in_progress' : 
                       newStatus === 'not-started' ? 'todo' :
                       newStatus === 'stuck' ? 'on_hold' :
                       newStatus === 'done' ? 'completed' : newStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Task status saved to database successfully');
            } else {
                console.error('Failed to save task status:', data.message);
                // Revert UI changes if save failed
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error saving task status:', error);
            // Revert UI changes if save failed
            location.reload();
        });
        
        if (newStatus === 'done') {
            taskRow.style.opacity = '0.8';
            setTimeout(() => {
                taskRow.style.opacity = '1';
            }, 500);
        }
    };
    
    console.log('Dashboard updateTaskStatus function overridden');
}, 100);

function updateProjectProgress() {
    const allTasks = document.querySelectorAll('[data-task-id]');
    const completedTasks = document.querySelectorAll('[data-task-id] select[value="done"]');
    
    if (allTasks.length === 0) return;
    
    const progressPercentage = Math.round((completedTasks.length / allTasks.length) * 100);
    
    const mainProgressBar = document.querySelector('.bg-blue-500[style*="width"]');
    const mainProgressText = document.querySelector('.text-sm.font-medium.text-gray-900');
    
    if (mainProgressBar) {
        mainProgressBar.style.width = `${progressPercentage}%`;
        
        if (progressPercentage >= 80) {
            mainProgressBar.style.background = 'linear-gradient(90deg, #10b981 0%, #059669 100%)';
        } else if (progressPercentage >= 60) {
            mainProgressBar.style.background = 'linear-gradient(90deg, #3b82f6 0%, #0891b2 100%)';
        } else if (progressPercentage >= 40) {
            mainProgressBar.style.background = 'linear-gradient(90deg, #eab308 0%, #f97316 100%)';
        } else if (progressPercentage >= 20) {
            mainProgressBar.style.background = 'linear-gradient(90deg, #f97316 0%, #ef4444 100%)';
        } else {
            mainProgressBar.style.background = 'linear-gradient(90deg, #ef4444 0%, #dc2626 100%)';
        }
    }
    
    if (mainProgressText) {
        mainProgressText.textContent = `${progressPercentage}%`;
    }
}
</script>
