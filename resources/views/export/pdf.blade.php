<h2>Anggota Ekskul {{ $ekskul }}</h2>

<table border="1" width="100%">
<tr>
<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>No HP</th>
</tr>

@foreach($data as $i => $d)

<tr>
<td>{{ $i+1 }}</td>
<td>{{ $d->nama }}</td>
<td>{{ $d->kelas }}</td>
<td>{{ $d->no_hp }}</td>
</tr>

@endforeach

</table>