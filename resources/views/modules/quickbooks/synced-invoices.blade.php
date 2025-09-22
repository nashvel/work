<x-app-layout>
    <x-slot name="title">QuickBooks Invoices</x-slot>

    <div class="mb-4">
        <a href="{{ route('quickbooks.syncInvoices') }}" class="ti-btn bg-primary text-white">
            <i class="bi bi-arrow-repeat"></i> Sync from QuickBooks
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-2">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger mb-2">{{ session('error') }}</div>
    @endif

    <div class="box">
        <div class="box-header">Synced Invoices</div>
        <div class="box-body overflow-auto">
            <table class="table table-bordered text-sm w-full">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Customer ID</th>
                        {{-- <th>Customer Name</th> --}}
                        <th>Total</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Txn Date</th>
                        <th>Due Date</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $inv)
                        @php
                            $customerId = is_object($inv->CustomerRef)
                                ? $inv->CustomerRef->value ?? '-'
                                : $inv->CustomerRef ?? '-';
                            $customerName = is_object($inv->CustomerRef)
                                ? $inv->CustomerRef->name ?? 'Unnamed'
                                : 'Unnamed';
                            $status = $inv->Balance > 0 ? 'Unpaid' : 'Paid';
                        @endphp

                        <tr>
                            <td>{{ $inv->DocNumber ?? '-' }}</td>
                             <td>{{ $customerId }}</td>
                            {{--<td>{{ $customerName }}</td> --}}
                            <td>${{ number_format($inv->TotalAmt ?? 0, 2) }}</td>
                            <td>${{ number_format($inv->Balance ?? 0, 2) }}</td>
                            <td>
                                <span class="badge {{ $status === 'Paid' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td>{{ $inv->TxnDate ?? '-' }}</td>
                            <td>{{ $inv->DueDate ?? '-' }}</td>
                            <td>{{ $inv->PrivateNote ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No synced invoices yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
