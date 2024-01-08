@extends('layouts.appv2')

@section('title', 'Preview Surat')

@section('content')
    <div class="page-content" id="main-card">
        <div class="header d-flex gap-3 justify-content-end align-items-center mb-3">
            <a href="{{ route('data-surat.index') }}">Kembali</a>
            <a href="{{ route('data-surat.print', $data->id) }}" target="_blank" class="btn btn-dark btn-sm"><i class="bi bi-printer-fill"></i> Cetak</a>
        </div>
        <div class="card border-1 rounded-0 border">
            <div class="content">
                <div class="card-body">
                    <div class="main-page">
                        <div class="sub-page">
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/wikrama-logo.png'))) }}"
                                                 style="width: 30mm; height: 30mm; object-fit: cover" alt="image">
                                            <div>
                                                <h4>SMK WIKRAMA BOGOR</h4>
                                                <div style="height: 2px; background: #000; width: 250px"></div>
                                                <p style="margin-top: 4px">Bisnis dan Managemen</p>
                                                <p>Teknologi Informasi dan Komunikasi</p>
                                                <p>Pariwisata</p>
                                            </div>
                                        </div>
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

                            <div id="container" style="padding-right: 18px; padding-left: 18px">
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="width: 65%">
                                            <p>No: {{ $data->letterTypes->letter_code }}/003/SMK Wikrama/XII/2024</p>
                                            <p>Hal: <b>{{ $data->letter_perihal }}</b></p>
                                        </td>
                                        <td>
                                            <p style="margin-bottom: 20px;">Kepada</p>
                                            <p>Yth. Bapak/Ibu Terlampir</p>
                                            <p>di</p>
                                            <p>Tempat</p>
                                        </td>
                                    </tr>
                                </table>
                                <div style="padding-right: 18px; padding-left: 18px; padding-top: 37px">
                                    {!! $data->content !!}
                                </div>

                                <div style="padding-right: 18px; padding-left: 18px; padding-top: 37px">
                                    <p>Peserta</p>
                                </div>
                                <div style="padding-left: 45px">
                                    <ol class="ps-0">
                                        @foreach (json_decode($data->recipients) as $recipient)
                                            <li>{{ $recipient }}</li>
                                        @endforeach
                                    </ol>
                                </div>

                                <div style="padding: 20px 20px 40px 10px;float: right">
                                    <p>Hormat kami,</p>
                                    <p style="margin-bottom: 3cm">Kepala Smk Wikrama Bogor</p>
                                    <p style="padding-left: 18px">(...............................)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!is_null($data->attachment))
            <div class="card border-1 rounded-0 border mt-4">
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <p class="text-center fw-bold">Lampiran</p>
                    <img src="{{ Storage::url($data->attachment) }}"
                         style="width: 350px; height: 200px; object-fit: cover" alt="image">
                </div>
            </div>
        @endif
    </div>
@endsection

@push('css')
    <style>
        #main-card {
	        width: 210mm;
	        margin-left: auto;
	        margin-right: auto;
	        height: auto;
        }

        h3 {
	        margin: 0 0 2mm 0;
        }

        p {
	        margin: 0 0 1mm 0;
	        padding: 0;
        }
    </style>
@endpush
