@extends('layouts.appv2')

@section('title', 'Detail Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Data Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('data-surat-guru.index') }}">Data Surat</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Detail Data Surat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="page-content" id="main-card">
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
                                                    <p>No: {{ $data->letterTypes->letter_code }}</p>
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

    @if ($data->result)
        <div class="card border-1 rounded-0 border mt-4">
            <div class="card-body">
                <div class="mb-3">
                    <table class="table table-sm">
                        <tbody>
                        <tr>
                            <td colspan="2">Peserta Rapat yang Hadir:</td>
                        </tr>
                        <tr>
                            <td><b>Nama</b></td>
                            <td><b>Kehadiran</b></td>
                        </tr>
                        </tbody>
                        <tbody>
                        @foreach (json_decode($data->recipients) as $id => $recipient)
                            <tr>
                                <td> {{ $recipient }} </td>
                                <td>
                                    @if (in_array($recipient, json_decode($data->result->presence_recipients,1)))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" disabled checked value="{{ $recipient }}"
                                                   id="checkPeserta{{ $id }}" name="peserta[]">
                                            <label class="form-check-label d-none" for="checkPeserta{{ $id }}">
                                                {{ $recipient }}
                                            </label>
                                        </div>
                                    @else
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" disabled value="{{ $recipient }}"
                                                   id="checkPeserta{{ $id }}" name="peserta[]">
                                            <label class="form-check-label d-none" for="checkPeserta{{ $id }}">
                                                {{ $recipient }}
                                            </label>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mb-3">
                    <label for="ringkasan">Ringkasan:</label>
                    {!! $data->result->notes !!}
                </div>
            </div>
        </div>
    @endif
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
