@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Room</h1>
        <form action="{{ route('rooms.update', $room->room_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="room_number">Room Number</label>
                <input type="text" name="room_number" class="form-control" value="{{ $room->room_number }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="room_type_id">Room Type</label>
                <select name="room_type_id" class="form-control" required>
                    @foreach ($roomTypes as $roomType)
                        <option value="{{ $roomType->room_type_id }}"
                            {{ $roomType->room_type_id == $room->room_type_id ? 'selected' : '' }}>
                            {{ $roomType->type_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
