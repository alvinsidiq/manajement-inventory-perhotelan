<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryCategory;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        $categories = InventoryCategory::all();
        return view('inventory_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('inventory_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:inventory_categories|max:255',
            'description' => 'nullable|string',
        ]);

        InventoryCategory::create($request->all());

        return redirect()->route('inventory_categories.index')
            ->with('toast_message', 'Category created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit($id)
    {
        $category = InventoryCategory::findOrFail($id);
        return view('inventory_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|max:255|unique:inventory_categories,category_name,' . $id . ',category_id',
            'description' => 'nullable|string',
        ]);

        $category = InventoryCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('inventory_categories.index')
            ->with('toast_message', 'Category updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy($id)
    {
        $category = InventoryCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('inventory_categories.index')
            ->with('toast_message', 'Category deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
