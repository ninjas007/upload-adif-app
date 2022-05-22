<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tagihan Billing</title>
    <style>
        .text-center {
            text-align: center;
        }
        .wrap {
            line-height: 1.7;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            border: 1px solid #e3d3d3;
            width: 50%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
            background-color: #e8f0fe;
        }
    </style>
</head>
<body>
    <div class="text-center wrap">
        <img src="https://yb6-dxc.net/wp-content/uploads/2020/10/gbr-2.jpg" width="100%">
        Selamat <b>{{ $user->callsign }}</b>, <br/>
        Saudara berhasil claim Membership YB6_DXCommunity {{ ucwords($user->class_premium ?? '') }} <br>
        Untuk bisa download certificate silahkan Transfer biaya pendaftaran sebesar <br> <b>Rp.150.000,- ke Bank BNI, atas nama Andayudas, Nomor Rekening 0898428488</b> <br> atau <br> <b>$15.00,- melalui <a href="paypal.me/yb6hai" target="_blank">paypal.me/yb6hai</a></b>  <br> dan Bukti transfer konfirmasi melalui <a href="https://yb6-dxc.net/confirmation/" target="_blank">https://yb6-dxc.net/confirmation/ </a> <br/> <br>

        Terima Kasih, 73 <br/> <br>

        Director Member <br> <br>
        <b style="font-size: 12px; font-style: italic;">* This notification was sent by the system, please do not reply </b>
    </div>
</body>
</html>
