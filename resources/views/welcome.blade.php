@extends('layouts.museum')

@push('css')
    {{-- <link rel="stylesheet" type="text/css" href="https://alvarotrigo.com/pagePiling/jquery.pagepiling.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fullpage.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}" />
    <script src="{{ asset('vendors/spotlight/spotlight.bundle.js') }}"></script>
@endpush

@section('content')
    <div id="pagepiling">
        <div class="section" id="section-home" style="background-image: url('{{ asset('backgrounds/desain-website-museum_bg_01_optimized.jpg') }}');">
            <div class="fluid-container first-nav" style="">
                <img data-src="images/logo-museum.png" height="50" class="mr-3 ml-5" />
                <img data-src="images/logo-white.png" height="50" />
                <div class="ml-auto d-flex social-media-nav">
                    <a class="nav-link" href="https://www.facebook.com/universitasdinamika/" target="_blank"><i class="fab fa-facebook-f fa-lg text-white"></i></a>
                    <a class="nav-link" href="https://www.youtube.com/user/stikomsurabaya" target="_blank"><i class="fab fa-youtube fa-lg text-white"></i></a>
                    <a class="nav-link" href="https://twitter.com/undikasurabaya" target="_blank"><i class="fab fa-twitter fa-lg text-white"></i></a>
                    <a class="nav-link" href="https://www.instagram.com/universitasdinamika" target="_blank"><i class="fab fa-instagram fa-lg text-white"></i></a>
                </div>
            </div>
            <div class="container">
                <div class="mb-3">
                    <h1 class="font-4 mb-0">This is</h1>
                    <h1 class="font-4 mb-0">Museum</h1>
                    <h1 class="font-4 mb-0">Teknoform.</h1>
                </div>
                <p class="">Museum Teknologi Informasi Universitas Dinamika</p>
                <hr>
            </div>
            {{-- <div id="carouselId" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                <li data-target="#carouselId" data-slide-to="1"></li>
                <li data-target="#carouselId" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="mb-3"><h1 class="font-4 mb-0">This is</h1><h1 class="font-4 mb-0">Museum</h1><h1 class="font-4 mb-0">Teknoform.</h1></div>
                        <p class="">Museum Teknologi Informasi Universitas Dinamika</p>
                        <hr>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="mb-3"><h1 class="font-4 mb-0">This is</h1><h1 class="font-4 mb-0">Museum</h1><h1 class="font-4 mb-0">Teknoform.</h1></div>
                        <p class="">Museum Teknologi Informasi Universitas Dinamika</p>
                        <hr>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="mb-3"><h1 class="font-4 mb-0">This is</h1><h1 class="font-4 mb-0">Museum</h1><h1 class="font-4 mb-0">Teknoform.</h1></div>
                        <p class="">Museum Teknologi Informasi Universitas Dinamika</p>
                        <hr>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                <i class="fas fa-arrow-circle-left fa-2x"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <i class="fas fa-arrow-circle-right fa-2x"></i>
                <span class="sr-only">Next</span>
            </a>
        </div> --}}
        </div>

        <div class="section" id="section-profil" style="background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <img data-src="images/Desain Website Museum_IMG_01.png" class="w-75" />
                    </div>
                    <div class="col-lg-6 col-12 mt-lg-0 mt-5">
                        <h3 class="mb-1">Profil</h3>
                        <h1 class="font-weight-bolder">Museum Teknoform</h1>
                        <hr class="mr-auto ml-0">
                        <p>Museum teknoform merupakan museum pertama di Surabaya yang membahas tentang perkembangan teknologi informasi dari masa ke masa khususnya pada perkembangan komputer. Perkembangan teknologi informasi yang dibahas dimulai dari
                            perkembangan teknologi zaman praaksara, hingga teknologi informasi di zaman sekarang.</p>
                        <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon,
                            radio, handphone, jam, hingga perangkat komputer masa kini</p>
                        <a href="#" data-toggle="modal" data-target="#modalProfil" class="btn text-white border rounded-0" style="width: 10rem">READ MORE</a>
                    </div>
                </div>
            </div>

            <div class="profil-menu" style="margin-bottom: 17px">
                <a href="#hubungi" class="text-white mx-3 mt-3 text-center">
                    <i class="fas fa-comment fa-3x"></i>
                    <p class="mt-2">Kritik saran</p>
                </a>
                <!-- <a href="#" data-toggle="modal" data-target="#modalBooking" class="text-white mx-3 mt-3 text-center"> -->
                <a href="{{ route('booking-online') }}" class="text-white mx-3 mt-3 text-center">
                    <i class="fas fa-book fa-3x"></i>
                    <p class="mt-2">Booking Online</p>
                </a>
                <a href="{{ route('katalog-merchandise') }}" class="text-white mx-3 mt-3 text-center">
                    <i class="fas fa-shopping-bag fa-3x"></i>
                    <p class="mt-2">Merchandise</p>
                </a>
                <a href="{{ route('donasi-koleksi') }}" class="text-white mx-3 mt-3 text-center">
                    <i class="fas fa-donate fa-3x"></i>
                    <p class="mt-2">Donation</p>
                </a>
            </div>
        </div>
        <div class="section" id="section-koleksi" style="background-image: url('{{ asset('backgrounds/desain-website-museum_bg_03_optimized.jpg') }}');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12 mt-lg-0 mt-5">
                        <h3 class="mb-1">Koleksi Terbaru</h3>
                        <h1 class="font-weight-bold">Museum</h1>
                        <hr class="mr-auto ml-0">
                        <p>Museum teknoform merupakan museum pertama di Surabaya yang membahas tentang perkembangan teknologi informasi dari masa ke masa khususnya pada perkembangan komputer. Perkembangan teknologi informasi yang dibahas dimulai dari
                            perkembangan teknologi zaman praaksara, hingga teknologi informasi di zaman sekarang.</p>
                        <div class="d-flex">
                            {{-- <i class="fas fa-arrow-circle-left fa-2x mr-3"></i>
                        <i class="fas fa-arrow-circle-right fa-2x"></i> --}}
                            <a class="text-white" href="#carouselKoleksi" role="button" data-slide="prev">
                                <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                                <i class="fas fa-arrow-circle-left fa-2x mr-3"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="text-white" href="#carouselKoleksi" role="button" data-slide="next">
                                <i class="fas fa-arrow-circle-right fa-2x"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div id="carouselKoleksi" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                {{-- <li data-target="#carouselKoleksi" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselKoleksi" data-slide-to="1"></li>
                            <li data-target="#carouselKoleksi" data-slide-to="2"></li> --}}
                                @php
                                    $jumlahKoleksi = $koleksi->count();
                                    $loopIndicatorKoleksi = (int) ($jumlahKoleksi > 2) ? ceil($jumlahKoleksi / 2) : 1;
                                @endphp
                                @for ($i = 0; $i < $loopIndicatorKoleksi; $i++)
                                    <li data-target="#carouselKoleksi" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                                @endfor
                                {{-- @foreach ($koleksi as $item)
                            @if ($loop->iteration % 2 == 0)
                            <li data-target="#carouselKoleksi" data-slide-to="{{ $i++ }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endif
                            @endforeach --}}
                            </ol>
                            <div class="carousel-inner spotlight-group" role="listbox">
                                <div class="carousel-item active">
                                    <div class="row">
                                        @foreach ($koleksi as $item)
                                            <div class="col-6">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <a class="spotlight" href="{{ asset($item->foto) }}" data-download=true>
                                                            <img data-src="{{ asset($item->foto) ?? 'images/no-photos.webp' }}" class="w-100 mt-2" />
                                                            {{-- style="max-height: 9.2rem; object-fit: contain;" --}}
                                                        </a>
                                                        <hr>
                                                        <p class="mb-0">
                                                            {{ $item->nama_koleksi }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($loop->iteration % 2 == 0 && !$loop->last)
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        @endif
                                        @endforeach
                                    </div>
                                </div>

                                {{-- <div class="carousel-item active">
                                <div class="container d-flex">
                                    <img src="images/Desain Website Museum_IMG_04.png" class="w-50" alt="First slide">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <h4>Benang Merah</h4>
                                            <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                                            <a href="#" class="btn text-white border rounded-0" style="width: 10rem">DOWNLOAD</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container d-flex">
                                    <img src="images/Desain Website Museum_IMG_04.png" class="w-50" alt="First slide">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <h4>Benang Merah</h4>
                                            <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                                            <a href="#" class="btn text-white border rounded-0" style="width: 10rem">DOWNLOAD</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container d-flex">
                                    <img src="images/Desain Website Museum_IMG_04.png" class="w-50" alt="First slide">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <h4>Benang Merah</h4>
                                            <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                                            <a href="#" class="btn text-white border rounded-0" style="width: 10rem">DOWNLOAD</a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="section-berita" style="background-image: url('{{ asset('backgrounds/Page-Berita.jpg') }}');">
            <div class="container">
                <h2 class="font-weight-bolder">Berita</h2>
                <hr class="mr-auto ml-0">
                <div id="carouselBerita" class="carousel slide" data-ride="carousel" data-interval="false">
                    {{-- <ol class="carousel-indicators">
                    <li data-target="#carouselBerita" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselBerita" data-slide-to="1"></li>
                    <li data-target="#carouselBerita" data-slide-to="2"></li>
                </ol> --}}
                    @if (!$berita->isEmpty())
                        <div class="carousel-inner" role="listbox">
                            @php
                                $jumlahData = $berita->count();
                                $indexData = 0;
                                $perCarouselItem = 3;
                                $perRow = 3;

                                /** Jumlah Looping Carousel Item
                                 * kalo jumlah datanya lebih dari $perCarouselItem, maka lakukan perhitungan untuk menemukan jumlah carousel itemnya
                                 * kalo enggak, maka buat 1 carousel item aja
                                 */
                                $loopCarouselItem = $jumlahData > $perCarouselItem ? ceil($jumlahData / $perCarouselItem) : 1;

                                /** Jumlah Looping Row
                                 * kalo jumlah datanya lebih dari $perRow, maka buat 2 baris
                                 * kalo enggak, buat 1 baris aja
                                 */
                                $loopRow = $jumlahData > $perRow ? 2 : 1;
                            @endphp
                            @for ($i = 0; $i < $loopCarouselItem; $i++)
                                <div class="carousel-item @if ($i == 0) {{ 'active' }} @endif">
                                    @for ($j = 0; $j < $loopRow; $j++)
                                        <div class="row mb-2">
                                            @for ($k = 0; $k < $perRow; $k++)
                                                @break($indexData == $jumlahData)
                                                <div class="col-4">
                                                    <div class="card h-100">
                                                        <a href="{{ route('berita', $berita[$indexData]->slug) }}" style="text-decoration: none; color: white;">
                                                            <div class="card-img-top">
                                                                <img class="w-100" style="object-fit: cover; max-height: 15rem;" data-src="{{ $berita[$indexData]->thumbnail }}" />
                                                                <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000f2">
                                                                    <p class="mb-0">{{ $berita[$indexData]->judul }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @php
                                                    $indexData++;
                                                @endphp
                                            @endfor
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                    @else
                        <h1>Tidak Ada Berita</h1>
                    @endif
                </div>
                <div class="d-flex justify-content-center my-3">
                    <a class="text-white" href="#carouselBerita" role="button" data-slide="prev"><i class="mx-2 fas fa-arrow-circle-left fa-2x"></i></a>
                    <a class="text-white" href="#carouselBerita" role="button" data-slide="next"><i class="mx-2 fas fa-arrow-circle-right fa-2x"></i></a>
                </div>
            </div>
        </div>
        <div class="section" id="section-benang-merah" style="background-image: url('{{ asset('backgrounds/desain-website-museum_bg_04_optimized.jpg') }}');">
            <div class="container">
                <h3 class="text-right">Majalah</h3>
                <h1 class="text-right font-weight-bolder">Benang Merah</h1>
                <hr class="ml-auto mr-0">
            </div>
            <div id="carouselBenangMerah" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    {{-- <li data-target="#carouselBenangMerah" data-slide-to="0" class="active"></li>
                <li data-target="#carouselBenangMerah" data-slide-to="1"></li>
                <li data-target="#carouselBenangMerah" data-slide-to="2"></li> --}}
                    @foreach ($majalah as $item)
                        <li data-target="#carouselBenangMerah" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner spotlight-group" role="listbox">
                    @foreach ($majalah as $item)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="container d-flex">
                                <a class="spotlight" href="{{ asset($item->thumbnail) }}">
                                    <img data-src="{{ asset($item->thumbnail) }}" class="w-100 h-100" alt="{{ $item->judul }}">
                                </a>
                                <div class="card w-100">
                                    <div class="card-body">
                                        <h4>Benang Merah</h4>
                                        <p>{{ $item->judul }}</p>
                                        <p class="">{{ $item->edisi }}</p>
                                        @if ($item->deskripsi != null)
                                            {{-- <p>{{ strip_tags($item->deskripsi) }}</p> --}}
                                            <p>{!! $item->deskripsi ?? '' !!}</p>
                                        @else
                                            <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan
                                                alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                                        @endif
                                        <a href="{{ route('majalah.show.file', $item->id_majalah) }}" target="_blank" class="btn text-white border rounded-0" style="width: 10rem">DOWNLOAD</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="carousel-item active">
                    <div class="container d-flex">
                        <img src="images/Desain Website Museum_IMG_04.png" class="w-50" alt="First slide">
                        <div class="card w-100">
                            <div class="card-body">
                                <h4>Benang Merah</h4>
                                <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                                <a href="#" class="btn text-white border rounded-0" style="width: 10rem">DOWNLOAD</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container d-flex">
                        <img src="images/Desain Website Museum_IMG_04.png" class="w-50" alt="First slide">
                        <div class="card w-100">
                            <div class="card-body">
                                <h4>Benang Merah</h4>
                                <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                                <a href="#" class="btn text-white border rounded-0" style="width: 10rem">DOWNLOAD</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container d-flex">
                        <img src="images/Desain Website Museum_IMG_04.png" class="w-50" alt="First slide">
                        <div class="card w-100">
                            <div class="card-body">
                                <h4>Benang Merah</h4>
                                <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                                <a href="#" class="btn text-white border rounded-0" style="width: 10rem">DOWNLOAD</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
                <a class="carousel-control-prev" href="#carouselBenangMerah" role="button" data-slide="prev">
                    <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselBenangMerah" role="button" data-slide="next">
                    <i class="fas fa-arrow-circle-right fa-2x"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="section" id="section-gallery" style="background-image: url('{{ asset('backgrounds/desain-website-museum_bg_05_optimized.jpg') }}');">
            <div class="container">
                <h3>Foto</h3>
                <h1 class="font-weight-bolder">Gallery</h1>
                <hr class="mr-auto ml-0">
                <div id="carouselGallery" class="carousel slide" data-ride="carousel" data-interval="false">
                    {{-- <ol class="carousel-indicators">
                    <li data-target="#carouselGallery" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselGallery" data-slide-to="1"></li>
                    <li data-target="#carouselGallery" data-slide-to="2"></li>
                </ol> --}}
                    @if (!$kategori->isEmpty())
                        <div class="carousel-inner" role="listbox">
                            @php
                                $jumlahData = $kategori->count();
                                $indexData = 0;
                                $perCarouselItem = 8;
                                $perRow = 4;

                                /** Jumlah Looping Carousel Item
                                 * kalo jumlah datanya lebih dari $perCarouselItem, maka lakukan perhitungan untuk menemukan jumlah carousel itemnya
                                 * kalo enggak, maka buat 1 carousel item aja
                                 */
                                $loopCarouselItem = $jumlahData > $perCarouselItem ? ceil($jumlahData / $perCarouselItem) : 1;

                                /** Jumlah Looping Row
                                 * kalo jumlah datanya lebih dari $perRow, maka buat 2 baris
                                 * kalo enggak, buat 1 baris aja
                                 */
                                $loopRow = $jumlahData > $perRow ? 2 : 1;
                            @endphp
                            @for ($i = 0; $i < $loopCarouselItem; $i++)
                                <div class="carousel-item @if ($i == 0) {{ 'active' }} @endif">
                                    @for ($j = 0; $j < $loopRow; $j++)
                                        <div class="row @if ($j == 0) {{ 'mb-3' }} @endif">
                                            @for ($k = 0; $k < $perRow; $k++)
                                                @break($indexData == $jumlahData)
                                                <div class="col-3">
                                                    <a href="{{ route('gallery', $kategori[$indexData]->slug) }}" class="card" style="text-decoration: none; color: white;">
                                                        <div class="card-img-top">
                                                            <img class="w-100" data-src="{{ asset($kategori[$indexData]->file_photo()[0] ?? 'images/no-photos.webp') }}" style="height: 12rem; object-fit: cover">
                                                            <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                                                <p class="mb-0">{{ $kategori[$indexData]->nama_kategori }}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                @php
                                                    $indexData++;
                                                @endphp
                                            @endfor
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                    @else
                        <h1>Tidak Ada Gallery</h1>
                    @endif
                </div>
                {{-- <div class="d-flex justify-content-center my-3">
                <a class="text-white" href="#carouselGallery" role="button" data-slide="prev"><i class="mx-2 fas fa-arrow-circle-left fa-2x"></i></a>
                <a class="text-white" href="#carouselGallery" role="button" data-slide="next"><i class="mx-2 fas fa-arrow-circle-right fa-2x"></i></a>
            </div> --}}
                <a class="carousel-control-prev" href="#carouselGallery" role="button" data-slide="prev">
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselGallery" role="button" data-slide="next">
                    <i class="fas fa-arrow-circle-right fa-2x"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="section" id="section-agenda" style="background-image: url('{{ asset('backgrounds/desain-website-museum_bg_06_optimized.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col mx-5">
                        <h3 class="text-right">Museum</h3>
                        <h1 class="text-right font-weight-bolder">Agenda</h1>
                        <hr class="ml-auto mr-0">
                    </div>
                </div>
                <div id="agenda-museum" class="row justify-content-center">
                    @forelse ($agenda as $item)
                        <div class="card mx-5" style="width: 23%">
                            <a href="{{ route('event-agenda', $item->slug) }}" style="text-decoration: none; color: white;">
                                <div class="card-img-top">
                                    <img class="w-100" data-src="{{ asset($item->foto) ?? 'images/no-photos.webp' }}" />
                                    <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                        <p>{{ $item->nama_agenda }}</p>
                                        <small>
                                            @if ($item->tanggal_mulai->toDateString() == $item->tanggal_selesai->toDateString())
                                                {{ $item->tanggal_selesai->translatedFormat('d F Y') }}
                                            @else
                                                {{ $item->tanggal_mulai->translatedFormat('d') }} - {{ $item->tanggal_selesai->translatedFormat('d F Y') }}
                                            @endif
                                            <br>
                                            {{-- {{ $item->tanggal_mulai->translatedFormat('H:i') }} - {{ $item->tanggal_selesai->translatedFormat('H:i') }} WIB --}}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h1>Tidak Ada Agenda</h1>
                    @endforelse

                </div>
            </div>
            <div class="text-center mt-3">
                @if (!$agenda->isEmpty())
                    <a href="{{ route('event') }}" class="btn text-white border rounded-0" style="width: 10rem">SEE ALL</a>
                @endif
            </div>
        </div>
        <div class="section" id="section-hubungi" style="background-image: url('{{ asset('backgrounds/desain-website-museum_bg_07_optimized.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <form action="{{ route('tambah-saran') }}" method="POST">
                            @csrf
                            <h1 class="font-weight-bolder">Kritik & Saran</h1>
                            <hr class="mr-auto ml-0">
                            <div class="form-group">
                                <label>Nama <span style="color: red">*</span></label>
                                <input type="text" name="nama" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Email <span style="color: red">*</span></label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" name="no_telp" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Pesan <span style="color: red">*</span></label>
                                <textarea type="text" name="pesan" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn bg-white text-black" style="width: 8rem; border-radius: 0;">KIRIM</button>
                        </form>
                    </div>
                    <div class="col-md-6 col-12">
                        <b>Alamat Museum</b>
                        <p>Kampus Universitas Dinamika<br>Jalan Raya Kedung Baruk no. 98 Surabaya</p>

                        <b>Buka:</b>
                        <p>Senin - Jum'at pukul 09.00 - 16.00 WIB</p>

                        <b>Email:</b>
                        <p>teknoform@dinamika.ac.id</p>

                        <b>Telepon / Fax</b>
                        <p>T 031 - 721731 &nbsp; F 031 - 8710218</p>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15829.505576089192!2d112.7824338!3d-7.3115441!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf13eec4465c5a263!2sUniversitas%20Dinamika%20(STIKOM%20Surabaya)!5e0!3m2!1sen!2sus!4v1618467703795!5m2!1sen!2sus"
                            height="300" style="width: 100%; border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Modal Profil -->
    <div class="modal fade" id="modalProfil" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title">Profil Museum Teknoform</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-secondary">
                    <div class="container-fluid">
                        <p>Museum teknoform merupakan museum pertama di Surabaya yang membahas tentang perkembangan teknologi informasi dari masa ke masa khususnya pada perkembangan komputer. Perkembangan teknologi informasi yang dibahas dimulai dari
                            perkembangan teknologi zaman praaksara, hingga teknologi informasi di zaman sekarang.</p>
                        <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon,
                            radio, handphone, jam, hingga perangkat komputer masa kini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($popUpAgenda)
        <!-- Modal Pop Up -->
        <div class="modal fade" id="modalPopUp" tabindex="-1" aria-labelledby="modalPopUpLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title" id="modalPopUpLabel">Agenda Terbaru</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-secondary text-center">
                        <a href="{{ route('event-agenda', $popUpAgenda->slug) }}">
                            <img src="{{ asset($popUpAgenda->foto) }}" alt="{{ $popUpAgenda->nama_agenda }}" style="height: 75vh;">
                        </a>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>
    @endif


    <footer class="footer mt-auto fixed-bottom" style="background-color: #f5f5f5">
        <div class="container" style="width: auto; max-width: 365px; padding: 0 15px;">
            <span class="text-dark">
                Jumlah Pengunjung Tahun {{ now()->format('Y') }} : {{ $jmlPengunjung }} Orang
            </span>
        </div>
    </footer>






@endsection

@push('js')

    {{-- <script type="text/javascript" src="https://alvarotrigo.com/pagePiling/jquery.pagepiling.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('js/fullpage.js') }}"></script>
    <script src="{{ 'js/jquery.toast.min.js' }}"></script>

    @if ($popUpAgenda)
        <script>
            document.addEventListener('DOMContentLoaded', function(e) {
                $('#modalPopUp').modal('show');
            });


            // $('#modalPopUp').on('show.bs.modal', event => {
            //     var button = $(event.relatedTarget);
            //     var modal = $(this);
            //     // Use above variables to manipulate the DOM

            // });
        </script>
    @endif


    <script type="text/javascript">
        // $('#pagepiling').pagepiling({
        var newFullpage = new fullpage('#pagepiling', {
            menu: '#menu',
            direction: 'vertical',
            verticalCentered: true,
            sectionsColor: [],
            anchors: ['home', 'profil', 'koleksi', 'berita', 'benang-merah', 'gallery', 'agenda', 'hubungi'],
            scrollingSpeed: 1500,
            easing: 'swing',
            loopBottom: true,
            loopTop: true,
            // css3: true,
            navigation: false,
            normalScrollElements: null,
            normalScrollElementTouchThreshold: 5,
            touchSensitivity: 5,
            keyboardScrolling: true,
            sectionSelector: '.section',
            slideSelector: '.section-slide',
            animateAnchor: false,

        });
        // var splider = new Splide( '#splide', {
        //         classes: {
        //             // Add classes for arrows.
        //             arrows: 'splide__arrows your-class-arrows',
        //             arrow : 'splide__arrow your-class-arrow',
        //             prev  : 'splide__arrow--prev your-class-prev',
        //             next  : 'splide__arrow--next your-class-next',

        //             // Add classes for pagination.
        //             pagination: 'splide__pagination your-class-pagination', // container
        //             page      : 'splide__pagination__page your-class-page', // each button
        //         },
        //     } ).mount();
    </script>

    @if (session('status'))
        <script>
            $.toast({
                heading: 'Information',
                text: "{{ session('status') }}",
                icon: 'success',
                position: 'top-right',
                loader: true, // Change it to false to disable loader
                loaderBg: '#9EC600' // To change the background
            })
        </script>
    @endif

@endpush
