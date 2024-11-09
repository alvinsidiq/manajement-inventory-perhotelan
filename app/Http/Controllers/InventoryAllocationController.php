<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryAllocation;
use App\Models\Room;
use App\Models\Inventory;


class InventoryAllocationController extends Controller
{
    public function index()
    {
        $allocations = InventoryAllocation::with('room', 'inventory')->get();
        return view('inventory_allocations.index', compact('allocations'));
    }

    public function create()
    {
        $rooms = Room::all();
        $inventories = Inventory::all();
        return view('inventory_allocations.create', compact('rooms', 'inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'inventory_id' => 'required|exists:inventories,inventory_id',
            'quantity' => 'required|integer|min:1',
        ]);

        InventoryAllocation::create($request->all());

        return redirect()->route('inventory_allocations.index')
            ->with('toast_message', 'Inventory allocated to room successfully.')
            ->with('toast_color', 'info');
    }

    public function edit($id)
    {
        $allocation = InventoryAllocation::findOrFail($id);
        $rooms = Room::all();
        $inventories = Inventory::all();
        return view('inventory_allocations.edit', compact('allocation', 'rooms', 'inventories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'inventory_id' => 'required|exists:inventories,inventory_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $allocation = InventoryAllocation::findOrFail($id);
        $allocation->update($request->all());

        return redirect()->route('inventory_allocations.index')
            ->with('toast_message', 'Inventory allocation updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy($id)
    {
        $allocation = InventoryAllocation::findOrFail($id);
        $allocation->delete();

        return redirect()->route('inventory_allocations.index')
            ->with('toast_message', 'Inventory allocation deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
