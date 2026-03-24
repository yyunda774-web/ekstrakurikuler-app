@extends('layouts.simple')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Laporan Pendaftaran Ekstrakurikuler
    </h2>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">

        <table class="min-w-full border border-gray-200">

            <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-3 border">No</th>
                    <th class="px-4 py-3 border">Nama</th>
                    <th class="px-4 py-3 border">Kelas</th>
                    <th class="px-4 py-3 border">No HP</th>
                    <th class="px-4 py-3 border">Ekstrakurikuler</th>
                    <th class="px-4 py-3 border">Status</th>
                    <th class="px-4 py-3 border">Tanggal</th>
                </tr>
            </thead>

            <tbody class="text-sm text-gray-700">

                @forelse($pendaftaran as $index => $data)

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 border">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-4 py-3 border font-medium">
                        {{ $data->nama }}
                    </td>

                    <td class="px-4 py-3 border">
                        {{ $data->kelas }}
                    </td>

                    <td class="px-4 py-3 border">
                        {{ $data->no_hp }}
                    </td>

                    <td class="px-4 py-3 border">
                        {{ $data->ekstrakurikuler->nama ?? '-' }}
                    </td>

                    <td class="px-4 py-3 border">

                        @if($data->status == 'pending')
                            <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded">
                                Pending
                            </span>

                        @elseif($data->status == 'diterima')
                            <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">
                                Diterima
                            </span>

                        @elseif($data->status == 'ditolak')
                            <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded">
                                Ditolak
                            </span>
                        @endif

                    </td>

                    <td class="px-4 py-3 border">
                        {{ $data->created_at->format('d M Y') }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        Belum ada data pendaftaran
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection