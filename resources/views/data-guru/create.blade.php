@extends('layouts.appv2')

@section('title', 'Tambah Guru')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Data Guru</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('data-guru.index') }}">Data Guru</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Tambah Data Guru
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <!-- Form tambah data guru tata usaha -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-guru.store') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mb-3">
                        <label for="inputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="inputNama" name="name" placeholder="Masukan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Masukan Email">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form tambah data guru tata usaha -->
    </div>
@endsection