@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Consumable Allocation</h1>
        <form action="{{ route('consumable_allocations.store') }}" method="POST">
            @csrf

            <!-- Consumable Selection -->
            <div id="consumable-container">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="consumable_id_0" class="form-label">Consumable</label>
                        <select name="consumables[0][id]" id="consumable_id_0" class="form-select" required>
                            <option value="" disabled selected>Select a consumable</option>
                            @foreach ($consumables as $consumable)
                                <option value="{{ $consumable->id }}">{{ $consumable->name }} (Stock:
                                    {{ $consumable->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity_0" class="form-label">Quantity</label>
                        <input type="number" name="consumables[0][quantity]" id="quantity_0" class="form-control"
                            min="1" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-success w-100 add-consumable">+</button>
                    </div>
                </div>
            </div>

            <!-- Room Selection -->
            <div class="mb-3">
                <label for="room_id" class="form-label">Room</label>
                <select name="room_id" id="room_id" class="form-select" required>
                    <option value="" disabled selected>Select a room</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->room_id }}">{{ $room->room_number }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Allocated By -->
            <div class="mb-3">
                <label for="allocated_by" class="form-label">Allocated By</label>
                <select name="allocated_by" id="allocated_by" class="form-select" required>
                    <option value="" disabled selected>Select an employee</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Allocation Date -->
            <div class="mb-3">
                <label for="allocated_at" class="form-label">Allocation Date</label>
                <input type="datetime-local" name="allocated_at" id="allocated_at" class="form-control" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="dalam pemakaian">Dalam Pemakaian</option>
                    <option value="habis">Habis</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Allocate</button>
        </form>
    </div>

    <!-- Template for additional consumable rows -->
    <template id="consumable-template">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Consumable</label>
                <select name="consumables[#][id]" class="form-select" required>
                    <option value="" disabled selected>Select a consumable</option>
                    @foreach ($consumables as $consumable)
                        <option value="{{ $consumable->id }}">{{ $consumable->name }} (Stock: {{ $consumable->stock }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Quantity</label>
                <input type="number" name="consumables[#][quantity]" class="form-control" min="1" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="button" class="btn btn-danger w-100 remove-consumable">-</button>
            </div>
        </div>
    </template>

    <!-- Add JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('consumable-container');
            const template = document.getElementById('consumable-template').innerHTML;

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('add-consumable')) {
                    const newIndex = container.children.length;
                    container.insertAdjacentHTML('beforeend', template.replace(/#/g, newIndex));
                }
                if (e.target.classList.contains('remove-consumable')) {
                    e.target.closest('.row').remove();
                }
            });
        });
    </script>
@endsection
