<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
	    font-family: 'Nunito', sans-serif;
         body {
             width: 230mm;
	         height:297mm;
	         margin: 0 auto;
             padding: 0;
             font-size: 12pt;
             background: rgb(204,204,204);
         }
         h3 {
           margin: 0 0 2mm 0;
         }
         p {
           margin:0 0 1mm 0;
           padding: 0;
         }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .main-page {
	        height:297mm;
            width:210mm;
            margin-left:auto;
            margin-right:auto;
            background: white;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        .sub-page {
	        padding: 1cm;
        }
        @page {
            size: A4;
	        margin: 0 !important;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
            .main-page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
	            height: 297mm;
                padding: 0.5cm;
            }
        }
    </style>
</head>
<body>
    <div class="main-page">
        <div class="sub-page">
            <table>
                <tr>
                    <td>
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/wikrama-logo.png'))) }}" style="width: 30mm; height: 30mm; object-fit: cover" alt="image">
                    </td>
                    <td style="width: 320px">
                        <h3>SMK WIKRAMA BOGOR</h3>
                        <div style="height: 2px; background: #000; width: 250px"></div>
                        <p style="margin-top: 4px">Bisnis dan Managemen</p>
                        <p>Teknologi Informasi dan Komunikasi</p>
                        <p>Pariwisata</p>
                    </td>
                    <td>
                        <p style="text-align: right">Jl. Raya Wangun Kel. Sindangsari Bogor</p>
                        <p style="text-align: right">Telp/Faks: (0251) 8242411</p>
                        <p style="text-align: right">email: prohumasi@smkwikrama.sch.id</p>
                        <p style="text-align: right">website: www.smkwikrama.sch.id</p>
                    </td>
                </tr>
            </table>
            <div style="height: 2px; background: #000; width: 100%; margin-top: 20px"></div>

            <p style="text-align: right; padding-right: 80px; padding-top: 40px; margin-bottom: 40px">17 Desember 2023</p>

            <div id="container" style="padding-right: 0.5cm; padding-left: 0.5cm">
                <table>
                    <tr>
                        <td style="width: 450px">
                            <p>No: 220604-1/0002/SMK Wikrama/X11/2023</p>
                            <p>Hal: <b>Rapat Rutin</b></p>
                        </td>
                        <td>
                            <p style="margin-bottom: 20px;">Kepada</p>
                            <p>Yth. Bapak/Ibu Terlampir</p>
                            <p>di</p>
                            <p>Tempat</p>
                        </td>
                    </tr>
                </table>
                <div style="padding-right: 0.5cm; padding-left: 0.5cm; padding-top: 1cm">
                    <p style="margin-bottom: 20px">Dengan Hormat</p>
                    <p style="margin-bottom: 20px">Bersama ini kami mengundang Bapak/Ibu untuk mengikuti rapat yang akan dilaksanakan pada:</p>
                    <p>Hari, Tanggal : Rabu, 13 Desember 2023</p>
                    <p>Pukul : 14.00 WIB s.d selesai</p>
                    <p>Tempat : Ruang Kepala Sekolah</p>
                    <p>Agenda : Pengelolaan Laboratorium</p>

                    <p style="margin-bottom: 20px">Notulis : Dinda S.S.</p>

                    <p>Demikian undangan ini kami sampaikan, atas perhatian dan kerja sama Bapak/Ibu kami ucapkan terima kasih</p>
                </div>

                <div style="padding-top: 2cm; padding-left: 1.2cm">
                    <p>1. Dinda S.S.</p>
                    <p>2. Aira S.Si.</p>
                </div>

                <div style="padding-top: 2cm; padding-left: 1cm; padding-right: 2cm; float: right">
                    <p>Hormat kami,</p>
                    <p style="margin-bottom: 3cm">Kepala Smk Wikrama Bogor</p>
                    <p style="padding-left: 0.5cm">(...............................)</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

