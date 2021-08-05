<?php

namespace App\Models\Catalog\Product\Option;

use App\Models\Catalog\Product\Product;
use App\Models\Model;

class Value extends Model
{
    protected $table = DB_PREFIX.'product_option_value';
    protected $primaryKey = 'product_option_value_id';

    public function value()
    {
        return $this->belongsTo(\App\Models\Catalog\Option\Value\Value::class, 'option_value_id', 'option_value_id');
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'product_option_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    //ocmod
}