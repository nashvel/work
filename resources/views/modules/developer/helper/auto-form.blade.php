@php
/**
 * Auto Form component (with grid column sizes)
 *
 * CONFIG (pass as $form):
 * [
 *   'id'      => 'expense-form',
 *   'action'  => route('pt.expense.store', $project ?? null),
 *   'method'  => 'POST',        // GET|POST|PUT|PATCH|DELETE
 *   'csrf'    => true,          // default true for non-GET
 *   'layout'  => [              // NEW: optional grid layout controls
 *      'cols'  => 12,           // grid-cols-12 (fixed to 12 for col-span system)
 *      'gap'   => 4,            // gap-4
 *      'class' => '',           // extra classes on grid container
 *   ],
 *   'fields'  => [
 *      // Common: type, name, label, icon, placeholder, value, required, class, wrapper_class
 *      // Sizes (NEW): col, col_sm, col_md, col_lg, col_xl, col_2xl
 *      // Types: text, number, date, textarea, richtext, file, select, radio, checkbox, hidden
 *   ],
 *   'buttons' => [ ... ],
 * ]
 */
$form      = $form ?? [];
$id        = $form['id']      ?? 'auto-form';
$action    = $form['action']  ?? '#';
$method    = strtoupper($form['method'] ?? 'POST');
$csrf      = $form['csrf']    ?? ($method !== 'GET');
$fields    = $form['fields']  ?? [];
$buttons   = $form['buttons'] ?? [];
$hasFile   = collect($fields)->contains(fn($f) => ($f['type'] ?? '') === 'file');

$layout    = $form['layout'] ?? [];
$gridCols  = 12; // fixed 12-col system for col-span utilities
$gridGap   = is_numeric($layout['gap'] ?? null) ? (int)$layout['gap'] : 4;
$gridExtra = $layout['class'] ?? '';

$spoofable = in_array($method, ['PUT','PATCH','DELETE'], true);
$displayMethod = $spoofable ? 'POST' : $method;

function af_old($name, $default = '') { return old($name, $default); }

/**
 * Compute responsive column classes from field config.
 * Supports ints (1–12) or raw strings. Example:
 *  - 'col' => 12, 'col_md' => 6, 'col_lg' => 4
 *  - 'col' => 'col-span-12 md:col-span-6 xl:col-span-3'
 */
function af_col_classes(array $f): string {
  // If a full class string is provided in `col` and it's not numeric, use as-is.
  if (isset($f['col']) && !is_numeric($f['col'])) {
    return trim((string)$f['col']);
  }

  // Helper to build 'prefix:col-span-N' or 'col-span-N' for base
  $mk = function($n, $bp = null) {
    $n = max(1, min(12, (int)$n));
    return $bp ? "{$bp}:col-span-{$n}" : "col-span-{$n}";
  };

  $out = [];

  // Base col
  $out[] = isset($f['col']) && is_numeric($f['col']) ? $mk($f['col']) : 'col-span-12';

  // Breakpoints
  $bpMap = [
    'col_sm'  => 'sm',
    'col_md'  => 'md',
    'col_lg'  => 'lg',
    'col_xl'  => 'xl',
    'col_2xl' => '2xl',
  ];
  foreach ($bpMap as $key => $bp) {
    if (isset($f[$key]) && is_numeric($f[$key])) {
      $out[] = $mk($f[$key], $bp);
    }
  }

  return implode(' ', array_filter($out));
}
@endphp

{{-- Quill assets (loaded only if there is at least one richtext field) --}}
@php $needsQuill = collect($fields)->contains(fn($f) => ($f['type'] ?? '') === 'richtext'); @endphp
@if($needsQuill)
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endif

<form id="{{ $id }}" method="{{ $displayMethod }}" action="{{ $action }}" @if($hasFile) enctype="multipart/form-data" @endif>
  @if($csrf) @csrf @endif
  @if($spoofable) @method($method) @endif

  {{-- Grid container (12-col) --}}
  <div class="grid grid-cols-12 gap-{{ $gridGap }} {{ $gridExtra }}">
    {{-- FIELD RENDERER --}}
    @foreach ($fields as $f)
      @php
        $type    = $f['type'] ?? 'text';
        $name    = $f['name'] ?? '';
        $label   = $f['label'] ?? null;
        $icon    = $f['icon'] ?? null;
        $ph      = $f['placeholder'] ?? '';
        $value   = $f['value'] ?? af_old($name);
        $req     = !empty($f['required']);
        $class   = $f['class'] ?? 'ti-form-input rounded-sm';
        $wclass  = $f['wrapper_class'] ?? '';
        $idAttr  = $f['id'] ?? $name;
        $colCls  = af_col_classes($f); // NEW
      @endphp

      {{-- Hidden (simple) --}}
      @if($type === 'hidden')
        <input type="hidden" name="{{ $name }}" id="{{ $idAttr }}" value="{{ $value }}">
        @continue
      @endif

      <div class="{{ $colCls }} {{ $wclass }}">
        @if($label)
          <label for="{{ $idAttr }}" class="form-label">
            {{ $label }} @if($req)<span class="text-red-500">*</span>@endif
          </label>
        @endif

        @if(in_array($type, ['text','number','date','file'], true))
          <div class="relative">
            @if($type === 'file')
              <input
                type="file"
                id="{{ $idAttr }}"
                name="{{ $name }}{{ !empty($f['multiple']) ? '[]' : '' }}"
                class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 file:border-0 file:bg-gray-200 file:me-4 file:py-2 file:px-4 dark:file:bg-black/20 dark:file:text-white/50 {{ $f['input_class'] ?? '' }}"
                @if(!empty($f['accept'])) accept="{{ $f['accept'] }}" @endif
                @if(!empty($f['multiple'])) multiple @endif
                @if($req) required @endif
              >
            @else
              <input
                type="{{ $type }}"
                id="{{ $idAttr }}"
                name="{{ $name }}"
                value="{{ $type === 'date' ? af_old($name, $value) : $value }}"
                placeholder="{{ $ph }}"
                class="{{ $class }} {{ $icon ? 'ps-11' : '' }}"
                @if($type === 'number' && !empty($f['step'])) step="{{ $f['step'] }}" @endif
                @if($type === 'number' && isset($f['min'])) min="{{ $f['min'] }}" @endif
                @if($type === 'number' && isset($f['max'])) max="{{ $f['max'] }}" @endif
                @if($req) required @endif
              >
              @if($icon)
                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                  <i class="{{ $icon }}"></i>
                </div>
              @endif
            @endif
          </div>

        @elseif($type === 'textarea')
          <textarea
            id="{{ $idAttr }}"
            name="{{ $name }}"
            rows="{{ $f['rows'] ?? 3 }}"
            class="{{ $class }} w-full"
            placeholder="{{ $ph }}"
            @if($req) required @endif
          >{{ af_old($name, $value) }}</textarea>

        @elseif($type === 'richtext')
          {{-- Rich text mount + hidden --}}
          <div id="{{ $idAttr }}__editor" class="!min-h-[120px] ti-form-input rounded-sm" style="height: 120px !important"></div>
          <textarea id="{{ $idAttr }}" name="{{ $name }}" class="hidden">{{ af_old($name, $value) }}</textarea>

        @elseif($type === 'select')
          <div class="relative">
            <select
              id="{{ $idAttr }}"
              name="{{ $name }}{{ !empty($f['multiple']) ? '[]' : '' }}"
              class="{{ $class }} {{ $icon ? 'ps-11' : '' }}"
              @if(!empty($f['multiple'])) multiple @endif
              @if($req) required @endif
            >
              @if(!empty($f['placeholder']))
                <option value="" disabled {{ empty($value) ? 'selected' : '' }}>{{ $f['placeholder'] }}</option>
              @endif
              @foreach(($f['options'] ?? []) as $opt)
                @php
                  $ov = $opt['value'] ?? $opt['id'] ?? '';
                  $ol = $opt['label'] ?? $opt['text'] ?? $ov;
                  $selected = (is_array($value) ? in_array($ov, $value) : (string)$ov === (string)$value);
                @endphp
                <option value="{{ $ov }}" @if($selected) selected @endif>{{ $ol }}</option>
              @endforeach
            </select>
            @if($icon)
              <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                <i class="{{ $icon }}"></i>
              </div>
            @endif
          </div>

        @elseif($type === 'radio')
          <div class="flex flex-wrap gap-4">
            @foreach(($f['options'] ?? []) as $opt)
              @php
                $ov = $opt['value'] ?? $opt['id'] ?? '';
                $ol = $opt['label'] ?? $opt['text'] ?? $ov;
                $checked = (string)$ov === (string)$value;
                $rid = $idAttr.'_'.$loop->index;
              @endphp
              <label for="{{ $rid }}" class="inline-flex items-center gap-2">
                <input type="radio" id="{{ $rid }}" class="form-check-input" name="{{ $name }}" value="{{ $ov }}" @if($checked) checked @endif @if($req) required @endif>
                <span>{{ $ol }}</span>
              </label>
            @endforeach
          </div>

        @elseif($type === 'checkbox')
          <div class="flex flex-wrap gap-4">
            @foreach(($f['options'] ?? []) as $opt)
              @php
                $ov = $opt['value'] ?? $opt['id'] ?? '';
                $ol = $opt['label'] ?? $opt['text'] ?? $ov;
                $checked = is_array($value) ? in_array($ov, $value) : (bool)$value;
                $cid = $idAttr.'_'.$loop->index;
              @endphp
              <label for="{{ $cid }}" class="inline-flex items-center gap-2">
                <input type="checkbox" id="{{ $cid }}" class="form-check-input" name="{{ $name }}{{ is_array($value) ? '[]' : '' }}" value="{{ $ov }}" @if($checked) checked @endif @if($req) required @endif>
                <span>{{ $ol }}</span>
              </label>
            @endforeach
          </div>

        @endif

        {{-- Per-field error --}}
        @error($name)
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>
    @endforeach
  </div>

  {{-- Buttons --}}
  <div class="flex justify-end gap-2 mt-4">
    @forelse ($buttons as $b)
      @php
        $bt = $b['type'] ?? 'button';
        $bl = $b['label'] ?? 'Button';
        $bi = $b['icon'] ?? null;
        $bc = $b['class'] ?? 'px-4 py-2 border rounded';
      @endphp

      @if($bt === 'link')
        <a href="{{ $b['href'] ?? 'javascript:void(0);' }}" class="{{ $bc }}">
          @if($bi)<i class="{{ $bi }}"></i>@endif <span class="mx-1">{{ $bl }}</span>
        </a>
      @else
        <button type="{{ $bt }}" class="{{ $bc }}">
          @if($bi)<i class="{{ $bi }}"></i>@endif <span class="mx-1">{{ $bl }}</span>
        </button>
      @endif
    @empty
      {{-- sensible defaults --}}
      <button type="reset" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">Cancel</button>
      <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <i class="bi bi-save"></i><span class="mx-1">Save</span>
      </button>
    @endforelse
  </div>
</form>

@if($needsQuill)
<script>
(function initQuillAutoForm() {
  const formEl = document.getElementById(@json($id));
  if (!formEl) return;

  const mounts = @json(
    collect($fields)
      ->filter(fn($f) => ($f['type'] ?? '') === 'richtext')
      ->map(fn($f) => ['name' => $f['name'], 'id' => ($f['id'] ?? $f['name']), 'placeholder' => ($f['placeholder'] ?? '')])
      ->values()
  );

  mounts.forEach(m => {
    const mountId = `${m.id}__editor`;
    const mount = document.getElementById(mountId);
    const hidden = document.getElementById(m.id);
    if (!mount || !hidden) return;

    if (mount.dataset.quillInitialized === '1') return;
    mount.dataset.quillInitialized = '1';

    const quill = new Quill('#' + mountId, {
      theme: 'snow',
      modules: {
        toolbar: [
          ['bold','italic','underline','strike'],
          ['blockquote','code-block'],
          [{ 'list':'ordered' }, { 'list':'bullet' }],
          [{ 'header':[1,2,3,false] }],
          ['link','clean']
        ]
      },
      placeholder: m.placeholder || 'Enter text...'
    });

    quill.clipboard.dangerouslyPasteHTML((hidden?.value || '').trim());

    quill.clipboard.addMatcher(Node.ELEMENT_NODE, (node, delta) => {
      delta.ops = (delta.ops || []).map(op => {
        if (op.attributes) {
          delete op.attributes.color;
          delete op.attributes.background;
          delete op.attributes.size;
          delete op.attributes.font;
        }
        return op;
      });
      return delta;
    });

    const sync = () => { hidden.value = quill.root.innerHTML; };
    quill.on('text-change', sync);
    formEl.addEventListener('submit', sync);
  });
})();
</script>
@endif
