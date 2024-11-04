@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="container">
        <h1>Add New Category</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3">Back to Categories</a>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
@endsection
