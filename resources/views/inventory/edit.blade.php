@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Inventory Item</h1>
    <form action="{{ route('inventory.update', $inventory->inventory_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->category_id }}" {{ $category->category_id == $inventory->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $inventory->name }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $inventory->quantity }}" required min="0">
        </div>
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="baik" {{ $inventory->status == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak" {{ $inventory->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="hilang" {{ $inventory->status == 'hilang' ? 'selected' : '' }}>Hilang</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
