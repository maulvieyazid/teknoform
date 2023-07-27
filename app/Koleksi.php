<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Donasi;
use Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Koleksi extends Model
{
    use Sluggable;

    protected $primaryKey = 'id_koleksi';

    protected $table = 'koleksi';

    protected $guarded = [];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
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
                'source'   => 'nama_koleksi',
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
