@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Consumable Allocations</h1>
        <a href="{{ route('consumable_allocations.create') }}" class="btn btn-primary mb-3">Add Allocation</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Consumable</th>
                    <th>Room</th>
                    <th>Allocated By</th>
                    <th>Quantity</th>
                    <th>Allocated At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allocations as $allocation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $allocation->consumable->name }}</td>
                        <td>{{ $allocation->room->room_number }}</td>
                        <td>{{ $allocation->user->name }}</td>
                        <td>{{ $allocation->quantity }}</td>
                        <td>{{ $allocation->allocated_at }}</td>
                        <td>{{ $allocation->status }}</td>
                        <td>
                            <a href="{{ route('consumable_allocations.edit', $allocation->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            {{-- <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $allocation->id }}">
                                Delete
                            </button> --}}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allocations->links() }}
    </div>

    <!-- Modal Konfirmasi Delete -->
    {{-- <div class="modal fade" id="deleteModal{{ $allocation->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel{{ $allocation->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $allocation->id }}">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the allocation for room "{{ $allocation->room->room_number }}"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('consumable_allocations.destroy', $allocation->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
