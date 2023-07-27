@extends('layouts.museum')
@section('content')
<div class="section" id="home" style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
    <div class="container py-5">
        <h1>Donasi</h1>
        <form action="{{ route('tambah-donasi') }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-lg-7">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama Pemberi <span style="color:red">*</span></label>
                            <input name="nama" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Email <span style="color:red">*</span></label>
                            <input name="email" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>No. HP <span style="color:red">*</span></label>
                            <input name="telp" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama Koleksi <span style="color:red">*</span></label>
                            <input name="nama_koleksi" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input name="foto" type="file" accept="image/*" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Kenangan Koleksi</label>
                            <textarea name="deskripsi" class="form-control" rows="5"
                            placeholder="Tuliskan kenangan atau hal yang berkesan mengenai benda yang akan di donasikan tersebut"></textarea>
                        </div>
                        <button type="submit" nama="simpan" class="btn text-white border rounded-0" style="width: 10rem;">Kirim</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <h3>Aturan Hibah / Donasi Barang</h3>
                <div class="text-justify">
                    <ol>
                        <li class="mb-3">Donatur WAJIB mengisi data-data berikut dengan sebenar-benarnya.</li>
                        <li class="mb-3">Barang koleksi yang didonasikan harus sesuai dengan tema Museum Teknoform, yaitu Teknologi Informasi.</li>
                        <li class="mb-3">Koleksi yang diberikan kepada Museum Teknoform, sepenuhnya akan menjadi milik Museum Teknoform dan akan dipamerkan di ruang pamer Museum Teknoform.</li>
                        <li class="mb-3">Museum Teknoform tidak melakukan penggantian untuk barang yang didonasikan dalam bentuk uang.</li>
                    </ol>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
