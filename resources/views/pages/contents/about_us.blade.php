<x-app-layout>

    <x-slot name="title">Manage About Us Section</x-slot>
    <x-slot name="url_1">{"link": "/cms/about-us", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/cms/about-us", "text": "About Us"}</x-slot>
    <x-slot name="active">Content</x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xl:col-span-12 col-span-12">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Whoops! Something went wrong.</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <hr>
            @endif

            <iframe src="/builder/about" frameborder="3" class="shadow" height="820" style="width: 100%;"></iframe>

            <div class="box mt-6">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the about us here.
                    <hr class="mb-3 mt-3">
                    <form action="{{ route('cms.about_us.update', $data->id) }}" enctype="multipart/form-data" method="POST" class="custom-box">
                        @csrf
                        <!-- About Us Description -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-2">
                                <div class="re">
                                    <label class="form-label" for="description">About Us : <b
                                            class="text-danger">*</b></label>

                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="relative">
                                    <textarea
                                        class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        id="description" name="description" rows="2" required>{{ $data->description ?? '' }}</textarea>
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-bookmarks text-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sub Header -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-2">
                                <div class="relative">
                                    <label class="form-label" for="sub_header">Sub Header: <b
                                            class="text-danger">*</b></label>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="relative">
                                    <input type="text"
                                        class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 fw-bolder"
                                        id="sub_header" value="{{ $data->sub_header ?? '' }}" name="sub_header"
                                        placeholder="Enter Sub Header" required>
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-columns-gap text-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sub Titles and Descriptions -->
                        @php
                            $icons = ['', 'clock', 'person-check', 'clipboard2-check', 'alarm'];
                        @endphp
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="grid grid-cols-12 gap-x-6 pt-3">
                                <div class="xl:col-span-3 col-span-12">
                                    <div class="col-lg-2">
                                        <div class="relative mb-0">
                                            <label class="form-label" for="sub_title_{{ $i }}">
                                                {{ $data->{'sub_title_' . $i} ?? '' }} : <b class="text-danger">*</b>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="relative">
                                            <input type="text"
                                                class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 fw-bolder"
                                                id="sub_title_{{ $i }}" name="sub_title_{{ $i }}"
                                                value="{{ $data->{'sub_title_' . $i} ?? '' }}"
                                                placeholder="Enter Sub-Title {{ $i }}" required>
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                                <i class="bi bi-{{ $icons[$i] }} text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="xl:col-span-9 col-span-12">
                                    <div class="col-lg-2">
                                        <div class="relative">
                                            <label class="form-label" for="sub_title_description_{{ $i }}">
                                                Details :
                                                <b class="text-danger">*</b>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="relative">
                                            <input type="text"
                                                class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                                id="sub_title_description_{{ $i }}"
                                                value="{{ $data->{'sub_title_description_' . $i} ?? '' }}"
                                                name="sub_title_description_{{ $i }}" rows="3"
                                                required />
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                                <i class="bi bi-info-square text-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor


                        <!-- Banner  -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-2">
                                <div class="relative">
                                    <label class="form-label" for="banner">Image Banner : <b
                                            class="text-danger">*</b></label>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="relative">
                                    <input type="file" accept="image/*"
                                        class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        id="banner" name="banner">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-play text-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Video  -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-2">
                                <div class="relative">
                                    <label class="form-label" for="video_link">Video Link:</label>
                                    <span class="form-note">Provide a video file</span>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="relative">
                                    <input type="file"  accept="video/*"
                                        class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                        id="video_link" name="video_link">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                        <i class="bi bi-play text-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="box-footer">
                    <div class="flex justify-end space-x-3">
                        <button type="reset"
                            class="bg-gray-100 text-dark px-4 py-2 rounded-md hover:bg-gray-300 transition"
                            data-hs-overlay="#hs-extralarge-modal">
                            Reset
                        </button>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-800 transition">
                            <i class="bi bi-check2-save"></i>
                            <span class="mx-1">Save</span>
                        </button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>


    </div>

</x-app-layout>


{{-- <x-app-layout>
    <x-slot name="back"></x-slot>
    <x-slot name="header">{{ __('Manage About Us') }}</x-slot>
    <x-slot name="subHeader">{{ __('You can manage your about us page and view content here.') }}</x-slot>
    <x-slot name="btn"></x-slot>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="row">
                    <div class="card" style="min-height: 70vh;">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner">
                                <div class="card-body">

                                    <form action="{{ route('content.about_us.store') }}" method="POST">
                                        @csrf
                                        <!-- About Us Description -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-2">
                                                <div class="relative">
                                                    <label class="form-label" for="description">About Us Description: <b
                                                            class="text-danger">*</b></label>
                                                    <span class="form-note">Provide the description for About
                                                        Us.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="relative">
                                                    <textarea class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="description" name="description" rows="2" required>{{ $data->description ?? ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sub Header -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-2">
                                                <div class="relative">
                                                    <label class="form-label" for="sub_header">Sub Header: <b
                                                            class="text-danger">*</b></label>
                                                    <span class="form-note">Specify the sub-header text.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="relative">
                                                    <input type="text" class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 fw-bolder" id="sub_header" value="{{ $data->sub_header ?? ''}}"
                                                        name="sub_header" placeholder="Enter Sub Header" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sub Titles and Descriptions -->
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="row mt-2 align-center">
                                                <div class="col-lg-2">
                                                    <div class="relative">
                                                        <label class="form-label"
                                                            for="sub_title_{{ $i }}">Challenges Sub Title
                                                            #{{ $i }} : <b class="text-danger">*</b></label>
                                                        <span class="form-note">Provide Sub-Title {{ $i }}
                                                            text.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10">
                                                    <div class="relative">
                                                        <input type="text" class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 fw-bolder"
                                                            id="sub_title_{{ $i }}"
                                                            name="sub_title_{{ $i }}"
                                                            value="{{ $data->{'sub_title_' . $i} ?? '' }}"
                                                            placeholder="Enter Sub-Title {{ $i }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-2 align-center">
                                                <div class="col-lg-2">
                                                    <div class="relative">
                                                        <label class="form-label"
                                                            for="sub_title_description_{{ $i }}">Challenges Sub Title
                                                            #{{ $i }} Description : <b
                                                                class="text-danger">*</b></label>
                                                        <span class="form-note">Provide a description for Sub-Title
                                                            {{ $i }}.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10">
                                                    <div class="relative">
                                                        <input type="text" class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                                            id="sub_title_description_{{ $i }}"
                                                            value="{{ $data->{'sub_title_description_' . $i} ?? '' }}"
                                                            name="sub_title_description_{{ $i }}"
                                                            rows="3" required />
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor

                                        <!-- Video Link -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-2">
                                                <div class="relative">
                                                    <label class="form-label" for="video_link">Video Link:</label>
                                                    <span class="form-note">Provide a video link (optional).</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="relative">
                                                    <input type="url" class="mt-1 w-full border ti-form-input ps-11 focus:z-10  border-gray-300 p-2 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="video_link" value="{{ $data->video_link ?? ''}}"
                                                        name="video_link" placeholder="Enter Video Link (optional)">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12" style="float: right">
                                            <hr class="mt-4 mb-3">
                                        </div>

                                        <div class="col-lg-10 justify-end mb-3" style="float: right">
                                            <div class="relative mt-2 mb-2 justify-end">
                                                <button type="reset" class="btn btn-danger mx-3">
                                                    <em class="icon ni ni-repeat"></em>&ensp; Reset
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    <em class="icon ni ni-save"></em>&ensp; Update Record
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
