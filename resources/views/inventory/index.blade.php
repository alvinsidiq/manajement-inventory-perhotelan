@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inventory</h1>
        <a href="{{ route('inventory.create') }}" class="btn btn-primary mb-3">Add Inventory Item</a>

        @if (session('toast_message'))
            <div class="alert {{ session('toast_color') }} text-white">{{ session('toast_message') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->inventory_id }}</td>
                        <td>{{ $inventory->category->category_name }}</td>
                        <td>{{ $inventory->name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>
                            @if ($inventory->status == 'baik')
                                <span class="badge bg-success">{{ ucfirst($inventory->status) }}</span>
                            @elseif($inventory->status == 'rusak')
                                <span class="badge bg-danger">{{ ucfirst($inventory->status) }}</span>
                            @elseif($inventory->status == 'hilang')
                                <span class="badge bg-dark">{{ ucfirst($inventory->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('inventory.edit', $inventory->inventory_id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('inventory.destroy', $inventory->inventory_id) }}" method="POST"
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
