@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Laporan Kerusakan dan Kehilangan Barang</h1>
            <p class="text-muted mb-0">View and manage damage and loss reports here.</p>
        </div>
    </div>

    <!-- Success Notification -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Reports Table Card -->
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
                            <th>Allocated At</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $loop->iteration }}</td>
                                <td>{{ $laporan->unconsumable->name }}</td>
                                <td>{{ $laporan->room->room_number }}</td>
                                <td>{{ $laporan->user->name }}</td>
                                <td>{{ $laporan->allocated_at }}</td>

                                <td>
                                    <!-- Displaying status -->
                                    @if ($laporan->status == 'rusak')
                                        <span class="badge bg-warning">{{ $laporan->status }}</span>
                                    @elseif ($laporan->status == 'hilang')
                                        <span class="badge bg-danger">{{ $laporan->status }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $laporan->status }}</span>
                                    @endif
                                </td>

                                <td>
                                    <!-- Displaying description -->
                                    @if ($laporan->status == 'hilang')
                                        Items missing in the room {{ $laporan->room->room_number }}
                                    @else
                                        {{ $laporan->deskripsi }}
                                    @endif
                                </td>

                                <td class="text-end px-4">
                                    <!-- Edit Button for non 'hilang' status -->
                                    @if ($laporan->status !== 'hilang')
                                        <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $laporans->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    .badge {
        text-transform: capitalize;
    }
    .btn-group {
        gap: 0.5rem;
    }
</style>
@endpush
