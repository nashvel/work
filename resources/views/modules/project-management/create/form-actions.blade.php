{{-- Form Action Buttons Component --}}
<div class="mt-8 flex justify-end space-x-3">
    <a href="{{ route('projects.index') }}" 
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
        Cancel
    </a>
    <button type="submit" 
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create Project
    </button>
</div>
