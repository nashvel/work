<x-app-layout>

    <x-slot name="title">Manage Team Members</x-slot>
    <x-slot name="url_1">{"link": "/cms/teams", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/cms/teams", "text": "Team Members"}</x-slot>
    <x-slot name="active">Profile</x-slot>
    <x-slot name="buttons">
        <button type="button" class="hs-overlay-open ti-btn btn-wave ti-btn-light bg-white text-dark"
            data-hs-overlay="#hs-extralarge-modal">
            <i class="bi bi-upload px-1"></i>
            Upload Profile
        </button>
    </x-slot>

    <link rel="stylesheet" href="/assets/libs/dragula/dragula.min.css">

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            
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

            @php
                $galleryItems = App\Models\CMS_Teams::orderBy('img_column')->orderBy('img_row')->get();
            @endphp

            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the team member here.
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
                                                        onclick="changeLogo({{ $item->id }}, '{{ asset('storage/' . $item->image_path) }}', '{{ $item->name }}')">
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

                                                </div>
                                            </div>


                                            <hr class=" mb-1">

                                            <form action="{{ route('cms.teams.info.update', ['id' => $item->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="w-full">
                                                    <label for="name-{{ $item->id }}"
                                                        class="block text-sm font-medium text-gray-700 mb-1">
                                                        Complete Name : <strong class="text-danger">*</strong>
                                                    </label>
                                                    <div class="relative">
                                                        <input type="text" value="{{ $item->name }}"
                                                            name="name" id="name-{{ $item->id }}"
                                                            placeholder="ABC Ltd." required
                                                            class="mt-1 w-full border ti-form-input ps-11 focus:z-10 border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                        <div
                                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="w-full mt-3">
                                                    <label for="postion-{{ $item->id }}"
                                                        class="block text-sm font-medium text-gray-700 mb-1">
                                                        Position : <strong class="text-danger">*</strong>
                                                    </label>
                                                    <div class="relative">
                                                        <input type="text" value="{{ $item->designation }}"
                                                            name="designation" id="designation-{{ $item->id }}"
                                                            placeholder="ABC Ltd." required
                                                            class="mt-1 w-full border ti-form-input ps-11 focus:z-10 border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                        <div
                                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                                            <i class="bi bi-building"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <button type="submit" id="submit-btn"
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

    @include('pages.contents.teams.modal')
    @include('pages.contents.teams.settings')

    <script src="/assets/libs/dragula/dragula.min.js"></script>
    <script src="/assets/js/draggable-cards.js"></script>

</x-app-layout>
