@php
    if (session('manage_portal_id')) {
        $clientId = session()->get('manage_portal_id');
    } else {
        $clientId = Auth::user()->id;
    }
@endphp
@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <x-slot name="title">File Manager</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "File"}</x-slot>
    <x-slot name="active">File Manager</x-slot>
    <x-slot name="buttons">
        <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#create-folder">
            <i class="bi bi-folder-plus align-middle"></i>Create Folder
        </button>
        &ensp;
        <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#create-file">
            <i class="bi bi-upload align-middle"></i>Upload File
        </button>
    </x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-10">
            <div class="grid grid-cols-12 gap-x-5">
                @php

                    function formatSize($bytes)
                    {
                        if ($bytes < 1024) {
                            return $bytes . ' B';
                        }
                        if ($bytes < 1024 * 1024) {
                            return number_format($bytes / 1024, 2) . ' KB';
                        }
                        if ($bytes < 1024 * 1024 * 1024) {
                            return number_format($bytes / (1024 * 1024), 2) . ' MB';
                        }
                        return number_format($bytes / (1024 * 1024 * 1024), 2) . ' GB';
                    }

                    $categories = [
                        'Docs' => ['icon' => 'ti ti-file-description', 'type' => ['pdf', 'doc', 'docx', 'txt']],
                        'Apps' => ['icon' => 'bi bi-file-earmark-zip', 'type' => ['zip', 'exe', 'apk']],
                        'Images' => ['icon' => 'ti ti-photo', 'type' => ['jpg', 'jpeg', 'png', 'gif']],
                        'Videos' => ['icon' => 'ti ti-video', 'type' => ['mp4', 'mkv', 'avi']],
                    ];
                @endphp

                @foreach ($categories as $category => $data)
                    @php

                        // $user = Auth::user();
                        // $clientId = null;

                        // if ($user->role === 'Virtual Assistant') {
                        //     $clientId = $user->company;
                        // } elseif ($user->role === 'Sub-Client') {
                        //     $clientId = App\Models\Clients::where('email', $user->email)->value('id');
                        // } else {
                        //     $clientId = App\Models\Lead::where('email', $user->email)->value('id');
                        // }

                        $files = App\Models\FileManager::where('user_id', $clientId)
                            ->whereIn('format', $data['type'])
                            ->where('isDeleted', 0)
                            ->get();
                        $totalSize = $files->sum('size');
                        $fileCount = $files->count();
                        $formattedSize = formatSize($totalSize);
                    @endphp

                    <div class="xxl:col-span-3 col-span-12">
                        <div class="box overflow-hidden main-content-card">
                            <div class="box-body">
                                <div class="flex items-center gap-4 flex-wrap">
                                    <div class="main-card-icon primary">
                                        <div class="avatar avatar-md bg-primary/10 border border-primary/10">
                                            <div class="avatar avatar-sm !text-primary">
                                                <i class="{{ $data['icon'] }} text-2xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="javascript:void(0);" class="block font-medium">{{ $category }}</a>
                                        <span class="text-xs text-textmuted dark:text-textmuted/50">
                                            Total Size: <span class="text-dark">{{ $formattedSize }}</span>
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        <span class="font-medium">{{ $fileCount }} files</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Whoops! Something went wrong.</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <hr>
            @endif

            <div class="box justify-between">
                <div class="box-body overflow-y-auto p-0 " id="discussion-container" style="min-height: 500px">

                    <script>
                        document.getElementById("fileInput").addEventListener("change", function() {
                            const file = this.files[0]; // Get selected file
                            const maxSize = 50 * 1024 * 1024; // 50MB in bytes

                            if (file && file.size > maxSize) {
                                Swal.fire({
                                    title: "Maximum allowed size of 50MB",
                                    text: "The selected file exceeds the maximum allowed size of 50MB. Please contact the VA to assist you with uploading large files.",
                                    icon: "warning"
                                });
                                this.value = ""; // Clear the input
                            }
                        });
                    </script>

                    <div class="p-4 pt-1">

                        @php
                            $folderId = request()->query('f'); // Get folder ID from URL
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

                        @include('pages.filemanager.folder_list')

                        <hr class="mb-6">

                        <div class="grid grid-cols-12 gap-x-6">
                            <div class="xl:col-span-12 col-span-12">
                                @include('pages.apps.storage.tables.files')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Emoji Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('input[name="message"]').addEventListener('input', function(event) {
                    this.value = this.value.replace(/:smile:/g, '😊').replace(/:heart:/g, '❤️');
                });
            });

            function displayFileName(input) {
                let fileName = input.files.length ? input.files[0].name : '';
                document.getElementById('file-name-display').innerText = fileName ? `Selected File: ${fileName}` : '';
            }
        </script>
    </div>

    @include('pages.filemanager.create_folder')
    @include('pages.filemanager.create_files')

    @include('pages.storage.rename_ff')
    @include('pages.storage.move_ff')

    <script>
        function rename_ff(id, type, value) {
            document.getElementById('form_rename').action = '/file-manager/rename/' + id
            document.getElementById('name').value = value
        }
    </script>

</x-app-layout>
