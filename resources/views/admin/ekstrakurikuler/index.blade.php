{{-- resources/views/admin/ekstrakurikuler/index.blade.php --}}
@extends('layouts.simple')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800"><i class="fas fa-futbol me-2"></i>Data Ekstrakurikuler</h1>
        <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Baru
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Ekstrakurikuler</h6>
            <div class="d-flex gap-2">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari ekstrakurikuler...">
                <button class="btn btn-sm btn-outline-secondary" onclick="resetSearch()">
                    <i class="fas fa-redo"></i>
                </button>
            </div>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(isset($ekstrakurikulers) && $ekstrakurikulers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Ekstrakurikuler</th>
                                <th>Pembina</th>
                                <th>Kuota</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ekstrakurikulers as $ekskul)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong class="text-primary">{{ $ekskul->nama }}</strong>
                                        @if($ekskul->deskripsi)
                                            <br><small class="text-muted">{{ Str::limit($ekskul->deskripsi, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $ekskul->pembina ?? '-' }}</td>
                                    <td>
                                        @if($ekskul->kuota)
                                            <span class="badge bg-info">{{ $ekskul->kuota }} peserta</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak terbatas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ekskul->hari && $ekskul->jam)
                                            <small>{{ $ekskul->hari }}</small><br>
                                            <small class="text-muted">{{ $ekskul->jam }}</small>
                                        @else
                                            <span class="text-muted">Belum diatur</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Aktif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.ekstrakurikuler.show', $ekskul->id) }}" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.ekstrakurikuler.edit', $ekskul->id) }}" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.ekstrakurikuler.destroy', $ekskul->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
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

                <!-- HAPUS atau KOMENTARI bagian pagination ini jika tidak menggunakan paginate() -->
                {{-- @if($ekstrakurikulers->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $ekstrakurikulers->links() }}
                    </div>
                @endif --}}
                
                <!-- Atau gunakan ini untuk pengecekan yang lebih aman -->
                @if(method_exists($ekstrakurikulers, 'hasPages') && $ekstrakurikulers->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $ekstrakurikulers->links() }}
                    </div>
                @endif
                
            @else
                <div class="text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <h5>Belum ada data ekstrakurikuler</h5>
                        <p class="mb-4">Mulai dengan menambahkan ekstrakurikuler baru</p>
                        <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Ekstrakurikuler
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table th {
        font-weight: 600;
        color: #4e73df;
        border-top: 2px solid #4e73df;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .btn-group .btn {
        border-radius: 4px !important;
        margin-right: 2px;
    }
    
    #searchInput {
        max-width: 250px;
        border-radius: 20px;
    }
</style>

@push('scripts')
<script>
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('#dataTable tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
    
    function resetSearch() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.value = '';
            const rows = document.querySelectorAll('#dataTable tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
        }
    }
    
    // Alert auto dismiss
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
@endsection