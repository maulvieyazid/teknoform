@extends('email.layout')
@section('mail-section')
    @if ($status == 'setuju')
        <p>Hi <b>{{ $nama }}</b>,</p>
        <p>Terima kasih telah mengunjungi website Museum Teknoform dan melakukan registrasi untuk melakukan appointment
            kunjungan ke Museum Teknoform pada {{ $hari }}, {{ $tanggal }} {{ $pukul }}. Silahkan untuk
            langsung datang ke Museum Teknoform di Jalan Kedung Baruk no. 98 (Universitas Dinamika) Surabaya pada jadwal
            yang sudah ditentukan di atas.
        </p>
        <p>Mohon untuk para pengunjung mematuhi protokol kesehatan yang diterapkan yaitu wajib menggunakan masker, mencuci
            tangan saat memasuki area kunjungan serta menjaga jarak dengan pengunjung yang lain saat di dalam area museum.
        </p>
        <p>Selamat menikmati kunjunganmu di Museum Teknoform!</p>
    @endif

    @if ($status == 'batal')
        <p>Hi <b>{{ $nama }}</b>,</p>
        <p>Terima kasih telah mengunjungi website Museum Teknoform dan melakukan registrasi untuk melakukan appointment
            kunjungan ke Museum Teknoform.
            Mohon maaf kamu belum bisa melakukan kunjungan ke Museum Teknoform dikarenakan jadwal yang kamu pilih bersamaan
            dengan kunjungan pengunjung lain. Kamu bisa coba untuk melakukan appointment kunjungan lagi dengan pilihan hari
            sebagai berikut :</p>
        <p>Hari : Senin - Jumat<br />
            Pukul : 09.00 - 16.00 WIB</p>
        <p>Tidak lupa kami juga mengingatkan bagi para pengunjung untuk mematuhi protokol kesehatan yang diterapkan yaitu
            wajib menggunakan masker, mencuci tangan saat memasuki area kunjungan serta menjaga jarak dengan pengunjung yang
            lain saat di dalam area.
            Selamat menikmati kunjunganmu di Museum Teknoform!</p>
    @endif

    @if ($status == 'notif-booking')
        <p>Halo Museum Teknoform,</p>
        <p>
            <b>{{ $nama }}</b> telah mengirim permintaan kunjungan dengan keterangan sebagai berikut:
        </p>
        <p>Nama Pengunjung : {{ $nama }}</p>
        <p>Instansi / Sekolah : {{ $instansi }}</p>
        <p>No. Telp : {{ $telp }}</p>
        <p>Tanggal : {{ $hari }}, {{ $tanggal }}</p>
        <p>Waktu : {{ $pukul }}</p>
        <p>Jumlah : {{ $jumlah_peserta }} Orang</p>

        <p>
            Informasi lebih lanjut tentang pengajuan Kunjungan Museum Teknoform dapat dilihat di CMS Museum Teknoform oleh Admin.
        </p>

        <p>Terima Kasih</p>
    @endif
@endsection
