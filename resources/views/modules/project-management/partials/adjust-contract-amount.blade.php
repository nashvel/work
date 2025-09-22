
<div id="edit-contract-amount" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="ti-modal-content w-full">
            <div class="ti-modal-header">
                <h6 class="modal-title text-[1rem] font-semibold">Contract Amount</h6>
                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                    data-hs-overlay="#edit-contract-amount">
                    <span class="sr-only">Close</span>
                    <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                            fill="currentColor" />
                    </svg>
                </button>
            </div>

            <div class="ti-modal-body">
                <div class="container-fluid">
                    <form id="contractAmountForm">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="relative p-1">
                            <input id="contractAmountInput" name="amount" type="text" inputmode="decimal"
                                value="{{ number_format($incomeTotal, 2, '.', '') }}"
                                class="ti-form-input rounded-sm ps-11 focus:z-10 text-dark text-end font-bold"
                                style="font-size: 28px !important;" placeholder="0.00" autocomplete="off">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                <i class="bi bi-currency-dollar text-dark" style="font-size: 28px !important;"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="ti-modal-footer">
                <button id="saveContractBtn" type="button"
                    class="ti-btn btn-wave ti-btn-info bg-blue-600 rounded-lg">
                    <span class="bi bi-save mx-1"></span>
                    Save changes
                </button>
                <button type="button"
                    class="hs-dropdown-toggle ti-btn btn-wave ti-btn-default bg-gray-100 rounded-lg text-danger"
                    data-hs-overlay="#edit-contract-amount">
                    <span class="bi bi-x-lg mx-1"></span>
                    Discard
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        const csrf = '{{ csrf_token() }}';
        const projectId = {{ $project->id }};
        const updateUrl = "{{ route('sheet.pms.contract', $project->id) }}";

        // Local helpers (avoid naming clashes)
        const parseNumB = (v) => {
            if (v === null || v === undefined || v === '') return 0;
            const s = String(v).replace(/[^0-9.\-]/g, '').trim();
            const n = parseFloat(s);
            return isNaN(n) ? 0 : n;
        };
        const fmt2B = (n) => Number(n || 0).toFixed(2);
        const displayMoneyB = (n) =>
            (Number(isFinite(n) ? n : 0)).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

        // Prefill modal from current card when opened
        document.addEventListener('click', (e) => {
            const tgt = e.target.closest('[data-hs-overlay="#edit-contract-amount"]');
            if (!tgt) return;
            const current = document.getElementById('topContractAmount')?.textContent || '';
            const raw = parseNumB(current);
            const input = document.getElementById('contractAmountInput');
            if (input) input.value = fmt2B(raw);
        });

        // Keep input at 2 decimals (no commas) while typing
        document.addEventListener('input', (e) => {
            if (e.target && e.target.id === 'contractAmountInput') {
                const raw = parseNumB(e.target.value);
                e.target.value = fmt2B(raw);
            }
        });

        // Save via AJAX
        document.getElementById('saveContractBtn')?.addEventListener('click', () => {
            const input = document.getElementById('contractAmountInput');
            const amount = parseNumB(input?.value || '0');

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to save the changes?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Save it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                amount,
                                project_id: projectId
                            })
                        })
                        .then(async (r) => {
                            if (!r.ok) throw await r.json().catch(() => ({
                                message: 'Save failed'
                            }));
                            return r.json();
                        })
                        .then((res) => {
                            const newAmount = parseNumB(res.contract_amount ?? amount);

                            // Update Contract Amount card (WITH commas)
                            const $contract = document.getElementById('topContractAmount');
                            if ($contract) $contract.textContent =
                                `$${displayMoneyB(newAmount)}`;

                            // Recompute Net Profit against current Total Expenses shown on page
                            const $expenses = document.getElementById('grandTotalAmount');
                            const expRaw = parseNumB($expenses ? $expenses.textContent : '0');
                            const net = newAmount - expRaw;

                            const $net = document.getElementById('topNetProfit');
                            const $netLbl = document.getElementById('topNetProfitLabel');
                            if ($net) {
                                $net.textContent = `$${displayMoneyB(net)}`;
                                $net.classList.toggle('text-green-700', net >= 0);
                                $net.classList.toggle('text-red-700', net < 0);
                            }
                            if ($netLbl) {
                                $netLbl.textContent = net >= 0 ? 'Profit' : 'Loss';
                                $netLbl.classList.toggle('text-green-700/90', net >= 0);
                                $netLbl.classList.toggle('text-red-700/90', net < 0);
                            }

                            // Close modal
                            document.querySelector('#edit-contract-amount .ti-modal-close-btn')
                                ?.click();
                        })
                        .catch((err) => {
                            console.error('Budget save error:', err);
                            alert(err?.message || 'Failed to save contract amount.');
                        });
                }
            });


        });
    })();
</script>