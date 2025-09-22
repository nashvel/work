<x-app-layout>
    <x-slot name="title">Invoices List</x-slot>

    <div class="box">
        <div class="box-header">Invoices from QuickBooks</div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Total</th>
                        <th>Balance</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $inv)
                        <tr>
                            <td>{{ $inv->DocNumber }}</td>
                            <td>${{ number_format($inv->TotalAmt, 2) }}</td>
                            <td>${{ number_format($inv->Balance, 2) }}</td>
                            <td>{{ $inv->DueDate ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
