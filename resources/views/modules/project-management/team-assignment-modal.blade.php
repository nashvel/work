<div id="teamAssignmentModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden transition-opacity duration-300 flex items-center justify-center">
    <div class="relative mx-auto p-6 border w-full max-w-md shadow-xl rounded-lg bg-white transform transition-all duration-300 scale-95 my-8">
        <div class="mt-3">
            {{-- Header Component --}}
            @include('modules.project-management.team-assignment.header')

            {{-- Current Team Members Component --}}
            @include('modules.project-management.team-assignment.current-members')

            {{-- Add Member Form Component --}}
            @include('modules.project-management.team-assignment.add-member-form')

            {{-- Modal Actions Component --}}
            @include('modules.project-management.team-assignment.modal-actions')
        </div>
    </div>
</div>

{{-- Team Assignment JavaScript Component --}}
@include('modules.project-management.team-assignment.scripts')
