@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Room</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rooms.store') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Room Number -->
                        <div class="mb-4">
                            <label for="room_number" class="form-label fw-bold">Room Number</label>
                            <input type="text" 
                                   class="form-control @error('room_number') is-invalid @enderror" 
                                   id="room_number" 
                                   name="room_number" 
                                   required 
                                   placeholder="Enter room number">
                            @error('room_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Room Type -->
                        <div class="mb-4">
                            <label for="room_type" class="form-label fw-bold">Room Type</label>
                            <select class="form-select @error('room_type') is-invalid @enderror" 
                                    id="room_type" 
                                    name="room_type" 
                                    required>
                                <option value="">Select room type</option>
                                @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}">
                                        {{ $roomType->type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Room Status -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Status</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="status" 
                                           id="status_available" 
                                           value="available" 
                                           checked>
                                    <label class="form-check-label" for="status_available">
                                        Available
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="status" 
                                           id="status_occupied" 
                                           value="occupied">
                                    <label class="form-check-label" for="status_occupied">
                                        Occupied
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="status" 
                                           id="status_maintenance" 
                                           value="maintenance">
                                    <label class="form-check-label" for="status_maintenance">
                                        Maintenance
                                    </label>
                                </div>
                            </div>
                            @error('status')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('rooms.index') }}" 
                               class="btn btn-light">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="btn btn-primary px-4">
                                Save Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Validation Script -->
@push('scripts')
<script>
    (function () {
        'use strict'
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
    })()
</script>
@endpush
@endsection