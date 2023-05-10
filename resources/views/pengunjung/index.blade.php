@extends('layouts.app', ['sidebar' => 'pengunjung'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pengunjung</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('pengunjung.create') }}" class="btn btn-primary ">
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
                                <th>Nama Pengunjung</th>
                                <th>Instansi</th>
                                <th>Jml Pengunjung</th>
                                <th>Selesai Kunjungan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaPengunjung as $pengunjung)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pengunjung->nama_pengunjung }}</td>
                                    <td>{{ $pengunjung->instansi }}</td>
                                    <td>{{ $pengunjung->jumlah_pengunjung }}</td>
                                    <td>{{ optional($pengunjung->created_at)->translatedFormat('l, d F Y H:i:s') }}</td>
                                    <td>
                                        <div class="btn-group dropstart  mb-1">
                                            <button type="button" class="btn btn-info dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('pengunjung.show', $pengunjung->id_pengunjung) }}">
                                                    <i class="bi bi-eye-fill me-50"></i> Lihat
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('pengunjung.edit', $pengunjung->id_pengunjung) }}">
                                                    <i class="bi bi-pencil-square me-50"></i> Ubah
                                                </a>
                                                <a class="dropdown-item" href=""
                                                    onclick="event.preventDefault(); hapus(this, ['{{ $pengunjung->nama_pengunjung }}', '{{ $pengunjung->instansi }}'])">
                                                    <i class="bi bi-trash-fill me-50"></i> Hapus
                                                    <form action="{{ route('pengunjung.destroy', $pengunjung->id_pengunjung) }}"
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
