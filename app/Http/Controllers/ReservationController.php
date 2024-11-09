<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('guest', 'room')->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $guests = Guest::all();
        $rooms = Room::where('status', 'available')->get(); // Hanya kamar yang tersedia
        return view('reservations.create', compact('guests', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,guest_id',
            'room_id' => 'required|exists:rooms,room_id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        // Buat reservasi baru
        Reservation::create($request->all());

        // Perbarui status kamar menjadi occupied
        Room::where('room_id', $request->room_id)->update(['status' => 'occupied']);

        return redirect()->route('reservations.index')
            ->with('toast_message', 'Reservation created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $guests = Guest::all();
        $rooms = Room::all();
        return view('reservations.edit', compact('reservation', 'guests', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,guest_id',
            'room_id' => 'required|exists:rooms,room_id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'status' => 'required|in:reserved,checked_in,checked_out,cancelled',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        // Update room status on check-out or cancellation
        if ($request->status === 'checked_out' || $request->status === 'cancelled') {
            Room::where('room_id', $reservation->room_id)->update(['status' => 'available']);
        }

        return redirect()->route('reservations.index')
            ->with('toast_message', 'Reservation updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Perbarui status kamar ke tersedia jika reservasi dibatalkan
        Room::where('room_id', $reservation->room_id)->update(['status' => 'available']);

        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('toast_message', 'Reservation deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
