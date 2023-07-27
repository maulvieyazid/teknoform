@extends('layouts.app', ['sidebar' => 'donasi'])

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Donasi</h3>
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
                                    <a href="{{ route('donasi.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama" class="form-control" name="nama"
                                                    placeholder="Nama Donatur" value="{{ $donasi->nama }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Email Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Email Donatur" value="{{ $donasi->email }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Alamat Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="alamat" class="form-control" name="alamat"
                                                    placeholder="Alamat Donatur" value="{{ $donasi->alamat }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>No. Hp Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="telp" class="form-control" name="telp"
                                                    placeholder="No. Hp Donatur" value="{{ $donasi->telp }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Nama Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_koleksi" class="form-control"
                                                    name="nama_koleksi" placeholder="Nama Koleksi"
                                                    value="{{ $donasi->nama_koleksi }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <img id="image_preview"
                                                    src="{{ asset($donasi->foto ?? 'images/no-photos.webp') }}"
                                                    width="200" height="200">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                @if ($donasi->status == 'tunggu')
                                                    <span class="badge bg-light-secondary">
                                                        <i class="bi bi-question-circle me-50"></i> Tunggu
                                                    </span>
                                                @elseif ($donasi->status == 'dalam pengiriman')
                                                    <span class="badge bg-light-info">
                                                        <i class="bi bi-clock me-50"></i> Dalam Pengiriman
                                                    </span>
                                                @elseif ($donasi->status == 'terima')
                                                    <span class="badge bg-light-success">
                                                        <i class="bi bi-check-circle me-50"></i> Terima
                                                    </span>
                                                @elseif ($donasi->status == 'tolak')
                                                    <span class="badge bg-light-danger">
                                                        <i class="bi bi-x-circle me-50"></i> Tolak
                                                    </span>
                                                @endif
                                            </div>
                                            @if ($donasi->koleksi()->exists())
                                                <div class="col-md-2">
                                                    <label>Data Koleksi</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="{{ route('koleksi.edit', $donasi->koleksi->id_koleksi) }}"
                                                        class="btn btn-primary">
                                                        <i class="bi bi-arrow-right-circle" style="vertical-align: sub"></i>
                                                        Menuju Koleksi
                                                    </a>
                                                </div>
                                            @endif
                                            @if ($donasi->status == 'tolak')
                                                <div class="col-md-2 alasan">
                                                    <label>Alasan</label>
                                                </div>
                                                <div class="col-md-10 form-group alasan">
                                                    <input type="text" id="alasan" class="form-control" name="alasan"
                                                        placeholder="Alasan" value="{{ $donasi->alasan }}">
                                                </div>
                                            @endif
                                            <div class="col-md-2">
                                                <label>Deskripsi Koleksi</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi">{!! $donasi->deskripsi !!}</textarea>
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
