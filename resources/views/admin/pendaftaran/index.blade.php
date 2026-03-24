@extends('layouts.simple')

@section('content')
<div class="container-fluid">

    <!-- PAGE TITLE -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-clipboard-list me-2"></i> Data Pendaftaran
        </h1>
        <div>
            <a href="{{ route('admin.pendaftaran.export') }}" class="btn btn-success btn-sm">
                <i class="fas fa-file-excel me-1"></i> Export Excel
            </a>
            <a href="{{ route('admin.pendaftaran.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah
            </a>
        </div>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Daftar Pendaftaran</strong>
            <small class="text-muted">
                Total: {{ $pendaftarans->total() }} data
            </small>
        </div>

        <div class="card-body">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- TABLE --}}
            @if($pendaftarans->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Ekstrakurikuler</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th width="220">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftarans as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($pendaftarans->currentPage() - 1) * $pendaftarans->perPage() }}
                                    </td>

                                    <td>
                                        <strong>{{ $item->kode_pendaftaran ?? '-' }}</strong>
                                    </td>

                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas }}</td>

                                    <td>
                                        {{ $item->ekstrakurikuler->nama ?? 'Ekskul Dihapus' }}
                                    </td>

                                    <td>
                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        <span class="badge bg-{{ 
                                            $item->status === 'diterima' ? 'success' :
                                            ($item->status === 'ditolak' ? 'danger' : 'warning')
                                        }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">

                                            {{-- VIEW --}}
                                            <a href="{{ route('admin.pendaftaran.show', $item->id) }}"
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.pendaftaran.edit', $item->id) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- TERIMA & TOLAK (HANYA JIKA PENDING) --}}
                                            @if($item->status === 'pending')
 
                                                <form action="{{ route('admin.pendaftaran.terima', $item->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="btn btn-success btn-sm"
                                                            onclick="return confirm('Terima siswa ini?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.pendaftaran.tolak', $item->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Tolak siswa ini?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>

                                            @endif

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.pendaftaran.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $pendaftarans->links() }}
                </div>

            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-inbox fa-3x mb-3"></i>
                    <p>Belum ada data pendaftaran</p>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection