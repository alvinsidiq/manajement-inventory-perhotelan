@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Consumable List</h1>
        <a href="{{ route('consumables.create') }}" class="btn btn-primary mb-3">Add Consumable</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Reorder Level</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumables as $consumable)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $consumable->name }}</td>
                        <td>{{ $consumable->category->name }}</td>
                        <td>{{ $consumable->stock }}</td>
                        <td>{{ $consumable->reorder_level }}</td>
                        <td>{{ $consumable->price }}</td>
                        <td>
                            <!-- Tombol Tambah Barang -->
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#addStockModal{{ $consumable->id }}">Add Stock</button>
                            <a href="{{ route('consumables.edit', $consumable->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $consumable->id }}">
                                Delete
                            </button>

                            <!-- Modal Tambah Barang -->
                            <div class="modal fade" id="addStockModal{{ $consumable->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Barang ({{ $consumable->name }})</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('consumables.add_stock', $consumable->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label">Jumlah</label>
                                                    <input type="number" name="quantity" id="quantity"
                                                        class="form-control" min="1" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Konfirmasi Delete -->
                            <div class="modal fade" id="deleteModal{{ $consumable->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $consumable->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $consumable->id }}">Confirm
                                                Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the consumable "{{ $consumable->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('consumables.destroy', $consumable->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $consumables->links() }}
    </div>
@endsection
