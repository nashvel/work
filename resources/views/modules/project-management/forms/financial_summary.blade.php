<!-- Header -->
<div class="pt-3 px-3">
    <h3 class="text-2xl leading-6 font-semibold text-gray-900">
        <strong>Financial Summary</strong>
    </h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-600">Comprehensive financial overview of the project.</p>
</div>

<div class="p-6 px-3">
    @php
        // ---- Base figures (wire to your actual data as needed) ----
        $incomeTotal = $project->budget ?? 0; // Contract amount
        $incomeCount = $project->incomes?->count() ?? 0;

        // ---- Load sheet cells (row/col/value) ----
        $clientId = auth()->id();
        $cells = App\Models\Sheets\PMSheetModel::where('user_id', $clientId)
            ->where('proj_id', $project->id)
            ->get(['row_index', 'column_index', 'value']);

        // Existing row indices only (avoid blank rows)
        $rowIndexes = $cells->pluck('row_index')->unique()->sort()->values();

        // Helper to get a cell
        $getCell = function ($r, $c) use ($cells) {
            return optional($cells->first(fn($x) => $x->row_index === $r && $x->column_index === $c))->value ?? '';
        };

        // Initial totals from sheet
        $initialGrandTotal = 0.0;
        $initialExpenseCount = 0;
        foreach ($rowIndexes as $r) {
            $amount = (float) str_replace([',', '%'], '', $getCell($r, 1));
            $qty = (float) str_replace([',', '%'], '', $getCell($r, 2));
            $rt = $amount * $qty;
            $initialGrandTotal += $rt;
            if ($amount != 0 || $qty != 0) {
                $initialExpenseCount++;
            }
        }

        $netProfit = $incomeTotal - $initialGrandTotal;
    @endphp

    <!-- Figures -->
    <div class="grid grid-cols-12 gap-6 mb-10">
        <div class="col-span-4 rounded-lg border border-green-200 p-6 px-3 bg-green-50">
            <h4 class="text-base font-semibold text-dark">Contract Amount</h4>
            <p class="mt-2 text-3xl font-bold text-success" id="topContractAmount">
                ${{ number_format($incomeTotal, 2) }} {{-- WITH commas --}}
            </p>
            <p class="text-sm text-success/90" id="topIncomeCount">
                If you want to adjust the contract amount, <a href="#" data-hs-overlay="#edit-contract-amount"
                    class="text-primary">Edit here</a>.
            </p>
        </div>

        <div class="col-span-4 rounded-lg border border-red-200 p-6 bg-red-50">
            <h4 class="text-base font-semibold text-dark">Total Expenses</h4>
            <p class="mt-2 text-3xl font-bold text-danger" id="topTotalExpenses">
                ${{ number_format($initialGrandTotal, 2) }} {{-- WITH commas --}}
            </p>
            <p class="text-sm text-red-700/90" id="topExpenseCount">
                {{ $initialExpenseCount }} transaction{{ $initialExpenseCount === 1 ? '' : 's' }}
            </p>
        </div>

        <div class="col-span-4 rounded-lg border border-blue-200 p-6 bg-blue-50">
            <h4 class="text-base font-semibold text-primary">Net Profit</h4>
            <p class="mt-2 text-3xl font-bold text-dark" id="topNetProfit">
                ${{ number_format($netProfit, 2) }} {{-- WITH commas --}}
            </p>
            <p class="text-sm" id="topNetProfitLabel">
                {{ $netProfit >= 0 ? 'Profit' : 'Loss' }}
            </p>
        </div>
    </div>

    <!-- Expenses by Category Table -->
    <div class="mt-5">


        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 mx-4 mt-4 float-start">Expenses by Category</h4>
            <button id="addExpenseRow"
                class="p-2 mb-3 mx-3 rounded-md text-dark bg-white !border btn-wave mt-3 ms-3 float-end">
                <i class="bi bi-plus-lg mx-2"></i>
                <span class="mx-2"> Add Expenses</span>
            </button>
            <div class="table-responsive shadow mt-3">
                <table id="expenseTable" class="min-w-full divide-y divide-gray-200" data-next-row="0">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left  text-xs font-semibold text-gray-700 uppercase">Category</th>
                            <th width="200"
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Amount</th>
                            <th width="120"
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Qty / Hrs
                            </th>
                            <th width="200"
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Total Amount
                            </th>
                            <th width="50"
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase w-16">Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200" id="expenseTbody">
                        @foreach ($rowIndexes as $r)
                            @php
                                $category = $getCell($r, 0);
                                $amount = (float) str_replace([',', '%'], '', $getCell($r, 1));
                                $qty = (float) str_replace([',', '%'], '', $getCell($r, 2));
                                $rowTotal = $amount * $qty;
                            @endphp
                            <tr class="expense-row" data-row="{{ $r }}">
                                <td>
                                    <div class="relative p-1">
                                        <input type="text"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark !focus:border-primary"
                                            data-row="{{ $r }}" data-field="category"
                                            value="{{ $category }}" placeholder="Enter Category here...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-info-circle"></i>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-right">
                                    <div class="relative p-1">
                                        <input type="text"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark text-end"
                                            data-row="{{ $r }}" data-field="amount"
                                            value="{{ number_format($amount, 2, '.', '') }}" placeholder="0.00">
                                        {{-- NO commas --}}
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-right">
                                    <div class="relative p-1">
                                        <input type="text"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark text-end"
                                            data-row="{{ $r }}" data-field="qty_hrs"
                                            value="{{ rtrim(rtrim(number_format($qty, 2, '.', ''), '0'), '.') }}"
                                            placeholder="0">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-right">
                                    <div class="relative p-1">
                                        <input type="text"
                                            class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark !focus:border-primary text-end"
                                            data-row="{{ $r }}" data-field="row_total"
                                            value="{{ number_format($rowTotal, 2) }}" readonly> {{-- WITH commas --}}
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                            <i class="bi bi-info-circle"></i>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center p-0">
                                    <button type="button" class="ti-btn ti-btn-sm ti-btn-danger delete-row"
                                        data-row="{{ $r }}" title="Delete row">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        <!-- Totals Row -->
                        <tr class="bg-gray-50" id="expenseTotalRow">
                            <td class="px-6 py-3 text-sm font-semibold text-gray-900">Total</td>
                            <td class="px-6 py-3 text-sm font-semibold text-right text-gray-900"></td>
                            <td class="px-3 text-sm font-semibold text-right text-gray-900" id="totalQtyHrs">0</td>
                            <td class="px-3 text-sm font-semibold text-right text-gray-900" id="grandTotalAmount">
                                ${{ number_format($initialGrandTotal, 2) }} {{-- WITH commas --}}
                            </td>
                            <td class="px-6 py-3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- ====== SCRIPTS ====== --}}
            <script>
                // ---------- Config ----------
                const csrf = '{{ csrf_token() }}';
                const projectId = {{ $project->id }};
                const FIELD_TO_COL = {
                    category: 0,
                    amount: 1,
                    qty_hrs: 2
                };

                // Live net profit base (raw number, no commas)
                const incomeTotal = {{ number_format($incomeTotal, 2, '.', '') }};

                // ---------- Helpers ----------
                const parseNum = (v) => {
                    if (v === null || v === undefined || v === '') return 0;
                    const s = String(v).replace(/,/g, '').replace(/%/g, '').trim();
                    const n = parseFloat(s);
                    return isNaN(n) ? 0 : n;
                };
                const fmt2 = (n) => Number(n || 0).toFixed(2);
                const displayMoney = (n) =>
                    (Number(isFinite(n) ? n : 0)).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                const debounce = (fn, ms = 350) => {
                    let t;
                    return (...a) => {
                        clearTimeout(t);
                        t = setTimeout(() => fn(...a), ms);
                    };
                };

                // Next smallest free index from DOM
                function nextFreeIndex() {
                    const used = new Set();
                    $("#expenseTable tbody tr.expense-row").each(function() {
                        const idx = Number($(this).data('row'));
                        if (!Number.isNaN(idx)) used.add(idx);
                    });
                    let i = 0;
                    while (used.has(i)) i++;
                    return i;
                }

                function setNextRowAttr() {
                    $("#expenseTable").attr("data-next-row", nextFreeIndex());
                }

                // ---------- Recalc ----------
                function recalcRow(rowIdx) {
                    const amount = parseNum($(`input[data-row='${rowIdx}'][data-field='amount']`).val());
                    const qty = parseNum($(`input[data-row='${rowIdx}'][data-field='qty_hrs']`).val());
                    const total = amount * qty;
                    // Row total WITH commas
                    $(`input[data-row='${rowIdx}'][data-field='row_total']`).val(displayMoney(total));
                }

                function recalcTableTotals() {
                    let grandTotal = 0,
                        totalQty = 0,
                        expenseRowCount = 0;

                    $("#expenseTable tbody tr.expense-row").each(function() {
                        const row = $(this).data('row');
                        const amount = parseNum($(`input[data-row='${row}'][data-field='amount']`).val());
                        const qty = parseNum($(`input[data-row='${row}'][data-field='qty_hrs']`).val());
                        const rt = amount * qty;

                        if (amount !== 0 || qty !== 0) expenseRowCount++;
                        grandTotal += rt;
                        totalQty += qty;
                    });

                    // Footer: WITH commas
                    $("#grandTotalAmount").text(`$${displayMoney(grandTotal)}`);
                    // Qty/Hrs: keep simple (no commas requirement), 2 decimals is fine
                    $("#totalQtyHrs").text(fmt2(totalQty).replace(/\.00$/, ''));

                    // Top cards: WITH commas
                    $("#topTotalExpenses").text(`$${displayMoney(grandTotal)}`);
                    $("#topExpenseCount").text(`${expenseRowCount} transaction${expenseRowCount === 1 ? '' : 's'}`);

                    const net = incomeTotal - grandTotal;
                    $("#topNetProfit").text(`$${displayMoney(net)}`)
                        .toggleClass('text-green-700', net >= 0)
                        .toggleClass('text-red-700', net < 0);
                    $("#topNetProfitLabel").text(net >= 0 ? 'Profit' : 'Loss')
                        .toggleClass('text-green-700/90', net >= 0)
                        .toggleClass('text-red-700/90', net < 0);
                }

                function recalcAll() {
                    $("#expenseTable tbody tr.expense-row").each(function() {
                        recalcRow($(this).data('row'));
                    });
                    recalcTableTotals();
                    setNextRowAttr();
                }

                // ---------- Autosave ----------
                const saveCell = debounce((row, field, shownValue) => {
                    if (!(field in FIELD_TO_COL)) return;
                    let value = shownValue;
                    // Ensure numeric fields save RAW number (no commas)
                    if (field === 'amount' || field === 'qty_hrs') value = String(parseNum(shownValue));
                    $.ajax({
                        url: "{{ route('sheet.pms') }}",
                        method: "POST",
                        data: {
                            _token: csrf,
                            project_id: projectId,
                            row,
                            column: FIELD_TO_COL[field],
                            value
                        },
                        success: res => console.log('Saved:', res),
                        error: xhr => console.error('Save failed:', xhr?.responseJSON || xhr)
                    });
                }, 400);

                // ---------- Delete ----------
                function deleteRowOnServer(rowIdx) {
                    return $.ajax({
                        url: "{{ route('sheet.pms.rowDelete') }}",
                        method: "POST",
                        data: {
                            _token: csrf,
                            project_id: projectId,
                            row: rowIdx
                        },
                    });
                }

                // ---------- Events ----------
                // Amount typing: NO commas, force 2 decimals
                $(document).on("input", "input[data-field='amount']", function() {
                    const $el = $(this);
                    const raw = parseNum($el.val());
                    $el.val(fmt2(raw)); // e.g., 1234.50 (no commas)
                });

                // Any cell change
                $(document).on("input", "#expenseTable .cell", function() {
                    const row = $(this).data('row');
                    const field = $(this).data('field');
                    const shown = $(this).val();

                    if (field === 'amount' || field === 'qty_hrs') recalcRow(row);
                    recalcTableTotals();
                    saveCell(row, field, shown);
                });

                // Add Row (fills smallest free index, uses your UI markup)
                $("#addExpenseRow").on("click", function() {
                    const i = nextFreeIndex();

                    const $tr = $(`
            <tr class="expense-row" data-row="${i}">
              <td>
                <div class="relative p-1">
                  <input type="text"
                    class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark !focus:border-primary"
                    data-row="${i}" data-field="category" value="" placeholder="Enter Category here...">
                  <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-info-circle"></i>
                  </div>
                </div>
              </td>

              <td class="text-right">
                <div class="relative p-1">
                  <input type="text"
                    class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark text-end"
                    data-row="${i}" data-field="amount" value="0.00" placeholder="0.00"> <!-- NO commas -->
                  <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                </div>
              </td>

              <td class="text-right">
                <div class="relative p-1">
                  <input type="text"
                    class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark text-end"
                    data-row="${i}" data-field="qty_hrs" value="0" placeholder="0">
                  <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-x"></i>
                  </div>
                </div>
              </td>

              <td class="text-right">
                <div class="relative p-1">
                  <input type="text"
                    class="ti-form-input rounded-sm ps-11 focus:z-10 cell text-dark !focus:border-primary text-end"
                    data-row="${i}" data-field="row_total" value="0.00" readonly> <!-- WITH commas on recalc -->
                  <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <i class="bi bi-info-circle"></i>
                  </div>
                </div>
              </td>

              <td class="text-center p-0">
                <button type="button" class="ti-btn ti-btn-sm ti-btn-danger delete-row"
                  data-row="${i}" title="Delete row">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          `);

                    $("#expenseTotalRow").before($tr);
                    recalcAll(); // recompute row + totals + top cards
                    setNextRowAttr(); // keep data-next-row updated
                });

                // Delete row
                $(document).on("click", ".delete-row", function() {
                    const rowIdx = $(this).data('row');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteRowOnServer(rowIdx)
                                .done(() => {
                                    $(`#expenseTable tr.expense-row[data-row='${rowIdx}']`).remove();
                                    recalcAll();
                                })
                                .fail(xhr => {
                                    console.error('Delete failed:', xhr?.responseJSON || xhr);
                                    alert('Failed to delete row.');
                                });

                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        }
                    });

                });

                // Init
                $(document).ready(() => recalcAll());
            </script>
        </div>
    </div>
</div>


@include('modules.project-management.partials.adjust-contract-amount')
