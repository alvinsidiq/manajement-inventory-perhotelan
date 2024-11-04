@extends('layouts.app')

@section('title', 'Add Transaction')

@section('content')
    <div class="container">
        <h1>Add New Transaction</h1>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mb-3">Back to Transactions</a>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <!-- Dropdown untuk memilih item -->
            <div class="form-group mb-3">
                <label for="item_id">Item</label>
                <select name="item_id" id="item_id" class="form-control" required>
                    <option value="">Select Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->item_id }}" {{ old('item_id') == $item->item_id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('item_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Dropdown untuk memilih jenis transaksi -->
            <div class="form-group mb-3">
                <label for="transaction_type">Transaction Type</label>
                <select name="transaction_type" id="transaction_type" class="form-control" required>
                    <option value="IN" {{ old('transaction_type') == 'IN' ? 'selected' : '' }}>IN</option>
                    <option value="OUT" {{ old('transaction_type') == 'OUT' ? 'selected' : '' }}>OUT</option>
                </select>
                @error('transaction_type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Field untuk jumlah -->
            <div class="form-group mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}"
                    required>
                @error('quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Field untuk tanggal transaksi -->
            <div class="form-group mb-3">
                <label for="transaction_date">Transaction Date</label>
                <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                    value="{{ old('transaction_date') }}" required>
                @error('transaction_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tombol submit -->
            <button type="submit" class="btn btn-primary">Add Transaction</button>
        </form>
    </div>
@endsection
