@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3">Back to Categories</a>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
@endsection
