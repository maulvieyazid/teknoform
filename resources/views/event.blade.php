@extends('layouts.museum')
@push('css')
    <script src="{{ asset('vendors/spotlight/spotlight.bundle.js') }}"></script>
@endpush
@section('content')
    <div class="section" id="home"
        style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            {{-- <a class="btn btn-primary" href="{{ route('katalog-merchandise') }}">Back</a> --}}
            <div class="row align-items-center">
                <div class="col-lg-6 text-center align-self-start">
                    {{-- <img src="{{ asset($merchandise->file_photo()[0]) }}" class="w-75" /> --}}
                    <div id="carouselProduk" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">

                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <a href="{{ asset($agenda->foto) }}" class="spotlight" data-download=true>
                                    <img src="{{ asset($agenda->foto) }}" class="w-75" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2>{{ $agenda->nama_agenda }}</h2>
                    <h5>Tanggal :
                        @if ($agenda->tanggal_mulai->toDateString() == $agenda->tanggal_selesai->toDateString())
                            {{ $agenda->tanggal_selesai->translatedFormat('d F Y') }}
                        @else
                            {{ $agenda->tanggal_mulai->translatedFormat('d') }} -
                            {{ $agenda->tanggal_selesai->translatedFormat('d F Y') }}
                        @endif
                    </h5>
                    {{-- <h5>Pukul :
                        {{ $agenda->tanggal_mulai->translatedFormat('H:i') }} -
                        {{ $agenda->tanggal_selesai->translatedFormat('H:i') }} WIB
                    </h5> --}}
                    <br>
                    {!! $agenda->deskripsi !!}
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')

@endpush
