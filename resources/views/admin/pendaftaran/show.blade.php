@extends('layouts.guest')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-file-alt me-2"></i>Detail Pendaftaran
        </h1>
        <div>
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pendaftaran</h6>
                </div>
                <div class="card-body">
                    <!-- Isi detail pendaftaran di sini -->
                    <p>Detail untuk pendaftaran ID: {{ $pendaftaran->id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection