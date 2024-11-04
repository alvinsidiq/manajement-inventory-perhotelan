@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="container">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <!-- Tombol Hapus dengan Modal -->
                            <button class="btn btn-sm btn-danger"
                                onclick="showDeleteModal({{ $category->id }}, '{{ $category->name }}')">Delete</button>
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
                    <p>Are you sure you want to delete the category <strong id="categoryName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="{{ route('categories.destroy', 0) }}" method="POST">
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
        function showDeleteModal(categoryId, categoryName) {
            // Set action URL untuk form delete berdasarkan kategori yang dipilih
            let form = document.getElementById('deleteForm');
            form.action = '{{ route('categories.destroy', ':id') }}'.replace(':id', categoryId);

            // Set nama kategori di modal
            document.getElementById('categoryName').textContent = categoryName;

            // Tampilkan modal
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endsection
