@extends('layouts.app', ['sidebar' => 'merchandise'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">

@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Merchandise</h3>
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
                                <form class="form form-horizontal"
                                    action="{{ route('merchandise.update', $merchandise->slug) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="folder_merchandise" name="folder_merchandise"
                                        value="{{ $merchandise->folder_merchandise }}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_merchandise" class="form-control"
                                                    name="nama_merchandise" placeholder="Nama Merchandise"
                                                    value="{{ $merchandise->nama_merchandise }}" required autofocus>
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
                                                <a href="#" id="info"><i class="bi bi-info-circle-fill"></i></a>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input class="form-control" type="file" id="foto" name="foto[]"
                                                    accept="image/*" multiple>
                                            </div>
                                            <div class="col-12">
                                                <div id="image_preview" class="mb-3">
                                                    {{-- Kalo ada fotonya --}}
                                                    @if ($semuaFoto)
                                                        {{-- Tampilkan semua foto --}}
                                                        @foreach ($semuaFoto as $foto)
                                                            <img class="me-2 mt-2 mb-3"
                                                                src="{{ asset($foto ?? 'images/no-photos.webp') }}"
                                                                width="200" height="200">
                                                        @endforeach
                                                    {{-- Kalo gk ada fotonya --}}
                                                    @else
                                                        {{-- Tampilkan foto default --}}
                                                        <img class="me-2 mt-2 mb-3"
                                                            src="{{ asset('images/no-photos.webp') }}" width="200"
                                                            height="200">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Deskripsi Merchandise</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi">{!! $merchandise->deskripsi !!}</textarea>
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
        <script src="{{ asset('vendors/toastify/toastify.js') }}"></script>
        <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

        <script>
            const foto = document.getElementById('foto')
            const image_preview = document.getElementById('image_preview')

            foto.addEventListener('change', function() {
                Array.from(this.files).forEach(file => {
                    if (file.size > 5242880) {
                        Toastify({
                            text: "Foto tidak boleh melebihi 5 MB",
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#ff0000",
                        }).showToast();
                        this.value = ''
                    }
                })
                /* Kosongkan image_preview*/
                image_preview.innerHTML = ''
                previewImage();
            })

            function previewImage() {
                Array.from(foto.files).forEach(file => {
                    var oFReader = new FileReader();

                    oFReader.addEventListener("load", function() {
                        var image = new Image();
                        image.height = 200;
                        image.width = 200;
                        image.title = file.name;
                        image.className = 'me-2';
                        image.src = this.result;

                        image_preview.appendChild(image);
                    });

                    oFReader.readAsDataURL(file);

                })
            };

            ClassicEditor
                .create(document.getElementById('deskripsi'))
                .catch(error => {
                    console.error(error);
                });

            /* Set Folder Merchandise */
            document.getElementById('nama_merchandise').addEventListener('keyup', (obj) => {
                document.getElementById('folder_merchandise').value = obj.target.value.toLowerCase();
            })

            document.getElementById('info').addEventListener('click', () => {
                Swal.fire(
                    "Anda dapat mengupload foto lebih dari satu sekaligus. <br> Pastikan ukuran file foto tidak melebihi 5 MB"
                )
            })
        </script>
    @endpush
@endsection
