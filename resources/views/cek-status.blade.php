@extends('layouts.simple')

@section('title', 'Cek Status Pendaftaran')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold mb-3" style="color: var(--primary);">
                    <i class="fas fa-search-check me-2"></i>Cek Status Pendaftaran
                </h1>
                <p class="lead text-muted">
                    Masukkan kode pendaftaran untuk melihat status pendaftaran ekstrakurikuler Anda
                </p>
            </div>

            <!-- Main Card -->
            <div class="main-card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-ticket-alt me-2"></i>Verifikasi Pendaftaran
                    </h4>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Error/Success Messages -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                                <div>
                                    <h6 class="mb-1">Kode Tidak Ditemukan</h6>
                                    <p class="mb-0">{{ session('error') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Search Form -->
                    @if(!isset($pendaftaran))
                    <form method="GET" action="{{ route('cek-status') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="kode_pendaftaran" class="form-label fw-semibold mb-3">
                                <i class="fas fa-barcode me-2"></i>Kode Pendaftaran
                            </label>
                            <div class="input-group input-group-lg mb-3">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-key text-primary"></i>
                                </span>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="kode_pendaftaran" 
                                       name="kode_pendaftaran"
                                       value="{{ old('kode_pendaftaran') }}"
                                       placeholder="Contoh: REG-AB12CD34 atau USER-ABCD1234"
                                       required>
                            </div>
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Kode dapat ditemukan di email konfirmasi atau bukti pendaftaran Anda</small>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-gradient btn-lg">
                                <i class="fas fa-search me-2"></i>Cek Status Sekarang
                            </button>
                        </div>
                    </form>
                    @endif

                    <!-- Results Section -->
                    @if(isset($pendaftaran))
                    <div class="mt-5 pt-4 border-top">
                        
                        <!-- Status Indicator -->
                        <div class="text-center mb-5">
                            @php
                                $statusConfig = [
                                    'pending' => ['color' => 'warning', 'icon' => 'clock', 'text' => 'Menunggu Verifikasi'],
                                    'diterima' => ['color' => 'success', 'icon' => 'check-circle', 'text' => 'Diterima'],
                                    'ditolak' => ['color' => 'danger', 'icon' => 'times-circle', 'text' => 'Ditolak']
                                ];
                                $config = $statusConfig[$pendaftaran->status];
                            @endphp
                            
                            <div class="d-inline-block p-4 rounded-4 bg-{{ $config['color'] }}-subtle border border-{{ $config['color'] }}-subtle">
                                <i class="fas fa-{{ $config['icon'] }} fa-3x text-{{ $config['color'] }} mb-3"></i>
                                <h3 class="text-{{ $config['color'] }} fw-bold mb-2">
                                    {{ $config['text'] }}
                                </h3>
                                <p class="text-muted mb-0">
                                    @if($pendaftaran->status == 'pending')
                                        Admin akan memverifikasi pendaftaran Anda dalam 1-3 hari kerja
                                    @elseif($pendaftaran->status == 'diterima')
                                        Selamat! Anda telah diterima di ekstrakurikuler ini
                                    @else
                                        Maaf, pendaftaran Anda tidak dapat diterima
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Two Column Layout -->
                        <div class="row g-4">
                            <!-- Left Column - Data Peserta -->
                            <div class="col-md-6">
                                <div class="info-card p-4 h-100">
                                    <h5 class="fw-bold mb-4" style="color: var(--primary);">
                                        <i class="fas fa-user-graduate me-2"></i>Data Peserta
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-hashtag text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">Kode Pendaftaran</small>
                                                <h6 class="mb-0 fw-bold">{{ $pendaftaran->kode_pendaftaran }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-user text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">Nama Lengkap</small>
                                                <h6 class="mb-0 fw-bold">{{ $pendaftaran->nama }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-users text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">Kelas</small>
                                                <h6 class="mb-0 fw-bold">{{ $pendaftaran->kelas }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-phone text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">No. Telepon</small>
                                                <h6 class="mb-0 fw-bold">{{ $pendaftaran->no_hp }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 pt-3 border-top">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">Tanggal Pendaftaran</small>
                                                <h6 class="mb-0 fw-bold">
                                                    {{ $pendaftaran->created_at->translatedFormat('l, d F Y') }}
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $pendaftaran->created_at->format('H:i') }} WIB
                                                    </small>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column - Ekstrakurikuler -->
                            <div class="col-md-6">
                                <div class="info-card p-4 h-100">
                                    <h5 class="fw-bold mb-4" style="color: var(--primary);">
                                        <i class="fas fa-futbol me-2"></i>Ekstrakurikuler
                                    </h5>
                                    
                                    <div class="mb-4">
                                        <h4 class="fw-bold text-primary">{{ $pendaftaran->ekstrakurikuler->nama }}</h4>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-user-tie text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">Pembina</small>
                                                <h6 class="mb-0 fw-bold">{{ $pendaftaran->ekstrakurikuler->pembina }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-calendar-day text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">Hari</small>
                                                <h6 class="mb-0 fw-bold">{{ $pendaftaran->ekstrakurikuler->hari }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-clock text-primary me-3"></i>
                                            <div>
                                                <small class="text-muted">Waktu</small>
                                                <h6 class="mb-0 fw-bold">{{ $pendaftaran->ekstrakurikuler->waktu ?? 'Akan diinformasikan' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($pendaftaran->ekstrakurikuler->deskripsi)
                                    <div class="mt-4 pt-3 border-top">
                                        <small class="text-muted">Deskripsi</small>
                                        <p class="mb-0">{{ $pendaftaran->ekstrakurikuler->deskripsi }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Admin -->
                        @if($pendaftaran->catatan)
                        <div class="alert alert-info mt-4">
                            <div class="d-flex">
                                <i class="fas fa-sticky-note fa-2x me-3 mt-1"></i>
                                <div>
                                    <h6 class="alert-heading mb-2">
                                        <i class="fas fa-microphone me-1"></i>Catatan dari Admin:
                                    </h6>
                                    <p class="mb-0">{{ $pendaftaran->catatan }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3">
                            <a href="{{ route('cek-status.umum') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-redo me-1"></i>Cek Kode Lain
                            </a>
                            
                            <div class="d-flex gap-2">
                                @if($pendaftaran->status == 'diterima')
                                    <a href="{{ route('cetak.bukti', $pendaftaran->kode_pendaftaran) }}" 
                                       class="btn btn-success" target="_blank">
                                        <i class="fas fa-print me-1"></i>Cetak Bukti
                                    </a>
                                @endif
                                
                                <a href="{{ route('home') }}" class="btn btn-primary">
                                    <i class="fas fa-home me-1"></i>Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="text-center mt-4">
                <p class="text-muted">
                    <i class="fas fa-question-circle me-1"></i>
                    Butuh bantuan? 
                    <a href="#" class="text-decoration-none">Hubungi Admin</a> | 
                    <a href="{{ route('home') }}" class="text-decoration-none">Lihat Ekstrakurikuler</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto select input text
    document.getElementById('kode_pendaftaran')?.addEventListener('click', function() {
        this.select();
    });
    
    // Form validation
    (function() {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush