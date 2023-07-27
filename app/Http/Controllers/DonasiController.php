<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Koleksi;
use App\Mail\Donasi as MailDonasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class DonasiController extends Controller
{
    private $pathFoto = "upload/donasi";
    private $pathFotoKoleksi = "upload/koleksi";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaDonasi = Donasi::with('koleksi')->latest()->get();
        return view('donasi.index', compact('semuaDonasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donasi = new Donasi;

        $foto = $request->foto;

        /** Kalo ada fotonya */
        if ($foto) {
            $namafile = $this->getNamaFile($foto);

            /** Simpan Foto ke Disk
             * note: konfigurasi disk 'foto_donasi' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('foto_donasi')->putFileAs(null, $foto, $namafile);

            /** Insert Foto */
            $donasi->foto = $this->getPathFoto($namafile);
        }

        $donasi->nama         = $request->nama;
        $donasi->email        = $request->email;
        $donasi->alamat       = $request->alamat;
        $donasi->telp         = $request->telp;
        $donasi->nama_koleksi = $request->nama_koleksi;
        $donasi->deskripsi    = $request->deskripsi;
        $donasi->status       = $request->status;
        $donasi->alasan       = $request->alasan;
        $donasi->save();

        /** Jika status donasi 'terima'
         * Maka buat koleksi
         */
        if ($request->status == 'terima') {
            $this->createKoleksiFromDonasi($request, $donasi);
        }

        /** Jika checkbox kirim notifikasi email dicentang */
        if ($request->sendEmail) {
            /** Kirim notifikasi email ke pengunjung */
            $this->sendEmail($request);
        }

        return redirect()->route('donasi.index')->with('success', 'Data Donasi Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function show(Donasi $donasi)
    {
        return view('donasi.show', compact('donasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Donasi $donasi)
    {
        return view('donasi.edit', compact('donasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donasi $donasi)
    {
        $foto = $request->foto;

        /** Jika status donasi 'terima' dan belum ada koleksi yang dibuat
         * Maka buat koleksi
         */
        if ($request->status == 'terima' && is_null($donasi->koleksi)) {
            $this->createKoleksiFromDonasi($request, $donasi);
        }

        /** Kalo ada fotonya */
        if ($foto) {
            $namafile = $this->getNamaFile($foto);

            /** Hapus File Foto dari Folder Public */
            Storage::delete($donasi->foto);

            /** Simpan Foto ke Disk
             * note: konfigurasi disk 'foto_donasi' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('foto_donasi')->putFileAs(null, $foto, $namafile);

            /** Update Foto */
            $donasi->foto = $this->getPathFoto($namafile);
        }

        $donasi->nama         = $request->nama;
        $donasi->email        = $request->email;
        $donasi->alamat       = $request->alamat;
        $donasi->telp         = $request->telp;
        $donasi->nama_koleksi = $request->nama_koleksi;
        $donasi->deskripsi    = $request->deskripsi;
        $donasi->status       = $request->status ?? $donasi->status;
        $donasi->alasan       = $request->alasan;
        $donasi->save();

        /** Jika checkbox kirim notifikasi email dicentang */
        if ($request->sendEmail) {
            /** Kirim notifikasi email ke pengunjung */
            $this->sendEmail($request);
        }

        return redirect()->route('donasi.index')->with('success', 'Data Donasi Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donasi $donasi)
    {
        /** Hapus koleksi yang terkait beserta fotonya jika ada */
        if ($donasi->koleksi()->exists()) {
            Storage::delete($donasi->koleksi->foto);

            $donasi->koleksi->delete();
        }

        /** Hapus File Foto dari Folder Public */
        Storage::delete($donasi->foto);

        $donasi->delete();

        return redirect()->route('donasi.index')->with('success', 'Data Donasi Berhasil Dihapus');
    }

    private function createKoleksiFromDonasi($request, $donasi)
    {
        $koleksi = new Koleksi;

        /** Kalo ada fotonya */
        if ($donasi->foto) {
            /** Menghilangkan path folder donasi pada foto donasi */
            $namafile = Str::replaceFirst("{$this->pathFoto}/", "", $donasi->foto);

            /** Mencopy file foto donasi ke folder koleksi */
            Storage::copy($donasi->foto, $this->getPathFotoKoleksi($namafile));

            $koleksi->foto = $this->getPathFotoKoleksi($namafile);
        }

        $koleksi->nama_koleksi = $request->nama_koleksi;
        $koleksi->deskripsi    = $request->deskripsi;
        $koleksi->id_donasi    = $donasi->id_donasi;
        $koleksi->save();
    }

    private function getPathFotoKoleksi($namafile)
    {
        return "{$this->pathFotoKoleksi}/{$namafile}";
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

    private function sendEmail($request)
    {
        /** Kirim email secara langsung */
        Mail::to($request->email)->send(new MailDonasi($request->status));

        /** Antrikan email untuk nanti dijalankan oleh cron */
        // Mail::to($request->email)->queue(new MailDonasi($request->status));
    }
}
