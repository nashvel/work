<x-app-layout>

    <x-slot name="title">Manage Banner Section</x-slot>
    <x-slot name="url_1">{"link": "/cms/banner", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/cms/banner", "text": "Banner"}</x-slot>
    <x-slot name="active">Content</x-slot>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xl:col-span-12 col-span-12">

            <iframe src="/builder/banner" frameborder="3" class="shadow" height="519" style="width: 100%;"></iframe>

            <div class="box mt-6">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the banner here.
                    <hr class="mb-3 mt-3">
                    <form action="{{ route('cms.hero.store') }}" id="heroForm" method="POST" autocomplete="off">
                        @csrf
                        <div class="grid grid-cols-12 gap-x-6">
                            <div class="xl:col-span-3 col-span-12">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label" for="welcome_message">Welcome
                                            Message:
                                            <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input type="text" value="{{ $hero->welcome_message ?? '' }}"
                                            class="form-control form-control-lg text-dark text-bold" id="welcome_message" name="welcome_message" required>
                                    </div>
                                </div>
                            </div>

                            <div class="xl:col-span-4 col-span-12">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label" for="sub_message">Welcome Sub
                                            Message:
                                            <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input type="text" value="{{ $hero->sub_message ?? '' }}"
                                            class="form-control form-control-lg" id="sub_message" name="sub_message" required>
                                    </div>
                                </div>
                            </div>
                            <div class="xl:col-span-2 col-span-12">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label" for="get_started_link">"Get
                                            Started" Link: <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input type="text" value="{{ $hero->get_started_link ?? '' }}"
                                            class="form-control form-control-lg" id="get_started_link" name="get_started_link" required>
                                    </div>
                                </div>
                            </div>
                            <div class="xl:col-span-2 col-span-12">
                                <div class="col-6-2">
                                    <div class="form-group">
                                        <label class="form-label" for="contact_us_link">"Contact
                                            Us" Link: <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input type="text" value="{{ $hero->contact_us_link ?? '' }}"
                                            class="form-control  form-control-lg" id="contact_us_link" name="contact_us_link" required>
                                    </div>
                                </div>
                            </div>
                            <div class="xl:col-span-1 col-span-12">
                                <div class="col-lg-2">
                                    <div class="form-group text-white">
                                       -
                                    </div>
                                </div>
                                <div class="col-lg-10 pt-3">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-800 transition">
                                        <em class="bi bi-check2-circle "></em> 
                                        <span class="mx-2">Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
