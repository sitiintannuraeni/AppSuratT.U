@extends('layouts.appv2')

@section('title', 'Data Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Data Surat
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
                            <a href="{{ route('data-surat.create') }}" class="btn btn-primary">Tambah</a>
                            <a href="{{ route('data-surat.download-excel') }}" class="btn btn-success"><i class="bi bi-download"></i> <span class="ms-1">Export Excel</span></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 offset-0 offset-sm-4">
                        <form action="{{ route('data-surat.index') }}" class="d-flex" method="GET">
                            <input type="text" class="form-control me-2" name="search_input" placeholder="Search..." >
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
                            <th scope="col">Nomor Surat</th>
                            <th scope="col">Perihal</th>
                            <th scope="col">Tanggal Keluar</th>
                            <th scope="col">Penerima Surat</th>
                            <th scope="col">Notulis</th>
                            <th scope="col">Hasil Rapat</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($number = 1)
                        @foreach ($letters as $value)
                            <tr>
                                <td class="align-middle">{{ ($number++) + $perPage }}</td>
                                <td class="align-middle">{{ $value->letter_code }}/003/SMK Wikrama/XII/2024</td>
                                <td class="align-middle">{{ $value->letter_perihal }}</td>
                                <td class="align-middle">{{ \Illuminate\Support\Carbon::parse($value->created_at)->format('d F Y') }}</td>
                                <td class="align-middle">
                                    <ol class="align-middle mb-0 ps-3">
                                        @foreach (json_decode($value->recipients) as $recipient)
                                            <li>{{ $recipient }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td class="align-middle">{{ $value->user_name }}</td>

                                <td class="align-middle">
                                    @if ($value->result)
                                        <p class="text-success align-middle mb-0">Sudah dibuat</p>
                                    @else
                                        <p class="text-danger align-middle mb-0">Belum dibuat</p>
                                    @endif
                                </td>

                                <td class="align-middle">
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ route('data-surat.detail', $value->id) }}" class="btn btn-outline-dark">
                                            <i class="bi bi-search"></i>
                                        </a>
                                        <a href="{{ route('data-surat.edit', $value->id) }}"
                                           class="btn btn-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <form action="{{ route('data-surat.delete', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash2-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $letters->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
