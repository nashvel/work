<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    {{-- Header Component --}}
                    @include('modules.project-management.create.header')

                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Basic Information Component --}}
                            @include('modules.project-management.create.basic-info')

                            {{-- Status and Priority Component --}}
                            @include('modules.project-management.create.status-priority')

                            {{-- Dates Component --}}
                            @include('modules.project-management.create.dates')

                            {{-- Budget and Manager Component --}}
                            @include('modules.project-management.create.budget-manager')
                        </div>

                        {{-- Form Actions Component --}}
                        @include('modules.project-management.create.form-actions')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
