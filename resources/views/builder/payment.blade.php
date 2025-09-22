<x-app-layout>

    <x-slot name="title">Register New Bidding</x-slot>
    <x-slot name="url_1">{"link": "/bid/list", "text": "Manage"}</x-slot>
    <x-slot name="url_2">{"link": "/bid/list", "text": "Bidding"}</x-slot>
    <x-slot name="active">New Bidding</x-slot>
    <x-slot name="buttons">
        <a href="/project/list/register" class="ti-btn text-white !border-0 btn-wave me-0"
            style="background-color: #2563eb">
            <i class="bi bi-plus-lg me-1"></i>
            <span class="mx-1" style="font-weight: 400">Register Project</span>
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-x-5">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-body overflow-y-auto">
                        <form id="payment-form">
                            @csrf
                            <label>Customer ID:</label>
                            <input type="text" name="customer_id" required>
                            <br>

                            <label>Amount:</label>
                            <input type="number" step="0.01" name="amount" required>
                            <br>

                            <label>Invoice Txn ID (optional):</label>
                            <input type="text" name="invoice_txn_id">
                            <br>

                            <button type="submit">Create Payment</button>
                        </form>

                        <div id="result"></div>

                        <script>
                            document.getElementById('payment-form').addEventListener('submit', async function(e) {
                                e.preventDefault();

                                const form = e.target;
                                const formData = new FormData(form);
                                const data = Object.fromEntries(formData.entries());

                                document.getElementById('result').textContent = 'Processing payment...';

                                try {
                                    const response = await fetch("{{ route('quickbooks.createPayment') }}", {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify(data),
                                    });

                                    const result = await response.json();

                                    if (response.ok) {
                                        document.getElementById('result').textContent = 'Payment successful! ID: ' + result.payment
                                            .Id;
                                    } else {
                                        document.getElementById('result').textContent = 'Error: ' + (result.error ||
                                            'Unknown error');
                                    }
                                } catch (err) {
                                    document.getElementById('result').textContent = 'Request failed: ' + err.message;
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
