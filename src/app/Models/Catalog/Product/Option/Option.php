<?php

namespace App\Models\Catalog\Product\Option;

use App\Models\Catalog\Product\Product;
use App\Models\Model;

class Option extends Model
{
    protected $table = DB_PREFIX.'product_option';
    protected $primaryKey = 'product_option_id';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function option()
    {
        return $this->belongsTo(\App\Models\Catalog\Option\Option::class, 'option_id', 'option_id');
    }

    public function values()
    {
        return $this->hasMany(Value::class, 'product_option_id');
    }

    //ocmod
}