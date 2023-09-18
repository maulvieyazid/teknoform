<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V7SPTCQH9B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-V7SPTCQH9B');
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=.5">
    <!-- <meta name="viewport" content="initial-scale=1, maximum-scale=1"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86"> -->
    <title>Museum Teknoform</title>
    <link rel="shortcut icon" href="https://gate.dinamika.ac.id/static/img/icon-stikom.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/taras-d/images-grid/src/images-grid.min.css"> --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/taras-d/images-grid/src/images-grid.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js" integrity="sha256-SmCcbf/1ehhlBnw3ZGinNu6fjQV471LDBjc4yMMJhsk=" crossorigin="anonymous"></script> --}}
    <style>
        @font-face {
            font-family: avenir;
            src: url("{{ asset('fonts/AVENIRLTSTD-MEDIUM_0.OTF') }}");
        }
        @font-face {
            font-family: avenir-bold;
            src: url("{{ asset('fonts/AVENIR-BLACK.OTF') }}");
            font-weight: bold;
        }
        body {
            font-family: avenir;
            color: white;
            overflow-x: hidden;
        }
        h1, h2, b {
            font-family: avenir-bold;
        }
        /* Centered texts in each section
	* --------------------------------------- */
        .section {
            /* text-align: center; */
            background-size: cover;
            background-position: center;
        }

        #infoMenu li a {
            color: #fff;
        }

        .abs-center-x {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .btn-circle {
            width: 40px;
            height: 40px;
            /* padding: 7px 10px;  */
            border-radius: 25px;
            text-align: center;
        }
        .circle-item {
            width: 40px;
            height: 40px;
            padding: 7px 8px;
            margin-top: 4px;
            margin-bottom: 4px;
            border-radius: 25px;
            text-align: center;
        }
        .card {
            background-color: #ffffff20;
        }
        .card-body {
            padding: 1rem;
        }
        .floating-sidebar {
            padding: 0 .7rem;
            height: 28.3rem;
            position: absolute;
            right: -10.55rem;
            /* top: calc((100% - 26rem)/2); */
            top: calc(100% - 33rem);
            background-color: black;
            z-index: 20;
            transition: 1s;
        }

        .bg-dark {
            background-color: #000 !important;
        }
        .bg-maroon {
            /* background-color: #BA1C2C; */
            background-color: #a61e22;
        }
        /* override bullet navigation */
        #pp-nav {
            display: none;
        }

        .btn-penmaru {
            width: 10rem;
            height: 3.25rem;
            line-height: 1rem;
            text-transform: uppercase;
            border-radius: 0;
            letter-spacing: 0.2rem;
        }

        @media screen and (width: 320px) {
            .logo-container{
                margin-left: 0;
                margin-right: 0;
            }
        }

        .carousel-control-next,
        .carousel-control-prev {
            width: 10%;
        }

        .first-nav {
            display: flex;
            position: absolute;
            top: 0;
            width: calc(100% - 4rem);
            border-bottom: 1px solid white;
            padding-top: 1rem;
            padding-bottom: 1rem;
            margin-left: 2rem;
            margin-right: 2rem;
            vertical-align: middle;
            align-items: center;
        }

        .carousel-indicators {
            bottom: -3rem;
        }
        .carousel-indicators li {
            width: 10px;
            height: 10px;
            border-radius: 100%;
        }

        .font-4 {
            font-size: 4.5rem;
            font-weight: 900;
        }

        p {
            font-size: .85rem;
        }

        .floating-menu {
            position: absolute;
            z-index: 10;
            display: block;
            right: 0;
            /* top: 15rem; */
            /* top: calc((100% - 5.3rem)/2); */
            top: calc((100% - (26rem/2)));
            background: black;
            padding: 1.15rem;
            text-align: center;
            transition: 1s;
            cursor: pointer;
        }

        hr {
            border-top: 2px solid #fff;
            width: 10rem;
        }

        .profil-menu {
            display: flex;
            position: absolute;
            bottom: 0;
            justify-content: center;
            background-color: #80808082;
            width: 100%;
        }

        .floating-wa {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
        }
    </style>
    @stack('css')
</head>

<body>
    <header>
        <div class="floating-menu">
            <p class="mb-0">MENU</p>
            <i class="fas fa-bars fa-lg"></i>
        </div>
        <div class="floating-sidebar text-center" id="menu">
            <div class="m-3" data-menuanchor="home"><a href="{{ Request::is('/') ? '#home' : url('/#home') }}" class="text-white">HOME</a></div>
            <div class="m-3" data-menuanchor="profil"><a href="{{ Request::is('/') ? '#profil' : url('/#profil') }}" class="text-white">PROFIL</a></div>
            <div class="m-3" data-menuanchor="koleksi"><a href="{{ Request::is('/') ? '#koleksi' : url('/#koleksi') }}" class="text-white">KOLEKSI</a></div>
            <div class="m-3" data-menuanchor="berita"><a href="{{ Request::is('/') ? '#berita' : url('/#berita') }}" class="text-white">BERITA</a></div>
            <div class="m-3" data-menuanchor="gallery"><a href="{{ Request::is('/') ? '#gallery' : url('/#gallery') }}" class="text-white">GALLERY</a></div>
            <div class="m-3" data-menuanchor="agenda"><a href="{{ Request::is('/') ? '#agenda' : url('/#agenda') }}" class="text-white">AGENDA</a></div>
            <div class="m-3" data-menuanchor="hubungi"><a href="{{ Request::is('/') ? '#hubungi' : url('/#hubungi') }}" class="text-white">HUBUNGI</a></div>
            <div class="m-3"><a href="{{ Request::is('katalog') ? '#' : url('katalog') }}" class="text-white">MERCHANDISE</a></div>
            <div class="m-3"><a href="{{ Request::is('ensiklopedia') ? '#' : url('ensiklopedia') }}" class="text-white">ENSIKLOPEDIA</a></div>
            <div class="m-3"><a href="#" class="text-white">LAPORAN</a></div>
            <div class="m-3"><a href="/360" class="text-white">VIRTUAL TOUR</a></div>
        </div>
    </header>
    @yield('content')

    <script type="text/javascript">

        var value = false;
        showMenu(value);
        function showMenu(val){
            if(val == true){
                $('.floating-sidebar').css('right', '0');
                $('.floating-menu').css('right', '10.55rem');
                $('.floating-menu').css('opacity', '100%');
                // $('.floating-sidebar').show();
            }else{
                // $('.floating-sidebar').hide();
                $('.floating-sidebar').css('right', '-10.55rem');
                $('.floating-menu').css('right', '0');
                $('.floating-menu').css('opacity', '50%');
            }
        }
        $(document).click(function(e) {
            // console.log(value);
            // console.log(e.target.offsetParent);
            if ((!$(e.target).is('.floating-menu') && value) || ($(e.target.offsetParent).is('.floating-menu') && value) || ($(e.target).is('.floating-menu') && !value) || ($(e.target.offsetParent).is('.floating-menu') && !value)) {
                // $('.floating-menu').click();
                value = !value;
                showMenu(value);
                // console.log("now : "+value);
            }
        });

    </script>
    @stack('js')
</body>

</html>
