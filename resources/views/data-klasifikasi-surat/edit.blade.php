@extends('layouts.appv2')

@section('title', 'Edit Klasifikasi Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Klasifikasi Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('klasifikasi-surat.index') }}">Data Klasifikasi Surat</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Edit Data Klasifikasi Surat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <!-- Form edit data klasifikasi surat -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('klasifikasi-surat.update', $klasifikasi['id']) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if ($errors->any())
                        <ul class="alert alert-danger p-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Surat</label>
                        <input type="text" class="form-control" id="kode" name="kode_surat"
                               value="{{ $klasifikasi['letter_code'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="klasifikasi" class="form-label">Klasifikasi Surat</label>
                        <input type="text" class="form-control" id="klasifikasi" name="klasifikasi_surat"
                               value="{{ $klasifikasi['name_type'] }}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Edit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form edit data klasifikasi surat -->
    </div>
@endsection
