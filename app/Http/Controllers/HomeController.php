<?php

namespace App\Http\Controllers;

use App\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function virtual_tour()
    {
        // Cek apakah ada cookie "has_entered_virtual_tour_data"
        // Kalo tidak ada, maka alihkan ke halaman entry virtual tour
        $cookie = Cookie::get('has_entered_virtual_tour_data', null);
        if (!$cookie) return redirect()->route('entry_virtual_tour');

        return view('360_v2');
    }

    function entry_virtual_tour(Request $request)
    {
        // Cek apakah ada cookie "has_entered_virtual_tour_data", 
        // Kalo ada maka langsung redirect ke virtual tour
        $cookie = $request->cookie('has_entered_virtual_tour_data', null);
        if ($cookie) return redirect()->route('virtual_tour');

        return view('entry-360');
    }

    function store_entry_virtual_tour(Request $request)
    {
        Pengunjung::create([
            'nama_pengunjung'     => $request->nama_pengunjung,
            'instansi'            => $request->instansi,
            'asal_pengunjung'     => $request->asal_pengunjung,
            'kategori_pengunjung' => $request->kategori_pengunjung,
            'input_dari'          => Pengunjung::DARI_VIRTUAL_TOUR,
        ]);

        // Atur waktu cookie selama 1000 tahun
        $minute = 525600 * 1000;

        // Redirect ke halaman virtual tour dengan menyimpan cookie di browser client
        return redirect()->route('virtual_tour')
            ->withCookie(Cookie::make('has_entered_virtual_tour_data', true, $minute));
    }
}
