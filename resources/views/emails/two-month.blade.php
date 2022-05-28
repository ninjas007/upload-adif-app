<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YB6DXCommunity - Notification Two Month Before Expired</title>
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
    <div class="text-center wrap">
        <img src="https://yb6-dxc.net/wp-content/uploads/2020/10/gbr-2.jpg" width="100%">
        Hello <b>{{ $data['callsign'] }}</b>, <br/>
        Bersama ini kami mengingatkan bahwa status Premium Member anda pada YB6_DXCommunity berakhir pada tanggal {{ $data['tanggal_expired'] }}. <br>

        Kami tunggu pembayaran iuran tahunan anda sebesar <br> <b>Rp. 50.000,- ke rekenin Bank BNI, atas nama Andayudas, Nomor Rekening 0898428488</b> <br> atau <br> <b>$5.00,- melalui <a href="paypal.me/yb6hai" target="_blank">paypal.me/yb6hai</a></b>  <br> dan mohon bukti transfer dikonfirmasi melalui <a href="https://yb6-dxc.net/confirmation/" target="_blank">https://yb6-dxc.net/confirmation/ </a> <br/> <br>

        Terima Kasih, 73 <br/> <br>

        Director Member <br> <br>
        <b style="font-size: 12px; font-style: italic;">* This notification was sent by the system, please do not reply </b>
    </div>
</body>
</html>
