@extends('layouts.app')

@section('title', 'Unconsumable Allocations')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Unconsumable Allocations</h1>
            <p class="text-muted mb-0">Manage all unconsumable allocations</p>
        </div>
        <a href="{{ route('unconsumable_allocations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Allocation
        </a>
    </div>

    <!-- Allocations Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">#</th>
                            <th>Unconsumable</th>
                            <th>Room</th>
                            <th>Allocated By</th>
                            <th>Quantity</th>
                            <th>Allocated At</th>
                            <th>Status</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allocations as $allocation)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $loop->iteration }}</td>
                                <td>{{ optional($allocation->unconsumable)->name ?? 'N/A' }}</td>
                                <td>{{ $allocation->room->room_number }}</td>
                                <td>{{ $allocation->user->name }}</td>
                                <td>{{ $allocation->quantity }}</td>
                                <td>{{ $allocation->allocated_at }}</td>
                                <td>
                                    @if ($allocation->status == 'dalam pemakaian')
                                        <span class="badge bg-success">{{ $allocation->status }}</span>
                                    @elseif ($allocation->status == 'rusak')
                                        <span class="badge bg-warning">{{ $allocation->status }}</span>
                                    @elseif ($allocation->status == 'hilang')
                                        <span class="badge bg-danger">{{ $allocation->status }}</span>
                                    @else
                                        <span class="badge bg-info">{{ $allocation->status }}</span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <div class="btn-group">
                                        <a href="{{ route('unconsumable_allocations.edit', $allocation->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $allocation->id }}">
                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $allocation->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="mb-0">Are you sure you want to delete the allocation for room "{{ $allocation->room->room_number }}"? This action cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('unconsumable_allocations.destroy', $allocation->id) }}" method="POST" class="d-inline">
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
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open mb-2 fa-2x"></i>
                                        <p class="mb-0">No allocations found. Click "Add Allocation" to create one.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
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
