{{-- Dates Component --}}
<div class="grid grid-cols-12 gap-4 mt-4">
    <div class="xl:col-span-4 col-span-12">
        <label for="start_date" class="ti-form-label flex items-center gap-2">
            <i class="ri-calendar-check-line text-primary"></i>
            Start Date
            <span class="text-xs text-gray-500 font-normal">(Optional)</span>
        </label>
        <input type="date" class="ti-form-input @error('start_date') !border-red-500 @enderror" 
               id="start_date" name="start_date" 
               value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}">
        @error('start_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="xl:col-span-4 col-span-12">
        <label for="end_date" class="ti-form-label flex items-center gap-2">
            <i class="ri-calendar-event-line text-primary"></i>
            End Date
            <span class="text-xs text-gray-500 font-normal">(Optional)</span>
        </label>
        <input type="date" class="ti-form-input @error('end_date') !border-red-500 @enderror" 
               id="end_date" name="end_date" 
               value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}">
        @error('end_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="xl:col-span-4 col-span-12">
        <label for="due_date" class="ti-form-label flex items-center gap-2">
            <i class="ri-time-line text-primary"></i>
            Due Date
            <span class="text-xs text-gray-500 font-normal">(Optional)</span>
        </label>
        <input type="date" class="ti-form-input @error('due_date') !border-red-500 @enderror" 
               id="due_date" name="due_date" 
               value="{{ old('due_date', $project->due_date ? $project->due_date->format('Y-m-d') : '') }}">
        @error('due_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
