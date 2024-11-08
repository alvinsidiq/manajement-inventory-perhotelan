<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms',
            'room_type_id' => 'required|exists:room_types,room_type_id',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')
            ->with('toast_message', 'Room created successfully.')
            ->with('toast_color', 'info'); // Warna info untuk create
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::all();
        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $id . ',room_id',
            'room_type_id' => 'required|exists:room_types,room_type_id',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('toast_message', 'Room updated successfully.')
            ->with('toast_color', 'success'); // Warna success untuk update
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('toast_message', 'Room deleted successfully.')
            ->with('toast_color', 'danger'); // Warna danger untuk delete
    }
}
