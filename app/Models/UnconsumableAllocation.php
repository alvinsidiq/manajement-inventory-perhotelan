<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnconsumableAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'unconsumable_id',
        'room_id',
        'allocated_by',
        'quantity',
        'allocated_at',
        'status',

    ];
    protected $casts = [
        'allocated_at' => 'datetime', // Cast allocated_at ke datetime
    ];

    public function unconsumable()
    {
        return $this->belongsTo(Unconsumable::class);
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
