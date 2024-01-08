@extends('layouts.appv2')

@section('title', 'Tambah Klasifikasi Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Data Klasifikasi Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('klasifikasi-surat.index') }}">Data Klasifikasi Surat</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Tambah Data Klasifikasi Surat
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
                <form action="{{ route('klasifikasi-surat.store') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Surat</label>
                        <input type="text" class="form-control" id="kode" placeholder="Masukan Kode Surat" name="kode_surat">
                    </div>
                    <div class="mb-3">
                        <label for="klasifikasiSurat" class="form-label">Klasifikasi Surat</label>
                        <input type="text" class="form-control" id="klasifikasiSurat" placeholder="Masukan Klasifikasi Surat" name="klasifikasi_surat">
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