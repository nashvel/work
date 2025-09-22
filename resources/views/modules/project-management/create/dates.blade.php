{{-- Project Dates Component --}}
<div>
    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @error('start_date')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @error('end_date')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
