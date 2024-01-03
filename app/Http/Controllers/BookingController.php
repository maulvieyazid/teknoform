<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Mail\Booking as MailBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaBooking = Booking::latest()->get();
        return view('booking.index', compact('semuaBooking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** Function ini ada di Parent Controller */
        $hari = $this->getHariBesarIndonesia();
        return view('booking.create', compact('hari'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $booking                    = new Booking;
        $booking->nama              = $request->nama;
        $booking->email             = $request->email;
        $booking->telp              = $request->telp;
        $booking->instansi          = $request->instansi;
        $booking->jumlah_peserta    = $request->jumlah_peserta;
        $booking->tanggal_kunjungan = $request->tanggal_kunjungan;
        $booking->status            = $request->status;
        $booking->lampiran_surat    = $path ?? null;
        $booking->save();

        /** Jika checkbox kirim notifikasi email dicentang */
        if ($request->sendEmail) {
            /** Kirim notifikasi email ke pengunjung */
            $this->sendEmail($request);
        }

        return redirect()->route('booking.index')->with('success', 'Data Booking Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        /** Function ini ada di Parent Controller */
        $hari = $this->getHariBesarIndonesia();
        return view('booking.edit', compact('booking', 'hari'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $lampiran_surat = $request->lampiran_surat;

        // Default path adalah path surat lampiran yang ada sekarang
        $path = $booking->lampiran_surat;

        // Pastikan lampiran_surat ada dan valid
        if ($lampiran_surat && $lampiran_surat->isValid()) {
            // Hapus lampiran surat yang sudah ada
            if ($booking->lampiran_surat) Storage::delete($booking->lampiran_surat);

            // Ambil relative path folder dari lampiran_surat_booking
            $rel_path = config('filesystems.disks.lampiran_surat_booking.relative_path');

            // Simpan file ke disk 'lampiran_surat_booking' dengan nama yang unik
            $path = Storage::disk('lampiran_surat_booking')->putFile(null, $lampiran_surat);

            // Tambahkan relative path ke $path
            $path = $rel_path . '/' . $path;
        }

        $booking->nama              = $request->nama;
        $booking->email             = $request->email;
        $booking->telp              = $request->telp;
        $booking->instansi          = $request->instansi;
        $booking->jumlah_peserta    = $request->jumlah_peserta;
        $booking->tanggal_kunjungan = $request->tanggal_kunjungan;
        $booking->status            = $request->status;
        $booking->lampiran_surat    = $path ?? null;
        $booking->save();

        /** Jika checkbox kirim notifikasi email dicentang */
        if ($request->sendEmail) {
            /** Kirim notifikasi email ke pengunjung */
            $this->sendEmail($request);
        }

        return redirect()->route('booking.index')->with('success', 'Data Booking Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        // Kalo ada file lampiran surat nya, maka hapus
        if ($booking->lampiran_surat) Storage::delete($booking->lampiran_surat);

        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Data Booking Berhasil Dihapus');
    }

    private function sendEmail($request)
    {
        /** Kirim email secara langsung */
        Mail::to($request->email)->send(new MailBooking($request));

        /** Antrikan email untuk nanti dijalankan oleh cron */
        // Mail::to($request->email)->queue(new MailBooking($request));
    }
}
