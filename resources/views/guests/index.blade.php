@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guests</h1>
        <a href="{{ route('guests.create') }}" class="btn btn-primary mb-3">Add Guest</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $guest)
                    <tr>
                        <td>{{ $guest->guest_id }}</td>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->email }}</td>
                        <td>{{ $guest->hp }}</td>
                        <td>{{ $guest->address }}</td>
                        <td>
                            <a href="{{ route('guests.edit', $guest->guest_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('guests.destroy', $guest->guest_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
