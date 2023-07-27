<?php

namespace App\Http\Controllers;

use App\Galeri;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    private $pathFoto = 'upload/galeri';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaGaleri = Galeri::with('kategori')->orderBy('id_kategori')->get();
        return view('galeri.index', compact('semuaGaleri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semuaKategori = Kategori::latest()->get();
        return view('galeri.create', compact('semuaKategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $semuaFoto = $request->foto;

        foreach ($semuaFoto as $foto) {
            $namafile = $this->getNamaFile($foto);
            $pathfile = $request->folder_kategori . '/' . $namafile;

            /** Simpan Foto ke Disk */
            Storage::disk('galeri')->putFileAs($request->folder_kategori, $foto, $namafile);

            $galeri              = new Galeri;
            $galeri->nama_foto   = $namafile;
            $galeri->deskripsi   = $request->deskripsi;
            $galeri->foto        = $this->getPathFoto($pathfile);
            $galeri->id_kategori = $request->id_kategori;
            $galeri->save();
        }

        return redirect()->route('galeri.index')->with('success', 'Data Galeri Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        return view('galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        $semuaKategori = Kategori::latest()->get();
        return view('galeri.edit', compact('galeri', 'semuaKategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        $foto = $request->foto;
        /** Kalo ada fotonya */
        if ($foto) {
            $namafile = $this->getNamaFile($foto);
            $pathfile = $request->folder_kategori . '/' . $namafile;

            /** Hapus File Foto dari Folder Public */
            Storage::delete($galeri->foto);

            /** Simpan Foto ke Disk */
            Storage::disk('galeri')->putFileAs($request->folder_kategori, $foto, $namafile);

            $galeri->nama_foto   = $namafile;
            $galeri->foto        = $this->getPathFoto($pathfile);
        }

        /** Jika kategori berubah tapi foto tidak berubah, maka pindahkan file foto ke direktori yang berbeda */
        if ($request->id_kategori != $galeri->id_kategori && is_null($foto)) {
            $kategori = Kategori::find($request->id_kategori);
            $pathfile = $kategori->folder_kategori . '/' . $galeri->nama_foto;

            /** Pindahkan file foto */
            Storage::move($galeri->foto, $this->getPathFoto($pathfile));

            $galeri->foto = $this->getPathFoto($pathfile);
        }

        $galeri->deskripsi   = $request->deskripsi;
        $galeri->id_kategori = $request->id_kategori;
        $galeri->save();

        return redirect()->route('galeri.index')->with('success', 'Data Galeri Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        /** Hapus File Foto dari Folder Public */
        Storage::delete($galeri->foto);

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Data Galeri Berhasil Dihapus');
    }

    private function getPathFoto($namafile)
    {
        return $this->pathFoto . '/' . $namafile;
    }

    /** Tambahkan string random pada nama file untuk menghindari duplikasi nama */
    private function getNamaFile($file)
    {
        return pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
    }
}
