@extends('layouts.museum')
@push('css')
    <script src="{{ asset('vendors/spotlight/spotlight.bundle.js') }}"></script>
@endpush
@section('content')
    <div class="section" id="home"
        style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            {{-- <a class="btn btn-primary" href="{{ route('katalog-koleksi') }}">Back</a> --}}
            <div class="row align-items-center">
                <div class="col-lg-6 text-center align-self-start">
                    {{-- <img src="{{ asset($koleksi->file_photo()[0]) }}" class="w-75" /> --}}
                    <div id="carouselProduk" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">

                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <a href="{{ asset($koleksi->foto) }}" class="spotlight" data-download=true>
                                    <img src="{{ asset($koleksi->foto) }}" class="w-75" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2>{{ $koleksi->nama_koleksi }}</h2>
                    <h4>{{ $koleksi->jenis ? "Jenis : $koleksi->jenis" : '' }}</h4>
                    <h4>{{ $koleksi->merk ? "Merk : $koleksi->merk" : '' }}</h4>
                    <h4>{{ $koleksi->tipe ? "Tipe : $koleksi->tipe" : '' }}</h4>

                    {!! $koleksi->deskripsi !!}
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
    {{-- <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    $('[data-toggle="tooltip"]').tooltip().tooltip('show');
</script> --}}
@endpush
