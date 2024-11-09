@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Reservation</h1>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="guest_id">Guest</label>
                <select name="guest_id" class="form-control" required>
                    <option value="">Select a guest</option>
                    @foreach ($guests as $guest)
                        <option value="{{ $guest->guest_id }}">{{ $guest->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="room_id">Room</label>
                <select name="room_id" class="form-control" required>
                    <option value="">Select a room</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->room_id }}">{{ $room->room_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="check_in_date">Check-in Date</label>
                <input type="date" name="check_in_date" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="check_out_date">Check-out Date</label>
                <input type="date" name="check_out_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Reservation</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
