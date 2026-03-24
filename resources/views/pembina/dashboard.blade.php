@extends('layouts.pembina')

@section('content')

<div class="container mt-4">

    <h3 class="mb-4">Daftar Pendaftar Ekstrakurikuler</h3>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('pembina.dashboard') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari nama / kelas..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    {{-- FILTER --}}
    <div class="mb-3">
        <a href="{{ route('pembina.dashboard') }}" class="btn btn-secondary btn-sm">Semua</a>
        <a href="{{ route('pembina.dashboard', ['status' => 'pending']) }}" class="btn btn-warning btn-sm">Pending</a>
        <a href="{{ route('pembina.dashboard', ['status' => 'diterima']) }}" class="btn btn-success btn-sm">Diterima</a>
        <a href="{{ route('pembina.dashboard', ['status' => 'ditolak']) }}" class="btn btn-danger btn-sm">Ditolak</a>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Ekskul</th>
                        <th>Status</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($pendaftarans as $data)
                    <tr>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td>{{ $data->ekstrakurikuler->nama }}</td>

                        <td>
                            @if($data->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($data->status == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>

                        <td>
                            @if($data->status == 'pending')

                                <form action="{{ route('pembina.pendaftaran.terima',$data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">Terima</button>
                                </form>

                                <form action="{{ route('pembina.pendaftaran.tolak',$data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger btn-sm">Tolak</button>
                                </form>

                            @else
                                <span class="text-muted">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">Belum ada pendaftar</td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection