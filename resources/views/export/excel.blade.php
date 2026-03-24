<table border="1">

<tr>
<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>No HP</th>
</tr>

@foreach($data as $index => $d)

<tr>
<td>{{ $index+1 }}</td>
<td>{{ $d->nama }}</td>
<td>{{ $d->kelas }}</td>
<td>{{ $d->no_hp }}</td>
</tr>

@endforeach

</table>