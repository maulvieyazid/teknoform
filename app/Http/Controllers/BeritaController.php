<?php

namespace App\Http\Controllers;

use App\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    private $pathFoto = "upload/berita";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaBerita = Berita::latest()->get();
        return view('berita.index', compact('semuaBerita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $berita = new Berita;

        $thumbnail = $request->thumbnail;

        /** Kalo ada thumbnailnya */
        if ($thumbnail) {
            $namafile = $this->getNamaFile($thumbnail);

            /** Simpan Thumbnail ke Disk
             * note: konfigurasi disk 'thumbnail_berita' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('thumbnail_berita')->putFileAs(null, $thumbnail, $namafile);

            /** Insert Thumbnail */
            $berita->thumbnail = $this->getPathFoto($namafile);
        }

        $berita->judul     = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Data Berita Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Berita  $beritum
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $beritum)
    {
        $berita = $beritum;
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Berita  $beritum
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $beritum)
    {
        $berita = $beritum;
        return view('berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Berita  $beritum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $beritum)
    {
        $berita = $beritum;
        $thumbnail = $request->thumbnail;

        /** Kalo ada thumbnailnya */
        if ($thumbnail) {
            $namafile = $this->getNamaFile($thumbnail);

            /** Hapus File Foto dari Folder Public */
            Storage::delete($berita->thumbnail);

            /** Simpan Thumbnail ke Disk
             * note: konfigurasi disk 'thumbnail_berita' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('thumbnail_berita')->putFileAs(null, $thumbnail, $namafile);

            /** Insert Thumbnail */
            $berita->thumbnail = $this->getPathFoto($namafile);
        }

        $berita->slug      = null;
        $berita->judul     = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Data Berita Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Berita  $beritum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $beritum)
    {
        $berita = $beritum;
        /** Hapus File Foto dari Folder Public */
        Storage::delete($berita->thumbnail);

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Data Berita Berhasil Dihapus');
    }

    private function getPathFoto($namafile)
    {
        return "{$this->pathFoto}/{$namafile}";
    }

    /** Tambahkan string random pada nama file untuk menghindari duplikasi nama */
    private function getNamaFile($file)
    {
        return pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
    }
}
