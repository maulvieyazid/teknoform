<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Galeri;

class Kategori extends Model
{
    use Sluggable;

    protected $primaryKey = 'id_kategori';

    protected $table = 'kategori';

    protected $guarded = [];

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'id_kategori', 'id_kategori');
    }

    public function file_photo(){
        $pathFotoGaleri = 'upload/galeri';
        $semuaFoto = Storage::allFiles($pathFotoGaleri . '/' . $this->folder_kategori);
        return $semuaFoto;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'   => 'nama_kategori',
                'onUpdate' => true,
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
