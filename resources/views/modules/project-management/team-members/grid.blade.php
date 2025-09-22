<div class="bg-white shadow-xl sm:rounded-lg">
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="teamMembersGrid">
            @foreach($project->teamMembers as $member)
                @include('modules.project-management.team-members.member-card', ['member' => $member])
            @endforeach
        </div>
    </div>
</div>
