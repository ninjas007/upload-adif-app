<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <title>Certificate</title>
    <style>
        * {
            font-family: 'Calibri', sans-serif;
        }

        .mainContainer {
            position: relative;
            padding: 0;
            min-width: 1100px;
            min-height: 800px;
            display: inline-block;
        }

        img {
            position: absolute;
            border: none;
            max-width: 100%;
        }

        #memberNumber,
        #date,
        #callsign,
        #nama {
            position: absolute;
            color: #dfdfdf !important;
            padding: 5px;
            background: rgba(0, 0, 0, 0);
            width: auto;
        }

        #memberNumber {
            top: 7%;
            left: 73%;
            text-align: left;
            font: 18px Calibri;
            font-weight: bold;
        }

        #date {
            top: 10%;
            left: 73%;
            text-align: left;
            font: 18px Calibri;
            font-weight: bold
        }

        #callsign {
            top: 52%;
            left: 25%;
            right: 25%;
            font-size: 46px;
        }

        #nama {
            top: 59%;
            left: 25%;
            right: 25%;
            font-size: 25px;
        }

        canvas {
            max-width: 100%;
        }
    </style>
</head>

<body>

    <div class="container mt-5">


        <!--Textarea to enter some texts.-->
        <input type="button" class="btn btn-sm btn-success mb-2" onclick="saveImageWithText();" id="bt" value="Download"/>
        <div>
            <div class="mainContainer" id='mainContainer'>

                @php
                    // $path = 'https://member-dm.yb6-dxc.net/assets/img/certificate.png';
                    $path = url('/template.png');
                	$type = pathinfo($path, PATHINFO_EXTENSION);
                	$data = file_get_contents($path);
                	$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $base64 }}" id="myimage" alt="" />

                <div id="memberNumber" style="color: #dfdfdf;">{{ $member->member_id }}</div>
                <div id="date" style="color: #dfdfdf">{{ date('d/m/Y', strtotime($member->register)) }}</div>
                <div id="callsign" style="color: #dfdfdf; text-align: center; font-weight: bold">{{ $member->callsign }}</div>
                <div id="nama" style="color: #dfdfdf; text-align: center;">{{ $member->name }}</div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $("body").on("contextmenu", "img", function(e) {
            return false;
        });

        let text1;
        let textnama;

        let t1 = document.querySelector('#memberNumber').innerText;
        let t2 = document.querySelector('#date').innerText;
        let t3 = document.querySelector('#callsign').innerText;
        let t4 = document.querySelector('#nama').innerText;

        let saveImageWithText = () => {
            $('#bt').attr('disabled', true);

            text1 = document.getElementById('memberNumber');
            textnama = document.getElementById('nama');

            let img = new Image();
            let canvas = document.createElement("canvas");

            img.src = document.getElementById('myimage').src;

            // Wait till the image is loaded.
            img.onload = function() {
                drawImage();
                downloadImage(img.src.replace(/^.*[\\\/]/, '')); // Download the processed image.
            }

            // Draw the image on the canvas.
            let drawImage = () => {
                let ctx = canvas.getContext("2d"); // Create canvas context.

                // Assign width and height.
                canvas.width = img.width;
                canvas.height = img.height;

                // Draw the image.
                ctx.drawImage(img, 0, 0);

                // Get the padding etc.
                // let left = parseInt(window.getComputedStyle(textContainer).left);
                // let right = textContainer.getBoundingClientRect().right;
                // let top = parseInt(window.getComputedStyle(textContainer).top, 0);
                // let center = textContainer.getBoundingClientRect().width / 2;

                // let paddingTop = window.getComputedStyle(textContainer).paddingTop.replace('px', '');
                // let paddingLeft = window.getComputedStyle(textContainer).paddingLeft.replace('px', '');
                // let paddingRight = window.getComputedStyle(textContainer).paddingRight.replace('px', '');


                // Assign text properties to the context.
                ctx.font = 'bold 60px Calibri';
                ctx.fillStyle = window.getComputedStyle(text1).color;

                // Get the text (it can a word or a sentence) to write over the image.
                let str = t1.replace(/\n\r?/g, '<br />').split('<br />');
                let str2 = t2.replace(/\n\r?/g, '<br />').split('<br />');
                let str3 = t3.replace(/\n\r?/g, '<br />').split('<br />');
                let str4 = t4.replace(/\n\r?/g, '<br />').split('<br />');


                // finally, draw the text using Canvas fillText() method.
                for (let i = 0; i <= str.length - 1; i++) {
                    ctx.fillText(str[i].replace(';', ''), 2510, 245);
                }

                for (let i = 0; i <= str2.length - 1; i++) {
                    ctx.fillText(str2[i].replace(';', ''), 2510, 315);
                }

                // ganti font yg nama dan callsign
                ctx.font = 'bold 150px Calibri';
                ctx.textAlign = "center";

                // callsign
                for (let i = 0; i <= str3.length - 1; i++) {
                    ctx.fillText(str3[i].replace(';', ''), 1700, 1465);
                }

                // ganti font yg nama dan callsign
                ctx.font = '75px Calibri';
                ctx.textAlign = "center";

                // nama
                for (let i = 0; i <= str4.length - 1; i++) {
                    ctx.fillText(str4[i].replace(';', ''), 1700, 1580);
                }
            }

            // Download the processed image.
            let downloadImage = (img_name) => {
                let a = document.createElement('a');
                a.href = canvas.toDataURL("image/png");
                a.download = 'certificate.png';
                document.body.appendChild(a);
                a.click();

                $('#bt').attr('disabled', false);
            }
        }
    </script>
</body>
