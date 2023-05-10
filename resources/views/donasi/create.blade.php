@extends('layouts.app', ['sidebar' => 'donasi'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/toastify/toastify.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Donasi</h3>
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
                                    <a href="{{ route('donasi.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('donasi.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama" class="form-control" name="nama"
                                                    placeholder="Nama Donatur" required autofocus>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Email Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Email Donatur">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Alamat Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="alamat" class="form-control" name="alamat"
                                                    placeholder="Alamat Donatur">
                                            </div>
                                            <div class="col-md-2">
                                                <label>No. Hp Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="telp" class="form-control" name="telp"
                                                    placeholder="No. Hp Donatur">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Nama Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_koleksi" class="form-control"
                                                    name="nama_koleksi" placeholder="Nama Koleksi" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Koleksi</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input class="form-control" type="file" id="foto" name="foto"
                                                    accept="image/*">
                                            </div>
                                            <div class="col-5">
                                                <img id="image_preview" src="{{ asset('images/no-photos.webp') }}"
                                                    width="200" height="200" style="display: none">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="radio" class="btn-check" name="status" id="secondary-outlined"
                                                    autocomplete="off" checked value="tunggu">
                                                <label class="btn btn-outline-secondary" for="secondary-outlined">
                                                    <i class="bi bi-question-circle me-50"></i> Tunggu
                                                </label>
                                                <input type="radio" class="btn-check" name="status" id="info-outlined"
                                                    autocomplete="off" value="dalam pengiriman">
                                                <label class="btn btn-outline-info" for="info-outlined">
                                                    <i class="bi bi-clock me-50"></i> Dalam Pengiriman
                                                </label>
                                                <input type="radio" class="btn-check" name="status" id="success-outlined"
                                                    autocomplete="off" value="terima">
                                                <label class="btn btn-outline-success" for="success-outlined">
                                                    <i class="bi bi-check-circle me-50"></i> Terima
                                                </label>
                                                <input type="radio" class="btn-check" name="status" id="danger-outlined"
                                                    autocomplete="off" value="tolak">
                                                <label class="btn btn-outline-danger" for="danger-outlined">
                                                    <i class="bi bi-x-circle me-50"></i> Tolak
                                                </label>
                                            </div>
                                            <div class="col-md-2 alasan" style="display: none">
                                                <label>Alasan</label>
                                            </div>
                                            <div class="col-md-10 form-group alasan" style="display: none">
                                                <input type="text" id="alasan" class="form-control" name="alasan"
                                                    placeholder="Alasan">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input type="checkbox" id="sendEmail" name="sendEmail" class="form-check-input" checked>
                                                <label for="sendEmail">Kirim email notifikasi ke donatur</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Deskripsi Koleksi</label>
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

            /* Ambil semua input yang memiliki attribut name='status',
             * kemudian lakukan perulangan untuk mengecek value nya satu persatu
             */
            if (document.querySelector('input[name="status"]')) {
                document.querySelectorAll('input[name="status"]').forEach((elem) => {
                    elem.addEventListener("change", function(event) {
                        var status = event.target.value;
                        const alasan = document.getElementsByClassName('alasan');
                        /* Jika status bernilai tolak, maka tampilkan semua field dengan class 'alasan' */
                        if (status == 'tolak') {
                            for (let index = 0; index < alasan.length; index++) {
                                alasan[index].style.display = 'block'
                            }
                            document.getElementById('alasan').focus()
                        } else {
                            for (let index = 0; index < alasan.length; index++) {
                                alasan[index].style.display = 'none'
                                document.getElementById('alasan').value = ''
                            }
                        }
                    });
                });
            }

        </script>
    @endpush
@endsection
