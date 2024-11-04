@extends('layouts.app')

@section('title', 'Add Supplier')

@section('content')
    <div class="container">
        <h1>Add New Supplier</h1>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mb-3">Back to Suppliers</a>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Supplier Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="contact_info">Contact Info</label>
                <input type="text" name="contact_info" id="contact_info" class="form-control"
                    value="{{ old('contact_info') }}">
                @error('contact_info')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Supplier</button>
        </form>
    </div>
@endsection
