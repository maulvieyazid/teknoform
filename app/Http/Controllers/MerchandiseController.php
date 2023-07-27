<?php

namespace App\Http\Controllers;

use App\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{

    private $pathFotoMerchandise = 'upload/merchandise';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaMerchandise = Merchandise::latest()->get();
        return view('merchandise.index', compact('semuaMerchandise'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merchandise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $merchandise = new Merchandise;

        $semuaFoto = $request->foto;

        $folder_merchandise = Str::snake($request->folder_merchandise);

        /** Kalo ada fotonya */
        if ($semuaFoto) {
            foreach ($semuaFoto as $foto) {
                $namafile = $this->getNamaFile($foto);

                /** Simpan Foto ke Disk
                 * note: konfigurasi disk 'merchandise' dapat dilihat pada config/filesystems.php
                 */
                Storage::disk('merchandise')->putFileAs($folder_merchandise, $foto, $namafile);
            }
        }

        $merchandise->kode               = $request->kode;
        $merchandise->nama_merchandise   = $request->nama_merchandise;
        $merchandise->harga              = $request->harga;
        $merchandise->stok               = $request->stok;
        $merchandise->ukuran             = $request->ukuran;
        $merchandise->deskripsi          = $request->deskripsi;
        $merchandise->folder_merchandise = $folder_merchandise;
        $merchandise->save();

        return redirect()->route('merchandise.index')->with('success', 'Data Merchandise Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function show(Merchandise $merchandise)
    {
        $semuaFoto = Storage::allFiles($this->pathFotoMerchandise . '/' . $merchandise->folder_merchandise);
        return view('merchandise.show', compact('merchandise', 'semuaFoto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchandise $merchandise)
    {
        $semuaFoto = Storage::allFiles($this->pathFotoMerchandise . '/' . $merchandise->folder_merchandise);
        return view('merchandise.edit', compact('merchandise', 'semuaFoto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchandise $merchandise)
    {
        $semuaFoto = $request->foto;

        $folder_merchandise = Str::snake($request->folder_merchandise);

        /** Kalo ada fotonya / kalo fotonya diubah */
        if ($semuaFoto) {
            /** Hapus Folder Merchandise dari Folder Public */
            Storage::disk('merchandise')->deleteDirectory($merchandise->folder_merchandise);

            foreach ($semuaFoto as $foto) {
                $namafile = $this->getNamaFile($foto);

                /** Simpan Foto ke Disk
                 * note: konfigurasi disk 'merchandise' dapat dilihat pada config/filesystems.php
                 */
                Storage::disk('merchandise')->putFileAs($folder_merchandise, $foto, $namafile);
            }
        }

        /** Jika folder merchandise berubah tapi foto tidak berubah, maka pindahkan file foto ke direktori yang berbeda */
        if ($merchandise->folder_merchandise != $folder_merchandise && is_null($semuaFoto)) {
            /** Pindahkan file foto */
            Storage::move(
                $this->getPathFotoMerchandise($merchandise->folder_merchandise), //from
                $this->getPathFotoMerchandise($folder_merchandise) //to
            );
        }

        $merchandise->slug               = null;
        $merchandise->kode               = $request->kode;
        $merchandise->nama_merchandise   = $request->nama_merchandise;
        $merchandise->harga              = $request->harga;
        $merchandise->stok               = $request->stok;
        $merchandise->ukuran             = $request->ukuran;
        $merchandise->deskripsi          = $request->deskripsi;
        $merchandise->folder_merchandise = $folder_merchandise;
        $merchandise->save();

        return redirect()->route('merchandise.index')->with('success', 'Data Merchandise Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchandise $merchandise)
    {
        /** Hapus Folder Merchandise dari Folder Public */
        Storage::disk('merchandise')->deleteDirectory($merchandise->folder_merchandise);

        $merchandise->delete();

        return redirect()->route('merchandise.index')->with('success', 'Data Merchandise Berhasil Dihapus');
    }

    private function getPathFotoMerchandise($namafile)
    {
        return $this->pathFotoMerchandise . '/' . $namafile;
    }

    /** Tambahkan string random pada nama file untuk menghindari duplikasi nama */
    private function getNamaFile($file)
    {
        return pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
    }
}
