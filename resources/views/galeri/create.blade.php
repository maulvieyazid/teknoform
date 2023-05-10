@extends('layouts.app', ['sidebar' => 'galeri'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Galeri</h3>
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
                                    <a href="{{ route('galeri.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('galeri.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="folder_kategori" id="folder_kategori">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Kategori</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="id_kategori" name="id_kategori"
                                                        required>
                                                        <option value="" disabled selected>-- Pilih Kategori--</option>
                                                        @foreach ($semuaKategori as $kategori)
                                                            <option data-folder="{{ $kategori->folder_kategori }}"
                                                                value="{{ $kategori->id_kategori }}">
                                                                {{ $kategori->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Koleksi</label>
                                                <a href="#" id="info"><i class="bi bi-info-circle-fill"></i></a>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input class="form-control" type="file" id="foto" name="foto[]"
                                                    accept="image/*" multiple required>
                                            </div>
                                            <div class="col-12">
                                                <div id="image_preview" class="mb-3"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Deskripsi Galeri</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi"></textarea>
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

            /* Set Folder Kategori */
            const id_kategori = document.getElementById('id_kategori')
            id_kategori.addEventListener('change', () => {
                document.getElementById('folder_kategori').value = id_kategori.options[id_kategori.selectedIndex]
                    .dataset.folder
            })

            document.getElementById('info').addEventListener('click', () => {
                Swal.fire(
                    "Anda dapat mengupload foto lebih dari satu sekaligus. <br> Pastikan ukuran file foto tidak melebihi 5 MB"
                )
            })

            ClassicEditor
                .create(document.getElementById('deskripsi'))
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endpush
@endsection
