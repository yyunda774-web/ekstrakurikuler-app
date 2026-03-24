@extends('layouts.simple')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Pendaftaran</h3>

    <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $pendaftaran->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control"
                   value="{{ old('kelas', $pendaftaran->kelas) }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control"
                   value="{{ old('no_hp', $pendaftaran->no_hp) }}" required>
        </div>

        <div class="mb-3">
            <label>Ekstrakurikuler</label>
            <select name="ekstrakurikuler_id" class="form-control" required>
                @foreach($ekstrakurikuler as $eks)
                    <option value="{{ $eks->id }}"
                        {{ $pendaftaran->ekstrakurikuler_id == $eks->id ? 'selected' : '' }}>
                        {{ $eks->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ $pendaftaran->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $pendaftaran->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control">{{ old('catatan', $pendaftaran->catatan) }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection