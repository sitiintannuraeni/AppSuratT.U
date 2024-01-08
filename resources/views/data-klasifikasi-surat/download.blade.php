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
        font-family: 'Nunito',
        sans-serif;

        body {
            width: 230mm;
            height: 297mm;
            margin: 0 auto;
            padding: 0;
            font-size: 12pt;
            background: rgb(204, 204, 204);
        }

        h3 {
            margin: 0 0 2mm 0;
        }

        p {
            margin: 0 0 1mm 0;
            padding: 0;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .main-page {
            height: 297mm;
            width: 210mm;
            margin-left: auto;
            margin-right: auto;
            background: white;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        .sub-page {
            padding: 1cm;
        }

        @page {
            size: A4;
            margin: 0 !important;
        }

        @media print {

            html,
            body {
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
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/wikrama-logo.png'))) }}"
                            style="width: 30mm; height: 30mm; object-fit: cover" alt="image">
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

            <p style="text-align: right; padding-right: 80px; padding-top: 20px; margin-bottom: 20px">
                {{ $data->created_at->format('d F Y') }}</p>

            <div id="container" style="padding-right: 0.5cm; padding-left: 0.5cm">
                <table>
                    <tr>
                        <td style="width: 450px">
                            <p>No: {{ $data->letterTypes->letter_code }}/003/SMK Wikrama/XII/2024</p>
                            <p>Hal: <b>{{ $data->letter_perihal }}</b></p>
                        </td>
                        <td>
                            <p style="margin-bottom: 20px;">Kepada</p>
                            <p>Yth. Bapa/Ibu Terlampir</p>
                            <p>di</p>
                            <p>Tempat</p>
                        </td>
                    </tr>
                </table>
                <div style="padding-right: 0.5cm; padding-left: 0.5cm; padding-top: 1cm">
                    {!! $data->content !!}
                </div>

                <div style="padding-right: 0.5cm; padding-left: 0.5cm; padding-top: 1cm">
                    <p>Peserta</p>
                </div>
                <div style="padding-left: 1.2cm">
                    @php($number = 1)
                    @foreach (json_decode($data->recipients) as $recipient)
                        <p>{{ $number++ }}. {{ $recipient }}</p>
                    @endforeach
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
