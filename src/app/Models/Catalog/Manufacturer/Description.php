<?php


namespace App\Models\Catalog\Manufacturer;

use App\Models\Model;

class Description extends Model
{
    //trait
    protected $table = DB_PREFIX.'manufacturer_description';

    public $timestamps = false;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'manufacturer_id');
    }

    //ocmod
}