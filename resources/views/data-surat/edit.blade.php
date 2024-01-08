@extends('layouts.appv2')

@section('title', 'Edit Data Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('data-surat.index') }}">Data Surat</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Edit Data Surat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <!-- Form edit data staff tata usaha -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-surat.update', $letter->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if ($errors->any())
                        <ul class="alert alert-danger p-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="row mb-3">
                        <div class="col">
                            <div>
                                <label for="inputKodeSurat" class="form-label">Perihal</label>
                                <input type="text" class="form-control" id="inputKodeSurat"
                                       name="perihal" value="{{ $letter['letter_perihal'] }}">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label for="selectKlasifikasiSurat" class="form-label">Klasifikasi Surat</label>
                                <select id="selectKlasifikasiSurat" class="form-select" aria-label="Select Klasifikasi Surat"
                                        name="klasifikasi_surat" value="{{ $letter['letter_type_id'] }}">
                                    <option selected>Pilih</option>
                                    @foreach ($letterTypes as $lt)
                                        @php($selectedLetterTypes = $lt->id == $letter->letter_type_id ? 'selected=""' : '')
                                        <option value="{{ $lt->id }}" {{ $selectedLetterTypes}}>{{ $lt->name_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputIsiSurat" class="form-label">Isi Surat</label>
                        <textarea id="inputIsiSurat" name="isi_surat" class="form-control">
                        {!! $letter->content !!}
                    </textarea>
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
                                        @if(in_array($recipient->name, json_decode($letter->recipients, 1)))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked value="{{ $recipient->name }}"
                                                       id="checkPeserta{{ $recipient->id }}" name="peserta[]" value="{{ $letter['recipients'] }}">
                                                <label class="form-check-label d-none" for="checkPeserta{{ $recipient->id }}">
                                                    {{ $recipient->name }}
                                                </label>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $recipient->name }}"
                                                       id="checkPeserta{{ $recipient->id }}" name="peserta[]" value="{{ $letter['recipients'] }}">
                                                <label class="form-check-label d-none" for="checkPeserta{{ $recipient->id }}">
                                                    {{ $recipient->name }}
                                                </label>
                                            </div>
                                        @endif

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
                        <select id="selectNotulis" class="form-select" aria-label="Select Klasifikasi Surat" name="notulis" value="{{ $letter['notulis'] }}">
                            <option selected>Pilih</option>
                            @foreach ($users as $notulis)
                                @php($selectedNotulis = $notulis->id == $letter->notulis ? 'selected=""' : '')
                                <option value="{{ $notulis->id }}" {{ $selectedNotulis }}>{{ $notulis->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Edit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form edit data staff tata usaha -->
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