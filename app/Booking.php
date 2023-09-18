<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const STATUS_TUNGGU = 'tunggu';
    const STATUS_SETUJU = 'setuju';
    const STATUS_BATAL = 'batal';
    
    protected $primaryKey = 'id_booking';

    protected $table = 'booking';

    protected $guarded = [];

    protected $dates = [
        'tanggal_kunjungan',
    ];
}
