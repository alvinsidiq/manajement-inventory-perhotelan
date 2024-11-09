<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'guest_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'status',
    ];

    // Relasi ke Guest
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    // Relasi ke Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
