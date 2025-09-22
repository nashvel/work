<x-app-layout>

    <x-slot name="back_link">{"link": "/project-management/{{ $project->id }}/dashboard", "text": "Project Dashboard"}</x-slot>
    <x-slot name="title">Edit Project - {{ $project->name }}</x-slot>
    <x-slot name="url_1">{"link": "/project-management/list", "text": "Project"}</x-slot>
    <x-slot name="url_2">{"link": "/project-management/list", "text": "Management"}</x-slot>
    <x-slot name="active">Edit {{ $project->name }}</x-slot>
    <x-slot name="buttons">

    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('projects.update', $project) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- Basic Information Component --}}
                        @include('modules.project-management.edit.basic-info')

                        {{-- Status and Priority Component --}}
                        @include('modules.project-management.edit.status-priority')

                        {{-- Dates Component --}}
                        @include('modules.project-management.edit.dates')

                        {{-- Budget and Folder Component --}}
                        @include('modules.project-management.edit.budget-folder')

                        {{-- Description Component --}}
                        @include('modules.project-management.edit.description')

                        {{-- Form Actions Component --}}
                        @include('modules.project-management.edit.form-actions')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    @endpush

    @push('scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    {{-- JavaScript Component --}}
    @include('modules.project-management.edit.scripts')
    @endpush

</x-app-layout>