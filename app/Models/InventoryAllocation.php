<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryAllocation extends Model
{
    use HasFactory;

    protected $table = 'inventory_allocations';

    protected $primaryKey = 'allocation_id';

    protected $fillable = [
        'room_id',
        'inventory_id',
        'quantity',
    ];

    // Relasi ke Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Relasi ke Inventory
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
}
