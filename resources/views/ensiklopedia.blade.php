@extends('layouts.museum')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}" />
@endpush
@section('content')
    <div class="section" id="home"
        style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            <h1 class="mb-4">Ensiklopedia</h1>
            <div class="row">
                @foreach ($semuaKoleksi as $item)
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                        <a href="{{ route('ensiklopedia-koleksi', $item->slug) }}" class="card">
                            <img class="card-img-top" src="{{ asset($item->foto) }}"
                                style="height: 16rem; object-fit: cover">
                            <div class="card-body" style="text-decoration: none; color: white;">
                                <p class="mb-0">{{ $item->nama_koleksi }}</p>
                                @if (!is_null($item->donasi))
                                    <p class="mb-0">Donatur : {{ $item->donasi->nama }}</p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $semuaKoleksi->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
