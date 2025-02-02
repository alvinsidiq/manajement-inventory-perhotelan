@extends('layouts.app')

@section('title', 'Add Supplier')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Supplier</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-light mb-4">Back to Suppliers</a>

                    <form action="{{ route('suppliers.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Supplier Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Supplier Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   placeholder="Enter supplier name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Contact Info -->
                        <div class="mb-4">
                            <label for="contact_info" class="form-label fw-bold">Contact Info</label>
                            <input type="text" 
                                   class="form-control @error('contact_info') is-invalid @enderror" 
                                   id="contact_info" 
                                   name="contact_info" 
                                   value="{{ old('contact_info') }}" 
                                   placeholder="Enter contact info">
                            @error('contact_info')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      placeholder="Enter address">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('suppliers.index') }}" 
                               class="btn btn-light">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="btn btn-primary px-4">
                                Add Supplier
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
