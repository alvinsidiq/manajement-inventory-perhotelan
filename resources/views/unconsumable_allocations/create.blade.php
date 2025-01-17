@extends('layouts.app')

@section('title', 'Add Transaction')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Transaction</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('transactions.index') }}" class="btn btn-light mb-4">Back to Transactions</a>

                    <form action="{{ route('transactions.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                       
                        <!-- Transaction Type -->
                        <div class="mb-4">
                            <label for="transaction_type" class="form-label fw-bold">Transaction Type</label>
                            <select name="transaction_type" id="transaction_type" class="form-select @error('transaction_type') is-invalid @enderror" required>
                                <option value="IN" {{ old('transaction_type') == 'IN' ? 'selected' : '' }}>IN</option>
                                <option value="OUT" {{ old('transaction_type') == 'OUT' ? 'selected' : '' }}>OUT</option>
                            </select>
                            @error('transaction_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold">Quantity</label>
                            <input type="number" 
                                   name="quantity" 
                                   id="quantity" 
                                   class="form-control @error('quantity') is-invalid @enderror" 
                                   value="{{ old('quantity') }}" 
                                   required>
                            @error('quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Transaction Date -->
                        <div class="mb-4">
                            <label for="transaction_date" class="form-label fw-bold">Transaction Date</label>
                            <input type="date" 
                                   name="transaction_date" 
                                   id="transaction_date" 
                                   class="form-control @error('transaction_date') is-invalid @enderror" 
                                   value="{{ old('transaction_date') }}" 
                                   required>
                            @error('transaction_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('transactions.index') }}" 
                               class="btn btn-light">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="btn btn-primary px-4">
                                Add Transaction
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
