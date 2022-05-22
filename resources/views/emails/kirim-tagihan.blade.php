<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification Certificate</title>
</head>
<body>
    <div>
        Selamat <b>{{ $user->callsign }}</b> <br/>
        Saudara berhasil claim Membership YB6_DXCommunity {{ ucwords($user->class_premium ?? '') }}
        {{ $user->member_id }} <br/>
        Untuk bisa download certificate silahkan Transfer biaya pendaftaran sebesar Rp.150.000,- ke Bank BNI, atas anma Andayudas, Nomor Rekening 0898428488 atau sebesar $15.00,- melalui <a href="paypal.me/yb6hai" target="_blank">paypal.me/yb6hai</a> dan Bukti transfer konfirmasi melalui <a href="https://yb6-dxc.net/confirmation/" target="_blank">https://yb6-dxc.net/confirmation/ </a> <br/> <br>

        Terima Kasih, 73 <br/> <br/>

        Director Member <br>
        <b>* This notification was sent by the system, please do not reply </b>
    </div>
</body>
</html>
