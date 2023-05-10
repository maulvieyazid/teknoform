@extends('layouts.app', ['sidebar' => 'majalah'])

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Majalah</h3>
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
                                <form class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Judul Majalah</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="judul" class="form-control" name="judul"
                                                    placeholder="Judul Majalah" value="{{ $majalah->judul }}">
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
                                            <div class="col-md-10 form-group">
                                                <img id="image_preview"
                                                    src="{{ asset($majalah->thumbnail ?? 'images/no-photos.webp') }}"
                                                    width="200" height="200">
                                            </div>


                                            <div class="col-md-2">
                                                <label>File Majalah</label>
                                            </div>
                                            <div class="col-md-7 form-group">
                                                <input class="form-control" type="text" id="file" name="file"
                                                    value="{{ \Str::replaceFirst('upload/majalah/', '', $majalah->file) }}">
                                            </div>
                                            <div class="col-md-3 form-group">
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
        {{-- <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script> --}}

        <script>
            // ClassicEditor
            //     .create(document.getElementById('deskripsi'))
            //     .catch(error => {
            //         console.error(error);
            //     });
        </script>
    @endpush
@endsection
