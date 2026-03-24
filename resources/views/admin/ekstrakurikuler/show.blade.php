{{-- resources/views/admin/ekstrakurikuler/show.blade.php --}}
@extends('layouts.simple')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-light">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ekstrakurikuler.index') }}">Ekstrakurikuler</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0"><i class="fas fa-eye text-primary me-2"></i>Detail Ekstrakurikuler</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('admin.ekstrakurikuler.edit', $ekstrakurikuler->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="row">
        <!-- Informasi Utama -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Ekstrakurikuler</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama Ekstrakurikuler</label>
                            <h5 class="mb-0 text-primary">{{ $ekstrakurikuler->nama }}</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Pembina</label>
                            <h5 class="mb-0">{{ $ekstrakurikuler->pembina ?? '-' }}</h5>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Kuota Peserta</label>
                            <div>
                                @if($ekstrakurikuler->kuota)
                                    <span class="badge bg-info fs-6">{{ $ekstrakurikuler->kuota }} peserta</span>
                                @else
                                    <span class="badge bg-secondary fs-6">Tidak terbatas</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Status</label>
                            <div>
                                <span class="badge bg-success fs-6">
                                    <i class="fas fa-check-circle me-1"></i> Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Jadwal</label>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                            <span class="me-4">{{ $ekstrakurikuler->hari ?? 'Belum diatur' }}</span>
                            <i class="fas fa-clock text-primary me-2"></i>
                            <span>{{ $ekstrakurikuler->jam ?? 'Belum diatur' }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-0">
                        <label class="form-label text-muted small">Deskripsi</label>
                        <div class="border rounded p-3 bg-light">
                            @if($ekstrakurikuler->deskripsi)
                                {{ $ekstrakurikuler->deskripsi }}
                            @else
                                <span class="text-muted">Tidak ada deskripsi</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Stats -->
        <div class="col-lg-4">
            <!-- Statistik Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="display-4 text-primary mb-2">
                            <!-- Ganti dengan jumlah peserta sebenarnya -->
                            0
                        </div>
                        <p class="text-muted mb-0">Jumlah Peserta</p>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Kuota Tersedia</span>
                            @if($ekstrakurikuler->kuota)
                                <span class="badge bg-primary">{{ $ekstrakurikuler->kuota }} kursi</span>
                            @else
                                <span class="badge bg-secondary">Tidak terbatas</span>
                            @endif
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Tanggal Dibuat</span>
                            <span class="text-muted">{{ $ekstrakurikuler->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Terakhir Diupdate</span>
                            <span class="text-muted">{{ $ekstrakurikuler->updated_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            <div class="card shadow">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.ekstrakurikuler.edit', $ekstrakurikuler->id) }}" 
                           class="btn btn-warning btn-lg">
                            <i class="fas fa-edit me-2"></i> Edit Data
                        </a>
                        
                        <button type="button" class="btn btn-outline-primary btn-lg" 
                                onclick="copyToClipboard('{{ route('ekskul.detail', $ekstrakurikuler->id) }}')">
                            <i class="fas fa-link me-2"></i> Copy Link
                        </button>
                        
                        <button type="button" class="btn btn-success btn-lg">
                            <i class="fas fa-qrcode me-2"></i> Generate QR Code
                        </button>
                        
                        <form action="{{ route('admin.ekstrakurikuler.destroy', $ekstrakurikuler->id) }}" 
                              method="POST" class="d-grid" 
                              onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="fas fa-trash me-2"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peserta Terdaftar (Jika ada) -->
    <div class="card shadow mt-4">
        <div class="card-header bg-secondary text-white py-3">
            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Peserta Terdaftar</h5>
        </div>
        <div class="card-body">
            <div class="text-center py-5">
                <i class="fas fa-user-friends fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada peserta terdaftar</h5>
                <p class="text-muted">Siswa dapat mendaftar melalui halaman pendaftaran</p>
                <a href="#" class="btn btn-outline-primary">
                    <i class="fas fa-external-link-alt me-1"></i> Lihat Halaman Pendaftaran
                </a>
            </div>
            
            <!-- Jika ada peserta, tampilkan tabel -->
            {{-- 
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data peserta akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
            --}}
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        border: none;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    
    .badge {
        font-size: 0.85em;
        padding: 0.5em 0.8em;
    }
    
    .list-group-item {
        border: none;
        padding: 0.75rem 0;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    
    .display-4 {
        font-weight: 300;
    }
    
    .bg-light {
        background-color: #f8f9fc !important;
    }
</style>

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show position-fixed top-3 end-3';
            alert.style.zIndex = '9999';
            alert.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>Link berhasil disalin!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alert);
            
            // Auto remove alert
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }).catch(function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
    
    // QR Code Generator (contoh sederhana)
    function generateQRCode() {
        const url = '{{ route("ekskul.detail", $ekstrakurikuler->id) }}';
        // Implement QR code generation here
        alert('QR Code untuk: ' + url);
    }
</script>
@endpush
@endsection