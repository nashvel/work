<x-app-layout>

    <x-slot name="title">Manage Partners Section</x-slot>
    <x-slot name="url_1">{"link": "/cms/partners", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/cms/partners", "text": "Partners"}</x-slot>
    <x-slot name="active">Logo</x-slot>
    <x-slot name="buttons">
        <button type="button" class="hs-overlay-open ti-btn btn-wave ti-btn-light bg-white text-dark"
            data-hs-overlay="#hs-extralarge-modal">
            <i class="bi bi-upload px-1"></i>
            Upload Logo
        </button>
    </x-slot>

    <link rel="stylesheet" href="/assets/libs/dragula/dragula.min.css">

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">

            @php
                $galleryItems = App\Models\CMS_Partners::orderBy('img_column')->orderBy('img_row')->get();
            @endphp

            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the partners here.
                    <hr class="mb-3 mt-3">
                    <div class="grid grid-cols-4 gap-4 custom-box ">
                        @for ($col = 1; $col <= 4; $col++)
                            @php
                                $columnItems = $galleryItems->where('img_column', $col)->sortBy('img_row');
                            @endphp

                            @if ($columnItems->isNotEmpty())
                                <div class="col-span-1 drag-column bg-white" id="post_{{ $col }}">
                                    @foreach ($columnItems as $item)
                                        <div class="box draggable-item relative text-gray-800"
                                            data-id="{{ $item->id }}" data-row="{{ $item->img_row }}">
                                            <button
                                                class="delete-btn absolute top-2 right-2 z-50 bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700"
                                                data-id="{{ $item->id }}"
                                                onclick="delete_image({{ $item->id }})">
                                                ✖
                                            </button>

                                            <div class="relative group">
                                                <img src="{{ asset('storage/' . $item->image_path) }}"
                                                    class="media-preview rounded-md" alt="{{ $item->title }}">

                                                <!-- Buttons on hover -->
                                                <div
                                                    class="absolute inset-0 bg-black/7 border-radius-20 flex justify-center items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <button
                                                        class="hover-button bg-green-500 text-white px-3 py-1 rounded-md text-sm"
                                                        data-hs-overlay="#change-logo"
                                                        onclick="changeLogo({{ $item->id }}, '{{ asset('storage/' . $item->image_path) }}', '{{ $item->company }}')">
                                                        <center>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-photo-edit">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M15 8h.01" />
                                                                <path
                                                                    d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4" />
                                                                <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3" />
                                                                <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596" />
                                                                <path
                                                                    d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                                            </svg>
                                                            Change 
                                                        </center>
                                                    </button>
                                                    <button
                                                        class="hover-button bg-yellow-500 text-white px-3 py-1 rounded-md text-sm"
                                                        data-hs-overlay="#watch-video"
                                                        onclick="watchVideo({{ $item->id }}, '{{ asset('storage/' . $item->video_ads) }}')">
                                                        <center>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-video">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" />
                                                                <path
                                                                    d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                                            </svg>
                                                            Video
                                                        </center>
                                                    </button>

                                                </div>
                                            </div>


                                            <hr class=" mb-1">

                                            <form action="{{ route('cms.partners.info.update', ['id' => $item->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="w-full">
                                                    <label for="company-name-{{ $item->id }}"
                                                        class="block text-sm font-medium text-gray-700 mb-1">
                                                        Company Name : <strong class="text-danger">*</strong>
                                                    </label>
                                                    <div class="relative">
                                                        <input type="text" value="{{ $item->company }}"
                                                            name="company_name" id="company-name-{{ $item->id }}"
                                                            placeholder="ABC Ltd." required
                                                            class="mt-1 w-full border ti-form-input ps-11 focus:z-10 border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                        <div
                                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                                            <i class="bi bi-building"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <label for="video_{{ $item->id }}"
                                                        class="block text-sm font-medium text-gray-700 mb-1">
                                                        Upload Video :
                                                    </label>
                                                    <input type="file" accept="video/*"
                                                        class="video-upload-input border border-gray-300 p-2 rounded-md shadow-sm text-sm text-gray-700 bg-white w-full"
                                                        name="video_{{ $item->id }}">
                                                </div>

                                                <div class="mt-4">
                                                    <button type="submit" id="submit-btn" onclick="submit(event)"
                                                        class="bg-gray-200 text-dark px-6 py-2 w-full rounded-md hover:bg-green-600 transition">
                                                        <i class="bi bi-check2-circle px-1"></i> Save Changes
                                                    </button>
                                                </div>
                                            </form>


                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.contents.partners.modal')
    @include('pages.contents.partners.settings')

    <script src="/assets/libs/dragula/dragula.min.js"></script>
    <script src="/assets/js/draggable-cards.js"></script>

</x-app-layout>
