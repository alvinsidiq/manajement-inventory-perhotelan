<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'room_number',
        'room_type_id',
        'status',
    ];

    // Relasi ke RoomType
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
