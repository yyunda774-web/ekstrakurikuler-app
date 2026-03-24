@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-6 rounded shadow max-w-md w-full text-center">

        <h2 class="text-2xl font-bold text-green-600 mb-4">
            Pendaftaran Berhasil 🎉
        </h2>

        <p class="mb-3">
            Simpan kode pendaftaran berikut untuk mengecek status:
        </p>

        <div class="text-xl font-mono bg-gray-100 p-3 rounded mb-4">
            {{ $pendaftaran->kode_pendaftaran }}
        </div>

        <a href="{{ route('cek-status') }}"
           class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Cek Status
        </a>

    </div>
</div>
@endsection
