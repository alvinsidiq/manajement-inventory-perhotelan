<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryCategory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('category')->get();
        return view('inventory.index', compact('inventories'));
    }

    public function create()
    {
        $categories = InventoryCategory::all();
        return view('inventory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:inventory_categories,category_id',
            'name' => 'required|max:255',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:baik,rusak,hilang',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventory.index')
            ->with('toast_message', 'Inventory item created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $categories = InventoryCategory::all();
        return view('inventory.edit', compact('inventory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:inventory_categories,category_id',
            'name' => 'required|max:255',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:baik,rusak,hilang',
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());

        return redirect()->route('inventory.index')
            ->with('toast_message', 'Inventory item updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventory.index')
            ->with('toast_message', 'Inventory item deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
