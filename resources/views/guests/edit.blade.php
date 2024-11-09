@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Guest</h1>
        <form action="{{ route('guests.update', $guest->guest_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $guest->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $guest->email }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="hp">Phone</label>
                <input type="text" name="hp" class="form-control" value="{{ $guest->hp }}">
            </div>
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <textarea name="address" class="form-control">{{ $guest->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('guests.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
