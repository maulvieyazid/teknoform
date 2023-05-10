@extends('layouts.museum')
@push('css')
<link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}"/>
@endpush
@section('content')
<div class="floating-wa" title="Icons made by <a href='https://www.flaticon.com/authors/pixel-perfect' title='Pixel perfect'>Pixel perfect</a> from <a href='https://www.flaticon.com/' title='Flaticon'>www.flaticon.com</a>">
    <a id="click-wa" href="https://wa.wizard.id/5ca591" target="_blank">
        <img src="{{ asset('images/whatsapp.png') }}" width="50" data-toggle="tooltip" data-placement="left" data-html="true" title="<b>Hubungi kami</b> untuk pemesanan/pertanyaan"/>
    </a>
</div>
<div class="section" id="home" style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
    <div class="container py-5">
        <h1 class="mb-4">Katalog Merchandise</h1>
        <div class="row">
            @foreach ($merchandise as $item)
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                <a href="{{ route('produk-merchandise', $item->slug) }}" class="card">
                    <img class="card-img-top" src="{{ asset($item->file_photo()[0]) }}"
                                style="height: 16rem; object-fit: cover">
                    <div class="card-body" style="text-decoration: none; color: white;">
                        <p class="mb-0">{{ $item->nama_merchandise }}</p>
                        <p class="mb-0">Rp. {{ $item->harga }}</p>
                        <p class="mb-0">Stok : {{ $item->stok }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
        {{ $merchandise->links("pagination::bootstrap-4") }}
        </div>
        <div class="card">
            {{-- <div class="card-body">
                <p class="mb-0">
                Terima kasih telah mengunjungi website Museum Teknoform dan berbelanja merchandise kami. <br>
                Terkait pembelian merchandise dimohon untuk melakukan konfirmasi order ke WhatsApp di nomor 0812-3442-4838 atau 0852-3046-4767 dengan mengisi format : <br>
                Nama Lengkap : <br>
                Alamat Lengkap : <br>
                No. Handphone : <br>
                Orderan (nama barang) : <br>
                Jumlah Order : <br>
                Kirim ekspedisi/ambil ditempat : <br>
                Produk pesanan kamu akan dikirim H+1 setelah melakukan pelunasan. Jadwal pengiriman atau pengambilan pesanan dapat dilakukan pada hari Senin-Jumat pukul 09.00 – 16.00. <br>
                Selamat berbelanja dan jangan lupa kunjungi Museum Teknoform ya!<br><br>
                Hormat kami,<br>
                Museum Teknoform.
                </p>
            </div> --}}
            <div class="card-body">
                <p class="mb-0">
                Terima kasih telah mengunjungi website Museum Teknoform dan berbelanja merchandise kami. <br>
                Untuk melakukan pembelian merchandise silahkan tekan tombol dengan ikon WhatsApp yang berada di pojok kanan bawah. <br>
                Anda akan diarahkan ke nomor WhatsApp Admin Museum Teknoform, dan selanjutnya anda tinggal mengisi data-data yang diperlukan sesuai dengan format yang telah disediakan secara otomatis. <br>
                Produk pesanan kamu akan dikirim H+1 setelah melakukan pelunasan.<br>
                Jadwal pengiriman atau pengambilan pesanan dapat dilakukan pada hari Senin-Jumat pukul 09.00 – 16.00. <br>
                Selamat berbelanja dan jangan lupa kunjungi Museum Teknoform ya!<br><br>
                Hormat kami,<br>
                Museum Teknoform.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ ('js/jquery.toast.min.js') }}"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$('[data-toggle="tooltip"]').tooltip().tooltip('show');
</script>
@if(session('status'))
<script>
    $.toast({
    heading: 'Information',
        text: "{{ session('status') }}",
        icon: 'success',
        position: 'top-right',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#9EC600'  // To change the background
    })
</script>
@endif
@endpush
