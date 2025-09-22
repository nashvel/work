<x-app-layout>

    <x-slot name="title">Manage Virtual Assistant</x-slot>
    <x-slot name="url_1">{"link": "/virtual-assistant/list", "text": "Manage"}</x-slot>
    <x-slot name="active">Virtual Assistant Information</x-slot>
    <x-slot name="buttons">
        @if (Auth::user()->role == 'Administrator')
            <button class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0" data-hs-overlay="#create-va">
                <i class="bi bi-person-plus-fill me-1"></i> Register New Virtual Assistant
            </button>
        @endif
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the virtual assistant here.
                    <hr class="mb-3 mt-3">
                    <div class="custom-box">
                        @include('pages.contents.inquiry.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


{{-- <x-app-layout>
    <x-slot name="back"></x-slot>
    <x-slot name="header">{{ __('Manage Contact Us Section') }}</x-slot>
    <x-slot name="subHeader">{{ __('You can manage your contact us page and view content here.') }}</x-slot>
    <x-slot name="btn"></x-slot>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="row">
                    <div class="card" style="min-height: 70vh;">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner">
                                <div class="card-body">
                                    <h1 class="text-2xl fw-bold">Customer Messages</h1>
                                    <p>You can read the content by view the record below.</p>
                                    <hr class="mt-4 mb-4">
                                    <table class="datatable-init table">
                                        <thead>
                                            <tr>
                                                <th width="10">#</th>
                                                <th width="200" >Name</th>
                                                <th width="200" >Email Address</th>
                                                <th width="200" >Subject</th>
                                                <th>Message</th>
                                                <th width="120" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $index => $rw)
                                                <tr>
                                                    <td>{{ $index + 1 }}.</td>
                                                    <td>{{ $rw->name }}</td>
                                                    <td>{{ $rw->email }}</td>
                                                    <td>{{ $rw->subject }}</td>
                                                    <td>{{ $rw->message }}</td>
                                                    <td>
                                                        <a href="mailto:{{ $rw->email }}"  class="btn btn-xs btn-light bg-white btn-block">
                                                            <em class="icon ni ni-mail"></em> &ensp; Reply
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
