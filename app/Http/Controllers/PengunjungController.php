<?php

namespace App\Http\Controllers;

use App\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaPengunjung = Pengunjung::latest()->get();
        return view('pengunjung.index', compact('semuaPengunjung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengunjung.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'created_at' => 'required',
        ], [
            'created_at.required' => 'Tanggal Selesai Kunjungan tidak boleh kosong',
        ]);
        
        $pengunjung                    = new Pengunjung;
        $pengunjung->nama_pengunjung   = $request->nama_pengunjung;
        $pengunjung->alamat            = $request->alamat;
        $pengunjung->instansi          = $request->instansi;
        $pengunjung->pesan_kesan       = $request->pesan_kesan;
        $pengunjung->jumlah_pengunjung = $request->jumlah_pengunjung;
        $pengunjung->created_at        = $request->created_at;
        $pengunjung->save();

        return redirect()->route('pengunjung.index')->with('success', 'Data Pengunjung Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function show(Pengunjung $pengunjung)
    {
        return view('pengunjung.show', compact('pengunjung'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengunjung $pengunjung)
    {
        return view('pengunjung.edit', compact('pengunjung'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengunjung $pengunjung)
    {
        $request->validate([
            'created_at' => 'required',
        ], [
            'created_at.required' => 'Tanggal Selesai Kunjungan tidak boleh kosong',
        ]);

        $pengunjung->nama_pengunjung   = $request->nama_pengunjung;
        $pengunjung->alamat            = $request->alamat;
        $pengunjung->instansi          = $request->instansi;
        $pengunjung->pesan_kesan       = $request->pesan_kesan;
        $pengunjung->jumlah_pengunjung = $request->jumlah_pengunjung;
        $pengunjung->created_at        = $request->created_at;
        $pengunjung->save();

        return redirect()->route('pengunjung.index')->with('success', 'Data Pengunjung Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengunjung $pengunjung)
    {
        $pengunjung->delete();

        return redirect()->route('pengunjung.index')->with('success', 'Data Pengunjung Berhasil Dihapus');
    }
}
