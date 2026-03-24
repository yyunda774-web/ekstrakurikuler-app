{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.simple')

@section('content')
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
        </h1>
        <div class="text-muted">
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>


    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Ekstrakurikuler -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Ekstrakurikuler
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['total_ekskul'] ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-futbol fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Siswa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Siswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['total_siswa'] ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pendaftaran -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pendaftaran
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['total_pendaftaran'] ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendaftaran Pending -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Verification
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['pendaftaran_pending'] ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Pendaftaran Table -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history me-2"></i>Pendaftaran Terbaru
                    </h6>
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($pendaftaranTerbaru) && $pendaftaranTerbaru->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Ekstrakurikuler</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftaranTerbaru as $pendaftaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $pendaftaran->user->name ?? ($pendaftaran->nama ?? 'Tidak Diketahui') }}
                                        </td>
                                        <td>
                                            {{ $pendaftaran->ekstrakurikuler->nama ?? 'Ekstrakurikuler Dihapus' }}
                                            @if(!$pendaftaran->ekstrakurikuler)
                                                <br><small class="text-danger">(ID: {{ $pendaftaran->ekstrakurikuler_id }})</small>
                                            @endif
                                        </td>
                                        <td>{{ $pendaftaran->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @php
                                                $badgeClass = [
                                                    'pending' => 'warning',
                                                    'diterima' => 'success', 
                                                    'ditolak' => 'danger'
                                                ][$pendaftaran->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ ucfirst($pendaftaran->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                            <h5 class="text-gray-500">Belum ada pendaftaran</h5>
                            <p class="text-muted">Tidak ada data pendaftaran terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-link me-2"></i>Quick Links
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.ekstrakurikuler.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle me-2 text-success"></i>Tambah Ekstrakurikuler
                        </a>
                        <a href="{{ route('admin.pendaftaran.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-clipboard-list me-2 text-info"></i>Kelola Pendaftaran
                        </a>
                        <a href="{{ route('admin.siswa.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-users me-2 text-warning"></i>Data Siswa
                        </a>
                        <a href="{{ route('admin.statistik') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-chart-bar me-2 text-primary"></i>Statistik
                        </a>
                        <a href="{{ route('admin.laporan') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-file-alt me-2 text-secondary"></i>Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie me-2"></i>Statistik Cepat
                    </h6>
                    <a href="{{ route('admin.statistik') }}" class="btn btn-sm btn-primary">Detail</a>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="p-3 border rounded">
                                <h5 class="text-primary">{{ $stats['total_ekskul'] ?? 0 }}</h5>
                                <small class="text-muted">Ekstrakurikuler</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-3 border rounded">
                                <h5 class="text-success">{{ $stats['total_siswa'] ?? 0 }}</h5>
                                <small class="text-muted">Siswa Terdaftar</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-3 border rounded">
                                <h5 class="text-warning">{{ $stats['pendaftaran_pending'] ?? 0 }}</h5>
                                <small class="text-muted">Pending</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="small text-muted mb-1">Update terakhir: {{ now()->format('H:i') }}</p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: {{ min(100, ($stats['pendaftaran_pending'] ?? 0) * 10) }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .card {
        border-radius: 10px;
        border: 1px solid #e3e6f0;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    
    .border-left-primary {
        border-left: 4px solid #4e73df !important;
    }
    
    .border-left-success {
        border-left: 4px solid #1cc88a !important;
    }
    
    .border-left-info {
        border-left: 4px solid #36b9cc !important;
    }
    
    .border-left-warning {
        border-left: 4px solid #f6c23e !important;
    }
    
    .list-group-item {
        border: none;
        padding: 0.75rem 0;
        transition: all 0.3s;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fc;
        transform: translateX(5px);
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fc;
    }
</style>

@endsection