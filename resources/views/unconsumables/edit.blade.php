@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Unconsumable</h1>
        <form action="{{ route('unconsumables.update', $unconsumable->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Barang -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $unconsumable->name }}"
                    required>
            </div>

            <!-- Kategori Barang -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $unconsumable->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Stok Barang -->
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock" value="{{ $unconsumable->stock }}"
                    required>
            </div>

            <!-- Level Pemesanan Ulang -->
            <div class="mb-3">
                <label for="reorder_level" class="form-label">Reorder Level</label>
                <input type="number" name="reorder_level" class="form-control" id="reorder_level"
                    value="{{ $unconsumable->reorder_level }}" required>
            </div>

            <!-- Harga Barang -->
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" id="price"
                    value="{{ $unconsumable->price }}" required>
            </div>

           

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
