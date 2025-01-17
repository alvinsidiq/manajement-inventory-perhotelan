@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Laporan Kerusakan dan Kehilangan Barang</h1>

    <form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="rusak" {{ $laporan->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="hilang" {{ $laporan->status == 'hilang' ? 'selected' : '' }}>Hilang</option>
                <option value="baik" {{ $laporan->status == 'baik' ? 'selected' : '' }}>Baik</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Laporan</button>
    </form>
</div>
@endsection
