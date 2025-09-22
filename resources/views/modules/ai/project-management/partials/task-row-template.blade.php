<template id="taskRowTpl">
    <div class="p-3 grid grid-cols-1 md:grid-cols-12 gap-2 items-start">
        <div class="md:col-span-5">
            <label class="text-[12px] text-slate-600">Task Name</label>
            <input name="task_name" placeholder="e.g., Floor Stripping & Waxing – Lobby" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="md:col-span-2">
            <label class="text-[12px] text-slate-600">Est. Days</label>
            <input name="task_days" type="number" min="0" step="0.5" placeholder="e.g., 2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="md:col-span-4">
            <label class="text-[12px] text-slate-600">Depends On (comma-separated)</label>
            <input name="task_depends" placeholder="e.g., Site Assessment, Pre-Clean" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="md:col-span-1 flex items-end">
            <button type="button" class="btnRemoveTask px-2.5 py-2 rounded-md border border-gray-200 hover:bg-gray-50 text-[13px]">Remove</button>
        </div>
        <div class="md:col-span-12">
            <label class="text-[12px] text-slate-600">Notes (optional)</label>
            <input name="task_notes" placeholder="Details, area coverage, constraints…" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
    </div>
</template>