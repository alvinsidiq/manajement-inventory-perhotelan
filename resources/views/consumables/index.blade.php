@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Consumable List</h1>
            <p class="text-muted mb-0">Manage the consumables available in your inventory.</p>
        </div>
        <a href="{{ route('consumables.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Consumable
        </a>
    </div>

    <!-- Consumables Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Reorder Level</th>
                            <th>Price</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consumables as $consumable)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $loop->iteration }}</td>
                                <td>{{ $consumable->name }}</td>
                                <td>{{ $consumable->category->name }}</td>
                                <td>{{ $consumable->stock }}</td>
                                <td>{{ $consumable->reorder_level }}</td>
                                <td>{{ $consumable->price }}</td>
                                <td class="text-end px-4">
                                    <div class="btn-group">
                                        <!-- Add Stock Modal Trigger -->
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#addStockModal{{ $consumable->id }}">
                                            <i class="fas fa-plus me-1"></i> Add Stock
                                        </button>

                                        <!-- Edit Button -->
                                        <a href="{{ route('consumables.edit', $consumable->id) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $consumable->id }}">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </div>

                                    <!-- Modal to Add Stock -->
                                    <div class="modal fade" id="addStockModal{{ $consumable->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Stock for ({{ $consumable->name }})</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('consumables.add_stock', $consumable->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label">Quantity</label>
                                                            <input type="number" name="quantity" id="quantity"
                                                                class="form-control" min="1" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Add Stock</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal to Confirm Delete -->
                                    <div class="modal fade" id="deleteModal{{ $consumable->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $consumable->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $consumable->id }}">
                                                        Confirm Delete</h5>
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
            </div>
        </div>
    </div>

    <!-- Pagination (optional) -->
    <!-- @if (method_exists($consumables, 'links')) -->
    <!--     <div class="d-flex justify-content-center mt-4"> -->
    <!--         {{ $consumables->links() }} -->
    <!--     </div> -->
    <!-- @endif -->
</div>

@push('styles')
<style>
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    .btn-group {
        gap: 0.5rem;
    }
</style>
@endpush
@endsection
