<x-app-layout>

    <x-slot name="title"></x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "File"}</x-slot>
    <x-slot name="active">Preview</x-slot>


    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 col-span-12">
            <div class="box overflow-hidden main-content-card">
                <div class="box-body text-center p-5">
                    <div class="aspect-w-16 aspect-h-9">

                        {{-- <a href="https://drive.google.com/file/d/{{ $id }}/view"
                                class="btn btn-sm btn-secondary" target="_blank">
                                Fullscreen
                            </a> --}}

                        <h1 class="text-2xl font-semibold mb-4">{{ $fileName }}</h1>
                        <p class="mb-2"><strong>File type:</strong> {{ $mimeType }}</p>
                        <p class="mb-4"><strong>File size:</strong> {{ $fileSizeFormatted }}</p>

                        @if ($previewUrl)
                            <div style="height:600px;">
                                <iframe src="{{ $previewUrl }}" width="100%" height="100%" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                        <a href="{{ $downloadUrl }}" download="{{ $fileName }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                            </svg>
                            &ensp; Download
                        </a>

                        {{-- 

                        <!-- Iframe Container -->
                        <div class="relative">
                            <iframe id="sheetIframe" src="{{ $embedUrl }}" width="100%" height="600"
                                frameborder="0" allowfullscreen class="w-full rounded shadow"></iframe>
                        </div>


                        <script>
                            function openFullscreen() {
                                const iframe = document.getElementById('sheetIframe');
                                if (iframe.requestFullscreen) {
                                    iframe.requestFullscreen();
                                } else if (iframe.webkitRequestFullscreen) { // Safari
                                    iframe.webkitRequestFullscreen();
                                } else if (iframe.msRequestFullscreen) { // IE11
                                    iframe.msRequestFullscreen();
                                }
                            }
                        </script> --}}
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
