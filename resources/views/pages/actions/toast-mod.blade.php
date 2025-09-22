<!-- TOAST CONTAINER (top-right) -->
<div id="notification-container"
     class="fixed top-14 right-4 z-[1000] w-[clamp(16rem,40vw,28rem)] space-y-2 pointer-events-none">
</div>

<style>
  @keyframes toastIn {
    from { opacity: 0; transform: translateY(-8px) translateX(8px) scale(.98); }
    to   { opacity: 1; transform: translateY(0) translateX(0) scale(1); }
  }
  @keyframes toastOut {
    from { opacity: 1; transform: translateY(0) translateX(0) scale(1); }
    to   { opacity: 0; transform: translateY(-8px) translateX(8px) scale(.98); }
  }
  .notification {
    animation: toastIn .28s ease-out forwards;
  }
  .notification.is-leaving {
    animation: toastOut .24s ease-in forwards;
  }
  .notification .progress {
    height: 3px;
    width: 100%;
    transform-origin: left;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
  }
  .notification.paused .progress {
    animation-play-state: paused;
  }
</style>

<script>
  // Top-right toast
  function ktoast_alert(type = 'info', icon = 'info-circle', response = '', opts = {}) {
    const {
      duration = 4000,     // ms
      dismissible = true,  // show close button
      keep = false,        // don't auto-dismiss if true
      accent = null        // override color (e.g. '#10b981')
    } = opts;

    const palette = {
      success: { dot: 'text-green-600',   bg: 'bg-white', border: '#22c55e', bar: '#22c55e' },
      danger:  { dot: 'text-red-600',     bg: 'bg-white', border: '#ef4444', bar: '#ef4444' },
      warning: { dot: 'text-amber-600',   bg: 'bg-white', border: '#f59e0b', bar: '#f59e0b' },
      info:    { dot: 'text-sky-600',     bg: 'bg-white', border: '#0ea5e9', bar: '#0ea5e9' },
      primary: { dot: 'text-indigo-600',  bg: 'bg-white', border: '#6366f1', bar: '#6366f1' }
    };
    const c = palette[type] || palette.info;
    const borderColor = accent || c.border;
    const barColor    = accent || c.bar;

    const container = document.getElementById('notification-container');
    if (!container) return;

    // Limit stack (remove oldest if > 5)
    const maxToasts = 5;
    while (container.children.length >= maxToasts) {
      container.firstElementChild?.remove();
    }

    const toast = document.createElement('div');
    toast.className =
      `notification pointer-events-auto rounded-md shadow-sm ring-1 ring-black/5 ${c.bg}`;
    toast.style.borderLeft = `4px solid ${borderColor}`;

    // Inner layout
    toast.innerHTML = `
      <div class="p-3 flex items-start gap-3">
        <div class="shrink-0 leading-none">
          <i class="bi bi-${icon} ${c.dot} text-lg align-middle"></i>
        </div>
        <div class="min-w-0 flex-1">
          <p class="text-sm text-slate-700 m-0"></p>
        </div>
        ${dismissible ? `
          <button type="button"
                  class="shrink-0 inline-flex items-center justify-center rounded hover:bg-slate-100 w-7 h-7 text-slate-500"
                  aria-label="Close">
            <i class="bi bi-x-lg text-[0.9rem]"></i>
          </button>` : ``}
      </div>
      <div class="progress" style="background:${barColor};"></div>
    `;

    // Set message safely (no HTML injection)
    toast.querySelector('p').textContent = response ?? '';

    // Progress animation
    const progress = toast.querySelector('.progress');
    if (!keep) {
      progress.style.animationName = 'shrinkBar';
      progress.style.animationDuration = `${duration}ms`;
      // create / reuse keyframes
      createShrinkKeyframes();
    } else {
      progress.style.display = 'none';
    }

    // Close handlers
    let removeTimer = null, leaveTimer = null, startTime = Date.now(), remaining = duration;

    const startAutoRemove = () => {
      if (keep) return;
      clearTimeout(removeTimer);
      removeTimer = setTimeout(() => beginLeave(), remaining);
    };

    const pause = () => {
      if (keep) return;
      toast.classList.add('paused');
      remaining -= (Date.now() - startTime);
      clearTimeout(removeTimer);
    };

    const resume = () => {
      if (keep) return;
      toast.classList.remove('paused');
      startTime = Date.now();
      startAutoRemove();
    };

    const beginLeave = () => {
      toast.classList.add('is-leaving');
      clearTimeout(leaveTimer);
      leaveTimer = setTimeout(() => toast.remove(), 260);
    };

    // Hover: pause/resume
    toast.addEventListener('mouseenter', pause);
    toast.addEventListener('mouseleave', resume);

    // Dismiss button
    if (dismissible) {
      toast.querySelector('button[aria-label="Close"]')?.addEventListener('click', beginLeave);
    }

    // Append to container
    container.appendChild(toast);

    // Kick off auto dismiss
    if (!keep) startAutoRemove();

    // Keyframes helper (once)
    function createShrinkKeyframes() {
      if (document.getElementById('toast-shrink-kf')) return;
      const style = document.createElement('style');
      style.id = 'toast-shrink-kf';
      style.textContent = `
        @keyframes shrinkBar {
          from { transform: scaleX(1); }
          to   { transform: scaleX(0); }
        }
      `;
      document.head.appendChild(style);
    }
  }

  // Example:
  // ktoast_alert('success', 'check-circle-fill', 'Saved successfully.');
  // ktoast_alert('danger',  'exclamation-triangle-fill', 'Something went wrong.', { duration: 6000 });
</script>
