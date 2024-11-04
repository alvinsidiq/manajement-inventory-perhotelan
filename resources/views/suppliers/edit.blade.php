@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
    <div class="container">
        <h1>Edit Supplier</h1>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mb-3">Back to Suppliers</a>

        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Supplier Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $supplier->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="contact_info">Contact Info</label>
                <input type="text" name="contact_info" id="contact_info" class="form-control"
                    value="{{ old('contact_info', $supplier->contact_info) }}">
                @error('contact_info')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control">{{ old('address', $supplier->address) }}</textarea>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Supplier</button>
        </form>
    </div>
@endsection
