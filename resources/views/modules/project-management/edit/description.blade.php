{{-- Description Component --}}
<div class="mt-4">
    <label for="description" class="ti-form-label flex items-center gap-2">
        <i class="ri-file-text-line text-primary"></i>
        Project Description
        <span class="text-xs text-gray-500 font-normal">(Optional)</span>
    </label>
    <input id="description" type="hidden" name="description" value="{{ old('description', $project->description) }}">
    <trix-editor input="description" class="ti-form-input @error('description') !border-red-500 @enderror" placeholder="Describe the project scope, objectives, and key details..."></trix-editor>
    @error('description')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
