{{-- resources/views/admin/ekstrakurikuler/edit.blade.php --}}
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
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0"><i class="fas fa-edit text-warning me-2"></i>Edit Ekstrakurikuler</h1>
            <p class="text-muted mb-0">ID: #{{ $ekstrakurikuler->id }} • Terakhir diupdate: {{ $ekstrakurikuler->updated_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.ekstrakurikuler.show', $ekstrakurikuler->id) }}" class="btn btn-outline-info">
                <i class="fas fa-eye me-1"></i> Lihat
            </a>
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-lg border-0 rounded-xl overflow-hidden">
        <!-- Card Header -->
        <div class="card-header bg-warning text-white border-bottom-0 pt-4 pb-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="h4 mb-0">Edit Data: <strong>{{ $ekstrakurikuler->nama }}</strong></h3>
                    <p class="mb-0">Ubah data ekstrakurikuler sesuai kebutuhan</p>
                </div>
                <div class="col-auto">
                    <span class="badge bg-white text-warning px-3 py-2">
                        <i class="fas fa-exclamation-triangle me-1"></i> Mode Edit
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <div class="card-body p-5">
            <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id) }}" method="POST" id="editEkskulForm">
                @csrf
                @method('PUT')

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> Terdapat kesalahan dalam pengisian form
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Row 1: Nama & Pembina -->
                <div class="row g-4 mb-4">
                    <!-- Nama Ekstrakurikuler -->
                    <div class="col-md-6">
                        <div class="form-group position-relative">
                            <label class="form-label fw-semibold text-gray-800 mb-2">
                                <span class="text-danger">*</span> Nama Ekstrakurikuler
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-soft-warning border-end-0">
                                    <i class="fas fa-graduation-cap text-warning"></i>
                                </span>
                                <input type="text" name="nama" class="form-control ps-2" 
                                       value="{{ old('nama', $ekstrakurikuler->nama) }}" 
                                       placeholder="Masukkan nama ekstrakurikuler" required>
                            </div>
                            <div class="form-text d-flex align-items-center mt-2">
                                <i class="fas fa-info-circle text-warning me-2 fs-sm"></i>
                                <span>Wajib diisi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pembina -->
                    <div class="col-md-6">
                        <div class="form-group position-relative">
                            <label class="form-label fw-semibold text-gray-800 mb-2">
                                Pembina
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-soft-success border-end-0">
                                    <i class="fas fa-chalkboard-teacher text-success"></i>
                                </span>
                                <input type="text" name="pembina" class="form-control ps-2" 
                                       value="{{ old('pembina', $ekstrakurikuler->pembina) }}" 
                                       placeholder="Masukkan nama pembina">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-5">
                    <div class="form-group">
                        <label class="form-label fw-semibold text-gray-800 mb-2">
                            Deskripsi
                        </label>
                        <div class="position-relative">
                            <textarea name="deskripsi" class="form-control form-control-lg" 
                                      rows="4" placeholder="Masukkan deskripsi ekstrakurikuler...">{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                            <div class="form-text d-flex align-items-center mt-2">
                                <i class="fas fa-lightbulb text-info me-2 fs-sm"></i>
                                <span>Jelaskan kegiatan, tujuan, dan manfaat ekstrakurikuler ini</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Kuota, Hari, Waktu -->
                <div class="row g-4 mb-5">
                    <!-- Kuota Peserta -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-semibold text-gray-800 mb-2">
                                Kuota Peserta
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-soft-info border-end-0">
                                    <i class="fas fa-users text-info"></i>
                                </span>
                                <input type="number" name="kuota" class="form-control ps-2" 
                                       value="{{ old('kuota', $ekstrakurikuler->kuota) }}" 
                                       placeholder="Masukkan angka" min="1">
                            </div>
                            <div class="form-text d-flex align-items-center mt-2">
                                <i class="fas fa-infinity text-secondary me-2 fs-sm"></i>
                                <span>Kosongkan untuk tidak terbatas</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hari Pelaksanaan -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-semibold text-gray-800 mb-2">
                                Hari Pelaksanaan
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-soft-primary border-end-0">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </span>
                                <input type="text" name="hari" class="form-control ps-2" 
                                       value="{{ old('hari', $ekstrakurikuler->hari) }}" 
                                       placeholder="Contoh: Senin & Kamis">
                            </div>
                        </div>
                    </div>

                    <!-- Waktu Pelaksanaan -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-semibold text-gray-800 mb-2">
                                Waktu Pelaksanaan
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-soft-danger border-end-0">
                                    <i class="fas fa-clock text-danger"></i>
                                </span>
                                <input type="text" name="jam" class="form-control ps-2" 
                                       value="{{ old('jam', $ekstrakurikuler->jam) }}" 
                                       placeholder="Contoh: 15.00 - 17.00 WIB">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="alert alert-soft-info border-0 mb-5">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-info-circle fs-4 text-info"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="alert-heading mb-2">Informasi Perubahan</h6>
                            <p class="mb-2">Perubahan yang dilakukan akan langsung diterapkan. Pastikan data yang dimasukkan sudah benar.</p>
                            <div class="row small text-muted">
                                <div class="col-md-6">
                                    <i class="fas fa-calendar-plus me-1"></i> Dibuat: {{ $ekstrakurikuler->created_at->format('d/m/Y H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <i class="fas fa-calendar-check me-1"></i> Update terakhir: {{ $ekstrakurikuler->updated_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="position-relative my-5">
                    <hr class="border-2">
                    <div class="divider-text bg-white px-3 position-absolute top-50 start-50 translate-middle">
                        <i class="fas fa-save text-warning me-2"></i>Simpan Perubahan
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center pt-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-history text-muted fs-4"></i>
                        </div>
                        <div>
                            <p class="mb-0 text-muted fw-medium">Riwayat Perubahan</p>
                            <small class="text-muted">Pastikan perubahan sudah diverifikasi</small>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-lg btn-outline-secondary px-4 rounded-pill" 
                                onclick="window.location.href='{{ route('admin.ekstrakurikuler.index') }}'">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        
                        <button type="reset" class="btn btn-lg btn-outline-warning px-4 rounded-pill">
                            <i class="fas fa-redo-alt me-2"></i>Reset
                        </button>
                        
                        <button type="submit" class="btn btn-lg btn-warning px-4 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Card Footer -->
        <div class="card-footer bg-soft-light border-top-0 py-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-exclamation-triangle text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Peringatan</h6>
                            <p class="mb-0 small">Perubahan kuota akan mempengaruhi pendaftaran siswa baru.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-user-check text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Peserta Terdaftar</h6>
                            <p class="mb-0 small">Perubahan tidak akan mempengaruhi peserta yang sudah terdaftar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Variables */
    :root {
        --warning: #f6c23e;
        --warning-soft: #fef8e7;
        --primary: #4e73df;
        --primary-soft: #eef2ff;
        --success: #1cc88a;
        --success-soft: #e8f7f1;
        --info: #36b9cc;
        --info-soft: #eaf9fc;
        --danger: #e74a3b;
        --danger-soft: #fdeaea;
    }

    /* Base Styles */
    .rounded-xl {
        border-radius: 1rem !important;
    }

    .card {
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    /* Form Controls */
    .form-control {
        border: 2px solid #e3e6f0;
        border-left: 0;
        border-radius: 0 0.5rem 0.5rem 0 !important;
        transition: all 0.3s ease;
        font-size: 1rem;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        border-color: var(--warning);
        box-shadow: 0 0 0 0.25rem rgba(246, 194, 62, 0.15);
        transform: translateY(-1px);
    }

    .form-control-lg {
        min-height: 3.5rem;
    }

    /* Input Groups */
    .input-group-text {
        border: 2px solid #e3e6f0;
        border-right: 0;
        border-radius: 0.5rem 0 0 0.5rem !important;
        background-color: white;
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
    }

    .bg-soft-warning { background-color: var(--warning-soft) !important; }
    .bg-soft-primary { background-color: var(--primary-soft) !important; }
    .bg-soft-success { background-color: var(--success-soft) !important; }
    .bg-soft-info { background-color: var(--info-soft) !important; }
    .bg-soft-danger { background-color: var(--danger-soft) !important; }
    .bg-soft-light { background-color: #f8f9fc !important; }

    /* Buttons */
    .btn-warning {
        background: linear-gradient(135deg, var(--warning), #da9a00);
        border: none;
        color: #212529;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #da9a00, var(--warning));
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(246, 194, 62, 0.3);
        color: #212529;
    }

    .btn-outline-warning {
        border: 2px solid var(--warning);
        color: var(--warning);
    }

    .btn-outline-warning:hover {
        background-color: var(--warning-soft);
        border-color: var(--warning);
        transform: translateY(-2px);
    }

    .btn-outline-secondary:hover {
        border-color: #d1d3e2;
        background-color: #f8f9fc;
        transform: translateY(-2px);
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    /* Alert */
    .alert-soft-info {
        background-color: var(--info-soft);
        color: #2c9faf;
        border: 1px solid rgba(54, 185, 204, 0.2);
    }

    /* Badge */
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    /* Divider */
    .divider-text {
        color: var(--warning);
        font-weight: 600;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    /* Breadcrumb */
    .breadcrumb-light .breadcrumb-item.active {
        color: var(--warning);
        font-weight: 600;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
        
        .btn-lg {
            padding: 0.625rem 1.5rem;
        }
        
        .d-flex.gap-3 {
            gap: 1rem !important;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editEkskulForm');
        const namaInput = form.querySelector('input[name="nama"]');
        
        // Auto-focus on nama field
        setTimeout(() => {
            namaInput.focus();
        }, 100);

        // Form validation
        form.addEventListener('submit', function(e) {
            if (!namaInput.value.trim()) {
                e.preventDefault();
                showNotification('error', 'Nama ekstrakurikuler wajib diisi!');
                namaInput.focus();
                namaInput.classList.add('is-invalid');
                return;
            }
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            // Auto re-enable after 5 seconds if submission fails
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });

        // Reset form handler
        form.querySelector('button[type="reset"]').addEventListener('click', function() {
            if (confirm('Reset semua perubahan? Data akan dikembalikan ke nilai semula.')) {
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
                namaInput.focus();
            }
        });

        // Input validation styling
        namaInput.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
            }
        });

        // Add is-valid class on input
        form.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                }
            });
        });

        function showNotification(type, message) {
            // Remove existing notification
            const existingNotif = document.querySelector('.notification-toast');
            if (existingNotif) existingNotif.remove();

            // Create notification
            const notification = document.createElement('div');
            notification.className = `notification-toast alert alert-${type === 'error' ? 'danger' : 'success'} 
                                      border-0 shadow-lg position-fixed top-4 end-4`;
            notification.style.zIndex = '9999';
            notification.style.minWidth = '300px';
            notification.style.animation = 'slideInRight 0.3s ease';
            
            const icon = type === 'error' ? 'exclamation-triangle' : 'check-circle';
            const iconColor = type === 'error' ? 'danger' : 'success';
            
            notification.innerHTML = `
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-${icon} text-${iconColor} fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">${type === 'error' ? 'Error' : 'Sukses'}</h6>
                        <p class="mb-0">${message}</p>
                    </div>
                    <button type="button" class="btn-close ms-3" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            
            .is-valid {
                border-color: var(--success) !important;
            }
            
            .is-invalid {
                border-color: var(--danger) !important;
                animation: shake 0.5s;
            }
            
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endpush
@endsection