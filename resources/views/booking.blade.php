@extends('layouts.museum')
@push('css')
    <link rel="stylesheet" href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}">

@endpush

@section('content')
    <div class="section" id="home"
        style="min-height: 116vh; background-image: url('{{ asset('backgrounds/desain-website-museum_bg_02_optimized.jpg') }}');">
        <div class="container py-5">
            <form action="{{ route('tambah-booking') }}" method="post">
                @csrf
                <h1>Booking Online</h1>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama <span style="color:red">*</span></label>
                                    <input name="nama" type="text" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Email <span style="color:red">*</span></label>
                                    <input name="email" type="email" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>No. HP <span style="color:red">*</span></label>
                                    <input name="telp" type="text" class="form-control" required />
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Instansi/Sekolah <span style="color:red">*</span></label></label>
                                    <input name="instansi" type="text" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Peserta <span style="color:red">*</span></label></label>
                                    <input name="jumlah_peserta" type="number" min="1" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kunjungan <span style="color:red">*</span></label>
                                    <input name="tanggal_kunjungan" id="tanggal_kunjungan" type="text" class="form-control" autocomplete="off"
                                        required />
                                </div>
                                <button type="submit" name="simpan" class="btn text-white border rounded-0"
                                    style="width: 10rem;">Kirim</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <h3>Aturan Booking Online</h3>
                        <div class="text-justify">
                            <ol>
                                <li class="mb-2">Pengunjung WAJIB mengisi data-data berikut dengan sebenar-benarnya.</li>
                                <li class="mb-2">Kunjungan hanya dapat dilakukan sesuai dengan waktu operasional Museum Teknoform yaitu Hari Senin - Jumat, pukul 09.00 - 15.30 WIB</li>
                                <li class="mb-2">Museum tidak beroperasi pada Hari Sabtu, Minggu, dan Hari Libur Nasional.</li>
                                <li class="mb-2">Jumlah peserta kunjungan dalam satu ruangan dibatasi maksimal 10 orang.</li>
                                <li class="mb-2">Museum tidak memungut biaya untuk pelaksanaan kunjungan.</li>
                                <li class="mb-2">Untuk kunjungan dalam masa pandemi Covid-19, pengunjung wajib taat pada protokol kesehatan yang ada di area Museum Teknoform dan Universitas Dinamika.</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('vendors/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('vendors/flatpickr/id.js') }}"></script>

    <script>
        function hariBesar(date) {
            let hari = {!! $hari !!}
            /* Entah kenapa, date flatpickr harus ditambahkan satu hari
            * biar dia bisa membandingkan dengan benar
            */
            let plusOneDay = date.setDate(date.getDate() + 1);
            return hari.includes(new Date(plusOneDay).toISOString().substring(0, 10));
        }

        function sabtuMinggu(date) {
            return (date.getDay() === 0 || date.getDay() === 6);
        }

        flatpickr('#tanggal_kunjungan', {
            altInput: true,
            altFormat: "l, d F Y H:i:S",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minTime: "09:00",
            maxTime: "15:30",
            minDate: "today",
            position: "below",
            locale: 'id',
            disable: [
                sabtuMinggu, hariBesar // Urutan ini jangan diubah, nanti hasilnya bisa beda
            ]
        })

    </script>
@endpush
