@extends('layouts.museum')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}" />
    <script src="{{ asset('vendors/spotlight/spotlight.bundle.js') }}"></script>
@endpush
@section('content')
    <div class="section" id="home"
        style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            <h1 class="mb-4">Galeri {{ $kategori->nama_kategori }}</h1>
            <div class="row">
                @foreach ($kategori->galeri as $item)
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                        <a href="{{ asset($item->foto) }}" class="card spotlight"
                            data-description="{{ strip_tags($item->deskripsi) }}" data-download=true>
                            <img class="card-img-top" src="{{ asset($item->foto) }}"
                                style="height: 16rem; object-fit: cover">
                            {{-- <div class="card-body" style="text-decoration: none; color: white;">
                                <p class="mb-0">{{ $item->nama_foto }}</p>
                            </div> --}}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
