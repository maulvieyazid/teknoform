@extends('layouts.app', ['sidebar' => 'majalah'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Majalah</h3>
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
                                    <a href="{{ route('majalah.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST"
                                    action="{{ route('majalah.update', $majalah->id_majalah) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Judul Majalah</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="judul" class="form-control" name="judul"
                                                    placeholder="Judul Majalah" value="{{ $majalah->judul }}" required
                                                    autofocus>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Edisi Majalah</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="edisi" class="form-control" name="edisi"
                                                    placeholder="Edisi Majalah" value="{{ $majalah->edisi }}">
                                            </div>

                                            <div class="col-md-2 pe-0">
                                                <label>Thumbnail Majalah</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input class="form-control" type="file" id="thumbnail" name="thumbnail"
                                                    accept="image/*">
                                            </div>
                                            <div class="col-5 mb-1">
                                                <img id="image_preview"
                                                    src="{{ asset($majalah->thumbnail ?? 'images/no-photos.webp') }}"
                                                    width="200" height="200">
                                            </div>

                                            <div class="col-md-2">
                                                <label>File Majalah</label>
                                                <a href="#" id="info"><i class="bi bi-info-circle-fill"></i></a>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input class="form-control" type="file" id="file" name="file"
                                                    accept="application/pdf">
                                            </div>
                                            <div class="col-md-5 form-group">
                                                {{-- Lihat File --}}
                                                <a href="{{ route('majalah.show.file', $majalah->id_majalah) }}"
                                                    target="_blank" class="btn btn-outline-primary" title="Lihat File">
                                                    <i class="bi bi-eye-fill" style="vertical-align: sub"></i>
                                                </a>
                                                {{-- Download File --}}
                                                <a href="{{ route('majalah.download.file', $majalah->id_majalah) }}"
                                                    target="_blank" class="btn btn-outline-primary" title="Unduh File">
                                                    <i class="bi bi-download" style="vertical-align: sub"></i>
                                                </a>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Deskripsi Majalah</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi" rows="10" class="form-control">{{ str_ireplace(['<br />', '<br>', '<br/>'], "\r\n", $majalah->deskripsi ?? '') }}</textarea>
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
        {{-- <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script> --}}
        <script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

        <script>
            const thumbnail = document.getElementById('thumbnail')
            const image_preview = document.getElementById('image_preview')

            thumbnail.addEventListener('change', function() {
                if (this.files[0].size > 5242880) {
                    Toastify({
                        text: "Thumbnail tidak boleh melebihi 5 MB",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ff0000",
                    }).showToast();
                    image_preview.style.display = "none"
                    this.value = ''
                } else {
                    image_preview.removeAttribute('style')
                    previewImage();
                }
            })

            function previewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(thumbnail.files[0]);

                oFReader.onload = function() {
                    image_preview.src = oFReader.result;
                };
            };

            // ClassicEditor
            //     .create(document.getElementById('deskripsi'))
            //     .catch(error => {
            //         console.error(error);
            //     });

            document.getElementById('info').addEventListener('click', () => {
                Swal.fire(
                    "Mohon kompres file majalah terlebih dahulu, sebelum melakukan upload. <br> Anda bisa menggunakan layanan kompres pdf secara online seperti ilovepdf.com atau yang lainnya"
                )
            })
        </script>
    @endpush
@endsection
