<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unconsumable;
use App\Models\UnconsumableAllocation;
use App\Models\Room;
use App\Models\User;

class UnconsumableAllocationController extends Controller
{
    public function index()
    {
        $allocations = UnconsumableAllocation::with(['unconsumable', 'room', 'user'])->paginate(10);
        return view('unconsumable_allocations.index', compact('allocations'));
    }

    public function create()
    {
        $unconsumables = Unconsumable::all();
        $rooms = Room::all();
        $users = User::all();
        return view('unconsumable_allocations.create', compact('unconsumables', 'rooms', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unconsumables.*.id' => 'required|exists:unconsumables,id',
            'unconsumables.*.quantity' => 'required|integer|min:1',
            'room_id' => 'required|exists:rooms,room_id',
            'allocated_by' => 'required|exists:users,id',
            'allocated_at' => 'required|date',
            'status' => 'required|string',
            
        ]);

        foreach ($request->unconsumables as $unconsumableData) {
            $unconsumable = Unconsumable::findOrFail($unconsumableData['id']);

            if ($unconsumable->stock < $unconsumableData['quantity']) {
                return redirect()->back()->withErrors(['quantity' => "Stock for {$unconsumable->name} is not sufficient."]);
            }

            // Kurangi stok barang
            $unconsumable->decrement('stock', $unconsumableData['quantity']);

            // Simpan alokasi
            UnconsumableAllocation::create([
                'unconsumable_id' => $unconsumable->id,
                'room_id' => $request->room_id,
                'allocated_by' => $request->allocated_by,
                'quantity' => $unconsumableData['quantity'],
                'allocated_at' => $request->allocated_at,
                 'status' => $request->status, 
            ]);
        }
        return redirect()->route('unconsumable_allocations.index')
            ->with('toast_message', 'Allocation created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit(UnconsumableAllocation $unconsumableAllocation)
    {
        $unconsumables = Unconsumable::all();
        $rooms = Room::all();
        $users = User::all();
        return view('unconsumable_allocations.edit', compact('unconsumableAllocation', 'unconsumables', 'rooms', 'users'));
    }

    public function update(Request $request, UnconsumableAllocation $unconsumableAllocation)
    {
        $request->validate([
            'unconsumable_id' => 'required|exists:unconsumables,id',
            'room_id' => 'required|exists:rooms,room_id',
            'allocated_by' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'allocated_at' => 'required|date',
            'status' => 'required|string',
        ]);

        // Kembalikan stok lama ke consumable sebelumnya
        $oldUnconsumable = Unconsumable::findOrFail($unconsumableAllocation->unconsumable_id);
        $oldUnconsumable->increment('stock', $unconsumableAllocation->quantity);

        // Perbarui stok baru jika consumable berubah
        if ($request->unconsumable_id != $unconsumableAllocation->unconsumable_id) {
            $newUnconsumable = Unconsumable::findOrFail($request->unconsumable_id);

            if ($newUnconsumable->stock < $request->quantity) {
                return redirect()->back()->withErrors(['quantity' => 'Stock is not sufficient for this allocation.']);
            }

            $newUnconsumable->decrement('stock', $request->quantity);
        } else {
            // Kurangi stok baru jika consumable sama
            $oldUnconsumable->decrement('stock', $request->quantity);
        }

        // Perbarui data alokasi
        $unconsumableAllocation->update($request->all());
        return redirect()->route('unconsumable_allocations.index')
            ->with('toast_message', 'Allocation updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy(UnconsumableAllocation $unconsumableAllocation)
    {
        // Ambil informasi barang yang terkait dengan alokasi ini
        $unconsumable = $unconsumableAllocation->unconsumable;

        // Tambahkan kembali stok yang dialokasikan
        $unconsumable->increment('stock', $unconsumableAllocation->quantity);

        // Hapus alokasi yang telah dibuat
        $unconsumableAllocation->delete();

        // Redirect ke halaman alokasi dengan pesan sukses
        return redirect()->route('unconsumable_allocations.index')
            ->with('toast_message', 'Allocation deleted and stock updated successfully.')
            ->with('toast_color', 'danger');
    }
}
