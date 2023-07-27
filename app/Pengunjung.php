<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $primaryKey = 'id_pengunjung';

    protected $table = 'pengunjung';

    protected $fillable = [
        'nama_pengunjung',
        'alamat',
        'instansi',
        'pesan_kesan',
        'jumlah_pengunjung',
    ];
}
