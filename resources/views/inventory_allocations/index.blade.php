@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inventory Allocations</h1>
        <a href="{{ route('inventory_allocations.create') }}" class="btn btn-primary mb-3">Allocate Inventory to Room</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Room</th>
                    <th>Inventory Item</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allocations as $allocation)
                    <tr>
                        <td>{{ $allocation->allocation_id }}</td>
                        <td>{{ $allocation->room->room_number }}</td>
                        <td>{{ $allocation->inventory->name }}</td>
                        <td>{{ $allocation->quantity }}</td>
                        <td>
                            <a href="{{ route('inventory_allocations.edit', $allocation->allocation_id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('inventory_allocations.destroy', $allocation->allocation_id) }}"
                                method="POST" style="display:inline;">
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
