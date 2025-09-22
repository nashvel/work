<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index(Project $project)
    {
        $incomes = $project->incomes()->with('creator')->latest()->paginate(10);
        return view('incomes.index', compact('project', 'incomes'));
    }

    public function create(Project $project)
    {
        return view('incomes.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'income_date' => 'required|date',
            'status' => 'required|in:pending,received,cancelled',
            'notes' => 'nullable|string',
        ]);

        $validated['project_id'] = $project->id;
        $validated['created_by'] = Auth::id();

        Income::create($validated);

        return redirect()->route('projects.incomes.index', $project)
                        ->with('success', 'Income created successfully.');
    }

    public function edit(Project $project, Income $income)
    {
        return view('incomes.edit', compact('project', 'income'));
    }

    public function update(Request $request, Project $project, Income $income)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'income_date' => 'required|date',
            'status' => 'required|in:pending,received,cancelled',
            'notes' => 'nullable|string',
        ]);

        $income->update($validated);

        return redirect()->route('projects.incomes.index', $project)
                        ->with('success', 'Income updated successfully.');
    }

    public function destroy(Project $project, Income $income)
    {
        $income->delete();

        return redirect()->route('projects.incomes.index', $project)
                        ->with('success', 'Income deleted successfully.');
    }

    public function updateStatus(Request $request, Income $income)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,received,cancelled'
        ]);

        $income->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Income status updated successfully.',
            'income' => $income->load('creator')
        ]);
    }
}