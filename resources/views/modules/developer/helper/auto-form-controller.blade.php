<?php
/**
 * Auto-generate controller code from the same $form config used by auto-form.
 * Paste this after your $form array and the @include('components.auto-form', ['form'=>$form])
 */

$form = $form ?? [];

// 1) Build $rules from fields
$rules = [];
$fileFields = []; // names of file inputs, e.g., ['receipt', 'avatar']
$dateFields = []; // names of date inputs, e.g., ['expense_date']

foreach (($form['fields'] ?? []) as $f) {
    $name = $f['name'] ?? null;
    $type = $f['type'] ?? 'text';
    $req  = !empty($f['required']);

    if (!$name) continue;

    if ($type === 'date') {
        $dateFields[] = $name;
    }

    $fieldRules = [];
    $fieldRules[] = $req ? 'required' : 'nullable';

    switch ($type) {
        case 'text':
        case 'textarea':
        case 'richtext':
            $fieldRules[] = 'string';
            if (!empty($f['max'])) {
                $fieldRules[] = 'max:'.$f['max'];
            }
            break;

        case 'number':
            $fieldRules[] = 'numeric';
            if (isset($f['min'])) $fieldRules[] = 'min:'.$f['min'];
            if (isset($f['max'])) $fieldRules[] = 'max:'.$f['max'];
            break;

        case 'date':
            $fieldRules[] = 'date';
            break;

        case 'file':
            // Parse accept list e.g. ".pdf,.jpg,.jpeg,.png" -> mimes:pdf,jpg,jpeg,png
            $accept = $f['accept'] ?? '';
            preg_match_all('/\.([a-z0-9]+)/i', $accept, $m);
            if (!empty($m[1])) {
                $fieldRules[] = 'mimes:'.implode(',', $m[1]);
            }
            // default size if none provided
            $fieldRules[] = 'max:'.($f['max'] ?? 2048);
            $fieldRules[] = 'file';
            $fileFields[] = $name;
            break;

        case 'select':
        case 'radio':
        case 'checkbox':
            // keep generic; customize with 'in:...' via config if needed
            break;
    }

    $rules[$name] = $fieldRules;
}

// 2) Controller class name based on form id (e.g., "expense-form" -> "ExpenseFormController")
$baseName = \Illuminate\Support\Str::studly(\Illuminate\Support\Str::before($form['id'] ?? 'auto-form', '-'));
$controllerClassName = $baseName . 'Controller';

// 3) Pretty PHP array for rules (valid PHP, not JSON)
$rulesPhp = var_export($rules, true);

// 4) Build date normalization segment
$dateNormalizePhp = '';
if (!empty($dateFields)) {
    $dateNormalizePhp .= "\n        // Normalize date fields to YYYY-MM-DD\n";
    foreach ($dateFields as $df) {
        $dateNormalizePhp .= "        if (!empty(\$validated['{$df}'])) {\n";
        $dateNormalizePhp .= "            \$validated['{$df}'] = \\Carbon\\Carbon::parse(\$validated['{$df}'])->toDateString();\n";
        $dateNormalizePhp .= "        }\n";
    }
    $dateNormalizePhp .= "\n";
}

// 5) Build file handling segment for ALL file fields
$fileHandlerPhp = '';
if (!empty($fileFields)) {
    $list = implode("','", array_map(fn($n) => addslashes($n), $fileFields));
    $fileHandlerPhp = <<<PHP
        // Handle uploaded files (all file-type fields)
        foreach (['{$list}'] as \$field) {
            if (\$request->hasFile(\$field)) {
                \$file = \$request->file(\$field);
                if (!\$file->isValid()) {
                    return back()->withErrors([\$field => 'Uploaded file is invalid.'])->withInput();
                }

                \$ext  = strtolower(\$file->getClientOriginalExtension());
                \$base = pathinfo(\$file->getClientOriginalName(), PATHINFO_FILENAME);
                \$safe = \\Illuminate\\Support\\Str::slug(\$base);
                \$name = \$safe . '-' . \\Illuminate\\Support\\Str::random(6) . '.' . \$ext;

                // Store to public disk; adjust folder as needed
                \$path = \$file->storeAs('uploads', \$name, 'public');

                // Persist metadata back into validated payload
                \$validated[\$field . '_path']           = \$path;
                \$validated[\$field . '_original_name']  = \$file->getClientOriginalName();
                \$validated[\$field . '_mime']           = \$file->getClientMimeType();
                \$validated[\$field . '_size']           = \$file->getSize();
            }
        }

PHP;
}

// 6) Optional: Route name for redirect success (derive from action or default)
$redirectRoute = 'home';
if (!empty($form['action']) && is_string($form['action'])) {
    // try to sniff a name-like string; otherwise keep 'home'
    $redirectRoute = 'home';
}

// 7) Compose final controller text
$controllerText  = "<?php\n\n";
$controllerText .= "namespace App\\Http\\Controllers;\n\n";
$controllerText .= "use Illuminate\\Http\\Request;\n";
$controllerText .= "use Illuminate\\Support\\Facades\\Storage;\n";
$controllerText .= "use Illuminate\\Support\\Str;\n";
$controllerText .= "use Carbon\\Carbon;\n\n";
$controllerText .= "class {$controllerClassName} extends Controller\n";
$controllerText .= "{\n";
$controllerText .= "    /**\n";
$controllerText .= "     * Auto-generated from Blade \$form config.\n";
$controllerText .= "     */\n";
$controllerText .= "    public function store(Request \$request)\n";
$controllerText .= "    {\n";
$controllerText .= "        // Validation rules derived from your auto-form config\n";
$controllerText .= "        \$validated = \$request->validate(" . $rulesPhp . ");\n\n";
$controllerText .= $dateNormalizePhp;
$controllerText .= $fileHandlerPhp;
$controllerText .= "        // TODO: persist model, e.g. Expense::create(\$validated);\n\n";
$controllerText .= "        return redirect()->back()->with('success', 'Saved successfully.');\n";
$controllerText .= "    }\n";
$controllerText .= "}\n";
?>

<pre class="text-xs leading-5 whitespace-pre overflow-auto p-3 rounded border bg-gray-50">{{ $controllerText }}</pre>
