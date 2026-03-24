@extends('layouts.simple')

@section('content')

<h2>Status Pendaftaran</h2>

@if($pendaftaran)

<p>Nama: {{ $pendaftaran->nama }}</p>
<p>Kelas: {{ $pendaftaran->kelas }}</p>
<p>Ekskul: {{ $pendaftaran->ekstrakurikuler->nama }}</p>
<p>Status: {{ $pendaftaran->status }}</p>

@else

<p>Data tidak ditemukan</p>

@endif

@endsection