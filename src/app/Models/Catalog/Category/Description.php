<?php


namespace App\Models\Catalog\Category;

use App\Models\Model;

class Description extends Model
{
    //trait
    protected $table = DB_PREFIX.'category_description';

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    //ocmod
}