@extends('layouts.appv2')

@section('title', 'Tambah Hasil Rapat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hasil Rapat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('data-surat-guru.index') }}">Data Surat</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Hasil Rapat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('data-surat-guru.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_surat" value="{{ $letter->id }}">
                <div class="mb-3">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td colspan="2">Kehadiran:</td>
                            </tr>
                            <tr>
                                <td><b>Nama</b></td>
                                <td><b>Peserta (ceklis jika "ya")</b></td>
                            </tr>
                        </tbody>
                        <tbody>
                            @foreach (json_decode($letter->recipients) as $id => $recipient)
                                <tr>
                                    <td> {{ $recipient }} </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $recipient }}"
                                                id="checkPeserta{{ $id }}" name="peserta[]">
                                            <label class="form-check-label d-none" for="checkPeserta{{ $id }}">
                                                {{ $recipient }}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
                <div class="mb-3">
                    <label for="inputIsiSurat" class="form-label">Isi Surat</label>
                    <textarea id="inputIsiSurat" name="isi_surat" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary float-end">Tambah</button>
                </div>
            </form>
        </div>
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
