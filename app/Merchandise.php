<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Merchandise extends Model
{
    use Sluggable;

    protected $primaryKey = 'id_merchandise';

    protected $table = 'merchandise';

    protected $guarded = [];

    private $pathFotoMerchandise = 'upload/merchandise';

    public function file_photo()
    {
        $pathFotoMerchandise = 'upload/merchandise';
        $semuaFoto = Storage::allFiles($pathFotoMerchandise . '/' . $this->folder_merchandise);
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
                'source' => 'nama_merchandise',
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
