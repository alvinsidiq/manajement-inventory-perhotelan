<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::all();
        return view('room_types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('room_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        RoomType::create($request->all());

        return redirect()->route('room_types.index')
            ->with('toast_message', 'Room type created successfully.')
            ->with('toast_color', 'info');
    }

    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('room_types.edit', compact('roomType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->all());

        return redirect()->route('room_types.index')
            ->with('toast_message', 'Room type updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();

        return redirect()->route('room_types.index')
            ->with('toast_message', 'Room type deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
