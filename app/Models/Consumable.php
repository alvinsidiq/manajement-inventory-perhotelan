<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consumable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'stock',
        'reorder_level',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(ConsumableCategory::class);
    }
}
