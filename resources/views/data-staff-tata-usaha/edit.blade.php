@extends('layouts.appv2')

@section('title', 'Edit tata usaha')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Staff Tata Usaha</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/staff-tata-usaha">Data Staff Tata Usaha</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Edit Data Staff Tata Usaha
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
                <form action="{{ route('staff-tata-usaha.update', $staff['id']) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if($errors->any())
                        <ul class="alert alert-danger p-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $staff['name'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $staff['email'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Ubah Password</label>
                        <input type="password" class="form-control" id="password" name="password" >
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