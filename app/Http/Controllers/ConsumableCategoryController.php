<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumableCategory;

class ConsumableCategoryController extends Controller
{
    public function index()
    {
        $categories = ConsumableCategory::paginate(); // 10 tampilakan semua data 
        return view('consumable_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('consumable_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ConsumableCategory::create($request->all());
        return redirect()->route('consumable_categories.index')
            ->with('toast_message', 'Category created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit(ConsumableCategory $consumableCategory)
    {
        return view('consumable_categories.edit', compact('consumableCategory'));
    }

    public function update(Request $request, ConsumableCategory $consumableCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $consumableCategory->update($request->all());
        return redirect()->route('consumable_categories.index')
            ->with('toast_message', 'Category updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy(ConsumableCategory $consumableCategory)
    {
        $consumableCategory->delete();
        return redirect()->route('consumable_categories.index')
            ->with('toast_message', 'Category deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
