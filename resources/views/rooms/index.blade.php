@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Rooms</h1>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Add Room</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->roomType->type_name }}</td>
                        <td>
                            @if ($room->status == 'available')
                                <span class="badge bg-success">{{ ucfirst($room->status) }}</span>
                            @elseif($room->status == 'occupied')
                                <span class="badge bg-danger">{{ ucfirst($room->status) }}</span>
                            @elseif($room->status == 'maintenance')
                                <span class="badge bg-warning text-dark">{{ ucfirst($room->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('rooms.edit', $room->room_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('rooms.destroy', $room->room_id) }}" method="POST"
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
