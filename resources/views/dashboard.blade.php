@extends('layouts.simple') {{-- Ubah dari admin ke app karena ini untuk siswa --}}

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Siswa</h1>

    <div class="row">
        <!-- Statistik Singkat -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pendaftaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendaftaran->count() }}</div>
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
                                Diterima</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendaftaran->where('status', 'diterima')->count() }}
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
                                Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendaftaran->where('status', 'pending')->count() }}
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
                                Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendaftaran->where('status', 'ditolak')->count() }}
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

    <!-- KELOMPOK EKSTRAKURIKULER -->
<div class="row">

@foreach($kelompokEkskul as $namaEkskul => $anggota)

<div class="col-md-12 mb-4">

<div class="card shadow-sm border-0">

<div class="card-header d-flex justify-content-between align-items-center">

<div>
<h5 class="mb-0 text-primary">
<i class="fas fa-users"></i> {{ $namaEkskul }}
</h5>

<small class="text-muted">
Total Anggota : {{ $anggota->count() }}
</small>
</div>

<div>

<a href="{{ route('ekskul.export.excel',$namaEkskul) }}" class="btn btn-success btn-sm">
Excel
</a>

<a href="{{ route('ekskul.export.word',$namaEkskul) }}" class="btn btn-primary btn-sm">
Word
</a>

<a href="{{ route('ekskul.export.pdf',$namaEkskul) }}" class="btn btn-danger btn-sm">
PDF
</a>

<button onclick="printTable('{{ $namaEkskul }}')"
class="btn btn-sm btn-secondary">
<i class="fas fa-print"></i> Cetak
</button>

</div>

</div>


<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="table-{{ Str::slug($namaEkskul) }}">

<thead class="table-light">

<tr>
<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>No HP</th>
</tr>

</thead>

<tbody>

@foreach($anggota as $index => $a)

<tr>
<td>{{ $index+1 }}</td>
<td>{{ $a->nama }}</td>
<td>{{ $a->kelas }}</td>
<td>{{ $a->no_hp }}</td>
</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>

@endforeach

</div>


    <!-- Riwayat Pendaftaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Pendaftaran</h6>
            <span class="badge badge-primary">{{ $pendaftaran->count() }} Pendaftaran</span>
        </div>
        <div class="card-body">
            @if($pendaftaran->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Ekstrakurikuler</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftaran as $key => $daftar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <code class="text-primary">{{ $daftar->kode_pendaftaran }}</code>
                            </td>
                            <td>
                                <strong>{{ $daftar->ekstrakurikuler->nama }}</strong>
                                <small class="d-block text-muted">{{ $daftar->ekstrakurikuler->kategori->nama ?? 'Tidak ada kategori' }}</small>
                            </td>
                            <td>
                                {{ $daftar->created_at->translatedFormat('d F Y') }}
                                <small class="d-block text-muted">{{ $daftar->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                @if($daftar->status == 'pending')
                                    <span class="badge badge-warning p-2">Pending</span>
                                @elseif($daftar->status == 'diterima')
                                    <span class="badge badge-success p-2">Diterima</span>
                                @elseif($daftar->status == 'ditolak')
                                    <span class="badge badge-danger p-2">Ditolak</span>
                                @else
                                    <span class="badge badge-secondary p-2">{{ $daftar->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('pendaftaran.show', $daftar->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <a href="{{ route('cetak.bukti', $daftar->kode_pendaftaran) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-primary {{ $daftar->status != 'diterima' ? 'disabled' : '' }}" 
                                       title="Cetak Bukti"
                                       @if($daftar->status != 'diterima') onclick="return false;" @endif>
                                        <i class="fas fa-print"></i>
                                    </a>
                                    
                                    @if($daftar->status == 'pending')
                                    <form action="{{ route('pendaftaran.cancel', $daftar->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Yakin ingin membatalkan pendaftaran ini?')"
                                                title="Batalkan">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination jika diperlukan -->
            @if($pendaftaran->hasPages())
            <div class="mt-3">
                {{ $pendaftaran->links() }}
            </div>
            @endif
            
            @else
            <div class="text-center py-5">
                <i class="fas fa-clipboard-list fa-4x text-muted mb-4"></i>
                <h5 class="text-muted">Belum ada riwayat pendaftaran</h5>
                <p class="text-muted">Daftarkan diri Anda pada ekstrakurikuler yang tersedia</p>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Informasi Penting -->
    <div class="alert alert-info">
        <h5 class="alert-heading"><i class="fas fa-info-circle mr-2"></i>Informasi Penting</h5>
        <ul class="mb-0 pl-3">
            <li>Pendaftaran hanya dapat dilakukan 1 kali per ekstrakurikuler</li>
            <li>Status "Pending" menunggu verifikasi dari admin</li>
            <li>Bukti pendaftaran hanya dapat dicetak jika status "Diterima"</li>
            <li>Pendaftaran dapat dibatalkan selama status masih "Pending"</li>
        </ul>
    </div>
</div>

<!-- Modal untuk konfirmasi pembatalan -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembatalan</h5>
                <button type="submit" class="btn btn-sm btn-danger btn-cancel" 
        title="Batalkan">
    <i class="fas fa-times"></i>
</button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin membatalkan pendaftaran ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmCancel">Ya, Batalkan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Validasi form sebelum submit
        $('form').submit(function(e) {
            const selectedEkskul = $('#ekstrakurikuler_id').val();
            if (!selectedEkskul) {
                e.preventDefault();
                alert('Silakan pilih ekstrakurikuler terlebih dahulu');
                $('#ekstrakurikuler_id').focus();
                return false;
            }
        });

        // Konfirmasi pembatalan dengan modal
        $('.btn-cancel').click(function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            $('#cancelModal').modal('show');
            
            $('#confirmCancel').off('click').on('click', function() {
                form.submit();
                $('#cancelModal').modal('hide');
            });
        });
    });
</script>
@endpush