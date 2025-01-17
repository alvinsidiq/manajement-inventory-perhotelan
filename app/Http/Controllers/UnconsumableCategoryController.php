<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UnconsumableCategory; // Import model yang sesuai

class UnconsumableCategoryController extends Controller
{
    public function index()
    {
        $categories = UnconsumableCategory::paginate(10);
        return view('unconsumable_categories.index', compact('categories'));
    }


    public function create()
    {
        return view('unconsumable_categories.create');
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        UnconsumableCategory::create($request->all());
        return redirect()->route('unconsumable_categories.index')
            ->with('toast_message', 'Category created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit(UnconsumableCategory $unconsumableCategory)
    {
        return view('unconsumable_categories.edit', compact('unconsumableCategory'));
    }

    public function update(Request $request, UnconsumableCategory $unconsumableCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $unconsumableCategory->update($request->all());
        return redirect()->route('unconsumable_categories.index')
            ->with('toast_message', 'Category updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy(UnconsumableCategory $unconsumableCategory)
    {
        $unconsumableCategory->delete();
        return redirect()->route('unconsumable_categories.index')
            ->with('toast_message', 'Category deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
