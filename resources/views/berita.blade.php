@extends('layouts.museum')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}" />
@endpush
@section('content')
    <style>
        .description p {
            font-size: 1.1em;
        }

        .title {
            font-size: 3em
        }

    </style>
    <div class="section" id="home"
        style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            <div class="card">
                <div class="card-body px-5">
                    <h3 class="card-title title">
                        {{ $berita->judul }}
                    </h3>
                    <h6 class="card-subtitle">{{ $berita->created_at->translatedFormat('l, d F Y H:i:s') }} WIB</h6>
                    <div class="card-img-top">
                        <img src="{{ asset($berita->thumbnail) }}" class="d-block mx-auto my-4 w-75">
                    </div>
                    {{-- <img src="{{ asset($berita->thumbnail) }}" class="card-img-top my-2" style="padding: 0 10rem"> --}}
                    <div class="card-text description">
                        {!! $berita->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
