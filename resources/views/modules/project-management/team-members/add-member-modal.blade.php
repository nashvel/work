<div id="addMemberModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Add Team Member</h3>
                <button onclick="closeAddMemberModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="addMemberForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Select User</label>
                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                        <input type="text" id="userSearch" placeholder="Search users..." 
                               class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        
                        <div id="userDropdown" class="hidden absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                        @foreach(\App\Models\User::whereNotIn('id', $project->teamMembers->pluck('id'))->get() as $user)
                            <div class="user-option p-3 hover:bg-gray-50 cursor-pointer flex items-center space-x-3 border-b border-gray-100 last:border-b-0" 
                                 data-user-id="{{ $user->id }}" 
                                 data-name="{{ $user->name }}" 
                                 data-email="{{ $user->email }}"
                                 data-search="{{ strtolower($user->name . ' ' . $user->email) }}">
                                @php
                                    // Get user avatar with profile photo fallback
                                    $facesPath = public_path('assets/images/faces');
                                    $availableFaces = [];
                                    
                                    if (is_dir($facesPath)) {
                                        $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                        $availableFaces = array_map(function($file) {
                                            return '/assets/images/faces/' . basename($file);
                                        }, $files);
                                    }
                                    
                                    // Fallback if no faces found
                                    if (empty($availableFaces)) {
                                        for ($i = 1; $i <= 16; $i++) {
                                            $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
                                        }
                                    }
                                    
                                    // Use hash to consistently assign a face
                                    $faceIndex = abs(crc32($user->name)) % count($availableFaces);
                                    $avatarUrl = $availableFaces[$faceIndex];
                                    
                                    // Check for user's actual profile photo first
                                    if ($user->profile_photo_path) {
                                        $profilePath = public_path('storage/' . $user->profile_photo_path);
                                        if (file_exists($profilePath) && is_readable($profilePath)) {
                                            $avatarUrl = '/storage/' . $user->profile_photo_path;
                                        }
                                    }
                                @endphp
                                <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" 
                                     class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500 truncate">{{ $user->email }}</div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    
                    <input type="hidden" id="selectedUserId">
                    <div id="selectedUserPreview" class="hidden mt-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center space-x-3">
                            <div id="selectedUserAvatar" class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <span id="selectedUserInitial" class="text-white text-xs font-semibold"></span>
                            </div>
                            <div class="flex-1">
                                <div id="selectedUserName" class="text-sm font-medium text-gray-900"></div>
                                <div id="selectedUserEmail" class="text-xs text-gray-500"></div>
                            </div>
                            <button type="button" onclick="clearSelectedUser()" class="text-gray-400 hover:text-gray-600">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select id="memberRole" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="member">Member</option>
                        <option value="lead">Lead</option>
                        <option value="viewer">Viewer</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Choose the appropriate role for this team member</p>
                </div>
                
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAddMemberModal()" 
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Add Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
