@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Room Management</h1>
            <p class="text-muted mb-0">Manage hotel rooms and their status</p>
        </div>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Room
        </a>
    </div>

    <!-- Rooms Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">Room Number</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $room->room_number }}</td>
                                <td>{{ $room->roomType->type_name }}</td>
                                <td>
                                    @switch($room->status)
                                        @case('available')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Available
                                            </span>
                                            @break
                                        @case('occupied')
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                                <i class="fas fa-bed me-1"></i>
                                                Occupied
                                            </span>
                                            @break
                                        @case('maintenance')
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2">
                                                <i class="fas fa-tools me-1"></i>
                                                Maintenance
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="text-end px-4">
                                    <div class="btn-group">
                                        <a href="{{ route('rooms.edit', $room->room_id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $room->room_id }}">
                                            <i class="fas fa-trash-alt me-1"></i>
                                            Delete
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $room->room_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="mb-0">Are you sure you want to delete Room {{ $room->room_number }}? This action cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('rooms.destroy', $room->room_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete Room</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-bed mb-2 fa-2x"></i>
                                        <p class="mb-0">No rooms found. Click "Add New Room" to create one.</p>
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
    @if (method_exists($rooms, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $rooms->links() }}
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