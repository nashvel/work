@props([
    'title' => 'AI Project Planner — Janitorial Services',
    'status' => 'Online',
    'toggleButtonText' => 'Project Inputs'
])

<header class="bg-white border border-gray-200 rounded-xl p-3 flex items-center justify-between shadow-sm">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-emerald-600 text-white grid place-items-center font-bold">AI</div>
        <div>
            <div class="font-semibold text-gray-900">{{ $title }}</div>
            <div class="text-[13px] text-slate-600 flex items-center gap-2">
                <span class="relative inline-flex h-2.5 w-2.5">
                    <span class="absolute inline-flex h-2.5 w-2.5 rounded-full bg-emerald-300 opacity-75 animate-ping"></span>
                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                </span>
                {{ $status }}
            </div>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <button id="btnUseTemplateHeader" type="button" class="px-3 py-2 text-sm border border-blue-300 bg-blue-50 text-blue-900 rounded-lg hover:bg-blue-100 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Use Template
        </button>
        <button id="toggleInputs" type="button" class="px-3 py-2 text-sm border border-gray-200 rounded-lg hover:bg-slate-50">
            {{ $toggleButtonText }}
        </button>
    </div>
</header>