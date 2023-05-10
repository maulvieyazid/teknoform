@extends('layouts.app', ['sidebar' => 'pengunjung'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Pengunjung</h3>
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
                                <form class="form form-horizontal"
                                    action="{{ route('pengunjung.update', $pengunjung->id_pengunjung) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Pengunjung</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_pengunjung" class="form-control"
                                                    name="nama_pengunjung" placeholder="Nama Pengunjung"
                                                    value="{{ $pengunjung->nama_pengunjung }}" required autofocus>
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
                                                <label>Jml Pengunjung</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="jumlah_pengunjung" class="form-control"
                                                    name="jumlah_pengunjung" placeholder="Jumlah Pengunjung"
                                                    value="{{ $pengunjung->jumlah_pengunjung }}">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Selesai Kunjungan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="created_at" class="form-control" name="created_at"
                                                    placeholder="Selesai Kunjungan" autocomplete="off">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Pesan / Kesan</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="pesan_kesan" id="pesan_kesan">{!! $pengunjung->pesan_kesan !!}</textarea>
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
                defaultDate: "{{ $pengunjung->created_at }}",
            })
        </script>
    @endpush
@endsection
