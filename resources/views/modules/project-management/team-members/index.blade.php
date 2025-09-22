<x-app-layout>
    <x-slot name="url_0">{"link": "{{ route('project-management.list') }}", "text": "Projects"}</x-slot>
    <x-slot name="url_1">{"link": "{{ route('projects.dashboard', $project->id) }}", "text": "{{ $project->name }}"}</x-slot>
    <x-slot name="active">Team Members</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('modules.project-management.team-members.header')
            
            <div class="mt-6">
                @if($project->teamMembers->count() > 0)
                    @include('modules.project-management.team-members.grid')
                @else
                    @include('modules.project-management.team-members.empty-state')
                @endif
            </div>
        </div>
    </div>

    @include('modules.project-management.team-members.add-member-modal')
    @include('modules.project-management.team-members.edit-role-modal')
    @include('modules.project-management.team-members.scripts')
</x-app-layout>
