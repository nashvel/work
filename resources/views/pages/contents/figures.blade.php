<x-app-layout>
    <x-slot name="back"></x-slot>
    <x-slot name="header">{{ __('Manage Figures Sections') }}</x-slot>
    <x-slot name="subHeader">{{ __('You can manage your figure page and view content here.') }}</x-slot>
    <x-slot name="btn"></x-slot>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner">
                                <div class="card-body">
                                    <form action="{{ route('content.figures.store') }}" method="POST">
                                        @csrf
                                        <!-- Client Count -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="client_count">Client Count: <b
                                                            class="text-danger">*</b></label>
                                                    <span class="form-note">Specify the total client count.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="client_count"
                                                        name="client_count" value="{{ $data->client_count ?? '0'}}" placeholder="Enter Client Count" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Project Count -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="project_count">Project Count: <b
                                                            class="text-danger">*</b></label>
                                                    <span class="form-note">Specify the total project count.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="project_count"
                                                        name="project_count" value="{{ $data->project_count ?? '0'}}" placeholder="Enter Project Count" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hours of Support Count -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="hours_of_support_count">Hours of
                                                        Support Count: <b class="text-danger">*</b></label>
                                                    <span class="form-note">Specify the total hours of support
                                                        provided.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <input type="number" class="form-control"
                                                        id="hours_of_support_count" value="{{ $data->hours_of_support_count ?? '0'}}" name="hours_of_support_count"
                                                        placeholder="Enter Hours of Support Count" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Workers Count -->
                                        <div class="row mt-2 align-center">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="workers_count">Workers Count: <b
                                                            class="text-danger">*</b></label>
                                                    <span class="form-note">Specify the total workers count.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="workers_count"
                                                        name="workers_count" value="{{ $data->workers_count ?? '0'}}" placeholder="Enter Workers Count" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12" style="float: right">
                                            <hr class="mt-4 mb-3">
                                        </div>

                                        <div class="col-lg-10 justify-end mb-3" style="float: right">
                                            <div class="form-group mt-2 mb-2 justify-end">
                                                <button type="reset" class="btn btn-danger mx-3">
                                                    <em class="icon ni ni-repeat"></em>&ensp; Reset
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    <em class="icon ni ni-save"></em>&ensp; Save Record
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
