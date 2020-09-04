<!DOCTYPE html>
<html>
<head>
    <title>Info Expired Member</title>
    <style>
    	table tr td {
    		padding: 5px;
    	}
    </style>
</head>
<body style="font-size: 14px;">
	<div>Hello Admin, Berikut daftar member yang expired hari ini</div>
	<table border="1" style="margin-top: 20px">
		<tr>
			<td>No</td>
			<td>Nama</td>
			<td>Kategori</td>
			<td>No Hp</td>
			<td>Callsign</td>
		</tr>
		@foreach ($data['users'] as $key => $user)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $user['name'] }}</td>
				<td>{{ $user['category'] }}</td>
				<td>{{ $user['no_hp'] }}</td>
				<td>{{ $user['callsign'] }}</td>
			</tr>
		@endforeach
	</table>
    <h1>Total : {{ $data['count'] }}</h1>
</body>
</html>