@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $info = App\Models\FileManager::where('google_drive_id', $id)->first();
    $fileToPreview = '.' . ($info->format ?? 'txt');
    $filePath = storage_path('app/public/' . ($info->path ?? ''));

@endphp

<x-app-layout>

    <x-slot name="title">{{ $info->name ?? 'Preview' }}</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "File"}</x-slot>
    <x-slot name="active">Preview</x-slot>


    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-12">
            <div class="box overflow-hidden main-content-card">
                <div class="box-body text-center p-5">
                    @if (Str::endsWith($fileToPreview, ['.txt', '.csv', '.html', '.json']))
                        {{-- @include('pages.apps.storage.preview.txt') --}}
                    @elseif (Str::endsWith($fileToPreview, ['.jpg', '.jpeg', '.png', '.gif', '.svg', '.webp']))
                        {{-- @include('pages.apps.storage.preview.images') --}}
                    @elseif (Str::endsWith($fileToPreview, ['.pdf']))
                        @php
                            $fileId = $id;
                        @endphp
                        <div class="mt-4">

                              <button id="fullscreenBtn" class="ti-btn ti-btn-primary absolute top-0 right-0 mt-2 mr-2 z-10"
                                onclick="toggleFullscreen()">Go Fullscreen</button>
                            <iframe class="mt-5" id="filePreview" src="{{ url('/preview-file/' . $fileId) }}" width="100%"
                                height="600px" style="border: none;" class="mt-4"></iframe>

                            <!-- Fullscreen Button -->
                          
                        </div>

                        <script>
                            function toggleFullscreen() {
                                var iframe = document.getElementById('filePreview');

                                if (iframe.requestFullscreen) {
                                    iframe.requestFullscreen();
                                } else if (iframe.mozRequestFullScreen) { // Firefox
                                    iframe.mozRequestFullScreen();
                                } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari and Opera
                                    iframe.webkitRequestFullscreen();
                                } else if (iframe.msRequestFullscreen) { // IE/Edge
                                    iframe.msRequestFullscreen();
                                }
                            }
                        </script>

                        {{-- @include('pages.apps.storage.preview.pdf') --}}
                    @elseif (Str::endsWith($fileToPreview, ['.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx']))
                        {{-- @include('pages.apps.storage.preview.msoffice') --}}
                        <iframe src="{{ url('/preview-office/' . $id) }}" width="100%" height="1200px"
                            style="border: none;" class="mt-4"></iframe>
                    @elseif (Str::endsWith($fileToPreview, ['.zip']))
                        @include('pages.apps.storage.preview.zip')
                    @else
                        <p class="text-red-500">Preview not available for this file type.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
