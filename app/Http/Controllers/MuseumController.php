<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Donasi;
use App\Koleksi;
use App\Majalah;
use App\Agenda;
use App\Berita;
use App\Kategori;
use App\Merchandise;
use App\KritikSaran;
use App\Mail\Booking as MailBooking;
use App\Pengunjung;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MuseumController extends Controller
{
    private $pathFoto = "upload/donasi";
    private $pathFotoKoleksi = "upload/koleksi";

    public function index()
    {
        $koleksi  = Koleksi::take(10)->latest()->get();
        $majalah  = Majalah::latest()->get();
        $agenda   = Agenda::take(3)->latest()->get();
        $kategori = Kategori::latest()->get();
        $berita   = Berita::latest()->get();
        $jmlPengunjung = Pengunjung::whereYear('created_at', now()->format('Y'))->sum('jumlah_pengunjung');

        $popUpAgenda = Agenda::where('pop_up', 1)->latest()->first();

        return view('welcome', compact(
            'koleksi',
            'majalah',
            'agenda',
            'kategori',
            'berita',
            'jmlPengunjung',
            'popUpAgenda',
        ));
    }

    public function booking()
    {
        /** Function ini ada di Parent Controller */
        $hari = $this->getHariBesarIndonesia();
        return view('booking', compact('hari'));
    }

    public function tambah_booking(Request $request)
    {
        $lampiran_surat = $request->lampiran_surat;

        // Pastikan lampiran_surat ada dan valid
        if ($lampiran_surat && $lampiran_surat->isValid()) {
            // Ambil relative path folder dari lampiran_surat_booking
            $rel_path = config('filesystems.disks.lampiran_surat_booking.relative_path');

            // Simpan file ke disk 'lampiran_surat_booking' dengan nama yang unik
            $path = Storage::disk('lampiran_surat_booking')->putFile(null, $lampiran_surat);

            // Tambahkan relative path ke $path
            $path = $rel_path . '/' . $path;
        }

        // Simpan data Booking
        $booking                    = new Booking;
        $booking->nama              = $request->nama;
        $booking->email             = $request->email;
        $booking->telp              = $request->telp;
        $booking->instansi          = $request->instansi;
        $booking->jumlah_peserta    = $request->jumlah_peserta;
        $booking->tanggal_kunjungan = $request->tanggal_kunjungan;
        $booking->status            = 'tunggu';
        $booking->lampiran_surat    = $path ?? null;
        $booking->save();


        /** Kirim email notifikasi ke Penjaga Museum */

        // Ubah status nya agar terdeteksi di view email.
        // NOTE : ini tidak mengubah data di database, data yang sudah tersimpan tetap terjaga
        $booking->status = 'notif-booking';

        $tos = ['teknoform@dinamika.ac.id', 'galih@dinamika.ac.id'];

        foreach ($tos as $to) {
            Mail::to($to)->send(new MailBooking($booking));
        }
        /** Kirim email notifikasi ke Penjaga Museum */

        return redirect('/')->with('status', 'Berhasil menambahkan data booking, tunggu konfirmasi dari pihak museum');

        // return redirect()->back()->with('status', 'Berhasil menambahkan data booking, tunggu konfirmasi dari pihak museum');
    }

    public function buku_tamu()
    {
        return view('tamu');
    }

    public function tambah_data_tamu(Request $request)
    {
        Pengunjung::create([
            'nama_pengunjung'     => $request->nama_pengunjung,
            'instansi'            => $request->instansi,
            'pesan_kesan'         => $request->pesan_kesan,
            'jumlah_pengunjung'   => $request->jumlah_pengunjung,
            'asal_pengunjung'     => $request->asal_pengunjung,
            'kategori_pengunjung' => $request->kategori_pengunjung,
            'input_dari'          => Pengunjung::DARI_BUKU_TAMU,
        ]);

        return redirect()->back()->with('status', 'Terimakasih sudah mengisi buku tamu');
    }

    public function merchandise()
    {
        $merchandise = Merchandise::paginate(9);

        return view('merchandise', compact(
            // 'katalog',
            'merchandise'
        ));
    }

    public function merchandise_produk(Merchandise $merchandise)
    {
        return view('produk', compact(
            // 'produk',
            'merchandise'
        ));
    }

    public function donasi()
    {
        return view('donasi');
    }

    public function tambah_donasi(Request $request)
    {
        $donasi = new Donasi;

        $foto = $request->file('foto');

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
        $donasi->status       = 'tunggu';
        $donasi->save();

        return redirect('/')->with('status', 'Berhasil menambahkan data donasi, tunggu konfirmasi dari pihak museum');
    }

    public function simpan_saran(Request $request)
    {
        KritikSaran::create([
            'nama'    => $request->nama,
            'email'   => $request->email,
            'no_telp' => $request->no_telp,
            'pesan'   => $request->pesan,
        ]);
        return redirect('/')->with('status', 'Terimakasih untuk pesan/saran yang diberikan');
    }

    public function galeri(Kategori $kategori)
    {
        return view('galeri', compact(
            'kategori'
        ));
    }

    public function agenda()
    {
        $agenda = Agenda::paginate(9);
        return view('agenda', compact(
            'agenda'
        ));
    }

    public function event_agenda(Agenda $agenda)
    {
        return view('event', compact(
            'agenda'
        ));
    }

    public function berita(Berita $berita)
    {
        return view('berita', compact('berita'));
    }

    public function ensiklopedia()
    {
        $semuaKoleksi = Koleksi::with('donasi')->paginate(9);
        return view('ensiklopedia', compact('semuaKoleksi'));
    }

    public function ensiklopedia_koleksi(Koleksi $koleksi)
    {
        return view('ensiklopedia-koleksi', compact('koleksi'));
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
}
