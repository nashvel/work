<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Models\ProjectManagement\Task;
use App\Models\ProjectManagement\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        $users = $project->teamMembers;
        return view('tasks.create', compact('project', 'users'));
    }

    public function store(Request $request, Project $project)
    {
        Log::info('Task creation request received', [
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,review,completed,cancelled',
            'priority' => 'required|in:low,medium,high,critical',
            'due_date' => 'nullable|date',
            'estimated_hours' => 'nullable|integer|min:0',
            'assigned_to' => 'nullable|exists:users,id',
            'order' => 'nullable|integer|min:0',
        ]);

        Log::info('Task validation passed', [
            'validated_data' => $validated
        ]);

        $validated['project_id'] = $project->id;
        $validated['created_by'] = Auth::id();

        if (!isset($validated['order'])) {
            $validated['order'] = $project->tasks()->max('order') + 1;
        }

        try {
            $task = Task::create($validated);
            
            Log::info('Task created successfully', [
                'task_id' => $task->id,
                'task_data' => $task->toArray()
            ]);

            // Check if this is an AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Task created successfully.',
                    'task' => $task->load('assignedUser')
                ]);
            }

            return redirect()->route('projects.dashboard', $project)
                            ->with('success', 'Task created successfully.');
        } catch (\Exception $e) {
            Log::error('Task creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Check if this is an AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create task: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                            ->with('error', 'Failed to create task: ' . $e->getMessage())
                            ->withInput();
        }
    }

    public function edit(Project $project, Task $task)
    {
        $users = $project->teamMembers;
        return view('tasks.edit', compact('project', 'task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        Log::info('Task update request received', [
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);

        // Handle both form data and JSON data
        $data = $request->all();
        
        // Validation rules - make all fields optional for partial updates
        $rules = [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:todo,in_progress,review,completed,cancelled',
            'priority' => 'sometimes|required|in:low,medium,high,critical',
            'due_date' => 'nullable|date',
            'estimated_hours' => 'nullable|integer|min:0',
            'actual_hours' => 'nullable|integer|min:0',
            'assigned_to' => 'nullable|exists:users,id',
            'order' => 'nullable|integer|min:0',
        ];

        $validated = $request->validate($rules);

        try {
            $task->update($validated);
            
            Log::info('Task updated successfully', [
                'task_id' => $task->id,
                'updated_fields' => array_keys($validated)
            ]);

            // Check if this is an AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Task updated successfully.',
                    'task' => $task->load('assignedUser')
                ]);
            }

            return redirect()->route('projects.dashboard', $task->project)
                            ->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            Log::error('Task update failed', [
                'task_id' => $task->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update task: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                            ->with('error', 'Failed to update task: ' . $e->getMessage())
                            ->withInput();
        }
    }

    public function getAssignments(Task $task)
    {
        try {
            $assignments = [];
            
            $assignedUsers = $task->assignedUsers;
            
            if ($assignedUsers->isEmpty() && $task->assignedUser) {
                $assignments[] = [
                    'id' => $task->assignedUser->id,
                    'name' => $task->assignedUser->name,
                    'email' => $task->assignedUser->email,
                    'avatar' => null // Force use of initials avatars
                ];
            } else {
                foreach ($assignedUsers as $user) {
                    $assignments[] = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'avatar' => null // Force use of initials avatars
                    ];
                }
            }
            
            return response()->json([
                'success' => true,
                'assignments' => $assignments
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching task assignments', [
                'task_id' => $task->id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch assignments'
            ], 500);
        }
    }

    public function assign(Request $request, Task $task)
    {
        try {
            Log::info('Assignment request received', [
                'task_id' => $task->id,
                'request_data' => $request->all()
            ]);

            $validated = $request->validate([
                'assigned_to' => 'nullable|exists:users,id',
                'assigned_users' => 'nullable|array',
                'assigned_users.*' => 'exists:users,id'
            ]);
            
            if (isset($validated['assigned_users'])) {
                Log::info('Processing multiple assignees', ['users' => $validated['assigned_users']]);
                
                // Handle empty array (clear all assignments)
                if (empty($validated['assigned_users'])) {
                    $task->assignedUsers()->detach();
                    $task->update(['assigned_to' => null]);
                } else {
                    // Sync the many-to-many relationship
                    $task->assignedUsers()->sync($validated['assigned_users']);
                    
                    // Update the primary assigned_to field
                    $task->update([
                        'assigned_to' => $validated['assigned_users'][0] ?? null
                    ]);
                }
                
                Log::info('Task multiple assignments updated', [
                    'task_id' => $task->id,
                    'assigned_users' => $validated['assigned_users'],
                    'primary_assigned_to' => $validated['assigned_users'][0] ?? null,
                    'user_id' => Auth::id()
                ]);
            } else {
                // Handle single assignment (backward compatibility) or empty assignment
                $assignedTo = $validated['assigned_to'] ?? null;
                
                $task->update([
                    'assigned_to' => $assignedTo
                ]);
                
                // Clear many-to-many assignments if only single assignment is provided
                if ($assignedTo) {
                    $task->assignedUsers()->sync([$assignedTo]);
                } else {
                    $task->assignedUsers()->sync([]);
                }
                
                Log::info('Task single assignment updated', [
                    'task_id' => $task->id,
                    'assigned_to' => $assignedTo,
                    'user_id' => Auth::id()
                ]);
            }
            
            // Refresh the task to get updated relationships
            $task->refresh();
            $task->load('assignedUsers');
            
            // Return the updated assignments
            $assignedUsers = $task->assignedUsers;
            $assignments = $assignedUsers->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $this->getUserAvatar($user)
                ];
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Task assignments updated successfully',
                'assignments' => $assignments
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update task assignments', [
                'task_id' => $task->id,
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update assignment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAssignmentData($taskId)
    {
        $task = Task::with('assignedUsers')->findOrFail($taskId);
        $project = $task->project;
        
        // Get all project team members - include ALL team members for assignment
        $allMembers = $project->teamMembers()->get();
        
        $currentAssignments = $task->assignedUsers;
        
        $availableMembers = $allMembers;
        
        \Log::info('Assignment data debug', [
            'task_id' => $taskId,
            'project_id' => $project->id,
            'all_members_count' => $allMembers->count(),
            'all_members' => $allMembers->pluck('name', 'id')->toArray(),
            'current_assignments_count' => $currentAssignments->count(),
            'current_assignments' => $currentAssignments->pluck('name', 'id')->toArray()
        ]);
        
        return response()->json([
            'success' => true,
            'available' => $availableMembers->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $this->getUserAvatar($user)
                ];
            }),
            'current' => $currentAssignments->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $this->getUserAvatar($user)
                ];
            })
        ]);
    }
    
    private function getUserAvatar($user)
    {
        if ($user->profile_photo_path) {
            $profilePath = '/storage/' . $user->profile_photo_path;
            $fullPath = public_path('storage/' . $user->profile_photo_path);

            if (file_exists($fullPath) && is_readable($fullPath)) {
                return $profilePath;
            }
        }
        
        $facesPath = public_path('assets/images/faces');
        $availableFaces = [];
        
        if (is_dir($facesPath)) {
            $files = glob($facesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            $availableFaces = array_map(function($file) {
                return '/assets/images/faces/' . basename($file);
            }, $files);
        }
        

        if (empty($availableFaces)) {
            for ($i = 1; $i <= 16; $i++) {
                $availableFaces[] = '/assets/images/faces/' . $i . '.jpg';
            }
        }
        
        $faceIndex = abs(crc32($user->name)) % count($availableFaces);
        return $availableFaces[$faceIndex];
    }

    public function destroy($project, $task)
    {
        // Find the task by ID since we're receiving IDs as strings
        $taskModel = Task::findOrFail($task);
        
        Log::info('Task deletion request received', [
            'task_id' => $taskModel->id,
            'user_id' => Auth::id()
        ]);

        try {
            $projectModel = $taskModel->project;
            $taskModel->delete();
            
            Log::info('Task deleted successfully', [
                'task_id' => $taskModel->id
            ]);

            // Check if this is an AJAX request
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Task deleted successfully.'
                ]);
            }

            return redirect()->route('projects.dashboard', $projectModel)
                            ->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Task deletion failed', [
                'task_id' => $taskModel->id,
                'error' => $e->getMessage()
            ]);
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete task: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                            ->with('error', 'Failed to delete task: ' . $e->getMessage());
        }
    }


    public function updateStatus(Request $request, Task $task)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|string|in:todo,in_progress,review,completed,cancelled'
            ]);

            Log::info('Task status update request', [
                'task_id' => $task->id,
                'old_status' => $task->status,
                'new_status' => $validated['status'],
                'user_id' => Auth::id()
            ]);

            // Update the task status
            $task->status = $validated['status'];
            $task->save();

            // Load the task with relationships for response
            $task->load(['assignedUser', 'project']);

            Log::info('Task status updated successfully', [
                'task_id' => $task->id,
                'status' => $task->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Task status updated successfully',
                'task' => $task
            ]);

        } catch (\Exception $e) {
            Log::error('Task status update failed: ' . $e->getMessage(), [
                'task_id' => $task->id ?? 'unknown',
                'status' => $request->status,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update task status',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

}