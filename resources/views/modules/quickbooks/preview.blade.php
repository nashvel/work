<x-app-layout>

    <x-slot name="return">{"link": "/relationship/list", "text": "Manage"}</x-slot>
    <x-slot name="title">Manage Relationships</x-slot>
    <x-slot name="url_1">{"link": "/relationship/list", "text": "Manage Relationship"}</x-slot>
    <x-slot name="active">Relationship</x-slot>
    <x-slot name="buttons">
        <a href="/relationship/list/register"
            class="ti-btn text-dark ti-btn-light shadow-none rounded-lg btn-wave me-0 waves-effect waves-light">
            <i class="bi bi-plus-circle me-1"></i>
            <span class="mx-1" style="font-weight: 400">Register New</span>
        </a>
    </x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
            <div class="box shadow-none border">
                <div class="box-body">
                    <i class="bi bi-info-circle px-1"></i>
                    <span>You can manage the relationship here.</span>
                    <hr class="my-3">
                    <h2 class="mb-4 text-lg font-semibold">Send Invoice to Customers (QuickBooks)</h2>
{{-- 
<form action="{{ route('invoices.sendBulk') }}" method="POST">
    @csrf

    <div class="table-responsive-n">
        <table id="clientTable" class="table table-sm min-w-full !border border-defaultborder dark:border-defaultborder/10">
            <thead>
                <tr class="border-b border-defaultborder dark:border-defaultborder/10" style="text-transform: uppercase">
                    <th class="text-start" style="width: 5px">
                        <input type="checkbox" class="form-check-input mx-3" id="selectAll">
                    </th>
                    <th class="text-start">Customer</th>
                    <th class="text-start">Email</th>
                    <th class="text-start">Amount</th>
                    <th class="text-start">Description</th>
                    <th class="text-start">Due Date</th>
                    <th class="text-start">CC</th>
                    <th class="text-start">Preview</th>
                    <th class="text-start" id="action_th">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    @php
                        $id = $customer->Id;
                        $email = $customer->PrimaryEmailAddr->Address ?? '';
                        $name = $customer->DisplayName ?? 'Unnamed';
                    @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="customers[]" value="{{ $id }}" class="form-check-input rowCheckbox mx-3">
                        </td>
                        <td class="text-start">{{ $name }}</td>
                        <td class="text-start">{{ $email }}</td>
                        <td class="text-start">
                            <input type="number" name="amounts[{{ $id }}]" class="form-control form-control-sm" step="0.01">
                        </td>
                        <td class="text-start">
                            <input type="text" name="descriptions[{{ $id }}]" class="form-control form-control-sm">
                        </td>
                        <td class="text-start">
                            <input type="date" name="due_dates[{{ $id }}]" class="form-control form-control-sm">
                        </td>
                        <td class="text-start">
                            <input type="email" name="ccs[{{ $id }}]" class="form-control form-control-sm" value="{{ $email }}">
                        </td>
                        <td class="text-start">
                            <button type="button" class="ti-btn ti-btn-sm ti-btn-soft-primary"
                                onclick="previewInvoice('{{ $name }}', '{{ $id }}')">
                                Preview
                            </button>
                        </td>
                        <td class="text-start">
                            <div class="hstack gap-1">
                                <a href="#" class="ti-btn ti-btn-sm ti-btn-soft-info bg-info/10">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="#" class="ti-btn ti-btn-sm ti-btn-soft-danger bg-danger/10">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="ti-btn bg-success text-white mt-4">Send Invoices</button>
</form>

<script>
    // Select all checkbox logic
    document.getElementById('selectAll').addEventListener('click', function () {
        document.querySelectorAll('.rowCheckbox').forEach(cb => cb.checked = this.checked);
    });

    function previewInvoice(name, id) {
        alert(`Preview invoice for ${name} (ID: ${id})`);
    }
</script>
<style>
    #action_th {
        width: 120px !important;
    }
</style> --}}



                    <br>
                    <br>
                    <br>

                    <form action="{{ route('invoices.sendBulk') }}" method="POST">
                        @csrf

                        <div class="overflow-auto">
                            <table class="ti-custom-table table table-bordered w-full text-sm">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th>CC</th>
                                        <th>Preview</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        @php
                                            $id = $customer->Id;
                                            $email = $customer->PrimaryEmailAddr->Address ?? '';
                                            $name = $customer->DisplayName ?? 'Unnamed';
                                        @endphp
                                        <tr>
                                            <td><input type="checkbox" name="customers[]" value="{{ $id }}">
                                            </td>
                                            <td>{{ $name }}</td>
                                            <td>{{ $email }}</td>
                                            <td>
                                                <input type="number" name="amounts[{{ $id }}]"
                                                    class="form-control" step="0.01">
                                            </td>
                                            <td>
                                                <input type="text" name="descriptions[{{ $id }}]"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="date" name="due_dates[{{ $id }}]"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="email" name="ccs[{{ $id }}]"
                                                    class="form-control" value="{{ $email }}">
                                            </td>
                                            <td>
                                                <button type="button" class="ti-btn ti-btn-sm ti-btn-soft-primary"
                                                    onclick="previewInvoice('{{ $name }}', '{{ $id }}')">
                                                    Preview
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="ti-btn bg-success text-white mt-4">Send Invoices</button>
                    </form>

                    <!-- Preview Modal -->
                    <div id="previewModal" class="hs-overlay hidden ti-modal" tabindex="-1" aria-hidden="true">
                        <div class="ti-modal-box max-w-xl">
                            <div class="ti-modal-header">
                                <h5 class="modal-title font-semibold">Invoice Preview</h5>
                                <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                                    data-hs-overlay="#previewModal">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="ti-modal-content space-y-3 p-4 text-sm">
                                <p><strong>Customer:</strong> <span id="previewCustomer"></span></p>
                                <p><strong>Amount:</strong> <span id="previewAmount"></span></p>
                                <p><strong>Description:</strong> <span id="previewDescription"></span></p>
                                <p><strong>Due Date:</strong> <span id="previewDueDate"></span></p>
                                <p><strong>CC Email:</strong> <span id="previewCC"></span></p>
                            </div>
                        </div>
                    </div>

                    <script>
                        function previewInvoice(name, id) {
                            document.getElementById('previewCustomer').textContent = name;
                            document.getElementById('previewAmount').textContent = document.querySelector(`[name="amounts[${id}]"]`).value;
                            document.getElementById('previewDescription').textContent = document.querySelector(
                                `[name="descriptions[${id}]"]`).value;
                            document.getElementById('previewDueDate').textContent = document.querySelector(`[name="due_dates[${id}]"]`)
                                .value;
                            document.getElementById('previewCC').textContent = document.querySelector(`[name="ccs[${id}]"]`).value;

                            const modal = document.getElementById('previewModal');
                            HSOverlay.open(modal); // assumes HSOverlay from Tailwind Integration or manually add `.show()` if Bootstrap
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
