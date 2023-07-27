<?php

namespace App\Http\Controllers;

use App\Koleksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KoleksiController extends Controller
{
    private $pathFoto = "upload/koleksi";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaKoleksi = Koleksi::with('donasi')->latest()->get();
        return view('koleksi.index', compact('semuaKoleksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('koleksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $koleksi = new Koleksi;

        $foto = $request->foto;

        /** Kalo ada fotonya */
        if ($foto) {
            $namafile = $this->getNamaFile($foto);

            /** Simpan Foto ke Disk
             * note: konfigurasi disk 'foto_koleksi' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('foto_koleksi')->putFileAs(null, $foto, $namafile);

            /** Insert Foto */
            $koleksi->foto = $this->getPathFoto($namafile);
        }

        $koleksi->nama_koleksi = $request->nama_koleksi;
        $koleksi->jenis        = $request->jenis;
        $koleksi->merk         = $request->merk;
        $koleksi->tipe         = $request->tipe;
        $koleksi->deskripsi    = $request->deskripsi;
        $koleksi->save();

        return redirect()->route('koleksi.index')->with('success', 'Data Koleksi Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Koleksi  $koleksi
     * @return \Illuminate\Http\Response
     */
    public function show(Koleksi $koleksi)
    {
        return view('koleksi.show', compact('koleksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Koleksi  $koleksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Koleksi $koleksi)
    {
        return view('koleksi.edit', compact('koleksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Koleksi  $koleksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Koleksi $koleksi)
    {
        $foto = $request->foto;

        /** Kalo ada fotonya */
        if ($foto) {
            $namafile = $this->getNamaFile($foto);

            /** Hapus File Foto dari Folder Public */
            Storage::delete($koleksi->foto);

            /** Simpan Foto ke Disk
             * note: konfigurasi disk 'foto_koleksi' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('foto_koleksi')->putFileAs(null, $foto, $namafile);

            /** Update Foto */
            $koleksi->foto = $this->getPathFoto($namafile);
        }

        $koleksi->slug         = null;
        $koleksi->nama_koleksi = $request->nama_koleksi;
        $koleksi->jenis        = $request->jenis;
        $koleksi->merk         = $request->merk;
        $koleksi->tipe         = $request->tipe;
        $koleksi->deskripsi    = $request->deskripsi;
        $koleksi->save();

        return redirect()->route('koleksi.index')->with('success', 'Data Koleksi Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Koleksi  $koleksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Koleksi $koleksi)
    {
        /** Hapus File Foto dari Folder Public */
        Storage::delete($koleksi->foto);

        $koleksi->delete();

        return redirect()->route('koleksi.index')->with('success', 'Data Koleksi Berhasil Dihapus');
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
