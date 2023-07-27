<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    //
    protected $primaryKey = 'id_saran';

    protected $table = 'kritik_saran';

    protected $guarded = [];
}
