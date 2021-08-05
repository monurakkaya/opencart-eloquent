<?php


namespace App\Models\Catalog\Option;

use App\Models\Model;

class Description extends Model
{
    protected $table = DB_PREFIX.'option_description';

    protected $primaryKey = 'option_description_id';

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'option_id');
    }

    //ocmod
}