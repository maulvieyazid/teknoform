@extends('layouts.app', ['sidebar' => 'booking'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}">

@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Booking</h3>
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
                                    <a href="{{ route('booking.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('booking.store') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Pemesan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama" class="form-control" name="nama"
                                                    placeholder="Nama Pemesan" required autofocus>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Email Pemesan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Email Pemesan">
                                            </div>
                                            <div class="col-md-2">
                                                <label>No. Hp Pemesan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="telp" class="form-control" name="telp"
                                                    placeholder="No. Hp Pemesan">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Instansi / Sekolah</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="instansi" class="form-control" name="instansi"
                                                    placeholder="Instansi / Sekolah">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Jumlah Peserta</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="number" id="jumlah_peserta" class="form-control"
                                                    name="jumlah_peserta" placeholder="Jumlah Peserta" min="0"
                                                    onwheel="this.blur()"
                                                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Kunjungan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="tanggal_kunjungan" class="form-control"
                                                    name="tanggal_kunjungan" placeholder="Kunjungan" autocomplete="off">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="radio" class="btn-check" name="status" id="secondary-outlined"
                                                    autocomplete="off" checked value="tunggu">
                                                <label class="btn btn-outline-secondary" for="secondary-outlined">
                                                    <i class="bi bi-question-circle me-50"></i> Tunggu
                                                </label>
                                                <input type="radio" class="btn-check" name="status" id="success-outlined"
                                                    autocomplete="off" value="setuju">
                                                <label class="btn btn-outline-success" for="success-outlined">
                                                    <i class="bi bi-check-circle me-50"></i> Setuju
                                                </label>

                                                <input type="radio" class="btn-check" name="status" id="danger-outlined"
                                                    autocomplete="off" value="batal">
                                                <label class="btn btn-outline-danger" for="danger-outlined">
                                                    <i class="bi bi-x-circle me-50"></i> Batal
                                                </label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="checkbox" id="sendEmail" name="sendEmail"
                                                    class="form-check-input" checked>
                                                <label for="sendEmail">Kirim email notifikasi ke pengunjung</label>
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
                maxTime: "16:00",
                minDate: "today",
                position: "above",
                locale: 'id',
                disable: [
                    sabtuMinggu, hariBesar // Urutan ini jangan diubah, nanti hasilnya bisa beda
                ]
            })

        </script>
    @endpush
@endsection
