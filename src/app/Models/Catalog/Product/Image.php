<?php

namespace App\Models\Catalog\Product;

use App\Models\Model;

class Image extends Model
{
    //trait
    protected $table = DB_PREFIX.'product_image';
    protected $primaryKey = 'product_image_id';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function getFullUrl()
    {
        return DIR_CATALOG.$this->image;
    }

    //ocmod
}