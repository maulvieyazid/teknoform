@extends('layouts.app', ['sidebar' => 'pengunjung'])

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Pengunjung</h3>
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
                                    <a href="{{ route('pengunjung.index') }}" class="btn btn-secondary">
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
                                                <label>Nama Pengunjung</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_pengunjung" class="form-control"
                                                    name="nama_pengunjung" placeholder="Nama Pengunjung"
                                                    value="{{ $pengunjung->nama_pengunjung }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="alamat" class="form-control" name="alamat"
                                                    placeholder="Alamat" value="{{ $pengunjung->alamat }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Instansi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="instansi" class="form-control" name="instansi"
                                                    placeholder="Instansi / Sekolah" value="{{ $pengunjung->instansi }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Selesai Kunjungan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    value="{{ $pengunjung->created_at->translatedFormat('l, d F Y H:i:s') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Pesan / Kesan</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="pesan_kesan"
                                                    id="pesan_kesan">{!! $pengunjung->pesan_kesan !!}</textarea>
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
                .create(document.getElementById('pesan_kesan'))
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endpush
@endsection
