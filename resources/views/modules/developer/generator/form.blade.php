@php
    $form = [
        'id' => 'expense-form',
        'action' => route('pt.expense.store', $project ?? null),
        'method' => 'POST',
        'layout' => [
            'gap' => 4, // gap-4
            'class' => 'mt-2', // extra classes
        ],
        'fields' => [
            [
                'type' => 'text',
                'name' => 'title',
                'label' => 'Title',
                'icon' => 'bi bi-type',
                'placeholder' => 'e.g. Paint supplies',
                'required' => true,
                'col' => 12,
                'col_md' => 6,
            ],
            [
                'type' => 'text',
                'name' => 'category',
                'label' => 'Category',
                'icon' => 'bi bi-tags',
                'placeholder' => 'e.g. Materials, Labor',
                'required' => true,
                'col' => 12,
                'col_md' => 6,
            ],
            [
                'type' => 'number',
                'name' => 'amount',
                'label' => 'Amount',
                'icon' => 'bi bi-wallet2',
                'placeholder' => '0.00',
                'step' => '0.01',
                'required' => true,
                'col' => 12,
                'col_md' => 6,
            ],
            [
                'type' => 'date',
                'name' => 'expense_date',
                'label' => 'Expense Date',
                'icon' => 'bi bi-calendar-date',
                'required' => true,
                'col' => 12,
                'col_md' => 6,
            ],
            [
                'type' => 'file',
                'name' => 'receipt',
                'label' => 'Receipt (PDF/JPG/PNG, max 2MB)',
                'accept' => '.pdf,.jpg,.jpeg,.png',
                'col' => 12,
                'col_md' => 12,
            ],
            [
                'type' => 'richtext',
                'name' => 'description',
                'label' => 'Description',
                'placeholder' => 'Enter expense description...',
                'col' => 12,
            ],
            [
                'type' => 'textarea',
                'name' => 'notes',
                'label' => 'Notes',
                'placeholder' => 'Optional notes...',
                'rows' => 3,
                'col' => 12,
                'col_md' => 12,
                'col_lg' => 12,
            ],
        ],
        'buttons' => [
            [
                'type' => 'reset',
                'label' => 'Cancel',
                'class' =>
                    'px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500',
            ],
            [
                'type' => 'submit',
                'label' => 'Add Expenses',
                'icon' => 'bi bi-save',
                'class' =>
                    'px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500',
            ],
        ],
    ];
@endphp


<div class="sm:flex bg-gray-100 hover:bg-gray-200 rounded-sm transition p-1 dark:bg-black/20 dark:hover:bg-black/20">
    <nav class="sm:flex sm:space-x-2 sm:rtl:space-x-reverse" role="tablist">
        <a class="w-full sm:w-auto hs-tab-active:bg-white hs-tab-active:text-gray-700 dark:hs-tab-active:bg-light dark:hs-tab-active:text-defaulttextcolor/70 py-2 px-3 inline-flex items-center gap-2 bg-transparent text-sm text-defaulttextcolor hover:text-gray-700 font-medium rounded-sm hover:hover:text-primary dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white active"
            href="javascript:void(0);" id="segment-item-1" data-hs-tab="#segment-1" aria-controls="segment-1">
            <i class="bi bi-rocket-takeoff"></i>
            Generated Form
        </a>
        <a class="w-full sm:w-auto hs-tab-active:bg-white hs-tab-active:text-gray-700 dark:hs-tab-active:bg-light dark:hs-tab-active:text-defaulttextcolor/70 py-2 px-3 inline-flex items-center gap-2 bg-transparent text-sm text-defaulttextcolor hover:text-gray-700 font-medium rounded-sm hover:hover:text-primary dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white"
            href="javascript:void(0);" id="segment-item-2" data-hs-tab="#segment-2" aria-controls="segment-2">
            <i class="bi bi-robot"></i>
            Controller
        </a>
        <a class="w-full sm:w-auto hs-tab-active:bg-white hs-tab-active:text-gray-700 dark:hs-tab-active:bg-light dark:hs-tab-active:text-defaulttextcolor/70 py-2 px-3 inline-flex items-center gap-2 bg-transparent text-sm text-defaulttextcolor hover:text-gray-700 font-medium rounded-sm hover:hover:text-primary dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white"
            href="javascript:void(0);" id="segment-item-3" data-hs-tab="#segment-3" aria-controls="segment-3">
            <i class="bi bi-shield-lock"></i>
            Model
        </a>
    </nav>
</div>

<div class="mt-3">
    <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
        <div class="border p-3">
            @include('modules.developer.helper.auto-form', ['form' => $form])
        </div>
    </div>
    <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
        <div class="border p-3">
            -
        </div>
    </div>
    <div id="segment-3" class="hidden" role="tabpanel" aria-labelledby="segment-item-3">
        <div class="border p-3">
            -
        </div>
    </div>
</div>



{{-- This will generate controller code based on above form --}}
{{-- @include('modules.developer.helper.auto-form-controller',['form'=>$form]) --}}
