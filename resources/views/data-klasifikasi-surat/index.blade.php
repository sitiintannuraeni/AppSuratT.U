@extends('layouts.appv2')

@section('title', 'Data Klasifikasi Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Klasifikasi Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Data Klasifikasi Surat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <div class="row gap-3 gap-sm-0">
                    <div class="col-12 col-sm-4">
                       <div class="d-flex gap-2">
                           <a href="{{ route('klasifikasi-surat.create') }}" class="btn btn-primary">Tambah</a>
                           <a href="{{ route('klasifikasi-surat.download-excel') }}" class="btn btn-success"><i class="bi bi-download"></i> <span class="ms-1">Export Excel</span></a>
                       </div>
                    </div>
                    <div class="col-12 col-sm-4 offset-0 offset-sm-4">
                        <form action="{{ route('klasifikasi-surat.index') }}" class="d-flex" method="GET">
                            <input type="text" class="form-control me-2" name="name_type" placeholder="Search..." >
                            <input type="submit" class="btn btn-primary" value="Search">
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success"> {{ Session::get('success') }} </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Surat</th>
                            <th scope="col">Klasifikasi Surat</th>
                            <th scope="col">Surat Tertaut</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($number = 1)
                        @foreach ($klasifikasi as $value)
                            <tr>
                                <td class="align-middle">{{ ($number++) + $perPage }}</td>
                                <td class="align-middle">{{ $value->letter_code }}</td>
                                <td class="align-middle">{{ $value->name_type }}</td>
                                <td class="align-middle">{{ $value->letters->count()}}</td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ route('klasifikasi-surat.detail', $value->id) }}" class="btn btn-outline-dark">
                                            <i class="bi bi-search"></i>
                                        </a>
                                        <a href="{{ route('klasifikasi-surat.edit', $value->id) }}"
                                           class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>

                                        <form action="{{ route('klasifikasi-surat.delete', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash2-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $klasifikasi->withQueryString()->links() !!}
            </div>
        </div>
    </div>

@endsection
