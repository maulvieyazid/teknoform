@extends('layouts.app', ['sidebar' => 'donasi'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">

@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Donasi</h3>
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
                                <form class="form form-horizontal"
                                    action="{{ route('donasi.update', $donasi->id_donasi) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="statusTerima" id="statusTerima"
                                        value="{{ $donasi->status }}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama" class="form-control" name="nama"
                                                    placeholder="Nama Donatur" value="{{ $donasi->nama }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Email Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Email Donatur" value="{{ $donasi->email }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Alamat Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="alamat" class="form-control" name="alamat"
                                                    placeholder="Alamat Donatur" value="{{ $donasi->alamat }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>No. Hp Donatur</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="telp" class="form-control" name="telp"
                                                    placeholder="No. Hp Donatur" value="{{ $donasi->telp }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Nama Koleksi</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_koleksi" class="form-control"
                                                    name="nama_koleksi" placeholder="Nama Koleksi"
                                                    value="{{ $donasi->nama_koleksi }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Koleksi</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input class="form-control" type="file" id="foto" name="foto"
                                                    accept="image/*">
                                            </div>
                                            <div class="col-5">
                                                <img id="image_preview"
                                                    src="{{ asset($donasi->foto ?? 'images/no-photos.webp') }}"
                                                    width="200" height="200" class="mb-3">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Status</label>
                                                <a href="#" id="info"><i class="bi bi-info-circle-fill"></i></a>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="radio" class="btn-check" name="status" id="secondary-outlined"
                                                    autocomplete="off" value="tunggu" @if ($donasi->status == 'tunggu') {{ 'checked' }} @endif>
                                                <label class="btn btn-outline-secondary" for="secondary-outlined">
                                                    <i class="bi bi-question-circle me-50"></i> Tunggu
                                                </label>
                                                <input type="radio" class="btn-check" name="status" id="info-outlined"
                                                    autocomplete="off" value="dalam pengiriman" @if ($donasi->status == 'dalam pengiriman') {{ 'checked' }} @endif>
                                                <label class="btn btn-outline-info" for="info-outlined">
                                                    <i class="bi bi-clock me-50"></i> Dalam Pengiriman
                                                </label>
                                                <input type="radio" class="btn-check" name="status" id="success-outlined"
                                                    autocomplete="off" value="terima" @if ($donasi->status == 'terima') {{ 'checked' }} @endif>
                                                <label class="btn btn-outline-success" for="success-outlined">
                                                    <i class="bi bi-check-circle me-50"></i> Terima
                                                </label>

                                                <input type="radio" class="btn-check" name="status" id="danger-outlined"
                                                    autocomplete="off" value="tolak" @if ($donasi->status == 'tolak') {{ 'checked' }} @endif>
                                                <label class="btn btn-outline-danger" for="danger-outlined">
                                                    <i class="bi bi-x-circle me-50"></i> Tolak
                                                </label>
                                            </div>
                                            {{-- Jika data koleksinya sudah dibuat, maka tampilkan field ini --}}
                                            @if ($donasi->koleksi()->exists())
                                                <div class="col-md-2">
                                                    <label>Data Koleksi</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="{{ route('koleksi.edit', $donasi->koleksi->slug) }}"
                                                        class="btn btn-primary">
                                                        <i class="bi bi-arrow-right-circle" style="vertical-align: sub"></i>
                                                        Menuju Koleksi
                                                    </a>
                                                </div>
                                            @endif
                                            {{-- Jika status bukan bernilai tolak, maka sembunyikan field ini --}}
                                            <div class="col-md-2 alasan" style="display: @if ($donasi->status != 'tolak') {{ 'none' }} @endif">
                                                <label>Alasan</label>
                                            </div>
                                            <div class="col-md-10 form-group alasan" style="display: @if ($donasi->status != 'tolak') {{ 'none' }} @endif">
                                                <input type="text" id="alasan" class="form-control" name="alasan"
                                                    placeholder="Alasan" value="{{ $donasi->alasan }}">
                                            </div>
                                            <div class="col-md-12 form-group sendEmail" style="display: none">
                                                <input type="checkbox" id="sendEmail" name="sendEmail"
                                                    class="form-check-input">
                                                <label for="sendEmail">Kirim email notifikasi ke pengunjung</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Deskripsi Koleksi</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi">{!! $donasi->deskripsi !!}</textarea>
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
                        const sendEmail = document.getElementsByClassName('sendEmail');
                        /* Jika status bernilai tolak, maka tampilkan semua field dengan class 'alasan' */
                        if (status == 'tolak') {
                            for (let index = 0; index < alasan.length; index++) {
                                alasan[index].style.display = 'block'
                            }
                            document.getElementById('alasan').focus()
                        } else {
                            for (let index = 0; index < alasan.length; index++) {
                                alasan[index].style.display = 'none'
                            }
                            document.getElementById('alasan').value = ''
                        }

                        /* Jika status berubah, maka tampilkan checkbox kirim notifikasi email */
                        if (status != '{{ $donasi->status }}') {
                            sendEmail[0].style.display = 'block'
                            document.getElementById('sendEmail').checked = true
                        }
                        else{
                            sendEmail[0].style.display = 'none'
                            document.getElementById('sendEmail').checked = false
                        }
                    });
                });
            }

            /* Jika status donasi sudah diterima, maka status tidak bisa diubah lagi */
            const statusTerima = document.getElementById('statusTerima');
            if (statusTerima.value == 'terima') {
                document.getElementsByName('status').forEach((elem) => {
                    elem.disabled = true
                })
            }

            document.getElementById('info').addEventListener('click', () => {
                Swal.fire(
                    "Jika status sudah 'Terima', maka status tidak dapat diubah kembali. <br> Jika ingin mengubah status, maka data donasi harus dihapus dan dibuat kembali"
                )
            })

        </script>
    @endpush
@endsection
