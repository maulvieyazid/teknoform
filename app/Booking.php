<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'id_booking';

    protected $table = 'booking';

    protected $guarded = [];

    protected $dates = [
        'tanggal_kunjungan',
    ];
}
