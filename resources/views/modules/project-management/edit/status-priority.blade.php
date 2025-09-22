{{-- Status and Priority Component --}}
<div class="grid grid-cols-12 gap-4 mt-4">
    <div class="xl:col-span-4 col-span-12">
        <label for="status" class="ti-form-label flex items-center gap-2">
            <i class="ri-flag-line text-primary"></i>
            Status 
            <span class="text-red-500">*</span>
        </label>
        <select class="ti-form-select @error('status') !border-red-500 @enderror" id="status" name="status" required>
            <option value="">Select Status</option>
            <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }} data-icon="bi bi-lightbulb-fill" data-color="warning">Planning</option>
            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }} data-icon="bi bi-play-circle-fill" data-color="success">Active</option>
            <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }} data-icon="bi bi-pause-circle-fill" data-color="warning">On Hold</option>
            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }} data-icon="bi bi-check-circle-fill" data-color="success">Completed</option>
            <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }} data-icon="bi bi-x-circle-fill" data-color="danger">Cancelled</option>
        </select>
        @error('status')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="xl:col-span-4 col-span-12">
        <label for="priority" class="ti-form-label flex items-center gap-2">
            <i class="ri-alarm-warning-line text-primary"></i>
            Priority 
            <span class="text-red-500">*</span>
        </label>
        <select class="ti-form-select @error('priority') !border-red-500 @enderror" id="priority" name="priority" required>
            <option value="">Select Priority</option>
            <option value="low" {{ old('priority', $project->priority) == 'low' ? 'selected' : '' }}>Low Priority</option>
            <option value="medium" {{ old('priority', $project->priority) == 'medium' ? 'selected' : '' }}>Medium Priority</option>
            <option value="high" {{ old('priority', $project->priority) == 'high' ? 'selected' : '' }}>High Priority</option>
            <option value="critical" {{ old('priority', $project->priority) == 'critical' ? 'selected' : '' }}>Critical Priority</option>
        </select>
        @error('priority')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="xl:col-span-4 col-span-12">
        <label for="manager_id" class="ti-form-label flex items-center gap-2">
            <i class="ri-user-star-line text-primary"></i>
            Project Manager
            <span class="text-xs text-gray-500 font-normal">(Optional)</span>
        </label>
        <select class="ti-form-select @error('manager_id') !border-red-500 @enderror" id="manager_id" name="manager_id">
            <option value="">Select Manager</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('manager_id', $project->manager_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('manager_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
