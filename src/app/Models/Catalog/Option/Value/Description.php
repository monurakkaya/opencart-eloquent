<?php


namespace App\Models\Catalog\Option\Value;

use App\Models\Model;

class Description extends Model
{
    //trait
    protected $table = DB_PREFIX.'option_value_description';

    protected $primaryKey = 'option_value_description_id';

    public $timestamps = false;

    public function value()
    {
        return $this->belongsTo(Value::class, 'option_value_id', 'option_value_id');
    }

    //ocmod
}