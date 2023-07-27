@extends('layouts.app', ['sidebar' => 'merchandise'])

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Merchandise</h3>
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
                                    <a href="{{ route('merchandise.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_merchandise" class="form-control"
                                                    name="nama_merchandise" placeholder="Nama Merchandise"
                                                    value="{{ $merchandise->nama_merchandise }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Kode</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="kode" class="form-control" name="kode"
                                                    placeholder="Kode Merchandise" value="{{ $merchandise->kode }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Harga</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="number" id="harga" class="form-control" name="harga"
                                                    placeholder="Harga Merchandise" min="0" onwheel="this.blur()"
                                                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                                                    value="{{ $merchandise->harga }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Stok</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="number" id="stok" class="form-control" name="stok"
                                                    placeholder="Stok Merchandise" min="0" onwheel="this.blur()"
                                                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                                                    value="{{ $merchandise->stok }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Ukuran</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="ukuran" class="form-control" name="ukuran"
                                                    placeholder="Ukuran Merchandise" value="{{ $merchandise->ukuran }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Merchandise</label>
                                            </div>
                                            <div class="col-12">
                                                {{-- Kalo ada fotonya --}}
                                                @if ($semuaFoto)
                                                    {{-- Tampilkan semua foto --}}
                                                    @foreach ($semuaFoto as $foto)
                                                        <img id="image_preview" class="me-2 mt-2 mb-3"
                                                            src="{{ asset($foto ?? 'images/no-photos.webp') }}"
                                                            width="200" height="200">
                                                    @endforeach
                                                {{-- Kalo gk ada fotonya --}}
                                                @else
                                                    {{-- Tampilkan foto default --}}
                                                    <img id="image_preview" class="me-2 mt-2 mb-3"
                                                        src="{{ asset('images/no-photos.webp') }}" width="200"
                                                        height="200">
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label>Deskripsi Merchandise</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi">{!! $merchandise->deskripsi !!}</textarea>
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

        <script>
            ClassicEditor
                .create(document.getElementById('deskripsi'))
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endpush
@endsection
