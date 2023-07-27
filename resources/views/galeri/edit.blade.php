@extends('layouts.app', ['sidebar' => 'galeri'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/toastify/toastify.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Galeri</h3>
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

                                <form class="form form-horizontal" method="POST"
                                    action="{{ route('galeri.update', $galeri->id_galeri) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="folder_kategori" id="folder_kategori"
                                        value="{{ $galeri->kategori->folder_kategori }}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Kategori</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="id_kategori" name="id_kategori"
                                                        required>
                                                        <option value="" disabled>-- Pilih Kategori--</option>
                                                        @foreach ($semuaKategori as $kategori)
                                                            <option data-folder="{{ $kategori->folder_kategori }}"
                                                                value="{{ $kategori->id_kategori }}" @if ($kategori->id_kategori == $galeri->id_kategori) {{ 'selected' }} @endif>
                                                                {{ $kategori->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input class="form-control" type="file" id="foto" name="foto"
                                                    accept="image/*">
                                            </div>
                                            <div class="col-12">
                                                <div id="image_preview">
                                                    <img class="me-2 mt-2 mb-3"
                                                        src="{{ asset($galeri->foto ?? 'images/no-photos.webp') }}"
                                                        width="700" height="700" title="{{ $galeri->nama_foto }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Deskripsi Galeri</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi">{!! $galeri->deskripsi !!}</textarea>
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
                        image.height = 700;
                        image.width = 700;
                        image.title = file.name;
                        image.className = 'me-2 mb-3';
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

            ClassicEditor
                .create(document.getElementById('deskripsi'))
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endpush
@endsection
