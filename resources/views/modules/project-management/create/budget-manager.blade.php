{{-- Budget and Manager Selection Component --}}
<div>
    <label for="budget" class="block text-sm font-medium text-gray-700">Budget ($)</label>
    <input type="number" name="budget" id="budget" value="{{ old('budget') }}" step="0.01" min="0"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @error('budget')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="manager_id" class="block text-sm font-medium text-gray-700">Project Manager</label>
    <select name="manager_id" id="manager_id"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        <option value="">Select Manager (Optional)</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('manager_id') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    @error('manager_id')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
