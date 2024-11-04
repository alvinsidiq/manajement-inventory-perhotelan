<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan ini ditambahkan

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('item')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $items = Item::all();
        return view('transactions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,item_id',
            'transaction_type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        // Mulai transaksi database untuk memastikan konsistensi data
        DB::transaction(function () use ($request) {
            // Buat transaksi
            $transaction = Transaction::create([
                'item_id' => $request->item_id,
                'transaction_type' => $request->transaction_type,
                'quantity' => $request->quantity,
                'transaction_date' => $request->transaction_date,
                'user_id' => auth()->id(), // ID pengguna yang sedang login
            ]);

            // Ambil item yang terkait dengan transaksi ini
            $item = Item::findOrFail($request->item_id);

            // Perbarui jumlah stok berdasarkan jenis transaksi
            if ($transaction->transaction_type === 'IN') {
                // Tambah stok jika transaksi adalah IN
                $item->quantity += $transaction->quantity;
            } elseif ($transaction->transaction_type === 'OUT') {
                // Kurangi stok jika transaksi adalah OUT
                // Cek jika stok mencukupi untuk pengurangan
                if ($item->quantity >= $transaction->quantity) {
                    $item->quantity -= $transaction->quantity;
                } else {
                    // Batalkan transaksi jika stok tidak cukup
                    throw new \Exception('Insufficient stock for this transaction.');
                }
            }

            // Simpan perubahan stok item
            $item->save();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }
}
