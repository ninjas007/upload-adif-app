<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Certificate</title>
    <style>
        .text-center {
            text-align: center;
        }
        .wrap {
            line-height: 1.6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            border: 1px solid #e3d3d3;
            width: 50%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
            background-color: #e8f0fe;
            font-size: 14px;
        }
    </style>
</head>
<body>
    @php
        $url = url('/member/certificate?callsign='.$user->callsign.'&token='.base64_encode($user->password).'');
    @endphp
    <div class="text-center wrap">
        <img src="https://yb6-dxc.net/wp-content/uploads/2020/10/gbr-2.jpg" width="100%">
        Selamat <b>{{ $user->callsign }}</b> <br/>
        Anda berhasil mendapatkan Premium Member Certificate {{ ucwords($user->class_premium ?? '') }}
        {{ $user->member_id }} <br/>

        Untuk download certificate member, silahkan <a href="{{ $url }}" style="font-weight: bold; color: red">KLIK DISINI</a> <br>
        Silahkan pelajari cara penggunaan aplikasi web member YB6_DXC di <a href="https://member.yb6-dxc.net/">https://member.yb6-dxc.net/ </a> pada menu Help Desk dan jika ada kendala silahkan gunakan form yang ada di halaman HELP DESK. <br/> <br/>

        Terima Kasih, 73 <br/> <br/>

        Director Member <br>
        <b>* This notification was sent by the system, please do not reply </b>
    </div>
</body>
</html>

