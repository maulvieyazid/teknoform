@extends('layouts.app', ['sidebar' => 'kategori'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kategori</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('kategori.create') }}" class="btn btn-primary ">
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
                                <th>Nama Kategori</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaKategori as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->created_at->translatedFormat('l, d F Y H:i:s') }}</td>
                                    <td>
                                        <div class="btn-group dropstart  mb-1">
                                            <button type="button" class="btn btn-info dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('kategori.show', $kategori->slug) }}">
                                                    <i class="bi bi-eye-fill me-50"></i> Lihat
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('kategori.edit', $kategori->slug) }}">
                                                    <i class="bi bi-pencil-square me-50"></i> Ubah
                                                </a>
                                                <a class="dropdown-item" href=""
                                                    onclick="event.preventDefault(); hapus(this, '{{ $kategori->nama_kategori }}')">
                                                    <i class="bi bi-trash-fill me-50"></i> Hapus
                                                    <form action="{{ route('kategori.destroy', $kategori->slug) }}"
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
                    html: `<h3 style='color:red'>Jika anda menghapus Kategori maka seluruh Galeri Foto yang ada di dalam Kategori tersebut juga akan terhapus.</h3><h5>Apakah anda yakin ingin menghapus ${item}?</h5>`,
                    showCancelButton: true,
                })

                if (hapus) {
                    btn.children[1].submit();
                }
            }

        </script>
    @endpush
@endsection
