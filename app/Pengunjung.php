<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    const KATEGORI_UMUM = 'Umum';
    const KATEGORI_SD = 'SD';
    const KATEGORI_SMP = 'SMP';
    const KATEGORI_SMA = 'SMA';
    const KATEGORI_PT = 'Perguruan Tinggi';

    const DARI_BUKU_TAMU = 'Buku Tamu';
    const DARI_VIRTUAL_TOUR = 'Virtual Tour';
    
    protected $primaryKey = 'id_pengunjung';

    protected $table = 'pengunjung';

    protected $fillable = [
        'nama_pengunjung',
        'alamat',
        'instansi',
        'pesan_kesan',
        'jumlah_pengunjung',
        'asal_pengunjung',
        'kategori_pengunjung',
        'input_dari',
    ];
}
