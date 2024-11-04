@extends('layouts.app')

@section('title', 'Items')

@section('content')
    <div class="container">
        <h1>Items</h1>
        <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add Item</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Supplier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->supplier->name }}</td>
                        <td>
                            <a href="{{ route('items.edit', $item->item_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <!-- Tombol Hapus dengan Modal -->
                            <button class="btn btn-sm btn-danger"
                                onclick="showDeleteModal({{ $item->item_id }}, '{{ $item->name }}')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the item <strong id="itemName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="{{ route('items.destroy', 0) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(itemId, itemName) {
            // Set action URL untuk form delete berdasarkan item yang dipilih
            let form = document.getElementById('deleteForm');
            form.action = '{{ route('items.destroy', ':id') }}'.replace(':id', itemId);

            // Set nama item di modal
            document.getElementById('itemName').textContent = itemName;

            // Tampilkan modal
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endsection
