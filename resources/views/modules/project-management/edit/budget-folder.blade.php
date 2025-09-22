{{-- Budget and Folder Component --}}
<div class="grid grid-cols-12 gap-4 mt-4">
    <div class="xl:col-span-6 col-span-12">
        <label for="budget" class="ti-form-label flex items-center gap-2">
            <i class="ri-money-dollar-circle-line text-primary"></i>
            Budget
            <span class="text-xs text-gray-500 font-normal">(Optional)</span>
        </label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">$</span>
            <input type="number" class="ti-form-input pl-8 @error('budget') !border-red-500 @enderror" 
                   id="budget" name="budget" step="0.01" min="0" 
                   value="{{ old('budget', $project->budget ?: '') }}" 
                   placeholder="Enter project budget (e.g., 50000)">
        </div>
        @error('budget')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="xl:col-span-6 col-span-12">
        <label for="folder_id" class="ti-form-label flex items-center gap-2">
            <i class="ri-folder-cloud-line text-primary"></i>
            Project Folder
            <span class="text-xs text-gray-500 font-normal">(Optional)</span>
        </label>
        <div class="relative">
            <i class="ri-links-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="url" class="ti-form-input pl-10 @error('folder_id') !border-red-500 @enderror" 
                   id="folder_id" name="folder_id" value="{{ old('folder_id', $project->folder_id) }}" 
                   placeholder="https://drive.google.com/folder/...">
        </div>
        @error('folder_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
