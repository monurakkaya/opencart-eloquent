<?php

namespace App\Models\Localisation;

use App\Models\Model;

class Country extends Model
{
    //trait
    protected $table = DB_PREFIX.'country';

    protected $primaryKey = 'country_id';

    public $timestamps = false;

    public function zones()
    {
        return $this->hasMany(Zone::class, 'country_id');
    }

    //ocmod
}