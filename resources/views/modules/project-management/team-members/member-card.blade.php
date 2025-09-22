<div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition-shadow" data-member-id="{{ $member->id }}">
    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0">
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
                $faceIndex = abs(crc32($member->name)) % count($availableFaces);
                $avatarUrl = $availableFaces[$faceIndex];
                
                // Check for user's actual profile photo first
                if ($member->profile_photo_path) {
                    $profilePath = public_path('storage/' . $member->profile_photo_path);
                    if (file_exists($profilePath) && is_readable($profilePath)) {
                        $avatarUrl = '/storage/' . $member->profile_photo_path;
                    }
                }
            @endphp
            <img src="{{ $avatarUrl }}" alt="{{ $member->name }}" 
                 class="w-12 h-12 rounded-full object-cover flex-shrink-0">
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-900 truncate">
                {{ $member->name }}
            </p>
            <p class="text-sm text-gray-500 truncate">
                {{ $member->email }}
            </p>
        </div>
    </div>
    
    <div class="mt-4 flex items-center justify-between">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
            @if($member->pivot->role === 'manager') bg-purple-100 text-purple-800
            @elseif($member->pivot->role === 'lead') bg-blue-100 text-blue-800
            @elseif($member->pivot->role === 'viewer') bg-gray-100 text-gray-800
            @else bg-green-100 text-green-800 @endif">
            {{ ucfirst($member->pivot->role) }}
        </span>
        
        <div class="flex space-x-2">
            <button onclick="openEditRoleModal({{ $member->id }}, '{{ $member->name }}', '{{ $member->email }}', '{{ $member->pivot->role }}')" 
                    class="text-gray-400 hover:text-blue-600 transition-colors"
                    title="Edit Role">
                <i class="bi bi-pencil"></i>
            </button>
            @if($member->pivot->role !== 'manager')
                <button onclick="removeMember({{ $member->id }})" 
                        class="text-gray-400 hover:text-red-600 transition-colors"
                        title="Remove Member">
                    <i class="bi bi-trash"></i>
                </button>
            @endif
        </div>
    </div>
    
    <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
        <span>
            Joined {{ $member->pivot->joined_at ? \Carbon\Carbon::parse($member->pivot->joined_at)->format('M j, Y') : 'N/A' }}
        </span>
        @if($member->pivot->role === 'manager')
            <span class="inline-flex items-center text-purple-600">
                <i class="bi bi-star-fill mr-1"></i>
                Project Manager
            </span>
        @endif
    </div>
</div>
