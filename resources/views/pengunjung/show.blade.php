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
                                            <div class="col-md-3">
                                                <label>Nama Pengunjung</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="nama_pengunjung" class="form-control" name="nama_pengunjung" value="{{ $pengunjung->nama_pengunjung }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="alamat" class="form-control" name="alamat" value="{{ $pengunjung->alamat }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Kota Asal</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="asal_pengunjung" class="form-control" name="asal_pengunjung" value="{{ $pengunjung->asal_pengunjung }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Kategori Pengunjung</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="asal_pengunjung" class="form-control" name="asal_pengunjung" value="{{ $pengunjung->kategori_pengunjung }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Instansi</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="instansi" class="form-control" name="instansi" value="{{ $pengunjung->instansi }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Jumlah Pengunjung</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="jumlah_pengunjung" class="form-control" name="jumlah_pengunjung" value="{{ $pengunjung->jumlah_pengunjung }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Selesai Kunjungan</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" class="form-control" value="{{ $pengunjung->created_at->translatedFormat('l, d F Y H:i:s') ?? '' }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Dari</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="input_dari" class="form-control" name="input_dari" value="{{ $pengunjung->input_dari }}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Pesan / Kesan</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="pesan_kesan" id="pesan_kesan" readonly>{!! $pengunjung->pesan_kesan !!}</textarea>
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
