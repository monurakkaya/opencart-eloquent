<?php


namespace App\Models\Catalog\Product;

use App\Models\Model;

class Description extends Model
{
    //trait
    protected $table = DB_PREFIX.'product_description';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    //ocmod
}