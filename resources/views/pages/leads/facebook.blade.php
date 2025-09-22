<x-app-layout>
    @php
        switch ($link) {
            case 'x':
                $tag = 'X (Twitter) Leads';
                $href = 'https://twitter.com/';
                $theme = 'bg-black';
                $icon = 'bi-twitter-x';
                break;
            case 'tiktok':
                $tag = 'TikTok Leads';
                $href = 'https://www.tiktok.com/@hillbcs_tiktok/video/7517532953660886280?';
                $theme = 'bg-gray-800';
                $icon = 'bi-tiktok';
                break;
            case 'instagram':
                $tag = 'Instagram Leads';
                $href = 'https://www.instagram.com/';
                $theme = 'bg-pink-500';
                $icon = 'bi-instagram';
                break;
            case 'linkedin':
                $tag = 'LinkedIn Leads';
                $href = 'https://www.linkedin.com/';
                $theme = 'bg-blue-700';
                $icon = 'bi-linkedin';
                break;
            case 'youtube':
                $tag = 'YouTube Leads';
                $href = 'https://www.youtube.com/@HillbcsYT';
                $theme = 'bg-red-600';
                $icon = 'bi-youtube';
                break;
            default:
                $tag = 'Facebook Leads';
                $href = 'https://www.facebook.com/people/Integrity-Outsourcing-Services/61567995020849/';
                $theme = 'bg-blue-500';
                $icon = 'bi-facebook';
                break;
        }
    @endphp



    <x-slot name="title">Manage {{ $tag }}</x-slot>
    <x-slot name="url_1">{"link": "/lead/facebook/list", "text": "{{ $tag }}"}</x-slot>
    <x-slot name="url_2">{"link": "/lead/facebook/list", "text": "Manage"}</x-slot>
    <x-slot name="active">{{ $tag }}</x-slot>
    <x-slot name="buttons">
        <a href="/crm/lead/facebook/create" class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave me-0">
            <i class="bi bi-plus-lg me-1"></i>
            <span class="mx-1">Register {{ $tag }}</span>
        </a>
        <a href="{{ $href }}" target="_blank"
            class="ti-btn ti-btn-light mx-2 text-white {{ $theme }} !border-0 btn-wave me-0">
            <i class="bi {{ $icon }} me-1"></i>
            <span class="mx-1">Follow Us On {{ Str::title(Str::replace('Leads', '', $tag)) }}</span>
        </a>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> You can manage the {{ $tag }} here.
                    <hr class="mb-3 mt-3">
                    @include('pages.leads.tables.fblist')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
