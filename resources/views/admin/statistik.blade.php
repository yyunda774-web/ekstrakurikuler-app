@extends('layouts.simple')

@section('title', 'Statistik Pendaftaran')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-chart-line me-2"></i>Statistik Pendaftaran
            </h1>
            <p class="mb-0">Analisis data pendaftaran ekstrakurikuler</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Dashboard
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-1"></i>Cetak
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pendaftaran
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['status_distribution']->sum('total') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
                                Diterima
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['status_distribution']->where('status', 'diterima')->first()->total ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['status_distribution']->where('status', 'pending')->first()->total ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Ditolak
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['status_distribution']->where('status', 'ditolak')->first()->total ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Status Distribution -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie me-1"></i>Distribusi Status Pendaftaran
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Ekstrakurikuler -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-trophy me-1"></i>Top 5 Ekstrakurikuler
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ekstrakurikuler</th>
                                    <th>Pembina</th>
                                    <th class="text-center">Pendaftar</th>
                                    <th class="text-center">Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPendaftar = $stats['total_per_ekskul']->sum('pendaftarans_count');
                                @endphp
                                @foreach($stats['top_ekskul'] as $ekskul)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ekskul->nama }}</td>
                                    <td>{{ $ekskul->pembina }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $ekskul->pendaftarans_count }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" 
                                                 role="progressbar" 
                                                 style="width: {{ $totalPendaftar > 0 ? ($ekskul->pendaftarans_count / $totalPendaftar * 100) : 0 }}%"
                                                 aria-valuenow="{{ $ekskul->pendaftarans_count }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="{{ $totalPendaftar }}">
                                                {{ $totalPendaftar > 0 ? number_format(($ekskul->pendaftarans_count / $totalPendaftar * 100), 1) : 0 }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Statistics -->
    <div class="row">
        <!-- Pendaftaran Per Hari -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar-alt me-1"></i>Pendaftaran 7 Hari Terakhir
                    </h6>
                </div>
                <div class="card-body">
                    @if($stats['pendaftaran_per_hari']->count() > 0)
                        <canvas id="dailyChart" height="200"></canvas>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data pendaftaran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Per Ekskul -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-list-alt me-1"></i>Detail Per Ekstrakurikuler
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Ekstrakurikuler</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Diterima</th>
                                    <th class="text-center">Pending</th>
                                    <th class="text-center">Ditolak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['total_per_ekskul'] as $ekskul)
                                <tr>
                                    <td>{{ Str::limit($ekskul->nama, 20) }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-dark">{{ $ekskul->pendaftarans_count }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">
                                            {{ $ekskul->pendaftarans->where('status', 'diterima')->count() }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">
                                            {{ $ekskul->pendaftarans->where('status', 'pending')->count() }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">
                                            {{ $ekskul->pendaftarans->where('status', 'ditolak')->count() }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Section -->
    <div class="card shadow mt-4">
        <div class="card-header bg-light py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-download me-1"></i>Export Data
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="#" class="btn btn-outline-primary w-100">
                        <i class="fas fa-file-excel me-2"></i>Export ke Excel
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#" class="btn btn-outline-success w-100">
                        <i class="fas fa-file-pdf me-2"></i>Export ke PDF
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#" class="btn btn-outline-info w-100">
                        <i class="fas fa-chart-bar me-2"></i>Generate Report
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusData = {
        labels: [
            'Diterima', 
            'Pending', 
            'Ditolak'
        ],
        datasets: [{
            data: [
                {{ $stats['status_distribution']->where('status', 'diterima')->first()->total ?? 0 }},
                {{ $stats['status_distribution']->where('status', 'pending')->first()->total ?? 0 }},
                {{ $stats['status_distribution']->where('status', 'ditolak')->first()->total ?? 0 }}
            ],
            backgroundColor: [
                '#28a745',
                '#ffc107',
                '#dc3545'
            ],
            borderWidth: 1
        }]
    };
    
    new Chart(statusCtx, {
        type: 'doughnut',
        data: statusData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Daily Chart
    @if($stats['pendaftaran_per_hari']->count() > 0)
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    const dailyData = {
        labels: [
            @foreach($stats['pendaftaran_per_hari']->reverse() as $data)
                "{{ \Carbon\Carbon::parse($data->tanggal)->format('d/m') }}",
            @endforeach
        ],
        datasets: [{
            label: 'Jumlah Pendaftaran',
            data: [
                @foreach($stats['pendaftaran_per_hari']->reverse() as $data)
                    {{ $data->total }},
                @endforeach
            ],
            backgroundColor: 'rgba(67, 97, 238, 0.2)',
            borderColor: 'rgba(67, 97, 238, 1)',
            borderWidth: 2,
            fill: true
        }]
    };
    
    new Chart(dailyCtx, {
        type: 'line',
        data: dailyData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
    @endif
</script>
@endpush

@push('styles')
<style>
    @media print {
        .btn, nav, .card-header .d-flex {
            display: none !important;
        }
        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
        }
    }
    
    .progress {
        border-radius: 10px;
        overflow: hidden;
    }
    .progress-bar {
        font-size: 0.8rem;
        line-height: 20px;
    }
</style>
@endpush
@endsection