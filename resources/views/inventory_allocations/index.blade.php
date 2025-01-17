@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Inventory Allocations</h1>
            <p class="text-muted mb-0">Allocate inventory items to rooms</p>
        </div>
        <a href="{{ route('inventory_allocations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Allocate Inventory to Room
        </a>
    </div>

    <!-- Inventory Allocations Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">ID</th>
                            <th>Room</th>
                            <th>Inventory Item</th>
                            <th>Quantity</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allocations as $allocation)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $allocation->allocation_id }}</td>
                                <td>{{ $allocation->room->room_number }}</td>
                                <td>{{ $allocation->inventory->name }}</td>
                                <td>{{ $allocation->quantity }}</td>
                                <td class="text-end px-4">
                                    <div class="btn-group">
                                        <a href="{{ route('inventory_allocations.edit', $allocation->allocation_id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $allocation->allocation_id }}">
                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $allocation->allocation_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="mb-0">Are you sure you want to delete the allocation of inventory item "{{ $allocation->inventory->name }}" to Room {{ $allocation->room->room_number }}? This action cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('inventory_allocations.destroy', $allocation->allocation_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete Allocation</button>
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
    @if (method_exists($allocations, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $allocations->links() }}
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
