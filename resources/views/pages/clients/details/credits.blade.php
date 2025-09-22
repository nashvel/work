@php
    $credit_total = App\Models\Credit::where('client_id', $id)
        ->where('client_type', 'client')
        ->where('type', 'add')
        ->sum('amount');
    $credit_charge = App\Models\Credit::where('client_id', $id)
        ->where('client_type', 'client')
        ->where('type', 'charge')
        ->sum('amount');

    $remaining_credit = $credit_total - $credit_charge;
    $percentage = $credit_total > 0 ? ($remaining_credit / $credit_total) * 100 : 0;

    $progressClass = 'bg-success'; // Default
    $progressClassText = 'text-success'; // Default

    if ($percentage < 20) {
        $progressClass = 'bg-danger';
        $progressClassText = 'text-danger';
    } elseif ($percentage >= 20 && $percentage <= 60) {
        $progressClass = 'bg-primary';
        $progressClassText = 'text-primary';
    }
@endphp

<div class="sm:col-span-6 xl:col-span-6 col-span-12">
    <div class="box overflow-hidden main-content-card">
        <div class="box-body">
            <div class="flex items-start justify-between ">
                <div>
                    <span class="text-textmuted dark:text-textmuted/50 block mb-1">Total
                        Credit</span>
                    <h4 class="font-medium mb-0">{{ number_format($remaining_credit, 0) }} /
                        <b>{{ number_format($credit_total, 0) }}</b> hours
                    </h4>
                </div>

            </div>
            <div class="text-textmuted dark:text-textmuted/50 text-[13px]">Remaining Credit
                <span class="{{ $progressClassText }}">{{ number_format($percentage, 0) }}%</span>
            </div>
            <div class="progress progress-lg !rounded-full p-1 ms-auto bg-primary/10 mb-2 mt-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $progressClass }}"
                    role="progressbar" style="width: {{ number_format($percentage, 0) }}%;" aria-valuenow="50"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
