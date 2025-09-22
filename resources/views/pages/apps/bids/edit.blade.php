<x-app-layout>

    @php
        $details = App\Models\ProjectBidding::where('id', $id)->first();
    @endphp

    <x-slot name="back_link">{"link": "/project/list/details/{{ $id }}", "text": "Project Details"}</x-slot>
    <x-slot name="title">Update Bidding {{ request()->has('t') ? '(' . request('t') . ')' : '(' . $details->proj_name . ')' }}</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Bidding"}</x-slot>
    <x-slot name="active">{{ request()->has('t') ? request('t') : $details->proj_name }}</x-slot>
    <x-slot name="buttons">

    </x-slot>

    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">

    <div class="hidden" id="upload-panel">
        <div class="main-content-card" style="min-height: 600px">
            <div class="pt-6 pb-6">
                <br><br><br><br><br><br><br>
                <center>
                    <img src="{{ asset('v1/file-storage.png') }}" style="height: 130px">
                    <p class="text-lg text-dark">
                        <strong id="project-name">Test 1</strong> <br>
                        <span id="uploadPercent" class="text-lg text-dark ">Uploading: 0%</span> <br>
                        <span class="text-sm text-dark" id="statusPercent">Please wait..</span>
                    </p>
                </center>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box" id="register-panel">
                <div class="box-body">
                    @include('pages.apps.bids.forms.edit')
                </div>
            </div>
        </div>
    </div>

    @include('pages.apps.bids.partials.contacts')

</x-app-layout>
