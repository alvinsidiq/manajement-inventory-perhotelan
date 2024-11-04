<?php

namespace App\Models;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Tentukan primary key sebagai transaction_id
    protected $primaryKey = 'transaction_id';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'item_id',
        'transaction_type',
        'quantity',
        'transaction_date',
        'user_id' // Kolom yang akan menyimpan ID pengguna yang sedang login
    ];

    /**
     * Relasi ke model Item.
     * Menghubungkan transaksi dengan item terkait.
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * Relasi ke model User.
     * Menghubungkan transaksi dengan pengguna yang menangani transaksi.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
