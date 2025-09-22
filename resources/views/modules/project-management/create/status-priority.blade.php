{{-- Status and Priority Selection Component --}}
<div>
    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
    <select name="status" id="status" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        <option value="planning" {{ old('status') === 'planning' ? 'selected' : '' }}>Planning</option>
        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
        <option value="on_hold" {{ old('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
    @error('status')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
    <select name="priority" id="priority" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : 'selected' }}>Medium</option>
        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
        <option value="critical" {{ old('priority') === 'critical' ? 'selected' : '' }}>Critical</option>
    </select>
    @error('priority')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
