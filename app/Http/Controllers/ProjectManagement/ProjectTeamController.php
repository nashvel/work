<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectTeamController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:member,lead,manager,viewer',
        ]);
        if ($project->teamMembers()->where('user_id', $validated['user_id'])->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'User is already a team member.'
            ], 422);
        }

        $project->teamMembers()->attach($validated['user_id'], [
            'role' => $validated['role'],
            'joined_at' => now()
        ]);

        $user = User::find($validated['user_id']);

        return response()->json([
            'success' => true,
            'message' => 'Team member added successfully.',
            'user' => $user,
            'role' => $validated['role']
        ]);
    }

    public function destroy(Project $project, User $user)
    {
        $project->teamMembers()->detach($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Team member removed successfully.'
        ]);
    }

    public function updateRole(Request $request, Project $project, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:member,lead,manager,viewer',
        ]);

        $project->teamMembers()->updateExistingPivot($user->id, [
            'role' => $validated['role']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Team member role updated successfully.',
            'user' => $user,
            'role' => $validated['role']
        ]);
    }
}
