<div class="flex-1 overflow-hidden">
    <div class="overflow-x-auto h-full">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="checkbox-column px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider" style="display: none;">
                        <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4">
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center space-x-1">
                            <span>Team Member</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center space-x-1">
                            <span>Assigned Project</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Due Date</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Progress</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
            @forelse($users as $user)
                @php
                    $userProject = $user->managedProjects ? $user->managedProjects->first() : null;
                @endphp
                <tr class="hover:bg-blue-50 user-row transition-colors duration-150 border-l-4 border-transparent hover:border-blue-400" 
                    data-user-id="{{ $user->id }}" 
                    data-user-name="{{ $user->name }}">
                    <td class="checkbox-column px-6 py-4 whitespace-nowrap" style="display: none;">
                        @if($userProject)
                            <input type="checkbox" name="selected_projects[]" value="{{ $userProject->id }}" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4">
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mr-4 shadow-md">
                                <span class="text-white font-semibold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $user->name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($userProject)
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $userProject->name }}</p>
                                    @if($userProject->description)
                                        <p class="text-xs text-gray-500 mt-1">{{ Str::limit($userProject->description, 50) }}</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="flex items-center text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="text-sm">No project assigned</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($userProject && $userProject->due_date)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-gray-900">{{ $userProject->due_date->format('M d, Y') }}</span>
                            </div>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($userProject)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if($userProject->stage === 'in_progress') bg-green-100 text-green-800 border border-green-200
                                @elseif($userProject->stage === 'planning') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif($userProject->stage === 'review') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($userProject->stage === 'completed') bg-gray-100 text-gray-800 border border-gray-200
                                @else bg-red-100 text-red-800 border border-red-200
                                @endif">
                                <div class="w-1.5 h-1.5 rounded-full mr-2
                                    @if($userProject->stage === 'in_progress') bg-green-400
                                    @elseif($userProject->stage === 'planning') bg-blue-400
                                    @elseif($userProject->stage === 'review') bg-yellow-400
                                    @elseif($userProject->stage === 'completed') bg-gray-400
                                    @else bg-red-400
                                    @endif"></div>
                                {{ ucfirst(str_replace('_', ' ', $userProject->stage)) }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500 border border-gray-200">
                                <div class="w-1.5 h-1.5 rounded-full mr-2 bg-gray-300"></div>
                                Unassigned
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($userProject)
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2 mr-3" style="width: 80px;">
                                    <div class="h-2 rounded-full
                                        @if($userProject->stage === 'completed') bg-green-500 w-full
                                        @elseif($userProject->stage === 'review') bg-yellow-500 w-4/5
                                        @elseif($userProject->stage === 'in_progress') bg-blue-500 w-3/5
                                        @else bg-gray-400 w-1/5
                                        @endif"></div>
                                </div>
                                <span class="text-xs text-gray-600 font-medium">
                                    @if($userProject->stage === 'completed') 100%
                                    @elseif($userProject->stage === 'review') 80%
                                    @elseif($userProject->stage === 'in_progress') 60%
                                    @else 20%
                                    @endif
                                </span>
                            </div>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-2">
                            @if($userProject)
                                <button onclick="openTeamModal({{ $userProject->id }})" class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 transition-colors">
                                    Create Team
                                </button>
                            @endif
                            <button class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="View Details">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Remove">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
        @empty
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <p class="text-gray-500">No users found</p>
                        <p class="text-gray-400 text-xs mt-1">Add users to get started</p>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
