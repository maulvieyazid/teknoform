@extends('layouts.museum')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}" />
@endpush
@section('content')

    <div class="section" id="home"
        style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            <h1 class="mb-4">Semua Agenda</h1>
            <div class="row">
                @foreach ($agenda as $item)
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                        <div class="card mx-5 h-100">
                            <a href="{{ route('event-agenda', $item->slug) }}"
                                style="text-decoration: none; color: white;">
                                <div class="card-img-top">
                                    <img class="w-100" src="{{ asset($item->foto) ?? 'images/no-photos.webp' }}" />
                                    <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                        <p>{{ $item->nama_agenda }}</p>
                                        <small>
                                            @if ($item->tanggal_mulai->toDateString() == $item->tanggal_selesai->toDateString())
                                                {{ $item->tanggal_selesai->translatedFormat('d F Y') }}
                                            @else
                                                {{ $item->tanggal_mulai->translatedFormat('d') }} -
                                                {{ $item->tanggal_selesai->translatedFormat('d F Y') }}
                                            @endif
                                            <br>
                                            {{ $item->tanggal_mulai->translatedFormat('H:i') }} -
                                            {{ $item->tanggal_selesai->translatedFormat('H:i') }} WIB
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                    <div class="card mx-5 h-100">
                        <a href="#home">
                            <img src="http://museum.test/upload/agenda/agenda pameran satu ruang-pnWl1.jpeg"
                                class="card-img-top" alt="...">
                            <div class="card-body" style="position: absolute; bottom: 0; background: #000000a1;">
                                <p class="card-text" style="color: white">Some quick example text to build on the card title
                                    and make up the bulk of the card's content.</p>
                            </div>
                        </a>
                    </div>
                </div> --}}
            </div>
            <div class="d-flex justify-content-center">
                {{ $agenda->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
