{{-- Basic Information Component --}}
<div class="grid grid-cols-12 gap-4">
    <div class="xl:col-span-6 col-span-12">
        <label for="name" class="ti-form-label flex items-center gap-2">
            <i class="ri-file-text-line text-primary"></i>
            Project Name 
            <span class="text-red-500">*</span>
        </label>
        <input type="text" class="ti-form-input @error('name') !border-red-500 @enderror" 
               id="name" name="name" value="{{ old('name', $project->name) }}" 
               placeholder="Enter project name" required>
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="xl:col-span-6 col-span-12">
        <label for="location" class="ti-form-label flex items-center gap-2">
            <i class="ri-map-pin-line text-primary"></i>
            Location
            <span class="text-xs text-gray-500 font-normal">(Optional)</span>
        </label>
        <div class="relative">
            <i class="ri-map-pin-2-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" class="ti-form-input pl-10 @error('location') !border-red-500 @enderror" 
                   id="location" name="location" value="{{ old('location', $project->location) }}"
                   placeholder="Project location or address">
        </div>
        @error('location')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
