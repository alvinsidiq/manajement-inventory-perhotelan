<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'room_types';

    protected $primaryKey = 'room_type_id';

    protected $fillable = [
        'type_name',
        'description',
        'price',
    ];
}
