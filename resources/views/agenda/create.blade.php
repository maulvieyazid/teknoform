@extends('layouts.app', ['sidebar' => 'agenda'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Agenda</h3>
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
                                    <a href="{{ route('agenda.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('agenda.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="checkboxPopUp" name="pop_up" value="1">
                                                    <label class="form-check-label" for="checkboxPopUp">Masukkan Agenda ke Pop Up</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Nama Agenda</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_agenda" class="form-control" name="nama_agenda" placeholder="Nama Agenda" required autofocus>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Tanggal Mulai</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="tanggal_mulai" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai" autocomplete="off">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Tanggal Selesai</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="tanggal_selesai" class="form-control" name="tanggal_selesai" placeholder="Tanggal Selesai" autocomplete="off">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Agenda</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                                            </div>
                                            <div class="col-5">
                                                <img id="image_preview" src="{{ asset('images/no-photos.webp') }}" width="200" height="200" style="display: none">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Deskripsi Agenda</label>
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
        <script src="{{ asset('vendors/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('vendors/flatpickr/id.js') }}"></script>

        <script>
            const foto = document.getElementById('foto')
            const image_preview = document.getElementById('image_preview')

            foto.addEventListener('change', function() {
                if (this.files[0].size > 5242880) {
                    Toastify({
                        text: "Foto tidak boleh melebihi 5 MB",
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
                oFReader.readAsDataURL(foto.files[0]);

                oFReader.onload = function() {
                    image_preview.src = oFReader.result;
                };
            };

            ClassicEditor
                .create(document.getElementById('deskripsi'))
                .catch(error => {
                    console.error(error);
                });

            flatpickr('#tanggal_mulai', {
                altInput: true,
                altFormat: "l, d F Y H:i:S",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minTime: "09:00",
                maxTime: "16:00",
                locale: 'id',
            })

            flatpickr('#tanggal_selesai', {
                altInput: true,
                altFormat: "l, d F Y H:i:S",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minTime: "09:00",
                maxTime: "16:00",
                locale: 'id',
            })
        </script>
    @endpush
@endsection
