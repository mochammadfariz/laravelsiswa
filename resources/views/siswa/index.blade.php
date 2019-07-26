<h1>Data siswa</h1>
<table>
<tr>
    <th>Nama Depan</th>
    <th>Nama Belakang</th>
    <th>Jenis Kelamin</th>
    <th>Agama</th>
    <th>Alamat</th>
</tr>
@foreach($data_siswa as $siswa)
<tr>
<td>{{$siswa->nama_depan}}</td>
<td>{{$siswa->nama_belakang}}</td>
<td>{{$siswa->jenis_kelamin}}</td>
<td>{{$siswa->agama}}</td>
<td>{{$siswa->alamat}}</td>
</tr>
@endforeach
</table>