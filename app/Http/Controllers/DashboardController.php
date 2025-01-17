<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\ConsumableCategory;
use App\Models\Consumable;
use App\Models\ConsumableAllocation;
use App\Models\UnconsumableCategory;
use App\Models\Unconsumable;
use App\Models\UnconsumableAllocation;


class DashboardController extends Controller
{
    public function index()
{
    // Ambil data ringkasan dari berbagai model
    $totalRoomTypes = RoomType::count();
    $totalRooms = Room::count();
    $totalReservations = Reservation::count();
    $totalGuests = Guest::count();
    $totalCategories = ConsumableCategory::count();
    $totalItems = Consumable::count();
    $totalAllocations = ConsumableAllocation::count();
    $totalUncategories = UnconsumableCategory::count();
    $totalUnitems = Unconsumable::count();
    $totalUnallocations = UnconsumableAllocation::count();

    // Hitung jumlah barang rusak dan hilang
    $totalRusak = UnconsumableAllocation::where('status', 'rusak')->count();
    $totalHilang = UnconsumableAllocation::where('status', 'hilang')->count();

    return view('dashboard', compact(
        'totalRoomTypes',
        'totalRooms',
        'totalReservations',
        'totalGuests',
        'totalCategories',
        'totalItems',
        'totalAllocations',
        'totalUncategories',
        'totalUnitems',
        'totalUnallocations',
        'totalRusak',
        'totalHilang',
    ));
}

}
