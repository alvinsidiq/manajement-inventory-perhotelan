@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Room</h1>
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="room_number">Room Number</label>
                <input type="text" name="room_number" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="room_type_id">Room Type</label>
                <select name="room_type_id" class="form-control" required>
                    @foreach ($roomTypes as $roomType)
                        <option value="{{ $roomType->room_type_id }}">{{ $roomType->type_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="available">Available</option>
                    <option value="occupied">Occupied</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
