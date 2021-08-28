<?php


namespace App\Models\Catalog\Product;


use App\Models\Catalog\Category\Category;
use App\Models\Catalog\Manufacturer\Manufacturer;
use App\Models\Catalog\Product\Option\Option;
use App\Models\Model;
use App\Support\Helper;
use App\Traits\HasDescription;

class Product extends Model
{
    //trait
    use HasDescription;

    protected $table = DB_PREFIX.'product';

    protected $primaryKey = 'product_id';

    public function categories()
    {
        return $this->belongsToMany(Category::class, DB_PREFIX.'product_to_category', 'product_id', 'category_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'manufacturer_id');
    }

    public function description()
    {
        return $this->hasOne(Description::class, 'product_id')
            ->where('language_id', Helper::session('config_language_id', 1));
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class, 'product_id');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id')->orderBy('sort_order');
    }

    //ocmod
}