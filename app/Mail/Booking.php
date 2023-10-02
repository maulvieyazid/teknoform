<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class Booking extends Mailable
{
    use Queueable, SerializesModels;

    public $status, $nama, $telp, $instansi, $jumlah_peserta;
    public $hari, $tanggal, $pukul;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        // Kalo tanggal kunjungan nya null, maka default nya now
        $carbon_date = $request->tanggal_kunjungan ?? 'now';
        $carbon_date = Carbon::parse($carbon_date)->locale('id');


        $this->status         = $request->status ?? null;
        $this->nama           = $request->nama ?? null;
        $this->telp           = $request->telp ?? null;
        $this->instansi       = $request->instansi ?? null;
        $this->jumlah_peserta = $request->jumlah_peserta ?? null;

        $this->hari           = $carbon_date->translatedFormat('l');
        $this->tanggal        = $carbon_date->translatedFormat('d F Y');
        $this->pukul          = $carbon_date->translatedFormat('H:i');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->status == 'tunggu') {
            return $this->subject('Booking dalam antrian')
                ->view('booking.email.tunggu');
        }
        if ($this->status == 'setuju') {
            return $this->subject('Permintaan booking kunjungan disetujui')
                ->view('email.booking', [
                    'status'  => $this->status,
                    'nama'    => $this->nama,
                    'hari'    => $this->hari,
                    'tanggal' => $this->tanggal,
                    'pukul'   => $this->pukul
                ]);
            // ->view('booking.email.setuju');
        }
        if ($this->status == 'batal') {
            return $this->subject('Permintaan booking kunjungan dibatalkan')
                ->view('email.booking', [
                    'status' => $this->status,
                    'nama'   => $this->nama
                ]);
            // ->view('booking.email.batal');
        }
        if ($this->status == 'notif-booking') {
            return $this
                ->subject('Notifikasi Booking Online Teknoform')
                ->view('email.booking');
        }
    }
}
