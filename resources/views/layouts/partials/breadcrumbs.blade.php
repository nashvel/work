<nav class="bg-white rounded-md shadow-none border px-4 py-2 w-full">
  <div class="flex items-center justify-between gap-3">

    <!-- Left: breadcrumbs -->
    <ol class="flex items-center text-sm text-gray-500 space-x-2">
      <!-- Home -->
      <li class="flex items-center">
        <a href="/" class="flex items-center text-primary hover:text-primary">
          <svg class="w-4 h-4 mx-2 text-primary" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
          <span>Home</span>
        </a>
      </li>

      <!-- Dynamic breadcrumbs -->
      @for ($i = 0; $i < 10; $i++)
        @php
          $slotVar   = 'url_' . $i;
          $slotValue = isset($$slotVar) ? json_decode($$slotVar, true) : null;
        @endphp

        @if (!empty($slotValue) && is_array($slotValue))
          <li class="flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ $slotValue['link'] ?? '#' }}" class="text-primary hover:text-primary">
              {{ $slotValue['text'] ?? 'Plan Panther ' . $i }}
            </a>
          </li>
        @endif
      @endfor

      <!-- Current Page -->
      @if (!empty($active))
        <li class="flex items-center gap-2">
          <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 5l7 7-7 7" />
          </svg>
          <span class="text-gray-500 mx-2">{{ $active }}</span>
        </li>
      @endif
    </ol>

    <!-- Right: digital clock + emphasized timezone (defaults to California) -->
    <div class="flex items-center gap-3 text-right" id="bcClock" data-timezone="">
      <div class="hidden sm:block text-xs text-gray-500" id="bcDate">—</div>

      <div class="font-mono text-sm md:text-base text-gray-700 flex items-baseline gap-1" aria-label="Current time">
        <span id="bcHH">--</span><span class="blink">:</span><span id="bcMM">--</span>
        <span class="blink">:</span><span id="bcSS">--</span>
        <span id="bcMer" class="ml-1 text-xs text-gray-500"></span>
      </div>

      <div class="flex items-center gap-2">
        <!-- Abbreviation badge (PDT/PST) -->
        <span id="bcTZAbbr"
              class="inline-flex items-center rounded px-2 py-0.5 text-[10px] font-semibold
                     bg-sky-100 text-sky-800 border border-sky-200">
          —
        </span>
        <!-- Full timezone label -->
        <span id="bcTZLong" class="hidden md:inline text-[11px] text-gray-600">
          —
        </span>
      </div>
    </div>

  </div>
</nav>

<style>
  @keyframes blink { 0%,49%{opacity:1} 50%,100%{opacity:.18} }
  .blink { animation: blink 1s steps(1,end) infinite; }
</style>

<script>
(function(){
  const els = {
    root: document.getElementById('bcClock'),
    hh:   document.getElementById('bcHH'),
    mm:   document.getElementById('bcMM'),
    ss:   document.getElementById('bcSS'),
    mer:  document.getElementById('bcMer'),
    date: document.getElementById('bcDate'),
    abbr: document.getElementById('bcTZAbbr'),
    long: document.getElementById('bcTZLong'),
  };

  // Default to California unless overridden via data-timezone
  function getActiveTZ() {
    const forced = els.root?.dataset?.timezone?.trim();
    return forced || 'America/Los_Angeles';
  }
  const pad = n => String(n).padStart(2,'0');

  function tzName(date, tz, style) {
    const parts = new Intl.DateTimeFormat('en-US', { timeZone: tz, timeZoneName: style }).formatToParts(date);
    return parts.find(p => p.type === 'timeZoneName')?.value || '';
  }

  function offsetMinutes(date, tz) {
    // e.g. "GMT-7"
    const name = tzName(date, tz, 'shortOffset');
    const m = name.match(/GMT([+-]\d{1,2})(?::(\d{2}))?/i);
    if (!m) return 0;
    const h = parseInt(m[1], 10);
    const min = parseInt(m[2] || '0', 10);
    return h * 60 + (h < 0 ? -min : min);
  }

  function deriveTZ(date, tz) {
    // Try direct names
    let abbr = tzName(date, tz, 'short'); // e.g., "PDT" or "GMT-7"
    let long = tzName(date, tz, 'long');  // e.g., "Pacific Daylight Time"

    // If short returns GMT offset, provide a friendly fallback for Los Angeles
    if (/^GMT/i.test(abbr)) {
      const nowOff = offsetMinutes(date, tz);
      const janOff = offsetMinutes(new Date(date.getFullYear(), 0, 1), tz);
      const isDST  = nowOff !== janOff;

      if (tz === 'America/Los_Angeles') {
        abbr = isDST ? 'PDT' : 'PST';
        long = isDST ? 'Pacific Daylight Time' : 'Pacific Standard Time';
      }
    }
    return { abbr: (abbr || '').toUpperCase(), long: long || '' };
  }

  function tick() {
    const tz  = getActiveTZ();
    const now = new Date();

    // time (12h)
    const tf = new Intl.DateTimeFormat('en-US', {
      timeZone: tz, hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true
    }).formatToParts(now);
    const part = t => tf.find(p => p.type === t)?.value || '';
    els.hh.textContent  = pad(part('hour'));
    els.mm.textContent  = pad(part('minute'));
    els.ss.textContent  = pad(part('second'));
    els.mer.textContent = (part('dayPeriod') || '').toUpperCase();

    // date
    els.date.textContent = new Intl.DateTimeFormat(undefined, {
      timeZone: tz, weekday: 'short', month: 'short', day: '2-digit', year: 'numeric'
    }).format(now);

    // timezone (abbr + full label)
    const names = deriveTZ(now, tz);
    els.abbr.textContent = names.abbr || '—';
    els.long.textContent = names.long || (tz.replace('_',' '));
  }

  tick();
  setInterval(tick, 1000);
})();
</script>
