@php
    $companyLogos = [
        'syracuse' => 'png',
        'utica' => 'jpg',
        'cleantec' => 'webp',
    ];

    $matched = null;
    foreach ($companyLogos as $company => $ext) {
        if (Str::contains(Str::lower($file->name), $company)) {
            $matched = ['name' => $company, 'ext' => $ext];
            break;
        }
    }

    $folder_count = App\Models\FileManager::where('parent_id', $file->google_drive_id)
        ->where('user_id', $clientId)
        ->where('is_folder', 1)
        ->where('isDeleted', 0)
        ->count();

    $files_count = App\Models\FileManager::where('parent_id', $file->google_drive_id)
        ->where('user_id', $clientId)
        ->where('is_folder', 0)
        ->where('isDeleted', 0)
        ->count();

    $files_sum = App\Models\FileManager::where('parent_id', $file->google_drive_id)
        ->where('user_id', $clientId)
        ->where('isDeleted', 0)
        ->sum('size');
@endphp

{{-- resources/views/file-manager/partials/folder-card.blade.php --}}

{{-- resources/views/file-manager/partials/folder-card.blade.php --}}

{{-- resources/views/file-manager/partials/folder-card.blade.php --}}

@php
    $sizeFormatted = function ($bytes) {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    };
@endphp

{{-- resources/views/file-manager/partials/folder-card.blade.php --}}

@php
    $sizeFormatted = function($bytes) {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' bytes';
    };
@endphp

<div class="col-span-3 p-2 hover:shadow-lg">
    <div class="relative h-full rounded-xl border border-gray-200 p-4 bg-white shadow-sm transition group hover:shadow-lg">
        <a href="/file-manager/list/folder?f={{ $file->google_drive_id }}&{{ $file->id }}" class="flex items-center gap-3">
            <div class="text-yellow-500">
                <div class="text-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" width="40" height="40">
                        <path fill="#FFA000" d="M853.333 256h-384L384 170.667H170.667c-46.934 0-85.334 38.4-85.334 85.333v170.667h853.334v-85.334c0-46.933-38.4-85.333-85.334-85.333z"></path>
                        <path fill="#FFCA28" d="M853.333 256H170.667c-46.934 0-85.334 38.4-85.334 85.333V768c0 46.933 38.4 85.333 85.334 85.333h682.666c46.934 0 85.334-38.4 85.334-85.333V341.333c0-46.933-38.4-85.333-85.334-85.333z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex-1 truncate">
                <p class="font-medium text-gray-800 truncate">{{ $file->name }}</p>
                <p class="text-sm text-gray-500">{{ $sizeFormatted($files_sum) }}</p>
            </div>
        </a>

        <div class="absolute top-5 right-2 flex items-center" style="position: absolute; right: 15px;">
            <div class="ti-dropdown hs-dropdown">
                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="inline-flex justify-center w-8 h-8 items-center rounded-full bg-gray-100">
                    <i class="ri-more-fill font-semibold text-textmuted dark:text-dark"></i>
                </a>
                <ul class="ti-dropdown-menu hs-dropdown-menu hidden">                    
                    <li>
                        <a class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                            <span class="bi bi-folder-symlink text-lg"></span>
                            <span class="text-sm">Open</span>
                        </a>
                    </li>
                    <li>
                        <a class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                            <span class="bi bi-cloud-download text-lg"></span>
                            <span class="text-sm">Download</span>
                        </a>
                    </li>
                    <li>
                        <a class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                            <span class="bi bi-pen text-lg"></span>
                            <span class="text-sm">Rename</span>
                        </a>
                    </li>
                    <li>
                        <a class="ti-dropdown-item flex items-center gap-2 text-gray-700" href="javascript:void(0);">
                            <span class="bi bi-send-plus text-lg"></span>
                            <span class="text-sm">Share</span>
                        </a>
                    </li>
                    <li>
                        <a class="ti-dropdown-item flex items-center gap-2 text-danger" onclick="remove_data({{ $file->id }}, 'file-manager')" href="javascript:void(0);">
                            <span class="bi bi-trash text-lg"></span>
                            <span class="text-sm">Delete</span>
                        </a>
                    </li>
                    {{-- <li><a class="ti-dropdown-item" onclick="remove_data({{ $file->id }}, 'file-manager')" href="javascript:void(0);">Delete</a></li>
                    <li><a class="ti-dropdown-item" data-hs-overlay="#rename-files-folder" onclick="rename_ff({{ $file->id }}, 'Folder', '{{ $file->name }}')" href="javascript:void(0);">Rename</a></li>
                    <li><a class="ti-dropdown-item" href="javascript:void(0);">Hide Folder</a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>
