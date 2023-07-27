<?php

namespace App\Http\Controllers;

use App\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaKritiksaran = KritikSaran::latest()->get();
        return view('kritik_saran.index', compact('semuaKritiksaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kritik_saran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kritiksaran          = new KritikSaran;
        $kritiksaran->nama    = $request->nama;
        $kritiksaran->email   = $request->email;
        $kritiksaran->no_telp = $request->no_telp;
        $kritiksaran->pesan   = $request->pesan;
        $kritiksaran->save();

        return redirect()->route('kritiksaran.index')->with('success', 'Data Kritik & Saran Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KritikSaran  $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function show(KritikSaran $kritiksaran)
    {
        return view('kritik_saran.show', compact('kritiksaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KritikSaran  $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function edit(KritikSaran $kritiksaran)
    {
        return view('kritik_saran.edit', compact('kritiksaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KritikSaran  $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KritikSaran $kritiksaran)
    {
        $kritiksaran->nama    = $request->nama;
        $kritiksaran->email   = $request->email;
        $kritiksaran->no_telp = $request->no_telp;
        $kritiksaran->pesan   = $request->pesan;
        $kritiksaran->save();

        return redirect()->route('kritiksaran.index')->with('success', 'Data Kritik & Saran Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KritikSaran  $kritiksaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(KritikSaran $kritiksaran)
    {
        $kritiksaran->delete();

        return redirect()->route('kritiksaran.index')->with('success', 'Data Kritik & Saran Berhasil Dihapus');
    }
}
