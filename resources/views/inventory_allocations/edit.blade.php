@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Inventory Allocation</h1>
        <form action="{{ route('inventory_allocations.update', $allocation->allocation_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="room_id">Room</label>
                <select name="room_id" class="form-control" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->room_id }}" {{ $room->room_id == $allocation->room_id ? 'selected' : '' }}>
                            {{ $room->room_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="inventory_id">Inventory Item</label>
                <select name="inventory_id" class="form-control" required>
                    @foreach ($inventories as $inventory)
                        <option value="{{ $inventory->inventory_id }}"
                            {{ $inventory->inventory_id == $allocation->inventory_id ? 'selected' : '' }}>
                            {{ $inventory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ $allocation->quantity }}" required
                    min="1">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('inventory_allocations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
