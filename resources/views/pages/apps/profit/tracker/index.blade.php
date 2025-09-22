<x-app-layout>

    <x-slot name="title">Manage Profit Tracker</x-slot>
    <x-slot name="url_1">{"link": "/crm/lead/generic", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/crm/lead/generic", "text": " Profit Tracker"}</x-slot>
    <x-slot name="active">Tracker</x-slot>
    <x-slot name="buttons">
        <button id="addRow" class="ti-btn ti-btn-light text-dark bg-white !border-0 btn-wave ">
            <i class="bi bi-plus-lg me-1"></i> Add Row
        </button>
        <button class="ti-btn text-white !border-0 btn-wave me-0" style="background-color: #2563eb"
            data-hs-overlay="#ai-profit-tracker">
            <i class="bi bi-robot me-1"></i>
            <span class="mx-1" style="font-weight: 400">AI Assistant Tools</span>
        </button>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i> Profit Tracking
                    <hr class="mb-3 mt-3">
                    <div class="custom-box">

                        <style>
                            .table-responsive { overflow: hidden; }
                            #featureTable { border-collapse: collapse; }
                            #featureTable td, #featureTable th { border: 1px solid rgba(0,0,0,0.2); }
                            #featureTable input[type="text"]{
                                width:100%; border:none; background:transparent; padding:4px 6px; font-size:14px; outline:none; box-shadow:none; border-radius:6px;
                            }
                            #featureTable input[type="text"]:focus{ background-color:#fef9e7; border:1px solid #ccc; border-radius:6px; }
                            #featureTable td{ padding:0; vertical-align:middle; }
                            .profit-positive{ color:#16a34a !important; } /* green-600 */
                            .profit-negative{ color:#dc2626 !important; } /* red-600 */
                        </style>

                        <div class="table-responsive shadow" style="overflow-x: hidden;">
                            <table id="featureTable" class="table table-sm text-xs align-middle" style="width:100%; white-space:nowrap;">
                                <thead class="text-nowrap">
                                <tr>
                                    <th style="width:30px; text-align:center;">#</th>
                                    <th>Company</th>           <!-- col 0 -->
                                    <th>Project</th>           <!-- col 1 -->
                                    <th>City</th>              <!-- col 2 -->
                                    <th>Sq.Ft</th>             <!-- col 3 -->
                                    <th>Contract $</th>        <!-- col 4 -->
                                    <th>Commission (%)</th>    <!-- col 5 (input) -->
                                    <th>Commission ($)</th>    <!-- col 6 (computed) -->
                                    <th># of Units</th>        <!-- col 7 -->
                                    <th>P-Vail Wage</th>       <!-- col 8 -->
                                    <th>Labor inHouse</th>     <!-- col 9 -->
                                    <th>Sub's</th>             <!-- col 10 -->
                                    <th>Material</th>          <!-- col 11 -->
                                    <th>Total Cost</th>        <!-- col 12 (computed) -->
                                    <th>Profit($)</th>         <!-- col 13 (computed) -->
                                    <th>Profit%</th>           <!-- col 14 (computed) -->
                                </tr>
                                </thead>
                                <tbody>
                                @php $colCount = 15; @endphp
                                @for ($i = 0; $i < $rowCount; $i++)
                                    <tr @if ($i === 0) class="fw-bold" @endif>
                                        <td class="text-center"><center>{{ $i + 1 }}.</center></td>
                                        @for ($j = 0; $j < $colCount; $j++)
                                            @php
                                                // Resolve cell value
                                                $cell = $leads->first(fn($lead) => $lead->row_index === $i && $lead->column_index === $j);
                                                $value = $cell?->value ?? '';

                                                // Fetch needed numeric inputs by index mapping above
                                                $contract = (float) ($leads->first(fn($l) => $l->row_index === $i && $l->column_index === 4)?->value ?? 0);
                                                $commissionRate = (float) ($leads->first(fn($l) => $l->row_index === $i && $l->column_index === 5)?->value ?? 0);
                                                $labor = (float) ($leads->first(fn($l) => $l->row_index === $i && $l->column_index === 9)?->value ?? 0);
                                                $subs = (float) ($leads->first(fn($l) => $l->row_index === $i && $l->column_index === 10)?->value ?? 0);
                                                $material = (float) ($leads->first(fn($l) => $l->row_index === $i && $l->column_index === 11)?->value ?? 0);

                                                $commission = ($contract * $commissionRate) / 100;
                                                $totalCost = $commission + $labor + $subs + $material;
                                                $profit = $contract - $totalCost;
                                                $profitPercent = $contract > 0 ? ($profit / $contract) * 100 : 0;

                                                $style = '';
                                                $readonly = '';

                                                // Computed columns: 6 (commission $), 12 (total cost), 13 (profit), 14 (profit %)
                                                if ($j === 6) {
                                                    $value = number_format($commission, 2);
                                                    $readonly = 'readonly';
                                                } elseif ($j === 12) {
                                                    $value = number_format($totalCost, 2);
                                                    $readonly = 'readonly';
                                                } elseif ($j === 13) {
                                                    $value = number_format($profit, 2);
                                                    $style = $profit >= 0 ? 'color: #16a34a !important;' : 'color: #dc2626 !important;';
                                                    $readonly = 'readonly';
                                                } elseif ($j === 14) {
                                                    $value = number_format($profitPercent, 2) . '%';
                                                    $style = $profitPercent >= 0 ? 'color: #16a34a !important;' : 'color: #dc2626 !important;';
                                                    $readonly = 'readonly';
                                                }
                                            @endphp
                                            <td style="padding:4px;">
                                                <input type="text"
                                                       class="form-control form-control-sm cell p-1"
                                                       data-row="{{ $i }}" data-col="{{ $j }}"
                                                       value="{{ $value }}" style="{{ $style }}" {{ $readonly }}>
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>

                        <script>
                            // ---- Helpers ----
                            const parseNum = (v) => {
                                if (v == null) return 0;
                                // remove commas and percent sign
                                const s = String(v).replace(/,/g, '').replace(/%/g, '').trim();
                                const n = parseFloat(s);
                                return isNaN(n) ? 0 : n;
                            };
                            const fmt2 = (n) => Number(n || 0).toFixed(2);

                            let rowCount = {{ $rowCount }}; // initial rows from backend
                            const COL = {
                                CONTRACT: 4,
                                COMM_RATE: 5,
                                COMM_VAL: 6,     // computed
                                UNITS: 7,
                                WAGE: 8,
                                LABOR: 9,
                                SUBS: 10,
                                MATERIAL: 11,
                                TOTAL: 12,       // computed
                                PROFIT: 13,      // computed
                                PROFIT_PCT: 14   // computed
                            };
                            const COMPUTED_COLS = new Set([COL.COMM_VAL, COL.TOTAL, COL.PROFIT, COL.PROFIT_PCT]);

                            function calculateRow(row) {
                                const get = (c) => parseNum($(`input[data-row='${row}'][data-col='${c}']`).val());

                                const contract = get(COL.CONTRACT);
                                const commissionRate = get(COL.COMM_RATE);
                                const commission = (contract * commissionRate) / 100;

                                const labor = get(COL.LABOR);
                                const subs = get(COL.SUBS);
                                const material = get(COL.MATERIAL);

                                const totalCost = commission + labor + subs + material;
                                const profit = contract - totalCost;
                                const profitPercent = contract > 0 ? (profit / contract) * 100 : 0;

                                // Write computed fields
                                $(`input[data-row='${row}'][data-col='${COL.COMM_VAL}']`).val(fmt2(commission));
                                $(`input[data-row='${row}'][data-col='${COL.TOTAL}']`).val(fmt2(totalCost));

                                const $profit = $(`input[data-row='${row}'][data-col='${COL.PROFIT}']`);
                                $profit.val(fmt2(profit))
                                    .removeClass('profit-positive profit-negative')
                                    .addClass(profit >= 0 ? 'profit-positive' : 'profit-negative');

                                const $pp = $(`input[data-row='${row}'][data-col='${COL.PROFIT_PCT}']`);
                                $pp.val(`${fmt2(profitPercent)}%`)
                                    .removeClass('profit-positive profit-negative')
                                    .addClass(profitPercent >= 0 ? 'profit-positive' : 'profit-negative');
                            }

                            // Add row (15 columns, keep computed cells readonly & prefilled)
                            $('#addRow').on('click', function() {
                                const newIndex = rowCount;
                                const $tr = $('<tr></tr>');
                                $tr.append(`<td class="text-center"><center>${newIndex + 1}.</center></td>`);

                                for (let j = 0; j < 15; j++) {
                                    const isComputed = COMPUTED_COLS.has(j);
                                    const initVal =
                                        j === COL.PROFIT_PCT ? '0.00%' :
                                            (isComputed ? '0.00' : '');
                                    $tr.append(`
        <td style="padding:4px;">
          <input type="text" class="form-control form-control-sm cell p-1"
                 data-row="${newIndex}" data-col="${j}"
                 value="${initVal}" ${isComputed ? 'readonly' : ''}>
        </td>
      `);
                                }
                                $('#featureTable tbody').append($tr);
                                calculateRow(newIndex); // initialize computed values
                                rowCount++;
                            });

                            // Debounce saver to avoid spamming server
                            const debounce = (fn, ms=300) => {
                                let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), ms); };
                            };
                            const saveCell = debounce((row, col, val) => {
                                $.ajax({
                                    url: "{{ route('profit.update') }}",
                                    type: 'POST',
                                    data: { _token: '{{ csrf_token() }}', row, column: col, value: val },
                                    success: (res) => console.log('Saved:', res)
                                });
                            }, 400);

                            // Input handler
                            $(document).on('input', '.cell', function() {
                                const row = $(this).data('row');
                                const col = $(this).data('col');

                                // Recalculate if any input affecting totals changes
                                if ([COL.CONTRACT, COL.COMM_RATE, COL.LABOR, COL.SUBS, COL.MATERIAL].includes(col)) {
                                    calculateRow(row);
                                }

                                // Do not persist computed columns
                                if (!COMPUTED_COLS.has(col)) {
                                    saveCell(row, col, $(this).val());
                                }
                            });

                            // Initial calculate for all rows rendered from backend
                            $(document).ready(function() {
                                for (let i = 0; i < {{ $rowCount }}; i++) {
                                    calculateRow(i);
                                }
                            });
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profit-positive {
            color: green !important;
        }

        .profit-negative {
            color: red !important;
        }
    </style>

    @include('modular.ai-profit-tracker')


</x-app-layout>
