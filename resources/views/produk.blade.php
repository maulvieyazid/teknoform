@extends('layouts.museum')
@section('content')
<div class="floating-wa" title="Icons made by <a href='https://www.flaticon.com/authors/pixel-perfect' title='Pixel perfect'>Pixel perfect</a> from <a href='https://www.flaticon.com/' title='Flaticon'>www.flaticon.com</a>">
    <a id="click-wa" href="https://wa.wizard.id/5ca591" target="_blank">
        <img src="{{ asset('images/whatsapp.png') }}" width="50" data-toggle="tooltip" data-placement="left" data-html="true" title="<b>Hubungi kami</b> untuk pemesanan/pertanyaan"/>
    </a>
</div>
<div class="section" id="home" style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
    <div class="container py-5">
        {{-- <a class="btn btn-primary" href="{{ route('katalog-merchandise') }}">Back</a> --}}
        <div class="row align-items-center">
            <div class="col-lg-6 text-center align-self-start">
                {{-- <img src="{{ asset($merchandise->file_photo()[0]) }}" class="w-75" /> --}}
                <div id="carouselProduk" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($merchandise->file_photo() as $item)
                        <li data-target="#carouselProduk" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach ($merchandise->file_photo() as $item)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset($item) }}" class="w-75" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                {{-- <h2>{{ substr($produk['title'], 0, 20) }}</h2> --}}
                <h2>{{ $merchandise->nama_merchandise }}</h2>
                <h4>Rp. {{ $merchandise->harga }}</h4>
                <h4>Stok. {{ $merchandise->stok }}</h4>
                <p class="mb-0">Deskripsi:</p>
                {!! $merchandise->deskripsi !!}
                {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p> --}}
            </div>
        </div>

    </div>
</div>
@endsection
@push('js')
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    $('[data-toggle="tooltip"]').tooltip().tooltip('show');
</script>
@endpush
