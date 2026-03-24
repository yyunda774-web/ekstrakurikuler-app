@extends('layouts.simple')

@section('title', 'Manajemen Siswa')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-users me-2"></i>Manajemen Siswa
            </h1>
            <p class="mb-0">Kelola data siswa yang terdaftar di sistem</p>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Siswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $siswa->total() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Siswa Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $siswa->total() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-search me-1"></i>Cari Siswa
            </h6>
            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-1"></i>Filter
            </a>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.siswa.index') }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Cari nama atau email..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" 
                               name="kelas" 
                               class="form-control" 
                               placeholder="Filter kelas..."
                               value="{{ request('kelas') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i>Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list me-1"></i>Daftar Siswa
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="siswaTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>No. HP</th>
                            <th>Jumlah Pendaftaran</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $item)
                        <tr>
                            <td>{{ $loop->iteration + (($siswa->currentPage() - 1) * $siswa->perPage()) }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <span class="badge bg-info">{{ $item->kelas }}</span>
                            </td>
                            <td>{{ $item->no_hp }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $item->pendaftarans_count }}</span>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.siswa.edit', $item->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger" 
                                            title="Hapus"
                                            onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}" 
                                          action="{{ route('admin.siswa.destroy', $item->id) }}" 
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-3"></i>
                                    <p class="mb-0">Belum ada data siswa</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($siswa->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $siswa->withQueryString()->links() }}
            </div>
            @endif
            
            <!-- Info -->
            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                Total: <strong>{{ $siswa->total() }}</strong> siswa | 
                Menampilkan: <strong>{{ $siswa->count() }}</strong> data
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('admin.siswa.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-filter me-2"></i>Filter Siswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Urutkan Berdasarkan</label>
                        <select name="sort" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Filter Kelas</label>
                        <input type="text" name="kelas_filter" class="form-control" 
                               placeholder="Contoh: X-10" value="{{ request('kelas_filter') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Reset</a>
                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus siswa "${name}"?`)) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }
    
    // Auto refresh page every 30 seconds
    setTimeout(() => {
        window.location.reload();
    }, 30000);
</script>

@push('styles')
<style>
    .table th {
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
    .table td {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.4em 0.8em;
    }
</style>
@endpush
@endsection