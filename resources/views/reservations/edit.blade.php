@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Reservation</h1>
        <form action="{{ route('reservations.update', $reservation->reservation_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="guest_id">Guest</label>
                <select name="guest_id" class="form-control" required>
                    <option value="">Select a guest</option>
                    @foreach ($guests as $guest)
                        <option value="{{ $guest->guest_id }}"
                            {{ $guest->guest_id == $reservation->guest_id ? 'selected' : '' }}>
                            {{ $guest->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="room_id">Room</label>
                <select name="room_id" class="form-control" required>
                    <option value="">Select a room</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->room_id }}"
                            {{ $room->room_id == $reservation->room_id ? 'selected' : '' }}>
                            {{ $room->room_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="check_in_date">Check-in Date</label>
                <input type="date" name="check_in_date" class="form-control" value="{{ $reservation->check_in_date }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="check_out_date">Check-out Date</label>
                <input type="date" name="check_out_date" class="form-control" value="{{ $reservation->check_out_date }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="reserved" {{ $reservation->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                    <option value="checked_in" {{ $reservation->status == 'checked_in' ? 'selected' : '' }}>Checked In
                    </option>
                    <option value="checked_out" {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>Checked Out
                    </option>
                    <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Reservation</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
