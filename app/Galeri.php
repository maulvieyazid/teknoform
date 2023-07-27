<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kategori;

class Galeri extends Model
{
    protected $primaryKey = 'id_galeri';

    protected $table = 'galeri';

    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
