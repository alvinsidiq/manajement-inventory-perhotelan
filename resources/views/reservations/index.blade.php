@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservations</h1>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Add Reservation</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Guest</th>
                    <th>Room</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->reservation_id }}</td>
                        <td>{{ $reservation->guest->name }}</td>
                        <td>{{ $reservation->room->room_number }}</td>
                        <td>{{ $reservation->check_in_date }}</td>
                        <td>{{ $reservation->check_out_date }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>
                            <a href="{{ route('reservations.edit', $reservation->reservation_id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('reservations.destroy', $reservation->reservation_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
