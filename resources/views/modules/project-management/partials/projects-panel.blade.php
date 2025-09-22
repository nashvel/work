{{-- <div id="projectsEdgePanel" class="fixed right-0 top-0 z-50" style="top: 0px !important; height: 100vh !important;">
    <button id="toggleProjectPanel" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-l-xl shadow-xl h-16 w-16 flex items-center justify-center cursor-pointer transition-all duration-300 hover:shadow-2xl transform hover:scale-105" style="position: absolute; top: 50%; transform: translateY(-50%); right: 0px;">
        <div class="flex flex-col items-center">
            <svg id="panelToggleIcon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-xs mt-1 font-medium">Projects</span>
        </div>
    </button>
    
<div id="projectPanelContent" class="bg-white shadow-2xl border-l border-gray-200 transform translate-x-full transition-transform duration-300 ease-in-out" style="height: 100vh !important; top: 0px !important; bottom: 0px !important; left: auto !important; right: 0px !important; margin: 0px !important; padding: 0px !important; position: fixed !important; z-index: 9999 !important; width: 420px !important; display: flex; flex-direction: column;">
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Available Projects</h3>
                    <p class="text-gray-500 text-sm mt-1">{{ count($projects ?? []) }} projects ready to assign</p>
                </div>
                <button id="closePanelBtn" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-3 gap-3 mt-3">
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center">
                    <div class="text-lg font-bold text-gray-900">{{ count($projects ?? []) }}</div>
                    <div class="text-xs text-gray-500">Total</div>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center">
                    <div class="text-lg font-bold text-gray-900">{{ collect($projects ?? [])->where('stage', 'in_progress')->count() }}</div>
                    <div class="text-xs text-gray-500">Active</div>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-2 text-center">
                    <div class="text-lg font-bold text-gray-900">{{ collect($projects ?? [])->where('stage', 'planning')->count() }}</div>
                    <div class="text-xs text-gray-500">Planning</div>
                </div>
            </div>
        </div> --}}

        <div class="bg-white flex-1 overflow-y-auto" style="flex: 1; min-height: 0;">
            <div class="overflow-x-auto h-full">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-300 sticky top-0 z-10">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-300">Project</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-300">Due Date</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-300">Status</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-300">Progress</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if(isset($projects) && $projects->count() > 0)
                            @foreach($projects as $project)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 border-b border-gray-200 project-card cursor-move" 
                                    draggable="true" 
                                    data-project-id="{{ $project->id }}"
                                    data-project-name="{{ $project->name }}">
                                    <td class="px-4 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full mr-3
                                                @if($project->stage === 'in_progress') bg-green-400
                                                @elseif($project->stage === 'planning') bg-blue-400
                                                @elseif($project->stage === 'review') bg-yellow-400
                                                @elseif($project->stage === 'completed') bg-gray-400
                                                @else bg-red-400
                                                @endif"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">{{ $project->name }}</p>
                                                @if($project->description)
                                                    <p class="text-xs text-gray-500 mt-1">{{ Str::limit($project->description, 40) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap border-r border-gray-200">
                                        @if($project->due_date)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-sm text-gray-900">{{ $project->due_date->format('M d, Y') }}</span>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap border-r border-gray-200">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($project->stage === 'in_progress') bg-green-100 text-green-800 border border-green-200
                                            @elseif($project->stage === 'planning') bg-blue-100 text-blue-800 border border-blue-200
                                            @elseif($project->stage === 'review') bg-yellow-100 text-yellow-800 border border-yellow-200
                                            @elseif($project->stage === 'completed') bg-gray-100 text-gray-800 border border-gray-200
                                            @else bg-red-100 text-red-800 border border-red-200
                                            @endif">
                                            <div class="w-1.5 h-1.5 rounded-full mr-2
                                                @if($project->stage === 'in_progress') bg-green-400
                                                @elseif($project->stage === 'planning') bg-blue-400
                                                @elseif($project->stage === 'review') bg-yellow-400
                                                @elseif($project->stage === 'completed') bg-gray-400
                                                @else bg-red-400
                                                @endif"></div>
                                            {{ ucfirst(str_replace('_', ' ', $project->stage)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2 mr-3" style="width: 60px;">
                                                <div class="h-2 rounded-full
                                                    @if($project->stage === 'completed') bg-green-500 w-full
                                                    @elseif($project->stage === 'review') bg-yellow-500 w-4/5
                                                    @elseif($project->stage === 'in_progress') bg-blue-500 w-3/5
                                                    @else bg-gray-400 w-1/5
                                                    @endif"></div>
                                            </div>
                                            <span class="text-xs text-gray-600 font-medium">
                                                @if($project->stage === 'completed') 100%
                                                @elseif($project->stage === 'review') 80%
                                                @elseif($project->stage === 'in_progress') 60%
                                                @else 20%
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-1">
                                            <button onclick="openTeamModal({{ $project->id }})" class="px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition-colors">
                                                Team
                                            </button>
                                            <button class="p-1 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button class="p-1 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded transition-colors" title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        <p class="text-gray-500">No projects available</p>
                                        <p class="text-gray-400 text-xs mt-1">Create projects to assign to team members</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            {{-- </div>

            <div class="bg-white border-t border-gray-200 px-4 py-3 flex-shrink-0">
                <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if ($projects->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $projects->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50" onclick="sessionStorage.setItem('projectPanelOpen', 'true')">
                                    Previous
                                </a>
                            @endif

                            @if ($projects->hasMorePages())
                                <a href="{{ $projects->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50" onclick="sessionStorage.setItem('projectPanelOpen', 'true')">
                                    Next
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                    Next
                                </span>
                            @endif
                        </div>
                        
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing <span class="font-medium">{{ $projects->firstItem() }}</span> to <span class="font-medium">{{ $projects->lastItem() }}</span> of <span class="font-medium">{{ $projects->total() }}</span> results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                   
                                    @if ($projects->onFirstPage())
                                        <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-default">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @else
                                        <a href="{{ $projects->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" onclick="sessionStorage.setItem('projectPanelOpen', 'true')">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif

                                    @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                                        @if ($page == $projects->currentPage())
                                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50" onclick="sessionStorage.setItem('projectPanelOpen', 'true')">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    @if ($projects->hasMorePages())
                                        <a href="{{ $projects->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" onclick="sessionStorage.setItem('projectPanelOpen', 'true')">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @else
                                        <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-default">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
