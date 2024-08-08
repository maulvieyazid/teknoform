@extends('layouts.museum')

@push('css')
    <meta name="robots" content="noindex, nofollow">

    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}" />

    <!-- Select2 -->
    <link href="{{ asset('vendors/select2/select2@4.1.0.min.css') }}" rel="stylesheet" />

    <style>
        .select2-results__options {
            color: #495057 !important;
        }
    </style>
@endpush

@section('content')
    <div class="section" id="home" style="min-height: 100vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            <h1>Buku Tamu</h1>
            <div class="mb-2">
                <span style="color:red">*</span> <span>Wajib Diisi</span>
            </div>
            <form action="{{ route('tambah-tamu') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <div class="form-group">
                            <label>Nama <span style="color:red">*</span></label>
                            <input name="nama_pengunjung" type="text" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label>Kota Asal <span style="color:red">*</span></label>
                            <select name="asal_pengunjung" id="asal_pengunjung" class="form-control" required>
                                <option value="" selected disabled>-- Pilih Kota Asal --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kategori <span style="color:red">*</span></label>
                            <select name="kategori_pengunjung" id="kategori_pengunjung" class="form-control" required>
                                <option value="{{ \App\Pengunjung::KATEGORI_UMUM }}" selected>Umum</option>
                                <option value="{{ \App\Pengunjung::KATEGORI_SD }}">SD</option>
                                <option value="{{ \App\Pengunjung::KATEGORI_SMP }}">SMP</option>
                                <option value="{{ \App\Pengunjung::KATEGORI_SMA }}">SMA</option>
                                <option value="{{ \App\Pengunjung::KATEGORI_PT }}">Perguruan Tinggi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Instansi/Sekolah (opsional)</label>
                            <input name="instansi" type="text" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label>Jumlah Peserta <span style="color:red">*</span></label>
                            <input name="jumlah_pengunjung" type="text" maxlength="3" class="form-control" required oninput="$(this).val($(this).val().replace(/\D/g,''))" />
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
    <script src="{{ 'js/jquery.toast.min.js' }}"></script>

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
        });
    </script>

    @if (session('status'))
        <script>
            $.toast({
                heading: 'Information',
                text: "{{ session('status') }}",
                icon: 'success',
                position: 'top-right',
                loader: true, // Change it to false to disable loader
                loaderBg: '#9EC600' // To change the background
            })
        </script>
    @endif
@endpush
