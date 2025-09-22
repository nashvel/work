<x-app-layout>
    <x-slot name="title">Add Expensexxx</x-slot>
    <x-slot name="url_1">{"link": "/expense", "text": "Expense"}</x-slot>
    <x-slot name="active">Add Expensexxx</x-slot>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-8 xl:col-span-8">
            <div class="box shadow-none border custom-box">
                <div class="box-body p-5">
                    <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
                        <strong>Recent Expenses</strong>
                    </h6>
                    <span>You can modify and add the expenses here.</span>
                    <hr class="mb-3 !mt-3">
                    @if ($errors->any())
                        <div
                            class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                            <div>
                                <strong class="text-danger">Whoops! Something went wrong:</strong>
                                <ul class="list-disc list-inside mt-2 mx-4">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-dark"><i>{{ $error }}</i></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-span-4 xl:col-span-4">
            <div class="box shadow-none border custom-box">
                <div class="box-body p-5">
                    <form id="expense-form" method="POST" action="{{ route('pt.expense.store', $project ?? null) }}"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-4">
                            <label for="title" class="form-label">Title <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                    placeholder="e.g. Paint supplies" class="ti-form-input rounded-sm ps-11" required>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-type"></i>
                                </div>
                            </div>
                            @error('title')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-4">
                            <label for="category" class="form-label">Category <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" id="category" name="category" value="{{ old('category') }}"
                                    placeholder="e.g. Materials, Labor" class="ti-form-input rounded-sm ps-11" required>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-tags"></i>
                                </div>
                            </div>
                            @error('category')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Amount --}}
                        <div class="mb-4">
                            <label for="amount" class="form-label">Amount <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" step="0.01" id="amount" name="amount"
                                    value="{{ old('amount') }}" placeholder="0.00"
                                    class="ti-form-input rounded-sm ps-11" required>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                            </div>
                            @error('amount')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Expense Date --}}
                        <div class="mb-4">
                            <label for="expense_date" class="form-label">Expense Date <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" id="expense_date" name="expense_date"
                                    value="{{ old('expense_date') }}" class="ti-form-input rounded-sm ps-11" required>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none z-20">
                                    <i class="bi bi-calendar-date"></i>
                                </div>
                            </div>
                            @error('expense_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description (Rich Text via Quill) --}}
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <div id="editor" class="min-h-[140px] ti-form-input rounded-sm">
                            </div>
                            <textarea id="description" name="description" class="hidden">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Receipt (file) --}}
                        <div class="mb-4">
                            <label for="receipt" class="form-label">Receipt (PDF/JPG/PNG, max 2MB)</label>
                            <input type="file" id="receipt" name="receipt" accept=".pdf,.jpg,.jpeg,.png"
                                class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 file:border-0 file:bg-gray-200 file:me-4 file:py-2 file:px-4 dark:file:bg-black/20 dark:file:text-white/50">
                            @error('receipt')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="mb-4">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea id="notes" name="notes" rows="3" class="ti-form-input rounded-sm w-full"
                                placeholder="Optional notes...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="reset"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="bi bi-save"></i>
                                <span class="mx-1">Add Expenses</span>
                            </button>
                        </div>
                    </form>

                    {{-- Quill assets (include once on the page) --}}
                    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                    <script>
                        (function() {
                            const mount = document.getElementById('editor');
                            if (!mount || mount.dataset.quillInitialized === '1') return;
                            mount.dataset.quillInitialized = '1';

                            const hidden = document.getElementById('description');
                            const form = document.getElementById('expense-form');

                            const quill = new Quill('#editor', {
                                theme: 'snow',
                                modules: {
                                    toolbar: [
                                        ['bold', 'italic', 'underline', 'strike'],
                                        ['blockquote', 'code-block'],
                                        [{
                                            list: 'ordered'
                                        }, {
                                            list: 'bullet'
                                        }],
                                        [{
                                            header: [1, 2, 3, false]
                                        }],
                                        ['link', 'clean']
                                    ]
                                },
                                placeholder: 'Enter expense description...'
                            });

                            // preload saved HTML
                            quill.clipboard.dangerouslyPasteHTML((hidden?.value || '').trim());

                            // clean paste (drop font/size/color)
                            quill.clipboard.addMatcher(Node.ELEMENT_NODE, (node, delta) => {
                                delta.ops = (delta.ops || []).map(op => {
                                    if (op.attributes) {
                                        delete op.attributes.color;
                                        delete op.attributes.background;
                                        delete op.attributes.size;
                                        delete op.attributes.font;
                                    }
                                    return op;
                                });
                                return delta;
                            });

                            // keep hidden synced
                            const sync = () => {
                                hidden.value = quill.root.innerHTML;
                            };
                            quill.on('text-change', sync);
                            form?.addEventListener('submit', sync);
                        })();
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
