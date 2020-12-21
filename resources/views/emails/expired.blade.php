<!DOCTYPE html>
<html>
<head>
    <title>Expired Account Member YB6DXC</title>
</head>
<body style="font-size: 14px; text-align: center;">
	<div>Hello, {{ $data['nama'] }}</div>
	@if ($data['expired'])
		<div>Your account {{ $data['kategori'] }} is expired. Please contact <a href="https://yb6-dxc.net/contact-us/" targer="_blank">admin</a> for upgrade</div>
	@else
		<div>Your account {{ $data['kategori'] }} will be expired 3 months. Please contact <a href="https://yb6-dxc.net/contact-us/" targer="_blank">admin</a> for upgrade</div>
	@endif
    <h1>Callsign : {{ $data['callsign'] }}</h1>
</body>
</html>