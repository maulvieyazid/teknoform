@extends('layouts.app', ['sidebar' => 'agenda'])

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Agenda</h3>
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
                                <form class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="checkboxPopUp" name="pop_up" value="1" @if ($agenda->pop_up) checked @endif>
                                                    <label class="form-check-label" for="checkboxPopUp">Masukkan Agenda ke Pop Up</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Nama Agenda</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="nama_agenda" class="form-control" name="nama_agenda"
                                                    placeholder="Nama Agenda" value="{{ $agenda->nama_agenda }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Tanggal Mulai</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="tanggal_mulai" class="form-control"
                                                    name="tanggal_mulai"
                                                    value="@if ($agenda->tanggal_mulai) {{ $agenda->tanggal_mulai->translatedFormat('l, d F Y H:i:s') }} @endif"
                                                    {{--value="{{ $agenda->tanggal_mulai->translatedFormat('l, d F Y H:i:s') }}"--}}
                                                    >
                                            </div>
                                            <div class="col-md-2">
                                                <label>Tanggal Selesai</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="tanggal_selesai" class="form-control"
                                                    name="tanggal_selesai"
                                                    value="@if ($agenda->tanggal_selesai) {{ $agenda->tanggal_selesai->translatedFormat('l, d F Y H:i:s') }} @endif"
                                                    {{--value="{{ $agenda->tanggal_selesai->translatedFormat('l, d F Y H:i:s') }}"--}}
                                                    >
                                            </div>
                                            <div class="col-md-2">
                                                <label>Foto Agenda</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <img id="image_preview"
                                                    src="{{ asset($agenda->foto ?? 'images/no-photos.webp') }}"
                                                    width="200" height="200">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Deskripsi Agenda</label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="deskripsi" id="deskripsi">{!! $agenda->deskripsi !!}</textarea>
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
