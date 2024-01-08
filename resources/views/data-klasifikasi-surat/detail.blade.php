@extends('layouts.appv2')

@section('title', 'Detail Klasifikasi Surat')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Klasifikasi Surat</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('klasifikasi-surat.index') }}">Data Klasifikasi Surat</a></li>
                            <li class="breadcrumb-item text-subtitle text-muted" aria-current="page">
                                Data Klasifikasi Surat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content mt-3">
        <div class="row row-cols-3">
            @foreach ($letters as $letter)
                <div class="col">
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <h4 class="fw-bold mb-0">{{ $letter->letterTypes->letter_code }}</h4>
                            <p class="mb-0 text-dark">| {{ $letter->letterTypes->name_type }}</p>
                        </div>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0"><strong>{{ $letter->letter_perihal}}</strong></h6>
                                    <a href="{{route('klasifikasi-surat.download', $letter->id)}}">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                                <div>
                                    <p class="mb-2"><b>{{ $letter->created_at->format('d F Y') }}</b></p>
                                    <ul class="list-unstyled px-3">
                                        @php($number = 1)
                                        @foreach (json_decode($letter->recipients) as $recipient)
                                            <li>{{ $number++ }}. {{ $recipient }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
