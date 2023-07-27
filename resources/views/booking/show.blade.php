@extends('layouts.app', ['sidebar' => 'booking'])

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Booking</h3>
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
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Pemesan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama" class="form-control" name="nama"
                                                    placeholder="Nama Pemesan" value="{{ $booking->nama }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Email Pemesan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Email Pemesan" value="{{ $booking->email }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>No. Hp Pemesan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="telp" class="form-control" name="telp"
                                                    placeholder="No. Hp Pemesan" value="{{ $booking->telp }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Instansi / Sekolah</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="instansi" class="form-control" name="instansi"
                                                    placeholder="Instansi / Sekolah" value="{{ $booking->instansi }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Jumlah Peserta</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="number" id="jumlah_peserta" class="form-control"
                                                    name="jumlah_peserta" placeholder="Jumlah Peserta" min="0"
                                                    value="{{ $booking->jumlah_peserta }}" readonly
                                                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Kunjungan</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="tanggal_kunjungan" class="form-control"
                                                    name="tanggal_kunjungan" placeholder="Kunjungan" autocomplete="off"
                                                    value="@if ($booking->tanggal_kunjungan) {{ $booking->tanggal_kunjungan->translatedFormat('l, d F Y H:i:s') }} @else - @endif">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                @if ($booking->status == 'tunggu')
                                                    <span class="badge bg-light-secondary">
                                                        <i class="bi bi-question-circle me-50"></i> Tunggu
                                                    </span>
                                                @elseif ($booking->status == 'setuju')
                                                    <span class="badge bg-light-success">
                                                        <i class="bi bi-check-circle me-50"></i> Setuju
                                                    </span>
                                                @elseif ($booking->status == 'batal')
                                                    <span class="badge bg-light-danger">
                                                        <i class="bi bi-x-circle me-50"></i> Batal
                                                    </span>
                                                @endif
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
    @endpush
@endsection
