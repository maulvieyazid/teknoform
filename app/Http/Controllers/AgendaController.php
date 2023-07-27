<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    private $pathFoto = 'upload/agenda';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaAgenda = Agenda::latest()->get();
        return view('agenda.index', compact('semuaAgenda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agenda = new Agenda;

        $foto = $request->foto;

        /** Kalo ada fotonya */
        if ($foto) {
            $namafile = $this->getNamaFile($foto);

            /** Simpan Foto ke Disk
             * note: konfigurasi disk 'foto_agenda' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('foto_agenda')->putFileAs(null, $foto, $namafile);

            /** Insert Foto */
            $agenda->foto = $this->getPathFoto($namafile);
        }

        $agenda->nama_agenda     = $request->nama_agenda;
        $agenda->tanggal_mulai   = $request->tanggal_mulai;
        $agenda->tanggal_selesai = $request->tanggal_selesai;
        $agenda->deskripsi       = $request->deskripsi;
        $agenda->pop_up          = $request->pop_up;
        $agenda->save();

        return redirect()->route('agenda.index')->with('success', 'Data Agenda Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return view('agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $foto = $request->foto;

        /** Kalo ada fotonya */
        if ($foto) {
            $namafile = $this->getNamaFile($foto);

            /** Hapus File Foto dari Folder Public */
            Storage::delete($agenda->foto);

            /** Simpan Foto ke Disk
             * note: konfigurasi disk 'foto_agenda' dapat dilihat pada config/filesystems.php
             */
            Storage::disk('foto_agenda')->putFileAs(null, $foto, $namafile);

            /** Update Foto */
            $agenda->foto = $this->getPathFoto($namafile);
        }

        $agenda->slug            = null;
        $agenda->nama_agenda     = $request->nama_agenda;
        $agenda->tanggal_mulai   = $request->tanggal_mulai;
        $agenda->tanggal_selesai = $request->tanggal_selesai;
        $agenda->deskripsi       = $request->deskripsi;
        $agenda->pop_up          = $request->pop_up;
        $agenda->save();

        return redirect()->route('agenda.index')->with('success', 'Data Agenda Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        /** Hapus File Foto dari Folder Public */
        Storage::delete($agenda->foto);

        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Data Agenda Berhasil Dihapus');
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
