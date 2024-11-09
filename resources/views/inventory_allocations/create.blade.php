@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Allocate Inventory to Room</h1>
        <form action="{{ route('inventory_allocations.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="room_id">Room</label>
                <select name="room_id" class="form-control" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->room_id }}">{{ $room->room_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="inventory_id">Inventory Item</label>
                <select name="inventory_id" class="form-control" required>
                    @foreach ($inventories as $inventory)
                        <option value="{{ $inventory->inventory_id }}">{{ $inventory->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" required min="1">
            </div>
            <button type="submit" class="btn btn-primary">Allocate</button>
            <a href="{{ route('inventory_allocations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
