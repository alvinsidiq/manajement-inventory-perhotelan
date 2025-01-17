<?php

// app/Http/Controllers/LaporanController.php

// app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use App\Models\UnconsumableAllocation;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan dengan status rusak dan hilang
    public function index()
    {
        // Ambil data alokasi dengan status rusak dan hilang
        $laporans = UnconsumableAllocation::with(['unconsumable', 'room', 'user'])
            ->whereIn('status', ['rusak', 'hilang'])
            ->paginate(10);

        // Mengirim data ke view laporan
        return view('laporan.index', compact('laporans'));
    }

    // Menampilkan form untuk mengedit laporan
    public function edit($id)
    {
        // Menemukan laporan berdasarkan ID
        $laporan = UnconsumableAllocation::findOrFail($id);
        
        // Menampilkan halaman edit dengan membawa data laporan
        return view('laporan.edit', compact('laporan'));
    }

    // Mengupdate laporan yang sudah diedit
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'status' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        // Menemukan laporan berdasarkan ID
        $laporan = UnconsumableAllocation::findOrFail($id);

        // Memperbarui status dan deskripsi laporan
        $laporan->status = $validated['status'];
        $laporan->deskripsi = $validated['deskripsi']; // Menambahkan deskripsi baru

        // Menyimpan perubahan
        $laporan->save();

        // Redirect ke halaman laporan setelah sukses
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }
}

