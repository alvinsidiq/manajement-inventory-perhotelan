<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'category_id',
        'name',
        'quantity',
        'status',
    ];

    // Relasi ke InventoryCategory
    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }
}
