@extends('layouts.simple')

@section('title', 'Tambah Pendaftaran')

@section('content')

<div class="container-fluid">

    <h4 class="mb-4">
        <i class="fas fa-user-plus"></i> Tambah Pendaftaran Siswa
    </h4>

    {{-- NOTIFIKASI ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.pendaftaran.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- NAMA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ old('nama') }}"
                               required>
                    </div>

                    {{-- KELAS --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text"
                               name="kelas"
                               class="form-control"
                               placeholder="Contoh: X RPL 1"
                               value="{{ old('kelas') }}"
                               required>
                    </div>

                    {{-- NO HP --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text"
                               name="no_hp"
                               class="form-control"
                               value="{{ old('no_hp') }}"
                               required>
                    </div>

                    {{-- EKSTRAKURIKULER --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ekstrakurikuler</label>
                        <select name="ekstrakurikuler_id"
                                class="form-select"
                                required>
                            <option value="">-- Pilih Ekskul --</option>
                            @foreach($ekstrakurikuler as $ekskul)
                                <option value="{{ $ekskul->id }}">
                                    {{ $ekskul->nama }}
                                    @if(!is_null($ekskul->kuota))
                                        (Kuota: {{ $ekskul->kuota }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Awal</label>
                        <select name="status" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    {{-- CATATAN ADMIN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <input type="text"
                               name="catatan"
                               class="form-control"
                               value="{{ old('catatan') }}">
                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('admin.pendaftaran.index') }}"
                       class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        💾 Simpan Pendaftaran
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection