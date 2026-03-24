{{-- resources/views/welcome.blade.php --}}
@extends('layouts.simple')

@section('title', 'Pendaftaran Ekstrakurikuler')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="fas fa-pen-alt me-2"></i>
                        FORM PENDAFTARAN EKSTRAKURIKULER
                    </h4>
                    <p class="mb-0">Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
                </div>

                <div class="card-body p-4">

                    {{-- ERROR GLOBAL --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.umum') }}" method="POST">
                        @csrf

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control form-control-lg"
                                   value="{{ old('nama') }}"
                                   required>
                        </div>

                        {{-- KELAS --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kelas</label>
                            <select name="kelas" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Kelas --</option>
                                @php
                                    $kelasList = [
                                        'X PM1','X PM2','X TO1','X TO2','X PPLG',
                                        'XI BR1','XI BR2','XI TKR1','XI TKR2','XI RPL'
                                    ];
                                @endphp
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas }}"
                                        {{ old('kelas') == $kelas ? 'selected' : '' }}>
                                        {{ $kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- NO HP --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor WhatsApp</label>
                            <input type="text"
                                   name="no_hp"
                                   class="form-control form-control-lg"
                                   value="{{ old('no_hp') }}"
                                   required>
                            <small class="text-muted">Pastikan nomor aktif</small>
                        </div>

                        {{-- EKSTRAKURIKULER --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Ekstrakurikuler</label>
                            <select name="ekstrakurikuler_id"
                                    class="form-select form-select-lg"
                                    required>
                                <option value="">-- PILIH EKSTRAKURIKULER --</option>

                                @foreach ($ekskul as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('ekstrakurikuler_id') == $item->id ? 'selected' : '' }}>
                                        {{ strtoupper($item->nama) }} – {{ strtoupper($item->pembina) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('ekstrakurikuler_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SYARAT --}}
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">
                                Saya menyetujui semua syarat dan ketentuan
                            </label>
                        </div>

                        {{-- SUBMIT --}}
                        <button class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-paper-plane me-2"></i>
                            DAFTAR SEKARANG
                        </button>
                    </form>

                    <hr>

                    <div class="text-center">
                        <p>Sudah memiliki akun?</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                            Login
                        </a>
                        <a href="{{ route('cek-status') }}" class="btn btn-outline-info ms-2">
                            Cek Status
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection