<?php


namespace App\Models\Catalog\Category;


use App\Models\Catalog\Product\Product;
use App\Models\Model;
use App\Support\Helper;

class Category extends Model
{
    //trait
    protected $table = DB_PREFIX.'category';

    protected $primaryKey = 'category_id';

    public function description()
    {
        return $this->hasOne(Description::class, 'category_id')
            ->where('language_id', Helper::session('config_language_id', 1));
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class, 'category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, DB_PREFIX.'product_to_category', 'category_id', 'product_id');
    }

    //ocmod
}