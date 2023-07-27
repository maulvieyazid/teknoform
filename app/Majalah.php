<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Majalah extends Model
{
    protected $primaryKey = 'id_majalah';

    protected $table = 'majalah';

    protected $guarded = [];
}
