@extends('layouts.app')

@section('title', 'Unconsumable List')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Unconsumable List</h1>
            <p class="text-muted mb-0">Manage all unconsumable items</p>
        </div>
        <a href="{{ route('unconsumables.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Unconsumable
        </a>
    </div>

    <!-- Unconsumables Table Card -->
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
                        @foreach ($unconsumables as $unconsumable)
                            @php
                                $lowStock = $unconsumable->stock < $unconsumable->reorder_level;
                            @endphp
                            <tr class="{{ $lowStock ? 'table-danger' : '' }}">
                                <td class="px-4 fw-semibold">{{ $loop->iteration }}</td>
                                <td>{{ $unconsumable->name }}</td>
                                <td>{{ $unconsumable->category->name }}</td>
                                <td>{{ $unconsumable->stock }}</td>
                                <td>{{ $unconsumable->reorder_level }}</td>
                                <td>Rp. {{ number_format($unconsumable->price) }}</td>
                                <td class="text-end px-4">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#addStockModal{{ $unconsumable->id }}">
                                            <i class="fas fa-plus me-1"></i>Add Stock
                                        </button>
                                        <a href="{{ route('unconsumables.edit', $unconsumable->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $unconsumable->id }}">
                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                        </button>
                                    </div>

                                    <!-- Add Stock Modal -->
                                    <div class="modal fade" id="addStockModal{{ $unconsumable->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Stock ({{ $unconsumable->name }})</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('unconsumables.add_stock', $unconsumable->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label">Quantity</label>
                                                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Add Stock</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $unconsumable->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="mb-0">Are you sure you want to delete the unconsumable "{{ $unconsumable->name }}"? This action cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('unconsumables.destroy', $unconsumable->id) }}" method="POST" class="d-inline">
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
                            @if ($lowStock)
                                <tr>
                                    <td colspan="7" class="text-danger px-4">Stock is below reorder level!</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if (method_exists($unconsumables, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $unconsumables->links() }}
        </div>
    @endif
</div>

@push('styles')
<style>
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    .btn-group {
        gap: 0.5rem;
    }
    .table-danger {
        background-color: #f8d7da;
    }
</style>
@endpush
@endsection
