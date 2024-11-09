@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Guest</h1>
        <form action="{{ route('guests.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="hp">Phone</label>
                <input type="text" name="hp" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('guests.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
