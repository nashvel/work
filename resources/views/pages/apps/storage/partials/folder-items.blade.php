<li class="my-1 folder-item">

    <div class="flex items-center">
        <button class="folder-toggle-btn ml-2" onclick="toggleFolder(this)">
            <i class="ri-arrow-right-s-line text-xl"></i> 
        </button>
        <a href="?f={{ $folder['google_drive_id'] }}"><span class="text-gray-800 ms-2 mt-1 flex-auto text-nowrap">{{ $folder['name'] }}</span></a>
    </div>

    @if (!empty($folder['children']))
        <ul class="ms-6 text-sm text-gray-600 folder-children hidden">
            @foreach ($folder['children'] as $child)
                @include('pages.apps.storage.partials.folder-items', ['folder' => $child])
            @endforeach
        </ul>
    @endif
</li>
