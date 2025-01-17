@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit unconsumable Allocation</h1>
        <form action="{{ route('unconsumable_allocations.update', $unconsumableAllocation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- unconsumable Selection -->
            <div class="mb-3">
                <label for="unconsumable_id" class="form-label">unconsumable</label>
                <select name="unconsumable_id" id="unconsumable_id" class="form-select" required>
                    <option value="" disabled>Select a unconsumable</option>
                    @foreach ($unconsumables as $unconsumable)
                        <option value="{{ $unconsumable->id }}"
                            {{ $unconsumableAllocation->unconsumable_id == $unconsumable->id ? 'selected' : '' }}>
                            {{ $unconsumable->name }} (Stock: {{ $unconsumable->stock }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Room Selection -->
            <div class="mb-3">
                <label for="room_id" class="form-label">Room</label>
                <select name="room_id" id="room_id" class="form-select" required>
                    <option value="" disabled>Select a room</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->room_id }}"
                            {{ $unconsumableAllocation->room_id == $room->room_id ? 'selected' : '' }}>
                            {{ $room->room_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Allocated By -->
            <div class="mb-3">
                <label for="allocated_by" class="form-label">Allocated By</label>
                <select name="allocated_by" id="allocated_by" class="form-select" required>
                    <option value="" disabled>Select an employee</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ $unconsumableAllocation->allocated_by == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control"
                    value="{{ $unconsumableAllocation->quantity }}" min="1" required>
            </div>

            <!-- Allocation Date -->
            <div class="mb-3">
                <label for="allocated_at" class="form-label">Allocation Date</label>
                <input type="datetime-local" name="allocated_at" id="allocated_at" class="form-control"
                    value="{{ $unconsumableAllocation->allocated_at->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="dalam pemakaian"
                        {{ $unconsumableAllocation->status == 'dalam pemakaian' ? 'selected' : '' }}>
                        Dalam Pemakaian
                    </option>
                    <option value="rusak" {{ $unconsumableAllocation->status == 'rusak' ? 'selected' : '' }}>
                        Rusak
                    </option>
                    <option value="hilang" {{ $unconsumableAllocation->status == 'hilang' ? 'selected' : '' }}>
                        Hilang
                    </option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
