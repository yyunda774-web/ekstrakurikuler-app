@extends('layouts.simple')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">📊 Mapping Ekskul → Pembina</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Ekskul</th>
                <th>Pembina</th>
                <th>Jumlah Pendaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ekskul as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->nama }}</td>

                <td>
                    @if($item->pembina)
                        {{ $item->pembina->name ?? '-' }}
                    @else
                        <span class="text-danger">Belum ada</span>
                    @endif
                </td>

                <td>{{ $item->pendaftarans->count() }}</td>

                <td>
                    <a href="{{ route('admin.mapping.edit',$item->id) }}" 
                       class="btn btn-sm btn-primary">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection