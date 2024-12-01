<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsumableAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'consumable_id',
        'room_id',
        'allocated_by',
        'quantity',
        'allocated_at',
        'status',

    ];
    protected $casts = [
        'allocated_at' => 'datetime', // Cast allocated_at ke datetime
    ];

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'allocated_by');
    }
}
