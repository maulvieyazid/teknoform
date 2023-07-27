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

    public $status, $nama, $hari, $tanggal, $pukul;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->status  = $request->status;
        $this->nama    = $request->nama;
        $this->hari    = Carbon::parse($request->tanggal_kunjungan)->locale('id')->translatedFormat('l');
        $this->tanggal = Carbon::parse($request->tanggal_kunjungan)->locale('id')->translatedFormat('d F Y');
        $this->pukul   = Carbon::parse($request->tanggal_kunjungan)->locale('id')->translatedFormat('H:i:s');
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
    }
}
