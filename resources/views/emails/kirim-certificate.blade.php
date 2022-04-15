<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification Certificate</title>
</head>
<body>
    @php
        $url = url('/member/certificate?callsign='.$user->callsign.'&token='.base64_encode($user->password).'');
    @endphp

    <div>
        Selamat <b>{{ $user->callsign }}</b> <br/>
        Anda berhasil mendapatkan Premium Member Certificate {{ ucwords($user->class_premium ?? '') }}
        {{ $user->member_id }} <br/>
        Untuk download certificate member, silahkan <a href="{{ $url }}" style="font-weight: bold; color: red">KLIK DISINI</a>
        Silahkan pelajari cara penggunaan aplikasi web member YB6_DXC di <a href="https://member.yb6-dxc.net/">https://member.yb6-dxc.net/ </a> pada menu Help Desk dan jika ada kendala silahkan gunakan form yang ada di halaman HELP DESK. <br/> <br/>

        Terima Kasih, 73 <br/> <br/>

        Director Member <br>
        <b>* This notification was sent by the system, please do not reply </b>
    </div>
</body>
</html>
