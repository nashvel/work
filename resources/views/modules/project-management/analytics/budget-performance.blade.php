{{-- Budget Performance Chart --}}
<div class="box">
    <div class="box-header justify-between">
        <div class="box-title">
            Budget Performance Analysis
        </div>
        <div>
            <button type="button" class="ti-btn ti-btn-soft-primary text-xs px-2 py-[0.26rem]"><i class="ri-download-line align-middle inline-block"></i>Export</button>
        </div>
    </div>
    <div class="box-body">
        <div class="space-y-4">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">${{ number_format($budgetAnalysis['total_budget']) }}</div>
                    <div class="text-sm text-textmuted">Total Budget</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">${{ number_format($budgetAnalysis['spent_budget']) }}</div>
                    <div class="text-sm text-textmuted">Spent ({{ round(($budgetAnalysis['spent_budget'] / $budgetAnalysis['total_budget']) * 100) }}%)</div>
                </div>
                <div class="text-center p-4 bg-orange-50 rounded-lg">
                    <div class="text-2xl font-bold text-orange-600">${{ number_format($budgetAnalysis['remaining_budget']) }}</div>
                    <div class="text-sm text-textmuted">Remaining</div>
                </div>
            </div>
            <div id="budget-performance-chart" class="h-[250px]"></div>
        </div>
    </div>
</div>
