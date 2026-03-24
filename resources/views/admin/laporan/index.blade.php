@extends('layouts.app')

@section('title', 'Laporan Pendaftaran')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-file-alt me-2"></i>Laporan Pendaftaran
            </h1>
            <p class="mb-0">Data lengkap semua pendaftaran ekstrakurikuler</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Dashboard
            </a>
            <a href="{{ route('admin.laporan.cetak') }}" target="_blank" class="btn btn-primary">
                <i class="fas fa-print me-1"></i>Cetak Laporan
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter me-2"></i>Filter Laporan
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.laporan') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" 
                               value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control" 
                               value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ekstrakurikuler</label>
                        <select name="ekstrakurikuler_id" class="form-select">
                            <option value="">Semua Ekskul</option>
                            @foreach(App\Models\Ekstrakurikuler::all() as $ekskul)
                                <option value="{{ $ekskul->id }}" 
                                        {{ request('ekstrakurikuler_id') == $ekskul->id ? 'selected' : '' }}>
                                    {{ $ekskul->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i>Terapkan Filter
                            </button>
                            <a href="{{ route('admin.laporan') }}" class="btn btn-secondary">
                                <i class="fas fa-redo me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table me-1"></i>Data Pendaftaran
            </h6>
            <span class="badge bg-info">
                Total: {{ $pendaftaran->total() }} data
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>No. HP</th>
                            <th>Ekstrakurikuler</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>Admin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaran as $item)
                        <tr>
                            <td>{{ $loop->iteration + (($pendaftaran->currentPage() - 1) * $pendaftaran->perPage()) }}</td>
                            <td>
                                <span class="badge bg-info">{{ $item->kode_pendaftaran }}</span>
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->ekstrakurikuler->nama }}</td>
                            <td>
                                @php
                                    $statusColor = [
                                        'pending' => 'warning',
                                        'diterima' => 'success',
                                        'ditolak' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColor[$item->status] }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($item->user)
                                    {{ $item->user->name }}
                                @else
                                    <span class="text-muted">Pendaftaran Umum</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.pendaftaran.edit', $item->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('cetak.bukti', $item->kode_pendaftaran) }}" 
                                       target="_blank" class="btn btn-sm btn-info" title="Cetak">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3"></i>
                                    <p class="mb-0">Tidak ada data pendaftaran</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($pendaftaran->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $pendaftaran->withQueryString()->links() }}
            </div>
            @endif
            
            <!-- Summary -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card border-primary">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Pendaftaran</h5>
                            <h3 class="text-primary">{{ $pendaftaran->total() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">Diterima</h5>
                            <h3 class="text-success">
                                {{ $pendaftaran->where('status', 'diterima')->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-warning">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pending</h5>
                            <h3 class="text-warning">
                                {{ $pendaftaran->where('status', 'pending')->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    .badge {
        font-size: 0.8rem;
        padding: 0.35rem 0.65rem;
    }
</style>
@endpush
@endsection