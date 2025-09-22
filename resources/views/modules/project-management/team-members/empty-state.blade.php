<div class="bg-white shadow-xl sm:rounded-lg">
    <div class="text-center py-16">
        <i class="bi bi-people text-6xl text-gray-400 mx-auto block"></i>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No team members yet</h3>
        <p class="mt-2 text-gray-500 max-w-sm mx-auto">
            Get started by adding team members to collaborate on <strong>{{ $project->name }}</strong>.
        </p>
        <div class="mt-8">
            <button onclick="openAddMemberModal()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center gap-2 mx-auto">
                <i class="bi bi-person-plus"></i>
                Add Your First Team Member
            </button>
        </div>
    </div>
</div>
