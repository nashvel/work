<x-app-layout>
    <x-slot name="return">{"link": "/project-management/list", "text": "back"}</x-slot>
    <x-slot name="url_1">{"link": "/project-management", "text": "Project Management"}</x-slot>
    <x-slot name="url_2">{"link": "/project-management/list", "text": "Project List"}</x-slot>
    <x-slot name="active">AI Assistance</x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <div class="max-w-[980px] mx-auto my-6 px-4">
        @include('modules.ai.project-management.components.header', [
            'title' => 'AI Project Planner — Janitorial Services',
            'status' => 'Online',
            'toggleButtonText' => 'Project Inputs'
        ])

        @include('modules.ai.project-management.components.inputs-panel')

        @include('modules.ai.project-management.components.chat-interface')
        
        <div class="mt-6">
            @include('modules.ai.project-management.components.assigned-team')
        </div>
    </div>
    @include('modules.ai.project-management.components.template-selector')

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
        const taskTpl = document.getElementById('taskRowTpl');
        const btnAddTask = document.getElementById('btnAddTask');
        const btnImportSuggested = document.getElementById('btnImportSuggested');
        let lastSuggestedTasks = [];

        const saved = JSON.parse(localStorage.getItem('ai_proj_inputs') || '{}');
        if (projForm) {
            if (saved.title) document.getElementById('inpTitle').value = saved.title;
            if (saved.due_date) document.getElementById('inpDue').value = saved.due_date;
            if (saved.budget) document.getElementById('inpBudget').value = saved.budget;
            if (saved.description) document.getElementById('inpDesc').value = saved.description;
        }

        const savedTasks = Array.isArray(saved.tasks) ? saved.tasks : [];
        function addTaskRow(data = { name: '', est_days: '', dependsOn: [], notes: '' }) {
            if (!taskTpl || !taskRows) return;
            const node = taskTpl.content.firstElementChild.cloneNode(true);
            node.querySelector('[name="task_name"]').value = data.name || '';
            node.querySelector('[name="task_days"]').value = data.est_days ?? '';
            node.querySelector('[name="task_depends"]').value = (data.dependsOn || []).join(', ');
            node.querySelector('[name="task_notes"]').value = data.notes || '';
            node.querySelector('.btnRemoveTask').addEventListener('click', () => node.remove());
            taskRows.appendChild(node);
        }
        if (savedTasks.length) {
            savedTasks.forEach(addTaskRow);
        } else {
            addTaskRow();
        }

        function collectTasks() {
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
        const dayFmt = new Intl.DateTimeFormat('en-PH', { timeZone: tz, weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        const timeFmt = new Intl.DateTimeFormat('en-PH', { timeZone: tz, hour: 'numeric', minute: '2-digit', hour12: true });

        function now() { return new Date(); }
        function dayKey(d) { return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`; }
        function stamp(d) { return `${dayFmt.format(d)} • ${timeFmt.format(d)}`; }
        function showEmpty(show) { empty?.classList.toggle('hidden', !show); }
        function bottom() { chat.scrollTop = chat.scrollHeight; }

        function ensureDay(d) {
            const k = dayKey(d);
            if (k !== lastDayKey) {
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

        function togglePlaceholder() {
            if (!editor || !placeholder) return;
            const hasText = editor.textContent.trim().length > 0;
            placeholder.classList.toggle('hidden', hasText || document.activeElement === editor);
        }
        if (editor && placeholder) {
            editor.addEventListener('focus', togglePlaceholder);
            editor.addEventListener('blur', togglePlaceholder);
            editor.addEventListener('input', togglePlaceholder);
            togglePlaceholder();
        }

        function addRow(role, html, when = now()) {
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
                icon: '<i class="bi bi-droplet-fill" style="color: #3B82F6; font-size: 24px;"></i>',
                category: 'Cleaning',
                description: 'Complete janitorial service setup including team hiring, equipment procurement, and service implementation.',
                duration_days: 30,
                tasks_count: 11
            },
            {
                id: 'office-construction',
                name: 'Office Construction',
                icon: '<i class="bi bi-building-fill" style="color: #F59E0B; font-size: 24px;"></i>',
                category: 'Construction',
                description: 'Commercial office space construction project with permits, structural work, and finishing.',
                duration_days: 90,
                tasks_count: 11
            },
            {
                id: 'it-software-development',
                name: 'IT Software Development',
                icon: '<i class="bi bi-laptop-fill" style="color: #8B5CF6; font-size: 24px;"></i>',
                category: 'Technology',
                description: 'Full-stack web application development including requirements, design, development, and testing.',
                duration_days: 120,
                tasks_count: 14
            },
            {
                id: 'marketing-campaign',
                name: 'Marketing Campaign',
                icon: '<i class="bi bi-megaphone-fill" style="color: #EF4444; font-size: 24px;"></i>',
                category: 'Marketing',
                description: 'Digital marketing campaign launch with strategy development, content creation, and performance tracking.',
                duration_days: 60,
                tasks_count: 12
            },
            {
                id: 'event-planning',
                name: 'Event Planning',
                icon: '<i class="bi bi-calendar-event-fill" style="color: #10B981; font-size: 24px;"></i>',
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
                alert(`Could not load template: ${error.message}`);
                return null;
            }
        }

        function applyTemplate(templateData) {
            const template = templateData.template;
            
            const titleInput = document.getElementById('inpTitle');
            const descInput = document.getElementById('inpDesc');
            const budgetInput = document.getElementById('inpBudget');
            const dueInput = document.getElementById('inpDue');
            
            if (titleInput) titleInput.value = template.title;
            if (descInput) descInput.value = template.description;
            if (budgetInput) budgetInput.value = template.budget;
            
            const dueDate = new Date();
            dueDate.setDate(dueDate.getDate() + template.duration_days);
            if (dueInput) dueInput.value = dueDate.toISOString().split('T')[0];
            
            if (taskRows) {
                taskRows.innerHTML = '';
                template.tasks.forEach(task => {
                    addTaskRow(task);
                });
            }
            
            const formData = {
                title: template.title,
                description: template.description,
                budget: template.budget,
                due_date: dueDate.toISOString().split('T')[0],
                tasks: template.tasks
            };
            localStorage.setItem('ai_proj_inputs', JSON.stringify(formData));
            
            if (inputsPanel && inputsPanel.classList.contains('hidden') && toggleInputs) {
                toggleInputs.click();
            }
            
            if (templateModal) {
                templateModal.classList.add('hidden');
                templateModal.style.display = 'none';
            }
            
            alert(`Template "${templateData.name}" has been applied successfully!`);
        }

        function renderTemplateCards() {
            if (!templateGrid || !templateCardTemplate) return;
            
            templateGrid.innerHTML = '';
            
            availableTemplates.forEach(template => {
                const card = templateCardTemplate.content.cloneNode(true);
                
                card.querySelector('.template-icon').innerHTML = template.icon;
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
                    templateModal.style.display = 'block';
                }
            });
        }
        
        if (btnUseTemplateHeader) {
            btnUseTemplateHeader.addEventListener('click', () => {
                if (templateModal) {
                    renderTemplateCards();
                    templateModal.classList.remove('hidden');
                    templateModal.style.display = 'block';
                }
            });
        }
        
        if (closeTemplateModal) {
            closeTemplateModal.addEventListener('click', () => {
                if (templateModal) {
                    templateModal.classList.add('hidden');
                    templateModal.style.display = 'none';
                }
            });
        }
        
        if (skipTemplate) {
            skipTemplate.addEventListener('click', () => {
                if (templateModal) {
                    templateModal.classList.add('hidden');
                    templateModal.style.display = 'none';
                }
            });
        }
        
        if (templateModal) {
            templateModal.addEventListener('click', (e) => {
                if (e.target === templateModal) {
                    templateModal.classList.add('hidden');
                    templateModal.style.display = 'none';
                }
            });
        }

        if (toggleInputs && inputsPanel) {
            toggleInputs.addEventListener('click', () => {
                inputsPanel.classList.toggle('hidden');
            });
        }

        if (btnAddTask) {
            btnAddTask.addEventListener('click', () => addTaskRow());
        }

        addRow('assistant', '<div class="rounded-xl p-3 bg-white border-gray-200"><div class="font-extrabold mb-1">Welcome</div>Provide the <b>project title</b>, a short <b>description</b>, the <b>due date</b>, the <b>budget</b>, and any <b>tasks</b>. If you don\'t have tasks, I\'ll propose a set of <b>Suggested Tasks</b> you can import with one click, then I\'ll build a <b>due-date–anchored</b> timeline with <b>numbered steps</b>, roles/skills, hours, and an expense estimate.<br><br><button onclick="document.getElementById(\'btnUseTemplateHeader\').click()" class="mt-2 px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2"><i class="bi bi-lightning-charge-fill"></i> Quick Start with Template</button></div>');
    })();
    </script>
</x-app-layout>