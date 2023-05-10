@extends('layouts.museum')
@push('css')
<link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}"/>
@endpush
@section('content')
<div class="section" id="home" style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
    <div class="container py-5">
        <h1>Buku Tamu</h1>
        {{-- <p>Dapat diisi deskripsi panjang, diisi saat akhir berkunjung. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p> --}}
        <form action="{{ route('tambah-tamu') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-9 col-sm-12">
                <div class="form-group">
                    <label>Nama <span style="color:red">*</span></label>
                    <input name="nama_pengunjung" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Alamat <span style="color:red">*</span></label>
                    <input name="alamat" type="alamat" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Instansi/Sekolah <span style="color:red">*</span></label>
                    <input name="instansi" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Pesan/Kesan <span style="color:red">*</span></label>
                    <textarea name="pesan_kesan" class="form-control" required></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn text-white border rounded-0" style="width: 10rem;">Simpan</button>
        </form>
    </div>
</div>
@endsection
@push('js')
<script src="{{ ('js/jquery.toast.min.js') }}"></script>
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
