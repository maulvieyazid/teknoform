@extends('layouts.app', ['sidebar' => 'kritiksaran'])

@push('styles')

@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Kritik & Saran</h3>
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
                                    <a href="{{ route('kritiksaran.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left-circle" style="vertical-align: sub"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('kritiksaran.store') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama" class="form-control"
                                                    name="nama" placeholder="Nama" required autofocus>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="email" class="form-control"
                                                    name="email" placeholder="Email" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label>No. Telp</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="no_telp" class="form-control"
                                                    name="no_telp" placeholder="No. Telp" required>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Pesan</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="pesan" id="pesan"></textarea>
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
        <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>

        <script>
            ClassicEditor
                .create(document.getElementById('pesan'))
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endpush
@endsection
