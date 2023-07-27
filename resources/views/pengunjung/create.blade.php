@extends('layouts.app', ['sidebar' => 'pengunjung'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Pengunjung</h3>
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
                                <form class="form form-horizontal" method="POST"
                                    action="{{ route('pengunjung.store') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Pengunjung</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_pengunjung" class="form-control" value="{{ old('nama_pengunjung') }}"
                                                    name="nama_pengunjung" placeholder="Nama Pengunjung" required autofocus>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="alamat" class="form-control" name="alamat" value="{{ old('alamat') }}"
                                                    placeholder="Alamat">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Instansi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="instansi" class="form-control" name="instansi" value="{{ old('instansi') }}"
                                                    placeholder="Instansi / Sekolah">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Jml Pengunjung</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="number" id="jumlah_pengunjung" class="form-control" value="{{ old('jumlah_pengunjung') }}"
                                                    name="jumlah_pengunjung" placeholder="Jumlah Pengunjung" min="0">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Selesai Kunjungan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="created_at" class="form-control" name="created_at"
                                                    placeholder="Selesai Kunjungan" autocomplete="off" required>
                                            </div>

                                            <div class="col-md-2 mt-3">
                                                <label>Pesan / Kesan</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="pesan_kesan" id="pesan_kesan"></textarea>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
        <script src="{{ asset('vendors/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('vendors/flatpickr/id.js') }}"></script>

        <script>
            ClassicEditor
                .create(document.getElementById('pesan_kesan'))
                .catch(error => {
                    console.error(error);
                });
        </script>
        <script>
            flatpickr('#created_at', {
                altInput: true,
                altFormat: "l, d F Y H:i:S",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                position: "above",
                locale: 'id',
            })
        </script>
    @endpush
@endsection
