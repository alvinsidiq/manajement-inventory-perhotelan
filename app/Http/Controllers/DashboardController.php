<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Guest;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data ringkasan dari berbagai model
        $totalRoomTypes = RoomType::count();
        $totalRooms = Room::count();
        $totalReservations = Reservation::count();
        $totalGuests = Guest::count();

        return view('dashboard', compact(
            'totalRoomTypes',
            'totalRooms',
            'totalReservations',
            'totalGuests',
        ));
    }
}
