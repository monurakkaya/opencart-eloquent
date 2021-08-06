<?php


namespace App\Models\Catalog\Manufacturer;


use App\Models\Catalog\Product\Product;
use App\Models\Model;

class Manufacturer extends Model
{
    //trait
    protected $table = DB_PREFIX.'manufacturer';

    protected $primaryKey = 'manufacturer_id';

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'manufacturer_id', 'manufacturer_id');
    }

    //ocmod
}