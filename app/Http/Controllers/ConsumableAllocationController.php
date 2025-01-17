<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumable;
use App\Models\ConsumableAllocation;
use App\Models\Room;
use App\Models\User;

class ConsumableAllocationController extends Controller
{
    public function index()
    {
        $allocations = ConsumableAllocation::with(['consumable', 'room', 'user'])->paginate();// tampilkan semua 
        return view('consumable_allocations.index', compact('allocations'));
    }

    public function create()
    {
        $consumables = Consumable::all();
        $rooms = Room::all();
        $users = User::all();
        return view('consumable_allocations.create', compact('consumables', 'rooms', 'users'));
    }

    public function store(Request $request)
    {
        // dd('Checkpoint Reached');
        $request->validate([
            'consumables.*.id' => 'required|exists:consumables,id',
            'consumables.*.quantity' => 'required|integer|min:1',
            'room_id' => 'required|exists:rooms,room_id',
            'allocated_by' => 'required|exists:users,id',
            'allocated_at' => 'required|date',
        ]);

        foreach ($request->consumables as $consumableData) {
            $consumable = Consumable::findOrFail($consumableData['id']);

            if ($consumable->stock < $consumableData['quantity']) {
                return redirect()->back()->withErrors(['quantity' => "Stock for {$consumable->name} is not sufficient."]);
            }

            // Kurangi stok barang
            $consumable->decrement('stock', $consumableData['quantity']);

            // Simpan alokasi
            ConsumableAllocation::create([
                'consumable_id' => $consumable->id,
                'room_id' => $request->room_id,
                'allocated_by' => $request->allocated_by,
                'quantity' => $consumableData['quantity'],
                'allocated_at' => $request->allocated_at,
                'status' => 'dalam pemakaian',
            ]);
        }
        return redirect()->route('consumable_allocations.index')
            ->with('toast_message', 'Allocation created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit(ConsumableAllocation $consumableAllocation)
    {
        $consumables = Consumable::all();
        $rooms = Room::all();
        $users = User::all();
        return view('consumable_allocations.edit', compact('consumableAllocation', 'consumables', 'rooms', 'users'));
    }

    public function update(Request $request, ConsumableAllocation $consumableAllocation)
    {
        $request->validate([
            'consumable_id' => 'required|exists:consumables,id',
            'room_id' => 'required|exists:rooms,room_id',
            'allocated_by' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'allocated_at' => 'required|date',
            'status' => 'required|string',
        ]);

        // Kembalikan stok lama ke consumable sebelumnya
        $oldConsumable = Consumable::findOrFail($consumableAllocation->consumable_id);
        $oldConsumable->increment('stock', $consumableAllocation->quantity);

        // Perbarui stok baru jika consumable berubah
        if ($request->consumable_id != $consumableAllocation->consumable_id) {
            $newConsumable = Consumable::findOrFail($request->consumable_id);

            if ($newConsumable->stock < $request->quantity) {
                return redirect()->back()->withErrors(['quantity' => 'Stock is not sufficient for this allocation.']);
            }

            $newConsumable->decrement('stock', $request->quantity);
        } else {
            // Kurangi stok baru jika consumable sama
            $oldConsumable->decrement('stock', $request->quantity);
        }

        // Perbarui data alokasi
        $consumableAllocation->update($request->all());
        return redirect()->route('consumable_allocations.index')
            ->with('toast_message', 'Allocation updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy(ConsumableAllocation $consumableAllocation)
    {
        $consumableAllocation->delete();
        return redirect()->route('consumable_allocations.index')
            ->with('toast_message', 'Allocation deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
