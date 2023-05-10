<?php

namespace App\Http\Controllers;

use App\Majalah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MajalahController extends Controller
{
    private $folderID = '10UBNsy0c1DfUY9hd5zV6EdxeW3OZYjaT';
    private $pathThumbnail = 'upload/majalah/thumbnail';
    private $pathFileMajalah = 'upload/majalah';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaMajalah = Majalah::latest()->get();
        return view('majalah.index', compact('semuaMajalah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('majalah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $majalah = new Majalah;

        $thumbnail = $request->thumbnail;
        $file = $request->file;

        /** Kalo ada thumbnailnya */
        if ($thumbnail) {
            $namafile = $this->getNamaFile($thumbnail);

            /** Simpan Foto ke Disk
             * note: konfigurasi disk 'thumbnail_majalah' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('thumbnail_majalah')->putFileAs(null, $thumbnail, $namafile);

            /** Insert Foto */
            $majalah->thumbnail = $this->getPathThumbnail($namafile);
        }

        /** Simpan file ke local */
        /** Kalo ada filenya */
        // if ($file) {
        //     $namafile = $this->getNamaFile($file);

        //     /** Simpan File ke Disk
        //      * note: konfigurasi disk 'file_majalah' dapat dilihat pada config/filesystems.php
        //      */
        //     Storage::disk('file_majalah')->putFileAs(null, $file, $namafile);

        //     /** Insert File */
        //     $majalah->file = $this->getPathFileMajalah($namafile);
        // }

        /** Simpan file ke Drive */
        if ($file) {
            $namafile = $this->getNamaFile($file);

            /** Simpan Foto ke Drive */
            Storage::cloud()->put("{$this->folderID}/{$namafile}", fopen($file, 'r+'));

            /** Ambil Path dari file yang sudah diupload */
            $path = collect(Storage::cloud()->listContents($this->folderID, false))
                ->where('type', '=', 'file')
                ->where('name', $namafile)
                ->first()['path'];

            /** Insert Path ke DB*/
            $majalah->file = $path;
        }

        $majalah->judul     = $request->judul;
        $majalah->edisi     = $request->edisi;
        $majalah->deskripsi = str_replace(array("\r", "\n"), '', nl2br(trim($request->deskripsi)));
        $majalah->save();

        return redirect()->route('majalah.index')->with('success', 'Data Majalah Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Majalah  $majalah
     * @return \Illuminate\Http\Response
     */
    public function show(Majalah $majalah)
    {
        return view('majalah.show', compact('majalah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Majalah  $majalah
     * @return \Illuminate\Http\Response
     */
    public function edit(Majalah $majalah)
    {
        return view('majalah.edit', compact('majalah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Majalah  $majalah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Majalah $majalah)
    {
        $thumbnail = $request->thumbnail;
        $file = $request->file;

        /** Kalo ada thumbnailnya */
        if ($thumbnail) {
            $namafile = $this->getNamaFile($thumbnail);

            /** Hapus File Foto dari Folder Public */
            Storage::delete($majalah->thumbnail);

            /** Simpan Foto ke Disk */
            Storage::disk('thumbnail_majalah')->putFileAs(null, $thumbnail, $namafile);

            /** Update Foto */
            $majalah->thumbnail = $this->getPathThumbnail($namafile);
        }

        /** Simpan file ke local */
        /** Kalo ada filenya */
        // if ($file) {
        //     $namafile = $this->getNamaFile($file);

        //     /** Hapus File Foto dari Folder Public */
        //     Storage::delete($majalah->file);

        //     /** Simpan File ke Disk */
        //     Storage::disk('file_majalah')->putFileAs(null, $file, $namafile);

        //     /** Update File */
        //     $majalah->file = $this->getPathFileMajalah($namafile);
        // }

        /** Simpan file ke Drive */
        if ($file) {
            $namafile = $this->getNamaFile($file);

            /** Hapus file dari Drive */
            Storage::cloud()->delete($majalah->file);

            /** Simpan file ke Drive */
            Storage::cloud()->put("{$this->folderID}/{$namafile}", fopen($file, 'r+'));

            /** Ambil Path dari file yang sudah diupload */
            $path = collect(Storage::cloud()->listContents($this->folderID, false))
                ->where('type', '=', 'file')
                ->where('name', $namafile)
                ->first()['path'];

            /** Insert Path ke DB*/
            $majalah->file = $path;
        }

        $majalah->judul     = $request->judul;
        $majalah->edisi     = $request->edisi;
        $majalah->deskripsi = str_replace(array("\r", "\n"), '', nl2br(trim($request->deskripsi)));
        $majalah->save();

        return redirect()->route('majalah.index')->with('success', 'Data Majalah Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Majalah  $majalah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Majalah $majalah)
    {
        /** Hapus Thumbnail dari Folder Public */
        Storage::delete($majalah->thumbnail);

        /** Hapus file dari Drive */
        Storage::cloud()->delete($majalah->file);

        $majalah->delete();

        return redirect()->route('majalah.index')->with('success', 'Data Majalah Berhasil Dihapus');
    }

    public function showFile(Majalah $majalah)
    {
        /** Menampilkan file dari local ke browser */
        /** Menghilangkan path folder majalah pada file majalah */
        // $namafile = Str::replaceFirst("{$this->pathFileMajalah}/", "", $majalah->file);

        /** Harus ditambahkan header agar selalu menampilkan ke browser
         * note: 'no-cache' diperlukan agar browser selalu update jika file diubah
         */
        // return response()->file(public_path($majalah->file), [
        //     'Content-Type'        => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="' . $namafile . '"',
        //     'Cache-Control'       => 'no-cache'
        // ]);

        /** Menampilkan file dari drive ke browser */
        $readStream = Storage::cloud()->getDriver()->readStream($majalah->file);
        $filename = $majalah->judul;

        return response()->stream(function () use ($readStream) {
            fpassthru($readStream);
        }, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '.pdf"',
            'Cache-Control'       => 'no-cache'
        ]);
    }

    public function downloadFile(Majalah $majalah)
    {
        /** Mendownload file dari local */
        // return response()->download(public_path($majalah->file));

        /** Mendownload file dari drive */
        $readStream = Storage::cloud()->getDriver()->readStream($majalah->file);
        $filename = $majalah->judul;

        return response()->stream(function () use ($readStream) {
            fpassthru($readStream);
        }, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.pdf"',
            'Cache-Control'       => 'no-cache'
        ]);
    }

    private function getPathThumbnail($namafile)
    {
        return "{$this->pathThumbnail}/{$namafile}";
    }

    private function getPathFileMajalah($namafile)
    {
        return "{$this->pathFileMajalah}/{$namafile}";
    }

    /** Tambahkan string random pada nama file untuk menghindari duplikasi nama */
    private function getNamaFile($file)
    {
        return pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
    }

    /* api data majalah untuk web dinamika */
    public function apiData()
    {
        $data = Majalah::orderBy('created_at')->get();
        return response()->json($data, 200);
    }
}
