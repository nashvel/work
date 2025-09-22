<div id="templateModal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-50" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); z-index: 9999; padding: 1rem;">
    <div class="flex items-center justify-center min-h-full py-4">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all" style="width: 100%; max-width: 800px !important; margin: 0 auto; max-height: 90vh; display: flex; flex-direction: column;">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 flex-shrink-0">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Choose a Project Template</h3>
                        <p class="text-sm text-gray-600">Select a pre-configured template to quickly set up your project with industry-specific tasks and timelines.</p>
                    </div>
                    <button id="closeTemplateModal" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-white hover:bg-opacity-80 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="p-4 overflow-y-auto bg-gray-50 flex-1" style="max-height: calc(90vh - 140px);">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="templateGrid" style="justify-items: center;">
                </div>
            </div>
            
            <div class="px-6 py-3 border-t border-gray-200 bg-white flex justify-between items-center flex-shrink-0">
                <span class="text-sm text-gray-500 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Select a template to auto-populate your project details
                </span>
                <button id="skipTemplate" class="px-4 py-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition-all rounded-lg font-medium">
                    Skip Templates
                </button>
            </div>
        </div>
    </div>
</div>

<template id="templateCardTemplate">
    <div class="template-card bg-white border border-gray-200 rounded-xl p-4 hover:border-blue-300 hover:shadow-lg transition-all duration-300 cursor-pointer group relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="template-icon text-2xl"></div>
                <span class="template-category text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-medium uppercase tracking-wide"></span>
            </div>
            
            <div class="mb-4">
                <h4 class="template-name font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors mb-2 leading-tight"></h4>
                <p class="template-description text-sm text-gray-600 leading-relaxed line-clamp-2"></p>
            </div>
            
            <div class="flex items-center justify-between mb-4 text-xs text-gray-500">
                <span class="template-duration flex items-center gap-1">
                    <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="duration-text font-medium"></span>
                </span>
                <span class="template-tasks flex items-center gap-1">
                    <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="tasks-text font-medium"></span>
                </span>
            </div>
            
            <button class="use-template-btn w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-300">
                Use Template
            </button>
        </div>
    </div>
</template>