<section id="inputsPanel" class="hidden mt-3">
    <form id="projForm" class="grid grid-cols-1 md:grid-cols-4 gap-3 p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
        <input id="inpTitle" name="title" placeholder="Project Title" class="md:col-span-2 border border-gray-200 rounded-lg px-3 py-2 text-[15px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <input id="inpDue" name="due_date" type="date" class="border border-gray-200 rounded-lg px-3 py-2 text-[15px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <input id="inpBudget" name="budget" type="number" step="0.01" placeholder="Budget (₱ or $)" class="border border-gray-200 rounded-lg px-3 py-2 text-[15px] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <textarea id="inpDesc" name="description" rows="3" placeholder="Description / Scope" class="md:col-span-4 border border-gray-200 rounded-lg px-3 py-2 text-[15px] focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

        <div class="md:col-span-4">
            <div class="flex items-center justify-between">
                <div class="font-semibold text-slate-800">Project Tasks</div>
                <div class="text-[12px] text-slate-500">Anchored to the Due Date (scheduled backward)</div>
            </div>

            <div class="mt-2 rounded-xl border border-gray-200">
                <div class="p-3 border-b border-gray-200 flex items-center justify-between">
                    <div class="text-[13px] text-slate-600">List tasks with optional duration (days) and dependencies.</div>
                    <div class="flex items-center gap-2">
                        <button type="button" id="btnUseTemplate" class="px-2.5 py-1.5 text-[13px] rounded-md border border-blue-300 bg-blue-50 text-blue-900 hover:bg-blue-100">Use Template</button>
                        <button type="button" id="btnAddTask" class="px-2.5 py-1.5 text-[13px] rounded-md bg-emerald-600 text-white hover:bg-emerald-700">Add Task</button>
                        <button type="button" id="btnImportSuggested" class="hidden px-2.5 py-1.5 text-[13px] rounded-md border border-amber-300 bg-amber-50 text-amber-900 hover:bg-amber-100">Import Suggested</button>
                    </div>
                </div>
                <div id="taskRows" class="divide-y divide-gray-100">
                </div>
            </div>
        </div>

        @include('modules.ai.project-management.partials.task-row-template')

        <div class="md:col-span-4 flex items-center gap-2">
            <button id="btnSaveInputs" type="submit" class="px-3 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Save Inputs
            </button>
            <span id="inputsSaved" class="hidden text-sm text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                Saved
            </span>
        </div>
    </form>
</section>