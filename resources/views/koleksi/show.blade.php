@extends('layouts.app', ['sidebar' => 'koleksi'])

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Koleksi</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <a href="{{ route('koleksi.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_koleksi" class="form-control"
                                                    name="nama_koleksi" placeholder="Nama Koleksi" value="{{ $koleksi->nama_koleksi }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Jenis Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="jenis" class="form-control"
                                                    name="jenis" placeholder="Jenis Koleksi" value="{{ $koleksi->jenis }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Merk Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="merk" class="form-control"
                                                    name="merk" placeholder="Merk Koleksi" value="{{ $koleksi->merk }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Tipe Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="tipe" class="form-control"
                                                    name="tipe" placeholder="Tipe Koleksi" value="{{ $koleksi->tipe }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <img id="image_preview" src="{{ asset($koleksi->foto ?? 'images/no-photos.webp') }}"
                                                    width="200" height="200">
                                            </div>
                                            @if ($koleksi->donasi()->exists())
                                                <div class="col-md-2">
                                                    <label>Data Donasi</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="{{ route('donasi.edit', $koleksi->donasi->id_donasi) }}"
                                                        class="btn btn-primary">
                                                        <i class="bi bi-arrow-right-circle" style="vertical-align: sub"></i>
                                                        Menuju Donasi
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="col-md-2">
                                                <label>Deskripsi Koleksi</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi">{!! $koleksi->deskripsi !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>

        <script>
            ClassicEditor
                .create(document.getElementById('deskripsi'))
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endpush
@endsection
