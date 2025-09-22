<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('v1/style-table.css') }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet">

<link rel="stylesheet" href="/assets/libs/quill/quill.snow.css">
<link rel="stylesheet" href="/assets/libs/quill/quill.bubble.css">
<link rel="stylesheet" href="/assets/libs/filepond/filepond.min.css">
<link rel="stylesheet" href="/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">
<link rel="stylesheet" href="/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@php
    $details = App\Models\ProjectBidding::where('id', $id)->first();
@endphp

@include('pages.apps.bids.forms.edit-partials.form')

@include('pages.apps.bids.forms.edit-partials.script')
@include('pages.apps.bids.forms.edit-partials.submit')

@include('pages.apps.bids.raw.plan-panther.create-js')
