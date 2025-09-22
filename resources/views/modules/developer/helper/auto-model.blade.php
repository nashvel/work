<div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
    <div class="vscode-editor">
        <!-- Fake VSCode top bar -->
        <div class="vscode-bar">
            <div class="traffic-lights">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
            </div>
            <div class="filename">auto-form.php</div>
        </div>

        <!-- Code -->
        <pre><code class="language-php">
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
    </code></pre>
    </div>
</div>

<!-- PrismJS (syntax highlighting like VSCode) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>

<style>
    .vscode-editor {
        background: #1e1e1e;
        border-radius: 6px;
        overflow: hidden;
        font-family: 'Fira Code', monospace;
        font-size: 13px;
        color: #d4d4d4;
    }

    .vscode-bar {
        background: #333;
        padding: 6px 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .traffic-lights {
        display: flex;
        gap: 6px;
    }

    .traffic-lights .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
    }

    .traffic-lights .red {
        background: #ff5f56;
    }

    .traffic-lights .yellow {
        background: #ffbd2e;
    }

    .traffic-lights .green {
        background: #27c93f;
    }

    .filename {
        font-size: 12px;
        color: #ccc;
    }

    pre {
        margin: 0;
        padding: 12px 16px;
        overflow-x: auto;
    }
</style>
