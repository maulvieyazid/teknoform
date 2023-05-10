@extends('layouts.app', ['sidebar' => 'booking'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Booking</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('booking.create') }}" class="btn btn-primary ">
                                <i class="bi bi-plus-circle" style="vertical-align: sub"></i> Tambah
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive" id="table_master">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Instansi / Sekolah</th>
                                <th>Kunjungan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaBooking as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->nama }}</td>
                                    <td>{{ $booking->instansi }}</td>
                                    <td>
                                        @if($booking->tanggal_kunjungan)
                                            {{ $booking->tanggal_kunjungan->locale('id')->translatedFormat('l, d F Y H:i:s') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>
                                        <div class="btn-group dropstart  mb-1">
                                            <button type="button" class="btn btn-info dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('booking.show', $booking->id_booking) }}">
                                                    <i class="bi bi-eye-fill me-50"></i> Lihat
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('booking.edit', $booking->id_booking) }}">
                                                    <i class="bi bi-pencil-square me-50"></i> Ubah
                                                </a>
                                                <a class="dropdown-item" href=""
                                                    onclick="event.preventDefault(); hapus(this, ['{{ $booking->nama }}', '{{ $booking->instansi }}'])">
                                                    <i class="bi bi-trash-fill me-50"></i> Hapus
                                                    <form action="{{ route('booking.destroy', $booking->id_booking) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script>
            /* Simple Datatable */
            let table_master = document.querySelector('#table_master');
            let dataTable = new simpleDatatables.DataTable(table_master);

            async function hapus(btn, item) {
                /* Sweet Alert 2 */
                const {
                    value: hapus
                } = await Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: `Apakah anda yakin ingin menghapus ${item[0]}(${item[1]})?`,
                    showCancelButton: true,
                })

                if (hapus) {
                    btn.children[1].submit();
                }
            }

        </script>
    @endpush
@endsection
