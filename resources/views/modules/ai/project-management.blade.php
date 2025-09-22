<x-app-layout>
  <x-slot name="return">{"link": "/users/manage", "text": "back"}</x-slot>
  <x-slot name="url_1">{"link": "/users/manage", "text": "User Management"}</x-slot>
  <x-slot name="url_2">{"link": "/users/manage/xx/details", "text": "xx"}</x-slot>
  <x-slot name="active">Details</x-slot>

  <div class="max-w-[980px] mx-auto my-6 px-4">
    <header class="bg-white border border-gray-200 rounded-xl p-3 flex items-center justify-between shadow-sm">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-emerald-600 text-white grid place-items-center font-bold">AI</div>
        <div>
          <div class="font-semibold text-gray-900">AI Project Planner — Janitorial Services</div>
          <div class="text-[13px] text-slate-600 flex items-center gap-2">
            <span class="relative inline-flex h-2.5 w-2.5">
              <span class="absolute inline-flex h-2.5 w-2.5 rounded-full bg-emerald-300 opacity-75 animate-ping"></span>
              <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
            </span>
            Online
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
          Project Inputs
        </button>
      </div>
    </header>

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

    <section class="mt-3 bg-white border border-gray-200 rounded-xl shadow-sm">
      <div id="chat" class="h-[520px] overflow-y-auto p-4 bg-gradient-to-b from-[#fbfdff] to-[#f7f9fc] rounded-t-xl space-y-3">
        <div id="emptyState" class="h-full grid place-items-center text-center text-slate-600">
          <div>
            <div class="text-2xl">🤖</div>
            <div class="font-semibold text-gray-900 mt-1">Start planning your project</div>
            <div class="max-w-xl mx-auto text-[15px]">Tell me the title, scope, due date, budget, and any tasks. If you don’t have tasks, I’ll suggest a complete list for you to import.</div>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-200 p-3 rounded-b-xl">
        <div class="flex items-end gap-2">
          <div class="relative flex-1">
            <div id="editor"
                 class="min-h-[42px] max-h-[120px] overflow-y-auto border border-gray-200 rounded-lg px-3 py-2 bg-white text-[15px] focus:outline-none focus:ring-2 focus:ring-blue-500"
                 contenteditable="true" role="textbox" aria-multiline="true"
                 data-placeholder="Type your message here. (Shift+Enter for new line)"></div>
            <div id="placeholder" class="pointer-events-none absolute left-3 top-2 text-slate-400 text-[15px]">
              Create Full Project Plan
            </div>
          </div>
          <button id="send" class="px-3 py-2 text-sm rounded-lg bg-emerald-600 text-dark hover:bg-emerald-700">
            Send
          </button>
        </div>

        <div class="flex items-center justify-between mt-2">
          <div class="text-[12px] text-slate-600">Enter to send · Shift+Enter for new line</div>

          <div id="typing" class="hidden items-center gap-2 text-slate-600 font-semibold">
            <span class="inline-block w-2 h-2 rounded-full bg-gray-400 animate-bounce"></span>
            <span class="inline-block w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay:.15s"></span>
            <span class="inline-block w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay:.30s"></span>
            <span class="text-[13px]">AI is preparing a reply…</span>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div id="templateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
      <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
          <h3 class="text-xl font-semibold text-gray-900">Choose a Project Template</h3>
          <button id="closeTemplateModal" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <p class="text-gray-600 mt-2">Select a pre-configured template to quickly set up your project with industry-specific tasks and timelines.</p>
      </div>
      
      <div class="p-6 overflow-y-auto max-h-[calc(90vh-180px)]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="templateGrid">
        </div>
      </div>
      
      <div class="p-6 border-t border-gray-200 bg-gray-50">
        <div class="flex justify-between items-center">
          <span class="text-sm text-gray-500">Select a template to auto-populate your project details</span>
          <button id="skipTemplate" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
            Skip Templates
          </button>
        </div>
      </div>
    </div>
  </div>

  <template id="templateCardTemplate">
    <div class="template-card border border-gray-200 rounded-lg p-4 hover:border-blue-300 hover:shadow-md transition-all cursor-pointer group">
      <div class="flex items-start gap-3">
        <div class="template-icon text-2xl flex-shrink-0 mt-1"></div>
        <div class="flex-1">
          <h4 class="template-name font-semibold text-gray-900 group-hover:text-blue-600 transition-colors"></h4>
          <span class="template-category text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full mt-1 inline-block"></span>
          <p class="template-description text-sm text-gray-600 mt-2 line-clamp-2"></p>
          <div class="flex items-center justify-between mt-3">
            <div class="flex items-center gap-4 text-xs text-gray-500">
              <span class="template-duration flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="duration-text"></span>
              </span>
              <span class="template-tasks flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="tasks-text"></span>
              </span>
            </div>
            <button class="use-template-btn text-blue-600 hover:text-blue-800 text-sm font-medium">
              Use Template
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
    (() => {
      const chat = document.getElementById('chat');
      const empty = document.getElementById('emptyState');
      const editor = document.getElementById('editor');
      const send = document.getElementById('send');
      const typing = document.getElementById('typing');
      const projForm = document.getElementById('projForm');
      const toggleInputs = document.getElementById('toggleInputs');
      const inputsPanel = document.getElementById('inputsPanel');
      const inputsSaved = document.getElementById('inputsSaved');
      const placeholder = document.getElementById('placeholder');

      const taskRows = document.getElementById('taskRows');
      const taskTpl  = document.getElementById('taskRowTpl');
      const btnAddTask = document.getElementById('btnAddTask');
      const btnImportSuggested = document.getElementById('btnImportSuggested');
      let lastSuggestedTasks = []; 

      const saved = JSON.parse(localStorage.getItem('ai_proj_inputs')||'{}');
      if (projForm){
        if (saved.title) document.getElementById('inpTitle').value = saved.title;
        if (saved.due_date) document.getElementById('inpDue').value = saved.due_date;
        if (saved.budget) document.getElementById('inpBudget').value = saved.budget;
        if (saved.description) document.getElementById('inpDesc').value = saved.description;
      }

      const savedTasks = Array.isArray(saved.tasks) ? saved.tasks : [];
      function addTaskRow(data = {name:'', est_days:'', dependsOn:[], notes:''}){
        const node = taskTpl.content.firstElementChild.cloneNode(true);
        node.querySelector('[name="task_name"]').value = data.name || '';
        node.querySelector('[name="task_days"]').value = data.est_days ?? '';
        node.querySelector('[name="task_depends"]').value = (data.dependsOn||[]).join(', ');
        node.querySelector('[name="task_notes"]').value = data.notes || '';
        node.querySelector('.btnRemoveTask').addEventListener('click', () => node.remove());
        taskRows.appendChild(node);
      }
      if (savedTasks.length){
        savedTasks.forEach(addTaskRow);
      } else {
        addTaskRow();
      }

      function collectTasks(){
        const rows = Array.from(taskRows.querySelectorAll('div.p-3.grid'));
        return rows.map(r => {
          const name = r.querySelector('[name="task_name"]').value.trim();
          const days = r.querySelector('[name="task_days"]').value;
          const dependsStr = r.querySelector('[name="task_depends"]').value.trim();
          const notes = r.querySelector('[name="task_notes"]').value.trim();
          const dependsOn = dependsStr ? dependsStr.split(',').map(s => s.trim()).filter(Boolean) : [];
          return {
            name,
            est_days: days === '' ? null : Number(days),
            dependsOn,
            notes
          };
        }).filter(t => t.name.length);
      }

      let history = [];
      let lastDayKey = null;

      const tz = 'Asia/Manila';
      const dayFmt  = new Intl.DateTimeFormat('en-PH', { timeZone: tz, weekday:'long', year:'numeric', month:'long', day:'numeric' });
      const timeFmt = new Intl.DateTimeFormat('en-PH', { timeZone: tz, hour:'numeric', minute:'2-digit', hour12:true });

      function now(){ return new Date(); }
      function dayKey(d){ return `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`; }
      function stamp(d){ return `${dayFmt.format(d)} • ${timeFmt.format(d)}`; }
      function showEmpty(show){ empty?.classList.toggle('hidden', !show); }
      function bottom(){ chat.scrollTop = chat.scrollHeight; }

      function ensureDay(d){
        const k = dayKey(d);
        if (k !== lastDayKey){
          lastDayKey = k;
          const sep = document.createElement('div');
          sep.className = "text-center my-3 relative text-slate-700 font-bold";
          sep.innerHTML = `
            <span class="px-2 bg-transparent">${dayFmt.format(d)}</span>
            <span class="absolute left-0 top-1/2 w-1/3 h-px bg-slate-200 -translate-y-1/2"></span>
            <span class="absolute right-0 top-1/2 w-1/3 h-px bg-slate-200 -translate-y-1/2"></span>`;
          chat.appendChild(sep);
        }
      }

      function togglePlaceholder(){
        const hasText = editor.textContent.trim().length > 0;
        placeholder.classList.toggle('hidden', hasText || document.activeElement === editor);
      }
      editor.addEventListener('focus', togglePlaceholder);
      editor.addEventListener('blur', togglePlaceholder);
      editor.addEventListener('input', togglePlaceholder);
      togglePlaceholder();

      function addRow(role, html, when = now()){
        showEmpty(false);
        ensureDay(when);

        const row = document.createElement('div');
        row.className = role === 'user' ? "flex gap-2 justify-end mx-1" : "flex gap-2 justify-start mx-1";

        const bubble = document.createElement('div');
        bubble.className = role === 'user'
          ? "max-w-[78%] rounded-xl px-3 py-2 text-[15px] shadow-sm bg-blue-50 text-gray-900 border border-blue-200"
          : "w-full rounded-xl px-3 py-2 text-[15px] shadow-sm bg-white text-gray-900 border border-gray-200";

        bubble.innerHTML = html;

        const time = document.createElement('div');
        time.className = "text-[12px] text-slate-600 mt-1";
        time.textContent = stamp(when);

        const wrap = document.createElement('div');
        wrap.appendChild(bubble);
        wrap.appendChild(time);

        row.appendChild(wrap);
        chat.appendChild(row);
        bottom();
        return row;
      }

      function safe(s){
        const d = document.createElement('div');
        d.textContent = String(s ?? '');
        return d.innerHTML;
      }
      function linkify(text){
        const url = /(https?:\/\/[^\s]+)/g;
        return safe(text).replace(url, '<a href="$1" target="_blank" rel="noopener" class="text-blue-600 underline">$1</a>');
      }
      function money(v){ return Number(v||0).toLocaleString(); }

      // Date helpers
      function parseDateLike(s){
        if (!s) return null;
        const d = new Date(s);
        if (!isNaN(d)) return d;
        const m = String(s).match(/^(\d{4})[-/](\d{1,2})[-/](\d{1,2})$/);
        if (m) return new Date(Number(m[1]), Number(m[2])-1, Number(m[3]));
        const dx = String(s).match(/day\s*(\d+)/i);
        if (dx) return new Date(1970, 0, Number(dx[1]));
        return null;
      }
      function sortTimeline(items){
        const mapped = items.map((t,i)=>({t,i,d:parseDateLike(t.start)}));
        mapped.sort((a,b)=>{
          if (a.d && b.d) return a.d - b.d || a.i - b.i;
          if (a.d && !b.d) return -1;
          if (!a.d && b.d) return 1;
          return a.i - b.i;
        });
        return mapped.map(x=>x.t);
      }

      // Render proposed plan and suggested tasks (if any)
      function renderPlan(p){
        const exp = p.expense_summary || {};
        const budget = Number(exp.budget||0), total = Number(exp.total||0);
        const variance = Number(exp.variance ?? (budget - total));
        const varianceClass = variance >= 0 ? " text-success " : " text-danger ";

        const kpis = `
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="rounded-lg p-3 bg-slate-50 border border-slate-200">
              <div class="text-[13px] font-semibold text-slate-600">Budget</div>
              <div class="mt-1 inline-flex items-center gap-2 px-2.5 py-1 rounded-md border text-info font-bold">₱ ${money(budget)}</div>
            </div>
            <div class="rounded-lg p-3 bg-slate-50 border border-slate-200">
              <div class="text-[13px] font-semibold text-slate-600">Estimated Total</div>
              <div class="mt-1 inline-flex items-center gap-2 px-2.5 py-1 rounded-md border text-warning font-bold">₱ ${money(total)}</div>
            </div>
            <div class="rounded-lg p-3 bg-slate-50 border border-slate-200 hidden">
              <div class="text-[13px] font-semibold text-slate-600">Variance</div>
              <div class="mt-1 inline-flex items-center gap-2 px-2.5 py-1 rounded-md border ${varianceClass} font-bold">₱ ${money(variance)}</div>
            </div>
          </div>`;

        const expenses = `
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
            <div class="rounded-lg p-3 bg-white border border-gray-200">
              <div class="text-[13px] font-semibold text-slate-600">Labor</div>
              <div class="mt-1 inline-flex items-center gap-2 px-2.5 py-1 rounded-md border text-warning font-bold">₱ ${money(exp.labor)}</div>
            </div>
            <div class="rounded-lg p-3 bg-white border border-gray-200">
              <div class="text-[13px] font-semibold text-slate-600">Supplies</div>
              <div class="mt-1 inline-flex items-center gap-2 px-2.5 py-1 rounded-md border text-info font-bold">₱ ${money(exp.supplies)}</div>
            </div>
            <div class="rounded-lg p-3 bg-white border border-gray-200">
              <div class="text-[13px] font-semibold text-slate-600">Equipment</div>
              <div class="mt-1 inline-flex items-center gap-2 px-2.5 py-1 rounded-md border border-slate-300 bg-slate-100 text-slate-700 font-bold">₱ ${money(exp.equipment)}</div>
            </div>
            <div class="rounded-lg p-3 bg-white border border-gray-200">
              <div class="text-[13px] font-semibold text-slate-600">Contingency</div>
              <div class="mt-1 inline-flex items-center gap-2 px-2.5 py-1 rounded-md border text-success font-bold">₱ ${money(exp.contingency)}</div>
            </div>
          </div>`;

        const rawTl = Array.isArray(p.timeline) ? p.timeline.slice(0,99) : [];
        const tlItems = sortTimeline(rawTl);
        const tl = tlItems.map((t, idx) => {
          const step = idx + 1;
          return `
            <div class="flex gap-3">
              <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full border border-amber-300 bg-amber-50 text-amber-800 grid place-items-center font-bold text-sm pt-2 px-2">${step}.</div>
                ${step < tlItems.length ? '<div class="flex-1 w-px bg-amber-200 my-1"></div>' : ''}
              </div>
              <div class="flex-1 rounded-lg p-3 bg-white border border-amber-200 mb-3">
                <div class="flex items-center justify-between gap-3">
                  <div class="font-extrabold">${safe(t.task)}</div>
                  <span class="inline-flex items-center gap-2 text-[13px] rounded-full px-2 py-1 bg-slate-50 border border-slate-200">
                    <span>📅</span> ${safe(t.start)} → ${safe(t.end)}
                  </span>
                </div>
                ${Array.isArray(t.dependsOn)&&t.dependsOn.length ? `<div class="mt-1 text-[13px] text-slate-700"><span class="font-semibold">Depends on:</span> ${t.dependsOn.map(safe).join(', ')}</div>`:''}
                ${t.notes ? `<div class="mt-1">${safe(t.notes)}</div>`:''}
              </div>
            </div>
          `;
        }).join('');

        const byRole = (p.manpower_hours?.by_role||[]).map(r => `
          <div class="rounded-lg p-3 bg-white border border-gray-200">
            <div class="flex items-center justify-between">
              <div class="font-extrabold">${safe(r.role)}</div>
              <div class="inline-flex items-center gap-1 text-[13px] rounded-full px-2 py-1 bg-slate-50 border border-slate-200">
                <span>⏱</span> ${Number(r.hours||0)}h
              </div>
            </div>
          </div>
        `).join('');

        const roles = (p.role_recommendations||[]).map(r => `
          <div class="rounded-lg p-3 bg-white border border-gray-200">
            <div class="flex items-center justify-between">
              <div class="font-extrabold">${safe(r.role)}</div>
              <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-1 text-[13px] rounded-full px-2 py-1 border">👥 ${safe(r.headcount)}</span>
                <span class="inline-flex items-center gap-1 text-[13px] rounded-full px-2 py-1 border">⏱ ${safe(r.hours_each)}h</span>
                <span class="inline-flex items-center gap-1 text-[13px] rounded-full px-2 py-1 border">Σ ${safe(r.total_hours)}h</span>
              </div>
            </div>
            ${(Array.isArray(r.skills)&&r.skills.length)?`<div class="mt-1"><span class="font-semibold">Skills:</span> ${r.skills.map(safe).join(', ')}</div>`:''}
            ${r.notes?`<div class="mt-1 text-[14px] text-slate-600">${safe(r.notes)}</div>`:''}
          </div>
        `).join('');

        const risks = Array.isArray(p.risks)&&p.risks.length
          ? `<div class="rounded-lg p-3 bg-white border border-gray-200"><div class="font-semibold mb-1">Risks</div><div class="flex flex-wrap gap-2">
               ${p.risks.map(r=>`<span class="inline-flex items-center gap-1 text-[13px] rounded-full px-2 py-1 border">⚠️ ${safe(r)}</span>`).join('')}
             </div></div>` : '';

        const assumptions = Array.isArray(p.assumptions)&&p.assumptions.length
          ? `<div class="rounded-lg p-3 bg-white border border-gray-200"><div class="font-semibold mb-1">Assumptions</div><div class="flex flex-wrap gap-2">
               ${p.assumptions.map(a=>`<span class="inline-flex items-center gap-1 text-[13px] rounded-full px-2 py-1 border">📘 ${safe(a)}</span>`).join('')}
             </div></div>` : '';

        let suggestedBlock = '';
        const sugg = Array.isArray(p.suggested_tasks) ? p.suggested_tasks : [];
        if (sugg.length) {
          // store for import
          lastSuggestedTasks = sugg.map(t => ({
            name: t.name || '',
            est_days: typeof t.est_days === 'number' ? t.est_days : null,
            dependsOn: Array.isArray(t.dependsOn) ? t.dependsOn : [],
            notes: t.notes || ''
          }));

          suggestedBlock = `
            <div class="rounded-xl p-3 mt-3 bg-white border border-amber-200">
              <div class="flex items-center justify-between">
                <div class="font-semibold">Suggested Tasks (no tasks were provided)</div>
                <button type="button" class="btnImportAll inline-flex items-center gap-2 px-2.5 py-1.5 text-[13px] rounded-md border border-amber-300 bg-amber-50 text-amber-900 hover:bg-amber-100">Import All</button>
              </div>
              <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-3">
                ${sugg.map((t,i)=>`
                  <div class="rounded-lg p-3 border border-amber-200 bg-amber-50/40">
                    <div class="font-semibold">${safe(t.name)}</div>
                    <div class="text-[13px] mt-1"><b>Est. days:</b> ${safe(t.est_days)}</div>
                    ${Array.isArray(t.dependsOn)&&t.dependsOn.length ? `<div class="text-[13px] mt-1"><b>Depends on:</b> ${t.dependsOn.map(safe).join(', ')}</div>`:''}
                    ${t.notes ? `<div class="text-[13px] mt-1">${safe(t.notes)}</div>`:''}
                  </div>
                `).join('')}
              </div>
            </div>
          `;
        }

        if (sugg.length) {
          btnImportSuggested.classList.remove('hidden');
        } else {
          btnImportSuggested.classList.add('hidden');
        }

        return `
          <div class="rounded-xl p-3 bg-white">
            <div class="font-extrabold mb-2">📋 Proposed Plan</div>

            ${kpis}

            <div class="rounded-xl p-3 mt-3 bg-white border border-gray-200">
              <div class="font-semibold mb-1">Expense Summary</div>
              ${expenses}
            </div>

            <div class="rounded-xl p-3 mt-3 bg-white border border-gray-200">
              <div class="font-semibold mb-2">Timeline (Steps)</div>
              ${tl || '<div class="text-slate-600 text-[14px]">No timeline provided.</div>'}
            </div>

            <div class="rounded-xl p-3 mt-3 bg-white border border-gray-200">
              <div class="font-semibold mb-1">Manpower</div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                ${byRole || '<div class="text-slate-600 text-[14px]">No manpower breakdown provided.</div>'}
              </div>
              <div class="mt-2 text-[14px]"><span class="font-semibold">Total:</span> ${Number(p.manpower_hours?.total_hours||0)}h</div>
            </div>

            <div class="rounded-xl p-3 mt-3 bg-white border border-gray-200">
              <div class="font-semibold mb-1">Role Recommendations</div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                ${roles || '<div class="text-slate-600 text-[14px]">No role recommendations provided.</div>'}
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
              ${risks}${assumptions}
            </div>

            ${suggestedBlock}
          </div>
        `;
      }

      // Thinking bubble
      function addThinking(when = now()){
        ensureDay(when);
        const row = document.createElement('div');
        row.className = "flex gap-2 justify-start mx-1";
        const bubble = document.createElement('div');
        bubble.className = "w-full rounded-xl px-3 py-2 text-[15px] shadow-sm bg-white text-gray-900 border border-gray-200";
        bubble.innerHTML = `
          <div class="flex items-center gap-2 text-slate-600 font-semibold">
            <span class="inline-block w-2 h-2 rounded-full bg-slate-400 animate-bounce"></span>
            <span class="inline-block w-2 h-2 rounded-full bg-slate-400 animate-bounce" style="animation-delay:.15s"></span>
            <span class="inline-block w-2 h-2 rounded-full bg-slate-400 animate-bounce" style="animation-delay:.30s"></span>
            <span class="text-[13px]">AI is preparing a reply…</span>
          </div>`;
        const time = document.createElement('div');
        time.className = "text-[12px] text-slate-600 mt-1";
        time.textContent = stamp(when);
        const wrap = document.createElement('div');
        wrap.appendChild(bubble); wrap.appendChild(time);
        row.appendChild(wrap); chat.appendChild(row); bottom();
        return row;
      }
      function removeNode(n){ if(n && n.parentNode) n.parentNode.removeChild(n); }

      // Toggle inputs
      toggleInputs.addEventListener('click', () => {
        inputsPanel.classList.toggle('hidden');
      });

      // Save inputs (including tasks)
      projForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const fd = new FormData(projForm);
        const data = {
          title: fd.get('title') || '',
          description: fd.get('description') || '',
          due_date: fd.get('due_date') || '',
          budget: fd.get('budget') || '',
          tasks: collectTasks()
        };
        localStorage.setItem('ai_proj_inputs', JSON.stringify(data));
        inputsSaved.classList.remove('hidden');
        setTimeout(()=>inputsSaved.classList.add('hidden'), 1400);
        addRow('assistant', '<div class="rounded-lg p-3 bg-emerald-50 text-emerald-900 border-emerald-200"><span class="font-semibold">Project inputs saved</span> (including tasks) for the next AI call.</div>');
      });

      function getText(){ return editor.innerText.replace(/\u00A0/g,' ').trim(); }

      // Import helpers
      function importSuggestedAll(){
        if (!lastSuggestedTasks.length) return;
        lastSuggestedTasks.forEach(addTaskRow);
        // persist immediately
        const fd = new FormData(projForm);
        const data = {
          title: fd.get('title') || '',
          description: fd.get('description') || '',
          due_date: fd.get('due_date') || '',
          budget: fd.get('budget') || '',
          tasks: collectTasks()
        };
        localStorage.setItem('ai_proj_inputs', JSON.stringify(data));
      }
      function importSuggestedOne(idx){
        const t = lastSuggestedTasks[idx];
        if (!t) return;
        addTaskRow(t);
        // optional: persist after single import
        const fd = new FormData(projForm);
        const data = {
          title: fd.get('title') || '',
          description: fd.get('description') || '',
          due_date: fd.get('due_date') || '',
          budget: fd.get('budget') || '',
          tasks: collectTasks()
        };
        localStorage.setItem('ai_proj_inputs', JSON.stringify(data));
      }

      btnImportSuggested.addEventListener('click', importSuggestedAll);
      document.addEventListener('click', (e) => {
        if (e.target.matches('.btnImportAll')) {
          importSuggestedAll();
        } else if (e.target.matches('.btnImportOne')) {
          const idx = Number(e.target.getAttribute('data-index'));
          importSuggestedOne(idx);
        }
      });

      async function callAI(text){
        const fd = new FormData(projForm);
        const currentTasks = collectTasks();
        const payload = {
          messages: history.concat([{ role:'user', content:text }]),
          title: fd.get('title') || null,
          description: fd.get('description') || null,
          due_date: fd.get('due_date') || null,
          budget: fd.get('budget') ? Number(fd.get('budget')) : null,
          tasks: currentTasks
        };

        typing.classList.remove('hidden');
        const thinkingRow = addThinking(now());

        try {
          const res = await fetch('{{ route('ai.call') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(payload)
          });

          if (!res.ok) throw new Error('AI call failed');
          const { assistant } = await res.json();

          removeNode(thinkingRow);
          try {
            const plan = JSON.parse(assistant);
            const html = renderPlan(plan);
            const row = addRow('assistant', html);

            // If the response contained suggested tasks, ensure the header button is visible
            if (Array.isArray(plan.suggested_tasks) && plan.suggested_tasks.length) {
              btnImportSuggested.classList.remove('hidden');
            }

          } catch {
            addRow('assistant', `<div class="rounded-xl p-3 bg-white border-gray-200"><div class="font-extrabold mb-1">Assistant Response</div>${linkify(assistant)}</div>`);
          }

          history.push({ role:'user', content:text });
          history.push({ role:'assistant', content:assistant });
        } catch (e) {
          removeNode(thinkingRow);
          addRow('assistant', '<div class="rounded-lg p-3 text-danger border font-semibold">Error: Could not reach AI endpoint.</div>');
          console.error(e);
        } finally {
          typing.classList.add('hidden');
        }
      }

      function sendMessage(){
        const text = getText();
        if (!text) return;
        addRow('user', safe(text));
        editor.innerHTML = '';
        togglePlaceholder();
        callAI(text);
      }

      editor.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
      });
      send.addEventListener('click', sendMessage);

      // Template functionality
      const btnUseTemplate = document.getElementById('btnUseTemplate');
      const btnUseTemplateHeader = document.getElementById('btnUseTemplateHeader');
      const templateModal = document.getElementById('templateModal');
      const closeTemplateModal = document.getElementById('closeTemplateModal');
      const skipTemplate = document.getElementById('skipTemplate');
      const templateGrid = document.getElementById('templateGrid');
      const templateCardTemplate = document.getElementById('templateCardTemplate');

      // Available templates
      const availableTemplates = [
        {
          id: 'janitorial-services',
          name: 'Janitorial Services',
          icon: '🧹',
          category: 'Cleaning',
          description: 'Complete janitorial service setup including team hiring, equipment procurement, and service implementation.',
          duration_days: 30,
          tasks_count: 11
        },
        {
          id: 'office-construction',
          name: 'Office Construction',
          icon: '🏗️',
          category: 'Construction',
          description: 'Commercial office space construction project with permits, structural work, and finishing.',
          duration_days: 90,
          tasks_count: 11
        },
        {
          id: 'it-software-development',
          name: 'IT Software Development',
          icon: '💻',
          category: 'Technology',
          description: 'Full-stack web application development including requirements, design, development, and testing.',
          duration_days: 120,
          tasks_count: 14
        },
        {
          id: 'marketing-campaign',
          name: 'Marketing Campaign',
          icon: '📢',
          category: 'Marketing',
          description: 'Digital marketing campaign launch with strategy development, content creation, and performance tracking.',
          duration_days: 60,
          tasks_count: 12
        },
        {
          id: 'event-planning',
          name: 'Event Planning',
          icon: '🎉',
          category: 'Events',
          description: 'Corporate event planning and execution including venue booking, catering, and logistics.',
          duration_days: 45,
          tasks_count: 12
        }
      ];

      async function loadTemplate(templateId) {
        try {
          const response = await fetch(`/modules/ai/project-management/templates/${templateId}.json`);
          if (!response.ok) throw new Error(`Template not found: ${response.status}`);
          const data = await response.json();
          return data;
        } catch (error) {
          console.error('Error loading template:', error);
          alert(`Could not load template: ${error.message}`);
          return null;
        }
      }

      function applyTemplate(templateData) {
        const template = templateData.template;
        
        // Fill form fields with null checks
        const titleInput = document.getElementById('inpTitle');
        const descInput = document.getElementById('inpDesc');
        const budgetInput = document.getElementById('inpBudget');
        const dueInput = document.getElementById('inpDue');
        
        if (titleInput) titleInput.value = template.title;
        if (descInput) descInput.value = template.description;
        if (budgetInput) budgetInput.value = template.budget;
        
        // Set due date to current date + duration_days
        const dueDate = new Date();
        dueDate.setDate(dueDate.getDate() + template.duration_days);
        if (dueInput) dueInput.value = dueDate.toISOString().split('T')[0];
        
        // Clear existing tasks
        if (taskRows) {
          taskRows.innerHTML = '';
          
          // Add template tasks
          template.tasks.forEach(task => {
            addTaskRow(task);
          });
        }
        
        // Save to localStorage
        const formData = {
          title: template.title,
          description: template.description,
          budget: template.budget,
          due_date: dueDate.toISOString().split('T')[0],
          tasks: template.tasks
        };
        localStorage.setItem('ai_proj_inputs', JSON.stringify(formData));
        
        // Show inputs panel if hidden
        if (inputsPanel && inputsPanel.classList.contains('hidden') && toggleInputs) {
          toggleInputs.click();
        }
        
        // Close modal
        if (templateModal) {
          templateModal.classList.add('hidden');
        }
        
        // Show confirmation
        alert(`Template "${templateData.name}" has been applied successfully!`);
      }

      function renderTemplateCards() {
        if (!templateGrid || !templateCardTemplate) {
          console.error('Template grid or card template not found');
          return;
        }
        
        templateGrid.innerHTML = '';
        
        availableTemplates.forEach(template => {
          const card = templateCardTemplate.content.cloneNode(true);
          
          card.querySelector('.template-icon').textContent = template.icon;
          card.querySelector('.template-name').textContent = template.name;
          card.querySelector('.template-category').textContent = template.category;
          card.querySelector('.template-description').textContent = template.description;
          card.querySelector('.duration-text').textContent = `${template.duration_days} days`;
          card.querySelector('.tasks-text').textContent = `${template.tasks_count} tasks`;
          
          const useBtn = card.querySelector('.use-template-btn');
          useBtn.addEventListener('click', async () => {
            const templateData = await loadTemplate(template.id);
            if (templateData) {
              applyTemplate(templateData);
            }
          });
          
          templateGrid.appendChild(card);
        });
      }

      // Event listeners for template modal
      if (btnUseTemplate) {
        btnUseTemplate.addEventListener('click', () => {
          if (templateModal) {
            renderTemplateCards();
            templateModal.classList.remove('hidden');
          }
        });
      }
      
      // Header template button (more prominent)
      if (btnUseTemplateHeader) {
        btnUseTemplateHeader.addEventListener('click', () => {
          if (templateModal) {
            renderTemplateCards();
            templateModal.classList.remove('hidden');
          }
        });
      }
      
      // Modal close buttons
      if (closeTemplateModal) {
        closeTemplateModal.addEventListener('click', () => {
          if (templateModal) templateModal.classList.add('hidden');
        });
      }
      
      if (skipTemplate) {
        skipTemplate.addEventListener('click', () => {
          if (templateModal) templateModal.classList.add('hidden');
        });
      }
      
      // Close modal when clicking outside
      if (templateModal) {
        templateModal.addEventListener('click', (e) => {
          if (e.target === templateModal) {
            templateModal.classList.add('hidden');
          }
        });
      }

      // Initial welcome
      addRow('assistant', '<div class="rounded-xl p-3 bg-white border-gray-200"><div class="font-extrabold mb-1">Welcome</div>Provide the <b>project title</b>, a short <b>description</b>, the <b>due date</b>, the <b>budget</b>, and any <b>tasks</b>. If you don\'t have tasks, I\'ll propose a set of <b>Suggested Tasks</b> you can import with one click, then I\'ll build a <b>due-date–anchored</b> timeline with <b>numbered steps</b>, roles/skills, hours, and an expense estimate.<br><br><button onclick="document.getElementById(\'btnUseTemplateHeader\').click()" class="mt-2 px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">🚀 Quick Start with Template</button></div>');
    })();
  </script>
</x-app-layout>
