<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Agenda extends Model
{
    use Sluggable;

    protected $primaryKey = 'id_agenda';

    protected $table = 'agenda';

    protected $guarded = [];

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_agenda',
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
