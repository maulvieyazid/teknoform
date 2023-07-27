<?php

namespace App\Http\Controllers;

use App\Galeri;
use App\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    private $pathFotoGaleri = 'upload/galeri';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaKategori = Kategori::latest()->get();
        return view('kategori.index', compact('semuaKategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->folder_kategori = Str::snake($request->folder_kategori);
        $kategori->save();

        /** Buat folder kosong */
        Storage::disk('galeri')->makeDirectory($kategori->folder_kategori);

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        /** Lakukan Update jika nama kategori berubah */
        if ($request->nama_kategori != $kategori->nama_kategori) {
            $folder_kategori = Str::snake($request->folder_kategori);

            $galeri = Galeri::where('id_kategori', $kategori->id_kategori)->get();

            /** Ubah path foto pada tiap data galeri */
            $galeri->each(function ($item) use ($folder_kategori) {
                $item->foto = "{$this->pathFotoGaleri}/{$folder_kategori}/{$item->nama_foto}";
                $item->save();
            });

            /** Ubah nama folder kategori pada disk
             * note: untuk konfigurasi disk 'galeri' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('galeri')->move($kategori->folder_kategori, $folder_kategori);

            $kategori->slug = null;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->folder_kategori = $folder_kategori;
            $kategori->save();
        }

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        /** Hapus Folder Kategori pada Disk 'galeri' */
        Storage::disk('galeri')->deleteDirectory($kategori->folder_kategori);

        /** Hapus galeri foto */
        Galeri::where('id_kategori', $kategori->id_kategori)->delete();

        /** Hapus kategori */
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Dihapus');
    }
}
