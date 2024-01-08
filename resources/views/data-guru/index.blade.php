@extends('layouts.appv2')

@section('title', 'Data Guru')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Guru</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Data Guru
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <a href="{{ route('data-guru.create') }}" class="btn btn-primary">Tambah</a>

                <form action="{{ route('data-guru.index') }}" class="d-flex" method="GET">
                    <input type="text" class="form-control me-2" name="name" placeholder="Search..." >
                    <input type="submit" class="btn btn-primary" value="Search">
                </form>

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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($number = 1)
                        @foreach ($guru as $value)
                            <tr>
                                <td class="align-middle">{{ ($number++) + $perPage }}</td>
                                <td class="align-middle">{{ $value->name }}</td>
                                <td class="align-middle">{{ $value->email }}</td>
                                <td class="align-middle">{{ $value->role }}</td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ route('data-guru.edit', $value->id) }}"
                                           class="btn btn-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <form action="{{ route('data-guru.delete', $value->id) }}" method="POST">
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

                {!! $guru->withQueryString()->links() !!}
            </div>
        </div>
    </div>

@endsection
