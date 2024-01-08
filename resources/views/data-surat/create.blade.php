@extends('layouts.appv2')

@section('title', 'Tambah Data Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Data Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('data-surat.index') }}">Data Surat</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Tambah Data Surat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <!-- Form tambah data klasifikasi surat -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-surat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="row mb-3">
                        <div class="col">
                            <div>
                                <label for="inputKodeSurat" class="form-label">Perihal</label>
                                <input type="text" class="form-control" id="inputKodeSurat" placeholder="Masukan Perihal"
                                       name="perihal">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label for="selectKlasifikasiSurat" class="form-label">Klasifikasi Surat</label>
                                <select id="selectKlasifikasiSurat" class="form-select" aria-label="Select Klasifikasi Surat"
                                        name="klasifikasi_surat">
                                    <option selected>Pilih</option>
                                    @foreach ($letterTypes as $lt)
                                        <option value="{{ $lt->id }}">{{ $lt->name_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputIsiSurat" class="form-label">Isi Surat</label>
                        <textarea id="inputIsiSurat" name="isi_surat" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <td><b>Nama</b></td>
                                <td><b>Peserta (ceklis jika "ya")</b></td>
                            </tr>
                            </tbody>
                            <tbody>
                            @foreach ($users as $recipient)
                                <tr>
                                    <td> {{ $recipient->name }}
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $recipient->name }}"
                                                   id="checkPeserta{{ $recipient->id }}" name="peserta[]">
                                            <label class="form-check-label d-none" for="checkPeserta{{ $recipient->id }}">
                                                {{ $recipient->name }}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="mb-3">
                        <label for="inputLampiran" class="form-label">Lampiran</label>
                        <input class="form-control" type="file" id="inputLampiran" name="lampiran">
                    </div>
                    <div class="mb-3">
                        <label for="selectNotulis" class="form-label">Notulis</label>
                        <select id="selectNotulis" class="form-select" aria-label="Select Klasifikasi Surat" name="notulis">
                            <option selected>Pilih</option>
                            @foreach ($users as $notulis)
                                <option value="{{ $notulis->id }}">{{ $notulis->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form tambah data klasifikasi surat -->
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-lite.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-lite.min.js') }}"></script>

    <script>
        $("#inputIsiSurat").summernote({
            tabsize: 2,
            height: 400,
        })
    </script>
@endpush
