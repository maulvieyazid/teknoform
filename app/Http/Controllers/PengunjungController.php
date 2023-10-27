<?php

namespace App\Http\Controllers;

use App\Pengunjung;
use Illuminate\Http\Request;
use Shuchkin\SimpleXLSXGen;

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

        $pengunjung                      = new Pengunjung;
        $pengunjung->nama_pengunjung     = $request->nama_pengunjung;
        $pengunjung->alamat              = $request->alamat;
        $pengunjung->instansi            = $request->instansi;
        $pengunjung->pesan_kesan         = $request->pesan_kesan;
        $pengunjung->jumlah_pengunjung   = $request->jumlah_pengunjung;
        $pengunjung->asal_pengunjung     = $request->asal_pengunjung;
        $pengunjung->kategori_pengunjung = $request->kategori_pengunjung;
        $pengunjung->input_dari          = $request->input_dari;
        $pengunjung->created_at          = $request->created_at;
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

        $pengunjung->nama_pengunjung     = $request->nama_pengunjung;
        $pengunjung->alamat              = $request->alamat;
        $pengunjung->instansi            = $request->instansi;
        $pengunjung->pesan_kesan         = $request->pesan_kesan;
        $pengunjung->jumlah_pengunjung   = $request->jumlah_pengunjung;
        $pengunjung->asal_pengunjung     = $request->asal_pengunjung;
        $pengunjung->kategori_pengunjung = $request->kategori_pengunjung;
        $pengunjung->input_dari          = $request->input_dari;
        $pengunjung->created_at          = $request->created_at;
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

    function excelPengunjung()
    {
        $pengunjung = Pengunjung::orderBy('id_pengunjung')->get();

        $data = [
            [
                '<style border="thin"><center>' . 'Nama Pengunjung' . '</center></style>',
                '<style border="thin"><center>' . 'Alamat' . '</center></style>',
                '<style border="thin"><center>' . 'Instansi' . '</center></style>',
                '<style border="thin"><center>' . 'Pesan Kesan' . '</center></style>',
                '<style border="thin"><center>' . 'Jumlah Pengunjung' . '</center></style>',
                '<style border="thin"><center>' . 'Asal Pengunjung' . '</center></style>',
                '<style border="thin"><center>' . 'Kategori Pengunjung' . '</center></style>',
                '<style border="thin"><center>' . 'Input Dari' . '</center></style>',
                '<style border="thin"><center>' . 'Dibuat' . '</center></style>',
            ]
        ];

        foreach ($pengunjung as $row) {
            $data[] = [
                $row['nama_pengunjung'],
                $row['alamat'],
                $row['instansi'],
                $row['pesan_kesan'],
                '<center>' . $row['jumlah_pengunjung'] . '</center>',
                $row['asal_pengunjung'],
                $row['kategori_pengunjung'],
                $row['input_dari'],
                $row['created_at'],
            ];
        }

        $xlsx = SimpleXLSXGen::fromArray($data);
        $xlsx->setDefaultFontSize(11);

        // Set width semua kolom menjadi 20
        foreach ($data[0] as $key => $value) {
            $xlsx->setColWidth($key + 1, 20);
        }

        $xlsx->downloadAs('Data Pengunjung Museum.xlsx');
    }
}
