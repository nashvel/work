{{-- Modal Action Buttons Component --}}
<div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
    <button type="button" 
            onclick="closeTeamModal()"
            class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors font-medium">
        Cancel
    </button>
    <button type="button" 
            onclick="saveTeamAssignment()"
            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed"
            id="saveTeamBtn">
        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        Save Changes
    </button>
</div>
