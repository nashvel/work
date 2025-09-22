<!-- libs (already on your page is fine) -->
<link rel="stylesheet" href="/assets/libs/dragula/dragula.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.css">
<script src="/assets/libs/dragula/dragula.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  /* ====== BOARD & COLUMNS ====== */
  .kb-board { --gap:16px; }
  .kb-header {
    background: linear-gradient(90deg,#0ea5e9,#3b82f6);
    color:#fff; border-radius:.75rem; padding:12px 16px; margin-bottom:12px;
    display:flex; align-items:center; justify-content:space-between;
  }
  .kb-header h3{ margin:0; font-weight:700; font-size:1.05rem; letter-spacing:.2px; }

  .kb-grid{
    display:grid; gap:var(--gap);
    grid-template-columns: repeat(1, minmax(0,1fr));
  }
  @media(min-width:768px){ .kb-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); } }
  @media(min-width:1280px){ .kb-grid{ grid-template-columns: repeat(5, minmax(0,1fr)); } }

  .kb-col{ display:flex; flex-direction:column; min-width:0; }
  .kb-col-head{
    display:flex; align-items:center; justify-content:space-between;
    border-radius:.6rem; padding:.5rem .75rem; font-weight:600; font-size:.92rem;
    border:1px solid #e5e7eb;
  }
  .kb-count{
    background:#111827; color:#fff; font-weight:700; font-size:.72rem;
    border-radius:999px; padding:.15rem .45rem;
  }

  /* Column-specific header colors (soft) */
  .kb-col--new        .kb-col-head{ background:#FFF7ED; color:#92400E; }  /* amber-50 */
  .kb-col--todo       .kb-col-head{ background:#EFF6FF; color:#1D4ED8; }  /* blue-50 */
  .kb-col--inprogress .kb-col-head{ background:#EEF2FF; color:#4F46E5; }  /* indigo-50 */
  .kb-col--inreview   .kb-col-head{ background:#ECFDF5; color:#065F46; }  /* emerald-50 */
  .kb-col--completed  .kb-col-head{ background:#F3F4F6; color:#111827; }  /* gray-100 */

  .kanban-tasks{ margin-top:10px; min-height:120px; }
  .task-Null{ min-height:60px; border:1px dashed #e5e7eb; border-radius:.6rem; }

  /* ====== CARDS ====== */
  .kb-card{
    background:#fff; border:1px solid #e5e7eb; border-radius:.6rem; margin-bottom:12px;
    overflow:hidden; transition:box-shadow .15s ease, transform .12s ease;
  }
  .kb-card:hover{ box-shadow:0 6px 18px rgba(0,0,0,.07); transform: translateY(-1px); }
  .kb-head{ display:flex; justify-content:space-between; padding:.5rem .75rem; align-items:center; }
  .kb-title{ font-weight:600; font-size:.95rem; color:#111827; margin:0 0 .25rem; }
  .kb-body{ padding:.5rem .75rem; color:#374151; }
  .kb-meta{ display:flex; flex-wrap:wrap; gap:.4rem; margin-top:.35rem; font-size:.8rem; color:#4b5563; }
  .kb-badge{ display:inline-flex; align-items:center; gap:.25rem; padding:.125rem .4rem; border-radius:.375rem; background:#f3f4f6; border:1px solid #e5e7eb; }

  /* Left status accent (soft) */
  .kb-card.edge-pending   { border-left:4px solid #F59E0B; } /* amber-500 */
  .kb-card.edge-done      { border-left:4px solid #22C55E; } /* green-500 */
  .kb-card.edge-close     { border-left:4px solid #3B82F6; } /* blue-500 */
  .kb-card.edge-unattended{ border-left:4px solid #F43F5E; } /* rose-500 */

  /* Soft status chips */
  .kb-status.pending{ background:#FEF3C7 }     /* amber-100 */
  .kb-status.done{ background:#DCFCE7 }        /* green-100 */
  .kb-status.close{ background:#DBEAFE }       /* blue-100 */
  .kb-status.unattended{ background:#FFE4E6 }  /* rose-100 */

  /* Tiny avatars / default images inside cards (kept small) */
  .kb-avatars{ display:flex; gap:6px; align-items:center; }
  .kb-avatars img.kb-avatar{ width:22px; height:22px; border-radius:999px; object-fit:cover; border:1px solid #e5e7eb; }

  /* Dragula */
  .gu-transit{ opacity:.55 }
  .gu-mirror{ transform: rotate(2deg); }

  /* SweetAlert compact modal + 10px paddings */
  .sw-modal.swal2-popup{ padding:10px !important; }
  .sw-modal .swal2-title{ font-weight:600; font-size:1rem; margin:0 0 6px; color:#111827; }
  .sw-modal .swal2-html-container{ margin:0; }
  .swal2-input, .swal2-textarea, .swal2-select{ width:100%; margin:0; }
</style>

<div id="kanban_board_here"></div>

<script>
(function(){
  "use strict";

  const csrf   = document.querySelector('meta[name="csrf-token"]')?.content || '';

  // Endpoints (no conversation id)
  const kbList   = `/kanban`;
  const typeUrl  = (id) => `/events/${encodeURIComponent(id)}/type`;
  const eventUrl = (id) => `/events/${encodeURIComponent(id)}`;

  // Map column id -> DB type
  const COL_MAP = {
    'new-tasks-draggable':        'Planning',
    'todo-tasks-draggable':       'Procurement',
    'inprogress-tasks-draggable': 'Construction',
    'inreview-tasks-draggable':   'Inspection',
    'completed-tasks-draggable':  'Completed',
  };
  const COL_IDS = Object.keys(COL_MAP);
  const LABELS  = {
    new:        'Planning',
    todo:       'Procurement',
    inprogress: 'Construction',
    inreview:   'Inspection',
    completed:  'Closeout'
  };

  // ---- build the board skeleton (titles/colors) ----
  function mountBoard(){
    const host = document.getElementById('kanban_board_here');
    if(!host) return;

    host.innerHTML = `
      <div class="kb-board">

        <div class="kb-grid TASK-kanban-board">
          ${[
            ['new-tasks','new-tasks-draggable','new'],
            ['todo-tasks','todo-tasks-draggable','todo'],
            ['inprogress-tasks','inprogress-tasks-draggable','inprogress'],
            ['inreview-tasks','inreview-tasks-draggable','inreview'],
            ['completed-tasks','completed-tasks-draggable','completed'],
          ].map(([wrapId, dragId, key]) => `
            <div class="kanban-tasks-type kb-col kb-col--${key}">
              <div class="kb-col-head">
                <span>${LABELS[key]}</span>
                <span class="kb-count badge-task">0</span>
              </div>
              <div class="kanban-tasks" id="${wrapId}">
                <div id="${dragId}" data-view-btn="${wrapId}"></div>
              </div>
            </div>
          `).join('')}
        </div>
      </div>
    `;
  }

  // ------- utils
  const pad2 = n => String(n).padStart(2,'0');
  const fmt12 = (hhmm) => {
    if(!hhmm) return '';
    let [h,m] = hhmm.split(':').map(v=>parseInt(v,10));
    const ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12 || 12;
    return `${h}${m ? ':'+pad2(m) : ''} ${ampm}`;
  };
  const escapeHtml = (s)=> String(s ?? '').replace(/[&<>"']/g, c=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;' }[c]));

  function getContainers(){ return COL_IDS.map(id => document.getElementById(id)).filter(Boolean); }

  // ------- render a card
  function renderCard(item){
    const time = item.from ? (item.to ? `${fmt12(item.from)} – ${fmt12(item.to)}` : fmt12(item.from)) : '';
    const edge = (item.status||'pending').toLowerCase(); // pending|done|close|unattended
    return `
      <div class="box border kb-card edge-${edge}" data-id="${item.id}">
        <div class="box-header kb-head">
          <div class="task-badges" style="display:flex;gap:.4rem;flex-wrap:wrap;">
            <span class="kb-badge">#${item.id}</span>
            <span class="kb-badge js-type-badge">${(item.type||'new').toUpperCase()}</span>
          </div>
          <div class="ti-dropdown hs-dropdown [--placement:bottom-right]">
            <button class="ti-btn ti-btn-sm bg-light kb-menu" type="button"><i class="ri-more-2-fill"></i></button>
            <ul class="ti-dropdown-menu hs-dropdown-menu hidden">
              <li><a class="ti-dropdown-item kb-view"  href="javascript:void(0);">View</a></li>
              <li><a class="ti-dropdown-item kb-edit"  href="javascript:void(0);">Edit</a></li>
              <li><a class="ti-dropdown-item kb-del"   href="javascript:void(0);">Delete</a></li>
            </ul>
          </div>
        </div>

        <div class="box-body kb-body">
          <h6 class="kb-title">${escapeHtml(item.title || '')}</h6>
          ${item.description ? `<div class="kanban-task-description">${escapeHtml(item.description)}</div>` : ''}
          <div class="kb-meta">
            ${item.date ? `<span class="kb-badge"><i class="ri-calendar-line"></i> ${item.date}</span>`:''}
            ${time ? `<span class="kb-badge"><i class="ri-time-line"></i> ${time}</span>` : ''}
            <span class="kb-badge kb-status ${(item.status||'pending').toLowerCase()}">${(item.status||'pending').toUpperCase()}</span>
          </div>
        </div>
      </div>
    `;
  }

  function clearAll(){ getContainers().forEach(c => c.innerHTML = ''); }

  function updateCounts(){
    for(const cid of COL_IDS){
      const col   = document.getElementById(cid);
      const wrap  = col?.closest('.kb-col');
      const badge = wrap?.querySelector('.badge-task');
      if(badge) badge.textContent = String(col?.children.length || 0);
      if(col) col.classList.toggle('task-Null', col.children.length === 0);
    }
  }

  // ------- load data
  async function loadKanban(){
    let res;
    try{ res = await fetch(kbList, { headers:{ 'Accept': 'application/json' } }); }
    catch(e){ console.error('[KANBAN] Fetch error:', e); return; }

    if(!res.ok){ console.error('[KANBAN] Load failed:', res.status, res.statusText); return; }

    let list = [];
    try{
      list = await res.json();
      if(!Array.isArray(list)) throw new Error('Response is not an array');
    }catch(e){ console.error('[KANBAN] Invalid JSON:', e); return; }

    clearAll();

    list.forEach(item=>{
      const targetId = COL_IDS.find(cid => COL_MAP[cid] === (item.type || 'new')) || 'new-tasks-draggable';
      const col = document.getElementById(targetId);
      if(col) col.insertAdjacentHTML('beforeend', renderCard(item));
    });

    updateCounts();
  }

  // ------- drag & drop
  let drake = null;
  function initDnD(){
    const containers = getContainers();
    if(!containers.length || typeof dragula !== 'function') return;

    drake?.destroy?.();
    drake = dragula(containers, {
      invalid: (el, handle) => !!handle?.closest('.kb-menu'),
    });

    drake.on('drop', async (el, target, source, sibling) => {
      const id = el.getAttribute('data-id');
      const targetType = COL_MAP[target?.id];
      if(!id || !targetType) return;

      try{
        const res = await fetch(typeUrl(id), {
          method: 'PATCH',
          headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
          },
          body: JSON.stringify({ type: targetType })
        });
        if(!res.ok) throw new Error('Type update failed');
        el.querySelector('.js-type-badge').textContent = (targetType||'').toUpperCase();
        updateCounts();
        if (window.calendar?.refetchEvents) window.calendar.refetchEvents();
      }catch(e){
        console.error(e);
        if(source){
          if(sibling) source.insertBefore(el, sibling);
          else source.appendChild(el);
        }
        Swal.fire({icon:'error', title:'Update failed'});
      }
    });
  }

  // ------- card actions
  function wireCardActions(){
    document.addEventListener('click', async (e)=>{
      const card = e.target.closest('.kb-card');
      if(!card) return;
      const id = card.getAttribute('data-id');

      if(e.target.closest('.kb-view')) { e.preventDefault(); return viewItem(id); }
      if(e.target.closest('.kb-edit')) { e.preventDefault(); return editItem(id, card); }
      if(e.target.closest('.kb-del'))  { e.preventDefault(); return delItem(id, card); }
    });
  }

  async function fetchOne(id){
    const res = await fetch(kbList, { headers:{'Accept':'application/json'} });
    if(!res.ok) return null;
    const list = await res.json();
    return list.find(x => String(x.id) === String(id));
  }

  async function viewItem(id){
    const it = await fetchOne(id);
    if(!it) return;
    const time = it.from ? (it.to ? `${fmt12(it.from)} – ${fmt12(it.to)}` : fmt12(it.from)) : '';
    Swal.fire({
      title: 'Schedule',
      html: `
        <div class="sw-form" style="display:grid;grid-template-columns:120px 1fr;gap:10px;align-items:center;text-align:left">
          <label>Title</label><div>${escapeHtml(it.title||'')}</div>
          <label>Date</label><div>${it.date ?? ''}</div>
          <label>Time</label><div>${time || '-'}</div>
          <label>Type</label><div>${(it.type||'new').toUpperCase()}</div>
          <label>Status</label><div>${(it.status||'pending').toUpperCase()}</div>
          <label>Description</label><div>${escapeHtml(it.description||'-')}</div>
        </div>
      `,
      customClass:{ popup:'sw-modal', title:'sw-title' }
    });
  }

  async function editItem(id, cardEl){
    const it = await fetchOne(id);
    if(!it) return;

    const dateLabel = it.date || '';
    const defaultFrom = it.from || '09:00';
    const defaultTo   = it.to   || '';

    const html = `
      <div class="sw-form" style="display:grid;grid-template-columns:120px 1fr;gap:10px 10px;align-items:center;text-align:left">
        <label>Date</label>
        <input class="swal2-input" value="${dateLabel}" disabled>

        <label>Type</label>
        <select id="evt-type" class="swal2-input">
          <option value="new" ${it.type==='new'?'selected':''}>New</option>
          <option value="todo" ${it.type==='todo'?'selected':''}>To Do</option>
          <option value="inprogress" ${it.type==='inprogress'?'selected':''}>In Progress</option>
          <option value="inreview" ${it.type==='inreview'?'selected':''}>In Review</option>
          <option value="completed" ${it.type==='completed'?'selected':''}>Completed</option>
        </select>

        <label>Title</label>
        <input id="evt-title" class="swal2-input" value="${escapeHtml(it.title||'')}" placeholder="Event title">

        <label>Time</label>
        <div class="sw-row-time" style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
          <input id="evt-time-from" class="swal2-input" type="time" value="${defaultFrom}">
          <input id="evt-time-to" class="swal2-input" type="time" value="${defaultTo}">
        </div>

        <label>Status</label>
        <select id="evt-status" class="swal2-input">
          <option value="pending" ${it.status==='pending'?'selected':''}>Pending</option>
          <option value="done" ${it.status==='done'?'selected':''}>Done</option>
          <option value="close" ${it.status==='close'?'selected':''}>Close</option>
          <option value="unattended" ${it.status==='unattended'?'selected':''}>Unattended</option>
        </select>

        <label>Description</label>
        <textarea id="evt-desc" class="swal2-textarea" rows="3" placeholder="Notes">${escapeHtml(it.description||'')}</textarea>
      </div>
    `;

    const resp = await Swal.fire({
      title: 'Edit Schedule',
      html,
      customClass:{ popup:'sw-modal', title:'sw-title' },
      focusConfirm:false,
      preConfirm: () => {
        const title  = (document.getElementById('evt-title').value||'').trim();
        const from   = document.getElementById('evt-time-from').value;
        const to     = document.getElementById('evt-time-to').value;
        const type   = document.getElementById('evt-type').value;
        const status = document.getElementById('evt-status').value;
        const desc   = document.getElementById('evt-desc').value || null;
        if(!title || !from){ Swal.showValidationMessage('Title and From time are required'); return false; }
        if(to && to < from){ Swal.showValidationMessage('End time must be after start time'); return false; }
        return { title, from, to, type, status, description: desc };
      },
      showCancelButton:true,
      confirmButtonText:'Save'
    });

    if(!resp.value) return;

    const payload = {
      title: resp.value.title,
      date:  it.date,
      from:  resp.value.from,
      to:    resp.value.to || null,
      type:  resp.value.type,
      status: resp.value.status,
      description: resp.value.description
    };

    const upd = await fetch(eventUrl(id), {
      method: 'PUT',
      headers:{
        'Accept':'application/json',
        'Content-Type':'application/json',
        'X-CSRF-TOKEN': csrf
      },
      body: JSON.stringify(payload)
    });

    if(!upd.ok){ Swal.fire({icon:'error', title:'Update failed'}); return; }

    // rebuild & move if type changed
    const newCard = renderCard({ ...it, ...payload });
    const targetColId = COL_IDS.find(cid => COL_MAP[cid] === payload.type) || 'new-tasks-draggable';
    const targetCol   = document.getElementById(targetColId);

    cardEl.remove();
    if(targetCol) targetCol.insertAdjacentHTML('afterbegin', newCard);

    updateCounts();
    if (window.calendar?.refetchEvents) window.calendar.refetchEvents();
    Swal.fire({icon:'success', title:'Updated', timer:1100, showConfirmButton:false});
  }

  async function delItem(id, cardEl){
    const ask = await Swal.fire({icon:'warning', title:'Delete this schedule?', showCancelButton:true, confirmButtonText:'Delete'});
    if(!ask.isConfirmed) return;

    const res = await fetch(eventUrl(id), {
      method: 'DELETE',
      headers:{ 'Accept':'application/json', 'X-CSRF-TOKEN': csrf }
    });
    if(!res.ok){ Swal.fire({icon:'error', title:'Delete failed'}); return; }

    cardEl.remove();
    updateCounts();
    if (window.calendar?.refetchEvents) window.calendar.refetchEvents();
    Swal.fire({icon:'success', title:'Deleted', timer:900, showConfirmButton:false});
  }

  // SimpleBar for scroll
  function initSimpleBars(){
    ['new-tasks','todo-tasks','inprogress-tasks','inreview-tasks','completed-tasks'].forEach(id=>{
      const el = document.getElementById(id);
      if(el && !el.dataset.sbInit){ new SimpleBar(el, { autoHide:true }); el.dataset.sbInit='1'; }
    });
  }

  // Init
  document.addEventListener('DOMContentLoaded', async () => {
    mountBoard();          // build board skeleton (with colored titles)
    initSimpleBars();      // add scrollers
    await loadKanban();    // fetch & render cards
    initDnD();             // drag & drop
    wireCardActions();     // view/edit/delete
    setInterval(updateCounts, 600);
  });
})();
</script>
