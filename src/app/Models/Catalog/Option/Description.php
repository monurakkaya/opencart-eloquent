<?php


namespace App\Models\Catalog\Option;

use App\Models\Model;

class Description extends Model
{
    //trait
    protected $table = DB_PREFIX.'option_description';

    protected $primaryKey = 'option_description_id';

    public $timestamps = false;

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'option_id');
    }

    //ocmod
}