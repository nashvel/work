<x-app-layout>
    <x-slot name="back"></x-slot>
    <x-slot name="header">{{ __('Manage Hero Content') }}</x-slot>
    <x-slot name="subHeader">{{ __('You can manage your hero page and view content here.') }}</x-slot>
    <x-slot name="btn"></x-slot>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="row">
                    <div class="card" style="min-height: 70vh;">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner">
                                <div class="card-body">
                                    <h1 class="text-2xl fw-bold">Edit Hero Section Content</h1>
                                    <p>You can update the content by modifying the record below.</p>
                                    <hr class="mt-4 mb-4">
                                    <form action="{{ route('content.services.store') }}" method="POST">
                                        @csrf
                                        <!-- Title 1 -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="title1">Title 1 <b
                                                            class="text-danger">*</b></label>
                                                    <span class="form-note">Specify the first title here.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-info"></em>
                                                        </div>
                                                        <input type="text" class="form-control" id="title1"
                                                            name="title1"
                                                            placeholder="Enter (Required) Title 1 here..." required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description 1 -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="description1">Description 1 <b
                                                            class="text-danger">*</b></label>
                                                    <span class="form-note">Specify the first description here.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-info"></em>
                                                        </div>
                                                        <textarea class="form-control" id="description1" name="description1"
                                                            placeholder="Enter (Required) Description 1 here..." required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Repeat for Title 2 to Title 6 and their corresponding descriptions -->
                                        @for ($i = 2; $i <= 6; $i++)
                                            <div class="row mt-2 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="title{{ $i }}">Title
                                                            {{ $i }}</label>
                                                        <span class="form-note">Specify Title {{ $i }}
                                                            here.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-right">
                                                                <em class="icon ni ni-info"></em>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                id="title{{ $i }}"
                                                                name="title{{ $i }}"
                                                                placeholder="Enter Title {{ $i }} here...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-2 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="description{{ $i }}">Description
                                                            {{ $i }}</label>
                                                        <span class="form-note">Specify Description {{ $i }}
                                                            here.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-right">
                                                                <em class="icon ni ni-info"></em>
                                                            </div>
                                                            <textarea class="form-control" id="description{{ $i }}" name="description{{ $i }}"
                                                                placeholder="Enter Description {{ $i }} here..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor

                                        <!-- Submit and Reset Buttons -->
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7" style="float: right">
                                            <hr>
                                        </div>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7 justify-end" style="float: right">
                                            <div class="form-group mt-2 mb-2 justify-end">
                                                <button type="reset" class="btn btn-light bg-white mx-3">
                                                    <em class="icon ni ni-repeat"></em>&ensp;Reset
                                                </button>
                                                <button type="submit" class="btn btn-light bg-white">
                                                    <em class="icon ni ni-save"></em>&ensp;Submit Record
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
</x-app-layout>
