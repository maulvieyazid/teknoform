<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Donasi extends Mailable
{
    use Queueable, SerializesModels;

    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->status == 'tunggu') {
            return $this->subject('Donasi dalam antrian')
                ->view('donasi.email.tunggu');
        }
        if ($this->status == 'dalam pengiriman') {
            return $this->subject('Pengiriman item donasi')
                ->view('donasi.email.dalam-pengiriman');
        }
        if ($this->status == 'terima') {
            return $this->subject('Donasi telah diterima')
                ->view('donasi.email.terima');
        }
        if ($this->status == 'tolak') {
            return $this->subject('Donasi ditolak')
                ->view('donasi.email.tolak');
        }
    }
}
