@extends('layouts.simple')

@section('content')
<div class="container mt-4">

    <h3>Edit Pembina - {{ $ekskul->nama }}</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.mapping.update',$ekskul->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pilih Pembina</label>
            <select name="pembina_id" class="form-control">
                @foreach($pembina as $p)
                    <option value="{{ $p->id }}"
                        {{ $ekskul->pembina_id == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.mapping') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection