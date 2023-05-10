@extends('layouts.museum')
@section('content')
<div id="pagepiling">
    <div class="section" id="home" style="background-image: url('backgrounds/desain-website-museum_bg_01_optimized.jpg');">
        <div class="fluid-container first-nav" style="">
            <img src="images/logo-museum.png" height="50" class="mr-3 ml-5" />
            <img src="images/logo-white.png" height="50" />
            <div class="ml-auto d-flex social-media-nav">
                <a class="nav-link" href="https://www.facebook.com/universitasdinamika/" target="_blank"><i class="fab fa-facebook-f fa-lg text-white"></i></a>
                <a class="nav-link" href="https://www.youtube.com/user/stikomsurabaya" target="_blank"><i class="fab fa-youtube fa-lg text-white"></i></a>
                <a class="nav-link" href="https://twitter.com/undikasurabaya" target="_blank"><i class="fab fa-twitter fa-lg text-white"></i></a>
                <a class="nav-link" href="https://www.instagram.com/universitasdinamika" target="_blank"><i class="fab fa-instagram fa-lg text-white"></i></a>
            </div>
        </div>
        <div id="carouselId" class="carousel slide" data-ride="carousel">
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
        </div>
    </div>
    
    <div class="section" id="profil" style="background-image: url('backgrounds/desain-website-museum_bg_02_optimized.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <img src="images/Desain Website Museum_IMG_01.png" class="w-75" />
                </div>
                <div class="col-lg-6 col-12 mt-lg-0 mt-5">
                    <h3 class="mb-1">Profil</h3>
                    <h1 class="font-weight-bolder">Museum Teknoform</h1>
                    <hr class="mr-auto ml-0">
                    <p>Museum teknoform merupakan museum pertama di Surabaya yang membahas tentang perkembangan teknologi informasi dari masa ke masa khususnya pada perkembangan komputer. Perkembangan teknologi informasi yang dibahas dimulai dari perkembangan teknologi zaman praaksara, hingga teknologi informasi di zaman sekarang.</p>
                    <p>Museum Teknoform berlokasi di Jalan Raya Kedung Baruk no. 98 Surabaya, Universitas Dinamika. Museum Teknoform memiliki ratusan koleksi yang dikategorikan berdasarkan perkembangannya, seperti perkembangan alat tulis, telepon, radio, handphone, jam, hingga perangkat komputer masa kini</p>
                    <a href="#" class="btn text-white border rounded-0" style="width: 10rem">READ MORE</a>
                </div>
            </div>
        </div>
        
        <div class="profil-menu">
            <a href="#hubungi" class="text-white mx-3 mt-3 text-center">
                <i class="fas fa-comment fa-3x"></i>
                <p class="mt-2">Kritik saran</p>
            </a>
            <!-- <a href="#" data-toggle="modal" data-target="#modalBooking" class="text-white mx-3 mt-3 text-center"> -->
            <a href="{{ route('booking-online') }}" class="text-white mx-3 mt-3 text-center">
                <i class="fas fa-book fa-3x"></i>
                <p class="mt-2">Booking Online</p>
            </a>
            <a href="#" class="text-white mx-3 mt-3 text-center">
                <i class="fas fa-shopping-bag fa-3x"></i>
                <p class="mt-2">Merchandise</p>
            </a>
            <a href="{{ route('donasi-koleksi') }}" class="text-white mx-3 mt-3 text-center">
                <i class="fas fa-donate fa-3x"></i>
                <p class="mt-2">Donation</p>
            </a>
        </div>
    </div>
    <div class="section" id="koleksi" style="background-image: url('backgrounds/desain-website-museum_bg_03_optimized.jpg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12 mt-lg-0 mt-5">
                    <h3 class="mb-1">Koleksi</h3>
                    <h1 class="font-weight-bold">Museum</h1>
                    <hr class="mr-auto ml-0">
                    <p>Museum teknoform merupakan museum pertama di Surabaya yang membahas tentang perkembangan teknologi informasi dari masa ke masa khususnya pada perkembangan komputer. Perkembangan teknologi informasi yang dibahas dimulai dari perkembangan teknologi zaman praaksara, hingga teknologi informasi di zaman sekarang.</p>
                    <div class="d-flex">
                        <i class="fas fa-arrow-circle-left fa-2x mr-3"></i>
                        <i class="fas fa-arrow-circle-right fa-2x"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="images/Desain Website Museum_IMG_02.png" class="w-100 mt-5" />
                            <hr>
                            <p class="mb-0">Mesin Ketik</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="images/Desain Website Museum_IMG_03.png" class="w-100 mt-2" />
                            <hr>
                            <p class="mb-0">Mesin Ketik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section" id="benang-merah" style="background-image: url('backgrounds/desain-website-museum_bg_04_optimized.jpg');">
        <div class="container">
            <h3 class="text-right">Majalah</h3>
            <h1 class="text-right font-weight-bolder">Benang Merah</h1>
            <hr class="ml-auto mr-0">
        </div>
        <div id="carouselBenangMerah" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselBenangMerah" data-slide-to="0" class="active"></li>
                <li data-target="#carouselBenangMerah" data-slide-to="1"></li>
                <li data-target="#carouselBenangMerah" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="container d-flex">
                        <img src="images/Desain Website Museum_IMG_04.png" class="w-50" alt="First slide">
                        <div class="card w-100">
                            <div class="card-body">
                                <h4>Benang Merah</h4>
                                <p>Mencatat Sejarah</p>
                                <p class="mb-5">Edisi 5 Vol. 1</p>
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
                </div>
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
    <div class="section" id="gallery" style="background-image: url('backgrounds/desain-website-museum_bg_05_optimized.jpg');">
        <div class="container">
            <h3>Foto</h3>
            <h1 class="font-weight-bolder">Gallery</h1>
            <hr class="mr-auto ml-0">
            <div id="gallery-foto" class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-img-top">
                            <img class="w-100" src="images/Desain Website Museum_IMG_05.png" />
                            <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                <p>Peresmian Museum Teknoform</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-img-top">
                            <img class="w-100" src="images/Desain Website Museum_IMG_06.png" />
                            <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                <p>Peresmian Museum Teknoform</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-img-top">
                            <img class="w-100" src="images/Desain Website Museum_IMG_07.png" />
                            <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                <p>Peresmian Museum Teknoform</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center my-3">
                <a class="text-white" href="#"><i class="mx-2 fas fa-arrow-circle-left fa-2x"></i></a>
                <a class="text-white" href="#"><i class="mx-2 fas fa-arrow-circle-right fa-2x"></i></a>
            </div>
        </div>
    </div>
    <div class="section" id="agenda" style="background-image: url('backgrounds/desain-website-museum_bg_06_optimized.jpg');">
        <div class="container">
            <div class="row">
                <div class="col mx-5">
                    <h3 class="text-right">Museum</h3>
                    <h1 class="text-right font-weight-bolder">Agenda</h1>
                    <hr class="ml-auto mr-0">
                </div>
            </div>
            <div id="agenda-museum" class="row">
                <!-- <div class="col-4"> -->
                    <div class="card ml-auto" style="width: 23%">
                        <div class="card-img-top">
                            <img class="w-100" src="images/Desain Website Museum_IMG_08.png" />
                            <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                <p>Pameran Satu Ruang</p>
                                <small>21-25 September 2019</small>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                <!-- <div class="col-4"> -->
                    <div class="card mx-5" style="width: 23%">
                        <div class="card-img-top">
                            <img class="w-100" src="images/Desain Website Museum_IMG_08.png" />
                            <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                <p>Pameran Satu Ruang</p>
                                <small>21-25 September 2019</small>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                <!-- <div class="col-4"> -->
                    <div class="card mr-auto" style="width: 23%">
                        <div class="card-img-top">
                            <img class="w-100" src="images/Desain Website Museum_IMG_08.png" />
                            <div class="w-100 position-absolute p-3" style="bottom: 0; background-color: #000000a1">
                                <p>Pameran Satu Ruang</p>
                                <small>21-25 September 2019</small>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn text-white border rounded-0" style="width: 10rem">SEE ALL</button>
        </div>
    </div>
    <div class="section" id="hubungi" style="background-image: url('backgrounds/desain-website-museum_bg_07_optimized.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h1 class="font-weight-bolder">Hubungi Kami</h1>
                    <hr class="mr-auto ml-0">
                    <div class="form-group">
                        <label>Nama <span style="color: red">*</span></label>
                        <input type="text" name="nama" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>Email <span style="color: red">*</span></label>
                        <input type="email" name="email" class="form-control" required/>
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
                </div>
                <div class="col-md-6 col-12">
                    <b>Alamat Museum</b>
                    <p>Kampus Universitas Dinamika<br>Jalan Raya Kedung Baruk no. 98 Surabaya</p>
                    
                    <b>Buka:</b>
                    <p>Senin - Jum'at pukul 09.00 - 16.00 WIB</p>
                    
                    <b>Email:</b>
                    <p>museum@dinamika.ac.id</p>

                    <b>Telepon / Fax</b>
                    <p>T 031 - 721731 &nbsp; F 031 - 8710218</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15829.505576089192!2d112.7824338!3d-7.3115441!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf13eec4465c5a263!2sUniversitas%20Dinamika%20(STIKOM%20Surabaya)!5e0!3m2!1sen!2sus!4v1618467703795!5m2!1sen!2sus" height="300" style="width: 100%; border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
@endsection
@push('js')
<script type="text/javascript">
    $('#pagepiling').pagepiling({
        menu: '#menu',
        direction: 'vertical',
        verticalCentered: true,
        sectionsColor: [],
        anchors: ['home','profil','koleksi','benang-merah','gallery','agenda','hubungi'],
        scrollingSpeed: 1500,
        easing: 'swing',
        loopBottom: true,
        loopTop: true,
        css3: true,
        navigation: {
            'textColor': '#000',
            'bulletsColor': '#000',
            'position': 'right',
            // 'tooltips': ['section1', 'section2', 'section3', 'section4']
        },
        normalScrollElements: null,
        normalScrollElementTouchThreshold: 5,
        touchSensitivity: 5,
        keyboardScrolling: true,
        sectionSelector: '.section',
        animateAnchor: false,

    });
    /* var splider = new Splide( '#splide', {
            classes: {
                // Add classes for arrows.
                arrows: 'splide__arrows your-class-arrows',
                arrow : 'splide__arrow your-class-arrow',
                prev  : 'splide__arrow--prev your-class-prev',
                next  : 'splide__arrow--next your-class-next',
                
                // Add classes for pagination.
                pagination: 'splide__pagination your-class-pagination', // container
                page      : 'splide__pagination__page your-class-page', // each button
            },
        } ).mount(); */

</script>
@endpush