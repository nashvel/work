{{-- resources/views/file-manager/index.blade.php --}}

<x-app-layout>
    <x-slot name="return">{"link": "/file-manager/list", "text": "Back"}</x-slot>
    <x-slot name="title">Manage File Manager</x-slot>
    <x-slot name="url_1">{"link": "/file-manager/list", "text": "File Manager"}</x-slot>
    <x-slot name="active">Files</x-slot>
    <x-slot name="buttons">
        <button class="ti-btn text-dark ti-btn-light shadow-none rounded-lg btn-wave me-0" data-hs-overlay="#create-folder">
            <i class="bi bi-folder-plus align-middle"></i>Create Folder
        </button>
        &ensp;
        <button class="ti-btn text-dark ti-btn-light rounded-lg !border-2 btn-wave me-0" data-hs-overlay="#create-file">
            <i class="bi bi-upload align-middle"></i>Upload File
        </button>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>File Manager</strong>
                    </h6>
                    <hr class="mb-3 !mt-3">
                    @if ($errors->any())
                        <div
                            class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                            <div>
                                <strong class="text-danger">Whoops! Something went wrong:</strong>
                                <ul class="list-disc list-inside mt-2 mx-4">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-dark"><i>{{ $error }}</i></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @php
                        $folderId = request()->query('f');
                        $currentFolder = $folderId ? App\Models\FileManager::find($folderId) : null;
                        $clientId = auth()->id();

                        $files = App\Models\FileManager::where('parent_id', $folderId)
                            ->where('user_id', $clientId)
                            ->where('isDeleted', 0)
                            ->orderBy('is_folder', 'desc')
                            ->orderBy('name')
                            ->paginate(24);

                        $breadcrumbs = [];
                        $current = $currentFolder;
                        while ($current) {
                            $breadcrumbs[] = $current;
                            $current = $current->parent ?? null;
                        }
                        $breadcrumbs = array_reverse($breadcrumbs);
                    @endphp

                    {{-- Breadcrumbs --}}
                    {{-- <nav class="text-sm mb-4">
                        <a href="{{ route('filemanager.index') }}" class="text-blue-500">Root</a>
                        @foreach ($breadcrumbs as $crumb)
                            &nbsp;/&nbsp;
                            <a href="{{ route('filemanager.index', ['f' => $crumb->id]) }}" class="text-blue-500">
                                {{ $crumb->name }}
                            </a>
                        @endforeach
                    </nav> --}}

                    
                    {{-- Folder Grid --}}
                    @include('modules.file-manager.partials.folder-grid', [
                        'files' => $files,
                        'clientId' => $clientId,
                    ])


                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-12 p-2 hover:shadow-lg">
                            @include('pages.apps.storage.tables.files')
                        </div>
                    </div>


                </div>
            </div>
            
        </div>
        
    </div>


    @include('pages.filemanager.create_folder')
    @include('pages.filemanager.create_files')
 
    @include('pages.storage.rename_ff')
    @include('pages.storage.move_ff')

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

    <script>
        function rename_ff(id, type, value) {
            document.getElementById('form_rename').action = '/file-manager/rename/' + id
            document.getElementById('name').value = value
        }
    </script>

</x-app-layout>
