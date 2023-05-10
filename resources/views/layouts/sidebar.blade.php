<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <h1>Museum</h1>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item @if ($sidebar=='home' ) {{ 'active' }} @endif">
                    <a href="{{ route('home') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='pengunjung' ) {{ 'active' }} @endif">
                    <a href="{{ route('pengunjung.index') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Pengunjung</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='kritiksaran' ) {{ 'active' }} @endif">
                    <a href="{{ route('kritiksaran.index') }}" class='sidebar-link'>
                        <i class="bi bi-inbox-fill"></i>
                        <span>Kritik & Saran</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='booking' ) {{ 'active' }} @endif">
                    <a href="{{ route('booking.index') }}" class='sidebar-link'>
                        <i class="bi bi-calendar2-check"></i>
                        <span>Booking</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='donasi' ) {{ 'active' }} @endif">
                    <a href="{{ route('donasi.index') }}" class='sidebar-link'>
                        <i class="bi bi-cash-stack"></i>
                        <span>Donasi</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='merchandise' ) {{ 'active' }} @endif">
                    <a href="{{ route('merchandise.index') }}" class='sidebar-link'>
                        <i class="bi bi-basket-fill"></i>
                        <span>Merchandise</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='koleksi' ) {{ 'active' }} @endif">
                    <a href="{{ route('koleksi.index') }}" class='sidebar-link'>
                        <i class="bi bi-archive-fill"></i>
                        <span>Koleksi</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='majalah' ) {{ 'active' }} @endif">
                    <a href="{{ route('majalah.index') }}" class='sidebar-link'>
                        <i class="bi bi-book"></i>
                        <span>Majalah</span>
                    </a>
                </li>

                <li class="sidebar-item @if ($sidebar=='berita' ) {{ 'active' }} @endif">
                    <a href="{{ route('berita.index') }}" class='sidebar-link'>
                        <i class="bi bi-newspaper"></i>
                        <span>Berita</span>
                    </a>
                </li>

                <li class="sidebar-item @if (collect(['kategori', 'galeri' ])->
                    contains($sidebar)) {{ 'active' }} @endif has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-image"></i>
                        <span>Galeri</span>
                    </a>
                    <ul class="submenu @if (collect(['kategori', 'galeri' ])->
                        contains($sidebar)) {{ 'active' }} @endif">
                        <li class="submenu-item @if ($sidebar=='kategori' ) {{ 'active' }} @endif">
                            <a href="{{ route('kategori.index') }}">Kelola Kategori</a>
                        </li>
                        <li class="submenu-item @if ($sidebar=='galeri' ) {{ 'active' }} @endif">
                            <a href="{{ route('galeri.index') }}">Kelola Galeri</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item @if ($sidebar=='agenda' ) {{ 'active' }} @endif">
                    <a href="{{ route('agenda.index') }}" class='sidebar-link'>
                        <i class="bi bi-calendar3"></i>
                        <span>Agenda</span>
                    </a>
                </li>

                <li class="sidebar-item"><br><br></li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
