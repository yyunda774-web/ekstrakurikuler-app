@extends('layouts.app')

@section('title', $ekskul->nama . ' - Detail Ekstrakurikuler')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $ekskul->nama }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">{{ $ekskul->nama }}</h3>
                        <span class="badge bg-light text-dark fs-6">
                            {{ $ekskul->pendaftarans_count ?? 0 }} Pendaftar
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Ekstrakurikuler Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-user-tie fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Pembina</small>
                                    <h6 class="mb-0 fw-bold">{{ $ekskul->pembina }}</h6>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-calendar fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Hari</small>
                                    <h6 class="mb-0 fw-bold">{{ $ekskul->hari }}</h6>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-clock fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Waktu</small>
                                    <h6 class="mb-0 fw-bold">{{ $ekskul->waktu ?? 'Akan diinformasikan' }}</h6>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-users fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Kuota</small>
                                    <h6 class="mb-0 fw-bold">
                                        {{ $ekskul->pendaftarans_count ?? 0 }}/{{ $ekskul->kuota ?? '∞' }}
                                        @if($ekskul->kuota)
                                            <small class="text-muted">
                                                ({{ $ekskul->kuota - ($ekskul->pendaftarans_count ?? 0) }} tersedia)
                                            </small>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    @if($ekskul->deskripsi)
                    <div class="mb-4">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>Deskripsi
                        </h5>
                        <div class="bg-light p-4 rounded">
                            {!! nl2br(e($ekskul->deskripsi)) !!}
                        </div>
                    </div>
                    @endif

                    <!-- Action Button -->
                    @if(auth()->check() && auth()->user()->role == 'siswa')
                        @php
                            $sudahDaftar = auth()->user()->pendaftarans()
                                ->where('ekstrakurikuler_id', $ekskul->id)
                                ->exists();
                        @endphp
                        
                        <div class="mt-4">
                            @if($sudahDaftar)
                                <div class="alert alert-info">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Anda sudah mendaftar ekstrakurikuler ini.
                                    <a href="{{ route('dashboard') }}" class="alert-link">
                                        Lihat status di dashboard
                                    </a>
                                </div>
                            @else
                                @if($ekskul->kuota && ($ekskul->pendaftarans_count ?? 0) >= $ekskul->kuota)
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Maaf, kuota untuk ekstrakurikuler ini sudah penuh.
                                    </div>
                                @else
                                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="ekstrakurikuler_id" value="{{ $ekskul->id }}">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                            <i class="fas fa-tachometer-alt me-2"></i>Kembali ke Dashboard
                        </a>
                        <a href="{{ route('pendaftaran.umum') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>Daftar Ekstrakurikuler Lain
                        </a>
                        <a href="{{ route('cek-status') }}" class="btn btn-outline-info">
                            <i class="fas fa-search me-2"></i>Cek Status Pendaftaran
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistik Singkat -->
            <div class="card shadow border-0">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Pendaftar</span>
                            <span class="badge bg-primary rounded-pill">
                                {{ $ekskul->pendaftarans_count ?? 0 }}
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Kuota Tersedia</span>
                            <span class="badge bg-success rounded-pill">
                                @if($ekskul->kuota)
                                    {{ $ekskul->kuota - ($ekskul->pendaftarans_count ?? 0) }}
                                @else
                                    ∞
                                @endif
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Status</span>
                            <span class="badge {{ $ekskul->kuota && ($ekskul->pendaftarans_count ?? 0) < $ekskul->kuota ? 'bg-success' : 'bg-warning' }} rounded-pill">
                                {{ $ekskul->kuota && ($ekskul->pendaftarans_count ?? 0) < $ekskul->kuota ? 'Tersedia' : 'Hampir Penuh' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border-radius: 15px;
    }
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
    .bg-opacity-10 {
        opacity: 0.1;
    }
</style>
@endpush
@endsection