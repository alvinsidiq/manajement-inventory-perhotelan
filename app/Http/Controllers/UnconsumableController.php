<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unconsumable;
use App\Models\UnconsumableCategory;

class UnconsumableController extends Controller
{
    public function index()
    {
        // Fetch unconsumables with their associated categories
        $unconsumables = Unconsumable::with('category')->paginate(10);

        // Check if any consumable has a stock below the reorder level
        foreach ($unconsumables as $unconsumable) {
            if ($unconsumable->stock < $unconsumable->reorder_level) {
                // Flash a session message for low stock
                session()->flash('low_stock', 'Warning: ' . $unconsumable->name . ' is below its reorder level!');
            }
        }

        // Fetch categories for any other use
        $categories = UnconsumableCategory::all();

        return view('unconsumables.index', compact('unconsumables', 'categories'));
    }

    public function create()
    {
        $categories = UnconsumableCategory::all();
        return view('unconsumables.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:unconsumable_categories,id',
            'stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Unconsumable::create($request->all());
        return redirect()->route('unconsumables.index')
            ->with('toast_message', 'Consumable created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit(Unconsumable $unconsumable)
    {
        $categories = UnconsumableCategory::all();
        return view('unconsumables.edit', compact('unconsumable', 'categories'));
    }

    public function update(Request $request, Unconsumable $unconsumable)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:unconsumable_categories,id',
            'stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $unconsumable->update($request->all());
        return redirect()->route('unconsumables.index')
            ->with('toast_message', 'Consumable updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy(Unconsumable $unconsumable)
    {
        $unconsumable->delete();

        return redirect()->route('unconsumables.index')
            ->with('toast_message', 'Unconsumable deleted successfully.')
            ->with('toast_color', 'danger');
    }

    public function addStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $unconsumable = Unconsumable::findOrFail($id);

        // Add stock
        $unconsumable->increment('stock', $request->quantity);
        return redirect()->route('unconsumables.index')
            ->with('toast_message', 'Unconsumable added successfully.')
            ->with('toast_color', 'success');
    }
}
