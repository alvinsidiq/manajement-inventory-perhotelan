<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::all();
        return view('guests.index', compact('guests'));
    }

    public function create()
    {
        return view('guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:guests',
            'hp' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Guest::create($request->all());

        return redirect()->route('guests.index')
            ->with('toast_message', 'Guest added successfully.')
            ->with('toast_color', 'info');
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('guests.edit', compact('guest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:guests,email,' . $id . ',guest_id',
            'hp' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $guest = Guest::findOrFail($id);
        $guest->update($request->all());

        return redirect()->route('guests.index')
            ->with('toast_message', 'Guest updated successfully.')
            ->with('toast_color', 'success');
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->route('guests.index')
            ->with('toast_message', 'Guest deleted successfully.')
            ->with('toast_color', 'danger');
    }
}
