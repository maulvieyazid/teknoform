@extends('layouts.app', ['sidebar' => 'pengunjung'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}">

    <!-- Select2 -->
    <link href="{{ asset('vendors/select2/select2@4.1.0.min.css') }}" rel="stylesheet" />

    <style>
        .select2-results__options {
            color: #495057 !important;
        }
    </style>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endpush

@php
    use App\Pengunjung;
@endphp

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
                                <form class="form form-horizontal" action="{{ route('pengunjung.update', $pengunjung->id_pengunjung) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <label>Nama Pengunjung</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="nama_pengunjung" class="form-control" name="nama_pengunjung" value="{{ $pengunjung->nama_pengunjung }}" required autofocus>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="alamat" class="form-control" name="alamat" value="{{ $pengunjung->alamat }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Kota Asal</label>
                                            </div>
                                            <div class="col-md-9 form-group mb-3">
                                                <select name="asal_pengunjung" id="asal_pengunjung" class="form-control">
                                                    <option value="" selected></option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Kategori Pengunjung</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <select name="kategori_pengunjung" id="kategori_pengunjung" class="form-control">
                                                    <option value="" selected></option>
                                                    <option value="{{ Pengunjung::KATEGORI_UMUM }}" {{ $pengunjung->kategori_pengunjung == Pengunjung::KATEGORI_UMUM ? 'selected' : '' }}>
                                                        Umum
                                                    </option>
                                                    <option value="{{ Pengunjung::KATEGORI_SD }}" {{ $pengunjung->kategori_pengunjung == Pengunjung::KATEGORI_SD ? 'selected' : '' }}>
                                                        SD
                                                    </option>
                                                    <option value="{{ Pengunjung::KATEGORI_SMP }}" {{ $pengunjung->kategori_pengunjung == Pengunjung::KATEGORI_SMP ? 'selected' : '' }}>
                                                        SMP
                                                    </option>
                                                    <option value="{{ Pengunjung::KATEGORI_SMA }}" {{ $pengunjung->kategori_pengunjung == Pengunjung::KATEGORI_SMA ? 'selected' : '' }}>
                                                        SMA
                                                    </option>
                                                    <option value="{{ Pengunjung::KATEGORI_PT }}" {{ $pengunjung->kategori_pengunjung == Pengunjung::KATEGORI_PT ? 'selected' : '' }}>
                                                        Perguruan Tinggi
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Instansi</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="instansi" class="form-control" name="instansi" value="{{ $pengunjung->instansi }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Jumlah Pengunjung</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="jumlah_pengunjung" class="form-control" name="jumlah_pengunjung" value="{{ $pengunjung->jumlah_pengunjung }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Selesai Kunjungan</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <input type="text" id="created_at" class="form-control" name="created_at" autocomplete="off">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Dari</label>
                                            </div>
                                            <div class="col-md-9 form-group">
                                                <select name="input_dari" id="input_dari" class="form-control">
                                                    <option value="" selected></option>
                                                    <option value="{{ Pengunjung::DARI_BUKU_TAMU }}" {{ $pengunjung->input_dari == Pengunjung::DARI_BUKU_TAMU ? 'selected' : '' }}>
                                                        Buku Tamu
                                                    </option>
                                                    <option value="{{ Pengunjung::DARI_VIRTUAL_TOUR }}" {{ $pengunjung->input_dari == Pengunjung::DARI_VIRTUAL_TOUR ? 'selected' : '' }}>
                                                        Virtual Tour
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
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

        <!-- Select2 -->
        <script src="{{ asset('vendors/select2/select2@4.1.0.min.js') }}"></script>

        @php
            // Mengambil data kota dari file json
            $data = json_decode(file_get_contents(asset('data_kota.json')));
            // Merubah menjadi collection, lalu diambil nama kota nya saja
            $data = collect($data)->pluck('kabupatenkota_nama');
        @endphp
        <script>
            // Blade directive untuk melemparkan nilai php ke javascript sebagai json
            let data = @json($data);

            $(document).ready(function() {
                $('#asal_pengunjung').select2({
                    data: data, // Menggunakan data dari array
                });

                $('#asal_pengunjung').val('{{ $pengunjung->asal_pengunjung }}').trigger('change');
            });
        </script>


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
