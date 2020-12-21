<a href="{{ url('admin/members') }}" class="btn btn-danger mb-3">Kembali</a>
<table class="table">
	<tr>
		<td style="width: 30%">Nama</td><td>:</td><td>{{ $user->name }}</td> <td rowspan="5">
		<img src="{{ asset('/storage/foto/'.$user->foto) }}" width="200" align="right"></td>
	</tr>
	<tr><td style="width: 30%">Email</td><td>:</td><td>{{ $user->email }}</td></tr>
	<tr><td style="width: 30%">Callsign</td><td>:</td><td>{{ $user->callsign }}</td></tr>
	<tr><td style="width: 30%">Kategori</td><td>:</td><td>{{ strtoupper($user->category) }}</td></tr>
	@if ($user->category == 'premium')
	<tr><td style="width: 30%">Class Premium</td><td>:</td><td>{{ strtoupper($user->class_premium) }}</td></tr>
	@endif
	<tr><td style="width: 30%">Alamat</td><td>:</td><td>{{ $user->alamat }}</td></tr>
</table>