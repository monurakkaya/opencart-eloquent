<?php

namespace App\Models\Localisation;

use App\Models\Model;

class Zone extends Model
{
    //trait
    protected $table = DB_PREFIX.'zone';

    protected $primaryKey = 'zone_id';

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }

    //ocmod
}