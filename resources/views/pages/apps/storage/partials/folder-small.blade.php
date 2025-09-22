@php
                                    // Retrieve folders from database
                                    $folders = json_decode(App\Models\FileManager::get(), true);

                                    // Build folder tree function
                                    function buildFolderTree($folders, $parentId = null)
                                    {
                                        $branch = [];

                                        foreach ($folders as $folder) {
                                            if ($folder['parent_id'] === $parentId && $folder['is_folder'] === 1) {
                                                $children = buildFolderTree($folders, $folder['google_drive_id']);
                                                if ($children) {
                                                    $folder['children'] = $children;
                                                }
                                                $branch[] = $folder;
                                            }
                                        }

                                        return $branch;
                                    }

                                    // Generate the folder tree structure
                                    $folderTree = buildFolderTree($folders);
                                @endphp

                                <!-- Folder Tree -->
                                @if (!empty($folderTree))
                                    <ul class="ms-2 mt-2 text-sm text-gray-700">
                                        @foreach ($folderTree as $folder)
                                            @include('pages.apps.storage.partials.folder-items', [
                                                'folder' => $folder,
                                            ])
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="ms-4 text-sm text-gray-400">No folders found.</div>
                                @endif

                            <script>
                                // Toggle the folder's children visibility
                                function toggleFolder(button) {
                                    const folderChildren = button.closest('li').querySelector('.folder-children');
                                    const icon = button.querySelector('i');

                                    // Toggle visibility
                                    folderChildren.classList.toggle('hidden');

                                    // Change the arrow icon based on folder state
                                    if (folderChildren.classList.contains('hidden')) {
                                        icon.classList.remove('ri-arrow-down-s-line');
                                        icon.classList.add('ri-arrow-right-s-line');
                                    } else {
                                        icon.classList.remove('ri-arrow-right-s-line');
                                        icon.classList.add('ri-arrow-down-s-line');
                                    }
                                }
                            </script>