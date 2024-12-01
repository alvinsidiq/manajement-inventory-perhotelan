<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumable;
use App\Models\ConsumableCategory;

class ConsumableController extends Controller
{
    public function index()
    {
        $consumables = Consumable::with('category')->paginate(10);
        $categories = ConsumableCategory::all();

        return view('consumables.index', compact('consumables', 'categories'));
    }

    public function create()
    {
        $categories = ConsumableCategory::all();
        return view('consumables.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:consumable_categories,id',
            'stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Consumable::create($request->all());
        return redirect()->route('consumables.index')
            ->with('toast_message', 'Consumable created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit(Consumable $consumable)
    {
        $categories = ConsumableCategory::all();
        return view('consumables.edit', compact('consumable', 'categories'));
    }

    public function update(Request $request, Consumable $consumable)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:consumable_categories,id',
            'stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $consumable->update($request->all());
        return redirect()->route('consumables.index')
            ->with('toast_message', 'Consumable updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy(Consumable $consumable)
    {
        $consumable->delete();

        return redirect()->route('consumables.index')
            ->with('toast_message', 'Consumable deleted successfully.')
            ->with('toast_color', 'danger');
    }

    public function addStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $consumable = Consumable::findOrFail($id);

        // Tambah stock
        $consumable->increment('stock', $request->quantity);
        return redirect()->route('consumables.index')
            ->with('toast_message', 'Consumable added successfully.')
            ->with('toast_color', 'success');
    }
}
