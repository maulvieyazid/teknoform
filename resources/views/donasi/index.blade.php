@extends('layouts.app', ['sidebar' => 'donasi'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Donasi</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('donasi.create') }}" class="btn btn-primary ">
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
                                <th>Nama Donatur</th>
                                <th>Nama Koleksi</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaDonasi as $donasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $donasi->nama }}</td>
                                    <td>{{ $donasi->nama_koleksi }}</td>
                                    <td>
                                        <img src="{{ asset($donasi->foto ?? 'images/no-photos.webp') }}" width="100"
                                            height="100">
                                    </td>
                                    <td>
                                        @if ($donasi->status == 'tunggu')
                                            <span class="badge bg-light-secondary">
                                                <i class="bi bi-question-circle me-50"></i> Tunggu
                                            </span>
                                        @elseif ($donasi->status == 'dalam pengiriman')
                                            <span class="badge bg-light-info">
                                                <i class="bi bi-clock me-50"></i> Dalam Pengiriman
                                            </span>
                                        @elseif ($donasi->status == 'terima')
                                            <span class="badge bg-light-success">
                                                <i class="bi bi-check-circle me-50"></i> Terima
                                            </span>
                                        @elseif ($donasi->status == 'tolak')
                                            <span class="badge bg-light-danger">
                                                <i class="bi bi-x-circle me-50"></i> Tolak
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
                                                @if (!is_null($donasi->koleksi))
                                                    <a class="dropdown-item"
                                                        href="{{ route('koleksi.edit', $donasi->koleksi->slug) }}">
                                                        <i class="bi bi-arrow-right-circle me-50"></i> Menuju Koleksi
                                                    </a>
                                                @endif
                                                <a class="dropdown-item"
                                                    href="{{ route('donasi.show', $donasi->id_donasi) }}">
                                                    <i class="bi bi-eye-fill me-50"></i> Lihat
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('donasi.edit', $donasi->id_donasi) }}">
                                                    <i class="bi bi-pencil-square me-50"></i> Ubah
                                                </a>
                                                <a class="dropdown-item" href=""
                                                    onclick="event.preventDefault(); hapus(this, ['{{ $donasi->nama }}', '{{ $donasi->nama_koleksi }}'])">
                                                    <i class="bi bi-trash-fill me-50"></i> Hapus
                                                    <form action="{{ route('donasi.destroy', $donasi->id_donasi) }}"
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
                    html: `<h3 style='color:red'>Jika anda menghapus Donasi maka Koleksi yang terkait dengan donasi tersebut juga akan terhapus.</h3><h5>Apakah anda yakin ingin menghapus ${item[0]}(${item[1]})?</h5>`,
                    showCancelButton: true,
                })

                if (hapus) {
                    btn.children[1].submit();
                }
            }

        </script>
    @endpush
@endsection
