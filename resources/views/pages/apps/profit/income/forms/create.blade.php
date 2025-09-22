<x-app-layout>
    <x-slot name="title">Add Income</x-slot>
    <x-slot name="url_1">{"link": "/income", "text": "Income"}</x-slot>
    <x-slot name="active">Add Income</x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xl:col-span-12">
            <div class="box">
                <div class="box-body p-5">
                    <form method="POST" action="{{ route('pt.income.store') }}">
                        @csrf
                        @php
                            $projects = [];
                        @endphp
                        <!-- Project -->
                        <div class="mb-4">
                            <label for="project_id" class="form-label">Project <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="project_id" id="project_id" class="ti-form-input rounded-sm ps-11"
                                    required>
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-kanban"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Source -->
                        <div class="mb-4">
                            <label for="source" class="form-label">Source <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" name="source" id="source" placeholder="e.g. Client Payment"
                                    class="ti-form-input rounded-sm ps-11" required>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <label for="amount" class="form-label">Amount <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" step="0.01" name="amount" id="amount" placeholder="0.00"
                                    class="ti-form-input rounded-sm ps-11" required>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Received Date -->
                        <div class="mb-4">
                            <label for="received_date" class="form-label">Received Date</label>
                            <div class="relative">
                                <input type="date" name="received_date" id="received_date"
                                    class="ti-form-input rounded-sm ps-11" required>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-calendar-date"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="ti-form-input rounded-sm w-full"></textarea>
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="reset"
                                class="bg-gray-200 text-dark px-4 py-2 rounded hover:bg-gray-300">Cancel</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                <i class="bi bi-check-circle"></i> Save Income
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
