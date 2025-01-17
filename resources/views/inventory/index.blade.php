@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Inventory Management</h1>
            <p class="text-muted mb-0">Manage your inventory items and their status</p>
        </div>
        <a href="{{ route('inventory.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Inventory Item
        </a>
    </div>

    <!-- Toast Message -->
    @if (session('toast_message'))
        <div class="alert {{ session('toast_color') }} text-white">{{ session('toast_message') }}</div>
    @endif

    <!-- Inventory Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $inventory->inventory_id }}</td>
                                <td>{{ $inventory->category->category_name }}</td>
                                <td>{{ $inventory->name }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>
                                    @if ($inventory->status == 'baik')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                            {{ ucfirst($inventory->status) }}
                                        </span>
                                    @elseif($inventory->status == 'rusak')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                            {{ ucfirst($inventory->status) }}
                                        </span>
                                    @elseif($inventory->status == 'hilang')
                                        <span class="badge bg-dark-subtle text-dark border border-dark-subtle px-3 py-2">
                                            {{ ucfirst($inventory->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <div class="btn-group">
                                        <a href="{{ route('inventory.edit', $inventory->inventory_id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $inventory->inventory_id }}">
                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $inventory->inventory_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="mb-0">Are you sure you want to delete the inventory item "{{ $inventory->name }}"? This action cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('inventory.destroy', $inventory->inventory_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete Item</button>
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

    <!-- Pagination -->
    @if (method_exists($inventories, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $inventories->links() }}
        </div>
    @endif
</div>

@push('styles')
<style>
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    .badge {
        font-weight: 500;
    }
    .btn-group {
        gap: 0.5rem;
    }
</style>
@endpush
@endsection
