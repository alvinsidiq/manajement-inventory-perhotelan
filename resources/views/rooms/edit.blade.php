@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Room Details</h5>
                    <span class="badge bg-light text-primary">Room #{{ $room->room_number }}</span>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room->room_id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Room Number -->
                        <div class="mb-4">
                            <label for="room_number" class="form-label fw-semibold">
                                Room Number
                            </label>
                            <input type="text" 
                                   name="room_number" 
                                   class="form-control @error('room_number') is-invalid @enderror" 
                                   value="{{ old('room_number', $room->room_number) }}" 
                                   required>
                            @error('room_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Room Type -->
                        <div class="mb-4">
                            <label for="room_type_id" class="form-label fw-semibold">
                                Room Type
                            </label>
                            <select name="room_type_id" 
                                    class="form-select @error('room_type_id') is-invalid @enderror" 
                                    required>
                                @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType->room_type_id }}"
                                            {{ old('room_type_id', $room->room_type_id) == $roomType->room_type_id ? 'selected' : '' }}>
                                        {{ $roomType->type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Room Status -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Status</label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-check card h-100">
                                        <div class="card-body">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="status" 
                                                   id="status_available" 
                                                   value="available"
                                                   {{ old('status', $room->status) == 'available' ? 'checked' : '' }}>
                                            <label class="form-check-label w-100" for="status_available">
                                                <i class="fas fa-check-circle text-success"></i>
                                                Available
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check card h-100">
                                        <div class="card-body">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="status" 
                                                   id="status_occupied" 
                                                   value="occupied"
                                                   {{ old('status', $room->status) == 'occupied' ? 'checked' : '' }}>
                                            <label class="form-check-label w-100" for="status_occupied">
                                                <i class="fas fa-bed text-primary"></i>
                                                Occupied
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check card h-100">
                                        <div class="card-body">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="status" 
                                                   id="status_maintenance" 
                                                   value="maintenance"
                                                   {{ old('status', $room->status) == 'maintenance' ? 'checked' : '' }}>
                                            <label class="form-check-label w-100" for="status_maintenance">
                                                <i class="fas fa-tools text-warning"></i>
                                                Maintenance
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('status')
                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2 justify-content-end border-top pt-4">
                            <a href="{{ route('rooms.index') }}" 
                               class="btn btn-light">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back to List
                            </a>
                            <button type="submit" 
                                    class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-check.card {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .form-check.card:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
    }
    .form-check.card .card-body {
        padding: 1rem;
    }
    .form-check-input:checked + .form-check-label {
        font-weight: 600;
    }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        'use strict'
        
        // Form validation
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })

        // Make entire card clickable for status selection
        document.querySelectorAll('.form-check.card').forEach(card => {
            card.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]')
                radio.checked = true
            })
        })
    })()
</script>
@endpush
@endsection