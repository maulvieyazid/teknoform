<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Koleksi;

class Donasi extends Model
{
    protected $primaryKey = 'id_donasi';

    protected $table = 'donasi';

    protected $guarded = [];

    public function koleksi()
    {
        return $this->hasOne(Koleksi::class, 'id_donasi', 'id_donasi');
    }
}
